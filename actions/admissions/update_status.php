<?php
/* ============================================================
   POST actions/admissions/update_status.php
   Body: { id, status }   status = received|verified|completed
   ============================================================ */
require __DIR__ . '/_common.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_out(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$in     = read_input();
$id     = (int)($in['id'] ?? 0);
$status = trim($in['status'] ?? '');

if ($id <= 0 || !in_array($status, ADM_STATUSES, true)) {
    json_out(['success' => false, 'message' => 'Invalid id or status.'], 400);
}

// Moving back to "received" clears the verification timestamp;
// verified/completed stamp it once.
if ($status === 'received') {
    $stmt = $conn->prepare("UPDATE admission_applications SET status = ?, verified_at = NULL WHERE id = ? AND status <> 'deleted'");
} else {
    $stmt = $conn->prepare("UPDATE admission_applications SET status = ?, verified_at = IFNULL(verified_at, NOW()) WHERE id = ? AND status <> 'deleted'");
}
$stmt->bind_param('si', $status, $id);
$stmt->execute();
$changed = $stmt->affected_rows;
$stmt->close();

if ($changed === 0) {
    // either the row is gone/deleted, or the value was already the same
    $chk = $conn->prepare("SELECT COUNT(*) FROM admission_applications WHERE id = ? AND status <> 'deleted'");
    $chk->bind_param('i', $id);
    $chk->execute();
    $exists = (int)($chk->get_result()->fetch_row()[0] ?? 0);
    $chk->close();
    if (!$exists) {
        json_out(['success' => false, 'message' => 'Application not found.'], 404);
    }
}

json_out(['success' => true, 'id' => $id, 'status' => $status]);
