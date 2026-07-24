<?php $page_name = 'career'; ?>
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
.job-dept{display:inline-block;font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--secondary);margin-bottom:6px;}
.job-card{flex-direction:column;align-items:stretch;}
.job-card-main{display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
.job-card-actions{display:flex;align-items:center;gap:12px;flex-shrink:0;}
.job-desc-toggle{display:inline-flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--primary);cursor:pointer;background:none;border:1px solid var(--outline-variant);padding:9px 16px;border-radius:6px;transition:.2s;}
.job-desc-toggle:hover{border-color:var(--primary);}
.job-desc-toggle .material-symbols-outlined{font-size:18px;transition:transform .3s;}
.job-card.open .job-desc-toggle .material-symbols-outlined{transform:rotate(180deg);}
.job-desc{max-height:0;overflow:hidden;transition:max-height .4s ease;}
.job-card.open .job-desc{max-height:1500px;}
.job-desc-inner{margin-top:20px;padding-top:20px;border-top:1px solid var(--outline-variant);font-family:var(--font-serif);font-size:15px;line-height:1.7;color:var(--on-surface-variant);white-space:pre-line;}

/* States */
.jobs-state{text-align:center;padding:56px 20px;color:var(--on-surface-variant);background:var(--surface-container-lowest);border-radius:8px;}
.jobs-state .material-symbols-outlined{font-size:52px;color:var(--outline-variant);}
.jobs-state h3{font-family:var(--font-serif);font-size:20px;font-weight:700;color:var(--primary);margin-top:10px;}
.jobs-state p{margin-top:6px;font-size:15px;}
.j-spin{width:32px;height:32px;border:3px solid var(--outline-variant);border-top-color:var(--primary-container);border-radius:50%;animation:jspin .7s linear infinite;margin:0 auto;}
@keyframes jspin{to{transform:rotate(360deg);}}

/* Form feedback */
.form-alert{display:none;align-items:flex-start;gap:10px;font-family:var(--font-sans);font-size:14px;font-weight:600;padding:14px 16px;border-radius:8px;margin-bottom:8px;grid-column:1/-1;}
.form-alert.visible{display:flex;}
.form-alert.err{background:#fdecec;border:1px solid #f3c9c9;color:#8c1d1d;}
.form-alert.ok{background:#e2f7ec;border:1px solid #b6e4cb;color:#227a52;}
.form-alert .material-symbols-outlined{font-size:20px;flex-shrink:0;}
.form-field.has-error .form-input{border-color:#c0392b;}
.field-err{display:none;font-family:var(--font-sans);font-size:13px;font-weight:600;color:#c0392b;margin-top:6px;}
.form-field.has-error .field-err{display:block;}
.file-name-lbl{display:block;margin-top:8px;font-family:var(--font-sans);font-size:13px;font-weight:600;color:#227a52;word-break:break-all;}
.btn-submit-app:disabled{opacity:.85;cursor:progress;}

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
<div class="job-filter-bar" id="jobFilters">
<button class="filter-btn active" type="button" data-dept="all">All Positions</button>
<button class="filter-btn" type="button" data-dept="academic-faculty">Academic Faculty</button>
<button class="filter-btn" type="button" data-dept="administration">Administration</button>
<button class="filter-btn" type="button" data-dept="support-staff">Support Staff</button>
<button class="filter-btn" type="button" data-dept="other">Other</button>
</div>

<!-- Loading -->
<div class="jobs-state" id="jobsLoading"><div class="j-spin"></div><p style="margin-top:14px">Loading open positions…</p></div>

<!-- Empty -->
<div class="jobs-state" id="jobsEmpty" style="display:none">
<span class="material-symbols-outlined">work_off</span>
<h3>No Vacancies Available</h3>
<p id="jobsEmptyHint">There are currently no open positions. Please check back later.</p>
</div>

<!-- Error -->
<div class="jobs-state" id="jobsError" style="display:none">
<span class="material-symbols-outlined">error</span>
<h3>Could not load positions</h3>
<p id="jobsErrorMsg">Please try again in a moment.</p>
<button class="btn-line" id="jobsRetry" style="margin-top:16px;padding:10px 24px;border-radius:6px;">Retry</button>
</div>

<!-- Openings List -->
<div class="jobs-list" id="jobsList" style="display:none"></div>
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
<form class="apply-form" id="applyForm" enctype="multipart/form-data" novalidate>

<div class="form-alert err" id="applyErr"><span class="material-symbols-outlined">error</span><span id="applyErrMsg"></span></div>
<div class="form-alert ok" id="applyOk"><span class="material-symbols-outlined">check_circle</span><span id="applyOkMsg"></span></div>

<div class="form-field" data-field="first_name">
<label class="form-label">First Name *</label>
<input class="form-input" id="firstName" placeholder="John" required type="text"/>
<span class="field-err"></span>
</div>
<div class="form-field" data-field="last_name">
<label class="form-label">Last Name *</label>
<input class="form-input" id="lastName" placeholder="Doe" required type="text"/>
<span class="field-err"></span>
</div>
<div class="form-field" data-field="email">
<label class="form-label">Email Address *</label>
<input class="form-input" id="applyEmail" placeholder="john.doe@example.com" required type="email"/>
<span class="field-err"></span>
</div>
<div class="form-field" data-field="phone">
<label class="form-label">Phone Number *</label>
<input class="form-input" id="applyPhone" placeholder="+91 90000 00000" required type="tel"/>
<span class="field-err"></span>
</div>
<div class="form-field" data-field="vacancy_id">
<label class="form-label">Position of Interest *</label>
<select class="form-input" id="applyPosition" required>
<option value="">Select a Position</option>
</select>
<span class="field-err"></span>
</div>
<div class="form-field" data-field="experience">
<label class="form-label">Total Experience</label>
<input class="form-input" id="applyExp" placeholder="e.g. 5 years / Fresher" type="text" maxlength="50"/>
<span class="field-err"></span>
</div>
<div class="form-field form-field--full" data-field="resume">
<label class="form-label">Resume / CV Upload *</label>
<div class="file-upload-box" id="resumeDrop">
<span class="material-symbols-outlined file-upload-icon">upload_file</span>
<p style="font-family: var(--font-sans); font-weight: 600; color: var(--primary);">Click to upload your Resume or CV</p>
<p style="font-size: 12px; color: var(--outline);">Accepted format: PDF only (Max 10 MB)</p>
<input id="resumeFile" style="display:none;" type="file" accept="application/pdf,.pdf"/>
<span class="file-name-lbl" id="resumeName"></span>
</div>
<span class="field-err"></span>
</div>
<div class="form-field form-field--full" data-field="additional_info">
<label class="form-label">Cover Letter / Statement of Intent</label>
<textarea class="form-input" id="applyNote" placeholder="Tell us about your teaching philosophy and experience..." rows="4"></textarea>
</div>
<div class="form-field--full">
<button class="btn-submit-app" id="applySubmit" type="submit">Submit Application</button>
</div>
</form>
</div>
</div>
</section>

<!-- Footer -->
<?php include 'components/footer.php';?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });

  var VAC_API = 'actions/careers/vacancies.php';
  var APPLY_API = 'actions/careers/apply.php';

  var list    = document.getElementById('jobsList');
  var loading = document.getElementById('jobsLoading');
  var empty   = document.getElementById('jobsEmpty');
  var errBox  = document.getElementById('jobsError');
  var posSelect = document.getElementById('applyPosition');
  var dept = 'all';
  var openVacancies = [];   // for the position dropdown (always all open)

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function show(w){
    loading.style.display = w==='loading'?'':'none';
    empty.style.display   = w==='empty'  ?'':'none';
    errBox.style.display  = w==='error'  ?'':'none';
    list.style.display    = w==='list'   ?'flex':'none';
  }

  function jobCard(v){
    var hasDesc = v.description && String(v.description).trim() !== '';
    return '<div class="job-card">'
      + '<div class="job-card-main">'
      + '<div>'
      + '<span class="job-dept">'+esc(v.dept_label)+'</span>'
      + '<h3 class="job-title">'+esc(v.title)+'</h3>'
      + '<div class="job-meta">'
      +   '<span class="job-meta-item"><span class="material-symbols-outlined">work</span> '+esc(v.type_label)+'</span>'
      +   '<span class="job-meta-item"><span class="material-symbols-outlined">group</span> '+esc(v.openings)+' opening'+(v.openings===1?'':'s')+'</span>'
      +   (v.deadline ? '<span class="job-meta-item"><span class="material-symbols-outlined">event</span> Apply by '+esc(v.deadline)+'</span>' : '')
      + '</div></div>'
      + '<div class="job-card-actions">'
      +   (hasDesc ? '<button type="button" class="job-desc-toggle">Description <span class="material-symbols-outlined">expand_more</span></button>' : '')
      +   '<a href="#apply" class="btn-apply" data-vac="'+v.id+'">Apply Now</a>'
      + '</div>'
      + '</div>'
      + (hasDesc ? '<div class="job-desc"><div class="job-desc-inner">'+esc(v.description)+'</div></div>' : '')
      + '</div>';
  }

  function loadJobs(){
    show('loading');
    var qs = new URLSearchParams({ dept: dept });
    fetch(VAC_API + '?' + qs.toString(), { headers:{ 'Accept':'application/json' } })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
        var rows = res.d.rows || [];
        if (!rows.length) {
          document.getElementById('jobsEmptyHint').textContent = (dept === 'all')
            ? 'There are currently no open positions. Please check back later.'
            : 'No open positions in this department right now.';
          show('empty');
          return;
        }
        list.innerHTML = rows.map(jobCard).join('');
        show('list');
      })
      .catch(function (err) {
        document.getElementById('jobsErrorMsg').textContent = err.message || 'Please try again in a moment.';
        show('error');
      });
  }

  // The position dropdown always lists ALL open vacancies (independent of the filter)
  function loadPositions(){
    fetch(VAC_API + '?dept=all', { headers:{ 'Accept':'application/json' } })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        if (!d.success) return;
        openVacancies = d.rows || [];
        posSelect.innerHTML = '<option value="">Select a Position</option>' +
          openVacancies.map(function (v) {
            return '<option value="'+v.id+'">'+esc(v.title)+' — '+esc(v.dept_label)+'</option>';
          }).join('');
      })
      .catch(function () {});
  }

  document.getElementById('jobFilters').addEventListener('click', function (e) {
    var b = e.target.closest('.filter-btn'); if (!b) return;
    this.querySelectorAll('.filter-btn').forEach(function (x) { x.classList.remove('active'); });
    b.classList.add('active');
    dept = b.getAttribute('data-dept');
    loadJobs();
  });

  document.getElementById('jobsRetry').addEventListener('click', loadJobs);

  // Card interactions: expand description, or preselect a position on "Apply Now"
  list.addEventListener('click', function (e) {
    var toggle = e.target.closest('.job-desc-toggle');
    if (toggle) { toggle.closest('.job-card').classList.toggle('open'); return; }
    var a = e.target.closest('.btn-apply'); if (!a) return;
    var id = a.getAttribute('data-vac');
    if (id) posSelect.value = id;
  });

  /* -------------------- Apply form -------------------- */
  var form = document.getElementById('applyForm');
  var fileInput = document.getElementById('resumeFile');
  var submitBtn = document.getElementById('applySubmit');
  var errAlert = document.getElementById('applyErr');
  var okAlert  = document.getElementById('applyOk');

  document.getElementById('resumeDrop').addEventListener('click', function () { fileInput.click(); });
  fileInput.addEventListener('change', function () {
    var nameEl = document.getElementById('resumeName');
    var wrap = form.querySelector('[data-field="resume"]');
    var msg = wrap ? wrap.querySelector('.field-err') : null;
    wrap && wrap.classList.remove('has-error');
    if (!this.files || !this.files.length) { nameEl.textContent = ''; return; }
    var f = this.files[0];
    var isPdf = /\.pdf$/i.test(f.name) && (f.type === 'application/pdf' || f.type === '');
    if (!isPdf) {
      this.value = '';
      nameEl.textContent = '';
      if (wrap) { wrap.classList.add('has-error'); if (msg) msg.textContent = 'Only PDF files are allowed.'; }
      return;
    }
    nameEl.textContent = f.name;
  });

  function clearErrors(){
    errAlert.classList.remove('visible'); okAlert.classList.remove('visible');
    form.querySelectorAll('.form-field.has-error').forEach(function (f) {
      f.classList.remove('has-error');
      var m = f.querySelector('.field-err'); if (m) m.textContent = '';
    });
  }
  // backend uses combined `name`; map its field keys back onto the form wrappers
  var FIELD_MAP = { name:'first_name', email:'email', phone:'phone', vacancy_id:'vacancy_id', experience:'experience', resume:'resume' };
  function showErrors(message, errors){
    document.getElementById('applyErrMsg').textContent = message || 'Please correct the highlighted fields.';
    errAlert.classList.add('visible');
    var first = null;
    Object.keys(errors || {}).forEach(function (key) {
      var wrapKey = FIELD_MAP[key] || key;
      var wrap = form.querySelector('[data-field="'+wrapKey+'"]');
      if (!wrap) return;
      wrap.classList.add('has-error');
      var m = wrap.querySelector('.field-err'); if (m) m.textContent = errors[key];
      if (!first) first = wrap;
    });
    (first || errAlert).scrollIntoView({ behavior:'smooth', block:'center' });
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    clearErrors();

    var first = document.getElementById('firstName').value.trim();
    var last  = document.getElementById('lastName').value.trim();

    var fd = new FormData();
    fd.append('name', (first + ' ' + last).trim());
    fd.append('email', document.getElementById('applyEmail').value.trim());
    fd.append('phone', document.getElementById('applyPhone').value.trim());
    fd.append('experience', document.getElementById('applyExp').value.trim());
    fd.append('vacancy_id', posSelect.value);
    fd.append('additional_info', document.getElementById('applyNote').value.trim());
    if (fileInput.files && fileInput.files.length) fd.append('resume', fileInput.files[0]);

    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting…';

    fetch(APPLY_API, { method:'POST', body: fd })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (res.d && res.d.success) {
          form.reset();
          document.getElementById('resumeName').textContent = '';
          document.getElementById('applyOkMsg').textContent = res.d.message || 'Your application has been submitted successfully.';
          okAlert.classList.add('visible');
          okAlert.scrollIntoView({ behavior:'smooth', block:'center' });
        } else {
          showErrors(res.d && res.d.message, res.d && res.d.errors);
        }
      })
      .catch(function () {
        showErrors('Could not reach the server. Please try again.', {});
      })
      .finally(function () {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Application';
      });
  });

  loadJobs();
  loadPositions();
});
</script>
</body></html>