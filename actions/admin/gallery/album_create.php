<?php
/* POST actions/admin/gallery/album_create.php  Body: { title, description }
   Creates the album (cover empty until media is added) and its folder. */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in    = read_input();
$title = trim($in['title'] ?? '');
$desc  = trim($in['description'] ?? '');

if ($title === '') {
    json_out(['success' => false, 'message' => 'Album title is required.'], 400);
}

$empty = '';
$stmt = $conn->prepare("INSERT INTO albums (title, description, cover) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $title, $desc, $empty);
$stmt->execute();
$id = (int)$stmt->insert_id;
$stmt->close();

if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Could not create the album.'], 500);
}

// create the storage folder now so uploads have somewhere to land
ensure_album_dir($id);

json_out(['success' => true, 'id' => $id, 'redirect' => 'album.php?id=' . $id]);
