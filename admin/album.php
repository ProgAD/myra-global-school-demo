<?php
$page_name = 'album';   // drives sidebar highlight + topbar heading

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
<title>Album | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<script src="admin.js" defer></script>
<style>
.back{display:inline-flex;align-items:center;gap:6px;font-weight:600;font-size:14px;color:var(--muted);margin-bottom:16px;}
.back:hover{color:var(--primary-container);}
.back .material-symbols-outlined{font-size:19px;}
.alb-head{display:flex;flex-wrap:wrap;gap:16px;justify-content:space-between;align-items:flex-start;margin-bottom:24px;}
.alb-head .date{color:var(--secondary);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;}
.alb-head h2{font-family:var(--font-serif);font-size:28px;font-weight:700;color:var(--primary-container);margin:4px 0 6px;}
.alb-head p{color:var(--muted);max-width:640px;}
.alb-head .meta{margin-top:8px;font-size:13px;color:var(--muted);display:inline-flex;align-items:center;gap:6px;}
.alb-head .meta .material-symbols-outlined{font-size:16px;}
.head-actions{display:flex;gap:10px;flex-wrap:wrap;}
.head-actions label{cursor:pointer;}
.head-actions label.is-busy{opacity:.6;pointer-events:none;}

.photo-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;}
.ph{position:relative;border-radius:12px;overflow:hidden;aspect-ratio:1/1;background:var(--bg);}
.ph img{width:100%;height:100%;object-fit:cover;}
.ph-actions{position:absolute;top:8px;right:8px;display:flex;gap:6px;opacity:0;transform:translateY(-4px);transition:.2s;z-index:2;}
.ph:hover .ph-actions{opacity:1;transform:none;}
.ph-btn{width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.94);color:var(--primary-container);display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,.15);}
.ph-btn .material-symbols-outlined{font-size:18px;}
.ph-btn:hover{background:var(--secondary-fixed);}
.ph-btn.del:hover{background:var(--red);color:#fff;}
.ph-btn.set:hover{background:var(--secondary-fixed);}
.ph.is-cover{outline:3px solid var(--secondary-fixed);outline-offset:-3px;}
.ph-cover-badge{position:absolute;top:8px;left:8px;background:var(--secondary-fixed);color:var(--primary-container);font-size:11px;font-weight:700;padding:3px 9px;border-radius:9999px;display:none;align-items:center;gap:4px;z-index:2;}
.ph.is-cover .ph-cover-badge{display:inline-flex;}
.ph-cover-badge .material-symbols-outlined{font-size:13px;}
.ph.busy{opacity:.5;pointer-events:none;}
.ph img{cursor:pointer;}

/* States */
.state-box{text-align:center;padding:56px 20px;color:var(--muted);}
.state-box .material-symbols-outlined{font-size:52px;color:var(--line);}
.state-box h4{font-family:var(--font-serif);font-size:19px;font-weight:700;color:var(--primary-container);margin-top:10px;}
.state-box.err h4{color:var(--red);}
.state-box p{margin-top:6px;font-size:14px;}
.spin{width:30px;height:30px;border:3px solid var(--line);border-top-color:var(--primary-container);border-radius:50%;animation:sp .7s linear infinite;margin:0 auto;}
@keyframes sp{to{transform:rotate(360deg);}}

/* Lightbox */
.lightbox{position:fixed;inset:0;background:rgba(9,25,50,.94);display:none;align-items:center;justify-content:center;z-index:1000;padding:24px;}
.lightbox.open{display:flex;}
.lb-stage{max-width:90vw;max-height:82vh;display:flex;align-items:center;justify-content:center;}
.lb-stage img{max-width:90vw;max-height:82vh;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5);background:#000;}
.lb-close{position:absolute;top:20px;right:24px;z-index:3;width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,.12);color:#fff;display:flex;align-items:center;justify-content:center;transition:background .2s,color .2s;}
.lb-close:hover{background:var(--secondary-fixed);color:var(--primary-container);}
.lb-close .material-symbols-outlined{font-size:26px;}
.lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:52px;height:52px;border-radius:50%;background:rgba(255,255,255,.12);color:#fff;display:flex;align-items:center;justify-content:center;transition:background .2s,color .2s;z-index:3;}
.lb-nav:hover{background:var(--secondary-fixed);color:var(--primary-container);}
.lb-nav .material-symbols-outlined{font-size:30px;}
.lb-prev{left:24px;}.lb-next{right:24px;}
.lb-counter{position:absolute;bottom:22px;left:50%;transform:translateX(-50%);z-index:3;color:#fff;font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;background:rgba(0,0,0,.35);padding:6px 16px;border-radius:9999px;}

@media(min-width:600px){ .photo-grid{grid-template-columns:repeat(3,1fr);} }
@media(min-width:1000px){ .photo-grid{grid-template-columns:repeat(4,1fr);} }
@media(min-width:1400px){ .photo-grid{grid-template-columns:repeat(5,1fr);} }
@media(max-width:600px){ .lb-prev{left:10px;}.lb-next{right:10px;}.lb-nav{width:44px;height:44px;} }
</style>
</head>
<body>
<div class="admin">

<?php include '../components/admin-sidebar.php'?>

<div class="main">
<?php include '../components/admin-topbar.php'?>

<div class="content">
<a class="back" href="gallery.php"><span class="material-symbols-outlined">arrow_back</span> Back to Gallery</a>

<!-- Loading -->
<div class="state-box" id="loadingBox"><div class="spin"></div><p style="margin-top:12px">Loading album…</p></div>

<!-- Not found / error -->
<div class="state-box err" id="errorBox" style="display:none">
<span class="material-symbols-outlined">error</span>
<h4 id="errorTitle">Album not found</h4>
<p id="errorMsg">This album may have been removed.</p>
<a class="btn btn-ghost btn-sm" href="gallery.php" style="margin-top:14px"><span class="material-symbols-outlined">arrow_back</span> Back to Gallery</a>
</div>

<div id="albumWrap" style="display:none">
<div class="alb-head">
<div>
<span class="date" id="albDate"></span>
<h2 id="albTitle"></h2>
<p id="albDesc"></p>
<span class="meta"><span class="material-symbols-outlined">photo_library</span> <span id="albCount">0 photos</span></span>
</div>
<div class="head-actions">
<button class="btn btn-ghost" id="editDetails"><span class="material-symbols-outlined">edit</span> Edit details</button>
<label class="btn btn-primary" id="addMediaLabel"><span class="material-symbols-outlined">perm_media</span> <span id="addMediaText">Add Photos</span><input type="file" id="addFiles" accept="image/*" multiple hidden/></label>
</div>
</div>

<div class="photo-grid" id="photoGrid"></div>

<div class="state-box" id="emptyState" style="display:none">
<span class="material-symbols-outlined">image</span>
<h4>No Photos Yet</h4>
<p>Click <b>Add Photos</b> to upload images to this album.</p>
</div>
</div>

</div>
</div>
</div>

<!-- Media viewer -->
<div class="lightbox" id="lightbox">
<button class="lb-close" id="lbClose" aria-label="Close"><span class="material-symbols-outlined">close</span></button>
<button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous"><span class="material-symbols-outlined">chevron_left</span></button>
<div class="lb-stage" id="lbStage"></div>
<button class="lb-nav lb-next" id="lbNext" aria-label="Next"><span class="material-symbols-outlined">chevron_right</span></button>
<div class="lb-counter" id="lbCounter"></div>
</div>

<!-- Edit details modal -->
<div class="modal" id="detailsModal">
<div class="modal-box">
<div class="modal-head"><h3>Album Details</h3><button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>
<form id="detailsForm">
<div class="modal-body">
<div class="field"><label>Title</label><input class="finput" id="dTitle" type="text" placeholder="Album title" required/></div>
<div class="field"><label>Description</label><textarea class="finput" id="dDesc" placeholder="Describe this album..."></textarea></div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary" id="dSave">Save</button></div>
</form>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var API = '../actions/admin/gallery/';
  var albumId = parseInt(new URLSearchParams(location.search).get('id'), 10) || 0;

  var loadingBox = document.getElementById('loadingBox');
  var errorBox   = document.getElementById('errorBox');
  var wrap       = document.getElementById('albumWrap');
  var grid       = document.getElementById('photoGrid');
  var emptyState = document.getElementById('emptyState');
  var countEl    = document.getElementById('albCount');

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function show(w){
    loadingBox.style.display = w==='loading'?'':'none';
    errorBox.style.display   = w==='error'  ?'':'none';
    wrap.style.display       = w==='album'  ?'':'none';
  }

  if (!albumId) { document.getElementById('errorMsg').textContent = 'No album was specified.'; show('error'); return; }

  function tileHtml(m){
    return '<div class="ph'+(m.is_cover?' is-cover':'')+'" data-id="'+m.id+'">'
      + '<img src="'+esc(m.url)+'" alt="Photo"/>'
      + '<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>'
      + '<div class="ph-actions">'
      +   '<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>'
      +   '<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>'
      + '</div></div>';
  }

  function render(album, media){
    document.getElementById('albTitle').textContent = album.title;
    document.getElementById('albDate').textContent  = album.date;
    document.getElementById('albDesc').textContent  = album.description || '';
    var n = media.length;
    countEl.textContent = n + (n === 1 ? ' photo' : ' photos');
    grid.innerHTML = media.map(tileHtml).join('');
    grid.style.display = n ? 'grid' : 'none';
    emptyState.style.display = n ? 'none' : 'block';
  }

  function load(){
    show('loading');
    fetch(API + 'album_get.php?id=' + albumId, { headers:{ 'Accept':'application/json' } })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (!res.ok || !res.d.success) {
          document.getElementById('errorMsg').textContent = (res.d && res.d.message) || 'This album could not be loaded.';
          show('error'); return;
        }
        render(res.d.album, res.d.media || []);
        show('album');
      })
      .catch(function () {
        document.getElementById('errorMsg').textContent = 'Could not reach the server.';
        show('error');
      });
  }

  /* ---------- Add photos ---------- */
  var fileInput = document.getElementById('addFiles');
  var addLabel  = document.getElementById('addMediaLabel');
  var addText   = document.getElementById('addMediaText');

  fileInput.addEventListener('change', function () {
    var files = this.files;
    if (!files || !files.length) return;
    var fd = new FormData();
    fd.append('album_id', albumId);
    for (var i = 0; i < files.length; i++) fd.append('media[]', files[i]);
    this.value = '';

    addLabel.classList.add('is-busy');
    addText.textContent = 'Uploading…';

    fetch(API + 'media_upload.php', { method:'POST', body: fd })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        if (!d.success) throw new Error(d.message || 'Upload failed');
        if (d.skipped && d.skipped.length) alert('Some files were skipped:\n' + d.skipped.join('\n'));
        load();
      })
      .catch(function (err) { alert('Upload failed: ' + err.message); })
      .finally(function () {
        addLabel.classList.remove('is-busy');
        addText.textContent = 'Add Photos';
      });
  });

  /* ---------- Set cover / delete ---------- */
  grid.addEventListener('click', function (e) {
    var btn = e.target.closest('.ph-btn');
    if (btn) {
      var tile = btn.closest('.ph');
      var mediaId = tile.dataset.id;
      if (btn.classList.contains('set')) {
        tile.classList.add('busy');
        fetch(API + 'set_cover.php', {
          method:'POST', headers:{ 'Content-Type':'application/json' },
          body: JSON.stringify({ album_id: albumId, media_id: mediaId })
        }).then(function (r) { return r.json(); })
          .then(function (d) {
            if (!d.success) throw new Error(d.message || 'Failed');
            grid.querySelectorAll('.ph.is-cover').forEach(function (p) { p.classList.remove('is-cover'); });
            tile.classList.add('is-cover');
          })
          .catch(function (err) { alert('Could not set cover: ' + err.message); })
          .finally(function () { tile.classList.remove('busy'); });
      } else if (btn.classList.contains('del')) {
        if (!window.confirm('Delete this photo? This cannot be undone.')) return;
        tile.classList.add('busy');
        fetch(API + 'media_delete.php', {
          method:'POST', headers:{ 'Content-Type':'application/json' },
          body: JSON.stringify({ id: mediaId })
        }).then(function (r) { return r.json(); })
          .then(function (d) {
            if (!d.success) throw new Error(d.message || 'Failed');
            load();
          })
          .catch(function (err) { alert('Could not delete: ' + err.message); tile.classList.remove('busy'); });
      }
      return;
    }
    var img = e.target.closest('.ph');
    if (img) openViewer(img);
  });

  /* ---------- Lightbox ---------- */
  var lb = document.getElementById('lightbox');
  var stage = document.getElementById('lbStage');
  var counter = document.getElementById('lbCounter');
  var items = [], current = 0;

  function tiles() { return Array.prototype.slice.call(grid.querySelectorAll('.ph')); }
  function renderLb(i) {
    if (!items.length) return;
    current = (i + items.length) % items.length;
    stage.innerHTML = '';
    var node = document.createElement('img');
    node.src = items[current]; node.alt = 'Photo';
    stage.appendChild(node);
    counter.textContent = (current + 1) + ' / ' + items.length;
  }
  function openViewer(tile) {
    items = tiles().map(function (t) { return t.querySelector('img').getAttribute('src'); });
    var idx = tiles().indexOf(tile);
    renderLb(idx < 0 ? 0 : idx);
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeViewer() { lb.classList.remove('open'); stage.innerHTML = ''; document.body.style.overflow = ''; }
  document.getElementById('lbClose').addEventListener('click', closeViewer);
  document.getElementById('lbNext').addEventListener('click', function (e) { e.stopPropagation(); renderLb(current + 1); });
  document.getElementById('lbPrev').addEventListener('click', function (e) { e.stopPropagation(); renderLb(current - 1); });
  lb.addEventListener('click', function (e) { if (e.target === lb) closeViewer(); });
  document.addEventListener('keydown', function (e) {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeViewer();
    else if (e.key === 'ArrowRight') renderLb(current + 1);
    else if (e.key === 'ArrowLeft') renderLb(current - 1);
  });

  /* ---------- Edit details ---------- */
  var modal = document.getElementById('detailsModal');
  document.getElementById('editDetails').addEventListener('click', function () {
    document.getElementById('dTitle').value = document.getElementById('albTitle').textContent;
    document.getElementById('dDesc').value  = document.getElementById('albDesc').textContent;
    modal.classList.add('open');
  });
  document.getElementById('detailsForm').addEventListener('submit', function (e) {
    e.preventDefault();
    var btn = document.getElementById('dSave');
    btn.disabled = true;
    fetch(API + 'album_update.php', {
      method:'POST', headers:{ 'Content-Type':'application/json' },
      body: JSON.stringify({
        id: albumId,
        title: document.getElementById('dTitle').value.trim(),
        description: document.getElementById('dDesc').value.trim()
      })
    }).then(function (r) { return r.json(); })
      .then(function (d) {
        if (!d.success) throw new Error(d.message || 'Save failed');
        document.getElementById('albTitle').textContent = document.getElementById('dTitle').value.trim();
        document.getElementById('albDesc').textContent  = document.getElementById('dDesc').value.trim();
        modal.classList.remove('open');
      })
      .catch(function (err) { alert('Could not save: ' + err.message); })
      .finally(function () { btn.disabled = false; });
  });

  load();
});
</script>
</body></html>
