<?php
$page_name = 'enquiries';   // drives sidebar highlight + topbar heading

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
<title>Manage Enquiries | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<style>
/* Selection column */
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,#chkAll{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
#enTable tbody td:nth-child(-n+6){cursor:pointer;}
.tbl td.sno{color:var(--muted);font-weight:700;}

/* Name + contact */
.enq-name{font-size:14px;font-weight:700;color:var(--ink);}
.contact{font-size:12.5px;line-height:1.5;color:var(--muted);white-space:nowrap;}
.msg{font-size:13px;line-height:1.5;color:var(--on-surface-variant);max-width:340px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.recv{white-space:nowrap;font-size:13.5px;}

/* Status as a changeable coloured dropdown */
.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select.s-pending{background:var(--amber-bg);color:var(--amber);}
.status-select.s-replied{background:var(--green-bg);color:var(--green);}

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

/* Enquiry details — plain label + value, not form inputs */
.info-grid{display:grid;grid-template-columns:1fr;gap:16px 28px;}
.info-item{display:flex;flex-direction:column;gap:3px;min-width:0;}
.info-label{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);}
.info-value{font-size:14.5px;font-weight:600;color:var(--ink);word-break:break-word;}
.msg-block{margin:20px 0;padding-top:18px;border-top:1px solid var(--line);}
.msg-text{font-size:14px;line-height:1.7;color:var(--on-surface-variant);white-space:pre-wrap;margin-top:6px;}
@media(min-width:560px){ .info-grid{grid-template-columns:1fr 1fr;} }
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
<h2>Manage Enquiries</h2>
<p>View and respond to enquiries received from parents.</p>
</div>
</div>

<div class="toolbar">
<div class="search"><span class="material-symbols-outlined">search</span><input id="enSearch" type="text" placeholder="Search by name, contact or message"/></div>
<div class="spacer"></div>
<div class="tabs" id="enTabs">
<button class="tab active" data-f="all">All</button>
<button class="tab" data-f="pending">Pending</button>
<button class="tab" data-f="replied">Replied</button>
</div>
</div>

<!-- Bulk actions -->
<div class="bulkbar" id="bulkBar" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCount">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" id="bulkClear">Clear selection</button>
<button class="btn btn-danger btn-sm" id="bulkDelete"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">
<div class="table-wrap">
<table class="tbl" id="enTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" id="chkAll" aria-label="Select all"/></th>
<th style="width:52px">#</th>
<th>Name</th>
<th>Contact</th>
<th>Message</th>
<th>Received</th>
<th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody>
<tr data-status="pending" data-recv="2h ago" data-fname="Neha Gupta" data-phone="+91 98200 10101" data-email="neha.gupta@example.com"
    data-msg="Hello, I would like to know the fee structure and available seats for Grade 5 admission for my daughter. Also, are there any scholarships available? Thank you."
    data-name="neha gupta fee structure grade 5 admission scholarship neha.gupta@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">2h ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="pending" data-recv="5h ago" data-fname="Vikram Rao" data-phone="+91 99110 22220" data-email="vikram.rao@example.com"
    data-msg="We are interested in visiting the campus this weekend with our son. Could you please let us know the available slots for a campus tour?"
    data-name="vikram rao campus tour visit weekend slots vikram.rao@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">5h ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="replied" data-recv="Yesterday" data-fname="Sunita Devi" data-phone="+91 90909 80808" data-email="sunita.devi@example.com"
    data-msg="Is school transport available for Sector 12? What are the timings and monthly charges?"
    data-name="sunita devi transport sector 12 timings charges sunita.devi@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">Yesterday</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="replied" data-recv="Yesterday" data-fname="Arjun Nair" data-phone="+91 98765 00011" data-email="arjun.nair@example.com"
    data-msg="Please share the list of documents required for Grade 11 admission and the last date to apply."
    data-name="arjun nair grade 11 documents last date apply arjun.nair@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">Yesterday</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="pending" data-recv="2 days ago" data-fname="Pooja Sharma" data-phone="+91 98110 44556" data-email="pooja.sharma@example.com"
    data-msg="Does the school offer coaching for competitive exams like NTSE and Olympiads in the senior classes? If yes, is it part of the regular timetable?"
    data-name="pooja sharma coaching competitive ntse olympiad senior classes pooja.sharma@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">2 days ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="pending" data-recv="2 days ago" data-fname="Ramesh Yadav" data-phone="+91 90222 33445" data-email="ramesh.yadav@example.com"
    data-msg="I would like to know about the annual fee payment schedule and whether instalment options are available for parents."
    data-name="ramesh yadav annual fee payment schedule instalment ramesh.yadav@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">2 days ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="replied" data-recv="3 days ago" data-fname="Fatima Sheikh" data-phone="+91 99887 12345" data-email="fatima.sheikh@example.com"
    data-msg="My son has special learning needs. Do you have a special educator or counsellor available on campus to support such students?"
    data-name="fatima sheikh special learning needs educator counsellor fatima.sheikh@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">3 days ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="pending" data-recv="4 days ago" data-fname="Deepak Menon" data-phone="+91 98333 55667" data-email="deepak.menon@example.com"
    data-msg="Are there any vacancies for a physics teacher at the senior secondary level? I could not find the careers page on the website."
    data-name="deepak menon vacancy physics teacher senior secondary careers deepak.menon@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">4 days ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
<tr data-status="replied" data-recv="5 days ago" data-fname="Kavita Bose" data-phone="+91 90111 77889" data-email="kavita.bose@example.com"
    data-msg="Kindly share details about the hostel facility and mess arrangements for outstation students joining from Grade 9."
    data-name="kavita bose hostel facility mess outstation students grade 9 kavita.bose@example.com">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="encell"></td>
<td class="ctcell"></td>
<td class="msgcell"></td>
<td class="recv">5 days ago</td>
<td class="stcell"></td>
<td class="actcell"></td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="pager">
<div class="pager-left">
<label class="perpage">Show
<select class="perpage-select" id="perPage">
<option value="5">5</option>
<option value="10" selected>10</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="all">All</option>
</select>
entries</label>
<span class="pager-info" id="enInfo"></span>
</div>
<div class="pager-btns" id="enPages"></div>
</div>
</div>

</div>
</div>
</div>

<!-- View / reply modal -->
<div class="modal" id="enModal">
<div class="modal-box lg">
<div class="modal-head"><h3>Enquiry</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body">
<div class="info-grid">
<div class="info-item"><span class="info-label">Name</span><span class="info-value" id="eName">—</span></div>
<div class="info-item"><span class="info-label">Received</span><span class="info-value" id="eTime">—</span></div>
<div class="info-item"><span class="info-label">Phone</span><span class="info-value" id="ePhone">—</span></div>
<div class="info-item"><span class="info-label">Email</span><span class="info-value" id="eEmail">—</span></div>
</div>
<div class="msg-block">
<span class="info-label">Message</span>
<p class="msg-text" id="eMsg">—</p>
</div>
<div class="field"><label>Your Reply</label><textarea class="finput" id="eReply" placeholder="Type your reply..."></textarea></div>
</div>
<div class="modal-foot">
<button class="btn btn-ghost" data-close>Close</button>
<button class="btn btn-primary" id="eSend"><span class="material-symbols-outlined">send</span> Send Reply &amp; Mark Replied</button>
</div>
</div>
</div>

<!-- Bulk delete confirmation popup -->
<div class="modal" id="bulkDelModal">
<div class="modal-box" style="max-width:420px">
<div class="modal-head"><h3>Delete Selected</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body" style="text-align:center">
<span class="material-symbols-outlined" style="font-size:44px;color:var(--red)">warning</span>
<div class="del-count" id="delCount" style="margin-top:8px">0</div>
<p style="margin-top:6px">enquir<span id="delNoun">ies</span> will be deleted</p>
<p class="muted" style="margin-top:10px">This action cannot be undone.</p>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Cancel</button><button class="btn btn-danger" id="bulkDelConfirm"><span class="material-symbols-outlined">delete</span> Delete</button></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var table = document.getElementById('enTable');
  var tbody = table.querySelector('tbody');
  var filter = 'all', term = '', page = 1;

  function allRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }
  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
    });
  }

  function statusSelectHtml(s){
    s = (s === 'replied') ? 'replied' : 'pending';
    return '<select class="status-select s-' + s + '">' +
           '<option value="pending"' + (s === 'pending' ? ' selected' : '') + '>Pending</option>' +
           '<option value="replied"' + (s === 'replied' ? ' selected' : '') + '>Replied</option>' +
           '</select>';
  }

  function paintRow(tr){
    tr.querySelector('.encell').innerHTML  = '<span class="enq-name">' + esc(tr.getAttribute('data-fname')) + '</span>';
    tr.querySelector('.ctcell').innerHTML  = '<div class="contact">' + esc(tr.getAttribute('data-phone')) + '<br>' + esc(tr.getAttribute('data-email')) + '</div>';
    tr.querySelector('.msgcell').innerHTML = '<p class="msg">' + esc(tr.getAttribute('data-msg')) + '</p>';
    tr.querySelector('.recv').textContent  = tr.getAttribute('data-recv') || '';
    tr.querySelector('.stcell').innerHTML  = statusSelectHtml(tr.getAttribute('data-status'));
    tr.querySelector('.actcell').innerHTML =
      '<div class="acts" style="justify-content:flex-end">' +
      '<button class="row-act view" title="View &amp; reply"><span class="material-symbols-outlined">visibility</span></button>' +
      '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>' +
      '</div>';
  }
  allRows().forEach(paintRow);

  /* ---------- Filter / search / pagination ---------- */
  function matches(r){
    var okF = filter === 'all' || r.getAttribute('data-status') === filter;
    var okS = !term || (r.getAttribute('data-name') || '').indexOf(term) > -1;
    return okF && okS;
  }
  function filteredRows(){ return allRows().filter(matches); }
  function checkedRows(){ return allRows().filter(function (r) { return r.querySelector('.rowchk').checked; }); }

  var infoEl = document.getElementById('enInfo');
  var pagesEl = document.getElementById('enPages');
  var chkAll = document.getElementById('chkAll');
  var perPageSel = document.getElementById('perPage');

  function render(){
    var rows = allRows();
    var list = rows.filter(matches);
    var total = list.length;
    var raw = perPageSel.value;
    var size = (raw === 'all') ? Math.max(total, 1) : (parseInt(raw, 10) || 10);
    var pages = Math.max(1, Math.ceil(total / size));
    if (page > pages) page = pages;
    if (page < 1) page = 1;
    var start = (page - 1) * size;
    var end = start + size;

    rows.forEach(function (r) { r.style.display = 'none'; });
    list.forEach(function (r, i) {
      if (i >= start && i < end) {
        r.style.display = '';
        r.querySelector('.sno').textContent = i + 1;
      }
    });

    infoEl.textContent = total === 0
      ? 'No enquiries found'
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
  }

  function syncSelectAll(){
    var f = filteredRows();
    var checked = f.filter(function (r) { return r.querySelector('.rowchk').checked; }).length;
    chkAll.checked = f.length > 0 && checked === f.length;
    chkAll.indeterminate = checked > 0 && checked < f.length;
    updateBulkBar();
  }

  chkAll.addEventListener('change', function () {
    var on = this.checked;
    filteredRows().forEach(function (r) { r.querySelector('.rowchk').checked = on; });
    syncSelectAll();
  });

  // Click a row (up to Received) toggles selection
  tbody.addEventListener('click', function (e) {
    if (e.target.closest('.acts') || e.target.closest('.status-select')) return;
    var td = e.target.closest('td');
    if (!td) return;
    var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
    if (idx < 0 || idx > 5) return;
    var chk = td.parentNode.querySelector('.rowchk');
    if (e.target === chk) return;
    chk.checked = !chk.checked;
    syncSelectAll();
  });

  table.addEventListener('change', function (e) {
    if (e.target.classList.contains('status-select')) {
      var r = e.target.closest('tr');
      r.setAttribute('data-status', e.target.value);
      e.target.classList.remove('s-pending', 's-replied');
      e.target.classList.add('s-' + e.target.value);
      render();
      return;
    }
    if (e.target.classList.contains('rowchk')) syncSelectAll();
  });

  document.getElementById('enTabs').addEventListener('click', function (e) {
    var t = e.target.closest('.tab'); if (!t) return;
    this.querySelectorAll('.tab').forEach(function (x) { x.classList.remove('active'); });
    t.classList.add('active'); filter = t.getAttribute('data-f'); page = 1; render();
  });

  document.getElementById('enSearch').addEventListener('input', function () {
    term = this.value.trim().toLowerCase(); page = 1; render();
  });

  perPageSel.addEventListener('change', function () { page = 1; render(); });

  document.addEventListener('admin:rowdeleted', render);

  /* ---------- Bulk actions ---------- */
  var bulkBar = document.getElementById('bulkBar');
  var bulkCountEl = document.getElementById('bulkCount');
  var bulkDelModal = document.getElementById('bulkDelModal');

  function updateBulkBar(){
    var n = checkedRows().length;
    bulkCountEl.textContent = n;
    bulkBar.hidden = (n === 0);
  }

  document.getElementById('bulkClear').addEventListener('click', function () {
    allRows().forEach(function (r) { r.querySelector('.rowchk').checked = false; });
    syncSelectAll();
  });

  document.getElementById('bulkDelete').addEventListener('click', function () {
    var n = checkedRows().length;
    if (!n) return;
    document.getElementById('delCount').textContent = n;
    document.getElementById('delNoun').textContent = n === 1 ? 'y' : 'ies';
    bulkDelModal.classList.add('open');
  });

  document.getElementById('bulkDelConfirm').addEventListener('click', function () {
    checkedRows().forEach(function (r) { r.remove(); });
    bulkDelModal.classList.remove('open');
    render();
  });

  /* ---------- View / reply ---------- */
  var modal = document.getElementById('enModal');
  var current = null;

  tbody.addEventListener('click', function (e) {
    var v = e.target.closest('.view'); if (!v) return;
    current = v.closest('tr');
    document.getElementById('eName').textContent  = current.getAttribute('data-fname');
    document.getElementById('eTime').textContent  = current.getAttribute('data-recv');
    document.getElementById('ePhone').textContent = current.getAttribute('data-phone');
    document.getElementById('eEmail').textContent = current.getAttribute('data-email');
    document.getElementById('eMsg').textContent   = current.getAttribute('data-msg');
    document.getElementById('eReply').value = '';
    modal.classList.add('open');
  });

  document.getElementById('eSend').addEventListener('click', function () {
    if (current) {
      current.setAttribute('data-status', 'replied');
      current.querySelector('.stcell').innerHTML = statusSelectHtml('replied');
      render();
    }
    modal.classList.remove('open');
  });

  render();
});
</script>
</body></html>
