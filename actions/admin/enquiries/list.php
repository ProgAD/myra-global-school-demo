<?php
/* GET actions/admin/enquiries/list.php
   Params: status=all|pending|replied, q, page, per_page */
require __DIR__ . '/_common.php';
require_admin();

$status = $_GET['status'] ?? 'all';
$q      = trim($_GET['q'] ?? '');
list($per, $page, $showAll) = paging_params(10);

$whereSql = enq_where($status, $q, $types, $params);

$stmt = $conn->prepare("SELECT COUNT(*) FROM enquiries $whereSql");
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$total = (int)($stmt->get_result()->fetch_row()[0] ?? 0);
$stmt->close();

$pages = $showAll ? 1 : max(1, (int)ceil($total / $per));
if (!$showAll && $page > $pages) { $page = $pages; }
$offset = $showAll ? 0 : ($page - 1) * $per;

$sql = "SELECT id, name, email, phone, message, status, reply, created_at, replied_at
        FROM enquiries $whereSql
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
        'id'       => (int)$r['id'],
        'name'     => $r['name'],
        'email'    => $r['email'],
        'phone'    => $r['phone'],
        'message'  => $r['message'],
        'status'   => $r['status'],
        'reply'    => $r['reply'],
        'received' => human_time($r['created_at']),
        'date'     => fmt_date($r['created_at']),
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
