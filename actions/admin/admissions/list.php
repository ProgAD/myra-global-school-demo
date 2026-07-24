<?php
/* ============================================================
   GET actions/admissions/list.php
   Params: status=all|received|verified|completed, q, page, per_page(int|'all')
   Returns: { success, rows[], total, page, pages, per_page }
   ============================================================ */
require __DIR__ . '/_common.php';
require_admin();

$status = $_GET['status']   ?? 'all';
$q      = trim($_GET['q']   ?? '');
$page   = max(1, (int)($_GET['page'] ?? 1));
$perRaw = $_GET['per_page'] ?? '10';

$showAll = ($perRaw === 'all');
$per     = $showAll ? 0 : max(1, min(200, (int)$perRaw));

$whereSql = adm_where($status, $q, $types, $params);

/* ---- total ---- */
$stmt = $conn->prepare("SELECT COUNT(*) FROM admission_applications $whereSql");
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$total = (int)($stmt->get_result()->fetch_row()[0] ?? 0);
$stmt->close();

$pages = $showAll ? 1 : max(1, (int)ceil($total / $per));
if (!$showAll && $page > $pages) { $page = $pages; }
$offset = $showAll ? 0 : ($page - 1) * $per;

/* ---- rows ---- */
$sql = "SELECT id, student_name, apply_class, phone, email, status, created_at
        FROM admission_applications
        $whereSql
        ORDER BY created_at DESC, id DESC";
if (!$showAll) { $sql .= " LIMIT ? OFFSET ?"; }

$stmt = $conn->prepare($sql);
if (!$showAll) {
    $bindTypes  = $types . 'ii';
    $bindParams = array_merge($params, [$per, $offset]);
    $stmt->bind_param($bindTypes, ...$bindParams);
} elseif ($types !== '') {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$res  = $stmt->get_result();

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'           => (int)$r['id'],
        'app_no'       => app_no($r['id']),
        'student_name' => $r['student_name'],
        'apply_class'  => class_label($r['apply_class']),
        'phone'        => $r['phone'],
        'email'        => $r['email'],
        'status'       => $r['status'],
        'applied_on'   => $r['created_at'] ? date('d M Y', strtotime($r['created_at'])) : '',
    ];
}
$stmt->close();

json_out([
    'success'  => true,
    'rows'     => $rows,
    'total'    => $total,
    'page'     => $page,
    'pages'    => $pages,
    'per_page' => $showAll ? 'all' : $per,
]);
