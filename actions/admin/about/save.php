<?php
/* ============================================================
   POST actions/admin/about/save.php   (multipart/form-data)
   Auth: admin session required.
   Saves the About-page content (text + photos) to
   assets/json/about.json. Photos upload to assets/about/.
   No database needed.
   ============================================================ */

ini_set('display_errors', '0');
error_reporting(E_ALL);
ob_start();
if (session_status() === PHP_SESSION_NONE) session_start();

function out($data, $code = 200) {
    if (ob_get_level()) ob_clean();
    if (!headers_sent()) { http_response_code($code); header('Content-Type: application/json; charset=utf-8'); }
    echo json_encode($data); exit;
}
set_exception_handler(function ($e) { out(['success' => false, 'message' => $e->getMessage()], 500); });
register_shutdown_function(function () {
    $e = error_get_last();
    if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        out(['success' => false, 'message' => 'Server error: ' . $e['message']], 500);
    }
});

if ($_SERVER['REQUEST_METHOD'] !== 'POST') out(['success' => false, 'message' => 'Method not allowed.'], 405);
if (!isset($_SESSION['user_id']))          out(['success' => false, 'message' => 'Not authenticated. Please sign in again.'], 401);

$ROOT = dirname(__DIR__, 3);                    // project root
require_once $ROOT . '/components/about-data.php';

$data = about_data();                          // current content (defaults merged)

/* ---- text fields: keep existing value if a field is submitted empty ---- */
function put(&$target, $key) {
    $v = trim((string)($_POST[$key] ?? ''));
    return $v;
}
$map = [
    ['principal', 'message', 'principal_message'],
    ['principal', 'sub',     'principal_sub'],
    ['vice',      'message', 'vice_message'],
    ['vice',      'sub',     'vice_sub'],
    ['team',      'captionTitle', 'team_title'],
    ['team',      'captionText',  'team_text'],
];
foreach ($map as [$sec, $key, $field]) {
    $v = trim((string)($_POST[$field] ?? ''));
    if ($v !== '') $data[$sec][$key] = $v;
}
$m = trim((string)($_POST['mission'] ?? '')); if ($m !== '') $data['mission'] = $m;
$vn = trim((string)($_POST['vision'] ?? '')); if ($vn !== '') $data['vision'] = $vn;

/* ---- photo uploads ---- */
const IMG_EXT   = ['jpg', 'jpeg', 'png', 'webp'];
const MAX_BYTES = 3 * 1024 * 1024;             // 3 MB

$dir = $ROOT . '/assets/about/';
$uploads = [                                    // field name => [section, base filename]
    'principal_photo' => ['principal', 'principal'],
    'vice_photo'      => ['vice',      'vice'],
    'team_photo'      => ['team',      'team'],
];

foreach ($uploads as $field => [$sec, $base]) {
    $f = $_FILES[$field] ?? null;
    if (!$f || !isset($f['error']) || $f['error'] === UPLOAD_ERR_NO_FILE) continue;   // no new file
    if ($f['error'] !== UPLOAD_ERR_OK) out(['success' => false, 'message' => ucfirst($base) . ' photo upload failed (error ' . $f['error'] . ').'], 422);
    if ($f['size'] > MAX_BYTES)        out(['success' => false, 'message' => ucfirst($base) . ' photo must be 3 MB or smaller.'], 422);

    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, IMG_EXT, true)) out(['success' => false, 'message' => ucfirst($base) . ' photo must be JPG, PNG or WEBP.'], 422);
    if (!is_uploaded_file($f['tmp_name']) || !@getimagesize($f['tmp_name'])) out(['success' => false, 'message' => ucfirst($base) . ' photo is not a valid image.'], 422);

    if (!is_dir($dir) && !@mkdir($dir, 0775, true)) out(['success' => false, 'message' => 'Upload folder could not be created on the server.'], 500);
    if (!is_writable($dir))                          out(['success' => false, 'message' => 'Upload folder is not writable on the server.'], 500);

    $fileName = $base . '-' . substr(md5(uniqid('', true)), 0, 8) . '.' . $ext;
    if (!@move_uploaded_file($f['tmp_name'], $dir . $fileName)) out(['success' => false, 'message' => 'Could not save the ' . $base . ' photo.'], 500);
    @chmod($dir . $fileName, 0644);

    /* remove the previous uploaded photo (only if it lived in assets/about/) */
    $old = $data[$sec]['photo'] ?? '';
    if (is_string($old) && strpos($old, 'assets/about/') === 0) {
        $oldPath = $ROOT . '/' . $old;
        if (is_file($oldPath)) @unlink($oldPath);
    }
    $data[$sec]['photo'] = 'assets/about/' . $fileName;
}

/* ---- write the JSON ---- */
$jsonDir = dirname(about_json_path());
if (!is_dir($jsonDir) && !@mkdir($jsonDir, 0775, true)) out(['success' => false, 'message' => 'Data folder could not be created.'], 500);

$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($json === false) out(['success' => false, 'message' => 'Could not encode data.'], 500);
if (file_put_contents(about_json_path(), $json, LOCK_EX) === false) out(['success' => false, 'message' => 'Could not write about.json. Check file permissions.'], 500);

out(['success' => true, 'message' => 'About page updated successfully.', 'data' => $data]);
