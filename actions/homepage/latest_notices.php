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

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'        => (int)$r['id'],
        'title'     => $r['title'],
        'content'   => $r['content'],
        'category'  => $r['category'],
        'date'      => fmt_date($r['created_at']),
        'documents' => json_arr($r['documents']),
        'links'     => json_arr($r['links']),
    ];
}
$stmt->close();

json_out(['success' => true, 'total' => count($rows), 'rows' => $rows]);
