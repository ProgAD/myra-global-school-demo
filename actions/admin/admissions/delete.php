<?php
/* ============================================================
   POST actions/admissions/delete.php
   Body: { ids: [1,2,3] }  (a single id is also accepted)

   NOTE: this is a SOFT delete — the schema's status enum has a
   'deleted' value, so rows are flagged rather than destroyed and
   simply stop appearing in list.php / export.php.
   ============================================================ */
require __DIR__ . '/_common.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_out(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$in  = read_input();
$ids = $in['ids'] ?? ($in['id'] ?? []);
if (!is_array($ids)) { $ids = [$ids]; }

$ids = array_values(array_unique(array_filter(array_map('intval', $ids), function ($v) { return $v > 0; })));

if (!$ids) {
    json_out(['success' => false, 'message' => 'No records selected.'], 400);
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types        = str_repeat('i', count($ids));

$stmt = $conn->prepare("UPDATE admission_applications SET status = 'deleted' WHERE id IN ($placeholders) AND status <> 'deleted'");
$stmt->bind_param($types, ...$ids);
$stmt->execute();
$deleted = $stmt->affected_rows;
$stmt->close();

json_out(['success' => true, 'deleted' => $deleted]);
