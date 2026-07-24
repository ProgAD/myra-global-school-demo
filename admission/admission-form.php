<?php $page_name = 'admission-form'; $base = '../'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admission Application Form | Myra Global School</title>
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
  --outline:#74777f;--outline-variant:#c4c6cf;--error:#c0392b;
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
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:16px;}

.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);flex-wrap:wrap;}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

.form-page{padding:48px 0 96px;background:var(--surface-container-low);}
.form-intro{text-align:center;max-width:600px;margin:0 auto 32px;}
.form-intro .heading-lg{font-size:34px;line-height:42px;margin-bottom:12px;}
.form-intro-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}

.form-card{max-width:920px;margin:0 auto;background:#fff;border:1px solid var(--outline-variant);border-radius:20px;padding:8px 44px 40px;box-shadow:0 24px 50px -28px rgba(0,33,71,.30);overflow:hidden;}

.form-section{padding:30px 0;border-top:1px solid var(--surface-container-highest);}
.form-section:first-of-type{border-top:none;padding-top:26px;}
.form-section-head{display:flex;align-items:center;gap:14px;margin-bottom:22px;}
.form-section-num{width:44px;height:44px;flex-shrink:0;border-radius:13px;background:linear-gradient(145deg,var(--primary-container),#013a72);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;box-shadow:0 6px 14px -6px rgba(0,33,71,.6);}
.form-section-num .material-symbols-outlined{font-size:23px;}
.form-section-title{font-family:var(--font-serif);font-size:20px;line-height:1.25;font-weight:700;color:var(--primary-container);}
.form-section-sub{display:block;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:var(--on-surface-variant);margin-top:2px;}

.form-grid{display:grid;grid-template-columns:1fr;gap:18px;}
.form-field--full{grid-column:1/-1;}
.form-label{display:block;font-family:var(--font-sans);font-size:13px;font-weight:600;letter-spacing:.02em;color:var(--primary);margin-bottom:7px;}
.req{color:var(--error);}
.opt{color:var(--on-surface-variant);font-weight:400;text-transform:none;letter-spacing:0;}
.form-input{width:100%;border:1px solid var(--outline-variant);border-radius:10px;padding:12px 14px;font-family:var(--font-serif);font-size:15.5px;color:var(--on-background);background:var(--surface-container-low);transition:border-color .2s, box-shadow .2s, background .2s;}
.form-input:hover{border-color:var(--outline);}
.form-input:focus{outline:none;border-color:var(--primary-container);background:#fff;box-shadow:0 0 0 3px rgba(0,33,71,.13);}
select.form-input{cursor:pointer;}
textarea.form-input{resize:vertical;min-height:84px;}

/* field-level error */
.form-field.has-error .form-input,.form-field.has-error .file-drop{border-color:var(--error);background:#fff;}
.err-msg{display:none;font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:var(--error);margin-top:6px;}
.form-field.has-error .err-msg{display:block;}

/* form-level alert */
.form-alert{display:none;align-items:flex-start;gap:10px;background:#fdecec;border:1px solid #f3c9c9;color:var(--error);font-family:var(--font-sans);font-size:14px;font-weight:600;padding:14px 16px;border-radius:10px;margin:20px 0 0;}
.form-alert.visible{display:flex;}
.form-alert .material-symbols-outlined{font-size:20px;flex-shrink:0;}

.upload-grid{display:grid;grid-template-columns:1fr;gap:16px;}
.file-drop{position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;gap:8px;min-height:138px;border:1.5px dashed var(--outline-variant);border-radius:14px;padding:20px 14px;cursor:pointer;background:var(--surface-container-low);transition:border-color .2s, background .2s, box-shadow .2s;}
.file-drop:hover{border-color:var(--primary-container);background:var(--surface-container);box-shadow:0 6px 16px -10px rgba(0,33,71,.4);}
.file-drop input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;}
.file-ico{font-size:30px;color:var(--secondary);}
.file-text{font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--primary);line-height:1.4;}
.file-text small{display:block;font-weight:400;color:var(--on-surface-variant);font-size:11.5px;margin-top:3px;}
.file-name{font-family:var(--font-sans);font-size:12.5px;font-weight:600;color:#227a52;word-break:break-all;}

.form-actions{display:flex;flex-wrap:wrap;gap:14px;justify-content:flex-end;align-items:center;padding-top:24px;margin-top:8px;border-top:1px solid var(--surface-container-highest);}
.btn-fill{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:var(--primary-container);color:var(--on-primary);padding:14px 34px;border-radius:10px;font-family:var(--font-sans);font-size:15.5px;font-weight:600;cursor:pointer;transition:all .2s;box-shadow:0 8px 18px -8px rgba(0,33,71,.6);}
.btn-fill:hover{background:var(--primary);transform:translateY(-1px);}
.btn-fill:disabled{cursor:progress;opacity:.85;transform:none;}
.btn-line{background:transparent;border:1px solid var(--outline-variant);color:var(--primary);padding:14px 30px;border-radius:10px;font-family:var(--font-sans);font-size:15.5px;cursor:pointer;transition:all .2s;}
.btn-line:hover{background:var(--surface-container);border-color:var(--primary);}
.btn-spinner{display:none;width:18px;height:18px;border:2px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:sp .6s linear infinite;}
.btn-fill.loading .btn-spinner{display:inline-block;}
@keyframes sp{to{transform:rotate(360deg);}}

@media(min-width:720px){
  .form-grid{grid-template-columns:repeat(2,1fr);}
  .upload-grid{grid-template-columns:repeat(2,1fr);}
}
@media(min-width:1000px){
  .upload-grid{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:719px){
  .container{padding-left:20px;padding-right:20px;}
  .form-card{padding:6px 22px 30px;border-radius:16px;}
  .form-intro .heading-lg{font-size:28px;line-height:36px;}
  .form-actions{justify-content:stretch;}
  .form-actions .btn-fill,.form-actions .btn-line{flex:1;}
}
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<?php include '../components/header.php'; ?>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="../index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<a href="../admission.php">Admissions</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Application Form</span>
</div>
</div>
</header>

<!-- FORM -->
<section class="form-page">
<div class="container">
<div class="form-intro">
<span class="eyebrow">Admissions 2025&ndash;26</span>
<h1 class="heading-lg">Application Form</h1>
<p class="form-intro-text">Please fill in the details below and upload the required documents. Fields marked <span class="req">*</span> are mandatory.</p>
</div>

<form class="form-card" id="admissionForm" autocomplete="off" novalidate enctype="multipart/form-data">

<div class="form-alert" id="formAlert">
<span class="material-symbols-outlined">error</span>
<span id="formAlertMsg">Please correct the highlighted fields and try again.</span>
</div>

<!-- 1. Admission details -->
<div class="form-section">
<div class="form-section-head">
<span class="form-section-num"><span class="material-symbols-outlined">school</span></span>
<div>
<h2 class="form-section-title">Admission Details</h2>
<span class="form-section-sub">The class you are applying for</span>
</div>
</div>
<div class="form-grid">
<div class="form-field form-field--full" data-field="apply_class">
<label class="form-label" for="apply_class">Class Applying For <span class="req">*</span></label>
<select class="form-input" id="apply_class" name="apply_class" required>
<option value="">Select class</option>
<option value="Nursery">Nursery</option>
<option value="LKG">LKG</option>
<option value="UKG">UKG</option>
<option value="1">Grade 1</option><option value="2">Grade 2</option><option value="3">Grade 3</option>
<option value="4">Grade 4</option><option value="5">Grade 5</option><option value="6">Grade 6</option>
<option value="7">Grade 7</option><option value="8">Grade 8</option><option value="9">Grade 9</option>
<option value="10">Grade 10</option><option value="11">Grade 11</option><option value="12">Grade 12</option>
</select>
<span class="err-msg"></span>
</div>
</div>
</div>

<!-- 2. Student details -->
<div class="form-section">
<div class="form-section-head">
<span class="form-section-num"><span class="material-symbols-outlined">person</span></span>
<div>
<h2 class="form-section-title">Student Details</h2>
<span class="form-section-sub">Tell us about the applicant</span>
</div>
</div>
<div class="form-grid">
<div class="form-field form-field--full" data-field="student_name">
<label class="form-label" for="student_name">Student's Full Name <span class="req">*</span></label>
<input class="form-input" id="student_name" name="student_name" type="text" placeholder="Enter full name" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="father_name">
<label class="form-label" for="father_name">Father's Name <span class="req">*</span></label>
<input class="form-input" id="father_name" name="father_name" type="text" placeholder="Enter father's name" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="mother_name">
<label class="form-label" for="mother_name">Mother's Name <span class="req">*</span></label>
<input class="form-input" id="mother_name" name="mother_name" type="text" placeholder="Enter mother's name" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="gender">
<label class="form-label" for="gender">Gender <span class="req">*</span></label>
<select class="form-input" id="gender" name="gender" required>
<option value="">Select gender</option>
<option value="Male">Male</option><option value="Female">Female</option><option value="Other">Other</option>
</select>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="dob">
<label class="form-label" for="dob">Date of Birth <span class="req">*</span></label>
<input class="form-input" id="dob" name="dob" type="date" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="blood_group">
<label class="form-label" for="blood_group">Blood Group <span class="opt">(optional)</span></label>
<select class="form-input" id="blood_group" name="blood_group">
<option value="">Select blood group</option>
<option value="A+">A+</option><option value="A-">A-</option>
<option value="B+">B+</option><option value="B-">B-</option>
<option value="O+">O+</option><option value="O-">O-</option>
<option value="AB+">AB+</option><option value="AB-">AB-</option>
</select>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="identification_mark">
<label class="form-label" for="identification_mark">Identification Mark <span class="req">*</span></label>
<input class="form-input" id="identification_mark" name="identification_mark" type="text" placeholder="e.g. mole on left cheek" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="religion">
<label class="form-label" for="religion">Religion <span class="req">*</span></label>
<input class="form-input" id="religion" name="religion" type="text" placeholder="Enter religion" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="category">
<label class="form-label" for="category">Category <span class="req">*</span></label>
<select class="form-input" id="category" name="category" required>
<option value="">Select category</option>
<option value="General">General</option><option value="OBC">OBC</option><option value="EBC">EBC</option>
<option value="SC">SC</option><option value="ST">ST</option><option value="EWS">EWS</option><option value="Other">Other</option>
</select>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="mother_tongue">
<label class="form-label" for="mother_tongue">Mother Tongue <span class="req">*</span></label>
<input class="form-input" id="mother_tongue" name="mother_tongue" type="text" placeholder="Enter mother tongue" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="student_aadhaar">
<label class="form-label" for="student_aadhaar">Student's Aadhaar Number <span class="req">*</span></label>
<input class="form-input" id="student_aadhaar" name="student_aadhaar" type="text" inputmode="numeric" pattern="[0-9]{12}" maxlength="12" placeholder="12-digit Aadhaar number" required/>
<span class="err-msg"></span>
</div>
<div class="form-field form-field--full" data-field="last_school">
<label class="form-label" for="last_school">Last School Attended <span class="opt">(if any)</span></label>
<input class="form-input" id="last_school" name="last_school" type="text" placeholder="Name of previous school"/>
<span class="err-msg"></span>
</div>
</div>
</div>

<!-- 3. Residential address -->
<div class="form-section">
<div class="form-section-head">
<span class="form-section-num"><span class="material-symbols-outlined">home</span></span>
<div>
<h2 class="form-section-title">Residential Address</h2>
<span class="form-section-sub">Where the family currently lives</span>
</div>
</div>
<div class="form-grid">
<div class="form-field form-field--full" data-field="address">
<label class="form-label" for="address">Address <span class="req">*</span></label>
<textarea class="form-input" id="address" name="address" placeholder="House no., street, area / locality" required></textarea>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="city">
<label class="form-label" for="city">City <span class="req">*</span></label>
<input class="form-input" id="city" name="city" type="text" placeholder="Enter city" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="pin">
<label class="form-label" for="pin">PIN Code <span class="req">*</span></label>
<input class="form-input" id="pin" name="pin" type="text" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" placeholder="6-digit PIN" required/>
<span class="err-msg"></span>
</div>
<div class="form-field form-field--full" data-field="state">
<label class="form-label" for="state">State <span class="req">*</span></label>
<input class="form-input" id="state" name="state" type="text" placeholder="Enter state" required/>
<span class="err-msg"></span>
</div>
</div>
</div>

<!-- 4. Contact details -->
<div class="form-section">
<div class="form-section-head">
<span class="form-section-num"><span class="material-symbols-outlined">call</span></span>
<div>
<h2 class="form-section-title">Contact Details</h2>
<span class="form-section-sub">How we can reach you</span>
</div>
</div>
<div class="form-grid">
<div class="form-field" data-field="phone">
<label class="form-label" for="phone">Phone Number <span class="req">*</span></label>
<input class="form-input" id="phone" name="phone" type="tel" inputmode="tel" placeholder="Enter phone number" required/>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="email">
<label class="form-label" for="email">Email Address <span class="req">*</span></label>
<input class="form-input" id="email" name="email" type="email" placeholder="email@example.com" required/>
<span class="err-msg"></span>
</div>
</div>
</div>

<!-- 5. Documents -->
<div class="form-section">
<div class="form-section-head">
<span class="form-section-num"><span class="material-symbols-outlined">upload_file</span></span>
<div>
<h2 class="form-section-title">Document Upload</h2>
<span class="form-section-sub">Photograph and Aadhaar documents</span>
</div>
</div>
<div class="upload-grid">
<div class="form-field" data-field="student_photo">
<label class="form-label">Student Photograph <span class="req">*</span></label>
<label class="file-drop">
<input type="file" name="student_photo" accept=".jpg,.jpeg,.png,.webp" required/>
<span class="material-symbols-outlined file-ico">add_a_photo</span>
<span class="file-text">Click to upload<small>JPG, PNG or WEBP · max 2 MB</small></span>
<span class="file-name"></span>
</label>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="doc_student_aadhaar">
<label class="form-label">Student's Aadhaar <span class="req">*</span></label>
<label class="file-drop">
<input type="file" name="doc_student_aadhaar" accept=".jpg,.jpeg,.png,.webp,.pdf" required/>
<span class="material-symbols-outlined file-ico">badge</span>
<span class="file-text">Click to upload<small>Image or PDF · max 2 MB</small></span>
<span class="file-name"></span>
</label>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="doc_father_aadhaar">
<label class="form-label">Father's Aadhaar <span class="req">*</span></label>
<label class="file-drop">
<input type="file" name="doc_father_aadhaar" accept=".jpg,.jpeg,.png,.webp,.pdf" required/>
<span class="material-symbols-outlined file-ico">badge</span>
<span class="file-text">Click to upload<small>Image or PDF · max 2 MB</small></span>
<span class="file-name"></span>
</label>
<span class="err-msg"></span>
</div>
<div class="form-field" data-field="doc_mother_aadhaar">
<label class="form-label">Mother's Aadhaar <span class="req">*</span></label>
<label class="file-drop">
<input type="file" name="doc_mother_aadhaar" accept=".jpg,.jpeg,.png,.webp,.pdf" required/>
<span class="material-symbols-outlined file-ico">badge</span>
<span class="file-text">Click to upload<small>Image or PDF · max 2 MB</small></span>
<span class="file-name"></span>
</label>
<span class="err-msg"></span>
</div>
</div>
</div>

<!-- Actions -->
<div class="form-actions">
<button type="reset" class="btn-line">Reset</button>
<button type="submit" class="btn-fill" id="submitBtn">
<span class="btn-spinner" aria-hidden="true"></span>
<span class="btn-label">Submit Application</span>
</button>
</div>

</form>
</div>
</section>

<!-- Footer -->
<?php include '../components/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('admissionForm');
  var alertBox = document.getElementById('formAlert');
  var alertMsg = document.getElementById('formAlertMsg');
  var btn = document.getElementById('submitBtn');
  var btnLabel = btn.querySelector('.btn-label');

  // show the chosen file name inside each upload box
  form.querySelectorAll('.file-drop input[type=file]').forEach(function (input) {
    input.addEventListener('change', function () {
      var nameEl = input.parentElement.querySelector('.file-name');
      if (nameEl) nameEl.textContent = input.files && input.files.length ? input.files[0].name : '';
    });
  });

  function clearErrors(){
    alertBox.classList.remove('visible');
    form.querySelectorAll('.form-field.has-error').forEach(function (f) {
      f.classList.remove('has-error');
      var m = f.querySelector('.err-msg'); if (m) m.textContent = '';
    });
  }

  function showErrors(message, errors){
    alertMsg.textContent = message || 'Please correct the highlighted fields and try again.';
    alertBox.classList.add('visible');
    var first = null;
    Object.keys(errors || {}).forEach(function (field) {
      var wrap = form.querySelector('[data-field="' + field + '"]');
      if (!wrap) return;
      wrap.classList.add('has-error');
      var m = wrap.querySelector('.err-msg');
      if (m) m.textContent = errors[field];
      if (!first) first = wrap;
    });
    (first || alertBox).scrollIntoView({ behavior:'smooth', block:'center' });
  }

  function setLoading(on){
    btn.disabled = on;
    btn.classList.toggle('loading', on);
    btnLabel.textContent = on ? 'Submitting…' : 'Submit Application';
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    clearErrors();
    setLoading(true);

    fetch('../actions/admission/submit.php', {
      method: 'POST',
      body: new FormData(form)
    })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (res.d && res.d.success) {
          // keep the button spinning while the browser navigates
          window.location.href = res.d.redirect || ('admission-status.php?id=' + res.d.id);
          return;
        }
        showErrors(res.d && res.d.message, res.d && res.d.errors);
        setLoading(false);
      })
      .catch(function () {
        showErrors('Could not reach the server. Please check your connection and try again.', {});
        setLoading(false);
      });
  });

  form.addEventListener('reset', clearErrors);

  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });
});
</script>
</body></html>
