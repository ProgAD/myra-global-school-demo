<?php $page_name = 'academics'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Academics | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet"/>
<link href="css/footer.css" rel="stylesheet"/>
<script src="js/nav.js" defer></script>
<style>
/* ============================================================
   DESIGN TOKENS
   ============================================================ */
:root{
  --primary-container:#002147;
  --secondary-fixed:#ffe088;
  --secondary-fixed-dim:#e9c349;
  --on-surface-variant:#44474e;
  --on-background:#1e1b18;
  --on-primary:#ffffff;
  --primary:#000a1e;
  --on-secondary-fixed:#241a00;
  --secondary:#735c00;
  --surface:#fff8f5;
  --surface-container-low:#fbf2ed;
  --surface-container:#f5ece7;
  --surface-container-high:#efe6e2;
  --surface-container-highest:#e9e1dc;
  --surface-container-lowest:#ffffff;
  --background:#fff8f5;
  --on-surface:#1e1b18;
  --on-primary-container:#708ab5;
  --outline:#74777f;
  --outline-variant:#c4c6cf;
  --font-serif:"Source Serif 4", Georgia, serif;
  --font-sans:"Source Sans 3", system-ui, sans-serif;
}

/* ============================================================
   RESET / BASE
   ============================================================ */
*,*::before,*::after{box-sizing:border-box;}
*{margin:0;}
html{scroll-behavior:smooth;}
body{
  background:var(--background);
  color:var(--on-background);
  font-family:var(--font-serif);
  font-size:16px;
  line-height:1.5;
  -webkit-font-smoothing:antialiased;
}
img{display:block;max-width:100%;}
a{text-decoration:none;color:inherit;}
ul{list-style:none;}
button{font-family:inherit;background:none;border:none;}
address{font-style:normal;}
.material-symbols-outlined{
  font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
  display:inline-block;
  vertical-align:middle;
}

/* ============================================================
   LAYOUT HELPERS
   ============================================================ */
.container{
  max-width:1280px;
  margin-left:auto;
  margin-right:auto;
  padding-left:64px;
  padding-right:64px;
  width:100%;
}
.eyebrow{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  color:var(--secondary);
  text-transform:uppercase;
  letter-spacing:.2em;
  display:block;
  margin-bottom:12px;
}
.eyebrow--gold{color:var(--secondary-fixed);}
.heading-lg{
  font-family:var(--font-serif);
  font-size:40px;
  line-height:48px;
  font-weight:700;
  color:var(--primary);
  margin-bottom:24px;
}
.heading-lg--light{color:var(--on-primary);}
.heading-lg--flush{margin-bottom:0;}

/* Buttons */
.btn-fill{
  background:var(--primary-container);
  color:var(--on-primary);
  padding:12px 32px;
  border-radius:8px;
  font-family:var(--font-sans);
  font-size:16px;
  cursor:pointer;
  transition:all .2s;
}
.btn-fill:hover{background:var(--primary);}
.btn-line{
  background:transparent;
  border:1px solid var(--primary);
  color:var(--primary);
  padding:12px 32px;
  border-radius:8px;
  font-family:var(--font-sans);
  font-size:16px;
  cursor:pointer;
  transition:all .2s;
}
.btn-line:hover{background:var(--primary);color:var(--on-primary);}

/* ============================================================
   PAGE BANNER / BREADCRUMB
   ============================================================ */
.page-banner{
  position:relative;
  width:100%;
  height:50px;
  overflow:hidden;
  display:flex;
  align-items:center;
  background:var(--primary-container);
}
.breadcrumb{
  display:flex;
  align-items:center;
  gap:8px;
  font-family:var(--font-sans);
  font-size:16px;
  color:var(--on-primary-container);
}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

/* ============================================================
   ACADEMICS HERO SLIDESHOW
   ============================================================ */
.acad-hero{position:relative;height:540px;overflow:hidden;background:var(--primary-container);}
.acad-hero-slides{position:absolute;inset:0;}
.acad-hero-slide{position:absolute;inset:0;background-size:cover;background-position:center;opacity:0;animation:acadHeroFade 24s infinite;}
.acad-hero-slide:nth-child(1){animation-delay:0s;}
.acad-hero-slide:nth-child(2){animation-delay:6s;}
.acad-hero-slide:nth-child(3){animation-delay:12s;}
.acad-hero-slide:nth-child(4){animation-delay:18s;}
@keyframes acadHeroFade{0%{opacity:0;}2%{opacity:1;}25%{opacity:1;}27%{opacity:0;}100%{opacity:0;}}
.acad-hero-overlay{position:absolute;inset:0;z-index:1;background:linear-gradient(90deg,rgba(0,10,30,.88) 0%,rgba(0,20,45,.62) 58%,rgba(0,20,45,.35) 100%);}
.acad-hero-content{position:relative;z-index:2;height:100%;display:flex;flex-direction:column;justify-content:center;max-width:680px;}
.acad-hero-title{font-family:var(--font-serif);font-size:56px;line-height:1.1;font-weight:700;color:var(--on-primary);margin-bottom:16px;}
.acad-hero-sub{font-family:var(--font-serif);font-size:19px;line-height:30px;color:rgba(255,255,255,.85);}
.acad-hero-dots{position:absolute;left:0;right:0;bottom:24px;z-index:2;display:flex;justify-content:center;gap:10px;}
.acad-hero-dots span{width:9px;height:9px;border-radius:50%;background:rgba(255,255,255,.4);animation:acadDot 24s infinite;}
.acad-hero-dots span:nth-child(1){animation-delay:0s;}
.acad-hero-dots span:nth-child(2){animation-delay:6s;}
.acad-hero-dots span:nth-child(3){animation-delay:12s;}
.acad-hero-dots span:nth-child(4){animation-delay:18s;}
@keyframes acadDot{0%,25%{background:var(--secondary-fixed);}27%,100%{background:rgba(255,255,255,.4);}}
@media(prefers-reduced-motion:reduce){
  .acad-hero-slide{animation:none;}
  .acad-hero-slide:nth-child(1){opacity:1;}
  .acad-hero-dots{display:none;}
}
@media(max-width:767px){
  .acad-hero{height:440px;}
  .acad-hero-title{font-size:38px;}
  .acad-hero-sub{font-size:16px;line-height:26px;}
}

/* ============================================================
   INTRO SECTION
   ============================================================ */
.acad-intro{padding-top:120px;padding-bottom:64px;background:var(--surface);}
.acad-intro-inner{text-align:center;max-width:768px;margin:0 auto;}
.acad-intro-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}

/* ============================================================
   ACADEMIC OPTIONS GRID
   ============================================================ */
.acad-options{padding:96px 0 120px;background:var(--surface);}
.acad-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.acad-card{
  border:1px solid var(--outline-variant);
  border-radius:12px;
  background:var(--surface-container-lowest);
  display:flex;
  flex-direction:column;
  overflow:hidden;
  transition:border-color .3s, box-shadow .3s;
}
.acad-card:hover{border-color:var(--primary);box-shadow:0 4px 20px rgba(0,33,71,.08);}
.acad-card-media{height:200px;overflow:hidden;background:var(--surface-container);}
.acad-card-media img{width:100%;height:100%;object-fit:cover;transition:transform .5s;}
.acad-card:hover .acad-card-media img{transform:scale(1.06);}
.acad-card-body{padding:40px;display:flex;flex-direction:column;flex:1;}
.acad-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;}
.acad-card-ico{
  width:64px;
  height:64px;
  background:var(--primary-container);
  color:var(--secondary-fixed);
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:8px;
  transition:all .3s;
}
.acad-card:hover .acad-card-ico{background:var(--secondary-fixed);color:var(--primary);}
.acad-card-ico .material-symbols-outlined{font-size:34px;}
.acad-card-arrow{color:var(--on-surface-variant);transition:all .3s;}
.acad-card:hover .acad-card-arrow{color:var(--primary);transform:translateX(4px);}
.acad-card-title{font-family:var(--font-serif);font-size:24px;line-height:1.3;font-weight:600;color:var(--primary);margin-bottom:12px;}
.acad-card-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}

/* ============================================================
   STATS STRIP (dark)
   ============================================================ */
.stats-sec{padding:120px 0;background:var(--primary-container);color:var(--on-primary);}
.stats-head{text-align:center;margin-bottom:64px;}
.stats-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:32px;}
.stat{text-align:center;}
.stat-num{font-family:var(--font-serif);font-size:64px;line-height:72px;font-weight:700;color:var(--secondary-fixed);margin-bottom:8px;}
.stat-label{font-family:var(--font-sans);font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--on-primary-container);}

/* ============================================================
   CTA STRIP
   ============================================================ */
.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;justify-content:space-between;gap:24px;padding:64px 0;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;gap:16px;flex-shrink:0;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(min-width:768px){
  .acad-grid{grid-template-columns:repeat(2,1fr);}
  .stats-grid{grid-template-columns:repeat(4,1fr);}
  .cta-inner{flex-direction:row;text-align:left;}
}
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<?php include 'components/header.php';?>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Academics</span>
</div>
</div>
</header>

<!-- ACADEMICS HERO SLIDESHOW -->
<section class="acad-hero">
<div class="acad-hero-slides">
<div class="acad-hero-slide" style="background-image:url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1600&q=80')"></div>
<div class="acad-hero-slide" style="background-image:url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1600&q=80')"></div>
<div class="acad-hero-slide" style="background-image:url('https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=1600&q=80')"></div>
<div class="acad-hero-slide" style="background-image:url('https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=1600&q=80')"></div>
</div>
<div class="acad-hero-overlay"></div>
<div class="container acad-hero-content">
<span class="eyebrow eyebrow--gold">Learning at Myra</span>
<h1 class="acad-hero-title">Academics</h1>
<p class="acad-hero-sub">From hands-on lab work to reading, sports and creative play, learning at Myra Global School comes alive — nurturing curious, confident and capable young minds.</p>
</div>
<div class="acad-hero-dots" aria-hidden="true"><span></span><span></span><span></span><span></span></div>
</section>

<!-- ACADEMIC OPTIONS GRID -->
<section class="acad-options">
<div class="container">
<div class="acad-grid">

<!-- Curriculum -->
<a href="academics/curriculum.php" class="acad-card">
<div class="acad-card-media"><img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80" alt="Curriculum" loading="lazy"/></div>
<div class="acad-card-body">
<div class="acad-card-top">
<span class="acad-card-ico"><span class="material-symbols-outlined">menu_book</span></span>
<span class="material-symbols-outlined acad-card-arrow">arrow_forward</span>
</div>
<h3 class="acad-card-title">Curriculum</h3>
<p class="acad-card-text">A balanced, inquiry-driven curriculum from Lower to Upper School, blending core academics with critical thinking and life skills.</p>
</div>
</a>

<!-- Examinations -->
<a href="academics/examinations.php" class="acad-card">
<div class="acad-card-media"><img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80" alt="Examinations" loading="lazy"/></div>
<div class="acad-card-body">
<div class="acad-card-top">
<span class="acad-card-ico"><span class="material-symbols-outlined">assignment</span></span>
<span class="material-symbols-outlined acad-card-arrow">arrow_forward</span>
</div>
<h3 class="acad-card-title">Examinations</h3>
<p class="acad-card-text">Continuous assessment, transparent evaluation and detailed progress reporting that support every learner's growth.</p>
</div>
</a>

<!-- Facilities -->
<a href="academics/facilities.php" class="acad-card">
<div class="acad-card-media"><img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800&q=80" alt="Facilities" loading="lazy"/></div>
<div class="acad-card-body">
<div class="acad-card-top">
<span class="acad-card-ico"><span class="material-symbols-outlined">apartment</span></span>
<span class="material-symbols-outlined acad-card-arrow">arrow_forward</span>
</div>
<h3 class="acad-card-title">Facilities</h3>
<p class="acad-card-text">Smart classrooms, science &amp; computer labs, libraries, sports grounds and secure transport — everything learning needs.</p>
</div>
</a>

<!-- Rules & Regulations -->
<a href="academics/rules-regulations.php" class="acad-card">
<div class="acad-card-media"><img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&q=80" alt="Rules and Regulations" loading="lazy"/></div>
<div class="acad-card-body">
<div class="acad-card-top">
<span class="acad-card-ico"><span class="material-symbols-outlined">gavel</span></span>
<span class="material-symbols-outlined acad-card-arrow">arrow_forward</span>
</div>
<h3 class="acad-card-title">Rules &amp; Regulations</h3>
<p class="acad-card-text">A clear framework of discipline, uniform code and conduct that nurtures respect, responsibility and a safe community.</p>
</div>
</a>

</div>
</div>
</section>

<!-- STATS STRIP -->
<section class="stats-sec">
  <div class="container">
  <div class="stats-head">
  <span class="eyebrow eyebrow--gold">Academic Strength</span>
  <h2 class="heading-lg heading-lg--light heading-lg--flush">Excellence by the Numbers</h2>
  </div>
  <div class="stats-grid">
  <div class="stat">
  <div class="stat-num">100%</div>
  <div class="stat-label">Board Exam Pass Rate</div>
  </div>
  <div class="stat">
  <div class="stat-num">25:1</div>
  <div class="stat-label">Student-Teacher Ratio</div>
  </div>
  <div class="stat">
  <div class="stat-num">15+</div>
  <div class="stat-label">Co-Curricular Activities</div>
  </div>
  <div class="stat">
  <div class="stat-num">20+</div>
  <div class="stat-label">Sports & Clubs</div>
  </div>
  </div>
  </div>
</section>

<!-- CTA STRIP -->
<section class="cta-sec">
<div class="container cta-inner">
<div>
<h2 class="cta-title">Have a Question ?</h2>
<p class="cta-text">Our school team is happy to guide you through admissions and more.</p>
</div>
<div class="cta-actions">
<button class="btn-fill" onclick="window.location.href='admission.php'">Admission Open</button>
<button class="btn-line" onclick="window.location.href='index.php/#enquiry'">Contact Us</button>
</div>
</div>
</section>

<!-- Footer -->
<?php include 'components/footer.php';?>
<!-- Interactive Layer for Micro-interactions -->
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.classList.add('academic-shadow');
                });
                input.addEventListener('blur', () => {
                    input.parentElement.classList.remove('academic-shadow');
                });
            });

            // Smooth Hover transitions for footer links
            const footerLinks = document.querySelectorAll('footer a');
            footerLinks.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    link.style.transform = 'translateX(4px)';
                });
                link.addEventListener('mouseleave', () => {
                    link.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body></html>
