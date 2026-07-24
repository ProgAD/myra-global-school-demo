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
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,#chkAll{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
#enTable tbody td:nth-child(-n+6){cursor:pointer;}
.tbl td.sno{color:var(--muted);font-weight:700;}

.enq-name{font-size:14px;font-weight:700;color:var(--ink);}
.contact{font-size:12.5px;line-height:1.5;color:var(--muted);white-space:nowrap;}
.msg{font-size:13px;line-height:1.5;color:var(--on-surface-variant);max-width:340px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.recv{white-space:nowrap;font-size:13.5px;}

.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select.s-pending{background:var(--amber-bg);color:var(--amber);}
.status-select.s-replied{background:var(--green-bg);color:var(--green);}
.status-select:disabled{opacity:.6;cursor:wait;}

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

/* Enquiry details — plain label + value, not form inputs */
.info-grid{display:grid;grid-template-columns:1fr;gap:16px 28px;}
.info-item{display:flex;flex-direction:column;gap:3px;min-width:0;}
.info-label{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);}
.info-value{font-size:14.5px;font-weight:600;color:var(--ink);word-break:break-word;}
.msg-block{margin:20px 0;padding-top:18px;border-top:1px solid var(--line);}
.msg-text{font-size:14px;line-height:1.7;color:var(--on-surface-variant);white-space:pre-wrap;margin-top:6px;}
@media(min-width:560px){ .info-grid{grid-template-columns:1fr 1fr;} }

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

<div class="bulkbar" id="bulkBar" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCount">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" id="bulkClear">Clear selection</button>
<button class="btn btn-danger btn-sm" id="bulkDelete"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">

<div class="state-box" id="loadingBox"><div class="spin"></div><p style="margin-top:12px">Loading enquiries…</p></div>

<div class="state-box" id="emptyBox" style="display:none">
<span class="material-symbols-outlined">mail</span>
<h4>No Enquiry Yet</h4>
<p id="emptyHint">No enquiries have been received so far.</p>
</div>

<div class="state-box err" id="errorBox" style="display:none">
<span class="material-symbols-outlined">error</span>
<h4>Could not load enquiries</h4>
<p id="errorMsg">Please check your connection and try again.</p>
<button class="btn btn-ghost btn-sm" id="retryBtn" style="margin-top:14px"><span class="material-symbols-outlined">refresh</span> Retry</button>
</div>

<div id="tableWrap" style="display:none">
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
<span class="pager-info" id="enInfo"></span>
</div>
<div class="pager-btns" id="enPages"></div>
</div>
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

<!-- Bulk delete popup -->
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
  var API = '../actions/admin/enquiries/';

  var table = document.getElementById('enTable');
  var tbody = table.querySelector('tbody');
  var infoEl = document.getElementById('enInfo');
  var pagesEl = document.getElementById('enPages');
  var chkAll = document.getElementById('chkAll');
  var perPageSel = document.getElementById('perPage');
  var loadingBox = document.getElementById('loadingBox');
  var emptyBox = document.getElementById('emptyBox');
  var errorBox = document.getElementById('errorBox');
  var tableWrap = document.getElementById('tableWrap');

  var STATUSES = [['pending','Pending'],['replied','Replied']];
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

  function load(){
    show('loading');
    var qs = new URLSearchParams({ status:state.status, q:state.q, page:state.page, per_page:state.perPage });
    fetch(API+'list.php?'+qs.toString(), { headers:{'Accept':'application/json'} })
      .then(function(r){ return r.json().then(function(d){ return {ok:r.ok,d:d}; }); })
      .then(function(res){
        if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
        state.rows = res.d.rows||[]; state.total = res.d.total||0;
        state.pages = res.d.pages||1; state.page = res.d.page||1;
        byId = {}; state.rows.forEach(function(r){ byId[r.id]=r; });
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
        (state.status !== 'all' || state.q !== '') ? 'No enquiries match this filter or search.' : 'No enquiries have been received so far.';
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
        '<td><span class="enq-name">'+esc(r.name)+'</span></td>'+
        '<td><div class="contact">'+esc(r.phone||'—')+'<br>'+esc(r.email||'—')+'</div></td>'+
        '<td><p class="msg">'+esc(r.message)+'</p></td>'+
        '<td class="recv">'+esc(r.received)+'</td>'+
        '<td><select class="status-select s-'+r.status+'">'+opts+'</select></td>'+
        '<td><div class="acts" style="justify-content:flex-end">'+
          '<button class="row-act view" title="View &amp; reply"><span class="material-symbols-outlined">visibility</span></button>'+
          '<button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button>'+
        '</div></td>';
      tbody.appendChild(tr);
    });

    infoEl.textContent = 'Showing '+(start+1)+'–'+(start+state.rows.length)+' of '+state.total;

    pagesEl.innerHTML = '';
    function addBtn(html, target, o){
      o=o||{}; var b=document.createElement('button');
      b.className='page-btn'+(o.active?' active':''); b.innerHTML=html;
      if(o.disabled) b.disabled=true; else b.addEventListener('click',function(){ state.page=target; load(); });
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
    if (e.target.closest('.acts') || e.target.closest('.status-select')) return;
    var td = e.target.closest('td'); if(!td) return;
    var idx = Array.prototype.indexOf.call(td.parentNode.children, td);
    if (idx<0 || idx>5) return;
    var chk = td.parentNode.querySelector('.rowchk');
    if (e.target===chk) return;
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
    var sel = e.target, id = sel.closest('tr').dataset.id;
    var prev = (byId[id]||{}).status, next = sel.value;
    sel.disabled = true;
    fetch(API+'update_status.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({ id:id, status:next })
    }).then(function(r){ return r.json(); })
      .then(function(d){ if(!d.success) throw new Error(d.message||'Update failed'); load(); })
      .catch(function(err){
        sel.value = prev; sel.className='status-select s-'+prev; sel.disabled=false;
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
    document.getElementById('delNoun').textContent = n===1?'y':'ies';
    bulkDelModal.classList.add('open');
  });
  document.getElementById('bulkDelConfirm').addEventListener('click', function(){
    var ids = selectedIds(); bulkDelModal.classList.remove('open');
    if(!ids.length) return;
    postDelete(ids).then(function(){ selected = {}; load(); });
  });

  /* ---------- filters / search / paging ---------- */
  document.getElementById('enTabs').addEventListener('click', function(e){
    var t = e.target.closest('.tab'); if(!t) return;
    this.querySelectorAll('.tab').forEach(function(x){ x.classList.remove('active'); });
    t.classList.add('active'); state.status = t.getAttribute('data-f'); state.page=1; load();
  });
  var timer = null;
  document.getElementById('enSearch').addEventListener('input', function(){
    var v = this.value.trim(); clearTimeout(timer);
    timer = setTimeout(function(){ state.q=v; state.page=1; load(); }, 300);
  });
  perPageSel.addEventListener('change', function(){ state.perPage=this.value; state.page=1; load(); });
  document.getElementById('retryBtn').addEventListener('click', load);

  /* ---------- view / reply ---------- */
  var modal = document.getElementById('enModal');
  var current = null;
  tbody.addEventListener('click', function(e){
    var v = e.target.closest('.view'); if(!v) return;
    var r = byId[v.closest('tr').dataset.id]; if(!r) return;
    current = r;
    document.getElementById('eName').textContent  = r.name;
    document.getElementById('eTime').textContent  = r.received + (r.date ? ' · ' + r.date : '');
    document.getElementById('ePhone').textContent = r.phone || '—';
    document.getElementById('eEmail').textContent = r.email || '—';
    document.getElementById('eMsg').textContent   = r.message;
    document.getElementById('eReply').value       = r.reply || '';
    modal.classList.add('open');
  });

  document.getElementById('eSend').addEventListener('click', function(){
    if (!current) return;
    var btn = this;
    var reply = document.getElementById('eReply').value.trim();
    if (!reply) { alert('Please type a reply before sending.'); return; }
    btn.disabled = true;
    fetch(API+'reply.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      body: JSON.stringify({ id: current.id, reply: reply })
    }).then(function(r){ return r.json(); })
      .then(function(d){
        if(!d.success) throw new Error(d.message||'Could not send reply');
        modal.classList.remove('open'); load();
      })
      .catch(function(err){ alert(err.message); })
      .finally(function(){ btn.disabled = false; });
  });

  load();
});
</script>
</body></html>
