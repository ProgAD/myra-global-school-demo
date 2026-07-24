<?php
/* ============================================================
   GET actions/notices/list.php
   Public list of PUBLISHED notices.
   Params:
     range = week | month | year   (default 'week' -> this week)
     q     = optional search text
   ============================================================ */
require __DIR__ . '/../_public_boot.php';

$range = $_GET['range'] ?? 'week';
if (!in_array($range, ['week', 'month', 'year'], true)) { $range = 'week'; }
$q = trim($_GET['q'] ?? '');

$where  = ["status = 'published'", range_since($range)];
$types  = '';
$params = [];

if ($q !== '') {
    $like = '%' . $q . '%';
    $where[] = '(title LIKE ? OR content LIKE ? OR category LIKE ?)';
    $types  .= 'sss';
    array_push($params, $like, $like, $like);
}

$sql = "SELECT id, title, content, category, links, documents, created_at
        FROM notices
        WHERE " . implode(' AND ', $where) . "
        ORDER BY created_at DESC, id DESC";

$stmt = $conn->prepare($sql);
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$res = $stmt->get_result();

function json_arr($raw) {
    if (!$raw) return [];
    $v = json_decode($raw, true);
    return is_array($v) ? array_values(array_filter($v, 'is_array')) : [];
}

/* Documents are stored as {name, file}; build a public URL from the file
   (relative to the site root, since notice.php lives at the root). */
function pub_docs($raw) {
    $out = [];
    foreach (json_arr($raw) as $d) {
        $name = $d['name'] ?? '';
        $file = $d['file'] ?? '';
        $url  = ($file !== '') ? 'assets/notices/' . $file : ($d['url'] ?? '');
        if ($name === '' && $url === '') continue;
        $out[] = ['name' => $name, 'url' => $url];
    }
    return $out;
}

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'        => (int)$r['id'],
        'title'     => $r['title'],
        'content'   => $r['content'],
        'category'  => $r['category'],
        'documents' => pub_docs($r['documents']),
        'links'     => json_arr($r['links']),
        'date'      => fmt_date($r['created_at']),
    ];
}
$stmt->close();

json_out(['success' => true, 'range' => $range, 'total' => count($rows), 'rows' => $rows]);
