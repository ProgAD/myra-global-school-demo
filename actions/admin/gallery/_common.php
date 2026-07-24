<?php
/* Gallery module: admin bootstrap + storage helpers.

   Storage layout (as specified):
     assets/gallery/album-<albumId>/<albumId>-<mediaId>.<ext>
   album_medias.photo and albums.cover both store the path RELATIVE to
   assets/gallery/, e.g.  "album-5/5-12.jpg".
*/
require_once __DIR__ . '/../_common.php';

const GALLERY_IMG_EXT = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
const GALLERY_MAX_BYTES = 8 * 1024 * 1024;   // 8 MB per image

/** Absolute path of assets/gallery/ (with trailing slash). */
function gallery_root() {
    return dirname(__DIR__, 3) . '/assets/gallery/';
}

/** Absolute folder for one album. */
function album_dir($albumId) {
    return gallery_root() . 'album-' . (int)$albumId . '/';
}

/** Ensure an album's folder exists; return false if it can't be made/written. */
function ensure_album_dir($albumId) {
    $dir = album_dir($albumId);
    if (!is_dir($dir) && !@mkdir($dir, 0775, true)) return false;
    return is_writable($dir) ? $dir : false;
}

/** Recursively remove a directory and its contents. */
function rrmdir($dir) {
    if (!is_dir($dir)) return;
    $items = array_diff(scandir($dir), ['.', '..']);
    foreach ($items as $it) {
        $p = $dir . DIRECTORY_SEPARATOR . $it;
        is_dir($p) ? rrmdir($p) : @unlink($p);
    }
    @rmdir($dir);
}

/** Media count for an album. */
function media_count(mysqli $conn, $albumId) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM album_medias WHERE album_id = ?");
    $stmt->bind_param('i', $albumId);
    $stmt->execute();
    $n = (int)($stmt->get_result()->fetch_row()[0] ?? 0);
    $stmt->close();
    return $n;
}

/** "December 2024" from a timestamp. */
function month_year($ts) { return $ts ? date('F Y', strtotime($ts)) : ''; }
