<?php $page_name = 'notice'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Notice &amp; News | Myra Global School</title>
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

/* Buttons */
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

/* Notice page */
.notice-page{padding:80px 0 120px;background:var(--surface);}
.notice-head{text-align:center;max-width:768px;margin:0 auto 64px;}
.notice-head-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}
.notice-grid{display:grid;grid-template-columns:1fr;gap:32px;}
.notice-card{background:var(--surface-container-lowest);padding:32px;border-left:4px solid var(--primary);box-shadow:0 1px 2px 0 rgba(0,0,0,.05);transition:box-shadow .2s;display:flex;flex-direction:column;}
.notice-card:hover{box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -2px rgba(0,0,0,.1);}
.notice-card--secondary{border-left-color:var(--secondary);}
.notice-tag{display:inline-block;align-self:flex-start;font-family:var(--font-sans);font-size:12px;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:2px 10px;border-radius:9999px;margin-bottom:14px;}
.notice-tag--exam{background:#e2ecff;color:#2b4c8c;}
.notice-tag--event{background:#e2f7ec;color:#227a52;}
.notice-tag--new{background:#ffe9d6;color:#c05621;}
.notice-tag--general{background:var(--surface-container);color:var(--secondary);}
.notice-date{font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;color:var(--on-surface-variant);display:block;margin-bottom:8px;}
.notice-card-title{font-family:var(--font-serif);font-size:20px;line-height:1.3;font-weight:600;color:var(--primary);margin-bottom:12px;}
.notice-card-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);margin-bottom:16px;flex-grow:1;}
.notice-link{font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;color:var(--primary);display:inline-flex;align-items:center;gap:4px;align-self:flex-start;}
.notice-link:hover{text-decoration:underline;}
.notice-link .material-symbols-outlined{font-size:14px;}
.notice-attach{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:4px;}
.notice-chip{display:inline-flex;align-items:center;gap:5px;font-family:var(--font-sans);font-size:13px;font-weight:600;padding:5px 11px;border-radius:8px;border:1px solid var(--outline-variant);color:var(--primary);transition:.2s;}
.notice-chip:hover{background:var(--surface-container);border-color:var(--primary);}
.notice-chip .material-symbols-outlined{font-size:15px;}

/* Toolbar: search + time filters */
.notice-toolbar{display:flex;flex-wrap:wrap;gap:16px;align-items:center;justify-content:space-between;margin-bottom:40px;}
.notice-search{position:relative;flex:1;min-width:240px;max-width:420px;}
.notice-search .material-symbols-outlined{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--on-surface-variant);font-size:20px;pointer-events:none;}
.notice-search input{width:100%;border:1px solid var(--outline-variant);border-radius:9999px;padding:12px 16px 12px 44px;font-family:var(--font-serif);font-size:16px;background:var(--surface-container-lowest);}
.notice-search input:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 1px var(--primary);}
.notice-filters{display:flex;gap:8px;flex-wrap:wrap;background:var(--surface-container-low);border:1px solid var(--outline-variant);border-radius:9999px;padding:5px;}
.range-btn{font-family:var(--font-sans);font-size:14px;font-weight:600;padding:8px 18px;border-radius:9999px;color:var(--on-surface-variant);cursor:pointer;transition:.2s;background:none;border:none;}
.range-btn:hover{color:var(--primary);}
.range-btn.active{background:var(--primary-container);color:var(--on-primary);}

/* States */
.notice-state{text-align:center;padding:64px 20px;color:var(--on-surface-variant);}
.notice-state .material-symbols-outlined{font-size:56px;color:var(--outline-variant);}
.notice-state h3{font-family:var(--font-serif);font-size:22px;font-weight:700;color:var(--primary);margin-top:12px;}
.notice-state p{margin-top:8px;}
.n-spin{width:34px;height:34px;border:3px solid var(--outline-variant);border-top-color:var(--primary-container);border-radius:50%;animation:nspin .7s linear infinite;margin:0 auto;}
@keyframes nspin{to{transform:rotate(360deg);}}

/* Read-more modal */
.nmodal{position:fixed;inset:0;background:rgba(9,25,50,.6);display:none;align-items:center;justify-content:center;z-index:1000;padding:20px;}
.nmodal.open{display:flex;}
.nmodal-box{background:#fff;border-radius:16px;max-width:640px;width:100%;max-height:88vh;overflow-y:auto;box-shadow:0 30px 60px rgba(0,0,0,.3);animation:nmPop .25s ease;}
@keyframes nmPop{from{transform:translateY(12px);opacity:0;}}
.nmodal-head{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;padding:26px 28px 0;}
.nmodal-close{font-size:28px;line-height:1;color:var(--on-surface-variant);cursor:pointer;background:none;border:none;flex-shrink:0;}
.nmodal-close:hover{color:var(--primary);}
.nmodal-cat{display:inline-block;font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--secondary);}
.nmodal-date{font-family:var(--font-sans);font-size:13px;font-weight:600;color:var(--on-surface-variant);display:block;margin-top:4px;}
.nmodal-title{font-family:var(--font-serif);font-size:26px;line-height:1.25;font-weight:700;color:var(--primary);padding:6px 28px 0;}
.nmodal-body{padding:16px 28px 26px;font-family:var(--font-serif);font-size:16px;line-height:28px;color:var(--on-surface-variant);white-space:pre-wrap;}
.nmodal-attach{display:flex;flex-wrap:wrap;gap:8px;padding:0 28px 26px;}
.nmodal-chip{display:inline-flex;align-items:center;gap:5px;font-family:var(--font-sans);font-size:13px;font-weight:600;padding:6px 12px;border-radius:8px;border:1px solid var(--outline-variant);color:var(--primary);transition:.2s;}
.nmodal-chip:hover{background:var(--surface-container);border-color:var(--primary);}
.nmodal-chip .material-symbols-outlined{font-size:15px;}
.notice-readmore{background:none;border:none;cursor:pointer;padding:0;}

/* CTA */
.cta-sec{background:var(--surface-container-high);border-top:1px solid var(--outline-variant);}
.cta-inner{display:flex;flex-direction:column;align-items:center;justify-content:space-between;gap:24px;padding:64px 0;}
.cta-title{font-family:var(--font-serif);font-size:32px;line-height:40px;font-weight:600;color:var(--primary);margin-bottom:8px;}
.cta-text{font-family:var(--font-serif);font-size:16px;line-height:26px;color:var(--on-surface-variant);}
.cta-actions{display:flex;gap:16px;flex-shrink:0;}

@media(min-width:768px){
  .notice-grid{grid-template-columns:repeat(2,1fr);}
  .cta-inner{flex-direction:row;text-align:left;}
}
@media(min-width:1024px){
  .notice-grid{grid-template-columns:repeat(3,1fr);}
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
<span class="breadcrumb-current">Notice</span>
</div>
</div>
</header>

<!-- NOTICE LIST -->
<section class="notice-page">
<div class="container">
<div class="notice-head">
<span class="eyebrow">Stay Updated</span>
<h1 class="heading-lg heading-lg--flush">Notice &amp; News</h1>
<p class="notice-head-text" style="margin-top:16px;">The latest circulars, announcements and events from across the Myra Global School community.</p>
</div>

<!-- Toolbar: search + time range filters -->
<div class="notice-toolbar">
<div class="notice-search">
<span class="material-symbols-outlined">search</span>
<input id="ntSearch" type="text" placeholder="Search notices…" aria-label="Search notices"/>
</div>
<div class="notice-filters" id="ntFilters">
<button class="range-btn active" type="button" data-range="week">This Week</button>
<button class="range-btn" type="button" data-range="month">This Month</button>
<button class="range-btn" type="button" data-range="year">This Year</button>
</div>
</div>

<!-- Loading -->
<div class="notice-state" id="ntLoading"><div class="n-spin"></div><p style="margin-top:14px">Loading notices…</p></div>

<!-- Empty -->
<div class="notice-state" id="ntEmpty" style="display:none">
<span class="material-symbols-outlined">campaign</span>
<h3>No Notices Right Now</h3>
<p id="ntEmptyHint">There are no notices for this week. Try a wider range.</p>
</div>

<!-- Error -->
<div class="notice-state" id="ntError" style="display:none">
<span class="material-symbols-outlined">error</span>
<h3>Could not load notices</h3>
<p id="ntErrorMsg">Please try again in a moment.</p>
<button class="btn-line" id="ntRetry" style="margin-top:16px">Retry</button>
</div>

<div class="notice-grid" id="ntGrid" style="display:none"></div>

</div>
</section>

<!-- Read-more modal -->
<div class="nmodal" id="ntModal" aria-hidden="true">
<div class="nmodal-box">
<div class="nmodal-head">
<div>
<span class="nmodal-cat" id="ntMCat"></span>
<span class="nmodal-date" id="ntMDate"></span>
</div>
<button class="nmodal-close" id="ntMClose" aria-label="Close">&times;</button>
</div>
<h3 class="nmodal-title" id="ntMTitle"></h3>
<div class="nmodal-body" id="ntMBody"></div>
<div class="nmodal-attach" id="ntMAttach"></div>
</div>
</div>

<!-- Footer -->
<?php include 'components/footer.php';?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('footer a').forEach(function (link) {
    link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
    link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
  });

  var API = 'actions/notices/list.php';
  var grid    = document.getElementById('ntGrid');
  var loading = document.getElementById('ntLoading');
  var empty   = document.getElementById('ntEmpty');
  var errBox  = document.getElementById('ntError');
  var range = 'week', q = '';
  var MAX_WORDS = 40;
  var byId = {};

  var RANGE_WORD = { week: 'this week', month: 'this month', year: 'this year' };

  // map a category to a colour group + display label
  var CAT_GROUP = {
    examination:'exam', result:'exam', academic:'exam',
    event:'event', sports:'event', holiday:'event',
    admission:'new', scholarship:'new',
    circular:'general', announcement:'general', fee:'general', emergency:'general',
    recruitment:'general', tender:'general', other:'general'
  };

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
  function cap(s){ return s ? s.charAt(0).toUpperCase() + s.slice(1) : s; }
  function truncateWords(str, max){
    var words = String(str || '').trim().split(/\s+/);
    if (words.length <= max) return { text: str, truncated: false };
    return { text: words.slice(0, max).join(' ') + ' …', truncated: true };
  }

  function attachHtml(docs, links){
    var chips = [];
    (docs || []).forEach(function (d) {
      chips.push('<a class="notice-chip" href="'+esc(d.url)+'" target="_blank" rel="noopener"><span class="material-symbols-outlined">description</span>'+esc(d.name)+'</a>');
    });
    (links || []).forEach(function (l) {
      chips.push('<a class="notice-chip" href="'+esc(l.url)+'" target="_blank" rel="noopener"><span class="material-symbols-outlined">link</span>'+esc(l.title)+'</a>');
    });
    return chips.length ? '<div class="notice-attach">'+chips.join('')+'</div>' : '';
  }

  function cardHtml(n, i){
    var group = CAT_GROUP[n.category] || 'general';
    var secondary = (i % 2 === 0) ? ' notice-card--secondary' : '';
    var t = truncateWords(n.content, MAX_WORDS);
    var readmore = t.truncated
      ? '<button class="notice-link notice-readmore" data-id="'+n.id+'">Read More <span class="material-symbols-outlined">arrow_forward</span></button>'
      : '';
    return '<div class="notice-card'+secondary+'">'
      + '<span class="notice-tag notice-tag--'+group+'">'+esc(cap(n.category))+'</span>'
      + '<span class="notice-date">'+esc(n.date)+'</span>'
      + '<h3 class="notice-card-title">'+esc(n.title)+'</h3>'
      + '<p class="notice-card-text">'+esc(t.text)+'</p>'
      + attachHtml(n.documents, n.links)
      + readmore
      + '</div>';
  }

  /* ---- Read-more modal ---- */
  var modal = document.getElementById('ntModal');
  function openModal(n){
    document.getElementById('ntMCat').textContent = cap(n.category);
    document.getElementById('ntMDate').textContent = n.date;
    document.getElementById('ntMTitle').textContent = n.title;
    document.getElementById('ntMBody').textContent = n.content;
    document.getElementById('ntMAttach').innerHTML =
      (n.documents || []).map(function (d) {
        return '<a class="nmodal-chip" href="'+esc(d.url)+'" target="_blank" rel="noopener"><span class="material-symbols-outlined">description</span>'+esc(d.name)+'</a>';
      }).concat((n.links || []).map(function (l) {
        return '<a class="nmodal-chip" href="'+esc(l.url)+'" target="_blank" rel="noopener"><span class="material-symbols-outlined">link</span>'+esc(l.title)+'</a>';
      })).join('');
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(){
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
  document.getElementById('ntMClose').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && modal.classList.contains('open')) closeModal(); });
  grid.addEventListener('click', function (e) {
    var b = e.target.closest('.notice-readmore'); if (!b) return;
    var n = byId[b.getAttribute('data-id')]; if (n) openModal(n);
  });

  function load(){
    show('loading');
    var qs = new URLSearchParams({ range: range, q: q });
    fetch(API + '?' + qs.toString(), { headers:{ 'Accept':'application/json' } })
      .then(function (r) { return r.json().then(function (d) { return { ok:r.ok, d:d }; }); })
      .then(function (res) {
        if (!res.ok || !res.d.success) throw new Error(res.d.message || 'Request failed');
        var rows = res.d.rows || [];
        if (!rows.length) {
          document.getElementById('ntEmptyHint').textContent = q
            ? 'No notices match your search for ' + RANGE_WORD[range] + '.'
            : 'There are no notices for ' + RANGE_WORD[range] + '. Try a wider range.';
          show('empty');
          return;
        }
        byId = {}; rows.forEach(function (n) { byId[n.id] = n; });
        grid.innerHTML = rows.map(cardHtml).join('');
        show('grid');
      })
      .catch(function (err) {
        document.getElementById('ntErrorMsg').textContent = err.message || 'Please try again in a moment.';
        show('error');
      });
  }

  document.getElementById('ntFilters').addEventListener('click', function (e) {
    var b = e.target.closest('.range-btn'); if (!b) return;
    this.querySelectorAll('.range-btn').forEach(function (x) { x.classList.remove('active'); });
    b.classList.add('active');
    range = b.getAttribute('data-range');
    load();
  });

  var timer = null;
  document.getElementById('ntSearch').addEventListener('input', function () {
    var v = this.value.trim();
    clearTimeout(timer);
    timer = setTimeout(function () { q = v; load(); }, 300);
  });

  document.getElementById('ntRetry').addEventListener('click', load);

  load();
});
</script>
</body></html>
