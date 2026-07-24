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
<title>Manage Notices | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<script src="admin.js" defer></script>
</head>
<body>
<div class="admin">

<?php include '../components/admin-sidebar.php'?>

<div class="main">
<header class="topbar">
<button class="hamburger" id="hamburger" aria-label="Menu"><span class="material-symbols-outlined">menu</span></button>
<h1>Notices</h1>
<div class="spacer"></div>
<button class="icon-btn" aria-label="Notifications"><span class="material-symbols-outlined">notifications</span><span class="dot"></span></button>
<div class="profile"><span class="avatar">A</span><div class="who"><b>Admin</b><span>Administrator</span></div></div>
</header>

<div class="content">
<div class="page-head">
<div>
<h2>Manage Notices</h2>
<p>Create, edit or remove notices &amp; news shown on the website.</p>
</div>
<button class="btn btn-primary" id="addNotice"><span class="material-symbols-outlined">add</span> Add Notice</button>
</div>

<div class="toolbar">
<div class="search"><span class="material-symbols-outlined">search</span><input id="ntSearch" type="text" placeholder="Search notices"/></div>
</div>

<div class="panel">
<div class="table-wrap">
<table class="tbl" id="ntTable">
<thead>
<tr><th>Title</th><th>Category</th><th>Date</th><th>Status</th><th style="text-align:right">Action</th></tr>
</thead>
<tbody>
<tr data-name="admissions open for 2025-26">
<td><b>Admissions Open for 2025–26</b></td>
<td>Admission</td><td>24 Oct 2024</td>
<td><span class="badge2 b-done">Published</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="half-yearly examination schedule">
<td><b>Half-Yearly Examination Schedule</b></td>
<td>Examination</td><td>22 Oct 2024</td>
<td><span class="badge2 b-done">Published</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="annual sports day">
<td><b>Annual Sports Day — 25th October</b></td>
<td>Event</td><td>18 Oct 2024</td>
<td><span class="badge2 b-done">Published</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="merit scholarship applications">
<td><b>Merit Scholarship Applications</b></td>
<td>Notice</td><td>08 Oct 2024</td>
<td><span class="badge2 b-draft">Draft</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
</tbody>
</table>
</div>
</div>

</div>
</div>
</div>

<!-- Add / Edit modal -->
<div class="modal" id="ntModal">
<div class="modal-box">
<div class="modal-head"><h3 id="ntModalTitle">Add Notice</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<form id="ntForm">
<div class="modal-body">
<div class="field"><label>Title</label><input class="finput" id="fTitle" type="text" placeholder="Notice title" required/></div>
<div class="field-row">
<div class="field"><label>Category</label>
<select class="finput" id="fCat"><option>Admission</option><option>Examination</option><option>Event</option><option>Notice</option></select>
</div>
<div class="field"><label>Date</label><input class="finput" id="fDate" type="date" required/></div>
</div>
<div class="field"><label>Content</label><textarea class="finput" id="fBody" placeholder="Write the notice details..."></textarea></div>
<div class="field"><label>Status</label>
<select class="finput" id="fStatus"><option value="published">Published</option><option value="draft">Draft</option></select>
</div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary">Save Notice</button></div>
</form>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var modal = document.getElementById('ntModal');
  var form = document.getElementById('ntForm');
  var title = document.getElementById('ntModalTitle');
  var tbody = document.querySelector('#ntTable tbody');
  var editing = null;

  function fmtDate(v){ if(!v) return ''; var d=new Date(v); return isNaN(d)?v:d.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}); }
  function statusBadge(s){ return s==='draft' ? '<span class="badge2 b-draft">Draft</span>' : '<span class="badge2 b-done">Published</span>'; }
  function rowHtml(t,c,d,s){
    return '<td><b>'+t+'</b></td><td>'+c+'</td><td>'+fmtDate(d)+'</td><td>'+statusBadge(s)+'</td>'+
      '<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>';
  }

  function openAdd(){ editing=null; title.textContent='Add Notice'; form.reset(); modal.classList.add('open'); }
  function openEdit(tr){
    editing=tr; title.textContent='Edit Notice';
    document.getElementById('fTitle').value = tr.querySelector('b').textContent;
    document.getElementById('fCat').value = tr.children[1].textContent.trim();
    document.getElementById('fStatus').value = tr.querySelector('.badge2').textContent.trim().toLowerCase()==='draft'?'draft':'published';
    modal.classList.add('open');
  }

  document.getElementById('addNotice').addEventListener('click', openAdd);
  tbody.addEventListener('click', function(e){ var b=e.target.closest('.edit'); if(b) openEdit(b.closest('tr')); });

  form.addEventListener('submit', function(e){
    e.preventDefault();
    var t=document.getElementById('fTitle').value, c=document.getElementById('fCat').value,
        d=document.getElementById('fDate').value, s=document.getElementById('fStatus').value;
    if(editing){
      editing.innerHTML = rowHtml(t,c,d||editing.children[2].textContent,s);
      editing.setAttribute('data-name', t.toLowerCase());
    } else {
      var tr=document.createElement('tr');
      tr.setAttribute('data-name', t.toLowerCase());
      tr.innerHTML = rowHtml(t,c,d,s);
      tbody.insertBefore(tr, tbody.firstChild);
    }
    modal.classList.remove('open');
  });

  // search
  document.getElementById('ntSearch').addEventListener('input', function(){
    var q=this.value.trim().toLowerCase();
    tbody.querySelectorAll('tr').forEach(function(r){
      r.style.display = (!q || (r.getAttribute('data-name')||'').indexOf(q)>-1) ? '' : 'none';
    });
  });
});
</script>
</body></html>
