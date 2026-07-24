<?php
/* ============================================================
   Application status page — always driven by ?id=<insertedId>
   Renders straight from admission_applications.
   ============================================================ */
ini_set('display_errors', '0');
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id    = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$app   = null;
$error = '';

if ($id <= 0) {
    $error = 'No application number was supplied. Please open this page using the link shown after submitting your form.';
} else {
    try {
        require_once __DIR__ . '/../config/db.php';
        $stmt = $conn->prepare(
            "SELECT * FROM admission_applications WHERE id = ? AND status <> 'deleted' LIMIT 1"
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $app = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if (!$app) {
            $error = 'We could not find an application with number ' . htmlspecialchars(app_no_fmt($id)) . '.';
        }
    } catch (Throwable $e) {
        $error = 'The application could not be loaded right now. Please try again shortly.';
    }
}

function app_no_fmt($id) { return 'MGS' . str_pad((string)(int)$id, 8, '0', STR_PAD_LEFT); }
function e($v)           { return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8'); }
function or_dash($v)     { return ($v === null || $v === '') ? '—' : e($v); }
function cls_label($c)   { return is_numeric($c) ? 'Grade ' . $c : (string)$c; }
function d_long($v)      { return $v ? date('j F Y', strtotime($v)) : '—'; }

$STATUS_UI = [
    'received'  => ['Received',   'inventory_2', '#e2ecff', '#2b4c8c'],
    'verified'  => ['Verified',   'verified',    '#fff3d6', '#8a6d1a'],
    'completed' => ['Completed',  'check_circle','#e2f7ec', '#227a52'],
];
$st  = $app['status'] ?? 'received';
$sui = $STATUS_UI[$st] ?? $STATUS_UI['received'];

$DOCS = [
    'student_photo'       => ['Student Photo',   'photo_camera'],
    'doc_student_aadhaar' => ['Student Aadhaar', 'badge'],
    'doc_father_aadhaar'  => ['Father Aadhaar',  'badge'],
    'doc_mother_aadhaar'  => ['Mother Aadhaar',  'badge'],
];
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Application Status | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="../css/header.css" rel="stylesheet"/>
<link href="../css/footer.css" rel="stylesheet"/>
<script src="../js/nav.js" defer></script>
<style>
:root{
  --primary-container:#002147;--secondary-fixed:#ffe088;--secondary-fixed-dim:#e9c349;
  --on-surface-variant:#44474e;--on-background:#1e1b18;--on-primary:#ffffff;--primary:#000a1e;
  --on-secondary-fixed:#241a00;--secondary:#735c00;--surface:#fff8f5;--surface-container-low:#fbf2ed;
  --surface-container:#f5ece7;--surface-container-high:#efe6e2;--surface-container-highest:#e9e1dc;
  --surface-container-lowest:#ffffff;--background:#fff8f5;--on-surface:#1e1b18;--on-primary-container:#708ab5;
  --outline:#74777f;--outline-variant:#c4c6cf;
  --font-serif:"Source Serif 4", Georgia, serif;--font-sans:"Source Sans 3", system-ui, sans-serif;
}
*,*::before,*::after{box-sizing:border-box;}*{margin:0;}
html{scroll-behavior:smooth;}
body{background:var(--background);color:var(--on-background);font-family:var(--font-serif);font-size:16px;line-height:1.5;-webkit-font-smoothing:antialiased;}
img{display:block;max-width:100%;}a{text-decoration:none;color:inherit;}ul{list-style:none;}
button{font-family:inherit;background:none;border:none;}address{font-style:normal;}
.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;display:inline-block;vertical-align:middle;}
.container{max-width:1280px;margin:0 auto;padding-left:64px;padding-right:64px;width:100%;}

.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);flex-wrap:wrap;}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

.btn-fill{display:inline-flex;align-items:center;gap:8px;background:var(--primary-container);color:var(--on-primary);padding:12px 26px;border-radius:8px;font-family:var(--font-sans);font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;}
.btn-fill:hover{background:var(--primary);}
.btn-fill .material-symbols-outlined{font-size:18px;}
.btn-line{display:inline-flex;align-items:center;gap:8px;background:transparent;border:1px solid var(--primary);color:var(--primary);padding:12px 26px;border-radius:8px;font-family:var(--font-sans);font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;}
.btn-line:hover{background:var(--primary);color:var(--on-primary);}
.btn-line .material-symbols-outlined{font-size:18px;}

.status-page{padding:48px 0 120px;background:var(--surface-container-low);}
.panel{background:#fff;border:1px solid var(--outline-variant);border-radius:14px;padding:28px 32px;box-shadow:0 8px 24px rgba(0,33,71,.06);margin-top:24px;}
.panel-head{display:flex;flex-wrap:wrap;gap:16px;align-items:center;justify-content:space-between;margin-bottom:24px;}
.panel-title{font-family:var(--font-serif);font-size:22px;font-weight:600;color:var(--primary);}

.stat-pill{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:9999px;font-family:var(--font-sans);font-size:13px;font-weight:600;}
.stat-pill .material-symbols-outlined{font-size:15px;}

/* Not-found / error state */
.notice-box{background:#fff;border:1px solid var(--outline-variant);border-radius:14px;padding:56px 32px;text-align:center;box-shadow:0 8px 24px rgba(0,33,71,.06);margin-top:24px;}
.notice-box .material-symbols-outlined{font-size:56px;color:var(--outline-variant);}
.notice-box h2{font-family:var(--font-serif);font-size:24px;font-weight:700;color:var(--primary);margin-top:12px;}
.notice-box p{color:var(--on-surface-variant);margin-top:8px;max-width:560px;margin-left:auto;margin-right:auto;}
.notice-box .acts{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:24px;}

.print-form{display:none;color:#000;font-family:var(--font-serif);width:100%;}
.pf-head{text-align:center;border-bottom:2px solid #002147;padding-bottom:10px;margin-bottom:12px;}
.pf-logo{height:52px;width:auto;margin:0 auto 6px;}
.pf-school{font-size:22px;font-weight:700;color:#002147;}
.pf-addr{font-family:var(--font-sans);font-size:10.5px;color:#333;margin-top:4px;}
.pf-title{font-size:14px;font-weight:700;margin-top:9px;color:#002147;text-transform:uppercase;letter-spacing:.06em;}
.pf-meta{display:flex;justify-content:space-between;flex-wrap:wrap;gap:4px 16px;font-family:var(--font-sans);font-size:11px;margin-bottom:10px;}
.pf-table{width:100%;border-collapse:collapse;margin-bottom:14px;}
.pf-table th,.pf-table td{border:1px solid #999;padding:5px 9px;font-size:11.5px;text-align:left;vertical-align:top;}
.pf-table th{width:34%;background:#f2f2f2;font-family:var(--font-sans);font-weight:600;color:#111;}
.pf-sec td{background:#002147;color:#fff;font-family:var(--font-sans);font-weight:700;text-transform:uppercase;letter-spacing:.05em;font-size:10.5px;padding:5px 9px;}
.pf-decl{font-size:10.5px;color:#333;margin-bottom:34px;line-height:1.5;}
.pf-sign{display:flex;justify-content:space-between;gap:40px;font-family:var(--font-sans);font-size:11.5px;}
.pf-sign > div{border-top:1px solid #000;padding-top:6px;width:45%;text-align:center;}

.summary-block + .summary-block{margin-top:28px;padding-top:28px;border-top:1px solid var(--outline-variant);}
.summary-block-title{font-family:var(--font-sans);font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.14em;color:var(--secondary);margin-bottom:18px;}
.summary-grid{display:grid;grid-template-columns:1fr;gap:18px 32px;}
.summary-item.wide{grid-column:1/-1;}
.summary-label{font-family:var(--font-sans);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:var(--on-surface-variant);margin-bottom:3px;}
.summary-value{font-family:var(--font-serif);font-size:16px;color:var(--on-background);}

.docs-grid{display:grid;grid-template-columns:1fr;gap:14px;}
.doc{display:flex;align-items:center;gap:12px;padding:12px 14px;border:1px solid var(--outline-variant);border-radius:10px;background:var(--surface-container-low);transition:border-color .2s;}
.doc:hover{border-color:var(--primary);}
.doc-ico{width:38px;height:38px;flex-shrink:0;border-radius:8px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;}
.doc-ico .material-symbols-outlined{font-size:20px;}
.doc-label{font-family:var(--font-sans);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:var(--on-surface-variant);}
.doc-name{font-family:var(--font-sans);font-size:14px;font-weight:600;color:#227a52;word-break:break-all;}
.doc-name.missing{color:#c0392b;}

.status-actions{display:flex;flex-wrap:wrap;gap:16px;margin-top:28px;}

@media(min-width:768px){
  .summary-grid{grid-template-columns:repeat(2,1fr);}
  .docs-grid{grid-template-columns:repeat(2,1fr);}
}
@media(min-width:1024px){
  .summary-grid{grid-template-columns:repeat(3,1fr);}
  .docs-grid{grid-template-columns:repeat(4,1fr);}
}

@media print{
  .site-nav,.page-banner,.site-footer,.status-page{display:none !important;}
  .print-form{display:block;}
  body,html{background:#fff;margin:0;padding:0;}
  .print-form,.pf-table,.pf-sign{break-inside:avoid;page-break-inside:avoid;}
  @page{size:A4;margin:14mm;}
}
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<nav class="site-nav">
<div class="container nav-inner">
<div class="nav-brand">
<a href="../index.php" class="brand-link">
<img src="../logo/horizontal-logo.png" alt="Myra Global School" class="brand-logo" onerror="this.style.display='none';this.nextElementSibling.style.display='inline';"/>
<span class="brand-name" style="display:none">Myra Global School</span>
</a>
</div>
<div class="nav-menu">
<a class="nav-link" href="../index.php">Home</a>
<div class="nav-item">
<a class="nav-link nav-link--caret" href="../about.php">About
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="../about.php#mission">Mission</a>
<a class="dropdown-link" href="../about.php#vision">Vision</a>
</div>
</div>
</div>
<div class="nav-item">
<a class="nav-link nav-link--caret" href="../academics.php">Academics
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="../academics.php">Curriculum</a>
<a class="dropdown-link" href="../academics.php">Examinations</a>
<a class="dropdown-link" href="../academics.php">Facilities</a>
</div>
</div>
</div>
<a class="nav-link nav-link--active" href="../admission.php">Admissions</a>
<a class="nav-link" href="../notice.php">Notice</a>
<a class="nav-link" href="../gallery.php">Gallery</a>
</div>
<div class="nav-actions">
<a class="nav-btn nav-btn--outline" href="../login.html">Portal Login</a>
<a class="nav-btn nav-btn--solid" href="admission-form.php">Apply Now</a>
</div>
</div>
</nav>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="../index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<a href="../admission.php">Admissions</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Application Status</span>
</div>
</div>
</header>

<section class="status-page">
<div class="container">

<?php if (!$app): ?>

<div class="notice-box">
<span class="material-symbols-outlined">search_off</span>
<h2>Application Not Found</h2>
<p><?= e($error) ?></p>
<div class="acts">
<a class="btn-fill" href="admission-form.php"><span class="material-symbols-outlined">edit_document</span> Apply for Admission</a>
<a class="btn-line" href="../admission.php"><span class="material-symbols-outlined">arrow_back</span> Back to Admissions</a>
</div>
</div>

<?php else: ?>

<div class="panel">
<div class="panel-head">
<h2 class="panel-title">Application Details</h2>
<button id="downloadBtn" class="btn-fill"><span class="material-symbols-outlined">download</span> Download Application Form</button>
</div>

<!-- Admission -->
<div class="summary-block">
<div class="summary-block-title">Admission Details</div>
<div class="summary-grid">
<div class="summary-item"><div class="summary-label">Class Applying For</div><div class="summary-value"><?= e(cls_label($app['apply_class'])) ?></div></div>
<div class="summary-item"><div class="summary-label">Application No</div><div class="summary-value"><?= e(app_no_fmt($app['id'])) ?></div></div>
<div class="summary-item"><div class="summary-label">Submitted On</div><div class="summary-value"><?= e(d_long($app['created_at'])) ?></div></div>
<div class="summary-item"><div class="summary-label">Current Status</div><div class="summary-value">
<span class="stat-pill" style="background:<?= e($sui[2]) ?>;color:<?= e($sui[3]) ?>">
<span class="material-symbols-outlined"><?= e($sui[1]) ?></span> <?= e($sui[0]) ?></span>
</div></div>
</div>
</div>

<!-- Student -->
<div class="summary-block">
<div class="summary-block-title">Student Details</div>
<div class="summary-grid">
<div class="summary-item"><div class="summary-label">Student's Name</div><div class="summary-value"><?= or_dash($app['student_name']) ?></div></div>
<div class="summary-item"><div class="summary-label">Father's Name</div><div class="summary-value"><?= or_dash($app['father_name']) ?></div></div>
<div class="summary-item"><div class="summary-label">Mother's Name</div><div class="summary-value"><?= or_dash($app['mother_name']) ?></div></div>
<div class="summary-item"><div class="summary-label">Gender</div><div class="summary-value"><?= or_dash($app['gender']) ?></div></div>
<div class="summary-item"><div class="summary-label">Date of Birth</div><div class="summary-value"><?= e(d_long($app['dob'])) ?></div></div>
<div class="summary-item"><div class="summary-label">Blood Group</div><div class="summary-value"><?= or_dash($app['blood_group']) ?></div></div>
<div class="summary-item"><div class="summary-label">Identification Mark</div><div class="summary-value"><?= or_dash($app['identification_mark']) ?></div></div>
<div class="summary-item"><div class="summary-label">Religion</div><div class="summary-value"><?= or_dash($app['religion']) ?></div></div>
<div class="summary-item"><div class="summary-label">Category</div><div class="summary-value"><?= or_dash($app['category']) ?></div></div>
<div class="summary-item"><div class="summary-label">Mother Tongue</div><div class="summary-value"><?= or_dash($app['mother_tongue']) ?></div></div>
<div class="summary-item"><div class="summary-label">Aadhaar Number</div><div class="summary-value"><?= or_dash($app['student_aadhaar']) ?></div></div>
<div class="summary-item"><div class="summary-label">Last School Attended</div><div class="summary-value"><?= or_dash($app['last_school']) ?></div></div>
</div>
</div>

<!-- Address -->
<div class="summary-block">
<div class="summary-block-title">Residential Address</div>
<div class="summary-grid">
<div class="summary-item wide"><div class="summary-label">Address</div><div class="summary-value"><?= or_dash($app['address']) ?></div></div>
<div class="summary-item"><div class="summary-label">City</div><div class="summary-value"><?= or_dash($app['city']) ?></div></div>
<div class="summary-item"><div class="summary-label">PIN Code</div><div class="summary-value"><?= or_dash($app['pin']) ?></div></div>
<div class="summary-item"><div class="summary-label">State</div><div class="summary-value"><?= or_dash($app['state']) ?></div></div>
</div>
</div>

<!-- Contact -->
<div class="summary-block">
<div class="summary-block-title">Contact Details</div>
<div class="summary-grid">
<div class="summary-item"><div class="summary-label">Phone Number</div><div class="summary-value"><?= or_dash($app['phone']) ?></div></div>
<div class="summary-item"><div class="summary-label">Email Address</div><div class="summary-value"><?= or_dash($app['email']) ?></div></div>
</div>
</div>

<!-- Documents -->
<div class="summary-block">
<div class="summary-block-title">Uploaded Documents</div>
<div class="docs-grid">
<?php foreach ($DOCS as $col => $meta):
        $file = $app[$col] ?? '';
        $href = $file ? '../assets/admissions/docs/' . rawurlencode($file) : '';
?>
<?php if ($file): ?>
<a class="doc" href="<?= e($href) ?>" target="_blank" rel="noopener">
<span class="doc-ico"><span class="material-symbols-outlined"><?= e($meta[1]) ?></span></span>
<div><div class="doc-label"><?= e($meta[0]) ?></div><div class="doc-name"><?= e($file) ?></div></div>
</a>
<?php else: ?>
<div class="doc">
<span class="doc-ico"><span class="material-symbols-outlined"><?= e($meta[1]) ?></span></span>
<div><div class="doc-label"><?= e($meta[0]) ?></div><div class="doc-name missing">Not uploaded</div></div>
</div>
<?php endif; ?>
<?php endforeach; ?>
</div>
</div>

<!-- Actions -->
<div class="status-actions">
<button id="downloadBtn2" class="btn-fill"><span class="material-symbols-outlined">download</span> Download Application Form</button>
<a class="btn-line" href="../admission.php"><span class="material-symbols-outlined">arrow_back</span> Back to Admissions</a>
</div>

</div>

<?php endif; ?>

</div>
</section>

<?php if ($app): ?>
<!-- Printable application form (shown only when printing) -->
<div class="print-form" id="printForm">
<div class="pf-head">
<img class="pf-logo" src="../logo/horizontal-logo.png" alt="Myra Global School" onerror="this.style.display='none';this.nextElementSibling.style.display='block';"/>
<div class="pf-school" style="display:none">Myra Global School</div>
<div class="pf-addr">2150 Torquay Mews, Mississauga, ON L5N 2M6 &nbsp;&bull;&nbsp; +1 (555) 012-3456 &nbsp;&bull;&nbsp; admissions@myraglobalschool.edu</div>
<div class="pf-title">Application for Admission &mdash; Session 2025&ndash;26</div>
</div>
<div class="pf-meta">
<span>Application No: <strong><?= e(app_no_fmt($app['id'])) ?></strong></span>
<span>Date: <strong><?= e(d_long($app['created_at'])) ?></strong></span>
<span>Status: <strong><?= e($sui[0]) ?></strong></span>
</div>
<table class="pf-table">
<tr class="pf-sec"><td colspan="2">Admission &amp; Student Details</td></tr>
<tr><th>Class Applying For</th><td><?= e(cls_label($app['apply_class'])) ?></td></tr>
<tr><th>Student's Full Name</th><td><?= or_dash($app['student_name']) ?></td></tr>
<tr><th>Father's Name</th><td><?= or_dash($app['father_name']) ?></td></tr>
<tr><th>Mother's Name</th><td><?= or_dash($app['mother_name']) ?></td></tr>
<tr><th>Gender</th><td><?= or_dash($app['gender']) ?></td></tr>
<tr><th>Date of Birth</th><td><?= e(d_long($app['dob'])) ?></td></tr>
<tr><th>Blood Group</th><td><?= or_dash($app['blood_group']) ?></td></tr>
<tr><th>Identification Mark</th><td><?= or_dash($app['identification_mark']) ?></td></tr>
<tr><th>Religion</th><td><?= or_dash($app['religion']) ?></td></tr>
<tr><th>Category</th><td><?= or_dash($app['category']) ?></td></tr>
<tr><th>Mother Tongue</th><td><?= or_dash($app['mother_tongue']) ?></td></tr>
<tr><th>Student's Aadhaar Number</th><td><?= or_dash($app['student_aadhaar']) ?></td></tr>
<tr><th>Last School Attended</th><td><?= or_dash($app['last_school']) ?></td></tr>
<tr class="pf-sec"><td colspan="2">Residential Address</td></tr>
<tr><th>Address</th><td><?= or_dash($app['address']) ?></td></tr>
<tr><th>City</th><td><?= or_dash($app['city']) ?></td></tr>
<tr><th>PIN Code</th><td><?= or_dash($app['pin']) ?></td></tr>
<tr><th>State</th><td><?= or_dash($app['state']) ?></td></tr>
<tr class="pf-sec"><td colspan="2">Contact Details</td></tr>
<tr><th>Phone Number</th><td><?= or_dash($app['phone']) ?></td></tr>
<tr><th>Email Address</th><td><?= or_dash($app['email']) ?></td></tr>
</table>
<div class="pf-decl">I hereby declare that the information provided above is true and correct to the best of my knowledge. I understand that any false information may lead to cancellation of admission.</div>
<div class="pf-sign">
<div>Parent / Guardian Signature</div>
<div>Principal / Admissions Office</div>
</div>
</div>
<?php endif; ?>

<!-- Footer -->
<footer class="site-footer">
<div class="container footer-grid">
<div class="footer-col footer-brand-col">
<div>
<img alt="Myra Global School Logo" class="footer-logo" src="../logo/horizontal-logo.png" onerror="this.style.display='none';this.nextElementSibling.style.display='block';"/>
<span class="footer-heading" style="display:none;color:var(--on-primary);font-family:var(--font-serif);font-size:20px;letter-spacing:0;text-transform:none;margin-bottom:8px;">Myra Global School</span>
<p class="footer-about">Fostering intellectual curiosity and moral character in a global learning community. Empowering students to lead with integrity and purpose since 1974.</p>
</div>
<div class="footer-social">
<a class="social-btn" href="#"><span class="material-symbols-outlined">share</span></a>
<a class="social-btn" href="#"><span class="material-symbols-outlined">videocam</span></a>
<a class="social-btn" href="#"><span class="material-symbols-outlined">photo_camera</span></a>
</div>
</div>
<div class="footer-col">
<h3 class="footer-heading">Academic Excellence</h3>
<ul class="footer-links">
<li><a href="../academics.php">Academics</a></li>
<li><a href="../admission.php">Admissions Process</a></li>
<li><a href="../notice.php">Notice &amp; News</a></li>
<li><a href="../gallery.php">Gallery</a></li>
<li><a href="../career.php">Careers</a></li>
</ul>
</div>
<div class="footer-col">
<h3 class="footer-heading">Community &amp; Legal</h3>
<ul class="footer-links">
<li><a href="#">Academic Resources</a></li>
<li><a href="../career.php">Careers at Myra</a></li>
<li><a href="../login.html">Parent Portal</a></li>
<li><a href="#">Contact Us</a></li>
<li><a href="#">Privacy Policy</a></li>
<li><a href="#">Terms of Service</a></li>
</ul>
</div>
<div class="footer-col footer-contact-col">
<div>
<h3 class="footer-heading">Stay Informed</h3>
<form class="footer-newsletter">
<div class="newsletter-field">
<input class="newsletter-input" placeholder="Email Address" type="email"/>
<button class="newsletter-btn" type="submit"><span class="material-symbols-outlined">arrow_forward</span></button>
</div>
<span class="footer-note">Sign up for our monthly academic newsletter.</span>
</form>
</div>
<div class="footer-contact">
<div class="footer-address-row">
<span class="material-symbols-outlined footer-loc-ico">location_on</span>
<address class="footer-address">2150 Torquay Mews,<br/>Mississauga, ON L5N 2M6</address>
</div>
<div class="footer-map">
<div class="footer-map-img" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCC9wkb5cJpu--KeH2ALKMUZqdY1fjydn7su0YqS-ots1OjNUDSHDhPuISmmpQlYArJ_wRjT2vugBAhzp7_L-pN5grRjre2kOaYN8-f3-UWox4Qaf_rWwxLuUZ3okoG0ZhX5PAnKdS7EPRl-GJffs_58nwtpcxBRTv0zTwOw3fmEcgzVO3RYocK09Q1eq3HsG-4e4zwS9EMVswq8kbLJUJIH5YX-MubTpvewA-et_AV8j3wool4nnPnpQ')"></div>
<div class="footer-map-overlay"><span class="footer-map-pill">VIEW MAP</span></div>
</div>
</div>
</div>
</div>
<div class="container footer-bottom">
<p class="footer-copy">© 2024 Myra Global School. All rights reserved.</p>
<div class="footer-badges">
<span class="footer-badge">IB WORLD SCHOOL</span>
<span class="footer-sep">|</span>
<span class="footer-badge">CAIS ACCREDITED</span>
</div>
</div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
  function download(){ window.print(); }
  var d1 = document.getElementById('downloadBtn');
  var d2 = document.getElementById('downloadBtn2');
  if (d1) d1.addEventListener('click', download);
  if (d2) d2.addEventListener('click', download);

  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });
});
</script>
</body></html>
