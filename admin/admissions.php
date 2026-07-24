<?php
$page_name = 'admissions';   // drives sidebar highlight + topbar heading

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
.status-select:disabled{opacity:.6;cursor:wait;}

/* Pagination footer */
.tbl td.sno{color:var(--muted);font-weight:700;}
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

/* Popups */
.exp-count{font-family:var(--font-serif);font-size:40px;font-weight:700;color:var(--primary-container);line-height:1;}
.del-count{font-family:var(--font-serif);font-size:40px;font-weight:700;color:var(--red);line-height:1;}

/* Bulk action bar */
.bulkbar{display:flex;align-items:center;gap:12px;flex-wrap:wrap;background:var(--blue-bg);border:1px solid #c8dcff;color:var(--blue);border-radius:11px;padding:10px 16px;margin-bottom:16px;font-size:14px;font-weight:600;}
.bulkbar[hidden]{display:none;}
.bulkbar .spacer{flex:1;}
.bulkbar b{font-weight:800;}

/* Loading / empty / error states */
.state-box{text-align:center;padding:56px 20px;color:var(--muted);}
.state-box .material-symbols-outlined{font-size:52px;color:var(--line);}
.state-box h4{font-family:var(--font-serif);font-size:19px;font-weight:700;color:var(--primary-container);margin-top:10px;}
.state-box p{margin-top:6px;font-size:14px;}
.state-box.err h4{color:var(--red);}
.spin{width:30px;height:30px;border:3px solid var(--line);border-top-color:var(--primary-container);border-radius:50%;animation:sp .7s linear infinite;margin:0 auto;}
@keyframes sp{to{transform:rotate(360deg);}}
.is-busy{opacity:.55;transition:opacity .15s;}
</style>
<script src="admin.js" defer></script>
</head>
<body>
<div class="admin">

<!-- Sidebar -->
<?php include '../components/admin-sidebar.php'?>

<!-- Main -->
<div class="main">
<?php include '../components/admin-topbar.php'?>

<div class="content">
<div class="page-head">
<div>
<h2>Manage Admissions</h2>
<p>Review applications, verify documents and update status.</p>
</div>
<button class="btn btn-ghost" id="exportBtn"><span class="material-symbols-outlined">download</span> Export CSV</button>
</div>

<div class="toolbar">
<div class="search"><span class="material-symbols-outlined">search</span><input id="adSearch" type="text" placeholder="Search by name, phone, email or application no."/></div>
<div class="spacer"></div>
<div class="tabs" id="adTabs">
<button class="tab active" data-f="all">All</button>
<button class="tab" data-f="received">Received</button>
<button class="tab" data-f="verified">Verified</button>
<button class="tab" data-f="completed">Completed</button>
</div>
</div>

<!-- Bulk actions (appears once one or more rows are selected) -->
<div class="bulkbar" id="bulkBar" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCount">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" id="bulkClear">Clear selection</button>
<button class="btn btn-danger btn-sm" id="bulkDelete"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">

<!-- Loading -->
<div class="state-box" id="loadingBox">
<div class="spin"></div>
<p style="margin-top:12px">Loading applications…</p>
</div>

<!-- Empty -->
<div class="state-box" id="emptyBox" style="display:none">
<span class="material-symbols-outlined">inbox</span>
<h4>No Admission Yet</h4>
<p id="emptyHint">No admission applications have been received so far.</p>
</div>

<!-- Error -->
<div class="state-box err" id="errorBox" style="display:none">
<span class="material-symbols-outlined">error</span>
<h4>Could not load applications</h4>
<p id="errorMsg">Please check your connection and try again.</p>
<button class="btn btn-ghost btn-sm" id="retryBtn" style="margin-top:14px"><span class="material-symbols-outlined">refresh</span> Retry</button>
</div>

<div id="tableWrap" style="display:none">
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
<tbody></tbody>
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
<span class="pager-info" id="adInfo"></span>
</div>
<div class="pager-btns" id="adPages"></div>
</div>
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

<!-- Bulk delete confirmation popup -->
<div class="modal" id="bulkDelModal">
<div class="modal-box" style="max-width:420px">
<div class="modal-head"><h3>Delete Selected</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body" style="text-align:center">
<span class="material-symbols-outlined" style="font-size:44px;color:var(--red)">warning</span>
<div class="del-count" id="delCount" style="margin-top:8px">0</div>
<p style="margin-top:6px">entr<span id="delNoun">ies</span> will be deleted</p>
<p class="muted" style="margin-top:10px">This action cannot be undone.</p>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Cancel</button><button class="btn btn-danger" id="bulkDelConfirm"><span class="material-symbols-outlined">delete</span> Delete</button></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var API = '../actions/admissions/';

  var table   = document.getElementById('adTable');
  var tbody   = table.querySelector('tbody');
  var infoEl  = document.getElementById('adInfo');
  var pagesEl = document.getElementById('adPages');
  var chkAll  = document.getElementById('chkAll');
  var perPageSel = document.getElementById('perPage');

  var loadingBox = document.getElementById('loadingBox');
  var emptyBox   = document.getElementById('emptyBox');
  var errorBox   = document.getElementById('errorBox');
  var tableWrap  = document.getElementById('tableWrap');

  var STATUS = [['received','Received'],['verified','Verified'],['completed','Completed']];
  var STATUS_LABEL = { received:'Received', verified:'Verified', completed:'Completed' };

  // client state; `selected` persists across pages
  var state = { status:'all', q:'', page:1, perPage:'10', total:0, pages:1, rows:[] };
  var selected = {};                 // id -> true
  function selectedIds(){ return Object.keys(selected).filter(function(k){ return selected[k]; }); }

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;' }[c];
    });
  }

  function show(which){
    loadingBox.style.display = which === 'loading' ? '' : 'none';
    emptyBox.style.display   = which === 'empty'   ? '' : 'none';
    errorBox.style.display   = which === 'error'   ? '' : 'none';
    tableWrap.style.display  = which === 'table'   ? '' : 'none';
  }

  /* ---------------- Fetch + render ---------------- */
  function load(){
    show('loading');
    var qs = new URLSearchParams({
      status: state.status, q: state.q, page: state.page, per_page: state.perPage
    });
    fetch(API + 'list.php?' + qs.toString(), { headers:{ 'Accept':'application/json' } })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
        state.rows  = res.d.rows || [];
        state.total = res.d.total || 0;
        state.pages = res.d.pages || 1;
        state.page  = res.d.page || 1;
        render();
      })
      .catch(function (err) {
        document.getElementById('errorMsg').textContent = err.message || 'Please try again.';
        show('error');
        updateBulkBar();
      });
  }

  function rowHtml(r, serial){
    var opts = STATUS.map(function (s) {
      return '<option value="' + s[0] + '"' + (s[0] === r.status ? ' selected' : '') + '>' + s[1] + '</option>';
    }).join('');
    return '' +
      '<td class="selcol"><input type="checkbox" class="rowchk"' + (selected[r.id] ? ' checked' : '') + '/></td>' +
      '<td class="sno">' + serial + '</td>' +
      '<td><div class="appl"><b>' + esc(r.student_name) + '</b><span>' + esc(r.app_no) + '</span></div></td>' +
      '<td>' + esc(r.apply_class) + '</td>' +
      '<td><div class="muted">' + esc(r.phone || '—') + '<br>' + esc(r.email || '—') + '</div></td>' +
      '<td class="appdate">' + esc(r.applied_on) + '</td>' +
      '<td><select class="status-select s-' + r.status + '">' + opts + '</select></td>' +
      '<td><div class="acts" style="justify-content:flex-end">' +
        '<a class="row-act view" href="../admission/admission-status.html?id=' + encodeURIComponent(r.id) + '" target="_blank" rel="noopener" title="View"><span class="material-symbols-outlined">visibility</span></a>' +
        '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>' +
      '</div></td>';
  }

  function render(){
    if (state.total === 0) {
      var filtered = (state.status !== 'all' || state.q !== '');
      document.getElementById('emptyHint').textContent = filtered
        ? 'No applications match this filter or search.'
        : 'No admission applications have been received so far.';
      show('empty');
      updateBulkBar();
      return;
    }

    var perNum = state.perPage === 'all' ? state.total : parseInt(state.perPage, 10);
    var start  = state.perPage === 'all' ? 0 : (state.page - 1) * perNum;

    tbody.innerHTML = '';
    state.rows.forEach(function (r, i) {
      var tr = document.createElement('tr');
      tr.setAttribute('data-id', r.id);
      tr.setAttribute('data-status', r.status);
      tr.innerHTML = rowHtml(r, start + i + 1);
      tbody.appendChild(tr);
    });

    var end = start + state.rows.length;
    infoEl.textContent = 'Showing ' + (start + 1) + '–' + end + ' of ' + state.total;

    pagesEl.innerHTML = '';
    function addBtn(html, target, opts){
      opts = opts || {};
      var b = document.createElement('button');
      b.className = 'page-btn' + (opts.active ? ' active' : '');
      b.innerHTML = html;
      if (opts.disabled) b.disabled = true;
      else b.addEventListener('click', function(){ state.page = target; load(); });
      pagesEl.appendChild(b);
    }
    addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>', state.page - 1, {disabled: state.page === 1});
    for (var p = 1; p <= state.pages; p++) addBtn(String(p), p, {active: p === state.page});
    addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>', state.page + 1, {disabled: state.page === state.pages});

    show('table');
    syncSelectAll();
  }

  /* ---------------- Selection ---------------- */
  function pageRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }

  function syncSelectAll(){
    var rows = pageRows();
    var n = rows.filter(function (r) { return r.querySelector('.rowchk').checked; }).length;
    chkAll.checked = rows.length > 0 && n === rows.length;
    chkAll.indeterminate = n > 0 && n < rows.length;
    updateBulkBar();
  }

  function updateBulkBar(){
    var n = selectedIds().length;
    document.getElementById('bulkCount').textContent = n;
    document.getElementById('bulkBar').hidden = (n === 0);
  }

  chkAll.addEventListener('change', function () {
    var on = this.checked;
    pageRows().forEach(function (tr) {
      tr.querySelector('.rowchk').checked = on;
      if (on) selected[tr.dataset.id] = true; else delete selected[tr.dataset.id];
    });
    syncSelectAll();
  });

  // click a row (up to "Applied On") toggles selection
  tbody.addEventListener('click', function (e) {
    if (e.target.closest('.status-select') || e.target.closest('.acts')) return;
    var td = e.target.closest('td'); if (!td) return;
    var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
    if (idx < 0 || idx > 5) return;
    var chk = td.parentNode.querySelector('.rowchk');
    if (e.target === chk) return;
    chk.checked = !chk.checked;
    if (chk.checked) selected[td.parentNode.dataset.id] = true; else delete selected[td.parentNode.dataset.id];
    syncSelectAll();
  });

  /* ---------------- Status change (persists) ---------------- */
  table.addEventListener('change', function (e) {
    if (e.target.classList.contains('rowchk')) {
      var tr = e.target.closest('tr');
      if (e.target.checked) selected[tr.dataset.id] = true; else delete selected[tr.dataset.id];
      syncSelectAll();
      return;
    }
    if (!e.target.classList.contains('status-select')) return;

    var sel = e.target, row = sel.closest('tr');
    var id = row.dataset.id, prev = row.dataset.status, next = sel.value;
    sel.disabled = true; row.classList.add('is-busy');

    fetch(API + 'update_status.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id: id, status: next })
    })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        if (!d.success) throw new Error(d.message || 'Update failed');
        load(); // row may drop out of the active filter
      })
      .catch(function (err) {
        sel.value = prev;                      // roll back the UI
        sel.className = 'status-select s-' + prev;
        sel.disabled = false;
        row.classList.remove('is-busy');
        alert('Could not update status: ' + err.message);
      });
  });

  /* ---------------- Single delete (admin.js confirms) ---------------- */
  var pendingDeleteId = null;
  tbody.addEventListener('click', function (e) {
    var d = e.target.closest('[data-del]');
    if (d) { var tr = d.closest('tr'); pendingDeleteId = tr ? tr.dataset.id : null; }
  });

  document.addEventListener('admin:rowdeleted', function (e) {
    var id = pendingDeleteId || (e.detail && e.detail.row ? e.detail.row.dataset.id : null);
    pendingDeleteId = null;
    if (!id) { load(); return; }
    postDelete([id]).then(function () { delete selected[id]; load(); });
  });

  function postDelete(ids){
    return fetch(API + 'delete.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ ids: ids })
    })
      .then(function (r) { return r.json(); })
      .then(function (d) { if (!d.success) throw new Error(d.message || 'Delete failed'); return d; })
      .catch(function (err) { alert('Could not delete: ' + err.message); });
  }

  /* ---------------- Bulk actions ---------------- */
  document.getElementById('bulkClear').addEventListener('click', function () {
    selected = {};
    pageRows().forEach(function (tr) { tr.querySelector('.rowchk').checked = false; });
    syncSelectAll();
  });

  var bulkDelModal = document.getElementById('bulkDelModal');
  document.getElementById('bulkDelete').addEventListener('click', function () {
    var n = selectedIds().length;
    if (!n) return;
    document.getElementById('delCount').textContent = n;
    document.getElementById('delNoun').textContent = n === 1 ? 'y' : 'ies';
    bulkDelModal.classList.add('open');
  });

  document.getElementById('bulkDelConfirm').addEventListener('click', function () {
    var ids = selectedIds();
    bulkDelModal.classList.remove('open');
    if (!ids.length) return;
    postDelete(ids).then(function () { selected = {}; load(); });
  });

  /* ---------------- Filters / search / paging ---------------- */
  document.getElementById('adTabs').addEventListener('click', function (e) {
    var t = e.target.closest('.tab'); if (!t) return;
    this.querySelectorAll('.tab').forEach(function (x) { x.classList.remove('active'); });
    t.classList.add('active');
    state.status = t.getAttribute('data-f');
    state.page = 1;
    load();
  });

  var searchTimer = null;
  document.getElementById('adSearch').addEventListener('input', function () {
    var v = this.value.trim();
    clearTimeout(searchTimer);
    searchTimer = setTimeout(function () { state.q = v; state.page = 1; load(); }, 300);
  });

  perPageSel.addEventListener('change', function () {
    state.perPage = this.value; state.page = 1; load();
  });

  document.getElementById('retryBtn').addEventListener('click', load);

  /* ---------------- CSV export (server-side) ---------------- */
  var exportModal = document.getElementById('exportModal');
  document.getElementById('exportBtn').addEventListener('click', function () {
    var ids = selectedIds();
    var n = ids.length ? ids.length : state.total;
    document.getElementById('expCount').textContent = n;
    document.getElementById('expNoun').textContent = n === 1 ? 'y' : 'ies';
    document.getElementById('expHint').textContent = ids.length
      ? 'Exporting your selected rows.'
      : 'No rows selected — exporting all entries in the "' + state.status + '" filter.';
    exportModal.classList.add('open');
  });

  document.getElementById('expConfirm').addEventListener('click', function () {
    var ids = selectedIds();
    var qs = new URLSearchParams({ status: state.status, q: state.q });
    if (ids.length) qs.set('ids', ids.join(','));
    exportModal.classList.remove('open');
    window.location = API + 'export.php?' + qs.toString();
  });

  load();
});
</script>
</body></html>
