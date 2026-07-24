<?php
/* Notices module: shared bootstrap + module-specific helpers. */
require_once __DIR__ . '/../_common.php';

/** Visible statuses. 'deleted' is reserved for soft deletes. */
const NOTICE_STATUSES = ['published', 'archived'];

/** Mirrors the category ENUM in schema.sql. */
const NOTICE_CATEGORIES = [
    'admission', 'examination', 'holiday', 'event', 'circular', 'announcement',
    'academic', 'fee', 'result', 'scholarship', 'sports', 'emergency',
    'recruitment', 'tender', 'other',
];

/** Decode a JSON column into a clean list of assoc arrays. */
function json_list($raw) {
    if (!$raw) return [];
    $v = json_decode($raw, true);
    return is_array($v) ? array_values(array_filter($v, 'is_array')) : [];
}

/** Normalise incoming documents [{name,url}] / links [{title,url}]. */
function clean_pairs($raw, $keyA, $keyB) {
    if (!is_array($raw)) return [];
    $out = [];
    foreach ($raw as $item) {
        if (!is_array($item)) continue;
        $a = trim((string)($item[$keyA] ?? ''));
        $b = trim((string)($item[$keyB] ?? ''));
        if ($a !== '' && $b !== '') {
            $out[] = [$keyA => $a, $keyB => $b];
        }
    }
    return $out;
}

function notice_where($status, $q, &$types, &$params) {
    $where  = ["status <> 'deleted'"];
    $types  = '';
    $params = [];

    if (in_array($status, NOTICE_STATUSES, true)) {
        $where[]  = 'status = ?';
        $types   .= 's';
        $params[] = $status;
    }
    if ($q !== '') {
        $like = '%' . $q . '%';
        $where[] = '(title LIKE ? OR content LIKE ? OR category LIKE ?)';
        $types  .= 'sss';
        array_push($params, $like, $like, $like);
    }
    return 'WHERE ' . implode(' AND ', $where);
}
