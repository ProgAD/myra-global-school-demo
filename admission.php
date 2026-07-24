<?php $page_name = 'admission'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admissions | Myra Global School</title>
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
.eyebrow--gold{color:var(--secondary-fixed);}
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:24px;}
.heading-lg--light{color:var(--on-primary);}
.heading-lg--flush{margin-bottom:0;}

/* Banner */
.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

/* Admission-status modal */
.status-modal{position:fixed;inset:0;background:rgba(9,25,50,.6);display:none;align-items:center;justify-content:center;z-index:1000;padding:20px;}
.status-modal.open{display:flex;}
.status-box{background:#fff;border-radius:16px;padding:32px;max-width:460px;width:100%;box-shadow:0 30px 60px rgba(0,0,0,.3);position:relative;animation:statusPop .25s ease;}
@keyframes statusPop{from{transform:translateY(12px);opacity:0;}}
.status-close{position:absolute;top:12px;right:16px;font-size:30px;line-height:1;color:var(--on-surface-variant);cursor:pointer;background:none;border:none;}
.status-close:hover{color:var(--primary);}
.status-title{font-family:var(--font-serif);font-size:24px;font-weight:700;color:var(--primary);margin-bottom:6px;}
.status-sub{font-family:var(--font-sans);font-size:14px;color:var(--on-surface-variant);margin-bottom:20px;}
.status-input{width:100%;border:1px solid var(--outline-variant);border-radius:8px;padding:12px 14px;font-family:var(--font-serif);font-size:16px;margin-bottom:16px;}
.status-input:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 1px var(--primary);}
.status-form-btn{width:100%;display:inline-flex;align-items:center;justify-content:center;gap:8px;}
.status-form-btn:disabled{opacity:.85;cursor:progress;}
.status-error{display:none;align-items:flex-start;gap:8px;background:#fdecec;border:1px solid #f3c9c9;color:#8c1d1d;font-family:var(--font-sans);font-size:13.5px;font-weight:600;padding:11px 14px;border-radius:8px;margin-bottom:14px;}
.status-error.visible{display:flex;}
.status-error .material-symbols-outlined{font-size:18px;flex-shrink:0;}
.status-spinner{display:none;width:17px;height:17px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:statusSpin .6s linear infinite;}
.status-form-btn.loading .status-spinner{display:inline-block;}
@keyframes statusSpin{to{transform:rotate(360deg);}}
.status-result{margin-top:4px;}
.status-ref{font-family:var(--font-sans);font-size:13px;color:var(--on-surface-variant);margin-bottom:12px;}
.status-ref strong{color:var(--primary);}
.status-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:9999px;font-family:var(--font-sans);font-size:14px;font-weight:600;margin-bottom:22px;}
.status-badge .material-symbols-outlined{font-size:16px;}
.status-badge--received{background:#e2ecff;color:#2b4c8c;}
.status-badge--verify{background:#fff3d6;color:#8a6d1a;}
.status-badge--done{background:#e2f7ec;color:#227a52;}
.status-steps{margin-bottom:20px;}
.status-step{display:flex;gap:14px;align-items:flex-start;position:relative;padding-bottom:20px;}
.status-step:last-child{padding-bottom:0;}
.status-step:not(:last-child)::before{content:'';position:absolute;left:12px;top:24px;bottom:0;width:2px;background:var(--outline-variant);}
.status-step.done:not(:last-child)::before{background:var(--primary-container);}
.status-dot{width:26px;height:26px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:var(--surface-container);border:2px solid var(--outline-variant);color:var(--on-surface-variant);z-index:1;}
.status-dot .material-symbols-outlined{font-size:15px;}
.status-step.done .status-dot{background:var(--primary-container);border-color:var(--primary-container);color:var(--secondary-fixed);}
.status-step.current .status-dot{background:var(--secondary-fixed);border-color:var(--secondary-fixed);color:var(--primary);}
.status-step-label{font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--primary);}
.status-step.pending .status-step-label{color:var(--on-surface-variant);}
.status-step-note{font-family:var(--font-serif);font-size:13px;color:var(--on-surface-variant);}
.status-again{margin-top:4px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--primary);cursor:pointer;background:none;border:none;display:inline-flex;align-items:center;gap:4px;}
.status-again:hover{color:var(--secondary-fixed-dim);}

/* Intro */
.adm-intro{padding:80px 0 64px;background:var(--surface);}
.adm-intro-inner{text-align:center;max-width:768px;margin:0 auto;}
.adm-intro-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}

/* Steps / Process flow */
.steps-sec{padding:120px 0;background:var(--surface-container);}
.steps-head{text-align:center;margin-bottom:64px;}

.flow{display:flex;flex-direction:column;align-items:stretch;gap:6px;}
.flow-step{
  flex:1;background:var(--surface-container-lowest);border:1px solid var(--outline-variant);
  border-radius:16px;padding:34px 26px;text-align:center;position:relative;
  opacity:0;transform:translateY(26px);
  transition:opacity .6s ease,transform .6s ease,box-shadow .3s,border-color .3s;
  transition-delay:var(--d,0s);
}
.flow.in-view .flow-step{opacity:1;transform:none;}
.flow-step:hover{border-color:var(--primary);box-shadow:0 14px 32px rgba(0,33,71,.12);}
.flow-kicker{font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--secondary);margin-bottom:8px;}
.flow-title{font-family:var(--font-serif);font-size:19px;line-height:1.3;font-weight:600;color:var(--primary);margin-bottom:8px;}
.flow-text{font-family:var(--font-serif);font-size:14px;line-height:1.6;color:var(--on-surface-variant);}
.flow-ico{
  width:74px;height:74px;border-radius:50%;background:var(--surface-container);color:var(--primary-container);
  display:flex;align-items:center;justify-content:center;margin:0 auto 20px;position:relative;transition:background .5s,color .5s;
}
.flow-ico .material-symbols-outlined{font-size:34px;}
.flow.in-view .flow-step .flow-ico{background:var(--primary-container);color:var(--secondary-fixed);}
.flow-ico::after{content:'';position:absolute;inset:-6px;border-radius:50%;border:2px solid var(--secondary-fixed-dim);opacity:0;}
.flow.in-view .flow-step .flow-ico::after{animation:flowRing 2.6s ease-out infinite;animation-delay:var(--d,0s);}
@keyframes flowRing{0%{transform:scale(.82);opacity:.55;}70%{opacity:0;}100%{transform:scale(1.42);opacity:0;}}

/* connector arrows between steps */
.flow-arrow{display:flex;align-items:center;justify-content:center;color:var(--secondary);padding:2px 0;}
.flow-arrow .material-symbols-outlined{font-size:30px;transform:rotate(90deg);animation:flowPulseV 1.7s ease-in-out infinite;}
@keyframes flowPulseV{0%,100%{opacity:.3;transform:rotate(90deg) translateX(-3px);}50%{opacity:1;transform:rotate(90deg) translateX(3px);}}
@keyframes flowPulseH{0%,100%{opacity:.3;transform:translateX(-3px);}50%{opacity:1;transform:translateX(3px);}}

@media(min-width:900px){
  .flow{flex-direction:row;align-items:stretch;gap:6px;}
  .flow-arrow{padding:0 2px;}
  .flow-arrow .material-symbols-outlined{transform:none;animation:flowPulseH 1.7s ease-in-out infinite;}
}
@media(prefers-reduced-motion:reduce){
  .flow-step{opacity:1;transform:none;transition:none;}
  .flow-ico::after,.flow-arrow .material-symbols-outlined{animation:none;}
}

/* Key facts */
.facts-sec{padding:120px 0;background:var(--primary-container);color:var(--on-primary);}
.facts-head{text-align:center;margin-bottom:64px;}
.facts-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:32px;}
.fact{text-align:center;}
.fact-ico{font-size:44px;color:var(--secondary-fixed);margin-bottom:12px;}
.fact-title{font-family:var(--font-serif);font-size:22px;font-weight:600;margin-bottom:4px;}
.fact-text{font-family:var(--font-sans);font-size:14px;color:var(--on-primary-container);}

/* Buttons */
.btn-fill{display:inline-block;background:var(--primary-container);color:var(--on-primary);padding:14px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;font-weight:600;cursor:pointer;transition:all .2s;text-align:center;}
.btn-fill:hover{background:var(--primary);}
.btn-line{display:inline-block;background:transparent;border:1px solid var(--primary);color:var(--primary);padding:14px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;font-weight:600;cursor:pointer;transition:all .2s;text-align:center;}
.btn-line:hover{background:var(--primary);color:var(--on-primary);}
.adm-actions{display:flex;flex-wrap:wrap;gap:16px;justify-content:center;margin-top:32px;}

/* CTA band */
.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;text-align:center;justify-content:space-between;gap:24px;padding:64px 0;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;flex-wrap:wrap;gap:16px;flex-shrink:0;justify-content:center;}

@media(min-width:768px){
  .facts-grid{grid-template-columns:repeat(4,1fr);}
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
<span class="breadcrumb-current">Admissions</span>
</div>
</div>
</header>

<!-- INTRO -->
<section class="adm-intro">
<div class="container">
<div class="adm-intro-inner">
<span class="eyebrow">Join Our Community</span>
<h1 class="heading-lg">Admissions 2025–26</h1>
<p class="adm-intro-text">Give your child an education that inspires. Applications are now open across all grades — from Nursery to Grade 11. Follow our simple three-step process to begin the journey.</p>
<div class="adm-actions">
<a href="admission/admission-form.php" class="btn-fill">Apply for Admission</a>
<button type="button" class="btn-line status-btn">Admission Status</button>
</div>
</div>
</div>
</section>

<!-- PROCESS STEPS -->
<section class="steps-sec">
<div class="container">
<div class="steps-head">
<span class="eyebrow">How It Works</span>
<h2 class="heading-lg heading-lg--flush">The Admission Process</h2>
</div>
<div class="flow" id="admFlow">
<div class="flow-step" style="--d:.05s">
<div class="flow-ico"><span class="material-symbols-outlined">edit_document</span></div>
<div class="flow-kicker">Step 1</div>
<h3 class="flow-title">Apply Online</h3>
<p class="flow-text">Fill in and submit the online admission form with the student's details and documents.</p>
</div>
<div class="flow-arrow"><span class="material-symbols-outlined">arrow_forward</span></div>
<div class="flow-step" style="--d:.28s">
<div class="flow-ico"><span class="material-symbols-outlined">fact_check</span></div>
<div class="flow-kicker">Step 2</div>
<h3 class="flow-title">Verification</h3>
<p class="flow-text">Our admissions team reviews your application and verifies the uploaded documents.</p>
</div>
<div class="flow-arrow"><span class="material-symbols-outlined">arrow_forward</span></div>
<div class="flow-step" style="--d:.51s">
<div class="flow-ico"><span class="material-symbols-outlined">call</span></div>
<div class="flow-kicker">Step 3</div>
<h3 class="flow-title">We Contact You</h3>
<p class="flow-text">Once verified, the school reaches out to you with the next steps of the process.</p>
</div>
<div class="flow-arrow"><span class="material-symbols-outlined">arrow_forward</span></div>
<div class="flow-step" style="--d:.74s">
<div class="flow-ico"><span class="material-symbols-outlined">verified</span></div>
<div class="flow-kicker">Step 4</div>
<h3 class="flow-title">Admission Confirmed</h3>
<p class="flow-text">Complete the formalities and your child's admission is confirmed. Welcome to Myra!</p>
</div>
</div>
</div>
</section>

<!-- KEY FACTS -->
<section class="facts-sec">
<div class="container">
<div class="facts-head">
<span class="eyebrow eyebrow--gold">At a Glance</span>
<h2 class="heading-lg heading-lg--light heading-lg--flush">Why Families Choose Myra</h2>
</div>
<div class="facts-grid">
<div class="fact">
<span class="material-symbols-outlined fact-ico">groups</span>
<div class="fact-title">12:1</div>
<div class="fact-text">Student-Teacher Ratio</div>
</div>
<div class="fact">
<span class="material-symbols-outlined fact-ico">school</span>
<div class="fact-title">100%</div>
<div class="fact-text">Graduation Rate</div>
</div>
<div class="fact">
<span class="material-symbols-outlined fact-ico">public</span>
<div class="fact-title">50+</div>
<div class="fact-text">Years of Excellence</div>
</div>
<div class="fact">
<span class="material-symbols-outlined fact-ico">directions_bus</span>
<div class="fact-title">Safe</div>
<div class="fact-text">Campus &amp; Transport</div>
</div>
</div>
</div>
</section>

<!-- CTA BAND -->
<section class="cta-sec">
<div class="container cta-inner">
<div>
<h2 class="cta-title">Ready to Join Myra?</h2>
<p class="cta-text">Start your child's application online, or check the status of an existing one.</p>
</div>
<div class="cta-actions">
<a href="admission/admission-form.php" class="btn-fill">Apply for Admission</a>
<button type="button" class="btn-line status-btn">Admission Status</button>
</div>
</div>
</section>

<!-- Admission Status Modal -->
<div class="status-modal" id="statusModal" aria-hidden="true">
<div class="status-box">
<button class="status-close" id="statusClose" aria-label="Close">&times;</button>
<h3 class="status-title">Check Admission Status</h3>
<p class="status-sub">Enter your application number or registered phone number.</p>
<div class="status-error" id="statusError">
<span class="material-symbols-outlined">error</span>
<span id="statusErrorMsg"></span>
</div>
<form id="statusForm">
<input class="status-input" id="statusInput" type="text" placeholder="Application no. / Phone number" required/>
<button class="btn-fill status-form-btn" id="statusSubmit" type="submit">
<span class="status-spinner" aria-hidden="true"></span>
<span class="status-btn-label">Check Status</span>
</button>
</form>
</div>
</div>

<!-- Footer -->
<?php include 'components/footer.php';?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Footer link micro-interaction
  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });

  // ---- Reveal the process flow on scroll ----
  var flow = document.getElementById('admFlow');
  if (flow) {
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) { en.target.classList.add('in-view'); io.unobserve(en.target); }
        });
      }, { threshold: 0.3 });
      io.observe(flow);
    } else {
      flow.classList.add('in-view');
    }
  }

  // ---- Admission status lookup modal ----
  var modal = document.getElementById('statusModal');
  if (!modal) return;
  var closeBtn = document.getElementById('statusClose');
  var form = document.getElementById('statusForm');
  var input = document.getElementById('statusInput');
  var errBox = document.getElementById('statusError');
  var errMsg = document.getElementById('statusErrorMsg');
  var btn = document.getElementById('statusSubmit');
  var btnLabel = btn.querySelector('.status-btn-label');

  function openModal() {
    clearError();
    form.reset();
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    input.focus();
  }
  function closeModal() {
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
  function clearError() { errBox.classList.remove('visible'); errMsg.textContent = ''; }
  function showError(msg) { errMsg.textContent = msg; errBox.classList.add('visible'); }
  function setLoading(on) {
    btn.disabled = on;
    btn.classList.toggle('loading', on);
    btnLabel.textContent = on ? 'Checking…' : 'Check Status';
  }

  document.querySelectorAll('.status-btn').forEach(function (b) {
    b.addEventListener('click', function (e) { e.preventDefault(); openModal(); });
  });
  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
  });
  input.addEventListener('input', clearError);

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var v = input.value.trim();
    if (!v) { showError('Please enter your application number or phone number.'); return; }
    clearError();
    setLoading(true);

    fetch('actions/admission/status_lookup.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ q: v })
    })
      .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
      .then(function (res) {
        if (res.d && res.d.success && res.d.id) {
          // keep the button spinning while the browser navigates to the status page
          window.location.href = 'admission/admission-status.php?id=' + encodeURIComponent(res.d.id);
          return;
        }
        showError((res.d && res.d.message) || 'No matching application was found.');
        setLoading(false);
      })
      .catch(function () {
        showError('Could not reach the server. Please try again.');
        setLoading(false);
      });
  });
});
    </script>
</body></html>
