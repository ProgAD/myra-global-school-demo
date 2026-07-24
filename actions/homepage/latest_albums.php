<?php
/* ============================================================
   GET actions/homepage/latest_albums.php
   Returns the latest albums for the homepage "Life at Myra"
   collage. Default limit = 4.
   ============================================================ */
require __DIR__ . '/../_public_boot.php';

$limit = (int)($_GET['limit'] ?? 4);
if ($limit < 1) { $limit = 4; }
if ($limit > 8) { $limit = 8; }

$stmt = $conn->prepare(
    "SELECT a.id, a.title, a.cover,
            (SELECT COUNT(*) FROM album_medias m WHERE m.album_id = a.id) AS media_count
     FROM albums a
     ORDER BY a.created_at DESC, a.id DESC
     LIMIT ?"
);
$stmt->bind_param('i', $limit);
$stmt->execute();
$res = $stmt->get_result();

$rows = [];
while ($r = $res->fetch_assoc()) {
    $rows[] = [
        'id'        => (int)$r['id'],
        'title'     => $r['title'],
        'count'     => (int)$r['media_count'],
        'cover_url' => ($r['cover'] !== null && $r['cover'] !== '') ? 'assets/gallery/' . $r['cover'] : '',
    ];
}
$stmt->close();

json_out(['success' => true, 'total' => count($rows), 'rows' => $rows]);
