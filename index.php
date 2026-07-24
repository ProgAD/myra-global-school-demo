<?php $page_name = 'home'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Myra Global School | Excellence in Education</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet"/>
<link href="css/hero.css" rel="stylesheet"/>
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
.heading-lg{
  font-family:var(--font-serif);
  font-size:40px;
  line-height:48px;
  font-weight:700;
  color:var(--primary);
  margin-bottom:24px;
}
.heading-lg--light{color:var(--on-primary);}
.heading-lg--tight{margin-bottom:16px;}

/* ============================================================
   NEWS TICKER
   ============================================================ */
.ticker{
  background:var(--secondary-fixed);
  color:var(--on-secondary-fixed);
  padding:8px 0;
  overflow:hidden;
  border-bottom:1px solid var(--outline-variant);
}
.ticker-inner{display:flex;align-items:center;}
.ticker-label{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:700;
  letter-spacing:.05em;
  text-transform:uppercase;
  margin-right:16px;
  flex-shrink:0;
  display:flex;
  align-items:center;
  gap:4px;
}
.ticker-ico{font-size:18px;}
.ticker-wrap{overflow:hidden;white-space:nowrap;flex-grow:1;}
.ticker-content{
  display:inline-block;
  animation:ticker 30s linear infinite;
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
}
@keyframes ticker{
  0%{transform:translateX(100%);}
  100%{transform:translateX(-100%);}
}

/* ============================================================
   NOTICE SECTION
   ============================================================ */
.notice-sec{
  padding:64px 0;
  background:var(--surface-container-low);
  border-bottom:1px solid var(--outline-variant);
}
.notice-head{display:flex;align-items:center;gap:16px;margin-bottom:32px;}
.notice-head-ico{color:var(--primary);font-size:30px;}
.notice-head-title{
  font-family:var(--font-serif);
  font-size:32px;
  line-height:40px;
  font-weight:600;
  color:var(--primary);
}
.notice-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.notice-card{
  background:var(--surface-container-lowest);
  padding:32px;
  border-left:4px solid var(--primary);
  box-shadow:0 1px 2px 0 rgba(0,0,0,.05);
  transition:box-shadow .2s;
}
.notice-card:hover{box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -2px rgba(0,0,0,.1);}
.notice-card--secondary{border-left-color:var(--secondary);}
.notice-date{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  color:var(--on-surface-variant);
  display:block;
  margin-bottom:8px;
}
.notice-card-title{
  font-family:var(--font-serif);
  font-size:20px;
  line-height:1.3;
  font-weight:600;
  color:var(--primary);
  margin-bottom:12px;
}
.notice-card-text{
  font-family:var(--font-serif);
  font-size:16px;
  line-height:26px;
  color:var(--on-surface-variant);
  margin-bottom:16px;
}
.notice-link{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  color:var(--primary);
  display:inline-flex;
  align-items:center;
  gap:4px;
}
.notice-link:hover{text-decoration:underline;}
.notice-link-ico{font-size:14px;}

/* ============================================================
   ABOUT SECTION
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
.btn-solid-primary{
  background:var(--primary);
  color:var(--on-primary);
  padding:12px 32px;
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  cursor:pointer;
  transition:all .2s;
}
.btn-solid-primary:hover{background:rgba(0,10,30,.9);}

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
   GALLERY
   ============================================================ */
.gallery-sec{background:var(--surface);}
.gallery-head{text-align:center;margin-bottom:64px;}
.gallery-sub{
  font-family:var(--font-serif);
  font-size:16px;
  line-height:26px;
  color:var(--on-surface-variant);
  max-width:672px;
  margin:0 auto;
}
.gallery-grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:16px;
  aspect-ratio:16/9;
}
.gallery-item{position:relative;overflow:hidden;border-radius:8px;}
.gallery-item--big{grid-column:span 2;grid-row:span 2;}
.gallery-item--wide{grid-column:span 2;}
.gallery-img{width:100%;height:100%;object-fit:cover;transition:transform .7s;}
.gallery-item:hover .gallery-img{transform:scale(1.1);}
.gallery-caption{
  position:absolute;
  inset:0;
  background:rgba(0,10,30,.2);
  opacity:0;
  transition:opacity .3s;
  display:flex;
  align-items:center;
  justify-content:center;
}
.gallery-item:hover .gallery-caption{opacity:1;}
.gallery-caption-pill{
  background:rgba(255,255,255,.9);
  padding:8px 16px;
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  border-radius:4px;
  color:var(--primary);
}
.gallery-cta{margin-top:48px;text-align:center;}
.btn-outline-primary{
  border:2px solid var(--primary);
  color:var(--primary);
  padding:12px 32px;
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  background:transparent;
  cursor:pointer;
  transition:all .2s;
}
.btn-outline-primary:hover{background:var(--primary);color:var(--on-primary);}

/* ============================================================
   ENQUIRY FORM
   ============================================================ */
.enquiry-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.enquiry-grid{display:grid;grid-template-columns:1fr;gap:32px;align-items:center;}
.enquiry-lead{
  font-family:var(--font-serif);
  font-size:20px;
  line-height:32px;
  color:var(--on-surface-variant);
  margin-bottom:32px;
}
.enquiry-contacts{display:flex;flex-direction:column;gap:24px;}
.enquiry-contact{display:flex;align-items:flex-start;gap:16px;}
.enquiry-contact-ico{color:var(--primary);padding:8px;background:#fff;border-radius:9999px;}
.enquiry-contact-label{
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  color:var(--primary);
}
.enquiry-contact-val{color:var(--on-surface-variant);}
.enquiry-card{
  background:#fff;
  padding:40px;
  box-shadow:0 10px 15px -3px rgba(0,0,0,.1),0 4px 6px -4px rgba(0,0,0,.1);
  border-radius:12px;
}
.enquiry-form{display:grid;grid-template-columns:1fr;gap:24px;}
.form-field--full{grid-column:1/-1;}
.form-label{
  display:block;
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  color:var(--primary);
  margin-bottom:8px;
}
.form-input{
  width:100%;
  border:1px solid var(--outline-variant);
  border-radius:8px;
  padding:12px;
  font-family:var(--font-serif);
  font-size:16px;
  color:var(--on-background);
  background:#fff;
}
.form-input:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 1px var(--primary);}
.btn-submit{
  width:100%;
  background:var(--primary-container);
  color:var(--on-primary);
  padding:16px;
  font-family:var(--font-sans);
  font-size:14px;
  font-weight:600;
  letter-spacing:.05em;
  cursor:pointer;
  border-radius:8px;
  box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -2px rgba(0,0,0,.1);
  transition:all .2s;
}
.btn-submit:hover{background:var(--primary);}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(min-width:768px){
  .notice-grid{grid-template-columns:repeat(3,1fr);}
  .about-grid{grid-template-columns:1fr 1fr;}
  .mv-grid{grid-template-columns:1fr 1fr;}
  .gallery-grid{grid-template-columns:repeat(4,1fr);}
  .enquiry-form{grid-template-columns:repeat(2,1fr);}
}
@media(min-width:1024px){
  .about-badge{display:block;}
  .enquiry-grid{grid-template-columns:5fr 7fr;}
}
</style>
</head>
<body>


<!-- header part  -->
 <?php include 'components/header.php';?>
<!-- News Ticker -->
<div class="ticker">
<div class="container ticker-inner">
<span class="ticker-label">
<span class="material-symbols-outlined ticker-ico">campaign</span> Latest Updates:
            </span>
<div class="ticker-wrap">
<div class="ticker-content">
                    • Admissions for the Academic Year 2024-25 are now open for all grades.     • Myra Global School ranks Top 10 in National Science Fair results.     • Annual Alumni Homecoming scheduled for October 15th.     • New state-of-the-art Robotics Lab inaugurated by the Education Minister.
                </div>
</div>
</div>
</div>
<!-- Hero Section -->
<header class="hero">
<div class="hero-bg">
<video class="hero-video" autoplay muted loop playsinline poster="">
<source src="assets/videos/hero.mp4" type="video/mp4"/>
</video>
<div class="hero-overlay"></div>
</div>
<div class="container hero-content-wrap">
<div class="hero-content">
<h1 class="hero-title">Where Tradition Meets Innovation</h1>
<p class="hero-sub">Cultivating intellectual curiosity and moral character in the leaders of tomorrow. Join a community dedicated to academic excellence and personal growth.</p>
<div class="hero-actions">
<button class="btn-hero btn-hero--gold">Admission Now</button>
<button class="btn-hero btn-hero--glass">Virtual Campus Tour</button>
</div>
</div>
</div>
</header>
<!-- NOTICE SECTION -->
<section class="notice-sec">
<div class="container">
<div class="notice-head">
<span class="material-symbols-outlined notice-head-ico">notifications_active</span>
<h2 class="notice-head-title">Official Announcements</h2>
</div>
<div class="notice-grid">
<div class="notice-card">
<span class="notice-date">October 24, 2024</span>
<h3 class="notice-card-title">Entrance Examination Schedule</h3>
<p class="notice-card-text">Dates for the Spring 2025 intake entrance exams have been finalized. Please check your portal for details.</p>
<a class="notice-link" href="#">Download Schedule <span class="material-symbols-outlined notice-link-ico">open_in_new</span></a>
</div>
<div class="notice-card notice-card--secondary">
<span class="notice-date">October 20, 2024</span>
<h3 class="notice-card-title">Parent-Teacher Symposium</h3>
<p class="notice-card-text">Join us for an evening of dialogue regarding our new experimental STEM curriculum enhancements.</p>
<a class="notice-link" href="#">Register Attendance <span class="material-symbols-outlined notice-link-ico">arrow_forward</span></a>
</div>
<div class="notice-card">
<span class="notice-date">October 15, 2024</span>
<h3 class="notice-card-title">Scholarship Applications</h3>
<p class="notice-card-text">Applications for the Merit-Based Leadership Scholarship for Grade 9 students are now open.</p>
<a class="notice-link" href="#">Apply Now <span class="material-symbols-outlined notice-link-ico">edit</span></a>
</div>
</div>
</div>
</section>
<!-- ABOUT SECTION -->
<section class="section-lg about-sec">
<div class="container">
<div class="about-grid">
<div class="about-media">
<img alt="Myra Global School Historic Campus" class="about-img" src="https://lh3.googleusercontent.com/aida/AP1WRLvj2juMHe6Ny1Drz8c5bleO9fp0KfpZtEsdRb8dV9gJQHYn7VM5hdyFS8ogfM_BnBHoew1ubfI-j1pyDVBTU4WSfR6SWpbl44-9NiSAPmFrk1yZRpGYCsZFizVlznlE9WiX7U3zbpWDkc7PcUUElVs97VZ7H4C49cUTtUri1ZOUTea6aDCksnljY-O0PjMziusbGqNDYISAGi13nq8XdaJF3_HG6suvYxrrOEQAwYsf5UYVcaTmV5R380A"/>
<div class="about-badge">
<div class="about-badge-num">50+</div>
<div class="about-badge-label">Years of Excellence</div>
</div>
</div>
<div class="about-copy">
<span class="eyebrow">Our Heritage</span>
<h2 class="heading-lg">A Legacy of Intellectual Growth</h2>
<p class="about-lead">Founded in 1974, Myra Global School has evolved from a small community school into a world-class institution. Our campus is more than just buildings; it is a sanctuary for ideas and a launchpad for future leaders.</p>
<p class="about-text">We pride ourselves on maintaining the highest standards of academic rigor while fostering an environment of inclusivity and moral integrity. Our alumni can be found leading industries, driving scientific breakthroughs, and serving communities across the globe.</p>
<button class="btn-solid-primary">Discover Our History</button>
</div>
</div>
</div>
</section>
<!-- MISSION & VISION SECTION -->
<section class="section-lg mv-sec">
<div class="container">
<div class="mv-grid">
<div class="mv-card mv-card--dark">
<span class="material-symbols-outlined mv-ico mv-ico--gold">psychology</span>
<h3 class="heading-lg heading-lg--light">Our Mission</h3>
<p class="mv-text">"To empower students with the knowledge, skills, and character necessary to excel in a rapidly changing global society, through a curriculum that emphasizes critical thinking, creativity, and compassionate leadership."</p>
</div>
<div class="mv-card mv-card--light">
<span class="material-symbols-outlined mv-ico mv-ico--primary">visibility</span>
<h3 class="heading-lg">Our Vision</h3>
<p class="mv-text">"To be a global leader in transformative education, where tradition and innovation converge to inspire generations of thinkers who solve the world's most pressing challenges with wisdom and empathy."</p>
</div>
</div>
</div>
</section>
<!-- GALLERY SECTION -->
<section class="section-lg gallery-sec">
<div class="container">
<div class="gallery-head">
<h2 class="heading-lg heading-lg--tight">Life at Myra Global School</h2>
<p class="gallery-sub">A glimpse into the daily experiences, celebrations, and achievements of our vibrant student community.</p>
</div>
<div class="gallery-grid">
<div class="gallery-item gallery-item--big">
<img alt="Graduation ceremony" class="gallery-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA"/>
<div class="gallery-caption"><span class="gallery-caption-pill">Academic Convocation</span></div>
</div>
<div class="gallery-item">
<img alt="Classroom learning" class="gallery-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew"/>
<div class="gallery-caption"><span class="gallery-caption-pill">Modern Classrooms</span></div>
</div>
<div class="gallery-item">
<img alt="Sports field" class="gallery-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q"/>
<div class="gallery-caption"><span class="gallery-caption-pill">Athletics</span></div>
</div>
<div class="gallery-item gallery-item--wide">
<img alt="Library" class="gallery-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEzSG6mdfW96059TNF1M1hivs6iTXZAr-vLQoKEhcbEjF7aiMXFuPqDTvOOwnwLS14mX2a0qvy96Ziym73h1CwNdqUiJhEMUvC9pvHakyvlukSDnE8A732JP02zde5D3fabGIIhHLU983zv_Nff4n-XdZunzIQpJgvpKuyNUFGokxj4o-ESTmvvx0uEslQ8cYhdbSpa2e-eovTg7Lb7XhXzR3KlgSVgFjYvnt0_mUO2F3494VEtD2g1g"/>
<div class="gallery-caption"><span class="gallery-caption-pill">The Great Library</span></div>
</div>
</div>
<div class="gallery-cta">
<button class="btn-outline-primary">View Full Gallery</button>
</div>
</div>
</section>
<!-- ENQUIRY FORM SECTION -->
<section class="section-lg enquiry-sec">
<div class="container">
<div class="enquiry-grid">
<div class="enquiry-info">
<h2 class="heading-lg">Start Your Journey Today</h2>
<p class="enquiry-lead">Our admissions team is here to guide you through every step of the process. Fill out the form below, and we'll be in touch to schedule a private tour.</p>
<div class="enquiry-contacts">
<div class="enquiry-contact">
<span class="material-symbols-outlined enquiry-contact-ico">call</span>
<div>
<div class="enquiry-contact-label">Admissions Hotline</div>
<div class="enquiry-contact-val">+1 (555) 012-3456</div>
</div>
</div>
<div class="enquiry-contact">
<span class="material-symbols-outlined enquiry-contact-ico">mail</span>
<div>
<div class="enquiry-contact-label">Email Us</div>
<div class="enquiry-contact-val">admissions@stjudesacademy.edu</div>
</div>
</div>
</div>
</div>
<div class="enquiry-form-wrap">
<div class="enquiry-card">
<form class="enquiry-form">
<div class="form-field">
<label class="form-label">Student's Full Name</label>
<input class="form-input" placeholder="Enter name" type="text"/>
</div>
<div class="form-field">
<label class="form-label">Desired Grade Level</label>
<select class="form-input">
<option>Select Grade</option>
<option>Lower School (Pre-K to 5)</option>
<option>Middle School (6 to 8)</option>
<option>Upper School (9 to 12)</option>
</select>
</div>
<div class="form-field">
<label class="form-label">Parent/Guardian Name</label>
<input class="form-input" placeholder="Enter name" type="text"/>
</div>
<div class="form-field">
<label class="form-label">Email Address</label>
<input class="form-input" placeholder="email@example.com" type="email"/>
</div>
<div class="form-field form-field--full">
<label class="form-label">Any specific questions?</label>
<textarea class="form-input" placeholder="How can we help you?" rows="4"></textarea>
</div>
<div class="form-field--full">
<button class="btn-submit" type="submit">Submit Enquiry</button>
</div>
</form>
</div>
</div>
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
