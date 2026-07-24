<?php
/* POST actions/admin/enquiries/delete.php  Body: { ids:[..] }
   HARD delete — the enquiries.status enum has no 'deleted' value. */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in  = read_input();
$ids = clean_ids($in['ids'] ?? ($in['id'] ?? []));

if (!$ids) {
    json_out(['success' => false, 'message' => 'No records selected.'], 400);
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $conn->prepare("DELETE FROM enquiries WHERE id IN ($placeholders)");
$stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
$stmt->execute();
$deleted = $stmt->affected_rows;
$stmt->close();

json_out(['success' => true, 'deleted' => $deleted]);
