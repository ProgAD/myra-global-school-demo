<?php $page_name = 'examinations'; $base = '../'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Examinations | Myra Global School</title>
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
button{font-family:inherit;background:none;border:none;}
.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;display:inline-block;vertical-align:middle;}
.container{max-width:1280px;margin:0 auto;padding-left:64px;padding-right:64px;width:100%;}
.eyebrow{font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--secondary);text-transform:uppercase;letter-spacing:.2em;display:block;margin-bottom:12px;}
.eyebrow--gold{color:var(--secondary-fixed);}
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:24px;}
.heading-lg--light{color:var(--on-primary);}
.heading-lg--flush{margin-bottom:0;}
.btn-fill{background:var(--primary-container);color:var(--on-primary);padding:12px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;cursor:pointer;transition:all .2s;}
.btn-fill:hover{background:var(--primary);}
.btn-line{background:transparent;border:1px solid var(--primary);color:var(--primary);padding:12px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;cursor:pointer;transition:all .2s;}
.btn-line:hover{background:var(--primary);color:var(--on-primary);}

.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);flex-wrap:wrap;}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

.acad-intro{padding:88px 0 56px;background:var(--surface);text-align:center;}
.acad-intro-inner{max-width:820px;margin:0 auto;}
.acad-intro-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}

.sec{padding:0 0 96px;background:var(--surface);}
.sec--alt{background:var(--surface-container);padding:96px 0;}
.sec-head{max-width:760px;margin:0 auto 48px;text-align:center;}
.sec-sub{font-family:var(--font-serif);font-size:17px;line-height:28px;color:var(--on-surface-variant);}

.card-grid{display:grid;grid-template-columns:1fr;gap:24px;}
.info-card{border:1px solid var(--outline-variant);border-radius:12px;padding:32px;background:var(--surface-container-lowest);transition:border-color .3s,box-shadow .3s;}
.info-card:hover{border-color:var(--primary);box-shadow:0 4px 20px rgba(0,33,71,.08);}
.info-title{font-family:var(--font-serif);font-size:22px;font-weight:600;color:var(--primary);margin-bottom:10px;}
.info-text{font-family:var(--font-serif);font-size:15px;line-height:25px;color:var(--on-surface-variant);}
.info-ico{width:56px;height:56px;border-radius:10px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;margin-bottom:20px;}
.info-ico .material-symbols-outlined{font-size:30px;}

.table-wrap{overflow-x:auto;border:1px solid var(--outline-variant);border-radius:12px;background:var(--surface-container-lowest);}
.grade-table{width:100%;border-collapse:collapse;min-width:420px;}
.grade-table th,.grade-table td{padding:14px 20px;text-align:left;font-family:var(--font-sans);font-size:15px;border-bottom:1px solid var(--outline-variant);}
.grade-table thead th{background:var(--primary-container);color:var(--on-primary);font-weight:600;letter-spacing:.03em;}
.grade-table tbody tr:last-child td{border-bottom:none;}
.grade-table tbody tr:nth-child(even){background:var(--surface-container-low);}
.grade-table td:first-child{font-weight:700;color:var(--primary);}

.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;justify-content:space-between;gap:24px;padding:64px 0;text-align:center;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;gap:16px;flex-shrink:0;}

@media(min-width:768px){
  .card-grid{grid-template-columns:repeat(2,1fr);}
  .cta-inner{flex-direction:row;text-align:left;}
}
@media(min-width:1024px){
  .card-grid--4{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:767px){
  .container{padding-left:20px;padding-right:20px;}
  .heading-lg{font-size:28px;line-height:36px;}
  .sec--alt{padding:64px 0;}
  .sec{padding-bottom:64px;}
}
</style>
</head>
<body>
<?php include '../components/header.php'; ?>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="../index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<a href="../academics.php">Academics</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Examinations</span>
</div>
</div>
</header>

<!-- INTRO -->
<section class="acad-intro">
<div class="container">
<div class="acad-intro-inner">
<span class="eyebrow">Assessment at Myra</span>
<h1 class="heading-lg">Examinations &amp; Assessment</h1>
<p class="acad-intro-text">We follow a continuous and comprehensive approach to assessment — measuring not just marks, but understanding, effort and all-round growth, with clear reporting to parents throughout the year.</p>
</div>
</div>
</section>

<!-- ASSESSMENT COMPONENTS -->
<section class="sec--alt">
<div class="container">
<div class="sec-head">
<span class="eyebrow eyebrow--tight">How We Assess</span>
<h2 class="heading-lg heading-lg--flush">A Balanced Evaluation</h2>
</div>
<div class="card-grid card-grid--4">
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">quiz</span></div>
<h3 class="info-title">Periodic Tests</h3>
<p class="info-text">Regular short assessments that track progress and keep learning on course.</p>
</div>
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">assignment</span></div>
<h3 class="info-title">Term Examinations</h3>
<p class="info-text">Structured half-yearly and annual exams that consolidate a term's learning.</p>
</div>
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">science</span></div>
<h3 class="info-title">Practical &amp; Projects</h3>
<p class="info-text">Lab work, projects and presentations that reward application and creativity.</p>
</div>
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">emoji_events</span></div>
<h3 class="info-title">Internal Assessment</h3>
<p class="info-text">Class participation, discipline and co-curricular effort recognised year-round.</p>
</div>
</div>
</div>
</section>

<!-- GRADING SCALE -->
<section class="sec" style="padding-top:96px;">
<div class="container">
<div class="sec-head">
<span class="eyebrow eyebrow--tight">Transparent Reporting</span>
<h2 class="heading-lg heading-lg--flush">Grading Scale</h2>
<p class="sec-sub" style="margin-top:16px;">Marks are converted into grades to give a clear, balanced picture of every student's performance.</p>
</div>
<div class="table-wrap" style="max-width:640px;margin:0 auto;">
<table class="grade-table">
<thead><tr><th>Grade</th><th>Marks Range</th><th>Description</th></tr></thead>
<tbody>
<tr><td>A1</td><td>91 &ndash; 100</td><td>Outstanding</td></tr>
<tr><td>A2</td><td>81 &ndash; 90</td><td>Excellent</td></tr>
<tr><td>B1</td><td>71 &ndash; 80</td><td>Very Good</td></tr>
<tr><td>B2</td><td>61 &ndash; 70</td><td>Good</td></tr>
<tr><td>C1</td><td>51 &ndash; 60</td><td>Fair</td></tr>
<tr><td>C2</td><td>41 &ndash; 50</td><td>Satisfactory</td></tr>
<tr><td>D</td><td>33 &ndash; 40</td><td>Needs Improvement</td></tr>
</tbody>
</table>
</div>
</div>
</section>

<!-- POLICIES -->
<section class="sec--alt" style="padding-top:0;">
<div class="container" style="padding-top:96px;">
<div class="card-grid">
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">trending_up</span></div>
<h3 class="info-title">Promotion Policy</h3>
<p class="info-text">Promotion is based on overall performance across the year — combining term examinations, periodic tests, practicals and internal assessment — so a single exam never defines a child.</p>
</div>
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">family_history</span></div>
<h3 class="info-title">Parent Reporting</h3>
<p class="info-text">Detailed report cards and regular parent-teacher meetings keep families informed about their child's academic progress and areas to support at home.</p>
</div>
</div>
</div>
</section>

<?php include '../components/footer.php'; ?>
</body></html>
