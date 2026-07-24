<?php $page_name = 'facilities'; $base = '../'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Facilities | Myra Global School</title>
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
.fac-card{border:1px solid var(--outline-variant);border-radius:12px;padding:32px;background:var(--surface-container-lowest);transition:border-color .3s,box-shadow .3s,transform .3s;}
.fac-card:hover{border-color:var(--primary);box-shadow:0 4px 20px rgba(0,33,71,.08);transform:translateY(-4px);}
.fac-ico{width:56px;height:56px;border-radius:10px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;margin-bottom:20px;transition:all .3s;}
.fac-card:hover .fac-ico{background:var(--secondary-fixed);color:var(--primary);}
.fac-ico .material-symbols-outlined{font-size:30px;}
.fac-title{font-family:var(--font-serif);font-size:21px;font-weight:600;color:var(--primary);margin-bottom:10px;}
.fac-text{font-family:var(--font-serif);font-size:15px;line-height:25px;color:var(--on-surface-variant);}

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
  .card-grid{grid-template-columns:repeat(3,1fr);}
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
<span class="breadcrumb-current">Facilities</span>
</div>
</div>
</header>

<!-- INTRO -->
<section class="acad-intro">
<div class="container">
<div class="acad-intro-inner">
<span class="eyebrow">Campus &amp; Infrastructure</span>
<h1 class="heading-lg">Our Facilities</h1>
<p class="acad-intro-text">A safe, well-equipped and inspiring campus where every space — from classrooms to playgrounds — is designed to help students learn, explore and thrive.</p>
</div>
</div>
</section>

<!-- FACILITIES GRID -->
<section class="sec--alt">
<div class="container">
<div class="sec-head">
<span class="eyebrow eyebrow--tight">Everything Learning Needs</span>
<h2 class="heading-lg heading-lg--flush">Built for Curious Minds</h2>
</div>
<div class="card-grid">

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">co_present</span></div>
<h3 class="fac-title">Smart Classrooms</h3>
<p class="fac-text">Spacious, well-lit classrooms with interactive digital boards that make every lesson engaging and easy to follow.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">science</span></div>
<h3 class="fac-title">Science Laboratories</h3>
<p class="fac-text">Dedicated Physics, Chemistry and Biology labs where students learn by observing and experimenting first-hand.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">computer</span></div>
<h3 class="fac-title">Computer Lab</h3>
<p class="fac-text">Modern computer lab with internet access that builds digital literacy from an early age.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">menu_book</span></div>
<h3 class="fac-title">Library</h3>
<p class="fac-text">A well-stocked library of books, references and periodicals that nurtures a lifelong love of reading.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">sports_soccer</span></div>
<h3 class="fac-title">Sports &amp; Playground</h3>
<p class="fac-text">Open grounds and courts for a range of indoor and outdoor games that build fitness and teamwork.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">directions_bus</span></div>
<h3 class="fac-title">Transport</h3>
<p class="fac-text">A safe, GPS-enabled fleet of buses with trained staff, covering key routes across the city.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">medical_services</span></div>
<h3 class="fac-title">Medical Care</h3>
<p class="fac-text">An on-campus infirmary and first-aid support to look after students' health and safety through the day.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">theater_comedy</span></div>
<h3 class="fac-title">Activity &amp; Arts Room</h3>
<p class="fac-text">Dedicated spaces for music, dance, art and craft where creativity and self-expression flourish.</p>
</div>

<div class="fac-card">
<div class="fac-ico"><span class="material-symbols-outlined">shield</span></div>
<h3 class="fac-title">Safe &amp; Secure Campus</h3>
<p class="fac-text">CCTV surveillance, secure entry and a caring staff ensure a protected environment for every child.</p>
</div>

</div>
</div>
</section>

<!-- CTA -->
<section class="cta-sec">
<div class="container cta-inner">
<div>
<h2 class="cta-title">Come see our campus for yourself.</h2>
<p class="cta-text">Reach out to arrange a visit or learn more about admissions.</p>
</div>
<div class="cta-actions">
<button class="btn-fill" onclick="window.location.href='../admission.php'">Apply Now</button>
<button class="btn-line" onclick="window.location.href='../index.php#enquiry'">Contact Us</button>
</div>
</div>
</section>

<?php include '../components/footer.php'; ?>
</body></html>
