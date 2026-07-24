<?php
/* ============================================================
   Shared bootstrap for PUBLIC (no-login) endpoints.
   Guarantees a JSON-only response surface and a mysqli $conn.
   ============================================================ */
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
ob_start();

function json_out($data, $code = 200) {
    if (ob_get_level()) { ob_clean(); }
    if (!headers_sent()) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
    }
    echo json_encode($data);
    exit;
}

set_error_handler(function ($no, $str, $file, $line) {
    throw new ErrorException($str, 0, $no, $file, $line);
});
set_exception_handler(function ($e) {
    json_out(['success' => false, 'message' => $e->getMessage()], 500);
});
register_shutdown_function(function () {
    $e = error_get_last();
    if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        json_out(['success' => false, 'message' => 'Server error: ' . $e['message']], 500);
    }
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // __DIR__ == project_root/actions  ->  project root is one level up
    require_once dirname(__DIR__) . '/config/db.php';
} catch (Throwable $e) {
    json_out(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()], 503);
}

function require_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        json_out(['success' => false, 'message' => 'Method not allowed.'], 405);
    }
}

/** Notice date window: this week (Mon-based) / month / year. */
function range_since($range) {
    switch ($range) {
        case 'month': return "created_at >= DATE_FORMAT(CURDATE(), '%Y-%m-01')";
        case 'year':  return "created_at >= DATE_FORMAT(CURDATE(), '%Y-01-01')";
        case 'week':
        default:      return "created_at >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)";
    }
}

function fmt_date($ts) { return $ts ? date('F j, Y', strtotime($ts)) : ''; }
