<?php
/* GET actions/admin/gallery/albums_list.php  -> all albums with media counts */
require __DIR__ . '/_common.php';
require_admin();

$q = trim($_GET['q'] ?? '');
$where = '';
$types = ''; $params = [];
if ($q !== '') {
    $where = "WHERE (a.title LIKE ? OR a.description LIKE ?)";
    $like = '%' . $q . '%';
    $types = 'ss'; $params = [$like, $like];
}

$sql = "SELECT a.id, a.title, a.description, a.cover, a.created_at,
               (SELECT COUNT(*) FROM album_medias m WHERE m.album_id = a.id) AS media_count
        FROM albums a
        $where
        ORDER BY a.created_at DESC, a.id DESC";

$stmt = $conn->prepare($sql);
if ($types !== '') { $stmt->bind_param($types, ...$params); }
$stmt->execute();
$res = $stmt->get_result();

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'          => (int)$r['id'],
        'title'       => $r['title'],
        'description' => $r['description'],
        'cover'       => $r['cover'],
        'cover_url'   => $r['cover'] !== '' ? '../assets/gallery/' . $r['cover'] : '',
        'count'       => (int)$r['media_count'],
        'date'        => month_year($r['created_at']),
    ];
}
$stmt->close();

json_out(['success' => true, 'total' => count($rows), 'rows' => $rows]);
