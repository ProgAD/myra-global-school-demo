<?php $page_name = 'album'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Album | Gallery | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet"/>
<link href="css/footer.css" rel="stylesheet"/>
<script src="js/nav.js" defer></script>
<style>
:root{
  --primary-container:#002147;--secondary-fixed:#ffe088;--secondary-fixed-dim:#e9c349;
  --on-surface-variant:#44474e;--on-background:#1e1b18;--on-primary:#ffffff;--primary:#000a1e;
  --on-secondary-fixed:#241a00;--secondary:#735c00;--surface:#fff8f5;--surface-container-low:#fbf2ed;
  --surface-container:#f5ece7;--surface-container-high:#efe6e2;--surface-container-highest:#e9e1dc;
  --surface-container-lowest:#ffffff;--background:#fff8f5;--on-surface:#1e1b18;--on-primary-container:#708ab5;
  --outline:#74777f;--outline-variant:#c4c6cf;
  --font-serif:"Source Serif 4", Georgia, serif;--font-sans:"Source Sans 3", system-ui, sans-serif;
}
*,*::before,*::after{box-sizing:border-box;}*{margin:0;}
html{scroll-behavior:smooth;}
body{background:var(--background);color:var(--on-background);font-family:var(--font-serif);font-size:16px;line-height:1.5;-webkit-font-smoothing:antialiased;}
img{display:block;max-width:100%;}a{text-decoration:none;color:inherit;}ul{list-style:none;}
button{font-family:inherit;background:none;border:none;}address{font-style:normal;}
.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;display:inline-block;vertical-align:middle;}
.container{max-width:1280px;margin:0 auto;padding-left:64px;padding-right:64px;width:100%;}
.eyebrow{font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--secondary);text-transform:uppercase;letter-spacing:.2em;display:block;margin-bottom:12px;}
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:16px;}

.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);flex-wrap:wrap;}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

.album-hero{padding:64px 0 40px;background:var(--surface);}
.album-back{display:inline-flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--secondary);margin-bottom:20px;transition:gap .2s;}
.album-back:hover{gap:10px;}
.album-back .material-symbols-outlined{font-size:18px;}
.album-meta{display:flex;flex-wrap:wrap;gap:20px;margin-top:8px;}
.album-meta-item{display:inline-flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--on-surface-variant);}
.album-meta-item .material-symbols-outlined{font-size:18px;color:var(--secondary);}
.album-lead{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);max-width:760px;margin-top:16px;}

.album-media{padding:40px 0 120px;background:var(--surface);}
.media-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;}
.media{position:relative;overflow:hidden;border-radius:8px;aspect-ratio:4/3;cursor:pointer;background:var(--surface-container);}
.media img{width:100%;height:100%;object-fit:cover;transition:transform .5s;}
.media:hover img{transform:scale(1.08);}
.media-overlay{position:absolute;inset:0;z-index:2;background:rgba(0,10,30,.18);opacity:0;transition:opacity .3s;display:flex;align-items:center;justify-content:center;}
.media:hover .media-overlay{opacity:1;}
.media-overlay .material-symbols-outlined{color:#fff;font-size:34px;}

/* States */
.al-state{text-align:center;padding:64px 20px;color:var(--on-surface-variant);}
.al-state .material-symbols-outlined{font-size:56px;color:var(--outline-variant);}
.al-state h3{font-family:var(--font-serif);font-size:24px;font-weight:700;color:var(--primary);margin-top:12px;}
.al-state p{margin-top:8px;}
.al-spin{width:34px;height:34px;border:3px solid var(--outline-variant);border-top-color:var(--primary-container);border-radius:50%;animation:alspin .7s linear infinite;margin:0 auto;}
@keyframes alspin{to{transform:rotate(360deg);}}

/* Lightbox */
.lightbox{position:fixed;inset:0;background:rgba(9,25,50,.94);display:none;align-items:center;justify-content:center;z-index:1000;padding:24px;}
.lightbox.open{display:flex;}
.lb-stage{max-width:90vw;max-height:82vh;display:flex;align-items:center;justify-content:center;}
.lb-stage img{max-width:90vw;max-height:82vh;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5);background:#000;}
.lb-close{position:absolute;top:20px;right:24px;z-index:3;width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,.12);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,color .2s;}
.lb-close:hover{background:var(--secondary-fixed);color:var(--primary);}
.lb-close .material-symbols-outlined{font-size:26px;}
.lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:52px;height:52px;border-radius:50%;background:rgba(255,255,255,.12);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,color .2s;z-index:3;}
.lb-nav:hover{background:var(--secondary-fixed);color:var(--primary);}
.lb-nav .material-symbols-outlined{font-size:30px;}
.lb-prev{left:24px;}
.lb-next{right:24px;}
.lb-counter{position:absolute;bottom:22px;left:50%;transform:translateX(-50%);z-index:3;color:#fff;font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;background:rgba(0,0,0,.35);padding:6px 16px;border-radius:9999px;}

@media(min-width:768px){ .media-grid{grid-template-columns:repeat(3,1fr);} }
@media(max-width:600px){ .lb-prev{left:10px;}.lb-next{right:10px;}.lb-nav{width:44px;height:44px;} }
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<?php include 'components/header.php'; ?>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<a href="gallery.php">Gallery</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current" id="bcTitle">Album</span>
</div>
</div>
</header>

<!-- Loading -->
<section class="album-hero"><div class="container">
<div class="al-state" id="loadingBox"><div class="al-spin"></div><p style="margin-top:14px">Loading album…</p></div>

<!-- Not found -->
<div class="al-state" id="errorBox" style="display:none">
<span class="material-symbols-outlined">image_not_supported</span>
<h3 id="errorTitle">Album Not Found</h3>
<p id="errorMsg">This album may have been removed.</p>
<a class="album-back" href="gallery.php" style="margin-top:16px"><span class="material-symbols-outlined">arrow_back</span> Back to Gallery</a>
</div>

<!-- Album header -->
<div id="albumHead" style="display:none">
<a class="album-back" href="gallery.php"><span class="material-symbols-outlined">arrow_back</span> Back to Gallery</a>
<span class="eyebrow">Photo Album</span>
<h1 class="heading-lg" id="albTitle"></h1>
<div class="album-meta">
<span class="album-meta-item"><span class="material-symbols-outlined">calendar_today</span> <span id="albDate"></span></span>
<span class="album-meta-item"><span class="material-symbols-outlined">photo_library</span> <span id="albCount"></span></span>
</div>
<p class="album-lead" id="albDesc"></p>
</div>
</div></section>

<!-- MEDIA GRID -->
<section class="album-media" id="mediaSection" style="display:none">
<div class="container">
<div class="media-grid" id="mediaGrid"></div>
<div class="al-state" id="emptyBox" style="display:none">
<span class="material-symbols-outlined">image</span>
<h3>No Photos Yet</h3>
<p>Photos for this album will be added soon.</p>
</div>
</div>
</section>

<!-- Media viewer -->
<div class="lightbox" id="lightbox">
<button class="lb-close" id="lbClose" aria-label="Close"><span class="material-symbols-outlined">close</span></button>
<button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous"><span class="material-symbols-outlined">chevron_left</span></button>
<div class="lb-stage" id="lbStage"></div>
<button class="lb-nav lb-next" id="lbNext" aria-label="Next"><span class="material-symbols-outlined">chevron_right</span></button>
<div class="lb-counter" id="lbCounter"></div>
</div>

<!-- Footer -->
<?php include 'components/footer.php';?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });

  var albumId = parseInt(new URLSearchParams(location.search).get('id'), 10) || 0;
  var loadingBox = document.getElementById('loadingBox');
  var errorBox   = document.getElementById('errorBox');
  var head       = document.getElementById('albumHead');
  var section    = document.getElementById('mediaSection');
  var grid       = document.getElementById('mediaGrid');
  var emptyBox   = document.getElementById('emptyBox');

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function fail(title, msg){
    loadingBox.style.display = 'none';
    head.style.display = 'none';
    section.style.display = 'none';
    document.getElementById('errorTitle').textContent = title;
    document.getElementById('errorMsg').textContent = msg;
    errorBox.style.display = 'block';
  }

  if (!albumId) { fail('No Album Specified', 'Please choose an album from the gallery.'); return; }

  fetch('actions/gallery/album_get.php?id=' + albumId, { headers:{ 'Accept':'application/json' } })
    .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
    .then(function (res) {
      if (!res.ok || !res.d.success) { fail('Album Not Found', (res.d && res.d.message) || 'This album could not be loaded.'); return; }
      var a = res.d.album, media = res.d.media || [];

      document.title = a.title + ' | Gallery | Myra Global School';
      document.getElementById('bcTitle').textContent = a.title;
      document.getElementById('albTitle').textContent = a.title;
      document.getElementById('albDate').textContent  = a.date;
      document.getElementById('albCount').textContent = a.count + (a.count === 1 ? ' Photo' : ' Photos');
      document.getElementById('albDesc').textContent  = a.description || '';

      loadingBox.style.display = 'none';
      head.style.display = 'block';
      section.style.display = 'block';

      if (!media.length) { grid.style.display = 'none'; emptyBox.style.display = 'block'; return; }
      grid.innerHTML = media.map(function (m) {
        return '<div class="media" data-src="'+esc(m.url)+'"><img alt="Photo" src="'+esc(m.url)+'"/>'
             + '<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div></div>';
      }).join('');
      wireViewer();
    })
    .catch(function () { fail('Could Not Load Album', 'Please try again in a moment.'); });

  /* ---------- Lightbox ---------- */
  var lb = document.getElementById('lightbox');
  var stage = document.getElementById('lbStage');
  var counter = document.getElementById('lbCounter');
  var items = [], current = 0;

  function renderLb(i){
    if (!items.length) return;
    current = (i + items.length) % items.length;
    stage.innerHTML = '';
    var img = document.createElement('img');
    img.src = items[current]; img.alt = 'Photo';
    stage.appendChild(img);
    counter.textContent = (current + 1) + ' / ' + items.length;
  }
  function openViewer(idx){
    lb.classList.add('open'); document.body.style.overflow = 'hidden'; renderLb(idx);
  }
  function closeViewer(){ lb.classList.remove('open'); stage.innerHTML = ''; document.body.style.overflow = ''; }

  function wireViewer(){
    var tiles = Array.prototype.slice.call(grid.querySelectorAll('.media'));
    items = tiles.map(function (t) { return t.getAttribute('data-src'); });
    tiles.forEach(function (t, i) { t.addEventListener('click', function () { openViewer(i); }); });
  }

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
});
</script>
</body></html>
