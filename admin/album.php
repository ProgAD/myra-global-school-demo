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
.ph video{width:100%;height:100%;object-fit:cover;display:block;}
.ph-vid{position:absolute;left:8px;bottom:8px;width:30px;height:30px;border-radius:50%;background:rgba(0,10,30,.6);color:#fff;display:flex;align-items:center;justify-content:center;z-index:2;}
.ph-vid .material-symbols-outlined{font-size:18px;}

.ph img,.ph video{cursor:pointer;}

/* Lightbox / media viewer (slideshow + player) */
.lightbox{position:fixed;inset:0;background:rgba(9,25,50,.94);display:none;align-items:center;justify-content:center;z-index:1000;padding:24px;}
.lightbox.open{display:flex;}
.lb-stage{max-width:90vw;max-height:82vh;display:flex;align-items:center;justify-content:center;}
.lb-stage img,.lb-stage video{max-width:90vw;max-height:82vh;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5);background:#000;}
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
<header class="topbar">
<button class="hamburger" id="hamburger" aria-label="Menu"><span class="material-symbols-outlined">menu</span></button>
<h1>Album</h1>
<div class="spacer"></div>
<button class="icon-btn" aria-label="Notifications"><span class="material-symbols-outlined">notifications</span><span class="dot"></span></button>
<div class="profile"><span class="avatar">A</span><div class="who"><b>Admin</b><span>Administrator</span></div></div>
</header>

<div class="content">
<a class="back" href="gallery.html"><span class="material-symbols-outlined">arrow_back</span> Back to Gallery</a>

<div class="alb-head">
<div>
<span class="date" id="albDate">December 2024</span>
<h2 id="albTitle">Annual Day Celebration</h2>
<p id="albDesc">Music, dance and drama highlights from the evening.</p>
<span class="meta"><span class="material-symbols-outlined">photo_library</span> <span id="albCount">0 photos</span></span>
</div>
<div class="head-actions">
<button class="btn btn-ghost" id="editDetails"><span class="material-symbols-outlined">edit</span> Edit details</button>
<label class="btn btn-primary"><span class="material-symbols-outlined">perm_media</span> Add Media<input type="file" id="addFiles" accept="image/*,video/*" multiple hidden/></label>
</div>
</div>

<div class="photo-grid" id="photoGrid">
<div class="ph is-cover" data-item>
<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA" alt="Photo"/>
<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>
<div class="ph-actions">
<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>
<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div>
</div>
<div class="ph" data-item>
<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew" alt="Photo"/>
<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>
<div class="ph-actions">
<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>
<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div>
</div>
<div class="ph" data-item>
<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q" alt="Photo"/>
<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>
<div class="ph-actions">
<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>
<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div>
</div>
<div class="ph" data-item>
<img src="https://lh3.googleusercontent.com/aida/AP1WRLvj2juMHe6Ny1Drz8c5bleO9fp0KfpZtEsdRb8dV9gJQHYn7VM5hdyFS8ogfM_BnBHoew1ubfI-j1pyDVBTU4WSfR6SWpbl44-9NiSAPmFrk1yZRpGYCsZFizVlznlE9WiX7U3zbpWDkc7PcUUElVs97VZ7H4C49cUTtUri1ZOUTea6aDCksnljY-O0PjMziusbGqNDYISAGi13nq8XdaJF3_HG6suvYxrrOEQAwYsf5UYVcaTmV5R380A" alt="Photo"/>
<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>
<div class="ph-actions">
<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>
<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div>
</div>
<div class="ph" data-item>
<img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEzSG6mdfW96059TNF1M1hivs6iTXZAr-vLQoKEhcbEjF7aiMXFuPqDTvOOwnwLS14mX2a0qvy96Ziym73h1CwNdqUiJhEMUvC9pvHakyvlukSDnE8A732JP02zde5D3fabGIIhHLU983zv_Nff4n-XdZunzIQpJgvpKuyNUFGokxj4o-ESTmvvx0uEslQ8cYhdbSpa2e-eovTg7Lb7XhXzR3KlgSVgFjYvnt0_mUO2F3494VEtD2g1g" alt="Photo"/>
<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>
<div class="ph-actions">
<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>
<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>
</div>
</div>
</div>

<div class="empty" id="emptyState" style="display:none">
<span class="material-symbols-outlined">image</span>
<p>No media in this album yet. Click <b>Add Media</b> to upload.</p>
</div>

</div>
</div>
</div>

<!-- Media viewer (slideshow + player) -->
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
<div class="field"><label>Event Month / Date</label><input class="finput" id="dDate" type="text" placeholder="e.g. December 2024"/></div>
<div class="field"><label>Description</label><textarea class="finput" id="dDesc" placeholder="Describe this album..."></textarea></div>
</div>
<div class="modal-foot"><button type="button" class="btn btn-ghost" data-close>Cancel</button><button type="submit" class="btn btn-primary">Save</button></div>
</form>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var grid = document.getElementById('photoGrid');
  var countEl = document.getElementById('albCount');
  var empty = document.getElementById('emptyState');

  // ---- album details from query params ----
  var q = new URLSearchParams(location.search);
  if (q.get('title')) document.getElementById('albTitle').textContent = q.get('title');
  if (q.get('date'))  document.getElementById('albDate').textContent  = q.get('date');
  if (q.get('desc') !== null && q.get('desc') !== '') document.getElementById('albDesc').textContent = q.get('desc');

  function updateCount() {
    var n = grid.querySelectorAll('.ph').length;
    countEl.textContent = n + (n === 1 ? ' item' : ' items');
    empty.style.display = n ? 'none' : 'block';
    grid.style.display = n ? 'grid' : 'none';
  }

  // keep the cover always at the first position
  function ensureCoverFirst() {
    var cover = grid.querySelector('.ph.is-cover');
    if (!cover) { cover = grid.querySelector('.ph'); if (cover) cover.classList.add('is-cover'); }
    if (cover && cover !== grid.firstElementChild) grid.insertBefore(cover, grid.firstElementChild);
  }

  updateCount();
  ensureCoverFirst();

  // ---- build a media tile (image or video) ----
  function makeTile(src, isVideo) {
    var d = document.createElement('div');
    d.className = 'ph'; d.setAttribute('data-item', '');
    var media = isVideo
      ? '<video src="' + src + '" muted playsinline></video><span class="ph-vid"><span class="material-symbols-outlined">play_arrow</span></span>'
      : '<img src="' + src + '" alt="Media"/>';
    d.innerHTML = media +
      '<span class="ph-cover-badge"><span class="material-symbols-outlined">star</span> Cover</span>' +
      '<div class="ph-actions">' +
        '<button class="ph-btn set" title="Set as cover"><span class="material-symbols-outlined">star</span></button>' +
        '<button class="ph-btn del" title="Delete"><span class="material-symbols-outlined">delete</span></button>' +
      '</div>';
    return d;
  }

  // ---- Add media (photos & videos) ----
  document.getElementById('addFiles').addEventListener('change', function () {
    var files = Array.prototype.slice.call(this.files || []);
    files.forEach(function (f) {
      var url = URL.createObjectURL(f);
      grid.appendChild(makeTile(url, f.type.indexOf('video') === 0));
    });
    this.value = '';
    ensureCoverFirst();
    updateCount();
  });

  // ---- Media actions (set cover / delete) OR open the viewer ----
  grid.addEventListener('click', function (e) {
    var btn = e.target.closest('.ph-btn');
    if (btn) {
      var tile = btn.closest('.ph');
      if (btn.classList.contains('set')) {
        grid.querySelectorAll('.ph.is-cover').forEach(function (p) { p.classList.remove('is-cover'); });
        tile.classList.add('is-cover');
        ensureCoverFirst();        // move the new cover to the front
      } else if (btn.classList.contains('del')) {
        if (window.confirm('Delete this item?')) {
          var wasCover = tile.classList.contains('is-cover');
          tile.remove();
          if (wasCover) ensureCoverFirst();
          updateCount();
        }
      }
      return;
    }
    // clicked the media itself → open the slideshow viewer
    var t = e.target.closest('.ph');
    if (t) openViewer(t);
  });

  // ---- Lightbox: slideshow + player ----
  var lb = document.getElementById('lightbox');
  var stage = document.getElementById('lbStage');
  var counter = document.getElementById('lbCounter');
  var items = [], current = 0;

  function tiles() { return Array.prototype.slice.call(grid.querySelectorAll('.ph')); }
  function collect() {
    items = tiles().map(function (t) {
      var v = t.querySelector('video');
      return v ? { type: 'video', src: v.getAttribute('src') }
               : { type: 'image', src: t.querySelector('img').getAttribute('src') };
    });
  }
  function stopVideo() { var v = stage.querySelector('video'); if (v) { try { v.pause(); } catch (err) {} } }
  function render(i) {
    if (!items.length) return;
    current = (i + items.length) % items.length;
    var it = items[current];
    stage.innerHTML = '';
    var node;
    if (it.type === 'video') {
      node = document.createElement('video');
      node.src = it.src; node.controls = true; node.autoplay = true; node.setAttribute('playsinline', '');
    } else {
      node = document.createElement('img'); node.src = it.src; node.alt = 'Media';
    }
    stage.appendChild(node);
    counter.textContent = (current + 1) + ' / ' + items.length;
  }
  function openViewer(tile) {
    collect();
    var idx = tiles().indexOf(tile);
    render(idx < 0 ? 0 : idx);
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeViewer() { stopVideo(); lb.classList.remove('open'); stage.innerHTML = ''; document.body.style.overflow = ''; }
  function next() { stopVideo(); render(current + 1); }
  function prev() { stopVideo(); render(current - 1); }

  document.getElementById('lbClose').addEventListener('click', closeViewer);
  document.getElementById('lbNext').addEventListener('click', function (e) { e.stopPropagation(); next(); });
  document.getElementById('lbPrev').addEventListener('click', function (e) { e.stopPropagation(); prev(); });
  lb.addEventListener('click', function (e) { if (e.target === lb) closeViewer(); });
  document.addEventListener('keydown', function (e) {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeViewer();
    else if (e.key === 'ArrowRight') next();
    else if (e.key === 'ArrowLeft') prev();
  });

  // ---- Edit album details ----
  var modal = document.getElementById('detailsModal');
  document.getElementById('editDetails').addEventListener('click', function () {
    document.getElementById('dTitle').value = document.getElementById('albTitle').textContent;
    document.getElementById('dDate').value  = document.getElementById('albDate').textContent;
    document.getElementById('dDesc').value  = document.getElementById('albDesc').textContent;
    modal.classList.add('open');
  });
  document.getElementById('detailsForm').addEventListener('submit', function (e) {
    e.preventDefault();
    document.getElementById('albTitle').textContent = document.getElementById('dTitle').value.trim();
    document.getElementById('albDate').textContent  = document.getElementById('dDate').value.trim();
    document.getElementById('albDesc').textContent  = document.getElementById('dDesc').value.trim();
    modal.classList.remove('open');
  });
});
</script>
</body></html>
