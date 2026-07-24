<?php
/* POST actions/admin/enquiries/update_status.php  Body: { id, status } */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in     = read_input();
$id     = (int)($in['id'] ?? 0);
$status = trim($in['status'] ?? '');

if ($id <= 0 || !in_array($status, ENQ_STATUSES, true)) {
    json_out(['success' => false, 'message' => 'Invalid id or status.'], 400);
}

// marking replied stamps the time; reverting to pending clears it
if ($status === 'replied') {
    $stmt = $conn->prepare("UPDATE enquiries SET status = ?, replied_at = IFNULL(replied_at, NOW()) WHERE id = ?");
} else {
    $stmt = $conn->prepare("UPDATE enquiries SET status = ?, replied_at = NULL WHERE id = ?");
}
$stmt->bind_param('si', $status, $id);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'id' => $id, 'status' => $status]);
