<?php
/* ============================================================
   POST actions/admission/submit.php   (multipart/form-data)

   Flow:
     1. validate every field + the four uploads
     2. INSERT the application (document columns left NULL)
     3. use the new insert id to rename each upload:
          <id>-StudentPhoto.<ext>
          <id>-StudentAadhaar.<ext>
          <id>-FatherAadhaar.<ext>
          <id>-MotherAadhaar.<ext>
        and move them into assets/admissions/docs/
     4. UPDATE the row with those file names
     5. on any file failure -> roll back (delete row + moved files)

   Returns: { success:true, id, redirect } | { success:false, message, errors{} }
   ============================================================ */
require __DIR__ . '/_common.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_out(['success' => false, 'message' => 'Method not allowed.'], 405);
}

const MAX_BYTES  = 2 * 1024 * 1024;                       // 2 MB
const IMG_EXT    = ['jpg', 'jpeg', 'png', 'webp'];
const DOC_EXT    = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];

/* Upload field  =>  [suffix used in the stored file name, allowed extensions, label] */
$UPLOADS = [
    'student_photo'       => ['StudentPhoto',   IMG_EXT, "Student photograph"],
    'doc_student_aadhaar' => ['StudentAadhaar', DOC_EXT, "Student's Aadhaar"],
    'doc_father_aadhaar'  => ['FatherAadhaar',  DOC_EXT, "Father's Aadhaar"],
    'doc_mother_aadhaar'  => ['MotherAadhaar',  DOC_EXT, "Mother's Aadhaar"],
];

$errors = [];
function v($k) { return trim((string)($_POST[$k] ?? '')); }

/* ---------------- text fields ---------------- */
$apply_class         = v('apply_class');
$student_name        = v('student_name');
$father_name         = v('father_name');
$mother_name         = v('mother_name');
$gender              = v('gender');
$dob                 = v('dob');
$blood_group         = v('blood_group');
$identification_mark = v('identification_mark');
$religion            = v('religion');
$category            = v('category');
$mother_tongue       = v('mother_tongue');
$student_aadhaar     = preg_replace('/\D/', '', v('student_aadhaar'));
$last_school         = v('last_school');
$address             = v('address');
$city                = v('city');
$pin                 = preg_replace('/\D/', '', v('pin'));
$state               = v('state');
$phone               = v('phone');
$email               = v('email');

if (!in_array($apply_class, ADM_CLASSES, true)) $errors['apply_class'] = 'Please select the class being applied for.';
if ($student_name === '')                       $errors['student_name'] = "Student's full name is required.";
if ($father_name === '')                        $errors['father_name'] = "Father's name is required.";
if ($mother_name === '')                        $errors['mother_name'] = "Mother's name is required.";
if (!in_array($gender, ADM_GENDERS, true))      $errors['gender'] = 'Please select a gender.';

if ($dob === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
    $errors['dob'] = 'Please enter a valid date of birth.';
} elseif (strtotime($dob) > time()) {
    $errors['dob'] = 'Date of birth cannot be in the future.';
}

if ($blood_group !== '' && !in_array($blood_group, ADM_BLOOD, true)) $errors['blood_group'] = 'Invalid blood group.';
if ($identification_mark === '')                $errors['identification_mark'] = 'Identification mark is required.';
if ($religion === '')                           $errors['religion'] = 'Religion is required.';
if (!in_array($category, ADM_CATS, true))       $errors['category'] = 'Please select a category.';
if ($mother_tongue === '')                      $errors['mother_tongue'] = 'Mother tongue is required.';
if (strlen($student_aadhaar) !== 12)            $errors['student_aadhaar'] = 'Aadhaar number must be exactly 12 digits.';
if ($address === '')                            $errors['address'] = 'Address is required.';
if ($city === '')                               $errors['city'] = 'City is required.';
if (strlen($pin) !== 6)                         $errors['pin'] = 'PIN code must be exactly 6 digits.';
if ($state === '')                              $errors['state'] = 'State is required.';
if ($phone === '' || strlen(preg_replace('/\D/', '', $phone)) < 10) $errors['phone'] = 'Please enter a valid phone number.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))    $errors['email'] = 'Please enter a valid email address.';

/* ---------------- uploads ---------------- */
$plan = [];   // field => ['tmp'=>..., 'name'=>final file name]
foreach ($UPLOADS as $field => $meta) {
    list($suffix, $allowed, $label) = $meta;
    $f = $_FILES[$field] ?? null;

    if (!$f || !isset($f['error']) || $f['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[$field] = $label . ' is required.';
        continue;
    }
    if ($f['error'] !== UPLOAD_ERR_OK) {
        $errors[$field] = $label . ' could not be uploaded (error ' . $f['error'] . ').';
        continue;
    }
    if ($f['size'] > MAX_BYTES) {
        $errors[$field] = $label . ' must be 2 MB or smaller.';
        continue;
    }
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) {
        $errors[$field] = $label . ' must be a ' . strtoupper(implode(' / ', $allowed)) . ' file.';
        continue;
    }
    if (!is_uploaded_file($f['tmp_name'])) {
        $errors[$field] = $label . ' upload failed. Please try again.';
        continue;
    }
    $plan[$field] = ['tmp' => $f['tmp_name'], 'suffix' => $suffix, 'ext' => $ext];
}

/* duplicate Aadhaar (column is UNIQUE) */
if (!isset($errors['student_aadhaar'])) {
    $chk = $conn->prepare("SELECT id FROM admission_applications WHERE student_aadhaar = ? LIMIT 1");
    $chk->bind_param('s', $student_aadhaar);
    $chk->execute();
    if ($chk->get_result()->fetch_row()) {
        $errors['student_aadhaar'] = 'An application with this Aadhaar number already exists.';
    }
    $chk->close();
}

if ($errors) {
    json_out([
        'success' => false,
        'message' => 'Please correct the highlighted fields and try again.',
        'errors'  => $errors,
    ], 422);
}

/* ---------------- writable upload folder ---------------- */
$dir = docs_dir();
if (!is_dir($dir) && !@mkdir($dir, 0775, true)) {
    json_out(['success' => false, 'message' => 'Upload folder could not be created on the server.'], 500);
}
if (!is_writable($dir)) {
    json_out(['success' => false, 'message' => 'Upload folder is not writable on the server.'], 500);
}

/* ---------------- 1) insert ---------------- */
$bloodVal = $blood_group !== '' ? $blood_group : null;
$lastVal  = $last_school !== '' ? $last_school : null;

$stmt = $conn->prepare(
    "INSERT INTO admission_applications
       (apply_class, student_name, father_name, mother_name, gender, dob, blood_group,
        identification_mark, religion, category, mother_tongue, student_aadhaar, last_school,
        address, city, pin, state, phone, email, status)
     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, 'received')"
);
$stmt->bind_param(
    'sssssssssssssssssss',
    $apply_class, $student_name, $father_name, $mother_name, $gender, $dob, $bloodVal,
    $identification_mark, $religion, $category, $mother_tongue, $student_aadhaar, $lastVal,
    $address, $city, $pin, $state, $phone, $email
);
$stmt->execute();
$id = (int)$stmt->insert_id;
$stmt->close();

if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Could not save the application. Please try again.'], 500);
}

/* ---------------- 2) move + rename the uploads ---------------- */
$saved = [];   // field => stored file name
$moved = [];   // absolute paths, for rollback

foreach ($plan as $field => $p) {
    $fileName = $id . '-' . $p['suffix'] . '.' . $p['ext'];
    $target   = $dir . $fileName;

    if (!@move_uploaded_file($p['tmp'], $target)) {
        // roll back: remove files already moved, then the row
        foreach ($moved as $m) { @unlink($m); }
        $del = $conn->prepare("DELETE FROM admission_applications WHERE id = ?");
        $del->bind_param('i', $id);
        $del->execute();
        $del->close();

        json_out(['success' => false, 'message' => 'Could not save the uploaded documents. Please try again.'], 500);
    }
    @chmod($target, 0644);
    $saved[$field] = $fileName;
    $moved[]       = $target;
}

/* ---------------- 3) store the file names ---------------- */
$stmt = $conn->prepare(
    "UPDATE admission_applications
     SET student_photo = ?, doc_student_aadhaar = ?, doc_father_aadhaar = ?, doc_mother_aadhaar = ?
     WHERE id = ?"
);
$stmt->bind_param(
    'ssssi',
    $saved['student_photo'],
    $saved['doc_student_aadhaar'],
    $saved['doc_father_aadhaar'],
    $saved['doc_mother_aadhaar'],
    $id
);
$stmt->execute();
$stmt->close();

json_out([
    'success'  => true,
    'id'       => $id,
    'redirect' => 'admission-status.php?id=' . $id,
]);
