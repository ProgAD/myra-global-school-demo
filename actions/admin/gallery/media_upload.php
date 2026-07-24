<?php
/* POST actions/admin/gallery/media_upload.php   (multipart/form-data)
   Fields: album_id, media[]  (one or more image files)

   Per file: INSERT album_medias(album_id, photo '') -> mediaId ->
   move to assets/gallery/album-<albumId>/<albumId>-<mediaId>.<ext> ->
   UPDATE photo. The first image ever added to an album becomes its cover.
*/
require __DIR__ . '/_common.php';
require_admin();
require_post();

$albumId = (int)($_POST['album_id'] ?? 0);
if ($albumId <= 0) {
    json_out(['success' => false, 'message' => 'Invalid album.'], 400);
}

/* album must exist; grab current cover */
$stmt = $conn->prepare("SELECT cover FROM albums WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $albumId);
$stmt->execute();
$album = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$album) {
    json_out(['success' => false, 'message' => 'Album not found.'], 404);
}
$cover = $album['cover'];

/* normalise $_FILES['media'] (array) into a simple list */
$files = [];
if (isset($_FILES['media']) && is_array($_FILES['media']['name'])) {
    foreach ($_FILES['media']['name'] as $i => $nm) {
        $files[] = [
            'name'  => $nm,
            'type'  => $_FILES['media']['type'][$i] ?? '',
            'tmp'   => $_FILES['media']['tmp_name'][$i] ?? '',
            'error' => $_FILES['media']['error'][$i] ?? UPLOAD_ERR_NO_FILE,
            'size'  => $_FILES['media']['size'][$i] ?? 0,
        ];
    }
} elseif (isset($_FILES['media'])) {
    $files[] = [
        'name'  => $_FILES['media']['name'],
        'type'  => $_FILES['media']['type'],
        'tmp'   => $_FILES['media']['tmp_name'],
        'error' => $_FILES['media']['error'],
        'size'  => $_FILES['media']['size'],
    ];
}

if (!$files) {
    json_out(['success' => false, 'message' => 'No files were uploaded.'], 400);
}

$dir = ensure_album_dir($albumId);
if (!$dir) {
    json_out(['success' => false, 'message' => 'Album folder is not writable on the server.'], 500);
}

$added  = [];
$errors = [];

foreach ($files as $f) {
    if ($f['error'] === UPLOAD_ERR_NO_FILE) continue;
    if ($f['error'] !== UPLOAD_ERR_OK) { $errors[] = $f['name'] . ': upload error ' . $f['error']; continue; }
    if ($f['size'] > GALLERY_MAX_BYTES) { $errors[] = $f['name'] . ': larger than 8 MB'; continue; }

    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, GALLERY_IMG_EXT, true)) { $errors[] = $f['name'] . ': not an image'; continue; }
    if (!is_uploaded_file($f['tmp'])) { $errors[] = $f['name'] . ': invalid upload'; continue; }

    // 1) insert placeholder row to obtain the media id
    $empty = '';
    $ins = $conn->prepare("INSERT INTO album_medias (album_id, photo) VALUES (?, ?)");
    $ins->bind_param('is', $albumId, $empty);
    $ins->execute();
    $mediaId = (int)$ins->insert_id;
    $ins->close();

    if ($mediaId <= 0) { $errors[] = $f['name'] . ': could not be saved'; continue; }

    // 2) move + rename
    $rel    = 'album-' . $albumId . '/' . $albumId . '-' . $mediaId . '.' . $ext;
    $target = gallery_root() . $rel;
    if (!@move_uploaded_file($f['tmp'], $target)) {
        $del = $conn->prepare("DELETE FROM album_medias WHERE id = ?");
        $del->bind_param('i', $mediaId);
        $del->execute();
        $del->close();
        $errors[] = $f['name'] . ': could not be stored';
        continue;
    }
    @chmod($target, 0644);

    // 3) store the path
    $upd = $conn->prepare("UPDATE album_medias SET photo = ? WHERE id = ?");
    $upd->bind_param('si', $rel, $mediaId);
    $upd->execute();
    $upd->close();

    // first ever image becomes the cover
    if ($cover === '') {
        $cv = $conn->prepare("UPDATE albums SET cover = ? WHERE id = ?");
        $cv->bind_param('si', $rel, $albumId);
        $cv->execute();
        $cv->close();
        $cover = $rel;
    }

    $added[] = ['id' => $mediaId, 'photo' => $rel, 'url' => '../assets/gallery/' . $rel, 'is_cover' => ($rel === $cover)];
}

if (!$added && $errors) {
    json_out(['success' => false, 'message' => 'No files could be uploaded. ' . implode('; ', $errors)], 422);
}

json_out(['success' => true, 'added' => $added, 'cover' => $cover, 'skipped' => $errors]);
