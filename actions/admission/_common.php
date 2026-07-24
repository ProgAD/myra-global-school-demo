<?php
/* ============================================================
   Public admission endpoints bootstrap.
   Same JSON-only guarantee as the admin APIs, but no login
   required — these are used by prospective applicants.
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
    require_once dirname(__DIR__, 2) . '/config/db.php';
} catch (Throwable $e) {
    json_out(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()], 503);
}

/* ---- shared option lists (mirror schema.sql) ---- */
const ADM_CLASSES = ['Nursery','LKG','UKG','1','2','3','4','5','6','7','8','9','10','11','12'];
const ADM_GENDERS = ['Male','Female','Other'];
const ADM_BLOOD   = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
const ADM_CATS    = ['General','OBC','EBC','SC','ST','EWS','Other'];

/** Where uploaded documents live (absolute path). */
function docs_dir() {
    return dirname(__DIR__, 2) . '/assets/admissions/docs/';
}

/** Human label for a class value. */
function class_label($c) {
    return is_numeric($c) ? 'Grade ' . $c : $c;
}
