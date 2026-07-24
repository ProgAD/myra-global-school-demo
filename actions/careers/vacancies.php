<?php
/* ============================================================
   GET actions/careers/vacancies.php
   Public list of OPEN vacancies (for the careers page).
   Params:
     dept = all | academic-faculty | administration | support-staff | other
   ============================================================ */
require __DIR__ . '/../_public_boot.php';

const DEPT_LABELS = [
    'academic-faculty' => 'Academic Faculty',
    'administration'   => 'Administration',
    'support-staff'    => 'Support Staff',
    'other'            => 'Other',
];
const TYPE_LABELS = [
    'full-time'  => 'Full-time', 'part-time' => 'Part-time', 'contract' => 'Contract',
    'internship' => 'Internship', 'temporary' => 'Temporary', 'freelance' => 'Freelance',
];

$dept = $_GET['dept'] ?? 'all';

$where  = ["status = 'open'"];
$types  = '';
$params = [];

if (array_key_exists($dept, DEPT_LABELS)) {
    $where[]  = 'department = ?';
    $types   .= 's';
    $params[] = $dept;
}

$sql = "SELECT id, role_title, role_description, department, type, openings, deadline, created_at
        FROM vacancies
        WHERE " . implode(' AND ', $where) . "
        ORDER BY created_at DESC, id DESC";

$stmt = $conn->prepare($sql);
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$res = $stmt->get_result();

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'          => (int)$r['id'],
        'title'       => $r['role_title'],
        'description' => $r['role_description'],
        'department'  => $r['department'],
        'dept_label'  => DEPT_LABELS[$r['department']] ?? $r['department'],
        'type'        => $r['type'],
        'type_label'  => TYPE_LABELS[$r['type']] ?? $r['type'],
        'openings'    => (int)$r['openings'],
        'deadline'    => $r['deadline'] ? date('d M Y', strtotime($r['deadline'])) : '',
    ];
}
$stmt->close();

json_out(['success' => true, 'dept' => $dept, 'total' => count($rows), 'rows' => $rows]);
