<?php
/* POST actions/admin/gallery/set_cover.php  Body: { album_id, media_id } */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in       = read_input();
$albumId  = (int)($in['album_id'] ?? 0);
$mediaId  = (int)($in['media_id'] ?? 0);

if ($albumId <= 0 || $mediaId <= 0) {
    json_out(['success' => false, 'message' => 'Invalid album or media.'], 400);
}

/* the media must belong to this album */
$stmt = $conn->prepare("SELECT photo FROM album_medias WHERE id = ? AND album_id = ? LIMIT 1");
$stmt->bind_param('ii', $mediaId, $albumId);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$row) {
    json_out(['success' => false, 'message' => 'That image is not part of this album.'], 404);
}

$stmt = $conn->prepare("UPDATE albums SET cover = ? WHERE id = ?");
$stmt->bind_param('si', $row['photo'], $albumId);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'cover' => $row['photo']]);
