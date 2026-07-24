<?php
/* POST actions/admin/notices/save.php
   Body: { id?, title, content, category, status, documents:[{name,url}], links:[{title,url}] }
   Omit / zero id to create. */
require __DIR__ . '/_common.php';
require_admin();
require_post();

$in       = read_input();
$id       = (int)($in['id'] ?? 0);
$title    = trim($in['title'] ?? '');
$content  = trim($in['content'] ?? '');
$category = trim($in['category'] ?? 'announcement');
$status   = trim($in['status'] ?? 'published');

if ($title === '') {
    json_out(['success' => false, 'message' => 'Title is required.'], 400);
}
if (!in_array($category, NOTICE_CATEGORIES, true)) {
    json_out(['success' => false, 'message' => 'Invalid category.'], 400);
}
if (!in_array($status, NOTICE_STATUSES, true)) {
    json_out(['success' => false, 'message' => 'Invalid status.'], 400);
}

$documents = json_encode(clean_pairs($in['documents'] ?? [], 'name', 'url'));
$links     = json_encode(clean_pairs($in['links'] ?? [], 'title', 'url'));

if ($id > 0) {
    $stmt = $conn->prepare(
        "UPDATE notices SET title = ?, content = ?, category = ?, links = ?, documents = ?, status = ?
         WHERE id = ? AND status <> 'deleted'"
    );
    $stmt->bind_param('ssssssi', $title, $content, $category, $links, $documents, $status, $id);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt = $conn->prepare(
        "INSERT INTO notices (title, content, category, links, documents, status)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param('ssssss', $title, $content, $category, $links, $documents, $status);
    $stmt->execute();
    $id = (int)$stmt->insert_id;
    $stmt->close();
}

json_out(['success' => true, 'id' => $id]);
