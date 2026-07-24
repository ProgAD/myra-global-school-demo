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
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,.chkall{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
#vacTable tbody td:nth-child(-n+7),#appTable tbody td:nth-child(-n+6){cursor:pointer;}
.tbl td.sno{color:var(--muted);font-weight:700;}

.pos b{display:block;font-size:14px;font-weight:700;color:var(--ink);}
.pos span{display:block;font-size:12px;color:var(--muted);margin-top:2px;}
.appl b{display:block;font-size:14px;font-weight:700;color:var(--ink);}
.appl span{display:block;font-size:12px;color:var(--muted);margin-top:2px;}
.nowrap{white-space:nowrap;}

.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select:disabled{opacity:.6;cursor:wait;}
.status-select.s-open{background:var(--green-bg);color:var(--green);}
.status-select.s-paused{background:var(--amber-bg);color:var(--amber);}
.status-select.s-closed{background:var(--bg);color:var(--muted);}
.status-select.s-new{background:var(--blue-bg);color:var(--blue);}
.status-select.s-reviewed{background:var(--green-bg);color:var(--green);}
.status-select.s-shortlisted{background:var(--amber-bg);color:var(--amber);}
.status-select.s-rejected{background:var(--red-bg);color:var(--red);}

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

.bulkbar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;background:var(--blue-bg);border:1px solid #c8dcff;color:var(--blue);border-radius:11px;padding:10px 16px;margin-bottom:16px;font-size:14px;font-weight:600;}
.bulkbar[hidden]{display:none;}
.bulkbar .spacer{flex:1;}
.bulkbar b{font-weight:800;}
.del-count{font-family:var(--font-serif);font-size:40px;font-weight:700;color:var(--red);line-height:1;}

/* Application details — plain label + value */
.info-grid{display:grid;grid-template-columns:1fr;gap:16px 28px;}
.info-item{display:flex;flex-direction:column;gap:3px;min-width:0;}
.info-label{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);}
.info-value{font-size:14.5px;font-weight:600;color:var(--ink);word-break:break-word;}
.msg-block{margin-top:20px;padding-top:18px;border-top:1px solid var(--line);}
.msg-text{font-size:14px;line-height:1.7;color:var(--on-surface-variant);white-space:pre-wrap;margin-top:6px;}
@media(min-width:560px){ .info-grid{grid-template-columns:1fr 1fr;} }
.res-link{display:inline-flex;align-items:center;gap:6px;font-weight:700;font-size:13px;color:var(--blue);}
.res-link:hover{text-decoration:underline;}

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

.state-box{text-align:center;padding:56px 20px;color:var(--muted);}
.state-box .material-symbols-outlined{font-size:52px;color:var(--line);}
.state-box h4{font-family:var(--font-serif);font-size:19px;font-weight:700;color:var(--primary-container);margin-top:10px;}
.state-box p{margin-top:6px;font-size:14px;}
.state-box.err h4{color:var(--red);}
.spin{width:30px;height:30px;border:3px solid var(--line);border-top-color:var(--primary-container);border-radius:50%;animation:sp .7s linear infinite;margin:0 auto;}
@keyframes sp{to{transform:rotate(360deg);}}
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

<div class="toolbar">
<div class="tabs" id="vacTabs">
<button class="tab active" data-vf="all" type="button">All</button>
<button class="tab" data-vf="open" type="button">Open</button>
<button class="tab" data-vf="paused" type="button">Paused</button>
<button class="tab" data-vf="closed" type="button">Closed</button>
</div>
</div>

<div class="bulkbar" id="bulkBarV" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCountV">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" data-clear="V">Clear selection</button>
<button class="btn btn-danger btn-sm" data-bulkdel="V"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">
<div class="state-box" id="loadingV"><div class="spin"></div><p style="margin-top:12px">Loading vacancies…</p></div>
<div class="state-box" id="emptyV" style="display:none">
<span class="material-symbols-outlined">work</span><h4>No Vacancy Yet</h4><p id="emptyHintV">No vacancies have been posted so far.</p>
</div>
<div class="state-box err" id="errorV" style="display:none">
<span class="material-symbols-outlined">error</span><h4>Could not load vacancies</h4><p id="errorMsgV"></p>
<button class="btn btn-ghost btn-sm" data-retry="V" style="margin-top:14px"><span class="material-symbols-outlined">refresh</span> Retry</button>
</div>
<div id="wrapV" style="display:none">
<div class="table-wrap">
<table class="tbl" id="vacTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" class="chkall" id="chkAllV" aria-label="Select all"/></th>
<th style="width:52px">#</th><th>Position</th><th>Department</th><th>Type</th><th>Openings</th><th>Posted</th><th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>
<div class="pager">
<div class="pager-left">
<label class="perpage">Show
<select class="perpage-select" id="perPageV"><option value="5">5</option><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option><option value="all">All</option></select>
entries</label>
<span class="pager-info" id="infoV"></span>
</div>
<div class="pager-btns" id="pagesV"></div>
</div>
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
<div class="state-box" id="loadingA"><div class="spin"></div><p style="margin-top:12px">Loading applications…</p></div>
<div class="state-box" id="emptyA" style="display:none">
<span class="material-symbols-outlined">how_to_reg</span><h4>No Application Yet</h4><p id="emptyHintA">No job applications have been received so far.</p>
</div>
<div class="state-box err" id="errorA" style="display:none">
<span class="material-symbols-outlined">error</span><h4>Could not load applications</h4><p id="errorMsgA"></p>
<button class="btn btn-ghost btn-sm" data-retry="A" style="margin-top:14px"><span class="material-symbols-outlined">refresh</span> Retry</button>
</div>
<div id="wrapA" style="display:none">
<div class="table-wrap">
<table class="tbl" id="appTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" class="chkall" id="chkAllA" aria-label="Select all"/></th>
<th style="width:52px">#</th><th>Applicant</th><th>Applied For</th><th>Experience</th><th>Applied On</th><th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>
<div class="pager">
<div class="pager-left">
<label class="perpage">Show
<select class="perpage-select" id="perPageA"><option value="5">5</option><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option><option value="all">All</option></select>
entries</label>
<span class="pager-info" id="infoA"></span>
</div>
<div class="pager-btns" id="pagesA"></div>
</div>
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
<option value="academic-faculty">Academic Faculty</option><option value="administration">Administration</option>
<option value="support-staff">Support Staff</option><option value="other">Other</option>
</select>
</div>
<div class="field"><label>Employment Type</label>
<select class="finput" id="vType">
<option value="full-time">Full-time</option><option value="part-time">Part-time</option><option value="contract">Contract</option>
<option value="internship">Internship</option><option value="temporary">Temporary</option><option value="freelance">Freelance</option>
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
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary" id="vSaveBtn">Save Vacancy</button></div>
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
<div class="msg-block"><span class="info-label">Additional Info</span><p class="msg-text" id="aNote">—</p></div>
<div class="msg-block"><span class="info-label">Resume</span>
<div style="margin-top:8px"><a class="res-link" id="aResume" href="#" target="_blank" rel="noopener"><span class="material-symbols-outlined">description</span> Open resume</a></div>
</div>
<div class="msg-block"><span class="info-label">Update Status</span>
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

<!-- Bulk delete popup -->
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
  var API_V = '../actions/admin/careers/vacancies/';
  var API_A = '../actions/admin/careers/applications/';

  var VAC_STATUSES = [['open','Open'],['paused','Paused'],['closed','Closed']];
  var APP_STATUSES = [['new','New'],['reviewed','Reviewed'],['shortlisted','Shortlisted'],['rejected','Rejected']];

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function selectHtml(value, options){
    return '<select class="status-select s-'+value+'">' + options.map(function(o){
      return '<option value="'+o[0]+'"'+(o[0]===value?' selected':'')+'>'+o[1]+'</option>';
    }).join('') + '</select>';
  }

  /* ============================================================
     Reusable DB-backed table controller
     ============================================================ */
  function makeCtl(cfg){
    var table   = document.getElementById(cfg.tableId);
    var tbody   = table.querySelector('tbody');
    var chkAll  = document.getElementById(cfg.chkAllId);
    var perPage = document.getElementById(cfg.perPageId);
    var infoEl  = document.getElementById(cfg.infoId);
    var pagesEl = document.getElementById(cfg.pagesId);
    var bulkBar = document.getElementById(cfg.bulkBarId);
    var bulkCnt = document.getElementById(cfg.bulkCountId);
    var boxes = {
      loading: document.getElementById(cfg.loadingId),
      empty:   document.getElementById(cfg.emptyId),
      error:   document.getElementById(cfg.errorId),
      table:   document.getElementById(cfg.wrapId)
    };

    var st = { status:'all', page:1, total:0, pages:1, rows:[] };
    var byId = {}, selected = {};

    function selectedIds(){ return Object.keys(selected).filter(function(k){ return selected[k]; }); }
    function show(w){ Object.keys(boxes).forEach(function(k){ boxes[k].style.display = (k===w?'':'none'); }); }
    function pageRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }

    function updateBulkBar(){
      var n = selectedIds().length;
      bulkCnt.textContent = n;
      bulkBar.hidden = (n === 0);
    }
    function syncSelectAll(){
      var rows = pageRows();
      var n = rows.filter(function(r){ return r.querySelector('.rowchk').checked; }).length;
      chkAll.checked = rows.length>0 && n===rows.length;
      chkAll.indeterminate = n>0 && n<rows.length;
      updateBulkBar();
    }

    function load(){
      show('loading');
      var qs = new URLSearchParams({ status: st.status, q: term, page: st.page, per_page: perPage.value });
      fetch(cfg.api + 'list.php?' + qs.toString(), { headers:{'Accept':'application/json'} })
        .then(function(r){ return r.json().then(function(d){ return {ok:r.ok,d:d}; }); })
        .then(function(res){
          if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
          st.rows = res.d.rows||[]; st.total = res.d.total||0;
          st.pages = res.d.pages||1; st.page = res.d.page||1;
          byId = {}; st.rows.forEach(function(r){ byId[r.id] = r; });
          document.getElementById(cfg.countBadgeId).textContent = st.total;
          render();
        })
        .catch(function(err){
          document.getElementById(cfg.errorMsgId).textContent = err.message || 'Please try again.';
          show('error'); updateBulkBar();
        });
    }

    function render(){
      if (st.total === 0) {
        document.getElementById(cfg.emptyHintId).textContent =
          (st.status !== 'all' || term !== '') ? 'Nothing matches this filter or search.' : cfg.emptyText;
        show('empty'); updateBulkBar(); return;
      }
      var per = perPage.value === 'all' ? st.total : parseInt(perPage.value, 10);
      var start = perPage.value === 'all' ? 0 : (st.page - 1) * per;

      tbody.innerHTML = '';
      st.rows.forEach(function(r,i){
        var tr = document.createElement('tr');
        tr.setAttribute('data-id', r.id);
        tr.innerHTML = cfg.rowHtml(r, start + i + 1, !!selected[r.id]);
        tbody.appendChild(tr);
      });

      infoEl.textContent = 'Showing '+(start+1)+'–'+(start+st.rows.length)+' of '+st.total;

      pagesEl.innerHTML = '';
      function addBtn(html, target, o){
        o=o||{}; var b=document.createElement('button');
        b.className='page-btn'+(o.active?' active':''); b.innerHTML=html;
        if(o.disabled) b.disabled=true; else b.addEventListener('click', function(){ st.page=target; load(); });
        pagesEl.appendChild(b);
      }
      addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>', st.page-1, {disabled:st.page===1});
      for (var p=1;p<=st.pages;p++) addBtn(String(p), p, {active:p===st.page});
      addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>', st.page+1, {disabled:st.page===st.pages});

      show('table'); syncSelectAll();
    }

    chkAll.addEventListener('change', function(){
      var on = this.checked;
      pageRows().forEach(function(tr){
        tr.querySelector('.rowchk').checked = on;
        if (on) selected[tr.dataset.id]=true; else delete selected[tr.dataset.id];
      });
      syncSelectAll();
    });

    tbody.addEventListener('click', function(e){
      if (e.target.closest('.acts') || e.target.closest('.status-select') || e.target.closest('a')) return;
      var td = e.target.closest('td'); if(!td) return;
      var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
      if (idx < 0 || idx > cfg.clickMax) return;
      var chk = td.parentNode.querySelector('.rowchk');
      if (e.target === chk) return;
      chk.checked = !chk.checked;
      if (chk.checked) selected[td.parentNode.dataset.id]=true; else delete selected[td.parentNode.dataset.id];
      syncSelectAll();
    });

    table.addEventListener('change', function(e){
      if (e.target.classList.contains('rowchk')) {
        var tr = e.target.closest('tr');
        if (e.target.checked) selected[tr.dataset.id]=true; else delete selected[tr.dataset.id];
        syncSelectAll(); return;
      }
      if (!e.target.classList.contains('status-select')) return;
      var sel = e.target, id = sel.closest('tr').dataset.id;
      var prev = (byId[id]||{}).status, next = sel.value;
      sel.disabled = true;
      fetch(cfg.api + 'update_status.php', {
        method:'POST', headers:{'Content-Type':'application/json'},
        body: JSON.stringify({ id:id, status:next })
      }).then(function(r){ return r.json(); })
        .then(function(d){ if(!d.success) throw new Error(d.message||'Update failed'); load(); })
        .catch(function(err){
          sel.value = prev; sel.className = 'status-select s-'+prev; sel.disabled = false;
          alert('Could not update status: '+err.message);
        });
    });

    perPage.addEventListener('change', function(){ st.page = 1; load(); });

    function postDelete(ids){
      return fetch(cfg.api + 'delete.php', {
        method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({ ids: ids })
      }).then(function(r){ return r.json(); })
        .then(function(d){ if(!d.success) throw new Error(d.message||'Delete failed'); return d; })
        .catch(function(err){ alert('Could not delete: '+err.message); });
    }

    return {
      load: load,
      setStatus: function(s){ st.status = s; st.page = 1; },
      resetPage: function(){ st.page = 1; },
      tbody: tbody,
      row: function(id){ return byId[id]; },
      selectedIds: selectedIds,
      clearSelection: function(){
        selected = {};
        pageRows().forEach(function(tr){ tr.querySelector('.rowchk').checked = false; });
        syncSelectAll();
      },
      dropSelected: function(id){ delete selected[id]; },
      postDelete: postDelete
    };
  }

  /* ---------- row renderers ---------- */
  function vacRow(r, serial, isSel){
    return '<td class="selcol"><input type="checkbox" class="rowchk"'+(isSel?' checked':'')+'/></td>'+
      '<td class="sno">'+serial+'</td>'+
      '<td><div class="pos"><b>'+esc(r.title)+'</b><span>Last date: '+esc(r.deadline)+'</span></div></td>'+
      '<td>'+esc(r.dept_label)+'</td><td>'+esc(r.type_label)+'</td><td>'+esc(r.openings)+'</td>'+
      '<td class="nowrap">'+esc(r.posted)+'</td>'+
      '<td>'+selectHtml(r.status, VAC_STATUSES)+'</td>'+
      '<td><div class="acts" style="justify-content:flex-end">'+
        '<button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button>'+
        '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>'+
      '</div></td>';
  }
  function appRow(r, serial, isSel){
    return '<td class="selcol"><input type="checkbox" class="rowchk"'+(isSel?' checked':'')+'/></td>'+
      '<td class="sno">'+serial+'</td>'+
      '<td><div class="appl"><b>'+esc(r.name)+'</b><span>'+esc(r.email)+'</span></div></td>'+
      '<td>'+esc(r.position)+'</td><td>'+esc(r.experience)+'</td>'+
      '<td class="nowrap">'+esc(r.applied)+'</td>'+
      '<td>'+selectHtml(r.status, APP_STATUSES)+'</td>'+
      '<td><div class="acts" style="justify-content:flex-end">'+
        '<button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button>'+
        '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>'+
      '</div></td>';
  }

  var term = '';

  var vacCtl = makeCtl({
    api: API_V, tableId:'vacTable', chkAllId:'chkAllV', perPageId:'perPageV', infoId:'infoV', pagesId:'pagesV',
    bulkBarId:'bulkBarV', bulkCountId:'bulkCountV', loadingId:'loadingV', emptyId:'emptyV', errorId:'errorV',
    wrapId:'wrapV', errorMsgId:'errorMsgV', emptyHintId:'emptyHintV', countBadgeId:'vacCount',
    emptyText:'No vacancies have been posted so far.', clickMax:6, rowHtml: vacRow
  });
  var appCtl = makeCtl({
    api: API_A, tableId:'appTable', chkAllId:'chkAllA', perPageId:'perPageA', infoId:'infoA', pagesId:'pagesA',
    bulkBarId:'bulkBarA', bulkCountId:'bulkCountA', loadingId:'loadingA', emptyId:'emptyA', errorId:'errorA',
    wrapId:'wrapA', errorMsgId:'errorMsgA', emptyHintId:'emptyHintA', countBadgeId:'appCount',
    emptyText:'No job applications have been received so far.', clickMax:5, rowHtml: appRow
  });

  /* ---------- tabs / filters / search ---------- */
  var current = 'vac';
  var searchInput = document.getElementById('crSearch');

  document.getElementById('crTabs').addEventListener('click', function(e){
    var t = e.target.closest('.tab'); if(!t) return;
    this.querySelectorAll('.tab').forEach(function(x){ x.classList.remove('active'); });
    t.classList.add('active');
    current = t.getAttribute('data-tab');
    document.getElementById('vacView').style.display = current==='vac'?'':'none';
    document.getElementById('appView').style.display = current==='app'?'':'none';
    searchInput.placeholder = current==='vac' ? 'Search vacancies' : 'Search applications';
  });

  document.getElementById('vacTabs').addEventListener('click', function(e){
    var t = e.target.closest('.tab'); if(!t) return;
    this.querySelectorAll('.tab').forEach(function(x){ x.classList.remove('active'); });
    t.classList.add('active'); vacCtl.setStatus(t.getAttribute('data-vf')); vacCtl.load();
  });
  document.getElementById('appTabs').addEventListener('click', function(e){
    var t = e.target.closest('.tab'); if(!t) return;
    this.querySelectorAll('.tab').forEach(function(x){ x.classList.remove('active'); });
    t.classList.add('active'); appCtl.setStatus(t.getAttribute('data-af')); appCtl.load();
  });

  var timer = null;
  searchInput.addEventListener('input', function(){
    var v = this.value.trim(); clearTimeout(timer);
    timer = setTimeout(function(){
      term = v; vacCtl.resetPage(); appCtl.resetPage();
      vacCtl.load(); appCtl.load();
    }, 300);
  });

  document.addEventListener('click', function(e){
    var rt = e.target.closest('[data-retry]');
    if (rt) { (rt.getAttribute('data-retry')==='V' ? vacCtl : appCtl).load(); return; }
    var cl = e.target.closest('[data-clear]');
    if (cl) { (cl.getAttribute('data-clear')==='V' ? vacCtl : appCtl).clearSelection(); return; }
    var bd = e.target.closest('[data-bulkdel]');
    if (bd) {
      var which = bd.getAttribute('data-bulkdel');
      pendingCtl = (which==='V') ? vacCtl : appCtl;
      var n = pendingCtl.selectedIds().length; if(!n) return;
      document.getElementById('delCount').textContent = n;
      document.getElementById('delNoun').textContent =
        (which==='V' ? (n===1?'vacancy':'vacancies') : (n===1?'application':'applications')) + ' will be deleted';
      bulkDelModal.classList.add('open');
    }
  });

  /* ---------- bulk delete ---------- */
  var bulkDelModal = document.getElementById('bulkDelModal');
  var pendingCtl = null;
  document.getElementById('bulkDelConfirm').addEventListener('click', function(){
    bulkDelModal.classList.remove('open');
    if (!pendingCtl) return;
    var ids = pendingCtl.selectedIds(); if(!ids.length) return;
    var ctl = pendingCtl;
    ctl.postDelete(ids).then(function(){ ctl.clearSelection(); ctl.load(); });
  });

  /* ---------- single delete (admin.js confirms) ---------- */
  var pendingDelete = { ctl:null, id:null };
  vacCtl.tbody.addEventListener('click', function(e){
    var d = e.target.closest('[data-del]');
    if (d) pendingDelete = { ctl: vacCtl, id: d.closest('tr').dataset.id };
  });
  appCtl.tbody.addEventListener('click', function(e){
    var d = e.target.closest('[data-del]');
    if (d) pendingDelete = { ctl: appCtl, id: d.closest('tr').dataset.id };
  });
  document.addEventListener('admin:rowdeleted', function(){
    var p = pendingDelete; pendingDelete = { ctl:null, id:null };
    if (!p.ctl || !p.id) return;
    p.ctl.postDelete([p.id]).then(function(){ p.ctl.dropSelected(p.id); p.ctl.load(); });
  });

  /* ---------- vacancy add / edit ---------- */
  var vModal = document.getElementById('vacModal');
  var vForm = document.getElementById('vacForm');
  var vTitleEl = document.getElementById('vacModalTitle');
  var editingId = 0;

  document.getElementById('addVacancy').addEventListener('click', function(){
    editingId = 0; vTitleEl.textContent = 'Post Vacancy';
    vForm.reset(); document.getElementById('vOpen').value = 1;
    vModal.classList.add('open');
  });

  vacCtl.tbody.addEventListener('click', function(e){
    var b = e.target.closest('.edit'); if(!b) return;
    var r = vacCtl.row(b.closest('tr').dataset.id); if(!r) return;
    editingId = r.id; vTitleEl.textContent = 'Edit Vacancy';
    document.getElementById('vTitle').value  = r.title;
    document.getElementById('vDept').value   = r.department;
    document.getElementById('vType').value   = r.type;
    document.getElementById('vOpen').value   = r.openings;
    document.getElementById('vLast').value   = r.deadline_iso || '';
    document.getElementById('vDesc').value   = r.description || '';
    document.getElementById('vStatus').value = r.status;
    vModal.classList.add('open');
  });

  vForm.addEventListener('submit', function(e){
    e.preventDefault();
    var btn = document.getElementById('vSaveBtn');
    btn.disabled = true;
    fetch(API_V + 'save.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({
        id: editingId,
        title: document.getElementById('vTitle').value.trim(),
        description: document.getElementById('vDesc').value.trim(),
        department: document.getElementById('vDept').value,
        type: document.getElementById('vType').value,
        openings: document.getElementById('vOpen').value,
        deadline: document.getElementById('vLast').value,
        status: document.getElementById('vStatus').value
      })
    }).then(function(r){ return r.json(); })
      .then(function(d){
        if(!d.success) throw new Error(d.message||'Save failed');
        vModal.classList.remove('open'); vacCtl.load();
      })
      .catch(function(err){ alert('Could not save: '+err.message); })
      .finally(function(){ btn.disabled = false; });
  });

  /* ---------- application view ---------- */
  var aModal = document.getElementById('appModal');
  var statusActions = document.getElementById('aStatusActions');
  var viewingId = 0;

  function markCurrent(s){
    statusActions.querySelectorAll('.mark-btn').forEach(function(b){
      b.classList.toggle('is-current', b.getAttribute('data-set') === s);
    });
  }

  appCtl.tbody.addEventListener('click', function(e){
    var b = e.target.closest('.view'); if(!b) return;
    var r = appCtl.row(b.closest('tr').dataset.id); if(!r) return;
    viewingId = r.id;
    document.getElementById('aName').textContent     = r.name;
    document.getElementById('aEmail').textContent    = r.email;
    document.getElementById('aPhone').textContent    = r.phone || '—';
    document.getElementById('aPosition').textContent = r.position;
    document.getElementById('aExp').textContent      = r.experience;
    document.getElementById('aApplied').textContent  = r.applied;
    document.getElementById('aNote').textContent     = r.note || '—';
    document.getElementById('aResume').href          = r.resume_url ? '../' + r.resume_url : '#';
    markCurrent(r.status);
    aModal.classList.add('open');
  });

  statusActions.addEventListener('click', function(e){
    var b = e.target.closest('.mark-btn'); if(!b || !viewingId) return;
    var s = b.getAttribute('data-set');
    fetch(API_A + 'update_status.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({ id: viewingId, status: s })
    }).then(function(r){ return r.json(); })
      .then(function(d){
        if(!d.success) throw new Error(d.message||'Update failed');
        markCurrent(s); aModal.classList.remove('open'); appCtl.load();
      })
      .catch(function(err){ alert('Could not update status: '+err.message); });
  });

  vacCtl.load();
  appCtl.load();
});
</script>
</body></html>
