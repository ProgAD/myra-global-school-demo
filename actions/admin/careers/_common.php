<?php
/* Careers module: shared bootstrap + helpers for vacancies & applications. */
require_once __DIR__ . '/../_common.php';

/* vacancies.status has a 'deleted' value -> soft delete.
   vacancy_apply has none                 -> hard delete. */
const VAC_STATUSES  = ['open', 'paused', 'closed'];
const VAC_DEPTS     = ['academic-faculty', 'administration', 'support-staff', 'other'];
const VAC_TYPES     = ['full-time', 'part-time', 'contract', 'internship', 'temporary', 'freelance'];
const APP_STATUSES  = ['new', 'reviewed', 'shortlisted', 'rejected'];

const DEPT_LABELS = [
    'academic-faculty' => 'Academic Faculty',
    'administration'   => 'Administration',
    'support-staff'    => 'Support Staff',
    'other'            => 'Other',
];
const TYPE_LABELS = [
    'full-time'  => 'Full-time',
    'part-time'  => 'Part-time',
    'contract'   => 'Contract',
    'internship' => 'Internship',
    'temporary'  => 'Temporary',
    'freelance'  => 'Freelance',
];

function vac_where($status, $q, &$types, &$params) {
    $where  = ["status <> 'deleted'"];
    $types  = '';
    $params = [];

    if (in_array($status, VAC_STATUSES, true)) {
        $where[]  = 'status = ?';
        $types   .= 's';
        $params[] = $status;
    }
    if ($q !== '') {
        $like = '%' . $q . '%';
        $where[] = '(role_title LIKE ? OR role_description LIKE ? OR department LIKE ? OR type LIKE ?)';
        $types  .= 'ssss';
        array_push($params, $like, $like, $like, $like);
    }
    return 'WHERE ' . implode(' AND ', $where);
}

/** Applications join vacancies for the position title. */
function app_where($status, $q, &$types, &$params) {
    $where  = ['1'];
    $types  = '';
    $params = [];

    if (in_array($status, APP_STATUSES, true)) {
        $where[]  = 'a.status = ?';
        $types   .= 's';
        $params[] = $status;
    }
    if ($q !== '') {
        $like = '%' . $q . '%';
        $where[] = '(a.name LIKE ? OR a.email LIKE ? OR a.phone LIKE ? OR v.role_title LIKE ?)';
        $types  .= 'ssss';
        array_push($params, $like, $like, $like, $like);
    }
    return 'WHERE ' . implode(' AND ', $where);
}
