<?php
/* Admissions module: shared bootstrap + module-specific helpers. */
require_once __DIR__ . '/../_common.php';

/** Allowed (non-deleted) statuses. 'deleted' is reserved for soft deletes. */
const ADM_STATUSES = ['received', 'verified', 'completed'];

/** Display application number derived from the primary key. */
function app_no($id) {
    return 'MGS' . str_pad((string)(int)$id, 8, '0', STR_PAD_LEFT);
}

/** apply_class is '1'..'12' or 'Nursery'/'LKG'/'UKG'. */
function class_label($c) {
    return is_numeric($c) ? 'Grade ' . $c : $c;
}

/**
 * Shared WHERE clause for list/export. Always excludes soft-deleted rows.
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
