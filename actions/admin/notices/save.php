<?php
/* POST actions/admin/notices/save.php   (multipart/form-data)

   Fields:
     id?         omit / 0 to create
     title, content, category, status
     links       JSON string: [{title,url}, ...]      (max 5)
     keep_docs   JSON string: ["<id>/<file>", ...]    documents to keep (edit)
     documents[] uploaded files (image/pdf)           (max 5 total with kept)

   On edit, documents removed from keep_docs are deleted from disk; new
   uploads are added. Stored JSON entry: {name, file} (file rel to assets/notices/).
*/
require __DIR__ . '/_common.php';
require_admin();
require_post();

$id       = (int)($_POST['id'] ?? 0);
$title    = trim($_POST['title'] ?? '');
$content  = trim($_POST['content'] ?? '');
$category = trim($_POST['category'] ?? 'announcement');
$status   = trim($_POST['status'] ?? 'published');

if ($title === '')                                   json_out(['success' => false, 'message' => 'Title is required.'], 400);
if (!in_array($category, NOTICE_CATEGORIES, true))   json_out(['success' => false, 'message' => 'Invalid category.'], 400);
if (!in_array($status, NOTICE_STATUSES, true))       json_out(['success' => false, 'message' => 'Invalid status.'], 400);

/* links */
$linksIn = json_decode($_POST['links'] ?? '[]', true);
$links   = clean_pairs(is_array($linksIn) ? $linksIn : [], 'title', 'url');
if (count($links) > NOTICE_MAX_LINKS) {
    json_out(['success' => false, 'message' => 'A maximum of ' . NOTICE_MAX_LINKS . ' links is allowed.'], 422);
}

/* which existing docs to keep */
$keepIn = json_decode($_POST['keep_docs'] ?? '[]', true);
$keep   = is_array($keepIn) ? array_values(array_filter(array_map('strval', $keepIn), 'strlen')) : [];

/* normalise uploaded files */
$files = [];
if (isset($_FILES['documents']) && is_array($_FILES['documents']['name'])) {
    foreach ($_FILES['documents']['name'] as $i => $nm) {
        if (($_FILES['documents']['error'][$i] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) continue;
        $files[] = [
            'name'  => $nm,
            'tmp'   => $_FILES['documents']['tmp_name'][$i] ?? '',
            'error' => $_FILES['documents']['error'][$i] ?? UPLOAD_ERR_NO_FILE,
            'size'  => $_FILES['documents']['size'][$i] ?? 0,
        ];
    }
} elseif (isset($_FILES['documents']) && ($_FILES['documents']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
    $files[] = [
        'name'  => $_FILES['documents']['name'],
        'tmp'   => $_FILES['documents']['tmp_name'],
        'error' => $_FILES['documents']['error'],
        'size'  => $_FILES['documents']['size'],
    ];
}

/* existing documents (edit) */
$existing = [];
if ($id > 0) {
    $stmt = $conn->prepare("SELECT documents FROM notices WHERE id = ? AND status <> 'deleted' LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$row) json_out(['success' => false, 'message' => 'Notice not found.'], 404);
    $existing = json_list($row['documents']);
}

/* split existing into kept vs removed */
$keptEntries  = [];
$removedFiles = [];
foreach ($existing as $d) {
    $file = $d['file'] ?? '';
    if ($file !== '' && in_array($file, $keep, true)) {
        $keptEntries[] = ['name' => $d['name'] ?? '', 'file' => $file];
    } elseif ($file !== '') {
        $removedFiles[] = $file;
    }
}

/* count + per-file validation */
if (count($keptEntries) + count($files) > NOTICE_MAX_DOCS) {
    json_out(['success' => false, 'message' => 'A maximum of ' . NOTICE_MAX_DOCS . ' documents is allowed.'], 422);
}
foreach ($files as $f) {
    if ($f['error'] !== UPLOAD_ERR_OK) json_out(['success' => false, 'message' => $f['name'] . ': upload error ' . $f['error'] . '.'], 422);
    if ($f['size'] > NOTICE_DOC_MAX_BYTES) json_out(['success' => false, 'message' => $f['name'] . ' is larger than 5 MB.'], 422);
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, NOTICE_DOC_EXT, true)) json_out(['success' => false, 'message' => $f['name'] . ': only image or PDF files are allowed.'], 422);
    if (!is_uploaded_file($f['tmp'])) json_out(['success' => false, 'message' => $f['name'] . ': invalid upload.'], 422);
}

/* ---- persist base fields ---- */
$linksJson = json_encode($links);
if ($id > 0) {
    $stmt = $conn->prepare(
        "UPDATE notices SET title = ?, content = ?, category = ?, links = ?, status = ?
         WHERE id = ? AND status <> 'deleted'"
    );
    $stmt->bind_param('sssssi', $title, $content, $category, $linksJson, $status, $id);
    $stmt->execute();
    $stmt->close();
} else {
    $emptyDocs = '[]';
    $stmt = $conn->prepare(
        "INSERT INTO notices (title, content, category, links, documents, status)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param('ssssss', $title, $content, $category, $linksJson, $emptyDocs, $status);
    $stmt->execute();
    $id = (int)$stmt->insert_id;
    $stmt->close();
    if ($id <= 0) json_out(['success' => false, 'message' => 'Could not create the notice.'], 500);
}

/* ---- folder ---- */
$dir = ensure_notice_dir($id);
if (!$dir) json_out(['success' => false, 'message' => 'Document folder is not writable on the server.'], 500);

/* delete removed files */
foreach ($removedFiles as $rf) { @unlink(notices_root() . $rf); }

/* move new files */
$newEntries = [];
foreach ($files as $f) {
    $ext  = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    $stored = bin2hex(random_bytes(4)) . '-' . sanitize_base($f['name']) . '.' . $ext;
    $rel  = $id . '/' . $stored;
    if (@move_uploaded_file($f['tmp'], notices_root() . $rel)) {
        @chmod(notices_root() . $rel, 0644);
        $newEntries[] = ['name' => $f['name'], 'file' => $rel];
    }
}

/* ---- store final documents ---- */
$finalDocs = json_encode(array_merge($keptEntries, $newEntries));
$stmt = $conn->prepare("UPDATE notices SET documents = ? WHERE id = ?");
$stmt->bind_param('si', $finalDocs, $id);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'id' => $id]);
