<?php
/* GET actions/admin/careers/applications/list.php
   Params: status=all|new|reviewed|shortlisted|rejected, q, page, per_page */
require __DIR__ . '/../_common.php';
require_admin();

$status = $_GET['status'] ?? 'all';
$q      = trim($_GET['q'] ?? '');
list($per, $page, $showAll) = paging_params(10);

$whereSql = app_where($status, $q, $types, $params);
$from     = "FROM vacancy_apply a LEFT JOIN vacancies v ON v.id = a.vacancy_id";

$stmt = $conn->prepare("SELECT COUNT(*) $from $whereSql");
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$total = (int)($stmt->get_result()->fetch_row()[0] ?? 0);
$stmt->close();

$pages = $showAll ? 1 : max(1, (int)ceil($total / $per));
if (!$showAll && $page > $pages) { $page = $pages; }
$offset = $showAll ? 0 : ($page - 1) * $per;

$sql = "SELECT a.id, a.name, a.email, a.phone, a.experience, a.resume, a.additional_info,
               a.status, a.applied_on, a.vacancy_id, v.role_title
        $from $whereSql
        ORDER BY a.applied_on DESC, a.id DESC";
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
        'id'         => (int)$r['id'],
        'name'       => $r['name'],
        'email'      => $r['email'],
        'phone'      => $r['phone'],
        'experience' => $r['experience'] ?: '—',
        'position'   => $r['role_title'] ?: '(vacancy removed)',
        'vacancy_id' => (int)$r['vacancy_id'],
        'resume'     => $r['resume'],
        'note'       => $r['additional_info'],
        'status'     => $r['status'],
        'applied'    => fmt_date($r['applied_on']),
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
