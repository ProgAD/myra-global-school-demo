<?php
$page_name = 'gallery';   // drives sidebar highlight + topbar heading

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
<title>Manage Gallery | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<style>
.alb-cover-empty{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--bg);color:var(--line);}
.alb-cover-empty .material-symbols-outlined{font-size:44px;}
.state-box{text-align:center;padding:56px 20px;color:var(--muted);grid-column:1/-1;}
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
<h2>Manage Gallery</h2>
<p>Create albums and manage photos of school events.</p>
</div>
<button class="btn btn-primary" id="addAlbum"><span class="material-symbols-outlined">add_photo_alternate</span> Add Album</button>
</div>

<!-- Loading -->
<div class="state-box" id="loadingBox"><div class="spin"></div><p style="margin-top:12px">Loading albums…</p></div>

<!-- Empty -->
<div class="state-box" id="emptyBox" style="display:none">
<span class="material-symbols-outlined">photo_library</span>
<h4>No Albums Yet</h4>
<p>Create your first album to start adding photos.</p>
</div>

<!-- Error -->
<div class="state-box err" id="errorBox" style="display:none">
<span class="material-symbols-outlined">error</span>
<h4>Could not load albums</h4>
<p id="errorMsg">Please try again in a moment.</p>
<button class="btn btn-ghost btn-sm" id="retryBtn" style="margin-top:14px"><span class="material-symbols-outlined">refresh</span> Retry</button>
</div>

<div class="alb-grid" id="albGrid" style="display:none"></div>

</div>
</div>
</div>

<!-- Add album modal -->
<div class="modal" id="albModal">
<div class="modal-box">
<div class="modal-head"><h3>Add Album</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<form id="albForm">
<div class="modal-body">
<div class="field"><label>Album Title</label><input class="finput" id="aTitle" type="text" placeholder="e.g. Annual Day Celebration" required/></div>
<div class="field"><label>Short Description</label><textarea class="finput" id="aDesc" placeholder="One line about this album"></textarea></div>
<p class="muted" style="font-size:13px">You'll be taken to the album to upload photos after it's created. The first photo becomes the cover.</p>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary" id="createBtn">Create Album</button></div>
</form>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var API = '../actions/admin/gallery/';
  var grid    = document.getElementById('albGrid');
  var loading = document.getElementById('loadingBox');
  var empty   = document.getElementById('emptyBox');
  var errBox  = document.getElementById('errorBox');
  var modal   = document.getElementById('albModal');
  var form    = document.getElementById('albForm');

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function show(w){
    loading.style.display = w==='loading'?'':'none';
    empty.style.display   = w==='empty'  ?'':'none';
    errBox.style.display  = w==='error'  ?'':'none';
    grid.style.display    = w==='grid'   ?'grid':'none';
  }

  function cardHtml(a){
    var cover = a.cover_url
      ? '<img alt="'+esc(a.title)+'" src="'+esc(a.cover_url)+'"/>'
      : '<div class="alb-cover-empty"><span class="material-symbols-outlined">image</span></div>';
    return '<div class="alb" data-item data-id="'+a.id+'">'
      + '<div class="alb-cover">'
      +   cover
      +   '<span class="alb-count"><span class="material-symbols-outlined">photo_library</span> '+a.count+'</span>'
      +   '<button class="alb-del" data-del title="Delete album"><span class="material-symbols-outlined">delete</span></button>'
      +   '<a class="alb-overlay" href="album.php?id='+a.id+'"><span class="alb-open"><span class="material-symbols-outlined">visibility</span> Open Album</span></a>'
      + '</div>'
      + '<div class="alb-body"><span class="date">'+esc(a.date)+'</span><h4>'+esc(a.title)+'</h4><p>'+esc(a.description || '')+'</p></div>'
      + '</div>';
  }

  function load(){
    show('loading');
    fetch(API + 'albums_list.php', { headers:{ 'Accept':'application/json' } })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
        var rows = res.d.rows || [];
        if (!rows.length) { show('empty'); return; }
        grid.innerHTML = rows.map(cardHtml).join('');
        show('grid');
      })
      .catch(function (err) {
        document.getElementById('errorMsg').textContent = err.message || 'Please try again.';
        show('error');
      });
  }

  document.getElementById('retryBtn').addEventListener('click', load);

  document.getElementById('addAlbum').addEventListener('click', function () {
    form.reset(); modal.classList.add('open');
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var btn = document.getElementById('createBtn');
    btn.disabled = true;
    fetch(API + 'album_create.php', {
      method:'POST', headers:{ 'Content-Type':'application/json' },
      body: JSON.stringify({
        title: document.getElementById('aTitle').value.trim(),
        description: document.getElementById('aDesc').value.trim()
      })
    }).then(function (r) { return r.json(); })
      .then(function (d) {
        if (!d.success) throw new Error(d.message || 'Could not create album');
        window.location.href = d.redirect || ('album.php?id=' + d.id);
      })
      .catch(function (err) { alert(err.message); btn.disabled = false; });
  });

  // delete album (admin.js confirms + removes the card) -> call API, then reload
  var pendingId = null;
  grid.addEventListener('click', function (e) {
    var d = e.target.closest('[data-del]');
    if (d) { var c = d.closest('.alb'); pendingId = c ? c.dataset.id : null; }
  });
  document.addEventListener('admin:rowdeleted', function () {
    var id = pendingId; pendingId = null;
    if (!id) { load(); return; }
    fetch(API + 'album_delete.php', {
      method:'POST', headers:{ 'Content-Type':'application/json' }, body: JSON.stringify({ ids:[id] })
    }).then(function (r) { return r.json(); })
      .then(function (d) { if (!d.success) throw new Error(d.message || 'Delete failed'); load(); })
      .catch(function (err) { alert('Could not delete album: ' + err.message); load(); });
  });

  load();
});
</script>
</body></html>
