<?php
$page_name = 'career';   // drives sidebar highlight + topbar heading

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
<title>Manage Careers | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<style>
/* Selection column */
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,.chkall{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
#vacTable tbody td:nth-child(-n+7),#appTable tbody td:nth-child(-n+6){cursor:pointer;}
.tbl td.sno{color:var(--muted);font-weight:700;}

/* Position / applicant cells */
.pos b{display:block;font-size:14px;font-weight:700;color:var(--ink);}
.pos .muted{display:block;font-size:12px;margin-top:2px;}
.appl b{display:block;font-size:14px;font-weight:700;color:var(--ink);}
.appl span{display:block;font-size:12px;color:var(--muted);margin-top:2px;}
.nowrap{white-space:nowrap;}

/* Status dropdowns */
.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select.s-open{background:var(--green-bg);color:var(--green);}
.status-select.s-paused{background:var(--amber-bg);color:var(--amber);}
.status-select.s-closed{background:var(--bg);color:var(--muted);}
.status-select.s-new{background:var(--blue-bg);color:var(--blue);}
.status-select.s-reviewed{background:var(--green-bg);color:var(--green);}
.status-select.s-shortlisted{background:var(--amber-bg);color:var(--amber);}
.status-select.s-rejected{background:var(--red-bg);color:var(--red);}

/* Pagination footer */
.pager{display:flex;flex-wrap:wrap;gap:12px;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid var(--line);}
.pager-info{color:var(--muted);font-size:13px;}
.pager-left{display:flex;align-items:center;gap:14px;flex-wrap:wrap;}
.perpage{display:flex;align-items:center;gap:7px;font-size:13px;font-weight:600;color:var(--muted);}
.perpage-select{border:1px solid var(--line);border-radius:8px;padding:6px 8px;font-family:inherit;font-size:13px;font-weight:600;background:var(--surface);color:var(--ink);cursor:pointer;}
.perpage-select:focus{outline:none;border-color:var(--primary-container);box-shadow:0 0 0 1px var(--primary-container);}
.pager-btns{display:flex;gap:6px;align-items:center;flex-wrap:wrap;}
.page-btn{min-width:34px;height:34px;padding:0 10px;border:1px solid var(--line);border-radius:8px;background:var(--surface);color:var(--ink);font-weight:600;font-size:13px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;transition:.2s;}
.page-btn:hover:not(:disabled){border-color:var(--primary-container);color:var(--primary-container);}
.page-btn.active{background:var(--primary-container);color:#fff;border-color:var(--primary-container);}
.page-btn:disabled{opacity:.45;cursor:not-allowed;}

/* Bulk action bar */
.bulkbar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;background:var(--blue-bg);border:1px solid #c8dcff;color:var(--blue);border-radius:11px;padding:10px 16px;margin-bottom:16px;font-size:14px;font-weight:600;}
.bulkbar[hidden]{display:none;}
.bulkbar .spacer{flex:1;}
.bulkbar b{font-weight:800;}
.del-count{font-family:var(--font-serif);font-size:40px;font-weight:700;color:var(--red);line-height:1;}
.res-link{display:inline-flex;align-items:center;gap:6px;font-weight:700;font-size:13px;color:var(--blue);}
.res-link:hover{text-decoration:underline;}

/* Application details — plain label + value, not form inputs */
.info-grid{display:grid;grid-template-columns:1fr;gap:16px 28px;}
.info-item{display:flex;flex-direction:column;gap:3px;min-width:0;}
.info-label{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);}
.info-value{font-size:14.5px;font-weight:600;color:var(--ink);word-break:break-word;}
.msg-block{margin-top:20px;padding-top:18px;border-top:1px solid var(--line);}
.msg-text{font-size:14px;line-height:1.7;color:var(--on-surface-variant);white-space:pre-wrap;margin-top:6px;}
@media(min-width:560px){ .info-grid{grid-template-columns:1fr 1fr;} }

/* "Mark as …" status buttons */
.status-actions{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px;}
.mark-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:9999px;font-size:13px;font-weight:700;border:1px solid var(--line);background:var(--surface);cursor:pointer;transition:.2s;}
.mark-btn .material-symbols-outlined{font-size:16px;}
.mark-btn:hover{background:var(--bg);border-color:currentColor;}
.mark-btn[data-set="new"]{color:var(--blue);}
.mark-btn[data-set="reviewed"]{color:var(--green);}
.mark-btn[data-set="shortlisted"]{color:var(--amber);}
.mark-btn[data-set="rejected"]{color:var(--red);}
.mark-btn.is-current{color:#fff;border-color:transparent;}
.mark-btn.is-current[data-set="new"]{background:var(--blue);}
.mark-btn.is-current[data-set="reviewed"]{background:var(--green);}
.mark-btn.is-current[data-set="shortlisted"]{background:var(--amber);}
.mark-btn.is-current[data-set="rejected"]{background:var(--red);}
</style>
<script src="admin.js" defer></script>
</head>
<body>
<div class="admin">

<?php include '../components/admin-sidebar.php'?>

<div class="main">
<?php include '../components/admin-topbar.php'?>

<div class="content">
<div class="page-head">
<div>
<h2>Manage Careers</h2>
<p>Post new vacancies, edit existing openings and review applications received.</p>
</div>
<button class="btn btn-primary" id="addVacancy"><span class="material-symbols-outlined">add</span> Post Vacancy</button>
</div>

<div class="toolbar">
<div class="tabs" id="crTabs">
<button class="tab active" data-tab="vac" type="button">Vacancies <span class="badge2 b-draft" id="vacCount">0</span></button>
<button class="tab" data-tab="app" type="button">Applications <span class="badge2 b-new" id="appCount">0</span></button>
</div>
<div class="spacer"></div>
<div class="search"><span class="material-symbols-outlined">search</span><input id="crSearch" type="text" placeholder="Search vacancies"/></div>
</div>

<!-- ============ VACANCIES ============ -->
<section id="vacView">

<div class="bulkbar" id="bulkBarV" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCountV">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" data-clear="V">Clear selection</button>
<button class="btn btn-danger btn-sm" data-bulkdel="V"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">
<div class="table-wrap">
<table class="tbl" id="vacTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" class="chkall" id="chkAllV" aria-label="Select all"/></th>
<th style="width:52px">#</th>
<th>Position</th>
<th>Department</th>
<th>Type</th>
<th>Openings</th>
<th>Posted</th>
<th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody>
<tr data-status="open" data-title="PGT — Mathematics" data-dept="academic-faculty" data-type="full-time" data-openings="2" data-posted="18 Jul 2026" data-deadline="15 Aug 2026"
    data-desc="Teach Mathematics to Grades 11 and 12. M.Sc with B.Ed required; CBSE board experience preferred."
    data-name="pgt mathematics academic faculty full-time teacher">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td><td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="open" data-title="TGT — English" data-dept="academic-faculty" data-type="full-time" data-openings="1" data-posted="16 Jul 2026" data-deadline="10 Aug 2026"
    data-desc="Teach English to Grades 6 to 10. M.A English with B.Ed; strong communication skills essential."
    data-name="tgt english academic faculty full-time teacher">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td><td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="open" data-title="Sports Coach" data-dept="other" data-type="part-time" data-openings="1" data-posted="12 Jul 2026" data-deadline="05 Aug 2026"
    data-desc="Coach athletics and football for the junior and senior teams. NIS certification preferred."
    data-name="sports coach other part-time athletics football">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td><td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="closed" data-title="Front Office Executive" data-dept="administration" data-type="full-time" data-openings="1" data-posted="02 Jul 2026" data-deadline="30 Jul 2026"
    data-desc="Handle front-desk enquiries, visitor management and parent communication."
    data-name="front office executive administration full-time reception">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td><td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="paused" data-title="Lab Assistant — Chemistry" data-dept="support-staff" data-type="contract" data-openings="2" data-posted="28 Jun 2026" data-deadline="25 Jul 2026"
    data-desc="Maintain the chemistry laboratory, prepare apparatus and assist during practical sessions."
    data-name="lab assistant chemistry support staff contract laboratory">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td><td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="open" data-title="School Counsellor" data-dept="other" data-type="part-time" data-openings="1" data-posted="20 Jun 2026" data-deadline="20 Jul 2026"
    data-desc="Provide counselling support to students and liaise with parents and class teachers."
    data-name="school counsellor other part-time student support">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td><td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
</tbody>
</table>
</div>
<div class="pager">
<div class="pager-left">
<label class="perpage">Show
<select class="perpage-select" id="perPageV">
<option value="5">5</option><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option><option value="all">All</option>
</select>
entries</label>
<span class="pager-info" id="vacInfo"></span>
</div>
<div class="pager-btns" id="vacPages"></div>
</div>
</div>
</section>

<!-- ============ APPLICATIONS ============ -->
<section id="appView" style="display:none">

<div class="toolbar">
<div class="tabs" id="appTabs">
<button class="tab active" data-af="all" type="button">All</button>
<button class="tab" data-af="new" type="button">New</button>
<button class="tab" data-af="reviewed" type="button">Reviewed</button>
<button class="tab" data-af="shortlisted" type="button">Shortlisted</button>
<button class="tab" data-af="rejected" type="button">Rejected</button>
</div>
</div>

<div class="bulkbar" id="bulkBarA" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCountA">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" data-clear="A">Clear selection</button>
<button class="btn btn-danger btn-sm" data-bulkdel="A"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">
<div class="table-wrap">
<table class="tbl" id="appTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" class="chkall" id="chkAllA" aria-label="Select all"/></th>
<th style="width:52px">#</th>
<th>Applicant</th>
<th>Applied For</th>
<th>Experience</th>
<th>Applied On</th>
<th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody>
<tr data-status="new" data-fname="Rahul Mehta" data-email="rahul.mehta@example.com" data-phone="+91 98111 22334"
    data-position="PGT — Mathematics" data-exp="7 years" data-applied="20 Jul 2026" data-resume="../uploads/resumes/rahul-mehta.pdf"
    data-note="B.Ed with M.Sc Mathematics. Currently HOD Maths at a CBSE school; keen to join Myra Global for its academic reputation."
    data-name="rahul mehta pgt mathematics rahul.mehta@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="shortlisted" data-fname="Sneha Iyer" data-email="sneha.iyer@example.com" data-phone="+91 90042 55667"
    data-position="TGT — English" data-exp="4 years" data-applied="19 Jul 2026" data-resume="../uploads/resumes/sneha-iyer.pdf"
    data-note="M.A English, B.Ed. Four years teaching Grades 6-10; strong in communicative English and debate coaching."
    data-name="sneha iyer tgt english sneha.iyer@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="new" data-fname="Amitabh Das" data-email="amitabh.das@example.com" data-phone="+91 98300 11220"
    data-position="Sports Coach" data-exp="6 years" data-applied="18 Jul 2026" data-resume="../uploads/resumes/amitabh-das.pdf"
    data-note="Former state-level athlete, NIS certified. Six years coaching athletics and football at school level."
    data-name="amitabh das sports coach amitabh.das@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="reviewed" data-fname="Priya Nair" data-email="priya.nair@example.com" data-phone="+91 99880 33445"
    data-position="PGT — Mathematics" data-exp="9 years" data-applied="17 Jul 2026" data-resume="../uploads/resumes/priya-nair.pdf"
    data-note="M.Sc, M.Ed. Nine years at ICSE schools, experienced in board result improvement and Olympiad training."
    data-name="priya nair pgt mathematics priya.nair@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="new" data-fname="Karan Malhotra" data-email="karan.malhotra@example.com" data-phone="+91 98220 66778"
    data-position="Front Office Executive" data-exp="3 years" data-applied="15 Jul 2026" data-resume="../uploads/resumes/karan-malhotra.pdf"
    data-note="Graduate with 3 years front-desk experience in the education sector; fluent in English and Hindi."
    data-name="karan malhotra front office executive karan.malhotra@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="new" data-fname="Anjali Verma" data-email="anjali.verma@example.com" data-phone="+91 90555 88991"
    data-position="Lab Assistant — Chemistry" data-exp="2 years" data-applied="14 Jul 2026" data-resume="../uploads/resumes/anjali-verma.pdf"
    data-note="B.Sc Chemistry with two years of laboratory assistance experience at a senior secondary school."
    data-name="anjali verma lab assistant chemistry anjali.verma@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
<tr data-status="reviewed" data-fname="Mohit Sinha" data-email="mohit.sinha@example.com" data-phone="+91 98444 20031"
    data-position="School Counsellor" data-exp="5 years" data-applied="12 Jul 2026" data-resume="../uploads/resumes/mohit-sinha.pdf"
    data-note="M.A Psychology with RCI registration. Five years of school counselling and career guidance experience."
    data-name="mohit sinha school counsellor mohit.sinha@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-appl"></td><td class="c-pos2"></td><td class="c-exp"></td><td class="c-date nowrap"></td><td class="c-status"></td><td class="c-act"></td>
</tr>
</tbody>
</table>
</div>
<div class="pager">
<div class="pager-left">
<label class="perpage">Show
<select class="perpage-select" id="perPageA">
<option value="5">5</option><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option><option value="all">All</option>
</select>
entries</label>
<span class="pager-info" id="appInfo"></span>
</div>
<div class="pager-btns" id="appPages"></div>
</div>
</div>
</section>

</div>
</div>
</div>

<!-- Add / Edit Vacancy modal -->
<div class="modal" id="vacModal">
<div class="modal-box">
<div class="modal-head"><h3 id="vacModalTitle">Post Vacancy</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<form id="vacForm">
<div class="modal-body">
<div class="field"><label>Position Title</label><input class="finput" id="vTitle" type="text" placeholder="e.g. PGT — Mathematics" required/></div>
<div class="field-row">
<div class="field"><label>Department</label>
<select class="finput" id="vDept">
<option value="academic-faculty">Academic Faculty</option>
<option value="administration">Administration</option>
<option value="support-staff">Support Staff</option>
<option value="other">Other</option>
</select>
</div>
<div class="field"><label>Employment Type</label>
<select class="finput" id="vType">
<option value="full-time">Full-time</option>
<option value="part-time">Part-time</option>
<option value="contract">Contract</option>
<option value="internship">Internship</option>
<option value="temporary">Temporary</option>
<option value="freelance">Freelance</option>
</select>
</div>
</div>
<div class="field-row">
<div class="field"><label>No. of Openings</label><input class="finput" id="vOpen" type="number" min="1" value="1" required/></div>
<div class="field"><label>Last Date to Apply</label><input class="finput" id="vLast" type="date" required/></div>
</div>
<div class="field"><label>Job Description</label><textarea class="finput" id="vDesc" placeholder="Roles, responsibilities and qualifications..."></textarea></div>
<div class="field"><label>Status</label>
<select class="finput" id="vStatus"><option value="open">Open</option><option value="paused">Paused</option><option value="closed">Closed</option></select>
</div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary">Save Vacancy</button></div>
</form>
</div>
</div>

<!-- View Application modal -->
<div class="modal" id="appModal">
<div class="modal-box">
<div class="modal-head"><h3>Application Details</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body">
<h2 style="font-family:var(--font-serif);font-size:20px;color:var(--primary-container);margin-bottom:2px" id="aName">—</h2>
<p class="muted" id="aEmail" style="margin-bottom:20px"></p>
<div class="info-grid">
<div class="info-item"><span class="info-label">Phone</span><span class="info-value" id="aPhone">—</span></div>
<div class="info-item"><span class="info-label">Applied For</span><span class="info-value" id="aPosition">—</span></div>
<div class="info-item"><span class="info-label">Experience</span><span class="info-value" id="aExp">—</span></div>
<div class="info-item"><span class="info-label">Applied On</span><span class="info-value" id="aApplied">—</span></div>
</div>
<div class="msg-block">
<span class="info-label">Additional Info</span>
<p class="msg-text" id="aNote">—</p>
</div>
<div class="msg-block">
<span class="info-label">Resume</span>
<div style="margin-top:8px"><a class="res-link" id="aResume" href="#" target="_blank" rel="noopener"><span class="material-symbols-outlined">description</span> Open resume</a></div>
</div>
<div class="msg-block">
<span class="info-label">Update Status</span>
<div class="status-actions" id="aStatusActions">
<button type="button" class="mark-btn" data-set="new"><span class="material-symbols-outlined">fiber_new</span> Mark as New</button>
<button type="button" class="mark-btn" data-set="reviewed"><span class="material-symbols-outlined">task_alt</span> Mark as Reviewed</button>
<button type="button" class="mark-btn" data-set="shortlisted"><span class="material-symbols-outlined">star</span> Mark as Shortlisted</button>
<button type="button" class="mark-btn" data-set="rejected"><span class="material-symbols-outlined">cancel</span> Mark as Rejected</button>
</div>
</div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Close</button></div>
</div>
</div>

<!-- Bulk delete confirmation popup -->
<div class="modal" id="bulkDelModal">
<div class="modal-box" style="max-width:420px">
<div class="modal-head"><h3>Delete Selected</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body" style="text-align:center">
<span class="material-symbols-outlined" style="font-size:44px;color:var(--red)">warning</span>
<div class="del-count" id="delCount" style="margin-top:8px">0</div>
<p style="margin-top:6px" id="delNoun">entries will be deleted</p>
<p class="muted" style="margin-top:10px">This action cannot be undone.</p>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Cancel</button><button class="btn btn-danger" id="bulkDelConfirm"><span class="material-symbols-outlined">delete</span> Delete</button></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var term = '';

  var DEPT_LABEL = { 'academic-faculty': 'Academic Faculty', 'administration': 'Administration', 'support-staff': 'Support Staff', 'other': 'Other' };
  var TYPE_LABEL = { 'full-time': 'Full-time', 'part-time': 'Part-time', 'contract': 'Contract', 'internship': 'Internship', 'temporary': 'Temporary', 'freelance': 'Freelance' };

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
    });
  }
  function selectHtml(value, options){
    return '<select class="status-select s-' + value + '">' + options.map(function (o) {
      return '<option value="' + o[0] + '"' + (o[0] === value ? ' selected' : '') + '>' + o[1] + '</option>';
    }).join('') + '</select>';
  }
  var VAC_STATUSES = [['open','Open'],['paused','Paused'],['closed','Closed']];
  var APP_STATUSES = [['new','New'],['reviewed','Reviewed'],['shortlisted','Shortlisted'],['rejected','Rejected']];

  /* ============================================================
     Reusable table controller: selection + pagination + bulk delete
     ============================================================ */
  function makeCtl(cfg){
    var table = document.getElementById(cfg.tableId);
    var tbody = table.querySelector('tbody');
    var chkAll = document.getElementById(cfg.chkAllId);
    var perPage = document.getElementById(cfg.perPageId);
    var infoEl = document.getElementById(cfg.infoId);
    var pagesEl = document.getElementById(cfg.pagesId);
    var bulkBar = document.getElementById(cfg.bulkBarId);
    var bulkCount = document.getElementById(cfg.bulkCountId);
    var page = 1;

    function allRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }
    function matches(r){
      if (cfg.extraMatch && !cfg.extraMatch(r)) return false;
      return !term || (r.getAttribute('data-name') || '').indexOf(term) > -1;
    }
    function filteredRows(){ return allRows().filter(matches); }
    function checkedRows(){ return allRows().filter(function (r) { return r.querySelector('.rowchk').checked; }); }

    function updateBulkBar(){
      var n = checkedRows().length;
      bulkCount.textContent = n;
      bulkBar.hidden = (n === 0);
    }
    function syncSelectAll(){
      var f = filteredRows();
      var c = f.filter(function (r) { return r.querySelector('.rowchk').checked; }).length;
      chkAll.checked = f.length > 0 && c === f.length;
      chkAll.indeterminate = c > 0 && c < f.length;
      updateBulkBar();
    }

    function render(){
      var rows = allRows();
      var list = rows.filter(matches);
      var total = list.length;
      var raw = perPage.value;
      var size = (raw === 'all') ? Math.max(total, 1) : (parseInt(raw, 10) || 10);
      var pages = Math.max(1, Math.ceil(total / size));
      if (page > pages) page = pages;
      if (page < 1) page = 1;
      var start = (page - 1) * size, end = start + size;

      rows.forEach(function (r) { r.style.display = 'none'; });
      list.forEach(function (r, i) {
        if (i >= start && i < end) { r.style.display = ''; r.querySelector('.sno').textContent = i + 1; }
      });

      infoEl.textContent = total === 0
        ? 'No ' + cfg.noun + ' found'
        : 'Showing ' + (start + 1) + '–' + Math.min(end, total) + ' of ' + total;

      pagesEl.innerHTML = '';
      function addBtn(html, target, opts){
        opts = opts || {};
        var b = document.createElement('button');
        b.className = 'page-btn' + (opts.active ? ' active' : '');
        b.innerHTML = html;
        if (opts.disabled) b.disabled = true;
        else b.addEventListener('click', function () { page = target; render(); });
        pagesEl.appendChild(b);
      }
      addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>', page - 1, {disabled: page === 1});
      for (var p = 1; p <= pages; p++) addBtn(String(p), p, {active: p === page});
      addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>', page + 1, {disabled: page === pages});

      syncSelectAll();
      if (cfg.onRender) cfg.onRender(allRows().length);
    }

    chkAll.addEventListener('change', function () {
      var on = this.checked;
      filteredRows().forEach(function (r) { r.querySelector('.rowchk').checked = on; });
      syncSelectAll();
    });

    // click a row (up to cfg.clickMax) toggles selection
    tbody.addEventListener('click', function (e) {
      if (e.target.closest('.acts') || e.target.closest('.status-select') || e.target.closest('a')) return;
      var td = e.target.closest('td'); if (!td) return;
      var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
      if (idx < 0 || idx > cfg.clickMax) return;
      var chk = td.parentNode.querySelector('.rowchk');
      if (e.target === chk) return;
      chk.checked = !chk.checked;
      syncSelectAll();
    });

    table.addEventListener('change', function (e) {
      if (e.target.classList.contains('status-select')) {
        var r = e.target.closest('tr');
        r.setAttribute('data-status', e.target.value);
        e.target.className = 'status-select s-' + e.target.value;
        return;
      }
      if (e.target.classList.contains('rowchk')) syncSelectAll();
    });

    perPage.addEventListener('change', function () { page = 1; render(); });

    return {
      render: render,
      resetPage: function () { page = 1; },
      allRows: allRows,
      checkedRows: checkedRows,
      tbody: tbody,
      clearSelection: function () {
        allRows().forEach(function (r) { r.querySelector('.rowchk').checked = false; });
        syncSelectAll();
      }
    };
  }

  /* ---------- Painters ---------- */
  function paintVac(tr){
    tr.querySelector('.c-pos').innerHTML   = '<div class="pos"><b>' + esc(tr.getAttribute('data-title')) + '</b>' +
                                             '<span class="muted">Last date: ' + esc(tr.getAttribute('data-deadline')) + '</span></div>';
    tr.querySelector('.c-dept').textContent  = DEPT_LABEL[tr.getAttribute('data-dept')] || tr.getAttribute('data-dept');
    tr.querySelector('.c-type').textContent  = TYPE_LABEL[tr.getAttribute('data-type')] || tr.getAttribute('data-type');
    tr.querySelector('.c-open').textContent  = tr.getAttribute('data-openings');
    tr.querySelector('.c-posted').textContent = tr.getAttribute('data-posted');
    tr.querySelector('.c-status').innerHTML  = selectHtml(tr.getAttribute('data-status'), VAC_STATUSES);
    tr.querySelector('.c-act').innerHTML =
      '<div class="acts" style="justify-content:flex-end">' +
      '<button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button>' +
      '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div>';
  }
  function paintApp(tr){
    tr.querySelector('.c-appl').innerHTML = '<div class="appl"><b>' + esc(tr.getAttribute('data-fname')) + '</b>' +
                                            '<span>' + esc(tr.getAttribute('data-email')) + '</span></div>';
    tr.querySelector('.c-pos2').textContent = tr.getAttribute('data-position');
    tr.querySelector('.c-exp').textContent  = tr.getAttribute('data-exp');
    tr.querySelector('.c-date').textContent = tr.getAttribute('data-applied');
    tr.querySelector('.c-status').innerHTML = selectHtml(tr.getAttribute('data-status'), APP_STATUSES);
    tr.querySelector('.c-act').innerHTML =
      '<div class="acts" style="justify-content:flex-end">' +
      '<button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button>' +
      '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div>';
  }

  /* ---------- Controllers ---------- */
  var vacCtl = makeCtl({
    tableId: 'vacTable', chkAllId: 'chkAllV', perPageId: 'perPageV', infoId: 'vacInfo', pagesId: 'vacPages',
    bulkBarId: 'bulkBarV', bulkCountId: 'bulkCountV', clickMax: 6, noun: 'vacancies',
    onRender: function (n) { document.getElementById('vacCount').textContent = n; }
  });
  var appFilter = 'all';
  var appCtl = makeCtl({
    tableId: 'appTable', chkAllId: 'chkAllA', perPageId: 'perPageA', infoId: 'appInfo', pagesId: 'appPages',
    bulkBarId: 'bulkBarA', bulkCountId: 'bulkCountA', clickMax: 5, noun: 'applications',
    extraMatch: function (r) { return appFilter === 'all' || r.getAttribute('data-status') === appFilter; },
    onRender: function (n) { document.getElementById('appCount').textContent = n; }
  });

  // Application status filter tabs
  document.getElementById('appTabs').addEventListener('click', function (e) {
    var t = e.target.closest('.tab'); if (!t) return;
    this.querySelectorAll('.tab').forEach(function (x) { x.classList.remove('active'); });
    t.classList.add('active');
    appFilter = t.getAttribute('data-af');
    appCtl.resetPage();
    appCtl.render();
  });

  vacCtl.allRows().forEach(paintVac);
  appCtl.allRows().forEach(paintApp);

  /* ---------- Tabs ---------- */
  var current = 'vac';
  var searchInput = document.getElementById('crSearch');
  document.getElementById('crTabs').addEventListener('click', function (e) {
    var t = e.target.closest('.tab'); if (!t) return;
    this.querySelectorAll('.tab').forEach(function (x) { x.classList.remove('active'); });
    t.classList.add('active');
    current = t.getAttribute('data-tab');
    document.getElementById('vacView').style.display = current === 'vac' ? '' : 'none';
    document.getElementById('appView').style.display = current === 'app' ? '' : 'none';
    searchInput.placeholder = current === 'vac' ? 'Search vacancies' : 'Search applications';
  });

  searchInput.addEventListener('input', function () {
    term = this.value.trim().toLowerCase();
    vacCtl.resetPage(); appCtl.resetPage();
    vacCtl.render(); appCtl.render();
  });

  document.addEventListener('admin:rowdeleted', function () { vacCtl.render(); appCtl.render(); });

  /* ---------- Bulk delete (shared popup) ---------- */
  var bulkDelModal = document.getElementById('bulkDelModal');
  var pendingCtl = null;

  document.addEventListener('click', function (e) {
    var clear = e.target.closest('[data-clear]');
    if (clear) { (clear.getAttribute('data-clear') === 'V' ? vacCtl : appCtl).clearSelection(); return; }

    var del = e.target.closest('[data-bulkdel]');
    if (del) {
      var which = del.getAttribute('data-bulkdel');
      pendingCtl = (which === 'V') ? vacCtl : appCtl;
      var n = pendingCtl.checkedRows().length;
      if (!n) return;
      document.getElementById('delCount').textContent = n;
      document.getElementById('delNoun').textContent =
        (which === 'V' ? (n === 1 ? 'vacancy' : 'vacancies') : (n === 1 ? 'application' : 'applications')) + ' will be deleted';
      bulkDelModal.classList.add('open');
    }
  });

  document.getElementById('bulkDelConfirm').addEventListener('click', function () {
    if (pendingCtl) {
      pendingCtl.checkedRows().forEach(function (r) { r.remove(); });
      pendingCtl.render();
    }
    bulkDelModal.classList.remove('open');
  });

  /* ---------- Vacancy add / edit ---------- */
  var vModal = document.getElementById('vacModal');
  var vForm = document.getElementById('vacForm');
  var vTitleEl = document.getElementById('vacModalTitle');
  var editing = null;

  function fmtDate(v){ if (!v) return ''; var d = new Date(v); return isNaN(d) ? v : d.toLocaleDateString('en-GB', {day:'2-digit', month:'short', year:'numeric'}); }
  function toInputDate(display){
    var d = new Date(display); if (isNaN(d)) return '';
    return d.getFullYear() + '-' + ('0' + (d.getMonth() + 1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
  }

  document.getElementById('addVacancy').addEventListener('click', function () {
    editing = null; vTitleEl.textContent = 'Post Vacancy';
    vForm.reset(); document.getElementById('vOpen').value = 1;
    vModal.classList.add('open');
  });

  vacCtl.tbody.addEventListener('click', function (e) {
    var b = e.target.closest('.edit'); if (!b) return;
    var tr = b.closest('tr'); editing = tr;
    vTitleEl.textContent = 'Edit Vacancy';
    document.getElementById('vTitle').value  = tr.getAttribute('data-title');
    document.getElementById('vDept').value   = tr.getAttribute('data-dept');
    document.getElementById('vType').value   = tr.getAttribute('data-type');
    document.getElementById('vOpen').value   = tr.getAttribute('data-openings');
    document.getElementById('vLast').value   = toInputDate(tr.getAttribute('data-deadline'));
    document.getElementById('vDesc').value   = tr.getAttribute('data-desc') || '';
    document.getElementById('vStatus').value = tr.getAttribute('data-status');
    vModal.classList.add('open');
  });

  vForm.addEventListener('submit', function (e) {
    e.preventDefault();
    var t = document.getElementById('vTitle').value.trim();
    var dept = document.getElementById('vDept').value;
    var type = document.getElementById('vType').value;
    var openings = document.getElementById('vOpen').value;
    var last = document.getElementById('vLast').value;
    var desc = document.getElementById('vDesc').value.trim();
    var status = document.getElementById('vStatus').value;

    var tr = editing;
    if (!tr) {
      tr = document.createElement('tr');
      tr.innerHTML = '<td class="selcol"><input type="checkbox" class="rowchk"/></td><td class="sno"></td><td class="c-pos"></td>' +
                     '<td class="c-dept"></td><td class="c-type"></td><td class="c-open"></td><td class="c-posted nowrap"></td>' +
                     '<td class="c-status"></td><td class="c-act"></td>';
      tr.setAttribute('data-posted', fmtDate(new Date()));
      vacCtl.tbody.insertBefore(tr, vacCtl.tbody.firstChild);
    }
    tr.setAttribute('data-title', t);
    tr.setAttribute('data-dept', dept);
    tr.setAttribute('data-type', type);
    tr.setAttribute('data-openings', openings);
    tr.setAttribute('data-deadline', fmtDate(last));
    tr.setAttribute('data-desc', desc);
    tr.setAttribute('data-status', status);
    tr.setAttribute('data-name', (t + ' ' + DEPT_LABEL[dept] + ' ' + TYPE_LABEL[type] + ' ' + desc).toLowerCase());
    paintVac(tr);
    vModal.classList.remove('open');
    vacCtl.render();
  });

  /* ---------- Application view ---------- */
  var aModal = document.getElementById('appModal');
  var viewingRow = null;

  appCtl.tbody.addEventListener('click', function (e) {
    var b = e.target.closest('.view'); if (!b) return;
    var tr = b.closest('tr'); viewingRow = tr;
    document.getElementById('aName').textContent     = tr.getAttribute('data-fname');
    document.getElementById('aEmail').textContent    = tr.getAttribute('data-email');
    document.getElementById('aPhone').textContent    = tr.getAttribute('data-phone');
    document.getElementById('aPosition').textContent = tr.getAttribute('data-position');
    document.getElementById('aExp').textContent      = tr.getAttribute('data-exp');
    document.getElementById('aApplied').textContent  = tr.getAttribute('data-applied');
    document.getElementById('aNote').textContent     = tr.getAttribute('data-note') || '—';
    document.getElementById('aResume').href          = tr.getAttribute('data-resume') || '#';
    markCurrent(tr.getAttribute('data-status') || 'new');
    aModal.classList.add('open');
  });

  // highlight whichever status the application currently has
  var statusActions = document.getElementById('aStatusActions');
  function markCurrent(s){
    statusActions.querySelectorAll('.mark-btn').forEach(function (b) {
      b.classList.toggle('is-current', b.getAttribute('data-set') === s);
    });
  }

  // "Mark as …" applies the status straight away
  statusActions.addEventListener('click', function (e) {
    var b = e.target.closest('.mark-btn'); if (!b || !viewingRow) return;
    var s = b.getAttribute('data-set');
    viewingRow.setAttribute('data-status', s);
    viewingRow.querySelector('.c-status').innerHTML = selectHtml(s, APP_STATUSES);
    markCurrent(s);
    aModal.classList.remove('open');
    appCtl.render(); // row may leave the active status filter
  });

  vacCtl.render();
  appCtl.render();
});
</script>
</body></html>
