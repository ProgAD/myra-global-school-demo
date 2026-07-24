<?php
/* POST actions/admin/notices/update_status.php  Body: { id, status } */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in     = read_input();
$id     = (int)($in['id'] ?? 0);
$status = trim($in['status'] ?? '');

if ($id <= 0 || !in_array($status, NOTICE_STATUSES, true)) {
    json_out(['success' => false, 'message' => 'Invalid id or status.'], 400);
}

$stmt = $conn->prepare("UPDATE notices SET status = ? WHERE id = ? AND status <> 'deleted'");
$stmt->bind_param('si', $status, $id);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'id' => $id, 'status' => $status]);
