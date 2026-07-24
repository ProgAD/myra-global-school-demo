<?php


session_start();
header('Content-Type: application/json; charset=utf-8');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Read input — supports both JSON (fetch) and normal form posts
$raw   = file_get_contents('php://input');
$input = json_decode($raw, true);
if (!is_array($input)) {
    $input = $_POST;
}

$username = trim($input['username'] ?? '');
$password = (string)($input['password'] ?? '');
$role     = trim($input['role'] ?? '');

// Validate presence
if ($username === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please enter both User ID and password.']);
    exit;
}

// Validate role against the users.role ENUM
if (!in_array($role, ['student', 'school'], true)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid portal selected.']);
    exit;
}

// DB connection ($conn)
require __DIR__ . '/../../config/db.php';

// Look up the user for this username AND the selected role
$stmt = $conn->prepare(
    'SELECT id, username, password, role FROM users WHERE username = ? AND role = ? LIMIT 1'
);
$stmt->bind_param('ss', $username, $role);
$stmt->execute();
$result = $stmt->get_result();
$user   = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Incorrect User ID or password.']);
    exit;
}

// Verify password — passwords are stored as plain text in the DB.
if ($user['password'] !== $password) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Incorrect User ID or password.']);
    exit;
}

// Success — establish the session
session_regenerate_id(true);
$_SESSION['user_id']  = (int)$user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

echo json_encode([
    'success'  => true,
    'redirect' => 'admin/dashboard.php'
]);
