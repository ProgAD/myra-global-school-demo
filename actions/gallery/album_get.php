<?php
/* GET actions/gallery/album_get.php?id=<id>  (public)
   One album's details + its photos. */
require __DIR__ . '/../_public_boot.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Invalid album.'], 400);
}

$stmt = $conn->prepare("SELECT id, title, description, cover, created_at FROM albums WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$album = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$album) {
    json_out(['success' => false, 'message' => 'Album not found.'], 404);
}

$stmt = $conn->prepare("SELECT id, photo FROM album_medias WHERE album_id = ? ORDER BY id ASC");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();

$media = [];
while ($m = $res->fetch_assoc()) {
    $media[] = [
        'id'  => (int)$m['id'],
        'url' => 'assets/gallery/' . $m['photo'],
    ];
}
$stmt->close();

json_out([
    'success' => true,
    'album'   => [
        'id'          => (int)$album['id'],
        'title'       => $album['title'],
        'description' => $album['description'],
        'date'        => $album['created_at'] ? date('F Y', strtotime($album['created_at'])) : '',
        'count'       => count($media),
    ],
    'media'   => $media,
]);
