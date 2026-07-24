<?php
/* POST actions/admin/enquiries/reply.php  Body: { id, reply }
   Stores the reply, marks the enquiry replied and stamps replied_at. */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in    = read_input();
$id    = (int)($in['id'] ?? 0);
$reply = trim($in['reply'] ?? '');

if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Invalid enquiry.'], 400);
}
if ($reply === '') {
    json_out(['success' => false, 'message' => 'Please type a reply before sending.'], 400);
}

$stmt = $conn->prepare("UPDATE enquiries SET reply = ?, status = 'replied', replied_at = NOW() WHERE id = ?");
$stmt->bind_param('si', $reply, $id);
$stmt->execute();
$changed = $stmt->affected_rows;
$stmt->close();

if ($changed === 0) {
    json_out(['success' => false, 'message' => 'Enquiry not found.'], 404);
}

json_out(['success' => true, 'id' => $id, 'status' => 'replied']);
