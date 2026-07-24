<?php
/* ============================================================
   Shared bootstrap for the admissions APIs.
   - never emits HTML: every failure comes back as JSON
   - session guard
   - mysqli connection ($conn)
   - shared WHERE builder so list + export always agree
   ============================================================ */

/* Keep PHP notices/warnings out of the response body — otherwise a stray
   warning turns the JSON into "<br /> <b>Warning</b>..." and the client
   fails with "Unexpected token '<'". */
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Allowed (non-deleted) statuses. 'deleted' is reserved for soft deletes. */
const ADM_STATUSES = ['received', 'verified', 'completed'];

function json_out($data, $code = 200) {
    if (ob_get_level()) { ob_clean(); }          // drop anything already printed
    if (!headers_sent()) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
    }
    echo json_encode($data);
    exit;
}

/* Turn warnings, uncaught exceptions and fatals into JSON responses. */
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

/* Make mysqli throw instead of emitting warnings, so a bad connection or a
   failed prepare surfaces as clean JSON rather than HTML. */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    require_once __DIR__ . '/../../config/db.php';
} catch (Throwable $e) {
    json_out([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage(),
    ], 503);
}

function require_admin() {
    if (!isset($_SESSION['user_id'])) {
        json_out(['success' => false, 'message' => 'Not authenticated. Please sign in again.'], 401);
    }
}

/** Read JSON body, falling back to form-encoded POST. */
function read_input() {
    $in = json_decode(file_get_contents('php://input'), true);
    return is_array($in) ? $in : $_POST;
}

/** Display application number derived from the primary key. */
function app_no($id) {
    return 'MGS' . str_pad((string)(int)$id, 8, '0', STR_PAD_LEFT);
}

/** apply_class is '1'..'12' or 'Nursery'/'LKG'/'UKG'. */
function class_label($c) {
    return is_numeric($c) ? 'Grade ' . $c : $c;
}

/**
 * Build the shared WHERE clause for list/export.
 * Always excludes soft-deleted rows.
 */
function adm_where($status, $q, &$types, &$params) {
    $where  = ["status <> 'deleted'"];
    $types  = '';
    $params = [];

    if (in_array($status, ADM_STATUSES, true)) {
        $where[]  = 'status = ?';
        $types   .= 's';
        $params[] = $status;
    }
    if ($q !== '') {
        $like = '%' . $q . '%';
        $where[] = "(student_name LIKE ? OR phone LIKE ? OR email LIKE ? OR CONCAT('MGS', LPAD(id, 8, '0')) LIKE ?)";
        $types  .= 'ssss';
        array_push($params, $like, $like, $like, $like);
    }
    return 'WHERE ' . implode(' AND ', $where);
}
