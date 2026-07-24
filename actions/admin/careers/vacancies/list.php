<?php
/* GET actions/admin/careers/vacancies/list.php
   Params: status=all|open|paused|closed, q, page, per_page */
require __DIR__ . '/../_common.php';
require_admin();

$status = $_GET['status'] ?? 'all';
$q      = trim($_GET['q'] ?? '');
list($per, $page, $showAll) = paging_params(10);

$whereSql = vac_where($status, $q, $types, $params);

$stmt = $conn->prepare("SELECT COUNT(*) FROM vacancies $whereSql");
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$total = (int)($stmt->get_result()->fetch_row()[0] ?? 0);
$stmt->close();

$pages = $showAll ? 1 : max(1, (int)ceil($total / $per));
if (!$showAll && $page > $pages) { $page = $pages; }
$offset = $showAll ? 0 : ($page - 1) * $per;

$sql = "SELECT id, role_title, role_description, department, type, openings, deadline, status, created_at
        FROM vacancies $whereSql
        ORDER BY created_at DESC, id DESC";
if (!$showAll) { $sql .= ' LIMIT ? OFFSET ?'; }

$stmt = $conn->prepare($sql);
if (!$showAll) {
    $stmt->bind_param($types . 'ii', ...array_merge($params, [$per, $offset]));
} elseif ($types !== '') {
    $stmt->bind_param($types, ...$params);
}
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
        'deadline'    => fmt_date($r['deadline']),
        'deadline_iso'=> $r['deadline'],
        'status'      => $r['status'],
        'posted'      => fmt_date($r['created_at']),
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
