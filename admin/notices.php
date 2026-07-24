<?php
$page_name = 'notices';   // drives sidebar highlight + topbar heading

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
<title>Manage Notices | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<style>
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,#chkAll{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
#ntTable tbody td:nth-child(-n+6){cursor:pointer;}
.tbl td.sno{color:var(--muted);font-weight:700;}
.ntdate{white-space:nowrap;font-size:13.5px;}

.ntitle b{display:block;font-size:14px;font-weight:700;color:var(--ink);}
.ntdesc{font-size:12.5px;line-height:1.45;color:var(--muted);margin-top:3px;max-width:330px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.cat-chip{display:inline-flex;padding:4px 11px;border-radius:9999px;background:var(--bg);color:var(--primary-container);font-size:12px;font-weight:700;text-transform:capitalize;white-space:nowrap;}

.attach{display:flex;flex-direction:column;gap:10px;min-width:190px;}
.attach-group{display:flex;flex-direction:column;gap:4px;}
.attach-lbl{display:block;font-size:10.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);}
.attach-items{display:flex;flex-direction:column;gap:4px;align-items:flex-start;}
.chip{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:7px;font-size:12px;font-weight:600;border:1px solid var(--line);background:var(--surface);max-width:190px;transition:.2s;}
.chip:hover{border-color:currentColor;background:var(--bg);}
.chip .material-symbols-outlined{font-size:14px;flex-shrink:0;}
.chip .t{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.chip-doc{color:var(--blue);}
.chip-link{color:var(--green);}
.no-attach{color:var(--muted);font-size:13px;}

.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select.s-published{background:var(--green-bg);color:var(--green);}
.status-select.s-archived{background:var(--bg);color:var(--muted);}
.status-select:disabled{opacity:.6;cursor:wait;}

.rep-row{display:flex;gap:8px;align-items:center;margin-bottom:8px;}
.rep-row .finput{flex:1;min-width:0;}
.rep-del{width:34px;height:34px;border-radius:8px;color:var(--muted);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;}
.rep-del:hover{background:var(--red-bg);color:var(--red);}
.finput[readonly]{background:var(--bg);color:var(--on-surface-variant);cursor:default;}

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

.info-label{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);}
.vw-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:14px;}
.vw-body{font-size:14px;line-height:1.7;color:var(--ink);white-space:pre-wrap;margin-top:6px;}

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
<h2>Manage Notices</h2>
<p>Create, edit or remove notices &amp; news shown on the website.</p>
</div>
<button class="btn btn-primary" id="addNotice"><span class="material-symbols-outlined">add</span> Add Notice</button>
</div>

<div class="toolbar">
<div class="search"><span class="material-symbols-outlined">search</span><input id="ntSearch" type="text" placeholder="Search by title, description or category"/></div>
<div class="spacer"></div>
<div class="tabs" id="ntTabs">
<button class="tab active" data-f="all">All</button>
<button class="tab" data-f="published">Published</button>
<button class="tab" data-f="archived">Archived</button>
</div>
</div>

<div class="bulkbar" id="bulkBar" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCount">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" id="bulkClear">Clear selection</button>
<button class="btn btn-danger btn-sm" id="bulkDelete"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">

<div class="state-box" id="loadingBox"><div class="spin"></div><p style="margin-top:12px">Loading notices…</p></div>

<div class="state-box" id="emptyBox" style="display:none">
<span class="material-symbols-outlined">campaign</span>
<h4>No Notice Yet</h4>
<p id="emptyHint">No notices have been published so far.</p>
</div>

<div class="state-box err" id="errorBox" style="display:none">
<span class="material-symbols-outlined">error</span>
<h4>Could not load notices</h4>
<p id="errorMsg">Please check your connection and try again.</p>
<button class="btn btn-ghost btn-sm" id="retryBtn" style="margin-top:14px"><span class="material-symbols-outlined">refresh</span> Retry</button>
</div>

<div id="tableWrap" style="display:none">
<div class="table-wrap">
<table class="tbl" id="ntTable">
<thead>
<tr>
<th class="selcol"><input type="checkbox" id="chkAll" aria-label="Select all"/></th>
<th style="width:52px">#</th>
<th>Date</th>
<th>Title &amp; Description</th>
<th>Category</th>
<th>Attachments</th>
<th>Status</th>
<th style="text-align:right">Action</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>
<div class="pager">
<div class="pager-left">
<label class="perpage">Show
<select class="perpage-select" id="perPage">
<option value="5">5</option><option value="10" selected>10</option><option value="25">25</option><option value="50">50</option><option value="all">All</option>
</select>
entries</label>
<span class="pager-info" id="ntInfo"></span>
</div>
<div class="pager-btns" id="ntPages"></div>
</div>
</div>

</div>

</div>
</div>
</div>

<!-- Add / Edit modal -->
<div class="modal" id="ntModal">
<div class="modal-box lg">
<div class="modal-head"><h3 id="ntModalTitle">Add Notice</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<form id="ntForm">
<div class="modal-body">
<div class="field"><label>Title</label><input class="finput" id="fTitle" type="text" placeholder="Notice title" required/></div>
<div class="field-row">
<div class="field"><label>Category</label>
<select class="finput" id="fCat">
<option value="admission">Admission</option><option value="examination">Examination</option><option value="holiday">Holiday</option>
<option value="event">Event</option><option value="circular">Circular</option><option value="announcement" selected>Announcement</option>
<option value="academic">Academic</option><option value="fee">Fee</option><option value="result">Result</option>
<option value="scholarship">Scholarship</option><option value="sports">Sports</option><option value="emergency">Emergency</option>
<option value="recruitment">Recruitment</option><option value="tender">Tender</option><option value="other">Other</option>
</select>
</div>
<div class="field"><label>Date</label><input class="finput" id="fDate" type="text" readonly tabindex="-1" aria-readonly="true"/></div>
</div>
<div class="field"><label>Description / Content</label><textarea class="finput" id="fBody" placeholder="Write the notice details..."></textarea></div>
<div class="field"><label>Status</label>
<select class="finput" id="fStatus"><option value="published">Published</option><option value="archived">Archived</option></select>
</div>
<div class="field">
<label>Documents</label><div id="docList"></div>
<button type="button" class="btn btn-ghost btn-sm" id="addDoc"><span class="material-symbols-outlined">attach_file</span> Add document</button>
</div>
<div class="field">
<label>Links</label><div id="linkList"></div>
<button type="button" class="btn btn-ghost btn-sm" id="addLink"><span class="material-symbols-outlined">add_link</span> Add link</button>
</div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary" id="saveBtn">Save Notice</button></div>
</form>
</div>
</div>

<!-- View modal -->
<div class="modal" id="viewModal">
<div class="modal-box lg">
<div class="modal-head"><h3>Notice Details</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body">
<h2 style="font-family:var(--font-serif);font-size:22px;color:var(--primary-container);margin-bottom:10px" id="vTitle">—</h2>
<div class="vw-row"><span class="cat-chip" id="vCat">—</span><span id="vStatus"></span><span class="muted" id="vDate">—</span></div>
<div><span class="info-label">Description</span><div class="vw-body" id="vDesc">—</div></div>
<div style="margin-top:18px"><span class="info-label">Attachments</span><div id="vAttach" style="margin-top:8px"></div></div>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Close</button><button class="btn btn-primary" id="vEditBtn"><span class="material-symbols-outlined">edit</span> Edit</button></div>
</div>
</div>

<!-- Bulk delete popup -->
<div class="modal" id="bulkDelModal">
<div class="modal-box" style="max-width:420px">
<div class="modal-head"><h3>Delete Selected</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body" style="text-align:center">
<span class="material-symbols-outlined" style="font-size:44px;color:var(--red)">warning</span>
<div class="del-count" id="delCount" style="margin-top:8px">0</div>
<p style="margin-top:6px">notice<span id="delNoun">s</span> will be deleted</p>
<p class="muted" style="margin-top:10px">This action cannot be undone.</p>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Cancel</button><button class="btn btn-danger" id="bulkDelConfirm"><span class="material-symbols-outlined">delete</span> Delete</button></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var API = '../actions/admin/notices/';

  var table = document.getElementById('ntTable');
  var tbody = table.querySelector('tbody');
  var infoEl = document.getElementById('ntInfo');
  var pagesEl = document.getElementById('ntPages');
  var chkAll = document.getElementById('chkAll');
  var perPageSel = document.getElementById('perPage');
  var loadingBox = document.getElementById('loadingBox');
  var emptyBox = document.getElementById('emptyBox');
  var errorBox = document.getElementById('errorBox');
  var tableWrap = document.getElementById('tableWrap');

  var STATUSES = [['published','Published'],['archived','Archived']];
  var state = { status:'all', q:'', page:1, perPage:'10', total:0, pages:1, rows:[] };
  var byId = {};
  var selected = {};
  function selectedIds(){ return Object.keys(selected).filter(function(k){ return selected[k]; }); }

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function show(w){
    loadingBox.style.display = w==='loading'?'':'none';
    emptyBox.style.display   = w==='empty'  ?'':'none';
    errorBox.style.display   = w==='error'  ?'':'none';
    tableWrap.style.display  = w==='table'  ?'':'none';
  }
  function statusBadge(s){
    return '<span class="badge2 ' + (s==='archived'?'b-draft':'b-done') + '">' + (s==='archived'?'Archived':'Published') + '</span>';
  }
  function attachHtml(docs, links){
    var out = '';
    if (docs && docs.length) {
      out += '<div class="attach-group"><span class="attach-lbl">Documents:</span><div class="attach-items">' + docs.map(function(d){
        return '<a class="chip chip-doc" href="'+esc(d.url)+'" target="_blank" rel="noopener" title="'+esc(d.name)+'"><span class="material-symbols-outlined">description</span><span class="t">'+esc(d.name)+'</span></a>';
      }).join('') + '</div></div>';
    }
    if (links && links.length) {
      out += '<div class="attach-group"><span class="attach-lbl">Links:</span><div class="attach-items">' + links.map(function(l){
        return '<a class="chip chip-link" href="'+esc(l.url)+'" target="_blank" rel="noopener" title="'+esc(l.title)+'"><span class="material-symbols-outlined">link</span><span class="t">'+esc(l.title)+'</span></a>';
      }).join('') + '</div></div>';
    }
    return out ? '<div class="attach">'+out+'</div>' : '<span class="no-attach">—</span>';
  }

  /* ---------- load / render ---------- */
  function load(){
    show('loading');
    var qs = new URLSearchParams({ status:state.status, q:state.q, page:state.page, per_page:state.perPage });
    fetch(API+'list.php?'+qs.toString(), { headers:{'Accept':'application/json'} })
      .then(function(r){ return r.json().then(function(d){ return {ok:r.ok,d:d}; }); })
      .then(function(res){
        if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
        state.rows = res.d.rows || []; state.total = res.d.total||0;
        state.pages = res.d.pages||1; state.page = res.d.page||1;
        byId = {}; state.rows.forEach(function(r){ byId[r.id] = r; });
        render();
      })
      .catch(function(err){
        document.getElementById('errorMsg').textContent = err.message || 'Please try again.';
        show('error'); updateBulkBar();
      });
  }

  function render(){
    if (state.total === 0) {
      document.getElementById('emptyHint').textContent =
        (state.status !== 'all' || state.q !== '') ? 'No notices match this filter or search.' : 'No notices have been published so far.';
      show('empty'); updateBulkBar(); return;
    }
    var per = state.perPage==='all' ? state.total : parseInt(state.perPage,10);
    var start = state.perPage==='all' ? 0 : (state.page-1)*per;

    tbody.innerHTML = '';
    state.rows.forEach(function(r,i){
      var opts = STATUSES.map(function(s){
        return '<option value="'+s[0]+'"'+(s[0]===r.status?' selected':'')+'>'+s[1]+'</option>';
      }).join('');
      var tr = document.createElement('tr');
      tr.setAttribute('data-id', r.id);
      tr.innerHTML =
        '<td class="selcol"><input type="checkbox" class="rowchk"'+(selected[r.id]?' checked':'')+'/></td>'+
        '<td class="sno">'+(start+i+1)+'</td>'+
        '<td class="ntdate">'+esc(r.date)+'</td>'+
        '<td><div class="ntitle"><b>'+esc(r.title)+'</b></div><p class="ntdesc">'+esc(r.content)+'</p></td>'+
        '<td><span class="cat-chip">'+esc(r.category)+'</span></td>'+
        '<td>'+attachHtml(r.documents, r.links)+'</td>'+
        '<td><select class="status-select s-'+r.status+'">'+opts+'</select></td>'+
        '<td><div class="acts" style="justify-content:flex-end">'+
          '<button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button>'+
          '<button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button>'+
          '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>'+
        '</div></td>';
      tbody.appendChild(tr);
    });

    infoEl.textContent = 'Showing '+(start+1)+'–'+(start+state.rows.length)+' of '+state.total;

    pagesEl.innerHTML = '';
    function addBtn(html, target, o){
      o = o||{}; var b = document.createElement('button');
      b.className = 'page-btn'+(o.active?' active':''); b.innerHTML = html;
      if (o.disabled) b.disabled = true; else b.addEventListener('click', function(){ state.page=target; load(); });
      pagesEl.appendChild(b);
    }
    addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>', state.page-1, {disabled:state.page===1});
    for (var p=1;p<=state.pages;p++) addBtn(String(p), p, {active:p===state.page});
    addBtn('<span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>', state.page+1, {disabled:state.page===state.pages});

    show('table'); syncSelectAll();
  }

  /* ---------- selection ---------- */
  function pageRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }
  function syncSelectAll(){
    var rows = pageRows();
    var n = rows.filter(function(r){ return r.querySelector('.rowchk').checked; }).length;
    chkAll.checked = rows.length>0 && n===rows.length;
    chkAll.indeterminate = n>0 && n<rows.length;
    updateBulkBar();
  }
  function updateBulkBar(){
    var n = selectedIds().length;
    document.getElementById('bulkCount').textContent = n;
    document.getElementById('bulkBar').hidden = (n===0);
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
    if (e.target.closest('.acts') || e.target.closest('a') || e.target.closest('.status-select')) return;
    var td = e.target.closest('td'); if (!td) return;
    var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
    if (idx < 0 || idx > 5) return;
    var chk = td.parentNode.querySelector('.rowchk');
    if (e.target === chk) return;
    chk.checked = !chk.checked;
    if (chk.checked) selected[td.parentNode.dataset.id]=true; else delete selected[td.parentNode.dataset.id];
    syncSelectAll();
  });

  /* ---------- status change ---------- */
  table.addEventListener('change', function(e){
    if (e.target.classList.contains('rowchk')) {
      var tr = e.target.closest('tr');
      if (e.target.checked) selected[tr.dataset.id]=true; else delete selected[tr.dataset.id];
      syncSelectAll(); return;
    }
    if (!e.target.classList.contains('status-select')) return;
    var sel = e.target, row = sel.closest('tr'), id = row.dataset.id;
    var prev = (byId[id]||{}).status, next = sel.value;
    sel.disabled = true;
    fetch(API+'update_status.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({ id:id, status:next })
    }).then(function(r){ return r.json(); })
      .then(function(d){ if(!d.success) throw new Error(d.message||'Update failed'); load(); })
      .catch(function(err){
        sel.value = prev; sel.className = 'status-select s-'+prev; sel.disabled = false;
        alert('Could not update status: '+err.message);
      });
  });

  /* ---------- delete ---------- */
  var pendingDeleteId = null;
  tbody.addEventListener('click', function(e){
    var d = e.target.closest('[data-del]');
    if (d) { var tr = d.closest('tr'); pendingDeleteId = tr ? tr.dataset.id : null; }
  });
  document.addEventListener('admin:rowdeleted', function(e){
    var id = pendingDeleteId || (e.detail && e.detail.row ? e.detail.row.dataset.id : null);
    pendingDeleteId = null;
    if (!id) { load(); return; }
    postDelete([id]).then(function(){ delete selected[id]; load(); });
  });
  function postDelete(ids){
    return fetch(API+'delete.php', {
      method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({ ids:ids })
    }).then(function(r){ return r.json(); })
      .then(function(d){ if(!d.success) throw new Error(d.message||'Delete failed'); return d; })
      .catch(function(err){ alert('Could not delete: '+err.message); });
  }

  document.getElementById('bulkClear').addEventListener('click', function(){
    selected = {}; pageRows().forEach(function(tr){ tr.querySelector('.rowchk').checked=false; }); syncSelectAll();
  });
  var bulkDelModal = document.getElementById('bulkDelModal');
  document.getElementById('bulkDelete').addEventListener('click', function(){
    var n = selectedIds().length; if(!n) return;
    document.getElementById('delCount').textContent = n;
    document.getElementById('delNoun').textContent = n===1?'':'s';
    bulkDelModal.classList.add('open');
  });
  document.getElementById('bulkDelConfirm').addEventListener('click', function(){
    var ids = selectedIds(); bulkDelModal.classList.remove('open');
    if (!ids.length) return;
    postDelete(ids).then(function(){ selected = {}; load(); });
  });

  /* ---------- filters / search / paging ---------- */
  document.getElementById('ntTabs').addEventListener('click', function(e){
    var t = e.target.closest('.tab'); if(!t) return;
    this.querySelectorAll('.tab').forEach(function(x){ x.classList.remove('active'); });
    t.classList.add('active'); state.status = t.getAttribute('data-f'); state.page = 1; load();
  });
  var timer = null;
  document.getElementById('ntSearch').addEventListener('input', function(){
    var v = this.value.trim(); clearTimeout(timer);
    timer = setTimeout(function(){ state.q = v; state.page = 1; load(); }, 300);
  });
  perPageSel.addEventListener('change', function(){ state.perPage = this.value; state.page = 1; load(); });
  document.getElementById('retryBtn').addEventListener('click', load);

  /* ---------- repeatable document / link rows ---------- */
  var docList = document.getElementById('docList');
  var linkList = document.getElementById('linkList');
  function repRow(container, ph1, ph2, v1, v2){
    var row = document.createElement('div');
    row.className = 'rep-row';
    row.innerHTML = '<input class="finput f1" type="text" placeholder="'+ph1+'" value="'+esc(v1||'')+'"/>'+
                    '<input class="finput f2" type="text" placeholder="'+ph2+'" value="'+esc(v2||'')+'"/>'+
                    '<button type="button" class="rep-del"><span class="material-symbols-outlined">close</span></button>';
    row.querySelector('.rep-del').addEventListener('click', function(){ row.remove(); });
    container.appendChild(row);
  }
  function collect(container, k1, k2){
    return Array.prototype.slice.call(container.querySelectorAll('.rep-row')).map(function(row){
      var o = {}; o[k1] = row.querySelector('.f1').value.trim(); o[k2] = row.querySelector('.f2').value.trim(); return o;
    }).filter(function(o){ return o[k1] && o[k2]; });
  }
  document.getElementById('addDoc').addEventListener('click', function(){ repRow(docList,'Document name','File URL / path','',''); });
  document.getElementById('addLink').addEventListener('click', function(){ repRow(linkList,'Link title','https://…','',''); });

  /* ---------- add / edit ---------- */
  var modal = document.getElementById('ntModal');
  var form = document.getElementById('ntForm');
  var modalTitle = document.getElementById('ntModalTitle');
  var editingId = 0;

  function todayDisplay(){
    return new Date().toLocaleDateString('en-GB', { day:'2-digit', month:'short', year:'numeric' });
  }

  document.getElementById('addNotice').addEventListener('click', function(){
    editingId = 0; modalTitle.textContent = 'Add Notice';
    form.reset();
    document.getElementById('fDate').value = todayDisplay();
    docList.innerHTML = ''; linkList.innerHTML = '';
    modal.classList.add('open');
  });

  function openEdit(r){
    editingId = r.id; modalTitle.textContent = 'Edit Notice';
    document.getElementById('fTitle').value  = r.title || '';
    document.getElementById('fCat').value    = r.category || 'announcement';
    document.getElementById('fDate').value   = r.date || '';
    document.getElementById('fBody').value   = r.content || '';
    document.getElementById('fStatus').value = r.status === 'archived' ? 'archived' : 'published';
    docList.innerHTML = ''; linkList.innerHTML = '';
    (r.documents||[]).forEach(function(d){ repRow(docList,'Document name','File URL / path', d.name, d.url); });
    (r.links||[]).forEach(function(l){ repRow(linkList,'Link title','https://…', l.title, l.url); });
    modal.classList.add('open');
  }

  tbody.addEventListener('click', function(e){
    var b = e.target.closest('.edit'); if(!b) return;
    var r = byId[b.closest('tr').dataset.id]; if (r) openEdit(r);
  });

  form.addEventListener('submit', function(e){
    e.preventDefault();
    var btn = document.getElementById('saveBtn');
    btn.disabled = true;
    fetch(API+'save.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({
        id: editingId,
        title: document.getElementById('fTitle').value.trim(),
        content: document.getElementById('fBody').value.trim(),
        category: document.getElementById('fCat').value,
        status: document.getElementById('fStatus').value,
        documents: collect(docList,'name','url'),
        links: collect(linkList,'title','url')
      })
    }).then(function(r){ return r.json(); })
      .then(function(d){
        if(!d.success) throw new Error(d.message||'Save failed');
        modal.classList.remove('open'); load();
      })
      .catch(function(err){ alert('Could not save: '+err.message); })
      .finally(function(){ btn.disabled = false; });
  });

  /* ---------- view ---------- */
  var viewModal = document.getElementById('viewModal');
  var viewingId = 0;
  tbody.addEventListener('click', function(e){
    var v = e.target.closest('.view'); if(!v) return;
    var r = byId[v.closest('tr').dataset.id]; if(!r) return;
    viewingId = r.id;
    document.getElementById('vTitle').textContent = r.title;
    document.getElementById('vCat').textContent = r.category;
    document.getElementById('vStatus').innerHTML = statusBadge(r.status);
    document.getElementById('vDate').textContent = r.date;
    document.getElementById('vDesc').textContent = r.content;
    document.getElementById('vAttach').innerHTML = attachHtml(r.documents, r.links);
    viewModal.classList.add('open');
  });
  document.getElementById('vEditBtn').addEventListener('click', function(){
    viewModal.classList.remove('open');
    if (byId[viewingId]) openEdit(byId[viewingId]);
  });

  load();
});
</script>
</body></html>
