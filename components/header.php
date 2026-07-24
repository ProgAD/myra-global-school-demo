<?php
/* Active nav item comes from $page_name, set at the top of each page.
   Sub-pages resolve to their parent nav item (e.g. album -> gallery).
   $base is the path prefix to the site root ('' for root pages,
   '../' for pages inside a subfolder like admission/ or academics/). */
$base = $base ?? '';
$nav_parent = [
  'admission-form'   => 'admission',
  'admission-status' => 'admission',
  'album'            => 'gallery',
  'curriculum'       => 'academics',
  'examinations'     => 'academics',
  'facilities'       => 'academics',
  'rules-regulations'=> 'academics',
];
$nav_active = $page_name ?? '';
$nav_active = $nav_parent[$nav_active] ?? $nav_active;
$na = function ($key) use ($nav_active) { return $key === $nav_active ? ' nav-link--active' : ''; };
?>
<nav class="site-nav">
<div class="container nav-inner">
<div class="nav-brand">
<a href="<?= $base ?>index.php" class="brand-link">
<img src="<?= $base ?>logo/horizontal-logo.png" alt="Myra Global School" class="brand-logo" onerror="this.style.display='none';this.nextElementSibling.style.display='inline';"/>
<span class="brand-name" style="display:none">Myra Global School</span>
</a>
</div>
<div class="nav-menu">
<a class="nav-link<?= $na('home') ?>" href="<?= $base ?>index.php">Home</a>
<div class="nav-item">
<a class="nav-link nav-link--caret<?= $na('about') ?>" href="<?= $base ?>about.php">About
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="<?= $base ?>about.php#mission">Mission</a>
<a class="dropdown-link" href="<?= $base ?>about.php#vision">Vision</a>
</div>
</div>
</div>
<div class="nav-item">
<a class="nav-link nav-link--caret<?= $na('academics') ?>" href="<?= $base ?>academics.php">Academics
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="<?= $base ?>academics/curriculum.php">Curriculum</a>
<a class="dropdown-link" href="<?= $base ?>academics/examinations.php">Examinations</a>
<a class="dropdown-link" href="<?= $base ?>academics/facilities.php">Facilities</a>
<a class="dropdown-link" href="<?= $base ?>academics/rules-regulations.php">Rules &amp; Regulations</a>
</div>
</div>
</div>
<div class="nav-item">
<a class="nav-link nav-link--caret<?= $na('admission') ?>" href="<?= $base ?>admission.php">Admissions
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="<?= $base ?>admission/admission-form.php">Apply 2026-2027</a>
</div>
</div>
</div>
<a class="nav-link<?= $na('notice') ?>" href="<?= $base ?>notice.php">Notice</a>
<a class="nav-link<?= $na('gallery') ?>" href="<?= $base ?>gallery.php">Gallery</a>
<a class="nav-link<?= $na('career') ?>" href="<?= $base ?>career.php">Careers</a>
</div>
<div class="nav-actions">
<button class="nav-btn nav-btn--solid" onclick="window.location.href='<?= $base ?>login.html'">Portal Login</button>
</div>
</div>
</nav>
