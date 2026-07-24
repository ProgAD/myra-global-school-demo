<?php
/* ============================================================
   Dashboard stats endpoint
   GET  actions/admin/dashboard_stats.php
   Auth: requires a logged-in admin session ($_SESSION['user_id'])
   Returns JSON:
     { "success": true, "stats": {
         "total_applications": <int>,
         "pending_verification": <int>,
         "published_notices": <int>,
         "new_enquiries": <int>,
         "career_applications": <int>
     } }
   ============================================================ */

session_start();
header('Content-Type: application/json; charset=utf-8');

// Only logged-in admins may read stats
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated.']);
    exit;
}

// DB connection ($conn) — mysqli
require __DIR__ . '/../../config/db.php';

/* Run a COUNT(*) query and return the number (0 on any failure). */
function count_query(mysqli $conn, string $sql): int {
    $res = $conn->query($sql);
    if (!$res) {
        return 0;
    }
    $row = $res->fetch_row();
    $res->free();
    return (int)($row[0] ?? 0);
}

/* Whether a table exists (used for careers, which has no table yet). */
function table_exists(mysqli $conn, string $table): bool {
    $table = $conn->real_escape_string($table);
    $res = $conn->query("SHOW TABLES LIKE '$table'");
    return $res && $res->num_rows > 0;
}

$stats = [
    'total_applications'   => count_query($conn, "SELECT COUNT(*) FROM admission_applications"),
    'pending_verification' => count_query($conn, "SELECT COUNT(*) FROM admission_applications WHERE status = 'received'"),
    'published_notices'    => count_query($conn, "SELECT COUNT(*) FROM notices WHERE status = 'published'"),
    'new_enquiries'        => count_query($conn, "SELECT COUNT(*) FROM enquiries WHERE status = 'pending'"),
    // Career applications live in vacancy_apply (guarded in case it isn't created yet).
    'career_applications'  => table_exists($conn, 'vacancy_apply')
        ? count_query($conn, "SELECT COUNT(*) FROM vacancy_apply")
        : 0,
];

echo json_encode(['success' => true, 'stats' => $stats]);
