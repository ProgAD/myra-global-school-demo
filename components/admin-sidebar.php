<?php
/* Active nav item comes from $page_name, set at the top of each admin page.
   album.php is a sub-page of Gallery, so it keeps Gallery highlighted. */
$cur = $page_name ?? '';
?>
<aside class="sidebar" id="sidebar">
<div class="side-brand">
<a href="dashboard.php" class="side-brand-link">
<img class="side-logo" src="../logo/horizontal-logo2.png" alt="Myra Global School" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"/>
<span class="side-fallback" style="display:none">
<span class="crest">MG</span>
<span class="name">Myra Global<small>Admin Panel</small></span>
</span>
</a>
</div>
<div class="side-group">
<div class="side-label">Main</div>
<a class="nav-a<?= $cur === 'dashboard' ? ' active' : '' ?>" href="dashboard.php"><span class="material-symbols-outlined">dashboard</span> Dashboard</a>
<div class="side-label" style="margin-top:18px;">Manage</div>
<a class="nav-a<?= $cur === 'admissions' ? ' active' : '' ?>" href="admissions.php"><span class="material-symbols-outlined">school</span> Admissions <span class="badge">14</span></a>
<a class="nav-a<?= $cur === 'notices' ? ' active' : '' ?>" href="notices.php"><span class="material-symbols-outlined">campaign</span> Notices</a>
<a class="nav-a<?= ($cur === 'gallery' || $cur === 'album') ? ' active' : '' ?>" href="gallery.php"><span class="material-symbols-outlined">photo_library</span> Gallery</a>
<a class="nav-a<?= $cur === 'enquiries' ? ' active' : '' ?>" href="enquiries.php"><span class="material-symbols-outlined">mail</span> Enquiries <span class="badge">9</span></a>
<a class="nav-a<?= $cur === 'career' ? ' active' : '' ?>" href="career.php"><span class="material-symbols-outlined">work</span> Careers <span class="badge">5</span></a>
</div>
<div class="side-foot">
<a class="nav-a" href="../index.php" target="_blank"><span class="material-symbols-outlined">open_in_new</span> View Website</a>
<a class="nav-a" href="../actions/auth/logout.php"><span class="material-symbols-outlined">logout</span> Logout</a>
</div>
</aside>
<div class="overlay" id="overlay"></div>