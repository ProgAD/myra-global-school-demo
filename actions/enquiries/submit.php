<?php
/* ============================================================
   POST actions/enquiries/submit.php   (form-data or JSON)
   Fields: name (required), phone (required), email?, message (required)

   Saves a "Have Questions?" enquiry into the `enquiries` table.
   ============================================================ */
require __DIR__ . '/../_public_boot.php';
require_post();

/* accept both urlencoded form posts and JSON bodies */
$src = $_POST;
if (empty($src)) {
    $raw = file_get_contents('php://input');
    if ($raw !== '' && $raw !== false) {
        $j = json_decode($raw, true);
        if (is_array($j)) $src = $j;
    }
}

function ev($src, $k) { return trim((string)($src[$k] ?? '')); }

$name    = ev($src, 'name');
$phone   = ev($src, 'phone');
$email   = ev($src, 'email');
$message = ev($src, 'message');

$errors = [];
if ($name === '')                                                    $errors['name']    = 'Your name is required.';
if ($phone === '' || strlen(preg_replace('/\D/', '', $phone)) < 10)  $errors['phone']   = 'A valid phone number is required.';
if ($message === '')                                                 $errors['message'] = 'Please enter your question.';
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL))     $errors['email']   = 'Please enter a valid email address.';

if (strlen($name) > 150)                                             $errors['name']    = 'Name is too long.';
if (strlen($phone) > 15)                                             $errors['phone']   = 'Phone number is too long.';
if (strlen($email) > 150)                                            $errors['email']   = 'Email is too long.';

if ($errors) {
    json_out(['success' => false, 'message' => 'Please correct the highlighted fields.', 'errors' => $errors], 422);
}

$emailVal = $email !== '' ? $email : null;

$stmt = $conn->prepare(
    "INSERT INTO enquiries (name, email, phone, message, status)
     VALUES (?, ?, ?, ?, 'pending')"
);
$stmt->bind_param('ssss', $name, $emailVal, $phone, $message);
$stmt->execute();
$id = (int)$stmt->insert_id;
$stmt->close();

if ($id <= 0) {
    json_out(['success' => false, 'message' => 'Could not submit your enquiry. Please try again.'], 500);
}

json_out(['success' => true, 'id' => $id, 'message' => 'Thank you! We will reach you soon.']);
