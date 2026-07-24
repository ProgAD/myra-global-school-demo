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

/* Document upload rules & storage.
   Files live in  assets/notices/<noticeId>/  and each stored JSON entry is
   {"name":"Original.pdf","file":"<noticeId>/<stored>.pdf"} — `file` is the
   path relative to assets/notices/. */
const NOTICE_MAX_DOCS      = 5;
const NOTICE_MAX_LINKS     = 5;
const NOTICE_DOC_EXT       = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf'];
const NOTICE_DOC_MAX_BYTES = 5 * 1024 * 1024;   // 5 MB per document

function notices_root() { return dirname(__DIR__, 3) . '/assets/notices/'; }
function notice_dir($id) { return notices_root() . (int)$id . '/'; }
function ensure_notice_dir($id) {
    $d = notice_dir($id);
    if (!is_dir($d) && !@mkdir($d, 0775, true)) return false;
    return is_writable($d) ? $d : false;
}
function sanitize_base($name) {
    $base = pathinfo($name, PATHINFO_FILENAME);
    $base = preg_replace('/[^A-Za-z0-9_-]+/', '-', $base);
    $base = trim($base, '-');
    if ($base === '') $base = 'doc';
    return substr($base, 0, 40);
}

/** Decode a JSON column into a clean list of assoc arrays. */
function json_list($raw) {
    if (!$raw) return [];
    $v = json_decode($raw, true);
    return is_array($v) ? array_values(array_filter($v, 'is_array')) : [];
}

/** Normalise link pairs [{title,url}] (drops empties). */
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

/** Map stored document entries to output form with a usable URL.
   $prefix e.g. '../assets/notices/' (admin) or 'assets/notices/' (public). */
function map_docs($docs, $prefix) {
    $out = [];
    foreach ($docs as $d) {
        $name = $d['name'] ?? '';
        $file = $d['file'] ?? '';
        $url  = ($file !== '') ? $prefix . $file : ($d['url'] ?? '');   // legacy fallback
        if ($name === '' && $url === '') continue;
        $out[] = ['name' => $name, 'file' => $file, 'url' => $url];
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
