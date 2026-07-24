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

/* Scroll reveal */
.reveal{opacity:0;transform:translateY(34px);transition:opacity .7s cubic-bezier(.22,.61,.36,1),transform .7s cubic-bezier(.22,.61,.36,1);}
.reveal--left{transform:translateX(-60px);}
.reveal--right{transform:translateX(60px);}
.reveal.in{opacity:1;transform:none;}
.reveal[data-delay="1"]{transition-delay:.1s;}
.reveal[data-delay="2"]{transition-delay:.2s;}
.reveal[data-delay="3"]{transition-delay:.3s;}
.reveal[data-delay="4"]{transition-delay:.4s;}
@media(prefers-reduced-motion:reduce){.reveal{opacity:1 !important;transform:none !important;transition:none !important;}}

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
.ann-viewall{margin-left:auto;display:inline-flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.03em;color:var(--primary);border:1px solid var(--primary);border-radius:8px;padding:9px 18px;transition:.2s;}
.ann-viewall:hover{background:var(--primary);color:var(--on-primary);}
.ann-viewall .material-symbols-outlined{font-size:16px;}
.notice-viewall-bottom{display:none;margin-top:32px;text-align:center;}
.notice-viewall-bottom .ann-viewall{margin-left:0;}

/* Notice "Read more" modal (shared style) */
.nmodal{position:fixed;inset:0;background:rgba(9,25,50,.6);display:none;align-items:center;justify-content:center;z-index:1000;padding:20px;}
.nmodal.open{display:flex;}
.nmodal-box{background:#fff;border-radius:16px;max-width:640px;width:100%;max-height:88vh;overflow-y:auto;box-shadow:0 30px 60px rgba(0,0,0,.3);animation:nmPop .25s ease;}
@keyframes nmPop{from{transform:translateY(12px);opacity:0;}}
.nmodal-head{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;padding:26px 28px 0;}
.nmodal-close{font-size:28px;line-height:1;color:var(--on-surface-variant);cursor:pointer;background:none;border:none;flex-shrink:0;}
.nmodal-close:hover{color:var(--primary);}
.nmodal-cat{display:inline-block;font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--secondary);}
.nmodal-date{font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--on-surface-variant);display:block;margin-top:4px;}
.nmodal-title{font-family:var(--font-serif);font-size:26px;line-height:1.25;font-weight:700;color:var(--primary);padding:6px 28px 0;}
.nmodal-body{padding:16px 28px 26px;font-family:var(--font-serif);font-size:16px;line-height:28px;color:var(--on-surface-variant);white-space:pre-wrap;}
.nmodal-attach{display:flex;flex-wrap:wrap;gap:8px;padding:0 28px 26px;}
.nmodal-chip{display:inline-flex;align-items:center;gap:5px;font-family:var(--font-sans);font-size:13px;font-weight:600;padding:6px 12px;border-radius:8px;border:1px solid var(--outline-variant);color:var(--primary);transition:.2s;}
.nmodal-chip:hover{background:var(--surface-container);border-color:var(--primary);}
.nmodal-chip .material-symbols-outlined{font-size:15px;}
.notice-readmore{background:none;border:none;cursor:pointer;}
/* Announcement loading skeleton + card entrance */
.notice-skel-card{pointer-events:none;}
.skel{display:block;background:linear-gradient(90deg,var(--surface-container) 25%,var(--surface-container-high) 37%,var(--surface-container) 63%);background-size:400% 100%;animation:gskel 1.4s ease infinite;border-radius:6px;}
.annfade{animation:annUp .55s ease both;}
@keyframes annUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:none;}}
@media(prefers-reduced-motion:reduce){.skel{animation:none;}.annfade{animation:none;}}

/* ============================================================
   ABOUT SECTION
   ============================================================ */
.about-sec{background:var(--surface);overflow:hidden;}
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
  grid-auto-rows:180px;
  gap:16px;
}
.gallery-item{position:relative;overflow:hidden;border-radius:8px;display:block;background:var(--surface-container);}
/* collage span helpers (index-assigned by JS per album count) */
.g-big{grid-column:span 2;grid-row:span 2;}
.g-wide{grid-column:span 2;}
.g-full{grid-column:1/-1;grid-row:span 2;}
.g-sm{grid-column:span 1;}
.g-half{grid-column:span 2;grid-row:span 2;}
.gallery-img{width:100%;height:100%;object-fit:cover;transition:transform .7s;}
.gallery-item:hover .gallery-img{transform:scale(1.1);}
.gallery-cover-empty{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--surface-container);color:var(--outline-variant);}
.gallery-cover-empty .material-symbols-outlined{font-size:46px;}
/* skeleton loaders */
.gallery-skel{border-radius:8px;background:linear-gradient(90deg,var(--surface-container) 25%,var(--surface-container-high) 37%,var(--surface-container) 63%);background-size:400% 100%;animation:gskel 1.4s ease infinite;}
@keyframes gskel{0%{background-position:100% 0;}100%{background-position:-100% 0;}}
/* empty / error state */
.gallery-state{grid-column:1/-1;text-align:center;padding:56px 20px;color:var(--on-surface-variant);}
.gallery-state .material-symbols-outlined{font-size:52px;color:var(--outline-variant);}
.gallery-state h3{font-family:var(--font-serif);font-size:20px;font-weight:700;color:var(--primary);margin-top:10px;}
.gallery-state p{margin-top:6px;font-size:15px;}
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
   FACILITIES SECTION  (copied from sheet.html)
   ============================================================ */
.facilities-sec {
  background: var(--surface-container-high);
  padding: 60px 0 80px;
}
.facilities-head {
  margin-bottom: 24px;
}
.facilities-title {
  font-family: Georgia, 'Times New Roman', serif;
  font-size: 28px;
  font-weight: 700;
  color: #333333;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 16px;
}
.facilities-desc {
  font-family: var(--font-serif);
  font-size: 16px;
  line-height: 1.6;
  color: #555555;
  max-width: 1000px;
  margin-bottom: 24px;
}
.facilities-btn {
  background-color: #0088cc;
  color: #ffffff;
  padding: 10px 22px;
  border-radius: 4px;
  font-family: var(--font-sans);
  font-size: 15px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: background-color 0.2s;
}
.facilities-btn:hover {
  background-color: #006699;
}
.facilities-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 12px;
  margin-top: 32px;
}
.facility-card {
  position: relative;
  overflow: hidden;
  height: 250px;
  background-size: cover;
  background-position: center;
  cursor: pointer;
}
.facility-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 10, 30, 0.82);
  color: #ffffff;
  padding: 24px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease;
  transform: translateY(10px);
  z-index: 4;
}
.facility-card:hover .facility-overlay {
  opacity: 1;
  transform: translateY(0);
}
.facility-overlay-title {
  font-family: Georgia, 'Times New Roman', serif;
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 8px;
  color: var(--secondary-fixed);
}
.facility-overlay-desc {
  font-family: var(--font-sans);
  font-size: 13px;
  line-height: 1.4;
  color: #e2e8f0;
}
.facility-badge-corner {
  position: absolute;
  top: 0;
  right: 0;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 0 55px 55px 0;
  z-index: 2;
}
.facility-badge-corner--blue { border-color: transparent #0056b3 transparent transparent; }
.facility-badge-corner--green { border-color: transparent #2ecc71 transparent transparent; }
.facility-badge-corner--orange { border-color: transparent #e67e22 transparent transparent; }
.facility-badge-corner--red { border-color: transparent #e74c3c transparent transparent; }
.facility-badge-icon {
  position: absolute;
  top: 6px;
  right: 6px;
  color: #ffffff;
  font-size: 20px;
  z-index: 3;
}

/* ============================================================
   ENQUIRY FORM
   ============================================================ */
.enquiry-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);overflow:hidden;}
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
.btn-submit:disabled{opacity:.6;cursor:not-allowed;}
.form-input.is-invalid{border-color:#d92d20;box-shadow:0 0 0 1px #d92d20;}
.enq-error{display:none;font-family:var(--font-sans);font-size:12px;font-weight:600;color:#d92d20;margin-top:6px;}
.enq-error.show{display:block;}

/* Enquiry success popup */
.enq-modal{position:fixed;inset:0;background:rgba(9,25,50,.6);display:none;align-items:center;justify-content:center;z-index:1200;padding:20px;}
.enq-modal.open{display:flex;}
.enq-modal-box{background:#fff;border-radius:16px;max-width:420px;width:100%;padding:40px 32px 32px;text-align:center;box-shadow:0 30px 60px rgba(0,0,0,.3);animation:nmPop .25s ease;}
.enq-tick{width:76px;height:76px;border-radius:50%;background:#e7f7ee;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;}
.enq-tick svg{width:40px;height:40px;}
.enq-tick circle{stroke:#12b76a;stroke-width:2.5;fill:none;stroke-dasharray:166;stroke-dashoffset:166;animation:enqCircle .5s cubic-bezier(.65,0,.45,1) forwards;}
.enq-tick path{stroke:#12b76a;stroke-width:3;fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:48;stroke-dashoffset:48;animation:enqCheck .35s .45s cubic-bezier(.65,0,.45,1) forwards;}
@keyframes enqCircle{to{stroke-dashoffset:0;}}
@keyframes enqCheck{to{stroke-dashoffset:0;}}
.enq-modal-title{font-family:var(--font-serif);font-size:24px;font-weight:700;color:var(--primary);margin-bottom:10px;}
.enq-modal-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);margin-bottom:24px;}
.enq-modal-btn{background:var(--primary-container);color:var(--on-primary);padding:12px 32px;font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;cursor:pointer;border-radius:8px;transition:.2s;}
.enq-modal-btn:hover{background:var(--primary);}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(min-width:768px){
  .notice-grid{grid-template-columns:repeat(3,1fr);}
  .about-grid{grid-template-columns:1fr 1fr;}
  .mv-grid{grid-template-columns:1fr 1fr;}
  .gallery-grid{grid-template-columns:repeat(4,1fr);grid-auto-rows:200px;}
  .enquiry-form{grid-template-columns:repeat(2,1fr);}
}
@media(min-width:1024px){
  .about-badge{display:block;}
  .enquiry-grid{grid-template-columns:5fr 7fr;}
}
@media (max-width:1024px){
  .facilities-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width:768px){
  .facilities-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width:480px){
  .facilities-grid { grid-template-columns: 1fr; }
}

/* ---- Mobile phones ---- */
@media (max-width:767px){
  .container{padding-left:20px;padding-right:20px;}
  .section-lg{padding:72px 0;}
  .heading-lg{font-size:28px;line-height:36px;margin-bottom:20px;}

  /* Notice: hide top "View All", show centered one at the end */
  .notice-sec{padding:48px 0;}
  .notice-head{gap:12px;margin-bottom:24px;}
  .notice-head-title{font-size:24px;line-height:30px;}
  .ann-viewall--top{display:none;}
  .notice-viewall-bottom{display:block;}

  /* About */
  .about-grid{gap:40px;}
  .about-img{height:320px;}
  .about-lead{font-size:18px;line-height:28px;}

  /* Mission & Vision */
  .mv-card{padding:36px 28px;}

  /* Gallery */
  .gallery-head{margin-bottom:40px;}
  .gallery-grid{grid-auto-rows:150px;}

  /* Facilities */
  .facilities-sec{padding:48px 0 56px;}

  /* Enquiry */
  .enquiry-card{padding:28px 24px;}
}
@media (max-width:400px){
  .facilities-grid{grid-template-columns:1fr;}
  .gallery-grid{grid-template-columns:1fr;grid-auto-rows:190px;}
  .g-big,.g-half,.g-wide,.g-full,.g-sm{grid-column:1/-1;grid-row:auto;}
}

/* ============================================================
   BEYOND ACADEMICS  (copied from sheet.html)
   ============================================================ */
:root{
  --ba-ink:#1F2A37;
  --ba-ink-soft:#4B5768;
  --ba-orange:#002147;
  --ba-orange-dark:#00152e;
  --ba-line:#e9c349;
  --ba-card-line:#EAECEF;
  --ba-blue:#002147;
  --ba-radius:2px;
  --ba-transition:420ms cubic-bezier(.65,0,.35,1);
}
.ba-wrapper{
  max-width:1280px;
  margin:0 auto;
  padding:80px 24px 100px;
  position:relative;
  color:var(--ba-ink);
}
.ba-frame-top{position:absolute;top:0;left:24px;width:calc(100% - 48px);height:1px;background:var(--ba-line);}
.ba-frame-left{position:absolute;top:0;left:24px;width:1px;height:130px;background:var(--ba-line);}
.ba-frame-left-lower{position:absolute;left:120px;width:1px;height:110px;background:var(--ba-line);}
.ba-grid{display:grid;grid-template-columns:300px 1fr;gap:56px;align-items:start;padding-top:56px;}
.ba-left{padding-top:8px;}
.ba-eyebrow{font-family:Georgia,'Times New Roman',serif;font-weight:700;font-size:26px;line-height:1.25;color:var(--ba-ink);margin:0 0 4px;letter-spacing:.5px;}
.ba-eyebrow span{display:block;color:var(--ba-orange);}
.ba-desc{margin:22px 0 32px;font-size:15px;line-height:1.7;color:var(--ba-ink-soft);max-width:320px;}
.ba-nav{display:flex;gap:14px;}
.ba-nav button{width:44px;height:44px;border:1.5px solid var(--ba-orange);background:transparent;border-radius:var(--ba-radius);color:var(--ba-orange);font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background var(--ba-transition),color var(--ba-transition),transform 160ms ease;}
.ba-nav button:hover{background:var(--ba-orange);color:#fff;}
.ba-nav button:active{transform:scale(.94);}
.ba-nav button:focus-visible{outline:2px solid var(--ba-orange-dark);outline-offset:3px;}
.ba-nav button:disabled{opacity:.35;cursor:not-allowed;background:transparent;color:var(--ba-orange);}
.ba-carousel{position:relative;overflow:hidden;}
.ba-track{display:flex;transition:transform var(--ba-transition);will-change:transform;}
.ba-card{flex:0 0 calc((100% - 2 * 32px) / 3);margin-right:32px;border:1px solid var(--ba-card-line);display:flex;flex-direction:column;}
.ba-card:last-child{margin-right:0;}
.ba-card-img{width:100%;aspect-ratio:4/3;object-fit:cover;display:block;background:#eee;}
.ba-card-body{padding:20px 22px 24px;display:flex;flex-direction:column;flex:1;}
.ba-card-title{font-family:Georgia,'Times New Roman',serif;font-size:20px;font-weight:600;color:#3E4C5E;margin:0 0 8px;padding-bottom:10px;border-bottom:2px solid var(--ba-orange);display:inline-block;width:fit-content;}
.ba-card-text{font-size:14px;line-height:1.6;color:var(--ba-ink-soft);margin:6px 0 20px;flex:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
.ba-readmore{display:inline-flex;align-items:center;gap:8px;align-self:flex-start;background:var(--ba-orange);color:#fff;font-size:14px;font-weight:600;text-decoration:none;padding:11px 20px;border-radius:var(--ba-radius);border:none;cursor:pointer;transition:background 200ms ease,transform 160ms ease;}
.ba-readmore:hover{background:var(--ba-orange-dark);}
.ba-readmore:active{transform:scale(.97);}
.ba-readmore svg{transition:transform 200ms ease;}
.ba-readmore:hover svg{transform:translateX(3px);}
.ba-dots{display:none;justify-content:center;gap:8px;margin-top:24px;}
.ba-dots button{width:8px;height:8px;border-radius:50%;border:none;background:var(--ba-card-line);cursor:pointer;padding:0;}
.ba-dots button.active{background:var(--ba-orange);width:22px;border-radius:5px;transition:width 200ms ease;}
.ba-scrolltop{position:fixed;right:28px;bottom:28px;width:46px;height:46px;border-radius:50%;background:var(--ba-blue);color:#fff;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 6px 18px rgba(30,136,199,.35);opacity:0;pointer-events:none;transform:translateY(8px);transition:opacity 250ms ease,transform 250ms ease;z-index:50;}
.ba-scrolltop.show{opacity:1;pointer-events:auto;transform:translateY(0);}
@media (prefers-reduced-motion: reduce){
  .ba-track,.ba-readmore,.ba-readmore svg,.ba-nav button,.ba-scrolltop{transition:none !important;}
}
@media (max-width:960px){
  .ba-grid{grid-template-columns:1fr;gap:32px;}
  .ba-desc{max-width:none;}
  .ba-card{flex:0 0 calc((100% - 24px) / 2);margin-right:24px;}
}
@media (max-width:640px){
  .ba-wrapper{padding:56px 18px 80px;}
  .ba-card{flex:0 0 100%;margin-right:0;}
  .ba-dots{display:flex;}
  .ba-nav{display:none;}
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
<a class="ann-viewall ann-viewall--top" href="notice.php">View All <span class="material-symbols-outlined">arrow_forward</span></a>
</div>
<div class="notice-grid" id="annGrid" data-loading="true">
<div class="notice-card notice-skel-card">
<span class="skel" style="width:35%;height:14px;margin-bottom:16px;"></span>
<span class="skel" style="width:80%;height:20px;margin-bottom:14px;"></span>
<span class="skel" style="width:100%;height:12px;margin-bottom:8px;"></span>
<span class="skel" style="width:92%;height:12px;margin-bottom:8px;"></span>
<span class="skel" style="width:60%;height:12px;"></span>
</div>
<div class="notice-card notice-skel-card">
<span class="skel" style="width:35%;height:14px;margin-bottom:16px;"></span>
<span class="skel" style="width:80%;height:20px;margin-bottom:14px;"></span>
<span class="skel" style="width:100%;height:12px;margin-bottom:8px;"></span>
<span class="skel" style="width:92%;height:12px;margin-bottom:8px;"></span>
<span class="skel" style="width:60%;height:12px;"></span>
</div>
<div class="notice-card notice-skel-card">
<span class="skel" style="width:35%;height:14px;margin-bottom:16px;"></span>
<span class="skel" style="width:80%;height:20px;margin-bottom:14px;"></span>
<span class="skel" style="width:100%;height:12px;margin-bottom:8px;"></span>
<span class="skel" style="width:92%;height:12px;margin-bottom:8px;"></span>
<span class="skel" style="width:60%;height:12px;"></span>
</div>
</div>
<div class="notice-viewall-bottom">
<a class="ann-viewall" href="notice.php">View All Notices <span class="material-symbols-outlined">arrow_forward</span></a>
</div>
</div>
</section>
<!-- ABOUT SECTION -->
<section class="section-lg about-sec">
<div class="container">
<div class="about-grid">
<div class="about-media reveal reveal--left">
<img alt="Myra Global School Campus" class="about-img" src="assets/images/school.png"/>
</div>
<div class="about-copy reveal reveal--right">
<span class="eyebrow">Our Legacy</span>
<h2 class="heading-lg">Building Excellence, Inspiring Generations</h2>
<p class="about-lead">Established in 1985, Myra Globe School is committed to providing quality education through academic excellence, innovative learning, and strong values. With a legacy of holistic development, leadership, and creativity, we continue to nurture confident learners prepared for success in a global world.</p>
<p class="about-text">Myra Globe School is committed to excellence in education, fostering creativity, integrity, and innovation. We empower students with the knowledge, confidence, and values to become responsible global citizens and future leaders.</p>
<a class="btn-solid-primary" href="about.php" style="display:inline-block;">Know more</a>
</div>
</div>
</div>
</section>
<!-- MISSION & VISION SECTION -->
<section class="section-lg mv-sec">
<div class="container">
<div class="mv-grid">
<div class="mv-card mv-card--dark reveal">
<span class="material-symbols-outlined mv-ico mv-ico--gold">psychology</span>
<h3 class="heading-lg heading-lg--light">Our Mission</h3>
<p class="mv-text">"To empower students with the knowledge, skills, and character necessary to excel in a rapidly changing global society, through a curriculum that emphasizes critical thinking, creativity, and compassionate leadership."</p>
</div>
<div class="mv-card mv-card--light reveal" data-delay="1">
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
<div class="gallery-grid" id="galleryGrid" data-loading="true">
<div class="gallery-item g-big"><div class="gallery-skel" style="width:100%;height:100%;"></div></div>
<div class="gallery-item g-sm"><div class="gallery-skel" style="width:100%;height:100%;"></div></div>
<div class="gallery-item g-sm"><div class="gallery-skel" style="width:100%;height:100%;"></div></div>
<div class="gallery-item g-wide"><div class="gallery-skel" style="width:100%;height:100%;"></div></div>
</div>
<div class="gallery-cta">
<a class="btn-outline-primary" href="gallery.php" style="display:inline-block;">View Full Gallery</a>
</div>
</div>
</section>
<!-- FACILITIES SECTION -->
<section class="facilities-sec">
  <div class="container">
    <div class="facilities-head">
      <h2 class="facilities-title">FACILITIES</h2>
      <p class="facilities-desc">
        At Myra Global School, education transcends academics, creating an exciting, caring and supportive space where students thrive and all-round development takes centre stage.
      </p>
      <a href="#" class="facilities-btn">
        View All &rarr;
      </a>
    </div>

    <div class="facilities-grid">
      <!-- Card 1: Hands-on / Experiential Learning -->
      <div class="facility-card reveal" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew');">
        <div class="facility-badge-corner facility-badge-corner--blue"></div>
        <span class="material-symbols-outlined facility-badge-icon">groups</span>
        <div class="facility-overlay">
          <h3 class="facility-overlay-title">Interactive Learning</h3>
          <p class="facility-overlay-desc">Hands-on practical models and collaborative activity-based learning modules designed for early development.</p>
        </div>
      </div>

      <!-- Card 2: Performing Arts & Music Room -->
      <div class="facility-card reveal" data-delay="1" style="background-image: url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&q=80');">
        <div class="facility-badge-corner facility-badge-corner--green"></div>
        <span class="material-symbols-outlined facility-badge-icon">sports_gymnastics</span>
        <div class="facility-overlay">
          <h3 class="facility-overlay-title">Music & Culture</h3>
          <p class="facility-overlay-desc">Dedicated acoustic spaces for classical music, Indian percussion, and group vocal training.</p>
        </div>
      </div>

      <!-- Card 3: Smart Classroom -->
      <div class="facility-card reveal" data-delay="2" style="background-image: url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80');">
        <div class="facility-badge-corner facility-badge-corner--orange"></div>
        <span class="material-symbols-outlined facility-badge-icon">co_present</span>
        <div class="facility-overlay">
          <h3 class="facility-overlay-title">Digital Classrooms</h3>
          <p class="facility-overlay-desc">Equipped with interactive smart displays, audio-visual technology, and comfortable seating arrangements.</p>
        </div>
      </div>

      <!-- Card 4: Science & Chemistry Lab -->
      <div class="facility-card reveal" data-delay="3" style="background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80');">
        <div class="facility-badge-corner facility-badge-corner--red"></div>
        <span class="material-symbols-outlined facility-badge-icon">science</span>
        <div class="facility-overlay">
          <h3 class="facility-overlay-title">Science Laboratories</h3>
          <p class="facility-overlay-desc">Modern science apparatus for physics, chemistry, and biology experimental learning under expert supervision.</p>
        </div>
      </div>

      <!-- Card 5: Library & Reading Room -->
      <div class="facility-card reveal" data-delay="4" style="background-image: url('https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=600&q=80');">
        <div class="facility-badge-corner facility-badge-corner--blue"></div>
        <span class="material-symbols-outlined facility-badge-icon">menu_book</span>
        <div class="facility-overlay">
          <h3 class="facility-overlay-title">Knowledge Center</h3>
          <p class="facility-overlay-desc">Extensive collection of books, research journals, and digital archives promoting reading habits.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Life at Myra: dynamic albums collage -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  var grid = document.getElementById('galleryGrid');
  if (!grid) return;

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }

  // collage span classes per album count, by card index
  var LAYOUTS = {
    1: ['g-full'],
    2: ['g-half', 'g-half'],
    3: ['g-big', 'g-wide', 'g-wide'],
    4: ['g-big', 'g-sm', 'g-sm', 'g-wide']
  };

  function cardHtml(a, cls){
    var media = a.cover_url
      ? '<img class="gallery-img" alt="' + esc(a.title) + '" src="' + esc(a.cover_url) + '"/>'
      : '<div class="gallery-cover-empty"><span class="material-symbols-outlined">image</span></div>';
    return '<a class="gallery-item ' + cls + '" href="album.php?id=' + a.id + '">'
      + media
      + '<div class="gallery-caption"><span class="gallery-caption-pill">' + esc(a.title) + '</span></div>'
      + '</a>';
  }

  fetch('actions/homepage/latest_albums.php?limit=4', { headers: { 'Accept': 'application/json' } })
    .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
    .then(function (res) {
      if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
      var rows = res.d.rows || [];
      grid.removeAttribute('data-loading');
      if (!rows.length) {
        grid.innerHTML = '<div class="gallery-state"><span class="material-symbols-outlined">photo_library</span>'
          + '<h3>No Albums Yet</h3><p>Photos from our events and campus life will appear here soon.</p></div>';
        return;
      }
      var layout = LAYOUTS[Math.min(rows.length, 4)] || LAYOUTS[4];
      grid.innerHTML = rows.map(function (a, i) { return cardHtml(a, (layout[i] || 'g-sm') + ' annfade'); }).join('');
    })
    .catch(function () {
      grid.removeAttribute('data-loading');
      grid.innerHTML = '<div class="gallery-state"><span class="material-symbols-outlined">error</span>'
        + '<h3>Could not load gallery</h3><p>Please refresh the page or try again in a moment.</p></div>';
    });
});
</script>
<!-- BEYOND ACADEMICS -->
<section class="ba-wrapper" aria-label="Beyond Academics">
  <span class="ba-frame-top" aria-hidden="true"></span>
  <span class="ba-frame-left" aria-hidden="true"></span>

  <div class="ba-grid">

    <!-- LEFT: heading, copy, nav controls -->
    <div class="ba-left">
      <h2 class="ba-eyebrow">BEYOND<span>ACADEMICS</span></h2>
      <p class="ba-desc">
        Myra Global School offers a range of extracurricular activities to help
        students develop their interests and talents.
      </p>
      <div class="ba-nav">
        <button type="button" id="baPrev" aria-label="Previous activities">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M15 5L8 12L15 19" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button type="button" id="baNext" aria-label="Next activities">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
    </div>

    <!-- RIGHT: carousel -->
    <div class="ba-carousel">
      <div class="ba-track" id="baTrack">
        <!-- cards injected by JS -->
      </div>
    </div>

  </div>

  <div class="ba-dots" id="baDots"></div>
</section>

<button class="ba-scrolltop" id="baScrollTop" aria-label="Scroll to top">
  <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 19V5M12 5L6 11M12 5L18 11" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
</button>

<script>
(function(){
  // ---- Replace this data with your real activities/images/links ----
  const cards = [
    {
      img: "https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80",
      title: "SLP",
      text: "The Student Leadership Programme (SLP) is a comprehensive life skills initiative designed to build confidence and responsibility in every learner.",
      link: "#"
    },
    {
      img: "https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=600&q=80",
      title: "Sports",
      text: "Sports is an integral part of the curriculum, promoting overall health, teamwork and well-being among students of every age group.",
      link: "#"
    },
    {
      img: "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=80",
      title: "Read Programme",
      text: "Reading presents an excellent opportunity to experience new worlds, build vocabulary and cultivate a lifelong love of learning.",
      link: "#"
    },
    {
      img: "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80",
      title: "Art & Craft",
      text: "Creative expression through art and craft helps students explore imagination while developing fine motor and design skills.",
      link: "#"
    },
    {
      img: "https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=600&q=80",
      title: "Music",
      text: "Our music programme nurtures rhythm, discipline and self-expression through vocal training and instrumental practice.",
      link: "#"
    },
    {
      img: "https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=600&q=80",
      title: "Field Trips",
      text: "Curated field trips connect classroom learning to the real world, building curiosity beyond the four walls of school.",
      link: "#"
    }
  ];

  const track   = document.getElementById('baTrack');
  const prevBtn = document.getElementById('baPrev');
  const nextBtn = document.getElementById('baNext');
  const dotsBox = document.getElementById('baDots');

  let perView = getPerView();
  let index = 0; // index of the left-most visible card

  function getPerView(){
    const w = window.innerWidth;
    if (w <= 640) return 1;
    if (w <= 960) return 2;
    return 3;
  }

  function render(){
    track.innerHTML = cards.map(c => `
      <article class="ba-card">
        <img class="ba-card-img" src="${c.img}" alt="${c.title}" loading="lazy">
        <div class="ba-card-body">
          <h3 class="ba-card-title">${c.title}</h3>
          <p class="ba-card-text">${c.text}</p>
          <a class="ba-readmore" href="${c.link}">
            Read More
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </article>
    `).join('');
    buildDots();
    update();
  }

  function buildDots(){
    const maxIndex = Math.max(cards.length - perView, 0);
    dotsBox.innerHTML = '';
    for(let i=0;i<=maxIndex;i++){
      const b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Go to slide ' + (i+1));
      b.addEventListener('click', () => { index = i; update(); });
      dotsBox.appendChild(b);
    }
  }

  function update(){
    const maxIndex = Math.max(cards.length - perView, 0);
    index = Math.min(Math.max(index, 0), maxIndex);

    const cardEl = track.querySelector('.ba-card');
    if (!cardEl) return;
    const cardWidth = cardEl.getBoundingClientRect().width;
    const gap = 32;
    track.style.transform = `translateX(-${index * (cardWidth + gap)}px)`;

    prevBtn.disabled = index === 0;
    nextBtn.disabled = index === maxIndex;

    [...dotsBox.children].forEach((d,i) => d.classList.toggle('active', i === index));
  }

  prevBtn.addEventListener('click', () => { index--; update(); });
  nextBtn.addEventListener('click', () => { index++; update(); });

  // touch swipe support
  let startX = 0, dragging = false;
  track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; dragging = true; }, {passive:true});
  track.addEventListener('touchend', e => {
    if(!dragging) return;
    const dx = e.changedTouches[0].clientX - startX;
    if (dx > 50) { index--; update(); }
    else if (dx < -50) { index++; update(); }
    dragging = false;
  });

  window.addEventListener('resize', () => {
    const newPerView = getPerView();
    if (newPerView !== perView){
      perView = newPerView;
      buildDots();
    }
    update();
  });

  render();

  // ---- scroll-to-top button ----
  const scrollBtn = document.getElementById('baScrollTop');
  window.addEventListener('scroll', () => {
    scrollBtn.classList.toggle('show', window.scrollY > 300);
  });
  scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top:0, behavior:'smooth' });
  });
})();
</script>
<!-- ENQUIRY FORM SECTION -->
<section class="section-lg enquiry-sec" id="enquiry">
<div class="container">
<div class="enquiry-grid">
<div class="enquiry-info reveal reveal--left">
<h2 class="heading-lg">Have Questions?</h2>
<p class="enquiry-lead">Share your inquiry with us, and our dedicated team will be happy to provide personalized guidance, answer your questions, and help you explore the opportunities at Myra Global School.</p>
<div class="enquiry-contacts">
<div class="enquiry-contact">
<span class="material-symbols-outlined enquiry-contact-ico">call</span>
<div>
<div class="enquiry-contact-label">Admissions Hotline</div>
<div class="enquiry-contact-val">+91 9023762633</div>
</div>
</div>
<div class="enquiry-contact">
<span class="material-symbols-outlined enquiry-contact-ico">mail</span>
<div>
<div class="enquiry-contact-label">Email Us</div>
<div class="enquiry-contact-val">admissions@myraglobalschool.edu</div>
</div>
</div>
</div>
</div>
<div class="enquiry-form-wrap reveal reveal--right">
<div class="enquiry-card">
<form class="enquiry-form" id="enquiryForm" novalidate>
<div class="form-field form-field--full">
<label class="form-label" for="enqName">Name</label>
<input class="form-input" id="enqName" name="name" placeholder="Enter name" type="text" required/>
</div>
<div class="form-field">
<label class="form-label" for="enqPhone">Contact Number</label>
<input class="form-input" id="enqPhone" name="phone" placeholder="Enter contact number" type="text" required/>
</div>
<div class="form-field">
<label class="form-label" for="enqEmail">Email Address</label>
<input class="form-input" id="enqEmail" name="email" placeholder="email@example.com" type="email"/>
</div>
<div class="form-field form-field--full">
<label class="form-label" for="enqMessage">Any specific questions?</label>
<textarea class="form-input" id="enqMessage" name="message" placeholder="How can we help you?" rows="4" required></textarea>
</div>
<div class="form-field--full">
<button class="btn-submit" id="enqSubmit" type="submit">Submit Enquiry</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- Enquiry success popup -->
<div class="enq-modal" id="enqModal" aria-hidden="true" role="dialog" aria-modal="true">
<div class="enq-modal-box">
<div class="enq-tick">
<svg viewBox="0 0 52 52"><circle cx="26" cy="26" r="24"/><path d="M15 27l7 7 15-15"/></svg>
</div>
<h3 class="enq-modal-title">Enquiry Submitted</h3>
<p class="enq-modal-text">Thank you for reaching out. We will reach you soon.</p>
<button class="enq-modal-btn" id="enqModalClose" type="button">Done</button>
</div>
</div>

<script>
(function(){
  var form = document.getElementById('enquiryForm');
  if (!form) return;

  var modal   = document.getElementById('enqModal');
  var btn     = document.getElementById('enqSubmit');
  var closeBtn= document.getElementById('enqModalClose');

  var fields = {
    name:    document.getElementById('enqName'),
    phone:   document.getElementById('enqPhone'),
    email:   document.getElementById('enqEmail'),
    message: document.getElementById('enqMessage')
  };

  function clearErrors(){
    Object.keys(fields).forEach(function(k){
      fields[k].classList.remove('is-invalid');
    });
    form.querySelectorAll('.enq-error').forEach(function(e){ e.remove(); });
  }
  function setError(key, msg){
    var el = fields[key];
    if (!el) return;
    el.classList.add('is-invalid');
    var m = document.createElement('div');
    m.className = 'enq-error show';
    m.textContent = msg;
    el.parentElement.appendChild(m);
  }

  function openModal(){
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(){
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function(e){ if (e.key === 'Escape' && modal.classList.contains('open')) closeModal(); });

  form.addEventListener('submit', function(e){
    e.preventDefault();
    clearErrors();

    btn.disabled = true;
    var original = btn.textContent;
    btn.textContent = 'Submitting…';

    var data = new FormData();
    data.append('name',    fields.name.value.trim());
    data.append('phone',   fields.phone.value.trim());
    data.append('email',   fields.email.value.trim());
    data.append('message', fields.message.value.trim());

    fetch('actions/enquiries/submit.php', { method: 'POST', body: data, headers: { 'Accept': 'application/json' } })
      .then(function(r){ return r.json().then(function(j){ return { ok: r.ok, body: j }; }); })
      .then(function(res){
        var j = res.body || {};
        if (res.ok && j.success){
          form.reset();
          openModal();
          return;
        }
        if (j.errors){
          Object.keys(j.errors).forEach(function(k){ setError(k, j.errors[k]); });
        } else {
          setError('message', j.message || 'Something went wrong. Please try again.');
        }
      })
      .catch(function(){
        setError('message', 'Network error. Please try again.');
      })
      .finally(function(){
        btn.disabled = false;
        btn.textContent = original;
      });
  });
})();
</script>
<!-- Scroll-reveal animations -->
<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  if (!('IntersectionObserver' in window)) { els.forEach(function(el){ el.classList.add('in'); }); return; }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(en){
      if (en.isIntersecting){ en.target.classList.add('in'); io.unobserve(en.target); }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });
  els.forEach(function(el){ io.observe(el); });
})();
</script>
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
<!-- Notice Read-more modal -->
<div class="nmodal" id="annModal" aria-hidden="true">
<div class="nmodal-box">
<div class="nmodal-head">
<div>
<span class="nmodal-cat" id="annMCat"></span>
<span class="nmodal-date" id="annMDate"></span>
</div>
<button class="nmodal-close" id="annMClose" aria-label="Close">&times;</button>
</div>
<h3 class="nmodal-title" id="annMTitle"></h3>
<div class="nmodal-body" id="annMBody"></div>
<div class="nmodal-attach" id="annMAttach"></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var grid = document.getElementById('annGrid');
  if (!grid) return;

  var MAX_WORDS = 40;
  var byId = {};
  var modal = document.getElementById('annModal');

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function cap(s){ return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }
  function truncateWords(str, max){
    var words = String(str || '').trim().split(/\s+/);
    if (words.length <= max) return { text: str, truncated: false };
    return { text: words.slice(0, max).join(' ') + ' …', truncated: true };
  }

  function cardHtml(n, i){
    var secondary = (i % 2 === 1) ? ' notice-card--secondary' : '';
    var t = truncateWords(n.content, MAX_WORDS);
    var action = t.truncated
      ? '<button class="notice-link notice-readmore" data-id="' + n.id + '">Read More <span class="material-symbols-outlined notice-link-ico">arrow_forward</span></button>'
      : '';
    return '<div class="notice-card annfade' + secondary + '" style="animation-delay:' + (i * 0.1) + 's">'
      + '<span class="notice-date">' + esc(n.date) + '</span>'
      + '<h3 class="notice-card-title">' + esc(n.title) + '</h3>'
      + '<p class="notice-card-text">' + esc(t.text) + '</p>'
      + action
      + '</div>';
  }

  function openModal(n){
    document.getElementById('annMCat').textContent = cap(n.category);
    document.getElementById('annMDate').textContent = n.date;
    document.getElementById('annMTitle').textContent = n.title;
    document.getElementById('annMBody').textContent = n.content;
    var chips = [];
    (n.documents || []).forEach(function (d) {
      chips.push('<a class="nmodal-chip" href="' + esc(d.url) + '" target="_blank" rel="noopener"><span class="material-symbols-outlined">description</span>' + esc(d.name) + '</a>');
    });
    (n.links || []).forEach(function (l) {
      chips.push('<a class="nmodal-chip" href="' + esc(l.url) + '" target="_blank" rel="noopener"><span class="material-symbols-outlined">link</span>' + esc(l.title) + '</a>');
    });
    document.getElementById('annMAttach').innerHTML = chips.join('');
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(){
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
  document.getElementById('annMClose').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && modal.classList.contains('open')) closeModal(); });

  grid.addEventListener('click', function (e) {
    var b = e.target.closest('.notice-readmore'); if (!b) return;
    var n = byId[b.getAttribute('data-id')]; if (n) openModal(n);
  });

  fetch('actions/homepage/latest_notices.php?limit=3', { headers: { 'Accept': 'application/json' } })
    .then(function (r) { return r.json(); })
    .then(function (d) {
      if (!d || !d.success) throw new Error('bad response');
      var rows = d.rows || [];
      grid.removeAttribute('data-loading');
      if (!rows.length) {
        grid.innerHTML = '<div class="notice-card"><p class="notice-card-text" style="margin:0;">No announcements at the moment. Please check back soon.</p></div>';
        return;
      }
      byId = {}; rows.forEach(function (n) { byId[n.id] = n; });
      grid.innerHTML = rows.map(cardHtml).join('');
    })
    .catch(function () {
      grid.removeAttribute('data-loading');
      grid.innerHTML = '<div class="notice-card"><p class="notice-card-text" style="margin:0;">Announcements are unavailable right now. '
        + '<a class="notice-link" href="notice.php" style="display:inline-flex;">View all notices <span class="material-symbols-outlined notice-link-ico">arrow_forward</span></a></p></div>';
    });
});
</script>
</body></html>
