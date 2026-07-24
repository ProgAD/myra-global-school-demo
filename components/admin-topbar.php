<?php
/* ============================================================
   Shared admin topbar.
   Each admin page sets $page_name (slug) before including this,
   e.g.  $page_name = 'admissions';
   The slug drives both this heading and the sidebar highlight.
   ============================================================ */
$ADMIN_TITLES = [
    'dashboard'  => 'Dashboard',
    'admissions' => 'Admissions',
    'notices'    => 'Notices',
    'gallery'    => 'Gallery',
    'album'      => 'Album',
    'enquiries'  => 'Enquiries',
    'career'     => 'Careers',
];
$page_heading = $ADMIN_TITLES[$page_name ?? ''] ?? 'Admin';
?>
<header class="topbar">
<button class="hamburger" id="hamburger" aria-label="Menu"><span class="material-symbols-outlined">menu</span></button>
<h1><?= htmlspecialchars($page_heading) ?></h1>
<div class="spacer"></div>
</header>
