<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Careers | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet"/>
<link href="css/footer.css" rel="stylesheet"/>
<script src="js/nav.js" defer></script>
<style>
/* DESIGN TOKENS */
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

/* RESET / BASE */
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

/* LAYOUT HELPERS */
.container{
  max-width:1280px;
  margin-left:auto;
  margin-right:auto;
  padding-left:64px;
  padding-right:64px;
  width:100%;
}
.section-lg{padding:100px 0;}

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

/* CAREERS HERO BANNER */
.careers-hero {
  background: linear-gradient(rgba(0, 33, 71, 0.85), rgba(0, 10, 30, 0.9)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew') center/cover no-repeat;
  padding: 100px 0;
  color: var(--on-primary);
  text-align: center;
}
.careers-hero-title {
  font-family: var(--font-serif);
  font-size: 48px;
  font-weight: 700;
  line-height: 56px;
  margin-bottom: 16px;
}
.careers-hero-sub {
  font-family: var(--font-serif);
  font-size: 20px;
  line-height: 32px;
  max-width: 768px;
  margin: 0 auto 32px;
  opacity: 0.9;
}
.btn-hero-cta {
  background: var(--secondary-fixed);
  color: var(--on-secondary-fixed);
  padding: 14px 36px;
  font-family: var(--font-sans);
  font-size: 16px;
  font-weight: 700;
  letter-spacing: .05em;
  border-radius: 6px;
  cursor: pointer;
  transition: all .2s;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-hero-cta:hover {
  background: var(--secondary-fixed-dim);
}

/* JOB OPENINGS & FILTERS */
.jobs-sec { background: var(--surface-container-low); }
.jobs-head { text-align: center; margin-bottom: 48px; }

.job-filter-bar {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-bottom: 40px;
  flex-wrap: wrap;
}
.filter-btn {
  font-family: var(--font-sans);
  font-size: 14px;
  font-weight: 600;
  padding: 8px 20px;
  border-radius: 20px;
  border: 1px solid var(--outline);
  color: var(--on-surface-variant);
  cursor: pointer;
  transition: all .2s;
}
.filter-btn:hover, .filter-btn.active {
  background: var(--primary-container);
  color: var(--on-primary);
  border-color: var(--primary-container);
}

.jobs-list { display: flex; flex-direction: column; gap: 20px; }
.job-card {
  background: var(--surface-container-lowest);
  border-radius: 8px;
  padding: 28px 32px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-left: 4px solid var(--primary);
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  transition: all .2s;
}
.job-card:hover {
  box-shadow: 0 6px 12px -2px rgba(0,0,0,0.1);
}
.job-title {
  font-family: var(--font-serif);
  font-size: 22px;
  font-weight: 600;
  color: var(--primary);
  margin-bottom: 6px;
}
.job-meta {
  display: flex;
  gap: 16px;
  font-family: var(--font-sans);
  font-size: 14px;
  color: var(--on-surface-variant);
}
.job-meta-item { display: flex; align-items: center; gap: 4px; }
.job-meta-item .material-symbols-outlined { font-size: 16px; color: var(--secondary); }
.btn-apply {
  background: var(--primary);
  color: var(--on-primary);
  padding: 10px 24px;
  font-family: var(--font-sans);
  font-size: 14px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
  transition: background .2s;
}
.btn-apply:hover { background: var(--primary-container); }

/* APPLICATION FORM SECTION */
.apply-sec { background: var(--surface-container-high); border-top: 1px solid var(--outline-variant); }
.apply-card {
  background: #fff;
  padding: 48px;
  border-radius: 12px;
  max-width: 800px;
  margin: 0 auto;
  box-shadow: 0 10px 20px rgba(0,0,0,0.08);
}
.apply-form { display: grid; grid-template-columns: 1fr; gap: 24px; }
.form-field--full { grid-column: 1 / -1; }
.form-label {
  display: block;
  font-family: var(--font-sans);
  font-size: 14px;
  font-weight: 600;
  letter-spacing: .05em;
  color: var(--primary);
  margin-bottom: 8px;
}
.form-input {
  width: 100%;
  border: 1px solid var(--outline-variant);
  border-radius: 8px;
  padding: 12px;
  font-family: var(--font-serif);
  font-size: 16px;
  color: var(--on-background);
  background: #fff;
}
.form-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 1px var(--primary); }
.file-upload-box {
  border: 2px dashed var(--outline-variant);
  border-radius: 8px;
  padding: 24px;
  text-align: center;
  background: var(--surface);
  cursor: pointer;
}
.file-upload-box:hover { border-color: var(--primary); }
.file-upload-icon { font-size: 36px; color: var(--primary); margin-bottom: 8px; }

.btn-submit-app {
  width: 100%;
  background: var(--primary-container);
  color: var(--on-primary);
  padding: 16px;
  font-family: var(--font-sans);
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  border-radius: 8px;
  transition: background .2s;
}
.btn-submit-app:hover { background: var(--primary); }

/* RESPONSIVE */
@media(min-width:768px){
  .apply-form { grid-template-columns: repeat(2, 1fr); }
}
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<?php include 'components/header.php';?>

<!-- CAREERS HERO SECTION -->
<header class="careers-hero">
<div class="container">
<h1 class="careers-hero-title">Build Your Career at Myra Global School</h1>
<p class="careers-hero-sub">Join an extraordinary community of educators, innovators, and leaders inspiring the next generation of global citizens.</p>
<a href="#openings" class="btn-hero-cta">
View Current Openings <span class="material-symbols-outlined">arrow_downward</span>
</a>
</div>
</header>

<!-- JOB OPENINGS SECTION -->
<section class="section-lg jobs-sec" id="openings">
<div class="container">
<div class="jobs-head">
<span class="eyebrow">Current Opportunities</span>
<h2 class="heading-lg">Explore Open Positions</h2>
</div>

<!-- Filter Bar -->
<div class="job-filter-bar">
<button class="filter-btn active" onclick="filterJobs('all')">All Positions</button>
<button class="filter-btn" onclick="filterJobs('academic')">Academic Faculty</button>
<button class="filter-btn" onclick="filterJobs('admin')">Administration</button>
<button class="filter-btn" onclick="filterJobs('support')">Support Staff</button>
</div>

<!-- Openings List -->
<div class="jobs-list">
<div class="job-card" data-category="academic">
<div>
<h3 class="job-title">Upper School Mathematics Teacher (IB / AP)</h3>
<div class="job-meta">
<span class="job-meta-item"><span class="material-symbols-outlined">work</span> Full-Time</span>
<span class="job-meta-item"><span class="material-symbols-outlined">location_on</span> Main Campus</span>
<span class="job-meta-item"><span class="material-symbols-outlined">menu_book</span> High School</span>
</div>
</div>
<a href="#apply" class="btn-apply">Apply Now</a>
</div>

<div class="job-card" data-category="academic">
<div>
<h3 class="job-title">Lower School Homeroom Educator (Grade 3)</h3>
<div class="job-meta">
<span class="job-meta-item"><span class="material-symbols-outlined">work</span> Full-Time</span>
<span class="job-meta-item"><span class="material-symbols-outlined">location_on</span> Primary Wing</span>
<span class="job-meta-item"><span class="material-symbols-outlined">child_care</span> Primary</span>
</div>
</div>
<a href="#apply" class="btn-apply">Apply Now</a>
</div>

<div class="job-card" data-category="admin">
<div>
<h3 class="job-title">Admissions & Outreach Counselor</h3>
<div class="job-meta">
<span class="job-meta-item"><span class="material-symbols-outlined">work</span> Full-Time</span>
<span class="job-meta-item"><span class="material-symbols-outlined">location_on</span> Administration Office</span>
<span class="job-meta-item"><span class="material-symbols-outlined">badge</span> Executive</span>
</div>
</div>
<a href="#apply" class="btn-apply">Apply Now</a>
</div>

<div class="job-card" data-category="support">
<div>
<h3 class="job-title">Head Football & Athletics Coach</h3>
<div class="job-meta">
<span class="job-meta-item"><span class="material-symbols-outlined">work</span> Full-Time / Seasonal</span>
<span class="job-meta-item"><span class="material-symbols-outlined">location_on</span> Sports Complex</span>
<span class="job-meta-item"><span class="material-symbols-outlined">sports_soccer</span> Athletics</span>
</div>
</div>
<a href="#apply" class="btn-apply">Apply Now</a>
</div>
</div>
</div>
</section>

<!-- APPLICATION FORM SECTION -->
<section class="section-lg apply-sec" id="apply">
<div class="container">
<div style="text-align: center; margin-bottom: 40px;">
<span class="eyebrow">Join Our Team</span>
<h2 class="heading-lg">Submit Your Application</h2>
<p style="color: var(--on-surface-variant);">Didn't find an exact fit? Send us a general application for future consideration.</p>
</div>
<div class="apply-card">
<form class="apply-form">
<div class="form-field">
<label class="form-label">First Name *</label>
<input class="form-input" placeholder="John" required type="text"/>
</div>
<div class="form-field">
<label class="form-label">Last Name *</label>
<input class="form-input" placeholder="Doe" required type="text"/>
</div>
<div class="form-field">
<label class="form-label">Email Address *</label>
<input class="form-input" placeholder="john.doe@example.com" required type="email"/>
</div>
<div class="form-field">
<label class="form-label">Phone Number *</label>
<input class="form-input" placeholder="+1 (555) 000-0000" required type="tel"/>
</div>
<div class="form-field form-field--full">
<label class="form-label">Position of Interest *</label>
<select class="form-input" required>
<option value="">Select a Position</option>
<option>Upper School Mathematics Teacher (IB / AP)</option>
<option>Lower School Homeroom Educator (Grade 3)</option>
<option>Admissions & Outreach Counselor</option>
<option>Head Football & Athletics Coach</option>
<option>General / Future Consideration</option>
</select>
</div>
<div class="form-field form-field--full">
<label class="form-label">Resume / CV Upload *</label>
<div class="file-upload-box" onclick="document.getElementById('resume-file').click()">
<span class="material-symbols-outlined file-upload-icon">upload_file</span>
<p style="font-family: var(--font-sans); font-weight: 600; color: var(--primary);">Click to upload your Resume or CV</p>
<p style="font-size: 12px; color: var(--outline);">Accepted formats: PDF, DOCX (Max 10MB)</p>
<input id="resume-file" style="display:none;" type="file"/>
</div>
</div>
<div class="form-field form-field--full">
<label class="form-label">Cover Letter / Statement of Intent</label>
<textarea class="form-input" placeholder="Tell us about your teaching philosophy and experience..." rows="4"></textarea>
</div>
<div class="form-field--full">
<button class="btn-submit-app" type="submit">Submit Application</button>
</div>
</form>
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

    function filterJobs(category) {
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        const cards = document.querySelectorAll('.job-card');
        cards.forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
</body></html>