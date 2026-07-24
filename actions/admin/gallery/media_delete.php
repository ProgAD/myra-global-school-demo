<?php
/* POST actions/admin/gallery/media_delete.php  Body: { id }
   Deletes a single media row + its file. If it was the album cover,
   the cover falls back to another image (or empty). */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in = read_input();
$id = (int)($in['id'] ?? 0);
if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Invalid media id.'], 400);
}

$stmt = $conn->prepare("SELECT album_id, photo FROM album_medias WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$m = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$m) {
    json_out(['success' => false, 'message' => 'Media not found.'], 404);
}
$albumId = (int)$m['album_id'];
$photo   = $m['photo'];

$stmt = $conn->prepare("DELETE FROM album_medias WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();

if ($photo !== '') { @unlink(gallery_root() . $photo); }

/* if that was the cover, pick a new one */
$newCover = null;
$cstmt = $conn->prepare("SELECT cover FROM albums WHERE id = ? LIMIT 1");
$cstmt->bind_param('i', $albumId);
$cstmt->execute();
$curCover = $cstmt->get_result()->fetch_row()[0] ?? '';
$cstmt->close();

if ($curCover === $photo) {
    $nstmt = $conn->prepare("SELECT photo FROM album_medias WHERE album_id = ? ORDER BY id ASC LIMIT 1");
    $nstmt->bind_param('i', $albumId);
    $nstmt->execute();
    $newCover = $nstmt->get_result()->fetch_row()[0] ?? '';
    $nstmt->close();

    $ustmt = $conn->prepare("UPDATE albums SET cover = ? WHERE id = ?");
    $ustmt->bind_param('si', $newCover, $albumId);
    $ustmt->execute();
    $ustmt->close();
}

json_out(['success' => true, 'id' => $id, 'new_cover' => $newCover]);
