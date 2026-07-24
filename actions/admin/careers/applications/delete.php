<?php
/* POST actions/admin/careers/applications/delete.php  Body: { ids:[..] }
   HARD delete — vacancy_apply.status has no 'deleted' value. */
require __DIR__ . '/../_common.php';
require_admin();
require_post();

$in  = read_input();
$ids = clean_ids($in['ids'] ?? ($in['id'] ?? []));

if (!$ids) {
    json_out(['success' => false, 'message' => 'No records selected.'], 400);
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $conn->prepare("DELETE FROM vacancy_apply WHERE id IN ($placeholders)");
$stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
$stmt->execute();
$deleted = $stmt->affected_rows;
$stmt->close();

json_out(['success' => true, 'deleted' => $deleted]);
