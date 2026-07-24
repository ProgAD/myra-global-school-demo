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
<title>Manage Careers | Admin | Myra Global School</title>
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
<h1>Careers</h1>
<div class="spacer"></div>
<button class="icon-btn" aria-label="Notifications"><span class="material-symbols-outlined">notifications</span><span class="dot"></span></button>
<div class="profile"><span class="avatar">A</span><div class="who"><b>Admin</b><span>Administrator</span></div></div>
</header>

<div class="content">
<div class="page-head">
<div>
<h2>Manage Careers</h2>
<p>Post new vacancies, edit existing openings and review applications received.</p>
</div>
<button class="btn btn-primary" id="addVacancy"><span class="material-symbols-outlined">add</span> Post Vacancy</button>
</div>

<div class="toolbar">
<div class="tabs">
<button class="tab active" data-tab="vac" type="button">Vacancies <span class="badge2 b-draft" id="vacCount">4</span></button>
<button class="tab" data-tab="app" type="button">Applications <span class="badge2 b-new" id="appCount">5</span></button>
</div>
<div class="spacer"></div>
<div class="search"><span class="material-symbols-outlined">search</span><input id="crSearch" type="text" placeholder="Search"/></div>
</div>

<!-- ============ VACANCIES ============ -->
<section id="vacView">
<div class="panel">
<div class="table-wrap">
<table class="tbl" id="vacTable">
<thead>
<tr><th>Position</th><th>Department</th><th>Type</th><th>Openings</th><th>Posted</th><th>Status</th><th style="text-align:right">Action</th></tr>
</thead>
<tbody>
<tr data-name="tgt pgt mathematics teacher">
<td><b>PGT — Mathematics</b><div class="muted">Last date: 15 Aug 2026</div></td>
<td>Academics</td><td>Full-time</td><td>2</td><td>18 Jul 2026</td>
<td><span class="badge2 b-done">Open</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="tgt english teacher">
<td><b>TGT — English</b><div class="muted">Last date: 10 Aug 2026</div></td>
<td>Academics</td><td>Full-time</td><td>1</td><td>16 Jul 2026</td>
<td><span class="badge2 b-done">Open</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="sports coach physical education">
<td><b>Sports Coach</b><div class="muted">Last date: 05 Aug 2026</div></td>
<td>Sports</td><td>Part-time</td><td>1</td><td>12 Jul 2026</td>
<td><span class="badge2 b-done">Open</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="front office receptionist administration">
<td><b>Front Office Executive</b><div class="muted">Last date: 30 Jul 2026</div></td>
<td>Administration</td><td>Full-time</td><td>1</td><td>02 Jul 2026</td>
<td><span class="badge2 b-draft">Closed</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
</tbody>
</table>
</div>
</div>
</section>

<!-- ============ APPLICATIONS ============ -->
<section id="appView" style="display:none">
<div class="panel">
<div class="table-wrap">
<table class="tbl" id="appTable">
<thead>
<tr><th>Applicant</th><th>Applied For</th><th>Experience</th><th>Date</th><th>Status</th><th style="text-align:right">Action</th></tr>
</thead>
<tbody>
<tr data-name="rahul mehta pgt mathematics"
    data-email="rahul.mehta@example.com" data-phone="+91 98111 22334"
    data-position="PGT — Mathematics" data-exp="7 years" data-applied="20 Jul 2026"
    data-note="B.Ed with M.Sc Mathematics. Currently HOD Maths at a CBSE school; keen to join Myra Global for its academic reputation.">
<td><div class="u"><span class="ua">RM</span><div><b>Rahul Mehta</b><span>rahul.mehta@example.com</span></div></div></td>
<td>PGT — Mathematics</td><td>7 years</td><td>20 Jul 2026</td>
<td><span class="badge2 b-new">New</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="sneha iyer tgt english"
    data-email="sneha.iyer@example.com" data-phone="+91 90042 55667"
    data-position="TGT — English" data-exp="4 years" data-applied="19 Jul 2026"
    data-note="M.A English, B.Ed. Four years teaching Grades 6–10; strong in communicative English and debate coaching.">
<td><div class="u"><span class="ua">SI</span><div><b>Sneha Iyer</b><span>sneha.iyer@example.com</span></div></div></td>
<td>TGT — English</td><td>4 years</td><td>19 Jul 2026</td>
<td><span class="badge2 b-verify">Shortlisted</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="amitabh das sports coach"
    data-email="amitabh.das@example.com" data-phone="+91 98300 11220"
    data-position="Sports Coach" data-exp="6 years" data-applied="18 Jul 2026"
    data-note="Former state-level athlete, NIS certified. Six years coaching athletics and football at school level.">
<td><div class="u"><span class="ua">AD</span><div><b>Amitabh Das</b><span>amitabh.das@example.com</span></div></div></td>
<td>Sports Coach</td><td>6 years</td><td>18 Jul 2026</td>
<td><span class="badge2 b-new">New</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="priya nair pgt mathematics"
    data-email="priya.nair@example.com" data-phone="+91 99880 33445"
    data-position="PGT — Mathematics" data-exp="9 years" data-applied="17 Jul 2026"
    data-note="M.Sc, M.Ed. Nine years at ICSE schools, experienced in board result improvement and Olympiad training.">
<td><div class="u"><span class="ua">PN</span><div><b>Priya Nair</b><span>priya.nair@example.com</span></div></div></td>
<td>PGT — Mathematics</td><td>9 years</td><td>17 Jul 2026</td>
<td><span class="badge2 b-done">Reviewed</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-name="karan malhotra front office executive"
    data-email="karan.malhotra@example.com" data-phone="+91 98220 66778"
    data-position="Front Office Executive" data-exp="3 years" data-applied="15 Jul 2026"
    data-note="Graduate with 3 years front-desk experience in the education sector; fluent in English and Hindi.">
<td><div class="u"><span class="ua">KM</span><div><b>Karan Malhotra</b><span>karan.malhotra@example.com</span></div></div></td>
<td>Front Office Executive</td><td>3 years</td><td>15 Jul 2026</td>
<td><span class="badge2 b-new">New</span></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
</tbody>
</table>
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
<select class="finput" id="vDept"><option>Academics</option><option>Administration</option><option>Sports</option><option>Support Staff</option><option>Management</option></select>
</div>
<div class="field"><label>Employment Type</label>
<select class="finput" id="vType"><option>Full-time</option><option>Part-time</option><option>Contract</option><option>Internship</option></select>
</div>
</div>
<div class="field-row">
<div class="field"><label>No. of Openings</label><input class="finput" id="vOpen" type="number" min="1" value="1" required/></div>
<div class="field"><label>Last Date to Apply</label><input class="finput" id="vLast" type="date"/></div>
</div>
<div class="field"><label>Job Description</label><textarea class="finput" id="vDesc" placeholder="Roles, responsibilities and qualifications..."></textarea></div>
<div class="field"><label>Status</label>
<select class="finput" id="vStatus"><option value="open">Open</option><option value="closed">Closed</option></select>
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
<div class="u" style="margin-bottom:18px;"><span class="ua" id="aInitials" style="width:46px;height:46px;font-size:16px;">--</span><div><b id="aName" style="font-size:16px;">—</b><span id="aEmail" class="muted"></span></div></div>
<div class="field-row">
<div class="field"><label>Phone</label><div id="aPhone">—</div></div>
<div class="field"><label>Applied For</label><div id="aPosition">—</div></div>
</div>
<div class="field-row">
<div class="field"><label>Experience</label><div id="aExp">—</div></div>
<div class="field"><label>Applied On</label><div id="aApplied">—</div></div>
</div>
<div class="field"><label>Cover Note</label><div id="aNote" class="muted" style="line-height:1.6;">—</div></div>
<div class="field"><label>Update Status</label>
<select class="finput" id="aStatus"><option value="new">New</option><option value="reviewed">Reviewed</option><option value="shortlisted">Shortlisted</option><option value="rejected">Rejected</option></select>
</div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Close</button><button type="button" class="btn btn-primary" id="aSave">Save Status</button></div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  /* ----- Tab switching (Vacancies / Applications) ----- */
  var tabs = document.querySelectorAll('.tab');
  var views = { vac: document.getElementById('vacView'), app: document.getElementById('appView') };
  var search = document.getElementById('crSearch');
  var current = 'vac';
  tabs.forEach(function (t) {
    t.addEventListener('click', function () {
      tabs.forEach(function (x) { x.classList.remove('active'); });
      t.classList.add('active');
      current = t.getAttribute('data-tab');
      views.vac.style.display = current === 'vac' ? '' : 'none';
      views.app.style.display = current === 'app' ? '' : 'none';
      search.placeholder = current === 'vac' ? 'Search vacancies' : 'Search applications';
      runSearch();
    });
  });

  /* ----- Search within the active view ----- */
  function runSearch() {
    var q = search.value.trim().toLowerCase();
    var tbody = (current === 'vac' ? document.getElementById('vacTable') : document.getElementById('appTable')).tBodies[0];
    tbody.querySelectorAll('tr').forEach(function (r) {
      r.style.display = (!q || (r.getAttribute('data-name') || '').indexOf(q) > -1) ? '' : 'none';
    });
  }
  search.addEventListener('input', runSearch);

  /* ----- Vacancy add / edit ----- */
  var vModal = document.getElementById('vacModal');
  var vForm = document.getElementById('vacForm');
  var vTitle = document.getElementById('vacModalTitle');
  var vBody = document.getElementById('vacTable').tBodies[0];
  var editing = null;

  function fmtDate(v){ if(!v) return ''; var d=new Date(v); return isNaN(d)?v:d.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}); }
  function vacStatusBadge(s){ return s==='closed' ? '<span class="badge2 b-draft">Closed</span>' : '<span class="badge2 b-done">Open</span>'; }
  function vacRowHtml(t, last, dept, type, open, posted, status){
    return '<td><b>'+t+'</b><div class="muted">'+(last?('Last date: '+fmtDate(last)):'&nbsp;')+'</div></td>'+
      '<td>'+dept+'</td><td>'+type+'</td><td>'+open+'</td><td>'+posted+'</td>'+
      '<td>'+vacStatusBadge(status)+'</td>'+
      '<td><div class="acts" style="justify-content:flex-end"><button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>';
  }

  function openAddVac(){ editing=null; vTitle.textContent='Post Vacancy'; vForm.reset(); document.getElementById('vOpen').value=1; vModal.classList.add('open'); }
  function openEditVac(tr){
    editing=tr; vTitle.textContent='Edit Vacancy';
    document.getElementById('vTitle').value = tr.querySelector('b').textContent;
    document.getElementById('vDept').value  = tr.children[1].textContent.trim();
    document.getElementById('vType').value  = tr.children[2].textContent.trim();
    document.getElementById('vOpen').value  = tr.children[3].textContent.trim();
    document.getElementById('vStatus').value = tr.querySelector('.badge2').textContent.trim().toLowerCase()==='closed'?'closed':'open';
    vModal.classList.add('open');
  }

  document.getElementById('addVacancy').addEventListener('click', openAddVac);
  vBody.addEventListener('click', function(e){ var b=e.target.closest('.edit'); if(b) openEditVac(b.closest('tr')); });

  vForm.addEventListener('submit', function(e){
    e.preventDefault();
    var t=document.getElementById('vTitle').value, dept=document.getElementById('vDept').value,
        type=document.getElementById('vType').value, open=document.getElementById('vOpen').value,
        last=document.getElementById('vLast').value, status=document.getElementById('vStatus').value;
    if(editing){
      var posted = editing.children[4].textContent;
      editing.innerHTML = vacRowHtml(t, last, dept, type, open, posted, status);
      editing.setAttribute('data-name', t.toLowerCase());
    } else {
      var today = new Date().toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'});
      var tr=document.createElement('tr');
      tr.setAttribute('data-name', t.toLowerCase());
      tr.innerHTML = vacRowHtml(t, last, dept, type, open, today, status);
      vBody.insertBefore(tr, vBody.firstChild);
    }
    updateVacCount();
    vModal.classList.remove('open');
  });

  function updateVacCount(){ document.getElementById('vacCount').textContent = vBody.querySelectorAll('tr').length; }

  // Keep the tab count badges in sync after admin.js confirms a delete
  document.addEventListener('admin:rowdeleted', function () {
    updateVacCount();
    document.getElementById('appCount').textContent = document.getElementById('appTable').tBodies[0].querySelectorAll('tr').length;
  });

  /* ----- Application view ----- */
  var aModal = document.getElementById('appModal');
  var aBody = document.getElementById('appTable').tBodies[0];
  var viewingRow = null;

  function initials(name){ return name.split(' ').map(function(w){return w[0];}).join('').slice(0,2).toUpperCase(); }
  function appStatusBadge(s){
    var map={ 'new':'b-new', 'reviewed':'b-done', 'shortlisted':'b-verify', 'rejected':'b-draft' };
    var label={ 'new':'New', 'reviewed':'Reviewed', 'shortlisted':'Shortlisted', 'rejected':'Rejected' };
    return '<span class="badge2 '+(map[s]||'b-new')+'">'+(label[s]||'New')+'</span>';
  }

  aBody.addEventListener('click', function(e){
    var b=e.target.closest('.view'); if(!b) return;
    var tr=b.closest('tr'); viewingRow=tr;
    var name=tr.querySelector('b').textContent;
    document.getElementById('aInitials').textContent = initials(name);
    document.getElementById('aName').textContent = name;
    document.getElementById('aEmail').textContent = tr.getAttribute('data-email')||'';
    document.getElementById('aPhone').textContent = tr.getAttribute('data-phone')||'—';
    document.getElementById('aPosition').textContent = tr.getAttribute('data-position')||'—';
    document.getElementById('aExp').textContent = tr.getAttribute('data-exp')||'—';
    document.getElementById('aApplied').textContent = tr.getAttribute('data-applied')||'—';
    document.getElementById('aNote').textContent = tr.getAttribute('data-note')||'—';
    var cur=tr.querySelector('.badge2').textContent.trim().toLowerCase();
    document.getElementById('aStatus').value = ['new','reviewed','shortlisted','rejected'].indexOf(cur)>-1?cur:'new';
    aModal.classList.add('open');
  });

  document.getElementById('aSave').addEventListener('click', function(){
    if(viewingRow){
      var s=document.getElementById('aStatus').value;
      viewingRow.children[4].innerHTML = appStatusBadge(s);
    }
    aModal.classList.remove('open');
  });
});
</script>
</body></html>
