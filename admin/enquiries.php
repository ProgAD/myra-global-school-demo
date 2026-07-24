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
<title>Manage Enquiries | Admin | Myra Global School</title>
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
<h1>Enquiries</h1>
<div class="spacer"></div>
<button class="icon-btn" aria-label="Notifications"><span class="material-symbols-outlined">notifications</span><span class="dot"></span></button>
<div class="profile"><span class="avatar">A</span><div class="who"><b>Admin</b><span>Administrator</span></div></div>
</header>

<div class="content">
<div class="page-head">
<div>
<h2>Manage Enquiries</h2>
<p>View and respond to enquiries received from parents.</p>
</div>
</div>

<div class="toolbar">
<div class="search"><span class="material-symbols-outlined">search</span><input id="enSearch" type="text" placeholder="Search by name or subject"/></div>
<div class="spacer"></div>
<div class="tabs" id="enTabs">
<button class="tab active" data-f="all">All</button>
<button class="tab" data-f="new">New</button>
<button class="tab" data-f="replied">Replied</button>
</div>
</div>

<div class="panel">
<div class="table-wrap">
<table class="tbl" id="enTable">
<thead>
<tr><th>From</th><th>Subject</th><th>Received</th><th>Status</th><th style="text-align:right">Action</th></tr>
</thead>
<tbody>
<tr data-status="new" data-name="neha gupta grade 5 admission" data-phone="+91 98200 10101" data-email="neha.gupta@example.com" data-msg="Hello, I would like to know the fee structure and available seats for Grade 5 admission for my daughter. Also, are there any scholarships available? Thank you.">
<td><div class="u"><span class="ua">NG</span><div><b>Neha Gupta</b><span>neha.gupta@example.com</span></div></div></td>
<td>Grade 5 admission &amp; fees</td><td>2h ago</td>
<td class="st"></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-status="new" data-name="vikram rao campus tour" data-phone="+91 99110 22220" data-email="vikram.rao@example.com" data-msg="We are interested in visiting the campus this weekend with our son. Could you please let us know the available slots for a campus tour?">
<td><div class="u"><span class="ua">VR</span><div><b>Vikram Rao</b><span>vikram.rao@example.com</span></div></div></td>
<td>Campus tour request</td><td>5h ago</td>
<td class="st"></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-status="replied" data-name="sunita devi transport sector 12" data-phone="+91 90909 80808" data-email="sunita.devi@example.com" data-msg="Is school transport available for Sector 12? What are the timings and monthly charges?">
<td><div class="u"><span class="ua">SD</span><div><b>Sunita Devi</b><span>sunita.devi@example.com</span></div></div></td>
<td>Transport availability</td><td>Yesterday</td>
<td class="st"></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
<tr data-status="replied" data-name="arjun nair grade 11 documents" data-phone="+91 98765 00011" data-email="arjun.nair@example.com" data-msg="Please share the list of documents required for Grade 11 admission and the last date to apply.">
<td><div class="u"><span class="ua">AN</span><div><b>Arjun Nair</b><span>arjun.nair@example.com</span></div></div></td>
<td>Grade 11 documents</td><td>Yesterday</td>
<td class="st"></td>
<td><div class="acts" style="justify-content:flex-end"><button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button><button class="row-act danger" data-del title="Delete"><span class="material-symbols-outlined">delete</span></button></div></td>
</tr>
</tbody>
</table>
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
<div class="field-row">
<div class="field"><label>Name</label><div id="eName" class="finput" style="background:var(--bg)">—</div></div>
<div class="field"><label>Received</label><div id="eTime" class="finput" style="background:var(--bg)">—</div></div>
<div class="field"><label>Email</label><div id="eEmail" class="finput" style="background:var(--bg)">—</div></div>
<div class="field"><label>Phone</label><div id="ePhone" class="finput" style="background:var(--bg)">—</div></div>
</div>
<div class="field"><label>Subject</label><div id="eSubject" class="finput" style="background:var(--bg)">—</div></div>
<div class="field"><label>Message</label><div id="eMsg" class="finput" style="background:var(--bg);min-height:90px">—</div></div>
<div class="field"><label>Your Reply</label><textarea class="finput" id="eReply" placeholder="Type your reply..."></textarea></div>
</div>
<div class="modal-foot">
<button class="btn btn-ghost" data-close>Close</button>
<button class="btn btn-primary" id="eSend"><span class="material-symbols-outlined">send</span> Send Reply</button>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var table = document.getElementById('enTable');
  var rows = Array.prototype.slice.call(table.querySelectorAll('tbody tr'));
  var STAT = {
    'new':     '<span class="badge2 b-new"><span class="material-symbols-outlined">mark_email_unread</span> New</span>',
    'replied': '<span class="badge2 b-replied"><span class="material-symbols-outlined">mark_email_read</span> Replied</span>'
  };
  rows.forEach(function(r){ r.querySelector('.st').innerHTML = STAT[r.getAttribute('data-status')]; });

  // filter + search
  var filter='all', term='';
  function apply(){
    rows.forEach(function(r){
      var okF = filter==='all' || r.getAttribute('data-status')===filter;
      var okS = !term || r.getAttribute('data-name').indexOf(term)>-1;
      r.style.display = (okF&&okS)?'':'none';
    });
  }
  document.getElementById('enTabs').addEventListener('click', function(e){
    var t=e.target.closest('.tab'); if(!t) return;
    this.querySelectorAll('.tab').forEach(function(x){x.classList.remove('active');});
    t.classList.add('active'); filter=t.getAttribute('data-f'); apply();
  });
  document.getElementById('enSearch').addEventListener('input', function(){ term=this.value.trim().toLowerCase(); apply(); });

  // view/reply modal
  var modal=document.getElementById('enModal'); var current=null;
  table.addEventListener('click', function(e){
    var v=e.target.closest('.view'); if(!v) return;
    current=v.closest('tr');
    document.getElementById('eName').textContent    = current.querySelector('.u b').textContent;
    document.getElementById('eEmail').textContent   = current.getAttribute('data-email');
    document.getElementById('ePhone').textContent   = current.getAttribute('data-phone');
    document.getElementById('eTime').textContent    = current.children[2].textContent;
    document.getElementById('eSubject').textContent = current.children[1].textContent;
    document.getElementById('eMsg').textContent     = current.getAttribute('data-msg');
    document.getElementById('eReply').value='';
    modal.classList.add('open');
  });
  document.getElementById('eSend').addEventListener('click', function(){
    if(current){
      current.setAttribute('data-status','replied');
      current.querySelector('.st').innerHTML = STAT.replied;
      apply();
    }
    modal.classList.remove('open');
  });
});
</script>
</body></html>
