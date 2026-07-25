<?php $page_name = 'facilities'; $base = '../'; ?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Facilities | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="../css/header.css" rel="stylesheet"/>
<link href="../css/footer.css" rel="stylesheet"/>
<script src="../js/nav.js" defer></script>
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
button{font-family:inherit;background:none;border:none;}
.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;display:inline-block;vertical-align:middle;}
.container{max-width:1280px;margin:0 auto;padding-left:64px;padding-right:64px;width:100%;}
.eyebrow{font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--secondary);text-transform:uppercase;letter-spacing:.2em;display:block;margin-bottom:12px;}
.eyebrow--gold{color:var(--secondary-fixed);}
.heading-lg{font-family:var(--font-serif);font-size:40px;line-height:48px;font-weight:700;color:var(--primary);margin-bottom:24px;}
.heading-lg--flush{margin-bottom:0;}

.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);flex-wrap:wrap;}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

.acad-intro{padding:88px 0 56px;background:var(--surface);text-align:center;}
.acad-intro-inner{max-width:820px;margin:0 auto;}
.acad-intro-text{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);}

/* Alternating facility rows */
.fac-list{background:var(--surface);padding:20px 0 100px;overflow:hidden;}
.fac-row{display:grid;grid-template-columns:1fr;gap:28px;align-items:center;padding:44px 0;}
.fac-row + .fac-row{border-top:1px solid var(--surface-container-highest);}
.fac-media{position:relative;border-radius:16px;overflow:hidden;box-shadow:0 22px 44px -24px rgba(0,33,71,.4);}
.fac-media img{width:100%;height:300px;object-fit:cover;transition:transform .6s ease;}
.fac-media:hover img{transform:scale(1.05);}
.fac-num{position:absolute;top:16px;left:16px;background:rgba(0,33,71,.88);color:var(--secondary-fixed);font-family:var(--font-serif);font-weight:700;font-size:15px;width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;}
.fac-head{display:flex;align-items:center;gap:14px;margin-bottom:16px;}
.fac-ico{width:52px;height:52px;flex-shrink:0;border-radius:12px;background:var(--primary-container);color:var(--secondary-fixed);display:flex;align-items:center;justify-content:center;}
.fac-ico .material-symbols-outlined{font-size:28px;}
.fac-eyebrow{font-family:var(--font-sans);font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--secondary);display:block;margin-bottom:3px;}
.fac-title{font-family:var(--font-serif);font-size:26px;line-height:1.2;font-weight:700;color:var(--primary-container);margin-bottom:16px;}
.fac-text{font-family:var(--font-serif);font-size:16.5px;line-height:28px;color:var(--on-surface-variant);margin-bottom:18px;}
.fac-points{display:flex;flex-direction:column;gap:10px;}
.fac-points li{display:flex;gap:10px;font-family:var(--font-serif);font-size:15px;line-height:1.5;color:var(--on-surface-variant);}
.fac-points .material-symbols-outlined{color:var(--secondary);font-size:19px;flex-shrink:0;margin-top:1px;}

/* Scroll reveal */
.reveal{opacity:0;transform:translateY(30px);transition:opacity .7s cubic-bezier(.22,.61,.36,1),transform .7s cubic-bezier(.22,.61,.36,1);}
.reveal--left{transform:translateX(-60px);}
.reveal--right{transform:translateX(60px);}
.reveal.in{opacity:1;transform:none;}
@media(prefers-reduced-motion:reduce){.reveal{opacity:1 !important;transform:none !important;transition:none !important;}.fac-media img{transition:none;}}

@media(min-width:900px){
  .fac-row{grid-template-columns:1fr 1fr;gap:64px;padding:56px 0;}
  .fac-row--rev .fac-media{order:2;}
  .fac-media img{height:360px;}
}
@media(max-width:767px){
  .container{padding-left:20px;padding-right:20px;}
  .heading-lg{font-size:28px;line-height:36px;}
  .acad-intro{padding:64px 0 40px;}
  .fac-media img{height:240px;}
  .fac-title{font-size:22px;}
}
</style>
</head>
<body>
<?php include '../components/header.php'; ?>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="../index.php">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<a href="../academics.php">Academics</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Facilities</span>
</div>
</div>
</header>

<!-- INTRO -->
<section class="acad-intro">
<div class="container">
<div class="acad-intro-inner">
<span class="eyebrow">Campus &amp; Infrastructure</span>
<h1 class="heading-lg">Our Facilities</h1>
<p class="acad-intro-text">At Myra Global School, education transcends academics — creating an exciting, caring and supportive space where students thrive and all-round development takes centre stage.</p>
</div>
</div>
</section>

<!-- ALTERNATING FACILITIES -->
<section class="fac-list">
<div class="container">
<?php
$facilities = [
  [
    'ico' => 'groups',
    'title' => 'Interactive Learning',
    'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew',
    'text' => 'Hands-on practical models and collaborative activity-based learning modules designed for early development.',
    'points' => ['Activity-based, learn-by-doing classrooms', 'Group projects that build teamwork', 'Curiosity-driven, playful lessons'],
  ],
  [
    'ico' => 'sports_gymnastics',
    'title' => 'Music &amp; Culture',
    'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=900&q=80',
    'text' => 'Dedicated acoustic spaces for classical music, Indian percussion, and group vocal training.',
    'points' => ['Vocal and instrumental training', 'Indian classical &amp; percussion', 'Stage performances &amp; cultural events'],
  ],
  [
    'ico' => 'co_present',
    'title' => 'Digital Classrooms',
    'img' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=900&q=80',
    'text' => 'Equipped with interactive smart displays, audio-visual technology, and comfortable seating arrangements.',
    'points' => ['Interactive smart boards', 'Audio-visual learning aids', 'Spacious, comfortable seating'],
  ],
  [
    'ico' => 'science',
    'title' => 'Science Laboratories',
    'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=900&q=80',
    'text' => 'Modern science apparatus for physics, chemistry, and biology experimental learning under expert supervision.',
    'points' => ['Separate Physics, Chemistry &amp; Biology labs', 'Hands-on experiments &amp; demonstrations', 'Safe, well-equipped and supervised'],
  ],
  [
    'ico' => 'menu_book',
    'title' => 'Knowledge Center',
    'img' => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=900&q=80',
    'text' => 'Extensive collection of books, research journals, and digital archives promoting reading habits.',
    'points' => ['Wide range of books &amp; references', 'Research journals &amp; periodicals', 'Quiet reading &amp; study areas'],
  ],
];
foreach ($facilities as $i => $f):
  $rev = ($i % 2 === 1);                 // odd rows: content left, photo right
  $mediaReveal = $rev ? 'reveal--right' : 'reveal--left';
  $textReveal  = $rev ? 'reveal--left'  : 'reveal--right';
?>
<div class="fac-row<?= $rev ? ' fac-row--rev' : '' ?>">
<div class="fac-media reveal <?= $mediaReveal ?>">
<img src="<?= $f['img'] ?>" alt="<?= strip_tags($f['title']) ?>" loading="lazy"/>
</div>
<div class="fac-content reveal <?= $textReveal ?>">
<h2 class="fac-title"><?= $f['title'] ?></h2>
<p class="fac-text"><?= $f['text'] ?></p>
<ul class="fac-points">
<?php foreach ($f['points'] as $p): ?>
<li><span class="material-symbols-outlined">check_circle</span><span><?= $p ?></span></li>
<?php endforeach; ?>
</ul>
</div>
</div>
<?php endforeach; ?>
</div>
</section>

<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  if (!('IntersectionObserver' in window)) { els.forEach(function(el){ el.classList.add('in'); }); return; }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(en){ if (en.isIntersecting){ en.target.classList.add('in'); io.unobserve(en.target); } });
  }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });
  els.forEach(function(el){ io.observe(el); });
})();
</script>

<?php include '../components/footer.php'; ?>
</body></html>
