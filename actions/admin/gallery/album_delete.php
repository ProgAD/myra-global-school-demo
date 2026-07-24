<?php
/* POST actions/admin/gallery/album_delete.php  Body: { ids:[..] } | { id }
   Hard delete: removes the album rows (media rows cascade) and each
   album's folder from disk. */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in  = read_input();
$ids = clean_ids($in['ids'] ?? ($in['id'] ?? []));

if (!$ids) {
    json_out(['success' => false, 'message' => 'No albums selected.'], 400);
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $conn->prepare("DELETE FROM albums WHERE id IN ($placeholders)");
$stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
$stmt->execute();
$deleted = $stmt->affected_rows;
$stmt->close();

// remove folders from disk
foreach ($ids as $id) {
    rrmdir(album_dir($id));
}

json_out(['success' => true, 'deleted' => $deleted]);
