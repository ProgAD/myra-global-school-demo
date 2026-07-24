<?php
/* POST actions/admin/careers/applications/update_status.php  Body: { id, status } */
require __DIR__ . '/../_common.php';
require_admin();
require_post();

$in     = read_input();
$id     = (int)($in['id'] ?? 0);
$status = trim($in['status'] ?? '');

if ($id <= 0 || !in_array($status, APP_STATUSES, true)) {
    json_out(['success' => false, 'message' => 'Invalid id or status.'], 400);
}

$stmt = $conn->prepare("UPDATE vacancy_apply SET status = ? WHERE id = ?");
$stmt->bind_param('si', $status, $id);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'id' => $id, 'status' => $status]);
