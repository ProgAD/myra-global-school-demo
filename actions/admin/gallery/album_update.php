<?php
/* POST actions/admin/gallery/album_update.php  Body: { id, title, description } */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in    = read_input();
$id    = (int)($in['id'] ?? 0);
$title = trim($in['title'] ?? '');
$desc  = trim($in['description'] ?? '');

if ($id <= 0)       json_out(['success' => false, 'message' => 'Invalid album id.'], 400);
if ($title === '')  json_out(['success' => false, 'message' => 'Album title is required.'], 400);

$stmt = $conn->prepare("UPDATE albums SET title = ?, description = ? WHERE id = ?");
$stmt->bind_param('ssi', $title, $desc, $id);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'id' => $id]);
