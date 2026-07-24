<?php $page_name = 'rules-regulations'; $base = '../'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Rules &amp; Regulations | Myra Global School</title>
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

.sec--alt{background:var(--surface-container);padding:96px 0;}
.sec-head{max-width:760px;margin:0 auto 48px;text-align:center;}

.rule-grid{display:grid;grid-template-columns:1fr;gap:24px;}
.rule-card{border:1px solid var(--outline-variant);border-radius:12px;padding:32px;background:var(--surface-container-lowest);}
.rule-head{display:flex;align-items:center;gap:14px;margin-bottom:18px;}
.rule-ico{width:48px;height:48px;border-radius:10px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.rule-ico .material-symbols-outlined{font-size:26px;}
.rule-title{font-family:var(--font-serif);font-size:20px;font-weight:600;color:var(--primary);}
.rule-list{display:flex;flex-direction:column;gap:12px;}
.rule-list li{display:flex;gap:10px;font-family:var(--font-serif);font-size:15px;line-height:1.55;color:var(--on-surface-variant);}
.rule-list .material-symbols-outlined{color:var(--secondary);font-size:18px;flex-shrink:0;margin-top:2px;}

.note-band{background:var(--primary-container);color:var(--on-primary);border-radius:12px;padding:36px 40px;display:flex;gap:18px;align-items:flex-start;}
.note-band .material-symbols-outlined{color:var(--secondary-fixed);font-size:32px;flex-shrink:0;}
.note-band p{font-family:var(--font-serif);font-size:16px;line-height:27px;opacity:.9;}

.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;justify-content:space-between;gap:24px;padding:64px 0;text-align:center;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;gap:16px;flex-shrink:0;}

@media(min-width:768px){
  .rule-grid{grid-template-columns:repeat(2,1fr);}
  .cta-inner{flex-direction:row;text-align:left;}
}
@media(max-width:767px){
  .container{padding-left:20px;padding-right:20px;}
  .heading-lg{font-size:28px;line-height:36px;}
  .sec--alt{padding:64px 0;}
  .note-band{padding:28px 24px;}
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
<span class="breadcrumb-current">Rules &amp; Regulations</span>
</div>
</div>
</header>

<!-- INTRO -->
<section class="acad-intro">
<div class="container">
<div class="acad-intro-inner">
<span class="eyebrow">Discipline &amp; Conduct</span>
<h1 class="heading-lg">Rules &amp; Regulations</h1>
<p class="acad-intro-text">A clear, caring framework of expectations that helps every student grow with discipline, respect and responsibility — and keeps our school community safe and happy.</p>
</div>
</div>
</section>

<!-- RULES -->
<section class="sec--alt">
<div class="container">
<div class="sec-head">
<span class="eyebrow eyebrow--tight">What We Expect</span>
<h2 class="heading-lg heading-lg--flush">School Guidelines</h2>
</div>
<div class="rule-grid">

<div class="rule-card">
<div class="rule-head">
<span class="rule-ico"><span class="material-symbols-outlined">schedule</span></span>
<h3 class="rule-title">Attendance &amp; Punctuality</h3>
</div>
<ul class="rule-list">
<li><span class="material-symbols-outlined">check_circle</span> Students must reach school before the assembly bell.</li>
<li><span class="material-symbols-outlined">check_circle</span> A minimum of 75% attendance is expected through the year.</li>
<li><span class="material-symbols-outlined">check_circle</span> Leave must be applied for in advance with a written note.</li>
</ul>
</div>

<div class="rule-card">
<div class="rule-head">
<span class="rule-ico"><span class="material-symbols-outlined">checkroom</span></span>
<h3 class="rule-title">Uniform &amp; Appearance</h3>
</div>
<ul class="rule-list">
<li><span class="material-symbols-outlined">check_circle</span> The prescribed school uniform must be worn neatly every day.</li>
<li><span class="material-symbols-outlined">check_circle</span> Students should be well-groomed with proper footwear.</li>
<li><span class="material-symbols-outlined">check_circle</span> Expensive jewellery and valuables should be avoided.</li>
</ul>
</div>

<div class="rule-card">
<div class="rule-head">
<span class="rule-ico"><span class="material-symbols-outlined">handshake</span></span>
<h3 class="rule-title">General Conduct</h3>
</div>
<ul class="rule-list">
<li><span class="material-symbols-outlined">check_circle</span> Treat teachers, staff and peers with courtesy and respect.</li>
<li><span class="material-symbols-outlined">check_circle</span> Speak politely and maintain silence in corridors and the library.</li>
<li><span class="material-symbols-outlined">check_circle</span> Take pride in keeping the campus clean and litter-free.</li>
</ul>
</div>

<div class="rule-card">
<div class="rule-head">
<span class="rule-ico"><span class="material-symbols-outlined">menu_book</span></span>
<h3 class="rule-title">Academics &amp; Discipline</h3>
</div>
<ul class="rule-list">
<li><span class="material-symbols-outlined">check_circle</span> Homework and assignments must be completed on time.</li>
<li><span class="material-symbols-outlined">check_circle</span> Bring all required books and material as per the timetable.</li>
<li><span class="material-symbols-outlined">check_circle</span> The school diary should be carried and signed regularly.</li>
</ul>
</div>

<div class="rule-card">
<div class="rule-head">
<span class="rule-ico"><span class="material-symbols-outlined">shield</span></span>
<h3 class="rule-title">Safety &amp; Care</h3>
</div>
<ul class="rule-list">
<li><span class="material-symbols-outlined">check_circle</span> Mobile phones and electronic gadgets are not permitted.</li>
<li><span class="material-symbols-outlined">check_circle</span> Students must not leave the campus without permission.</li>
<li><span class="material-symbols-outlined">check_circle</span> Any damage to school property should be reported at once.</li>
</ul>
</div>

<div class="rule-card">
<div class="rule-head">
<span class="rule-ico"><span class="material-symbols-outlined">forum</span></span>
<h3 class="rule-title">School &amp; Home</h3>
</div>
<ul class="rule-list">
<li><span class="material-symbols-outlined">check_circle</span> Parents are encouraged to attend parent-teacher meetings.</li>
<li><span class="material-symbols-outlined">check_circle</span> Circulars and notices should be read and acknowledged.</li>
<li><span class="material-symbols-outlined">check_circle</span> Concerns may be shared with the class teacher or office.</li>
</ul>
</div>

</div>

<div class="note-band" style="margin-top:40px;">
<span class="material-symbols-outlined">info</span>
<p>These guidelines are intended to build a culture of respect, responsibility and safety. The school may update its rules from time to time; any changes will be communicated to parents and students through official circulars.</p>
</div>
</div>
</section>

<?php include '../components/footer.php'; ?>
</body></html>
