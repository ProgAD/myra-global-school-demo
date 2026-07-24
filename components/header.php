<?php
/* Active nav item comes from $page_name, set at the top of each page.
   Sub-pages resolve to their parent nav item (e.g. album -> gallery). */
$nav_parent = [
  'admission-form'   => 'admission',
  'admission-status' => 'admission',
  'album'            => 'gallery',
  'curriculum'       => 'academics',
  'examinations'     => 'academics',
  'facilities'       => 'academics',
  'rules'            => 'academics',
];
$nav_active = $page_name ?? '';
$nav_active = $nav_parent[$nav_active] ?? $nav_active;
$na = function ($key) use ($nav_active) { return $key === $nav_active ? ' nav-link--active' : ''; };
?>
<nav class="site-nav">
<div class="container nav-inner">
<div class="nav-brand">
<a href="index.php" class="brand-link">
<img src="logo/horizontal-logo.png" alt="Myra Global School" class="brand-logo" onerror="this.style.display='none';this.nextElementSibling.style.display='inline';"/>
<span class="brand-name" style="display:none">Myra Global School</span>
</a>
</div>
<div class="nav-menu">
<a class="nav-link<?= $na('home') ?>" href="index.php">Home</a>
<div class="nav-item">
<a class="nav-link nav-link--caret<?= $na('about') ?>" href="about.php">About
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="about.php#mission">Mission</a>
<a class="dropdown-link" href="about.php#vision">Vision</a>
</div>
</div>
</div>
<div class="nav-item">
<a class="nav-link nav-link--caret<?= $na('academics') ?>" href="academics.php">Academics
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="curriculum.php">Curriculum</a>
<a class="dropdown-link" href="examinations.php">Examinations</a>
<a class="dropdown-link" href="facilities.php">Facilities</a>
<a class="dropdown-link" href="rules.php">Rules &amp; Regulations</a>
</div>
</div>
</div>
<div class="nav-item">
<a class="nav-link nav-link--caret<?= $na('admission') ?>" href="admission.php">Admissions
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="admission/admission-form.php">Apply 2026-2027</a>
</div>
</div>
</div>
<a class="nav-link<?= $na('notice') ?>" href="notice.php">Notice</a>
<a class="nav-link<?= $na('gallery') ?>" href="gallery.php">Gallery</a>
<a class="nav-link<?= $na('career') ?>" href="career.php">Careers</a>
</div>
<div class="nav-actions">
<button class="nav-btn nav-btn--solid" onclick="window.location.href='login.html'">Portal Login</button>
</div>
</div>
</nav>
