<?php $page_name = 'curriculum'; $base = '../'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Curriculum | Myra Global School</title>
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
.info-badge{display:inline-block;font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--secondary);margin-bottom:10px;}
.info-title{font-family:var(--font-serif);font-size:22px;font-weight:600;color:var(--primary);margin-bottom:10px;}
.info-text{font-family:var(--font-serif);font-size:15px;line-height:25px;color:var(--on-surface-variant);}
.info-ico{width:56px;height:56px;border-radius:10px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;margin-bottom:20px;}
.info-ico .material-symbols-outlined{font-size:30px;}
.info-list{margin-top:14px;display:flex;flex-direction:column;gap:8px;}
.info-list li{display:flex;gap:8px;font-family:var(--font-serif);font-size:15px;line-height:1.5;color:var(--on-surface-variant);}
.info-list .material-symbols-outlined{color:var(--secondary);font-size:18px;flex-shrink:0;margin-top:2px;}

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
  .card-grid--3{grid-template-columns:repeat(3,1fr);}
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
<span class="breadcrumb-current">Curriculum</span>
</div>
</div>
</header>

<!-- INTRO -->
<section class="acad-intro">
<div class="container">
<div class="acad-intro-inner">
<span class="eyebrow">Learning at Myra</span>
<h1 class="heading-lg">Our Curriculum</h1>
<p class="acad-intro-text">A balanced, inquiry-driven curriculum that grows with every child — from playful early years to focused board preparation — blending strong academics with creativity, values and life skills.</p>
</div>
</div>
</section>

<!-- STAGES -->
<section class="sec--alt">
<div class="container">
<div class="sec-head">
<span class="eyebrow eyebrow--tight">A Continuous Journey</span>
<h2 class="heading-lg heading-lg--flush">Stages of Learning</h2>
</div>
<div class="card-grid">

<div class="info-card">
<span class="info-badge">Nursery &ndash; UKG</span>
<h3 class="info-title">Pre-Primary</h3>
<p class="info-text">Joyful, play-based learning that builds strong foundations in language, early numeracy and social skills.</p>
<ul class="info-list">
<li><span class="material-symbols-outlined">check_circle</span> Phonics, rhymes and storytelling</li>
<li><span class="material-symbols-outlined">check_circle</span> Number sense through activities</li>
<li><span class="material-symbols-outlined">check_circle</span> Motor skills, art and music</li>
</ul>
</div>

<div class="info-card">
<span class="info-badge">Grades I &ndash; V</span>
<h3 class="info-title">Primary School</h3>
<p class="info-text">Core academics delivered through activity-based learning that keeps curiosity alive.</p>
<ul class="info-list">
<li><span class="material-symbols-outlined">check_circle</span> English, Hindi &amp; Mathematics</li>
<li><span class="material-symbols-outlined">check_circle</span> Environmental Studies &amp; Science</li>
<li><span class="material-symbols-outlined">check_circle</span> Computers, Art &amp; Physical Education</li>
</ul>
</div>

<div class="info-card">
<span class="info-badge">Grades VI &ndash; VIII</span>
<h3 class="info-title">Middle School</h3>
<p class="info-text">A broader academic base that strengthens conceptual understanding and independent thinking.</p>
<ul class="info-list">
<li><span class="material-symbols-outlined">check_circle</span> Science, Mathematics &amp; Social Science</li>
<li><span class="material-symbols-outlined">check_circle</span> Languages &amp; Information Technology</li>
<li><span class="material-symbols-outlined">check_circle</span> Projects, labs and field learning</li>
</ul>
</div>

<div class="info-card">
<span class="info-badge">Grades IX &ndash; X</span>
<h3 class="info-title">Secondary School</h3>
<p class="info-text">Focused board preparation with strong concept clarity and regular practice.</p>
<ul class="info-list">
<li><span class="material-symbols-outlined">check_circle</span> Science, Mathematics &amp; Social Science</li>
<li><span class="material-symbols-outlined">check_circle</span> English &amp; Hindi</li>
<li><span class="material-symbols-outlined">check_circle</span> Practicals, revision &amp; mentoring</li>
</ul>
</div>

<div class="info-card">
<span class="info-badge">Grades XI &ndash; XII</span>
<h3 class="info-title">Senior Secondary</h3>
<p class="info-text">Streamed learning with expert guidance to prepare students for higher education and careers.</p>
<ul class="info-list">
<li><span class="material-symbols-outlined">check_circle</span> Science stream</li>
<li><span class="material-symbols-outlined">check_circle</span> Commerce stream</li>
<li><span class="material-symbols-outlined">check_circle</span> Humanities stream</li>
</ul>
</div>

<div class="info-card">
<span class="info-badge">Beyond the Books</span>
<h3 class="info-title">Holistic Growth</h3>
<p class="info-text">Co-curricular and value education woven into the timetable at every stage.</p>
<ul class="info-list">
<li><span class="material-symbols-outlined">check_circle</span> Sports, arts and music</li>
<li><span class="material-symbols-outlined">check_circle</span> Clubs, leadership &amp; life skills</li>
<li><span class="material-symbols-outlined">check_circle</span> Values, empathy and discipline</li>
</ul>
</div>

</div>
</div>
</section>

<!-- APPROACH -->
<section class="sec" style="padding-top:96px;">
<div class="container">
<div class="sec-head">
<span class="eyebrow eyebrow--tight">How We Teach</span>
<h2 class="heading-lg heading-lg--flush">Our Teaching Approach</h2>
<p class="sec-sub" style="margin-top:16px;">Learning at Myra is active, personal and rooted in understanding rather than rote.</p>
</div>
<div class="card-grid card-grid--3">
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">psychology</span></div>
<h3 class="info-title">Concept-First</h3>
<p class="info-text">Ideas are built from the ground up, so students truly understand the "why" behind every topic.</p>
</div>
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">groups</span></div>
<h3 class="info-title">Activity-Based</h3>
<p class="info-text">Hands-on projects, experiments and discussion turn classrooms into spaces of discovery.</p>
</div>
<div class="info-card">
<div class="info-ico"><span class="material-symbols-outlined">smart_display</span></div>
<h3 class="info-title">Technology-Enabled</h3>
<p class="info-text">Smart boards and digital resources make lessons engaging, visual and easy to grasp.</p>
</div>
</div>
</div>
</section>

<?php include '../components/footer.php'; ?>
</body></html>
