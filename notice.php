<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Notice &amp; News | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet"/>
<link href="css/footer.css" rel="stylesheet"/>
<script src="js/nav.js" defer></script>
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
.eyebrow{font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--secondary);text-transform:uppercase;letter-spacing:.2em;display:block;margin-bottom:12px;}
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:24px;}
.heading-lg--flush{margin-bottom:0;}

/* Buttons */
.btn-fill{background:var(--primary-container);color:var(--on-primary);padding:12px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;cursor:pointer;transition:all .2s;}
.btn-fill:hover{background:var(--primary);}
.btn-line{background:transparent;border:1px solid var(--primary);color:var(--primary);padding:12px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;cursor:pointer;transition:all .2s;}
.btn-line:hover{background:var(--primary);color:var(--on-primary);}

/* Banner */
.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

/* Notice page */
.notice-page{padding:80px 0 120px;background:var(--surface);}
.notice-head{text-align:center;max-width:768px;margin:0 auto 64px;}
.notice-head-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}
.notice-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.notice-card{background:var(--surface-container-lowest);padding:32px;border-left:4px solid var(--primary);box-shadow:0 1px 2px 0 rgba(0,0,0,.05);transition:box-shadow .2s;display:flex;flex-direction:column;}
.notice-card:hover{box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -2px rgba(0,0,0,.1);}
.notice-card--secondary{border-left-color:var(--secondary);}
.notice-tag{display:inline-block;align-self:flex-start;font-family:var(--font-sans);font-size:12px;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:2px 10px;border-radius:9999px;margin-bottom:14px;}
.notice-tag--exam{background:#e2ecff;color:#2b4c8c;}
.notice-tag--event{background:#e2f7ec;color:#227a52;}
.notice-tag--new{background:#ffe9d6;color:#c05621;}
.notice-tag--general{background:var(--surface-container);color:var(--secondary);}
.notice-date{font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;color:var(--on-surface-variant);display:block;margin-bottom:8px;}
.notice-card-title{font-family:var(--font-serif);font-size:20px;line-height:1.3;font-weight:600;color:var(--primary);margin-bottom:12px;}
.notice-card-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);margin-bottom:16px;flex-grow:1;}
.notice-link{font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;color:var(--primary);display:inline-flex;align-items:center;gap:4px;align-self:flex-start;}
.notice-link:hover{text-decoration:underline;}
.notice-link .material-symbols-outlined{font-size:14px;}

/* CTA */
.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;justify-content:space-between;gap:24px;padding:64px 0;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;gap:16px;flex-shrink:0;}

@media(min-width:768px){
  .notice-grid{grid-template-columns:repeat(2,1fr);}
  .cta-inner{flex-direction:row;text-align:left;}
}
@media(min-width:1024px){
  .notice-grid{grid-template-columns:repeat(3,1fr);}
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
<a href="index.html">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Notice</span>
</div>
</div>
</header>

<!-- NOTICE LIST -->
<section class="notice-page">
<div class="container">
<div class="notice-head">
<span class="eyebrow">Stay Updated</span>
<h1 class="heading-lg heading-lg--flush">Notice &amp; News</h1>
<p class="notice-head-text" style="margin-top:16px;">The latest circulars, announcements and events from across the Myra Global School community.</p>
</div>
<div class="notice-grid">

<div class="notice-card notice-card--secondary">
<span class="notice-tag notice-tag--new">New</span>
<span class="notice-date">October 24, 2024</span>
<h3 class="notice-card-title">Admissions Open for 2025–26</h3>
<p class="notice-card-text">Registration is now live for Nursery to Grade 11. Apply online or visit the admissions office for assistance.</p>
<a class="notice-link" href="admission.html">Apply Now <span class="material-symbols-outlined">arrow_forward</span></a>
</div>

<div class="notice-card">
<span class="notice-tag notice-tag--exam">Examination</span>
<span class="notice-date">October 22, 2024</span>
<h3 class="notice-card-title">Half-Yearly Examination Schedule</h3>
<p class="notice-card-text">The datesheet for the half-yearly examinations has been published. Please check the student portal for section-wise timings.</p>
<a class="notice-link" href="#">Download Schedule <span class="material-symbols-outlined">open_in_new</span></a>
</div>

<div class="notice-card notice-card--secondary">
<span class="notice-tag notice-tag--event">Event</span>
<span class="notice-date">October 18, 2024</span>
<h3 class="notice-card-title">Annual Sports Day — 25th October</h3>
<p class="notice-card-text">All students are to report by 7:30 AM in their house colours. Parents are cordially invited to attend.</p>
<a class="notice-link" href="gallery.html">View Past Events <span class="material-symbols-outlined">photo_library</span></a>
</div>

<div class="notice-card">
<span class="notice-tag notice-tag--event">Event</span>
<span class="notice-date">October 12, 2024</span>
<h3 class="notice-card-title">Parent–Teacher Symposium</h3>
<p class="notice-card-text">Join us for an evening of dialogue regarding our new experimental STEM curriculum enhancements.</p>
<a class="notice-link" href="#">Register Attendance <span class="material-symbols-outlined">arrow_forward</span></a>
</div>

<div class="notice-card notice-card--secondary">
<span class="notice-tag notice-tag--general">Notice</span>
<span class="notice-date">October 08, 2024</span>
<h3 class="notice-card-title">Merit Scholarship Applications</h3>
<p class="notice-card-text">Applications for the Merit-Based Leadership Scholarship for Grade 9 students are now open until the end of the month.</p>
<a class="notice-link" href="#">Apply Now <span class="material-symbols-outlined">edit</span></a>
</div>

<div class="notice-card">
<span class="notice-tag notice-tag--general">Notice</span>
<span class="notice-date">October 02, 2024</span>
<h3 class="notice-card-title">Revised Library Timings</h3>
<p class="notice-card-text">The school library will remain open until 5:00 PM on all working days to support students during the examination season.</p>
<a class="notice-link" href="#">Read More <span class="material-symbols-outlined">arrow_forward</span></a>
</div>

</div>
</div>
</section>

<!-- CTA STRIP -->
<section class="cta-sec">
<div class="container cta-inner">
<div>
<h2 class="cta-title">Never Miss an Update</h2>
<p class="cta-text">Subscribe to our newsletter and get notices delivered straight to your inbox.</p>
</div>
<div class="cta-actions">
<button class="btn-fill">Subscribe</button>
<button class="btn-line">Contact Us</button>
</div>
</div>
</section>

<!-- Footer -->
<?php include 'components/footer.php';?>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const footerLinks = document.querySelectorAll('footer a');
            footerLinks.forEach(link => {
                link.addEventListener('mouseenter', () => { link.style.transform = 'translateX(4px)'; });
                link.addEventListener('mouseleave', () => { link.style.transform = 'translateX(0)'; });
            });
        });
    </script>
</body></html>
