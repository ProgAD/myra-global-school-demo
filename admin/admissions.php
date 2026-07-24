<?php
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
<title>Manage Admissions | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<style>
/* Selection column */
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,#chkAll{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
/* clickable cells (checkbox .. applied on) show a pointer to hint row-select */
#adTable tbody td:nth-child(-n+6){cursor:pointer;}

/* Applicant: name with application no. stacked below it */
.appl b{display:block;font-size:14px;font-weight:700;color:var(--ink);}
.appl span{display:block;font-size:12px;color:var(--muted);margin-top:2px;}

/* Status shown as a coloured dropdown (acts as the badge) */
.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select.s-received{background:var(--blue-bg);color:var(--blue);}
.status-select.s-verified{background:var(--amber-bg);color:var(--amber);}
.status-select.s-completed{background:var(--green-bg);color:var(--green);}

/* Pagination footer */
.tbl td.sno{color:var(--muted);font-weight:700;}
.pager{display:flex;flex-wrap:wrap;gap:12px;align-items:center;justify-content:space-between;padding:14px 22px;border-top:1px solid var(--line);}
.pager-info{color:var(--muted);font-size:13px;}
.pager-btns{display:flex;gap:6px;align-items:center;flex-wrap:wrap;}
.page-btn{min-width:34px;height:34px;padding:0 10px;border:1px solid var(--line);border-radius:8px;background:var(--surface);color:var(--ink);font-weight:600;font-size:13px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;transition:.2s;}
.page-btn:hover:not(:disabled){border-color:var(--primary-container);color:var(--primary-container);}
.page-btn.active{background:var(--primary-container);color:#fff;border-color:var(--primary-container);}
.page-btn:disabled{opacity:.45;cursor:not-allowed;}

/* Export popup */
.exp-count{font-family:var(--font-serif);font-size:40px;font-weight:700;color:var(--primary-container);line-height:1;}
</style>
<script src="admin.js" defer></script>
</head>
<body>
<div class="admin">

<!-- Sidebar -->
<?php include '../components/admin-sidebar.php'?>

<!-- Main -->
<div class="main">
<header class="topbar">
<button class="hamburger" id="hamburger" aria-label="Menu"><span class="material-symbols-outlined">menu</span></button>
<h1>Admissions</h1>
<div class="spacer"></div>
<button class="icon-btn" aria-label="Notifications"><span class="material-symbols-outlined">notifications</span><span class="dot"></span></button>
<div class="profile"><span class="avatar">A</span><div class="who"><b>Admin</b><span>Administrator</span></div></div>
</header>

<div class="content">
<div class="page-head">
<div>
<h2>Manage Admissions</h2>
<p>Review applications, verify documents and update status.</p>
</div>
<button class="btn btn-ghost" id="exportBtn"><span class="material-symbols-outlined">download</span> Export CSV</button>
</div>

<div class="toolbar">
<div class="search"><span class="material-symbols-outlined">search</span><input id="adSearch" type="text" placeholder="Search by name or application no."/></div>
<div class="spacer"></div>
<div class="tabs" id="adTabs">
<button class="tab active" data-f="all">All</button>
<button class="tab" data-f="received">Received</button>
<button class="tab" data-f="verified">Verified</button>
<button class="tab" data-f="completed">Completed</button>
</div>
</div>

<div class="panel">
<div class="table-wrap">
<table class="tbl" id="adTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" id="chkAll" aria-label="Select all"/></th>
<th style="width:52px">#</th>
<th>Applicant</th>
<th>Class</th>
<th>Contact</th>
<th>Applied On</th>
<th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody>
<tr data-id="MGS12345678" data-status="verified" data-name="aarav sharma mgs12345678" data-class="Grade 6" data-dob="14 May 2013" data-phone="+91 98765 43210" data-email="rajesh.sharma@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Aarav Sharma</b><span>MGS12345678</span></div></td>
<td>Grade 6</td>
<td><div class="muted">+91 98765 43210<br>rajesh.sharma@example.com</div></td>
<td class="appdate">22 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified" selected>Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345678" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345679" data-status="completed" data-name="isha kumari mgs12345679" data-class="Grade 3" data-dob="02 Jan 2016" data-phone="+91 90000 11111" data-email="isha.k@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Isha Kumari</b><span>MGS12345679</span></div></td>
<td>Grade 3</td>
<td><div class="muted">+91 90000 11111<br>isha.k@example.com</div></td>
<td class="appdate">21 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified">Verified</option><option value="completed" selected>Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345679" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345680" data-status="received" data-name="reyansh verma mgs12345680" data-class="Nursery" data-dob="11 Aug 2021" data-phone="+91 91234 56780" data-email="verma.family@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Reyansh Verma</b><span>MGS12345680</span></div></td>
<td>Nursery</td>
<td><div class="muted">+91 91234 56780<br>verma.family@example.com</div></td>
<td class="appdate">21 Jul 2026</td>
<td><select class="status-select"><option value="received" selected>Received</option><option value="verified">Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345680" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345681" data-status="verified" data-name="anaya mishra mgs12345681" data-class="Grade 9" data-dob="19 Mar 2010" data-phone="+91 99887 66554" data-email="mishra.a@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Anaya Mishra</b><span>MGS12345681</span></div></td>
<td>Grade 9</td>
<td><div class="muted">+91 99887 66554<br>mishra.a@example.com</div></td>
<td class="appdate">20 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified" selected>Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345681" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345682" data-status="completed" data-name="kabir singh mgs12345682" data-class="Grade 1" data-dob="07 Dec 2019" data-phone="+91 98111 22333" data-email="singh.k@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Kabir Singh</b><span>MGS12345682</span></div></td>
<td>Grade 1</td>
<td><div class="muted">+91 98111 22333<br>singh.k@example.com</div></td>
<td class="appdate">19 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified">Verified</option><option value="completed" selected>Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345682" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345683" data-status="received" data-name="vivaan gupta mgs12345683" data-class="Grade 8" data-dob="09 Feb 2011" data-phone="+91 98200 12345" data-email="gupta.v@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Vivaan Gupta</b><span>MGS12345683</span></div></td>
<td>Grade 8</td>
<td><div class="muted">+91 98200 12345<br>gupta.v@example.com</div></td>
<td class="appdate">19 Jul 2026</td>
<td><select class="status-select"><option value="received" selected>Received</option><option value="verified">Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345683" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345684" data-status="verified" data-name="diya patel mgs12345684" data-class="Grade 5" data-dob="23 Jun 2014" data-phone="+91 90011 22334" data-email="diya.patel@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Diya Patel</b><span>MGS12345684</span></div></td>
<td>Grade 5</td>
<td><div class="muted">+91 90011 22334<br>diya.patel@example.com</div></td>
<td class="appdate">18 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified" selected>Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345684" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345685" data-status="received" data-name="aditya rao mgs12345685" data-class="Grade 11" data-dob="12 Nov 2008" data-phone="+91 98330 44556" data-email="aditya.rao@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Aditya Rao</b><span>MGS12345685</span></div></td>
<td>Grade 11</td>
<td><div class="muted">+91 98330 44556<br>aditya.rao@example.com</div></td>
<td class="appdate">18 Jul 2026</td>
<td><select class="status-select"><option value="received" selected>Received</option><option value="verified">Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345685" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345686" data-status="completed" data-name="saanvi joshi mgs12345686" data-class="UKG" data-dob="30 Apr 2020" data-phone="+91 99220 33445" data-email="joshi.s@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Saanvi Joshi</b><span>MGS12345686</span></div></td>
<td>UKG</td>
<td><div class="muted">+91 99220 33445<br>joshi.s@example.com</div></td>
<td class="appdate">17 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified">Verified</option><option value="completed" selected>Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345686" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345687" data-status="received" data-name="arjun nair mgs12345687" data-class="Grade 7" data-dob="05 Sep 2012" data-phone="+91 98111 55667" data-email="arjun.nair@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Arjun Nair</b><span>MGS12345687</span></div></td>
<td>Grade 7</td>
<td><div class="muted">+91 98111 55667<br>arjun.nair@example.com</div></td>
<td class="appdate">17 Jul 2026</td>
<td><select class="status-select"><option value="received" selected>Received</option><option value="verified">Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345687" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345688" data-status="verified" data-name="myra reddy mgs12345688" data-class="Grade 2" data-dob="18 Jul 2018" data-phone="+91 90044 66778" data-email="myra.reddy@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Myra Reddy</b><span>MGS12345688</span></div></td>
<td>Grade 2</td>
<td><div class="muted">+91 90044 66778<br>myra.reddy@example.com</div></td>
<td class="appdate">16 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified" selected>Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345688" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345689" data-status="received" data-name="kabir khan mgs12345689" data-class="LKG" data-dob="27 Oct 2021" data-phone="+91 98550 77889" data-email="khan.k@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Kabir Khan</b><span>MGS12345689</span></div></td>
<td>LKG</td>
<td><div class="muted">+91 98550 77889<br>khan.k@example.com</div></td>
<td class="appdate">16 Jul 2026</td>
<td><select class="status-select"><option value="received" selected>Received</option><option value="verified">Verified</option><option value="completed">Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345689" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
<tr data-id="MGS12345690" data-status="completed" data-name="ananya das mgs12345690" data-class="Grade 10" data-dob="03 Mar 2009" data-phone="+91 99330 88990" data-email="ananya.das@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td><div class="appl"><b>Ananya Das</b><span>MGS12345690</span></div></td>
<td>Grade 10</td>
<td><div class="muted">+91 99330 88990<br>ananya.das@example.com</div></td>
<td class="appdate">15 Jul 2026</td>
<td><select class="status-select"><option value="received">Received</option><option value="verified">Verified</option><option value="completed" selected>Completed</option></select></td>
<td><div class="acts" style="justify-content:flex-end">
<a class="row-act view" href="../admission/admission-status.html?id=MGS12345690" title="View"><span class="material-symbols-outlined">visibility</span></a>
<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div></td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="pager">
<div class="pager-info" id="adInfo"></div>
<div class="pager-btns" id="adPages"></div>
</div>
</div>

</div>
</div>
</div>

<!-- Export confirmation popup -->
<div class="modal" id="exportModal">
<div class="modal-box" style="max-width:420px">
<div class="modal-head"><h3>Export to CSV</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body" style="text-align:center">
<div class="exp-count" id="expCount">0</div>
<p style="margin-top:6px">entr<span id="expNoun">ies</span> will be exported</p>
<p class="muted" id="expHint" style="margin-top:10px"></p>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Cancel</button><button class="btn btn-primary" id="expConfirm"><span class="material-symbols-outlined">download</span> Export</button></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var table = document.getElementById('adTable');
  var tbody = table.querySelector('tbody');
  var PAGE_SIZE = 8;
  var filter = 'all', term = '', page = 1;

  var STATUS_LABEL = { received: 'Received', verified: 'Verified', completed: 'Completed' };

  function allRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }

  function colorSelect(sel){
    sel.classList.remove('s-received', 's-verified', 's-completed');
    sel.classList.add('s-' + sel.value);
  }
  allRows().forEach(function (r) { colorSelect(r.querySelector('.status-select')); });

  function matches(r){
    var okF = filter === 'all' || r.getAttribute('data-status') === filter;
    var okS = !term || (r.getAttribute('data-name') || '').indexOf(term) > -1;
    return okF && okS;
  }

  var infoEl = document.getElementById('adInfo');
  var pagesEl = document.getElementById('adPages');
  var chkAll = document.getElementById('chkAll');

  function render(){
    var rows = allRows();
    var list = rows.filter(matches);
    var total = list.length;
    var pages = Math.max(1, Math.ceil(total / PAGE_SIZE));
    if (page > pages) page = pages;
    if (page < 1) page = 1;
    var start = (page - 1) * PAGE_SIZE;
    var end = start + PAGE_SIZE;

    rows.forEach(function (r) { r.style.display = 'none'; });
    list.forEach(function (r, i) {
      if (i >= start && i < end) {
        r.style.display = '';
        r.querySelector('.sno').textContent = i + 1;
      }
    });

    infoEl.textContent = total === 0
      ? 'No applications found'
      : 'Showing ' + (start + 1) + '–' + Math.min(end, total) + ' of ' + total;

    pagesEl.innerHTML = '';
    function addBtn(html, target, opts){
      opts = opts || {};
      var b = document.createElement('button');
      b.className = 'page-btn' + (opts.active ? ' active' : '');
      b.innerHTML = html;
      if (opts.disabled) b.disabled = true;
      else b.addEventListener('click', function(){ page = target; render(); });
      pagesEl.appendChild(b);
    }
    addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>', page - 1, {disabled: page === 1});
    for (var p = 1; p <= pages; p++) addBtn(String(p), p, {active: p === page});
    addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>', page + 1, {disabled: page === pages});

    syncSelectAll();
  }

  /* ---------- Selection ---------- */
  function filteredRows(){ return allRows().filter(matches); }
  function checkedRows(){ return allRows().filter(function (r) { return r.querySelector('.rowchk').checked; }); }

  function syncSelectAll(){
    var f = filteredRows();
    var checked = f.filter(function (r) { return r.querySelector('.rowchk').checked; }).length;
    chkAll.checked = f.length > 0 && checked === f.length;
    chkAll.indeterminate = checked > 0 && checked < f.length;
  }

  chkAll.addEventListener('change', function () {
    var on = this.checked;
    filteredRows().forEach(function (r) { r.querySelector('.rowchk').checked = on; });
  });

  // Click anywhere on a row up to the "Applied On" column toggles selection
  tbody.addEventListener('click', function (e) {
    // ignore the interactive columns (status dropdown, action buttons/links)
    if (e.target.closest('.status-select') || e.target.closest('.acts')) return;
    var td = e.target.closest('td');
    if (!td) return;
    var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
    if (idx < 0 || idx > 5) return;           // 0=checkbox … 5=Applied On
    var chk = td.parentNode.querySelector('.rowchk');
    if (e.target === chk) return;             // let the checkbox handle its own click
    chk.checked = !chk.checked;
    syncSelectAll();
  });

  /* ---------- Table change (status dropdown, checkbox) ---------- */
  table.addEventListener('change', function (e) {
    if (e.target.classList.contains('status-select')) {
      var r = e.target.closest('tr');
      r.setAttribute('data-status', e.target.value);
      colorSelect(e.target);
      render(); // row may leave the active filter
      return;
    }
    if (e.target.classList.contains('rowchk')) { syncSelectAll(); }
  });

  document.getElementById('adTabs').addEventListener('click', function (e) {
    var t = e.target.closest('.tab'); if (!t) return;
    this.querySelectorAll('.tab').forEach(function (x) { x.classList.remove('active'); });
    t.classList.add('active'); filter = t.getAttribute('data-f'); page = 1; render();
  });

  document.getElementById('adSearch').addEventListener('input', function () {
    term = this.value.trim().toLowerCase(); page = 1; render();
  });

  // admin.js confirms + removes the row -> re-render pagination afterwards
  document.addEventListener('admin:rowdeleted', render);

  /* ---------- CSV export ---------- */
  var exportModal = document.getElementById('exportModal');
  var pendingRows = [];

  function rowsToExport(){
    var checked = checkedRows();
    // if nothing is selected, export every entry in the current filter (all pages)
    return checked.length ? checked : filteredRows();
  }

  document.getElementById('exportBtn').addEventListener('click', function () {
    pendingRows = rowsToExport();
    var n = pendingRows.length;
    document.getElementById('expCount').textContent = n;
    document.getElementById('expNoun').textContent = n === 1 ? 'y' : 'ies';
    document.getElementById('expHint').textContent = checkedRows().length
      ? 'Exporting your selected rows.'
      : 'No rows selected — exporting all entries in the "' + filter + '" filter.';
    exportModal.classList.add('open');
  });

  function csvCell(v){
    v = (v == null ? '' : String(v)).replace(/\s+/g, ' ').trim();
    return /[",\n]/.test(v) ? '"' + v.replace(/"/g, '""') + '"' : v;
  }

  document.getElementById('expConfirm').addEventListener('click', function () {
    var header = ['S.No', 'Applicant Name', 'Application No', 'Class', 'Phone', 'Email', 'Applied On', 'Status'];
    var lines = [header.map(csvCell).join(',')];
    pendingRows.forEach(function (r, i) {
      lines.push([
        i + 1,
        r.querySelector('.appl b').textContent,
        r.querySelector('.appl span').textContent,
        r.getAttribute('data-class'),
        r.getAttribute('data-phone'),
        r.getAttribute('data-email'),
        r.querySelector('.appdate').textContent,
        STATUS_LABEL[r.getAttribute('data-status')] || r.getAttribute('data-status')
      ].map(csvCell).join(','));
    });
    var csv = '﻿' + lines.join('\r\n'); // BOM for Excel
    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'admissions_' + filter + '_' + pendingRows.length + '.csv';
    document.body.appendChild(a); a.click(); document.body.removeChild(a);
    URL.revokeObjectURL(url);
    exportModal.classList.remove('open');
  });

  render();
});
</script>
</body></html>
