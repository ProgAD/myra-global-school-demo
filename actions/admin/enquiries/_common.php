<?php
/* Enquiries module: shared bootstrap + module-specific helpers. */
require_once __DIR__ . '/../_common.php';

/* NOTE: the enquiries.status enum has no 'deleted' value, so deletes
   here are HARD deletes (unlike admissions / notices / vacancies). */
const ENQ_STATUSES = ['pending', 'replied'];

function enq_where($status, $q, &$types, &$params) {
    $where  = ['1'];
    $types  = '';
    $params = [];

    if (in_array($status, ENQ_STATUSES, true)) {
        $where[]  = 'status = ?';
        $types   .= 's';
        $params[] = $status;
    }
    if ($q !== '') {
        $like = '%' . $q . '%';
        $where[] = '(name LIKE ? OR email LIKE ? OR phone LIKE ? OR message LIKE ?)';
        $types  .= 'ssss';
        array_push($params, $like, $like, $like, $like);
    }
    return 'WHERE ' . implode(' AND ', $where);
}
