<?php
/* ============================================================
   GET/POST actions/admission/status_lookup.php
   Body/Query: { q }  -> application no (MGS00000012 or 12) OR phone number

   Resolves the input to an application and returns the id so the
   caller can redirect to admission-status.php?id=<id>.

   Returns:
     found     -> { success:true, id:<int>, redirect:"admission-status.php?id=<int>" }
     not found -> { success:false, message:"..." }  (HTTP 404)

   Rules:
     - application number: accepts "MGS00000012", "12", "MGS12" etc.
       -> matched on the primary key (the inserted id).
     - otherwise treated as a phone number (digits compared).
     - if a phone matches more than one application, the most recent
       one is returned.
   ============================================================ */
require __DIR__ . '/_common.php';

/* accept either query string or posted body */
$q = trim($_GET['q'] ?? ($_POST['q'] ?? ''));
if ($q === '') {
    $in = json_decode(file_get_contents('php://input'), true);
    if (is_array($in)) { $q = trim($in['q'] ?? ''); }
}

if ($q === '') {
    json_out(['success' => false, 'message' => 'Please enter your application number or phone number.'], 400);
}

$row = null;

/* ---- 1) application-number path -----------------------------------------
   Application numbers are "MGS" + zero-padded id. Strip the MGS prefix and
   any leading zeros; if what remains is purely numeric, treat it as the id. */
$asAppNo = strtoupper(preg_replace('/\s+/', '', $q));
if (preg_match('/^MGS0*([0-9]+)$/', $asAppNo, $m) || preg_match('/^0*([0-9]+)$/', $asAppNo, $m)) {
    $id = (int)$m[1];
    if ($id > 0) {
        $stmt = $conn->prepare(
            "SELECT id FROM admission_applications WHERE id = ? AND status <> 'deleted' LIMIT 1"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    }
}

/* ---- 2) phone path -------------------------------------------------------
   Compare on digits only, so "+91 98765 43210" and "9876543210" both match. */
if (!$row) {
    $digits = preg_replace('/\D/', '', $q);
    if (strlen($digits) >= 10) {
        $stmt = $conn->prepare(
            "SELECT id FROM admission_applications
             WHERE REPLACE(REPLACE(REPLACE(REPLACE(phone,' ',''),'-',''),'(',''),')','') LIKE CONCAT('%', ?)
               AND status <> 'deleted'
             ORDER BY created_at DESC, id DESC
             LIMIT 1"
        );
        $stmt->bind_param('s', $digits);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    }
}

if (!$row) {
    json_out([
        'success' => false,
        'message' => 'No application found for that application number or phone number. Please check and try again.',
    ], 404);
}

$id = (int)$row['id'];
json_out([
    'success'  => true,
    'id'       => $id,
    'redirect' => 'admission-status.php?id=' . $id,
]);
