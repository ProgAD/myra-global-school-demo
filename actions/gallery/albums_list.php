<?php
/* GET actions/gallery/albums_list.php  (public)
   All albums with media counts, for the public gallery page. */
require __DIR__ . '/../_public_boot.php';

$sql = "SELECT a.id, a.title, a.description, a.cover, a.created_at,
               (SELECT COUNT(*) FROM album_medias m WHERE m.album_id = a.id) AS media_count
        FROM albums a
        ORDER BY a.created_at DESC, a.id DESC";
$res = $conn->query($sql);

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'          => (int)$r['id'],
        'title'       => $r['title'],
        'description' => $r['description'],
        'count'       => (int)$r['media_count'],
        'date'        => $r['created_at'] ? date('F Y', strtotime($r['created_at'])) : '',
        'cover_url'   => $r['cover'] !== '' ? 'assets/gallery/' . $r['cover'] : '',
    ];
}

json_out(['success' => true, 'total' => count($rows), 'rows' => $rows]);
