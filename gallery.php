<?php $page_name = 'gallery'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Gallery | Myra Global School</title>
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
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:24px;}
.heading-lg--flush{margin-bottom:0;}
.btn-fill{background:var(--primary-container);color:var(--on-primary);padding:12px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;cursor:pointer;transition:all .2s;}
.btn-fill:hover{background:var(--primary);}
.btn-line{background:transparent;border:1px solid var(--primary);color:var(--primary);padding:12px 32px;border-radius:8px;font-family:var(--font-sans);font-size:16px;cursor:pointer;transition:all .2s;}
.btn-line:hover{background:var(--primary);color:var(--on-primary);}

/* Banner */
.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

/* Gallery page */
.gallery-page{padding:80px 0 120px;background:var(--surface);}
.gallery-head{text-align:center;max-width:768px;margin:0 auto 64px;}
.gallery-head-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}
.album-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.album-card{display:block;border-radius:12px;overflow:hidden;border:1px solid var(--outline-variant);background:var(--surface-container-lowest);transition:transform .3s, box-shadow .3s;text-decoration:none;}
.album-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(0,33,71,.14);}
.album-cover{position:relative;height:220px;overflow:hidden;}
.album-cover img{width:100%;height:100%;object-fit:cover;transition:transform .5s;}
.album-card:hover .album-cover img{transform:scale(1.08);}
.album-count{position:absolute;top:12px;right:12px;background:rgba(0,33,71,.85);color:var(--secondary-fixed);font-family:var(--font-sans);font-size:12px;font-weight:600;padding:4px 10px;border-radius:9999px;display:inline-flex;align-items:center;gap:4px;}
.album-count .material-symbols-outlined{font-size:14px;}
.album-body{padding:24px;}
.album-date{font-family:var(--font-sans);font-size:13px;font-weight:600;letter-spacing:.05em;text-transform:uppercase;color:var(--secondary);margin-bottom:8px;display:block;}
.album-title{font-family:var(--font-serif);font-size:22px;line-height:1.3;font-weight:600;color:var(--primary);margin-bottom:8px;}
.album-desc{font-family:var(--font-serif);font-size:15px;line-height:1.5;color:var(--on-surface-variant);}
.album-overlay{position:absolute;inset:0;z-index:2;display:flex;align-items:center;justify-content:center;background:rgba(0,33,71,.55);opacity:0;transition:opacity .3s;}
.album-card:hover .album-overlay{opacity:1;}
.album-view-btn{display:inline-flex;align-items:center;gap:6px;background:var(--secondary-fixed);color:var(--primary);font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.03em;padding:10px 22px;border-radius:9999px;transform:translateY(8px);transition:transform .3s;}
.album-card:hover .album-view-btn{transform:translateY(0);}
.album-view-btn .material-symbols-outlined{font-size:16px;}
.album-cover-empty{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--surface-container);color:var(--outline-variant);}
.album-cover-empty .material-symbols-outlined{font-size:46px;}

/* States */
.gal-state{text-align:center;padding:64px 20px;color:var(--on-surface-variant);grid-column:1/-1;}
.gal-state .material-symbols-outlined{font-size:56px;color:var(--outline-variant);}
.gal-state h3{font-family:var(--font-serif);font-size:22px;font-weight:700;color:var(--primary);margin-top:12px;}
.gal-state p{margin-top:8px;}
.g-spin{width:34px;height:34px;border:3px solid var(--outline-variant);border-top-color:var(--primary-container);border-radius:50%;animation:gspin .7s linear infinite;margin:0 auto;}
@keyframes gspin{to{transform:rotate(360deg);}}

/* CTA */
.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;justify-content:space-between;gap:24px;padding:64px 0;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;gap:16px;flex-shrink:0;}

@media(min-width:768px){
  .album-grid{grid-template-columns:repeat(2,1fr);}
  .cta-inner{flex-direction:row;text-align:left;}
}
@media(min-width:1024px){
  .album-grid{grid-template-columns:repeat(3,1fr);}
}
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<?php include 'components/header.php';?>
<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Gallery</span>
</div>
</div>
</header>

<!-- GALLERY / ALBUMS -->
<section class="gallery-page">
<div class="container">
<div class="gallery-head">
<span class="eyebrow">Campus Life</span>
<h1 class="heading-lg heading-lg--flush">Photo Albums</h1>
<p class="gallery-head-text" style="margin-top:16px;">Relive the moments that make Myra special. Choose an album to explore photos from our events, celebrations and everyday life.</p>
</div>
<div class="album-grid" id="albumGrid">
<div class="gal-state"><div class="g-spin"></div><p style="margin-top:14px">Loading albums…</p></div>
</div>
</div>
</section>

<!-- Footer -->
<?php include 'components/footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });

  var grid = document.getElementById('albumGrid');

  function esc(s){
    return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) {
      return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;' }[c];
    });
  }
  function stateHtml(icon, title, text){
    return '<div class="gal-state"><span class="material-symbols-outlined">'+icon+'</span><h3>'+esc(title)+'</h3><p>'+esc(text)+'</p></div>';
  }

  function cardHtml(a){
    var cover = a.cover_url
      ? '<img alt="'+esc(a.title)+'" src="'+esc(a.cover_url)+'"/>'
      : '<div class="album-cover-empty"><span class="material-symbols-outlined">image</span></div>';
    return '<a class="album-card" href="album.php?id='+a.id+'">'
      + '<div class="album-cover">'
      +   '<div class="album-overlay"><span class="album-view-btn">View Album <span class="material-symbols-outlined">arrow_forward</span></span></div>'
      +   cover
      +   '<span class="album-count"><span class="material-symbols-outlined">photo_library</span> '+a.count+'</span>'
      + '</div>'
      + '<div class="album-body">'
      +   '<span class="album-date">'+esc(a.date)+'</span>'
      +   '<h3 class="album-title">'+esc(a.title)+'</h3>'
      +   '<p class="album-desc">'+esc(a.description || '')+'</p>'
      + '</div></a>';
  }

  fetch('actions/gallery/albums_list.php', { headers:{ 'Accept':'application/json' } })
    .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
    .then(function (res) {
      if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
      var rows = res.d.rows || [];
      if (!rows.length) { grid.innerHTML = stateHtml('photo_library', 'No Albums Yet', 'Photo albums will appear here soon. Please check back later.'); return; }
      grid.innerHTML = rows.map(cardHtml).join('');
    })
    .catch(function () {
      grid.innerHTML = stateHtml('error', 'Could not load albums', 'Please refresh the page or try again in a moment.');
    });
});
</script>
</body></html>
