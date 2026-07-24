<?php
/* ============================================================
   POST actions/careers/apply.php   (multipart/form-data)
   Fields: name, email, phone, experience?, vacancy_id, resume(file), additional_info?

   Flow (mirrors admissions): validate -> INSERT (resume '') ->
   move file to assets/careers/resumes/<id>-Resume.<ext> -> UPDATE resume.
   Rolls back the row if the file cannot be saved.
   ============================================================ */
require __DIR__ . '/../_public_boot.php';
require_post();

const MAX_BYTES     = 10 * 1024 * 1024;                 // 10 MB
const RESUME_EXT    = ['pdf', 'doc', 'docx'];

function v($k) { return trim((string)($_POST[$k] ?? '')); }

$name       = v('name');
$email      = v('email');
$phone      = v('phone');
$experience = v('experience');
$vacancy_id = (int)($_POST['vacancy_id'] ?? 0);
$info       = v('additional_info');

$errors = [];
if ($name === '')                                             $errors['name'] = 'Your name is required.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'A valid email address is required.';
if ($phone === '' || strlen(preg_replace('/\D/', '', $phone)) < 10) $errors['phone'] = 'A valid phone number is required.';
if ($vacancy_id <= 0)                                         $errors['vacancy_id'] = 'Please choose a position to apply for.';
if (strlen($experience) > 50)                                $errors['experience'] = 'Experience must be 50 characters or fewer.';

/* resume file */
$plan = null;
$f = $_FILES['resume'] ?? null;
if (!$f || !isset($f['error']) || $f['error'] === UPLOAD_ERR_NO_FILE) {
    $errors['resume'] = 'Please attach your resume / CV.';
} elseif ($f['error'] !== UPLOAD_ERR_OK) {
    $errors['resume'] = 'Your resume could not be uploaded (error ' . $f['error'] . ').';
} elseif ($f['size'] > MAX_BYTES) {
    $errors['resume'] = 'Resume must be 10 MB or smaller.';
} else {
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, RESUME_EXT, true)) {
        $errors['resume'] = 'Resume must be a PDF, DOC or DOCX file.';
    } elseif (!is_uploaded_file($f['tmp_name'])) {
        $errors['resume'] = 'Resume upload failed. Please try again.';
    } else {
        $plan = ['tmp' => $f['tmp_name'], 'ext' => $ext];
    }
}

/* the vacancy must exist and still be open */
if (!isset($errors['vacancy_id'])) {
    $chk = $conn->prepare("SELECT id FROM vacancies WHERE id = ? AND status = 'open' LIMIT 1");
    $chk->bind_param('i', $vacancy_id);
    $chk->execute();
    if (!$chk->get_result()->fetch_row()) {
        $errors['vacancy_id'] = 'That position is no longer accepting applications.';
    }
    $chk->close();
}

if ($errors) {
    json_out(['success' => false, 'message' => 'Please correct the highlighted fields.', 'errors' => $errors], 422);
}

/* writable folder */
$dir = dirname(__DIR__, 2) . '/assets/careers/resumes/';
if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
    json_out(['success' => false, 'message' => 'Upload folder could not be created on the server.'], 500);
}
if (!is_writable($dir)) {
    json_out(['success' => false, 'message' => 'Upload folder is not writable on the server.'], 500);
}

/* 1) insert (resume filled after we know the id) */
$expVal  = $experience !== '' ? $experience : null;
$infoVal = $info !== '' ? $info : null;
$empty   = '';

$stmt = $conn->prepare(
    "INSERT INTO vacancy_apply (name, email, phone, experience, vacancy_id, resume, additional_info, status)
     VALUES (?, ?, ?, ?, ?, ?, ?, 'new')"
);
$stmt->bind_param('ssssiss', $name, $email, $phone, $expVal, $vacancy_id, $empty, $infoVal);
$stmt->execute();
$id = (int)$stmt->insert_id;
$stmt->close();

if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Could not save your application. Please try again.'], 500);
}

/* 2) move + rename the resume */
$fileName = $id . '-Resume.' . $plan['ext'];
$target   = $dir . $fileName;
if (!@move_uploaded_file($plan['tmp'], $target)) {
    $del = $conn->prepare("DELETE FROM vacancy_apply WHERE id = ?");
    $del->bind_param('i', $id);
    $del->execute();
    $del->close();
    json_out(['success' => false, 'message' => 'Could not save the uploaded resume. Please try again.'], 500);
}
@chmod($target, 0644);

/* 3) store the filename */
$stmt = $conn->prepare("UPDATE vacancy_apply SET resume = ? WHERE id = ?");
$stmt->bind_param('si', $fileName, $id);
$stmt->execute();
$stmt->close();

json_out(['success' => true, 'id' => $id, 'message' => 'Your application has been submitted successfully.']);
