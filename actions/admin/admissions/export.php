<?php
/* ============================================================
   GET actions/admissions/export.php
   Params: status, q  -> exports every row matching the filter
           ids=1,2,3  -> exports just those rows (overrides filter)
   Streams a CSV download.
   ============================================================ */
require __DIR__ . '/_common.php';
require_admin();

$status  = $_GET['status'] ?? 'all';
$q       = trim($_GET['q'] ?? '');
$idsRaw  = trim($_GET['ids'] ?? '');

if ($idsRaw !== '') {
    $ids = array_values(array_filter(array_map('intval', explode(',', $idsRaw)), function ($v) { return $v > 0; }));
}

if (!empty($ids)) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $whereSql = "WHERE status <> 'deleted' AND id IN ($placeholders)";
    $types    = str_repeat('i', count($ids));
    $params   = $ids;
    $tag      = 'selected';
} else {
    $whereSql = adm_where($status, $q, $types, $params);
    $tag      = ($status === 'all' || !in_array($status, ADM_STATUSES, true)) ? 'all' : $status;
}

$sql = "SELECT id, student_name, apply_class, phone, email, status, created_at
        FROM admission_applications
        $whereSql
        ORDER BY created_at DESC, id DESC";

$stmt = $conn->prepare($sql);
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$res = $stmt->get_result();

$labels = ['received' => 'Received', 'verified' => 'Verified', 'completed' => 'Completed'];

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="admissions_' . $tag . '_' . date('Ymd_His') . '.csv"');
header('Pragma: no-cache');

echo "\xEF\xBB\xBF"; // UTF-8 BOM so Excel opens it correctly
$out = fopen('php://output', 'w');
fputcsv($out, ['S.No', 'Applicant Name', 'Application No', 'Class', 'Phone', 'Email', 'Applied On', 'Status']);

$i = 0;
while ($r = $res->fetch_assoc()) {
    $i++;
    fputcsv($out, [
        $i,
        $r['student_name'],
        app_no($r['id']),
        class_label($r['apply_class']),
        $r['phone'],
        $r['email'],
        $r['created_at'] ? date('d M Y', strtotime($r['created_at'])) : '',
        $labels[$r['status']] ?? $r['status'],
    ]);
}
fclose($out);
$stmt->close();
