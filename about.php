<?php $page_name = 'about'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>About Us | Myra Global School</title>
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
.section-lg{padding:120px 0;}
.eyebrow{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  color:var(--secondary);
  text-transform:uppercase;
  letter-spacing:.2em;
  display:block;
  margin-bottom:16px;
}
.eyebrow--tight{margin-bottom:12px;}
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
   HERITAGE SECTION
   ============================================================ */
.about-sec{background:var(--surface);}
.about-grid{display:grid;grid-template-columns:1fr;gap:120px;align-items:center;}
.about-media{position:relative;}
.about-img{
  width:100%;
  height:500px;
  object-fit:cover;
  border-radius:8px;
  box-shadow:0 20px 25px -5px rgba(0,0,0,.1),0 8px 10px -6px rgba(0,0,0,.1);
}
.about-badge{
  position:absolute;
  bottom:-40px;
  right:-40px;
  background:var(--primary-container);
  padding:48px;
  color:var(--on-primary);
  border-radius:8px;
  display:none;
}
.about-badge-num{font-family:var(--font-serif);font-size:64px;line-height:72px;font-weight:700;}
.about-badge-label{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  text-transform:uppercase;
  letter-spacing:.1em;
  opacity:.7;
}
.about-lead{
  font-family:var(--font-serif);
  font-size:20px;
  line-height:32px;
  color:var(--on-surface-variant);
  margin-bottom:24px;
}
.about-text{
  font-family:var(--font-serif);
  font-size:16px;
  line-height:26px;
  color:var(--on-surface-variant);
  margin-bottom:32px;
}
.about-features{display:grid;grid-template-columns:1fr 1fr;gap:24px;}
.about-feature{display:flex;align-items:flex-start;gap:12px;}
.about-feature-ico{color:var(--secondary);font-size:30px;}
.about-feature-title{font-family:var(--font-sans);font-size:16px;font-weight:600;color:var(--primary);line-height:1.4;}
.about-feature-text{font-family:var(--font-serif);font-size:15px;line-height:1.5;color:var(--on-surface-variant);}

/* ============================================================
   MISSION & VISION
   ============================================================ */
.mv-sec{background:var(--surface-container);}
.mv-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.mv-card{
  padding:64px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  height:100%;
  border-radius:12px;
  scroll-margin-top:96px;
}
.mv-card--dark{background:var(--primary-container);color:var(--on-primary);}
.mv-card--light{background:var(--surface-container-lowest);border:1px solid var(--outline-variant);}
.mv-ico{font-size:48px;margin-bottom:24px;}
.mv-ico--gold{color:var(--secondary-fixed);}
.mv-ico--primary{color:var(--primary);}
.mv-text{font-family:var(--font-serif);font-size:20px;line-height:32px;}
.mv-card--dark .mv-text{opacity:.8;font-style:italic;}
.mv-card--light .mv-text{color:var(--on-surface-variant);}

/* ============================================================
   CORE VALUES
   ============================================================ */
.values-sec{background:var(--surface);}
.values-head{text-align:center;margin-bottom:64px;}
.values-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.value-card{
  border:1px solid var(--outline-variant);
  padding:40px;
  border-radius:8px;
  display:flex;
  flex-direction:column;
  transition:border-color .3s;
}
.value-card--alt{background:var(--surface-container-lowest);}
.value-card:hover{border-color:var(--primary);}
.value-ico{font-size:48px;color:var(--primary);margin-bottom:24px;transition:transform .3s;}
.value-card:hover .value-ico{transform:scale(1.1);}
.value-title{font-family:var(--font-serif);font-size:22px;line-height:1.3;font-weight:600;color:var(--primary);margin-bottom:12px;}
.value-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}

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
   LEADERSHIP MESSAGE
   ============================================================ */
.leader-sec{background:var(--surface);}
.leader-grid{display:grid;grid-template-columns:repeat(12,1fr);gap:32px;align-items:center;}
.leader-media{grid-column:span 12;position:relative;}
.leader-photo{
  aspect-ratio:4/5;
  background-size:cover;
  background-position:center;
  border:1px solid var(--outline-variant);
  border-radius:8px;
}
.leader-quote-badge{
  position:absolute;
  bottom:-24px;
  right:-24px;
  background:var(--secondary-fixed);
  padding:32px;
  border-radius:8px;
  display:none;
}
.leader-quote-badge .material-symbols-outlined{font-size:40px;color:var(--on-secondary-fixed);}
.leader-body{grid-column:span 12;}
.leader-quote{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface);margin-bottom:24px;font-style:italic;}
.leader-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);margin-bottom:32px;}
.leader-name{font-family:var(--font-serif);font-size:20px;line-height:1.3;font-weight:600;color:var(--primary);}
.leader-role{font-family:var(--font-sans);font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:.1em;color:var(--secondary);}

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
  .about-grid{grid-template-columns:1fr 1fr;}
  .mv-grid{grid-template-columns:1fr 1fr;}
  .values-grid{grid-template-columns:repeat(2,1fr);}
  .stats-grid{grid-template-columns:repeat(4,1fr);}
  .leader-media{grid-column:span 5;}
  .leader-body{grid-column:span 7;padding-left:48px;}
  .leader-quote-badge{display:block;}
  .cta-inner{flex-direction:row;text-align:left;}
}
@media(min-width:1024px){
  .about-badge{display:block;}
  .values-grid{grid-template-columns:repeat(4,1fr);}
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
<span class="breadcrumb-current">About</span>
</div>
</div>
</header>

<!-- PRINCIPAL MESSAGE SECTION -->
<section class="section-lg about-sec" style="background:var(--surface-container);">
<div class="container">
<div class="about-grid">
<div class="about-media">
<img alt="Principal, Myra Global School" class="about-img" src="assets/images/principal.jpeg"/>
</div>
<div>
<span class="eyebrow">Leadership</span>
<h2 class="heading-lg">Principal's Message</h2>
<p class="about-lead">Dear Parents, at our school we believe every child has the potential to achieve greatness. With your support and our commitment to quality education, we aim to nurture confident, creative, and responsible individuals who are ready to succeed in the future. Together, let us inspire young minds and build a brighter tomorrow.</p>
<p class="about-text">We pride ourselves on maintaining the highest standards of academic rigour while fostering an environment of inclusivity and moral integrity, guiding every student to grow with knowledge, values and confidence.</p>
<div class="about-features">
<div class="about-feature">
<span class="material-symbols-outlined about-feature-ico">verified</span>
<div><div class="about-feature-title">Accredited</div><div class="about-feature-text">Recognised for excellence</div></div>
</div>
<div class="about-feature">
<span class="material-symbols-outlined about-feature-ico">diversity_3</span>
<div><div class="about-feature-title">Inclusive</div><div class="about-feature-text">A caring community</div></div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- VICE PRINCIPAL MESSAGE SECTION -->
<section class="section-lg about-sec">
<div class="container">
<div class="about-grid">
<div>
<span class="eyebrow">Leadership</span>
<h2 class="heading-lg">Vice Principal's Message</h2>
<p class="about-lead">Dear Parents, every child is special, and our goal is to help them discover their strengths, build confidence, and grow with strong values. With your support and our dedication, we can create a joyful learning journey that prepares students for a bright future.</p>
<p class="about-text">We pride ourselves on maintaining the highest standards of academic rigour while fostering an environment of inclusivity and moral integrity, ensuring learning that is both meaningful and impactful.</p>
<div class="about-features">
<div class="about-feature">
<span class="material-symbols-outlined about-feature-ico">verified</span>
<div><div class="about-feature-title">Accredited</div><div class="about-feature-text">Recognised for excellence</div></div>
</div>
<div class="about-feature">
<span class="material-symbols-outlined about-feature-ico">diversity_3</span>
<div><div class="about-feature-title">Inclusive</div><div class="about-feature-text">Inclusive learning, global impact</div></div>
</div>
</div>
</div>
<div class="about-media">
<img alt="Vice Principal, Myra Global School" class="about-img" src="assets/images/viceprincipal.png"/>
</div>
</div>
</div>
</section>

<!-- MISSION & VISION SECTION -->
<section class="section-lg mv-sec">
<div class="container">
<div class="mv-grid">
<div id="mission" class="mv-card mv-card--dark">
<span class="material-symbols-outlined mv-ico mv-ico--gold">psychology</span>
<h3 class="heading-lg heading-lg--light">Our Mission</h3>
<p class="mv-text">"To empower students with the knowledge, skills, and character necessary to excel in a rapidly changing global society, through a curriculum that emphasizes critical thinking, creativity, and compassionate leadership."</p>
</div>
<div id="vision" class="mv-card mv-card--light">
<span class="material-symbols-outlined mv-ico mv-ico--primary">visibility</span>
<h3 class="heading-lg">Our Vision</h3>
<p class="mv-text">"To be a global leader in transformative education, where tradition and innovation converge to inspire generations of thinkers who solve the world's most pressing challenges with wisdom and empathy."</p>
</div>
</div>
</div>
</section>

<!-- CORE VALUES SECTION -->
<section class="section-lg values-sec">
<div class="container">
<div class="values-head">
<span class="eyebrow eyebrow--tight">What Guides Us</span>
<h2 class="heading-lg heading-lg--flush">Our Core Values</h2>
</div>
<div class="values-grid">
<div class="value-card">
<span class="material-symbols-outlined value-ico">school</span>
<h3 class="value-title">Excellence</h3>
<p class="value-text">A relentless pursuit of the highest standards in academics and character.</p>
</div>
<div class="value-card value-card--alt">
<span class="material-symbols-outlined value-ico">handshake</span>
<h3 class="value-title">Integrity</h3>
<p class="value-text">Honesty, respect and responsibility at the heart of everything we do.</p>
</div>
<div class="value-card">
<span class="material-symbols-outlined value-ico">lightbulb</span>
<h3 class="value-title">Innovation</h3>
<p class="value-text">Curiosity and creativity that prepare students for a changing world.</p>
</div>
<div class="value-card value-card--alt">
<span class="material-symbols-outlined value-ico">volunteer_activism</span>
<h3 class="value-title">Compassion</h3>
<p class="value-text">Empathy and service that build responsible, caring global citizens.</p>
</div>
</div>
</div>
</section>

<!-- ACHIEVEMENTS / STATS SECTION -->
<section class="stats-sec">
<div class="container">
<div class="stats-head">
<span class="eyebrow eyebrow--tight eyebrow--gold">Our Milestones</span>
<h2 class="heading-lg heading-lg--light heading-lg--flush">Achievements at a Glance</h2>
</div>
<div class="stats-grid">
<div class="stat">
<div class="stat-num">50+</div>
<div class="stat-label">Years of Excellence</div>
</div>
<div class="stat">
<div class="stat-num">100%</div>
<div class="stat-label">Graduation Rate</div>
</div>
<div class="stat">
<div class="stat-num">12:1</div>
<div class="stat-label">Student-Teacher Ratio</div>
</div>
<div class="stat">
<div class="stat-num">45+</div>
<div class="stat-label">Clubs &amp; Activities</div>
</div>
</div>
</div>
</section>

<!-- LEADERSHIP MESSAGE SECTION -->
<section class="section-lg leader-sec">
<div class="container">
<div class="leader-grid">
<div class="leader-media">
<div class="leader-photo" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCnLQoBiW2ppMiEXqiOlcTO5hCufB4J_koqwOi7Qez_8Pp7VJ92yeu370SoS5ZbTzTCQauPLjkRWAuKlhIW-DhrI95424vvXYeXKoAcmNVnzkh7eenQ17MCAyrdT_cC8MBD3Owajn-ZqXjL8poHdO4ELvWvJe7invlpvY5hDsNpmL726QtDkgWDROIA6_6PPZ950v2tkwunSFZ7cb0XN6FYHhHeyI0dKlbMkr5fnCb7HfEmJtbPI4I_kQ')"></div>
<div class="leader-quote-badge">
<span class="material-symbols-outlined">format_quote</span>
</div>
</div>
<div class="leader-body">
<span class="eyebrow">Leadership Statement</span>
<h2 class="heading-lg">A Message from Our Principal</h2>
<p class="leader-quote">"We don't just teach subjects; we inspire minds. Our mission is to create an environment where every student feels seen, challenged, and empowered to reach their highest potential."</p>
<p class="leader-text">For over half a century, Myra Global School has stood as a beacon of academic excellence. Our curriculum is designed to foster critical thinking, global awareness, and a lifelong passion for discovery. We warmly invite you to become part of our storied legacy.</p>
<div>
<div class="leader-name">Dr. Elena Richardson</div>
<div class="leader-role">Principal</div>
</div>
</div>
</div>
</div>
</section>

<!-- CTA STRIP -->
<section class="cta-sec">
<div class="container cta-inner">
<div>
<h2 class="cta-title">Ready to Begin Your Journey?</h2>
<p class="cta-text">Discover how Myra Global School can shape your child's future.</p>
</div>
<div class="cta-actions">
<button class="btn-fill">Apply Now</button>
<button class="btn-line">Contact Us</button>
</div>
</div>
</section>

<!-- Footer -->
<?php include 'components/footer.php'; ?>
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
