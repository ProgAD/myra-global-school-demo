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
/* Selection column */
.selcol{width:44px;text-align:center;padding-left:16px!important;padding-right:8px!important;}
.rowchk,#chkAll{width:16px;height:16px;accent-color:var(--primary-container);cursor:pointer;}
#ntTable tbody td:nth-child(-n+6){cursor:pointer;}

/* Status as a changeable coloured dropdown */
.status-select{font-weight:700;font-size:12.5px;border-radius:9999px;padding:6px 12px;border:1px solid transparent;cursor:pointer;}
.status-select:focus{outline:none;box-shadow:0 0 0 2px rgba(0,33,71,.18);}
.status-select.s-published{background:var(--green-bg);color:var(--green);}
.status-select.s-archived{background:var(--bg);color:var(--muted);}

/* Read-only form field */
.finput[readonly]{background:var(--bg);color:var(--on-surface-variant);cursor:default;}
.tbl td.sno{color:var(--muted);font-weight:700;}
.ntdate{white-space:nowrap;font-size:13.5px;}

/* Title + short description stacked */
.ntitle{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.ntitle b{font-size:14px;font-weight:700;color:var(--ink);}
.ntdesc{font-size:12.5px;line-height:1.45;color:var(--muted);margin-top:3px;max-width:330px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}

/* Category chip */
.cat-chip{display:inline-flex;padding:4px 11px;border-radius:9999px;background:var(--bg);color:var(--primary-container);font-size:12px;font-weight:700;text-transform:capitalize;white-space:nowrap;}

/* Attachments: documents + links */
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

/* Repeatable document / link rows in the form */
.rep-row{display:flex;gap:8px;align-items:center;margin-bottom:8px;}
.rep-row .finput{flex:1;min-width:0;}
.rep-del{width:34px;height:34px;border-radius:8px;color:var(--muted);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;}
.rep-del:hover{background:var(--red-bg);color:var(--red);}
.rep-empty{font-size:13px;color:var(--muted);margin-bottom:8px;}

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

/* View modal bits */
.vw-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:14px;}
.vw-body{font-size:14px;line-height:1.7;color:var(--ink);white-space:pre-wrap;}
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

<!-- Bulk actions (appears once one or more rows are selected) -->
<div class="bulkbar" id="bulkBar" hidden>
<span class="material-symbols-outlined">check_circle</span>
<span><b id="bulkCount">0</b> selected</span>
<div class="spacer"></div>
<button class="btn btn-ghost btn-sm" id="bulkClear">Clear selection</button>
<button class="btn btn-danger btn-sm" id="bulkDelete"><span class="material-symbols-outlined">delete</span> Delete selected</button>
</div>

<div class="panel">
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
<tbody>
<tr data-status="published" data-cat="admission" data-date="24 Oct 2024"
    data-title="Admissions Open for 2025-26"
    data-desc="Applications for the 2025-26 academic session are now open for Nursery through Grade 11. Forms may be submitted online or collected from the school office. Last date for submission is 30 November 2024."
    data-docs='[{"name":"Prospectus 2025-26.pdf","url":"../uploads/notices/prospectus-2025-26.pdf"},{"name":"Fee Structure.pdf","url":"../uploads/notices/fee-structure.pdf"}]'
    data-links='[{"title":"Apply Online","url":"../admission/admission-form.html"}]'
    data-name="admissions open for 2025-26 admission applications session nursery grade">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">24 Oct 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="published" data-cat="examination" data-date="22 Oct 2024"
    data-title="Half-Yearly Examination Schedule"
    data-desc="The half-yearly examinations begin on 11 November 2024. The detailed datesheet for Grades 1 to 12 is attached below. Students must carry their admit cards."
    data-docs='[{"name":"Exam Datesheet.pdf","url":"../uploads/notices/exam-datesheet.pdf"}]'
    data-links='[]'
    data-name="half-yearly examination schedule datesheet grades admit card">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">22 Oct 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="published" data-cat="sports" data-date="18 Oct 2024"
    data-title="Annual Sports Day - 25th October"
    data-desc="The 32nd Annual Sports Day will be held at the school ground from 8:00 AM. Parents are cordially invited. Students should report in their house uniforms."
    data-docs='[{"name":"Event Schedule.pdf","url":"../uploads/notices/sports-schedule.pdf"}]'
    data-links='[{"title":"Live Stream","url":"https://example.com/live"}]'
    data-name="annual sports day october event ground house uniform parents">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">18 Oct 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="published" data-cat="scholarship" data-date="08 Oct 2024"
    data-title="Merit Scholarship Applications"
    data-desc="Students scoring above 90% in the previous academic year may apply for the merit scholarship. Completed forms must reach the accounts office by 25 October."
    data-docs='[{"name":"Scholarship Form.pdf","url":"../uploads/notices/scholarship-form.pdf"}]'
    data-links='[{"title":"Eligibility Guidelines","url":"https://example.com/scholarship"}]'
    data-name="merit scholarship applications students percent accounts office form">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">08 Oct 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="published" data-cat="holiday" data-date="05 Oct 2024"
    data-title="Diwali Vacation Notice"
    data-desc="The school will remain closed from 30 October to 5 November on account of Diwali. Classes resume on 6 November as per the regular timetable."
    data-docs='[]'
    data-links='[]'
    data-name="diwali vacation notice holiday school closed classes resume november">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">05 Oct 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="published" data-cat="result" data-date="02 Oct 2024"
    data-title="Term 1 Result Declaration"
    data-desc="Term 1 results for all grades will be declared on 10 October. Report cards may be collected during the parent-teacher meeting scheduled the same week."
    data-docs='[{"name":"Result Analysis.pdf","url":"../uploads/notices/result-analysis.pdf"}]'
    data-links='[{"title":"Check Result","url":"https://example.com/result"}]'
    data-name="term 1 result declaration report cards parent teacher meeting grades">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">02 Oct 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="published" data-cat="circular" data-date="28 Sep 2024"
    data-title="Circular: Revised School Timings"
    data-desc="With effect from 1 October, school timings will be 8:00 AM to 2:15 PM for all grades. Transport routes have been adjusted accordingly."
    data-docs='[{"name":"Circular No 42.pdf","url":"../uploads/notices/circular-42.pdf"}]'
    data-links='[]'
    data-name="circular revised school timings transport routes october grades">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">28 Sep 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="archived" data-cat="recruitment" data-date="20 Sep 2024"
    data-title="Teacher Recruitment Drive 2024"
    data-desc="Applications are invited for PGT and TGT posts across Science, Mathematics and English. Walk-in interviews were held on 28 September at the main campus."
    data-docs='[{"name":"Job Description.pdf","url":"../uploads/notices/job-description.pdf"}]'
    data-links='[{"title":"Careers Page","url":"../career.php"}]'
    data-name="teacher recruitment drive pgt tgt science mathematics english interview">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">20 Sep 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
</tr>
<tr data-status="archived" data-cat="tender" data-date="15 Sep 2024"
    data-title="Tender for School Bus Procurement"
    data-desc="Sealed tenders are invited from registered vendors for the supply of four 40-seater school buses. The last date for submission was 30 September 2024."
    data-docs='[{"name":"Tender Document.pdf","url":"../uploads/notices/tender-doc.pdf"},{"name":"Technical Specs.pdf","url":"../uploads/notices/tender-specs.pdf"}]'
    data-links='[]'
    data-name="tender school bus procurement sealed vendors seater supply">
<td class="selcol"><input type="checkbox" class="rowchk"/></td>
<td class="sno"></td>
<td class="ntdate">15 Sep 2024</td>
<td class="ntcell"></td>
<td class="ntcat"></td>
<td class="attachcell"></td>
<td class="ntstatus"></td>
<td class="ntacts"></td>
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
<span class="pager-info" id="ntInfo"></span>
</div>
<div class="pager-btns" id="ntPages"></div>
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
<option value="admission">Admission</option>
<option value="examination">Examination</option>
<option value="holiday">Holiday</option>
<option value="event">Event</option>
<option value="circular">Circular</option>
<option value="announcement" selected>Announcement</option>
<option value="academic">Academic</option>
<option value="fee">Fee</option>
<option value="result">Result</option>
<option value="scholarship">Scholarship</option>
<option value="sports">Sports</option>
<option value="emergency">Emergency</option>
<option value="recruitment">Recruitment</option>
<option value="tender">Tender</option>
<option value="other">Other</option>
</select>
</div>
<div class="field"><label>Date</label><input class="finput" id="fDate" type="text" readonly tabindex="-1" aria-readonly="true"/></div>
</div>
<div class="field"><label>Description / Content</label><textarea class="finput" id="fBody" placeholder="Write the notice details..."></textarea></div>
<div class="field"><label>Status</label>
<select class="finput" id="fStatus"><option value="published">Published</option><option value="archived">Archived</option></select>
</div>

<div class="field">
<label>Documents</label>
<div id="docList"></div>
<button type="button" class="btn btn-ghost btn-sm" id="addDoc"><span class="material-symbols-outlined">attach_file</span> Add document</button>
</div>

<div class="field">
<label>Links</label>
<div id="linkList"></div>
<button type="button" class="btn btn-ghost btn-sm" id="addLink"><span class="material-symbols-outlined">add_link</span> Add link</button>
</div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary">Save Notice</button></div>
</form>
</div>
</div>

<!-- View modal -->
<div class="modal" id="viewModal">
<div class="modal-box lg">
<div class="modal-head"><h3>Notice Details</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<div class="modal-body">
<h2 style="font-family:var(--font-serif);font-size:22px;color:var(--primary-container);margin-bottom:10px" id="vTitle">—</h2>
<div class="vw-row">
<span class="cat-chip" id="vCat">—</span>
<span id="vStatus"></span>
<span class="muted" id="vDate">—</span>
</div>
<div class="field"><label>Description</label><div class="vw-body" id="vDesc">—</div></div>
<div class="field"><label>Attachments</label><div id="vAttach"></div></div>
</div>
<div class="modal-foot"><button class="btn btn-ghost" data-close>Close</button><button class="btn btn-primary" id="vEditBtn"><span class="material-symbols-outlined">edit</span> Edit</button></div>
</div>
</div>

<!-- Bulk delete confirmation popup -->
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
  var table = document.getElementById('ntTable');
  var tbody = table.querySelector('tbody');
  var filter = 'all', term = '', page = 1;

  var STATUS_LABEL = { published: 'Published', archived: 'Archived' };
  var STATUS_CLASS = { published: 'b-done', archived: 'b-draft' };

  function allRows(){ return Array.prototype.slice.call(tbody.querySelectorAll('tr')); }
  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
    });
  }
  function parseJSON(s, fallback){ try { return JSON.parse(s) || fallback; } catch (e) { return fallback; } }
  function rowDocs(tr){ return parseJSON(tr.getAttribute('data-docs'), []); }
  function rowLinks(tr){ return parseJSON(tr.getAttribute('data-links'), []); }

  function statusBadge(s){
    return '<span class="badge2 ' + (STATUS_CLASS[s] || 'b-draft') + '">' + (STATUS_LABEL[s] || s) + '</span>';
  }
  function statusSelectHtml(s){
    s = (s === 'archived') ? 'archived' : 'published';
    return '<select class="status-select s-' + s + '">' +
           '<option value="published"' + (s === 'published' ? ' selected' : '') + '>Published</option>' +
           '<option value="archived"' + (s === 'archived' ? ' selected' : '') + '>Archived</option>' +
           '</select>';
  }

  /* ---------- Cell painters ---------- */
  function attachHtml(docs, links){
    var out = '';
    if (docs.length) {
      out += '<div class="attach-group"><span class="attach-lbl">Documents:</span><div class="attach-items">' + docs.map(function (d) {
        return '<a class="chip chip-doc" href="' + esc(d.url) + '" target="_blank" rel="noopener" title="' + esc(d.name) + '">' +
               '<span class="material-symbols-outlined">description</span><span class="t">' + esc(d.name) + '</span></a>';
      }).join('') + '</div></div>';
    }
    if (links.length) {
      out += '<div class="attach-group"><span class="attach-lbl">Links:</span><div class="attach-items">' + links.map(function (l) {
        return '<a class="chip chip-link" href="' + esc(l.url) + '" target="_blank" rel="noopener" title="' + esc(l.title) + '">' +
               '<span class="material-symbols-outlined">link</span><span class="t">' + esc(l.title) + '</span></a>';
      }).join('') + '</div></div>';
    }
    return out ? '<div class="attach">' + out + '</div>' : '<span class="no-attach">—</span>';
  }

  function paintRow(tr){
    tr.querySelector('.ntdate').textContent = tr.getAttribute('data-date') || '';
    tr.querySelector('.ntcell').innerHTML =
      '<div class="ntitle"><b>' + esc(tr.getAttribute('data-title')) + '</b></div>' +
      '<p class="ntdesc">' + esc(tr.getAttribute('data-desc')) + '</p>';
    tr.querySelector('.ntcat').innerHTML = '<span class="cat-chip">' + esc(tr.getAttribute('data-cat')) + '</span>';
    tr.querySelector('.attachcell').innerHTML = attachHtml(rowDocs(tr), rowLinks(tr));
    tr.querySelector('.ntstatus').innerHTML = statusSelectHtml(tr.getAttribute('data-status'));
    tr.querySelector('.ntacts').innerHTML =
      '<div class="acts" style="justify-content:flex-end">' +
      '<button class="row-act view" title="View"><span class="material-symbols-outlined">visibility</span></button>' +
      '<button class="row-act edit" title="Edit"><span class="material-symbols-outlined">edit</span></button>' +
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

  var infoEl = document.getElementById('ntInfo');
  var pagesEl = document.getElementById('ntPages');
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
      ? 'No notices found'
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

  // Click a row (up to Attachments) toggles selection; links/actions excluded
  tbody.addEventListener('click', function (e) {
    if (e.target.closest('.acts') || e.target.closest('a')) return;
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
    // status dropdown doubles as the badge
    if (e.target.classList.contains('status-select')) {
      var r = e.target.closest('tr');
      r.setAttribute('data-status', e.target.value);
      e.target.classList.remove('s-published', 's-archived');
      e.target.classList.add('s-' + e.target.value);
      render(); // row may leave the active filter
      return;
    }
    if (e.target.classList.contains('rowchk')) syncSelectAll();
  });

  document.getElementById('ntTabs').addEventListener('click', function (e) {
    var t = e.target.closest('.tab'); if (!t) return;
    this.querySelectorAll('.tab').forEach(function (x) { x.classList.remove('active'); });
    t.classList.add('active'); filter = t.getAttribute('data-f'); page = 1; render();
  });

  document.getElementById('ntSearch').addEventListener('input', function () {
    term = this.value.trim().toLowerCase(); page = 1; render();
  });

  perPageSel.addEventListener('change', function () { page = 1; render(); });

  // admin.js confirms + removes the row -> refresh afterwards
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
    document.getElementById('delNoun').textContent = n === 1 ? '' : 's';
    bulkDelModal.classList.add('open');
  });

  document.getElementById('bulkDelConfirm').addEventListener('click', function () {
    checkedRows().forEach(function (r) { r.remove(); });
    bulkDelModal.classList.remove('open');
    render();
  });

  /* ---------- Repeatable document / link rows ---------- */
  var docList = document.getElementById('docList');
  var linkList = document.getElementById('linkList');

  function repRow(container, ph1, ph2, v1, v2){
    var row = document.createElement('div');
    row.className = 'rep-row';
    row.innerHTML =
      '<input class="finput f1" type="text" placeholder="' + ph1 + '" value="' + esc(v1 || '') + '"/>' +
      '<input class="finput f2" type="text" placeholder="' + ph2 + '" value="' + esc(v2 || '') + '"/>' +
      '<button type="button" class="rep-del"><span class="material-symbols-outlined">close</span></button>';
    row.querySelector('.rep-del').addEventListener('click', function () { row.remove(); });
    container.appendChild(row);
  }
  function collect(container, k1, k2){
    return Array.prototype.slice.call(container.querySelectorAll('.rep-row')).map(function (row) {
      var o = {};
      o[k1] = row.querySelector('.f1').value.trim();
      o[k2] = row.querySelector('.f2').value.trim();
      return o;
    }).filter(function (o) { return o[k1] && o[k2]; });
  }

  document.getElementById('addDoc').addEventListener('click', function () {
    repRow(docList, 'Document name', 'File URL / path', '', '');
  });
  document.getElementById('addLink').addEventListener('click', function () {
    repRow(linkList, 'Link title', 'https://…', '', '');
  });

  /* ---------- Add / Edit ---------- */
  var modal = document.getElementById('ntModal');
  var form = document.getElementById('ntForm');
  var modalTitle = document.getElementById('ntModalTitle');
  var editing = null;

  function fmtDate(v){
    if (!v) return '';
    var d = new Date(v);
    return isNaN(d) ? v : d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
  }
  function openAdd(){
    editing = null;
    modalTitle.textContent = 'Add Notice';
    form.reset();
    // date is fixed to today and not editable
    document.getElementById('fDate').value = fmtDate(new Date());
    docList.innerHTML = ''; linkList.innerHTML = '';
    modal.classList.add('open');
  }

  function openEdit(tr){
    editing = tr;
    modalTitle.textContent = 'Edit Notice';
    document.getElementById('fTitle').value  = tr.getAttribute('data-title') || '';
    document.getElementById('fCat').value    = tr.getAttribute('data-cat') || 'announcement';
    document.getElementById('fDate').value   = tr.getAttribute('data-date') || '';
    document.getElementById('fBody').value   = tr.getAttribute('data-desc') || '';
    document.getElementById('fStatus').value = tr.getAttribute('data-status') || 'published';
    docList.innerHTML = ''; linkList.innerHTML = '';
    rowDocs(tr).forEach(function (d) { repRow(docList, 'Document name', 'File URL / path', d.name, d.url); });
    rowLinks(tr).forEach(function (l) { repRow(linkList, 'Link title', 'https://…', l.title, l.url); });
    modal.classList.add('open');
  }

  document.getElementById('addNotice').addEventListener('click', openAdd);

  tbody.addEventListener('click', function (e) {
    var b = e.target.closest('.edit');
    if (b) openEdit(b.closest('tr'));
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var t = document.getElementById('fTitle').value.trim();
    var c = document.getElementById('fCat').value;
    var d = document.getElementById('fDate').value;
    var body = document.getElementById('fBody').value.trim();
    var s = document.getElementById('fStatus').value;
    var docs = collect(docList, 'name', 'url');
    var links = collect(linkList, 'title', 'url');

    var tr = editing;
    if (!tr) {
      tr = document.createElement('tr');
      tr.innerHTML = '<td class="selcol"><input type="checkbox" class="rowchk"/></td>' +
                     '<td class="sno"></td><td class="ntdate"></td><td class="ntcell"></td>' +
                     '<td class="ntcat"></td><td class="attachcell"></td><td class="ntstatus"></td><td class="ntacts"></td>';
      tbody.insertBefore(tr, tbody.firstChild);
    }
    tr.setAttribute('data-title', t);
    tr.setAttribute('data-cat', c);
    tr.setAttribute('data-date', d || fmtDate(new Date()));
    tr.setAttribute('data-desc', body);
    tr.setAttribute('data-status', s);
    tr.setAttribute('data-docs', JSON.stringify(docs));
    tr.setAttribute('data-links', JSON.stringify(links));
    tr.setAttribute('data-name', (t + ' ' + c + ' ' + body).toLowerCase());
    paintRow(tr);

    modal.classList.remove('open');
    render();
  });

  /* ---------- View ---------- */
  var viewModal = document.getElementById('viewModal');
  var viewingRow = null;

  tbody.addEventListener('click', function (e) {
    var v = e.target.closest('.view'); if (!v) return;
    var tr = v.closest('tr');
    viewingRow = tr;
    document.getElementById('vTitle').textContent  = tr.getAttribute('data-title');
    document.getElementById('vCat').textContent    = tr.getAttribute('data-cat');
    document.getElementById('vStatus').innerHTML   = statusBadge(tr.getAttribute('data-status'));
    document.getElementById('vDate').textContent   = tr.getAttribute('data-date');
    document.getElementById('vDesc').textContent   = tr.getAttribute('data-desc');
    document.getElementById('vAttach').innerHTML   = attachHtml(rowDocs(tr), rowLinks(tr));
    viewModal.classList.add('open');
  });

  document.getElementById('vEditBtn').addEventListener('click', function () {
    viewModal.classList.remove('open');
    if (viewingRow) openEdit(viewingRow);
  });

  render();
});
</script>
</body></html>
