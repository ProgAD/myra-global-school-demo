<?php
/* ============================================================
   GET actions/homepage/latest_notices.php
   Returns the latest published notices for the homepage
   "Official Announcements" strip. Default limit = 3.
   ============================================================ */
require __DIR__ . '/../_public_boot.php';

$limit = (int)($_GET['limit'] ?? 3);
if ($limit < 1)  { $limit = 3; }
if ($limit > 12) { $limit = 12; }

$stmt = $conn->prepare(
    "SELECT id, title, content, category, links, documents, created_at
     FROM notices
     WHERE status = 'published'
     ORDER BY created_at DESC, id DESC
     LIMIT ?"
);
$stmt->bind_param('i', $limit);
$stmt->execute();
$res = $stmt->get_result();

function json_arr($raw) {
    if (!$raw) return [];
    $v = json_decode($raw, true);
    return is_array($v) ? array_values(array_filter($v, 'is_array')) : [];
}

/* Documents stored as {name,file}; homepage lives at the site root. */
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
        'date'      => fmt_date($r['created_at']),
        'documents' => pub_docs($r['documents']),
        'links'     => json_arr($r['links']),
    ];
}
$stmt->close();

json_out(['success' => true, 'total' => count($rows), 'rows' => $rows]);
