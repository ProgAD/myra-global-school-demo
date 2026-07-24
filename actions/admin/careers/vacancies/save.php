<?php
/* POST actions/admin/careers/vacancies/save.php
   Body: { id?, title, description, department, type, openings, deadline(YYYY-MM-DD), status } */
require __DIR__ . '/../_common.php';
require_admin();
require_post();

$in       = read_input();
$id       = (int)($in['id'] ?? 0);
$title    = trim($in['title'] ?? '');
$desc     = trim($in['description'] ?? '');
$dept     = trim($in['department'] ?? '');
$type     = trim($in['type'] ?? '');
$openings = max(1, (int)($in['openings'] ?? 1));
$deadline = trim($in['deadline'] ?? '');
$status   = trim($in['status'] ?? 'open');

if ($title === '')                                  json_out(['success' => false, 'message' => 'Position title is required.'], 400);
if (!in_array($dept, VAC_DEPTS, true))              json_out(['success' => false, 'message' => 'Invalid department.'], 400);
if (!in_array($type, VAC_TYPES, true))              json_out(['success' => false, 'message' => 'Invalid employment type.'], 400);
if (!in_array($status, VAC_STATUSES, true))         json_out(['success' => false, 'message' => 'Invalid status.'], 400);
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $deadline)) json_out(['success' => false, 'message' => 'A valid last date to apply is required.'], 400);

if ($id > 0) {
    $stmt = $conn->prepare(
        "UPDATE vacancies
         SET role_title = ?, role_description = ?, department = ?, type = ?, openings = ?, deadline = ?, status = ?
         WHERE id = ? AND status <> 'deleted'"
    );
    $stmt->bind_param('ssssissi', $title, $desc, $dept, $type, $openings, $deadline, $status, $id);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt = $conn->prepare(
        "INSERT INTO vacancies (role_title, role_description, department, type, openings, deadline, status)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param('ssssiss', $title, $desc, $dept, $type, $openings, $deadline, $status);
    $stmt->execute();
    $id = (int)$stmt->insert_id;
    $stmt->close();
}

json_out(['success' => true, 'id' => $id]);
