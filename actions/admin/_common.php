<?php
/* ============================================================
   Shared bootstrap for every admin API module.

   Guarantees a JSON-only response surface: PHP notices, warnings,
   uncaught exceptions and fatals are all converted to JSON so the
   client never receives stray HTML.

   Provides: $conn (mysqli), require_admin(), read_input(),
             json_out(), and small shared helpers.
   ============================================================ */

ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function json_out($data, $code = 200) {
    if (ob_get_level()) { ob_clean(); }          // drop anything already printed
    if (!headers_sent()) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
    }
    echo json_encode($data);
    exit;
}

set_error_handler(function ($no, $str, $file, $line) {
    throw new ErrorException($str, 0, $no, $file, $line);
});
set_exception_handler(function ($e) {
    json_out(['success' => false, 'message' => $e->getMessage()], 500);
});
register_shutdown_function(function () {
    $e = error_get_last();
    if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        json_out(['success' => false, 'message' => 'Server error: ' . $e['message']], 500);
    }
});

/* mysqli throws instead of warning, so bad connections / prepares
   surface as clean JSON. */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // dirname(__DIR__, 2) == project root, regardless of caller depth
    require_once dirname(__DIR__, 2) . '/config/db.php';
} catch (Throwable $e) {
    json_out([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage(),
    ], 503);
}

function require_admin() {
    if (!isset($_SESSION['user_id'])) {
        json_out(['success' => false, 'message' => 'Not authenticated. Please sign in again.'], 401);
    }
}

function require_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        json_out(['success' => false, 'message' => 'Method not allowed.'], 405);
    }
}

/** Read JSON body, falling back to form-encoded POST. */
function read_input() {
    $in = json_decode(file_get_contents('php://input'), true);
    return is_array($in) ? $in : $_POST;
}

/** Normalise an ids payload into a list of positive ints. */
function clean_ids($raw) {
    if (!is_array($raw)) { $raw = [$raw]; }
    return array_values(array_unique(array_filter(
        array_map('intval', $raw),
        function ($v) { return $v > 0; }
    )));
}

/** Pagination params -> [perPage(int|0 for all), page, isAll] */
function paging_params($defaultPer = 10) {
    $perRaw = $_GET['per_page'] ?? (string)$defaultPer;
    $isAll  = ($perRaw === 'all');
    return [
        $isAll ? 0 : max(1, min(200, (int)$perRaw)),
        max(1, (int)($_GET['page'] ?? 1)),
        $isAll,
    ];
}

function fmt_date($ts) {
    return $ts ? date('d M Y', strtotime($ts)) : '';
}

/** "2h ago" / "Yesterday" / "12 Jul 2026" */
function human_time($ts) {
    if (!$ts) return '';
    $t = strtotime($ts);
    $diff = time() - $t;
    if ($diff < 60)    return 'Just now';
    if ($diff < 3600)  return floor($diff / 60) . 'm ago';
    if ($diff < 86400) return floor($diff / 3600) . 'h ago';
    if ($diff < 172800) return 'Yesterday';
    if ($diff < 604800) return floor($diff / 86400) . ' days ago';
    return date('d M Y', $t);
}
