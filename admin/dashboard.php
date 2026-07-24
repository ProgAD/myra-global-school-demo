<?php
$page_name = 'dashboard';   // drives sidebar highlight + topbar heading
// ===== Session guard: only logged-in users may view admin pages =====
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin Dashboard | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
:root{
  --primary-container:#002147;--primary-dark:#0c2242;--secondary-fixed:#ffe088;--secondary-fixed-dim:#e9c349;
  --on-surface-variant:#5c6b7f;--on-primary:#ffffff;--primary:#000a1e;--secondary:#735c00;
  --surface:#ffffff;--bg:#eef1f6;--line:#e2e7ef;--muted:#7787a0;--ink:#1e2430;
  --green:#227a52;--green-bg:#e2f7ec;--amber:#8a6d1a;--amber-bg:#fff3d6;--blue:#2b4c8c;--blue-bg:#e2ecff;--red:#c0392b;--red-bg:#ffe3df;
  --font-serif:"Source Serif 4", Georgia, serif;--font-sans:"Source Sans 3", system-ui, sans-serif;
}
*,*::before,*::after{box-sizing:border-box;}*{margin:0;}
body{background:var(--bg);color:var(--ink);font-family:var(--font-sans);font-size:15px;line-height:1.5;-webkit-font-smoothing:antialiased;}
a{text-decoration:none;color:inherit;}ul{list-style:none;}button{font-family:inherit;background:none;border:none;cursor:pointer;}
img{display:block;max-width:100%;}
.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;display:inline-block;vertical-align:middle;}

.admin{display:flex;min-height:100vh;}

/* ===== Sidebar ===== */
.sidebar{width:256px;flex-shrink:0;background:var(--primary-container);color:#c7d3e6;position:fixed;top:0;left:0;bottom:0;display:flex;flex-direction:column;z-index:60;transition:transform .3s ease;}
.side-brand{display:flex;align-items:center;gap:10px;padding:20px 22px;border-bottom:1px solid rgba(255,255,255,.08);}
.side-brand .crest{width:38px;height:38px;border-radius:9px;background:var(--secondary-fixed);color:var(--primary-container);display:flex;align-items:center;justify-content:center;font-family:var(--font-serif);font-weight:700;font-size:16px;flex-shrink:0;}
.side-brand .name{font-family:var(--font-serif);font-weight:700;font-size:16px;color:#fff;line-height:1.1;}
.side-brand .name small{display:block;font-family:var(--font-sans);font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:var(--secondary-fixed);margin-top:2px;}
.side-logo{height:auto;max-width:100%;display:block;}
.side-brand-link{display:flex;align-items:center;justify-content:center;width:100%;}
.side-fallback{display:flex;align-items:center;gap:10px;}
.side-group{padding:16px 14px;flex:1;overflow-y:auto;}
.side-label{font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#61789c;padding:0 12px;margin-bottom:8px;}
.nav-a{display:flex;align-items:center;gap:12px;padding:11px 12px;border-radius:9px;color:#c7d3e6;font-weight:600;font-size:14.5px;transition:.2s;margin-bottom:2px;}
.nav-a .material-symbols-outlined{font-size:21px;}
.nav-a:hover{background:rgba(255,255,255,.07);color:#fff;}
.nav-a.active{background:var(--secondary-fixed);color:var(--primary-container);}
.nav-a .badge{margin-left:auto;background:var(--red);color:#fff;font-size:11px;font-weight:700;padding:1px 8px;border-radius:9999px;}
.nav-a.active .badge{background:var(--primary-container);color:#fff;}
.side-foot{padding:14px;border-top:1px solid rgba(255,255,255,.08);}

/* ===== Main ===== */
.main{margin-left:256px;flex:1;min-width:0;display:flex;flex-direction:column;}

/* Topbar */
.topbar{height:66px;background:var(--surface);border-bottom:1px solid var(--line);display:flex;align-items:center;gap:16px;padding:0 26px;position:sticky;top:0;z-index:40;}
.hamburger{display:none;font-size:26px;color:var(--ink);}
.topbar h1{font-family:var(--font-serif);font-size:22px;font-weight:700;color:var(--primary-container);}
.topbar .spacer{flex:1;}
.icon-btn{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--on-surface-variant);position:relative;transition:.2s;}
.icon-btn:hover{background:var(--bg);color:var(--primary-container);}
.icon-btn .dot{position:absolute;top:9px;right:9px;width:8px;height:8px;border-radius:50%;background:var(--red);border:2px solid var(--surface);}
.profile{display:flex;align-items:center;gap:10px;padding-left:8px;border-left:1px solid var(--line);}
.avatar{width:38px;height:38px;border-radius:50%;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;font-family:var(--font-serif);font-weight:700;}
.profile .who{line-height:1.2;}
.profile .who b{font-size:14px;color:var(--ink);}
.profile .who span{font-size:12px;color:var(--muted);}

/* Content */
.content{padding:26px;max-width:1400px;width:100%;}
.page-head{margin-bottom:22px;}
.page-head h2{font-family:var(--font-serif);font-size:26px;font-weight:700;color:var(--primary-container);}
.page-head p{color:var(--muted);margin-top:4px;}

/* Stat cards */
.stat-grid{display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:24px;}
.stat{background:var(--surface);border:1px solid var(--line);border-radius:14px;padding:20px;display:flex;align-items:center;gap:16px;}
.stat-ico{width:52px;height:52px;border-radius:12px;flex-shrink:0;display:flex;align-items:center;justify-content:center;}
.stat-ico .material-symbols-outlined{font-size:26px;}
.stat-ico.b1{background:var(--blue-bg);color:var(--blue);}
.stat-ico.b2{background:var(--amber-bg);color:var(--amber);}
.stat-ico.b3{background:var(--green-bg);color:var(--green);}
.stat-ico.b4{background:#efe6ff;color:#6b3fa0;}
.stat-ico.b5{background:var(--secondary-fixed);color:var(--primary-container);}
.stat .num{font-family:var(--font-serif);font-size:28px;font-weight:700;color:var(--primary-container);line-height:1;}
.stat .lbl{color:var(--muted);font-size:13.5px;font-weight:600;margin-top:4px;}

/* Manage cards */
.section-title{font-family:var(--font-serif);font-size:19px;font-weight:700;color:var(--primary-container);margin:6px 0 16px;}
.manage-grid{display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:28px;}
.mcard{background:var(--surface);border:1px solid var(--line);border-radius:14px;padding:22px;transition:.25s;display:flex;flex-direction:column;}
.mcard:hover{border-color:var(--primary-container);box-shadow:0 10px 26px rgba(0,33,71,.08);transform:translateY(-3px);}
.mcard-ico{width:48px;height:48px;border-radius:12px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;margin-bottom:16px;}
.mcard-ico .material-symbols-outlined{font-size:24px;}
.mcard h4{font-family:var(--font-serif);font-size:18px;font-weight:700;color:var(--primary-container);margin-bottom:6px;}
.mcard p{color:var(--muted);font-size:14px;flex:1;margin-bottom:16px;}
.mcard .go{display:inline-flex;align-items:center;gap:6px;font-weight:700;color:var(--primary-container);font-size:14px;}
.mcard:hover .go{gap:10px;}
.mcard .go .material-symbols-outlined{font-size:18px;}

/* Panels row */
.panels{display:grid;grid-template-columns:1fr;gap:18px;}
.panel{background:var(--surface);border:1px solid var(--line);border-radius:14px;overflow:hidden;}
.panel-head{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid var(--line);}
.panel-head h3{font-family:var(--font-serif);font-size:17px;font-weight:700;color:var(--primary-container);}
.panel-head a{font-size:13px;font-weight:700;color:var(--primary-container);display:inline-flex;align-items:center;gap:4px;}

/* Table */
.tbl{width:100%;border-collapse:collapse;}
.tbl th{text-align:left;font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);padding:12px 22px;border-bottom:1px solid var(--line);}
.tbl td{padding:14px 22px;border-bottom:1px solid var(--line);font-size:14px;}
.tbl tr:last-child td{border-bottom:none;}
.tbl tr:hover td{background:#fafbfd;}
.u{display:flex;align-items:center;gap:10px;}
.u .ua{width:34px;height:34px;border-radius:50%;background:var(--bg);color:var(--primary-container);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;}
.u b{font-size:14px;color:var(--ink);}
.u span{font-size:12px;color:var(--muted);}
.badge2{display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:9999px;font-size:12.5px;font-weight:700;}
.badge2 .material-symbols-outlined{font-size:14px;}
.b-verify{background:var(--amber-bg);color:var(--amber);}
.b-done{background:var(--green-bg);color:var(--green);}
.b-new{background:var(--blue-bg);color:var(--blue);}
.row-act{color:var(--muted);width:34px;height:34px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;}
.row-act:hover{background:var(--bg);color:var(--primary-container);}

/* Enquiries list */
.enq{display:flex;gap:14px;padding:16px 22px;border-bottom:1px solid var(--line);}
.enq:last-child{border-bottom:none;}
.enq-ico{width:38px;height:38px;border-radius:10px;background:var(--blue-bg);color:var(--blue);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.enq b{font-size:14px;color:var(--ink);}
.enq p{font-size:13px;color:var(--muted);margin-top:2px;}
.enq .time{margin-left:auto;font-size:12px;color:var(--muted);white-space:nowrap;}

.overlay{display:none;position:fixed;inset:0;background:rgba(9,25,50,.5);z-index:55;}
.overlay.show{display:block;}

@media(min-width:600px){
  .stat-grid{grid-template-columns:repeat(2,1fr);}
  .manage-grid{grid-template-columns:repeat(2,1fr);}
}
@media(min-width:1100px){
  .stat-grid{grid-template-columns:repeat(4,1fr);}
  .manage-grid{grid-template-columns:repeat(4,1fr);}
  .panels{grid-template-columns:1.6fr 1fr;}
}
@media(max-width:1023px){
  .sidebar{transform:translateX(-100%);}
  .sidebar.open{transform:translateX(0);}
  .main{margin-left:0;}
  .hamburger{display:inline-flex;}
}
</style>
</head>
<body>
<div class="admin">

<!-- Sidebar -->
<?php include '../components/admin-sidebar.php'?>

<!-- Main -->
<div class="main">

<!-- Topbar -->
<?php include '../components/admin-topbar.php'?>

<!-- Content -->
<div class="content">

<div class="page-head">
<h2>Welcome back, Admin 👋</h2>
<p>Here's what's happening at Myra Global School today.</p>
</div>

<!-- Stats -->
<div class="stat-grid">
<div class="stat"><span class="stat-ico b1"><span class="material-symbols-outlined">school</span></span><div><div class="num" id="stTotalApplications">—</div><div class="lbl">Total Applications</div></div></div>
<div class="stat"><span class="stat-ico b2"><span class="material-symbols-outlined">pending_actions</span></span><div><div class="num" id="stPendingVerification">—</div><div class="lbl">Pending Verification</div></div></div>
<div class="stat"><span class="stat-ico b3"><span class="material-symbols-outlined">campaign</span></span><div><div class="num" id="stPublishedNotices">—</div><div class="lbl">Published Notices</div></div></div>
<div class="stat"><span class="stat-ico b4"><span class="material-symbols-outlined">mark_email_unread</span></span><div><div class="num" id="stNewEnquiries">—</div><div class="lbl">New Enquiries</div></div></div>
<div class="stat"><span class="stat-ico b5"><span class="material-symbols-outlined">work</span></span><div><div class="num" id="stCareerApplications">—</div><div class="lbl">Career Applications</div></div></div>
</div>

<!-- Manage -->
<div class="section-title">Manage</div>
<div class="manage-grid">
<a class="mcard" href="admissions.php">
<span class="mcard-ico"><span class="material-symbols-outlined">school</span></span>
<h4>Admissions</h4>
<p>Review applications, verify documents and update admission status.</p>
<span class="go">Open <span class="material-symbols-outlined">arrow_forward</span></span>
</a>
<a class="mcard" href="notices.php">
<span class="mcard-ico"><span class="material-symbols-outlined">campaign</span></span>
<h4>Notices</h4>
<p>Create, edit or remove notices and news for the website.</p>
<span class="go">Open <span class="material-symbols-outlined">arrow_forward</span></span>
</a>
<a class="mcard" href="gallery.php">
<span class="mcard-ico"><span class="material-symbols-outlined">photo_library</span></span>
<h4>Gallery</h4>
<p>Manage albums, upload photos and videos of school events.</p>
<span class="go">Open <span class="material-symbols-outlined">arrow_forward</span></span>
</a>
<a class="mcard" href="enquiries.php">
<span class="mcard-ico"><span class="material-symbols-outlined">mail</span></span>
<h4>Enquiries</h4>
<p>View and respond to enquiries received from parents.</p>
<span class="go">Open <span class="material-symbols-outlined">arrow_forward</span></span>
</a>
<a class="mcard" href="career.php">
<span class="mcard-ico"><span class="material-symbols-outlined">work</span></span>
<h4>Careers</h4>
<p>Post vacancies, edit openings and review job applications.</p>
<span class="go">Open <span class="material-symbols-outlined">arrow_forward</span></span>
</a>
</div>


</div>
</div>
</div>

<script>
  (function () {
    var sb = document.getElementById('sidebar');
    var ov = document.getElementById('overlay');
    var hb = document.getElementById('hamburger');
    function close(){ sb.classList.remove('open'); ov.classList.remove('show'); }
    hb.addEventListener('click', function(){ sb.classList.toggle('open'); ov.classList.toggle('show'); });
    ov.addEventListener('click', close);
  })();

  // ===== Load dashboard stats from the backend =====
  (function () {
    var map = {
      total_applications:   'stTotalApplications',
      pending_verification: 'stPendingVerification',
      published_notices:    'stPublishedNotices',
      new_enquiries:        'stNewEnquiries',
      career_applications:  'stCareerApplications'
    };

    fetch('../actions/admin/dashboard_stats.php', { headers: { 'Accept': 'application/json' } })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (!data || !data.success || !data.stats) throw new Error('bad response');
        Object.keys(map).forEach(function (key) {
          var el = document.getElementById(map[key]);
          if (el) el.textContent = (data.stats[key] != null ? data.stats[key] : 0);
        });
      })
      .catch(function () {
        // On failure show 0 rather than a stuck placeholder
        Object.keys(map).forEach(function (key) {
          var el = document.getElementById(map[key]);
          if (el && el.textContent === '—') el.textContent = '0';
        });
      });
  })();
</script>
</body></html>
