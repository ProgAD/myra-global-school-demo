<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Annual Day Celebration | Gallery | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="css/header.css" rel="stylesheet"/>
<link href="css/footer.css" rel="stylesheet"/>
<script src="js/nav.js" defer></script>
<script src="js/album.js" defer></script>
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

/* Banner */
.page-banner{position:relative;width:100%;height:50px;overflow:hidden;display:flex;align-items:center;background:var(--primary-container);}
.breadcrumb{display:flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:16px;color:var(--on-primary-container);}
.breadcrumb a{color:var(--on-primary-container);transition:color .2s;}
.breadcrumb a:hover{color:var(--secondary-fixed);}
.breadcrumb .material-symbols-outlined{font-size:18px;}
.breadcrumb-current{color:var(--secondary-fixed);}

/* Album header */
.album-hero{padding:64px 0 40px;background:var(--surface);}
.album-back{display:inline-flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--secondary);margin-bottom:20px;transition:gap .2s;}
.album-back:hover{gap:10px;}
.album-back .material-symbols-outlined{font-size:18px;}
.album-meta{display:flex;flex-wrap:wrap;gap:20px;margin-top:8px;}
.album-meta-item{display:inline-flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:14px;font-weight:600;color:var(--on-surface-variant);}
.album-meta-item .material-symbols-outlined{font-size:18px;color:var(--secondary);}
.album-lead{font-family:var(--font-serif);font-size:20px;line-height:32px;color:var(--on-surface-variant);max-width:760px;margin-top:16px;}

/* Media grid */
.album-media{padding:40px 0 120px;background:var(--surface);}
.media-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;}
.media{position:relative;overflow:hidden;border-radius:8px;aspect-ratio:4/3;cursor:pointer;background:var(--surface-container);}
.media img{width:100%;height:100%;object-fit:cover;transition:transform .5s;}
.media:hover img{transform:scale(1.08);}
.media-overlay{position:absolute;inset:0;z-index:2;background:rgba(0,10,30,.18);opacity:0;transition:opacity .3s;display:flex;align-items:center;justify-content:center;}
.media:hover .media-overlay{opacity:1;}
.media-overlay .material-symbols-outlined{color:#fff;font-size:34px;}
.media-badge{position:absolute;top:10px;left:10px;z-index:3;display:inline-flex;align-items:center;gap:4px;background:rgba(0,33,71,.85);color:var(--secondary-fixed);font-family:var(--font-sans);font-size:12px;font-weight:600;padding:4px 10px;border-radius:9999px;}
.media-badge .material-symbols-outlined{font-size:14px;}
/* video tile — play button always visible */
.media--video .media-overlay{opacity:1;background:rgba(0,10,30,.28);}
.play-circle{width:60px;height:60px;border-radius:50%;background:rgba(255,255,255,.92);display:flex;align-items:center;justify-content:center;transition:transform .3s;}
.media--video:hover .play-circle{transform:scale(1.1);}
.play-circle .material-symbols-outlined{color:var(--primary);font-size:34px;margin-left:3px;}

/* Lightbox / media viewer */
.lightbox{position:fixed;inset:0;background:rgba(9,25,50,.94);display:none;align-items:center;justify-content:center;z-index:1000;padding:24px;}
.lightbox.open{display:flex;}
.lb-stage{max-width:90vw;max-height:82vh;display:flex;align-items:center;justify-content:center;}
.lb-stage img,.lb-stage video{max-width:90vw;max-height:82vh;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5);background:#000;}
.lb-close{position:absolute;top:20px;right:24px;z-index:3;width:46px;height:46px;border-radius:50%;background:rgba(255,255,255,.12);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,color .2s;}
.lb-close:hover{background:var(--secondary-fixed);color:var(--primary);}
.lb-close .material-symbols-outlined{font-size:26px;}
.lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:52px;height:52px;border-radius:50%;background:rgba(255,255,255,.12);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,color .2s;z-index:3;}
.lb-nav:hover{background:var(--secondary-fixed);color:var(--primary);}
.lb-nav .material-symbols-outlined{font-size:30px;}
.lb-prev{left:24px;}
.lb-next{right:24px;}
.lb-counter{position:absolute;bottom:22px;left:50%;transform:translateX(-50%);z-index:3;color:#fff;font-family:var(--font-sans);font-size:14px;font-weight:600;letter-spacing:.05em;background:rgba(0,0,0,.35);padding:6px 16px;border-radius:9999px;}

@media(min-width:768px){
  .media-grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:600px){
  .lb-prev{left:10px;}.lb-next{right:10px;}
  .lb-nav{width:44px;height:44px;}
}
</style>
</head>
<body>
<!-- Top Navigation Bar -->
<nav class="site-nav">
<div class="container nav-inner">
<div class="nav-brand">
<a href="index.html" class="brand-link">
<img src="logo/horizontal-logo.png" alt="Myra Global School" class="brand-logo" onerror="this.style.display='none';this.nextElementSibling.style.display='inline';"/>
<span class="brand-name" style="display:none">Myra Global School</span>
</a>
</div>
<div class="nav-menu">
<a class="nav-link" href="index.html">Home</a>
<div class="nav-item">
<a class="nav-link nav-link--caret" href="about.html">About
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="about.html#mission">Mission</a>
<a class="dropdown-link" href="about.html#vision">Vision</a>
</div>
</div>
</div>
<div class="nav-item">
<a class="nav-link nav-link--caret" href="academics.html">Academics
<span class="material-symbols-outlined nav-caret">expand_more</span></a>
<div class="nav-dropdown">
<div class="nav-dropdown-inner">
<a class="dropdown-link" href="curriculum.html">Curriculum</a>
<a class="dropdown-link" href="examinations.html">Examinations</a>
<a class="dropdown-link" href="facilities.html">Facilities</a>
<a class="dropdown-link" href="rules.html">Rules &amp; Regulations</a>
</div>
</div>
</div>
<a class="nav-link" href="admission.html">Admissions</a>
<a class="nav-link" href="notice.html">Notice</a>
<a class="nav-link nav-link--active" href="gallery.html">Gallery</a>
</div>
<div class="nav-actions">
<button class="nav-btn nav-btn--outline">Portal Login</button>
<button class="nav-btn nav-btn--solid">Apply Now</button>
</div>
</div>
</nav>

<!-- Page Banner -->
<header class="page-banner">
<div class="container">
<div class="breadcrumb">
<a href="index.html">Home</a>
<span class="material-symbols-outlined">chevron_right</span>
<a href="gallery.html">Gallery</a>
<span class="material-symbols-outlined">chevron_right</span>
<span class="breadcrumb-current">Annual Day Celebration</span>
</div>
</div>
</header>

<!-- ALBUM HEADER -->
<section class="album-hero">
<div class="container">
<a class="album-back" href="gallery.html"><span class="material-symbols-outlined">arrow_back</span> Back to Gallery</a>
<span class="eyebrow">Photo &amp; Video Album</span>
<h1 class="heading-lg">Annual Day Celebration</h1>
<div class="album-meta">
<span class="album-meta-item"><span class="material-symbols-outlined">calendar_today</span> December 2024</span>
<span class="album-meta-item"><span class="material-symbols-outlined">photo_library</span> 9 Photos</span>
<span class="album-meta-item"><span class="material-symbols-outlined">videocam</span> 3 Videos</span>
<span class="album-meta-item"><span class="material-symbols-outlined">location_on</span> Main Auditorium</span>
</div>
<p class="album-lead">A dazzling evening of music, dance and drama as students, teachers and parents came together to celebrate a year of achievement and togetherness.</p>
</div>
</section>

<!-- MEDIA GRID -->
<section class="album-media">
<div class="container">
<div class="media-grid" id="mediaGrid">

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA">
<img alt="Annual Day photo 1" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew">
<img alt="Annual Day photo 2" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media media--video" data-type="video" data-src="assets/videos/hero.mp4">
<img alt="Annual Day highlights video" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q"/>
<span class="media-badge"><span class="material-symbols-outlined">videocam</span> Video</span>
<div class="media-overlay"><span class="play-circle"><span class="material-symbols-outlined">play_arrow</span></span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida/AP1WRLvj2juMHe6Ny1Drz8c5bleO9fp0KfpZtEsdRb8dV9gJQHYn7VM5hdyFS8ogfM_BnBHoew1ubfI-j1pyDVBTU4WSfR6SWpbl44-9NiSAPmFrk1yZRpGYCsZFizVlznlE9WiX7U3zbpWDkc7PcUUElVs97VZ7H4C49cUTtUri1ZOUTea6aDCksnljY-O0PjMziusbGqNDYISAGi13nq8XdaJF3_HG6suvYxrrOEQAwYsf5UYVcaTmV5R380A">
<img alt="Annual Day photo 3" src="https://lh3.googleusercontent.com/aida/AP1WRLvj2juMHe6Ny1Drz8c5bleO9fp0KfpZtEsdRb8dV9gJQHYn7VM5hdyFS8ogfM_BnBHoew1ubfI-j1pyDVBTU4WSfR6SWpbl44-9NiSAPmFrk1yZRpGYCsZFizVlznlE9WiX7U3zbpWDkc7PcUUElVs97VZ7H4C49cUTtUri1ZOUTea6aDCksnljY-O0PjMziusbGqNDYISAGi13nq8XdaJF3_HG6suvYxrrOEQAwYsf5UYVcaTmV5R380A"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEzSG6mdfW96059TNF1M1hivs6iTXZAr-vLQoKEhcbEjF7aiMXFuPqDTvOOwnwLS14mX2a0qvy96Ziym73h1CwNdqUiJhEMUvC9pvHakyvlukSDnE8A732JP02zde5D3fabGIIhHLU983zv_Nff4n-XdZunzIQpJgvpKuyNUFGokxj4o-ESTmvvx0uEslQ8cYhdbSpa2e-eovTg7Lb7XhXzR3KlgSVgFjYvnt0_mUO2F3494VEtD2g1g">
<img alt="Annual Day photo 4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEzSG6mdfW96059TNF1M1hivs6iTXZAr-vLQoKEhcbEjF7aiMXFuPqDTvOOwnwLS14mX2a0qvy96Ziym73h1CwNdqUiJhEMUvC9pvHakyvlukSDnE8A732JP02zde5D3fabGIIhHLU983zv_Nff4n-XdZunzIQpJgvpKuyNUFGokxj4o-ESTmvvx0uEslQ8cYhdbSpa2e-eovTg7Lb7XhXzR3KlgSVgFjYvnt0_mUO2F3494VEtD2g1g"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media media--video" data-type="video" data-src="assets/videos/hero.mp4">
<img alt="Cultural performance video" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA"/>
<span class="media-badge"><span class="material-symbols-outlined">videocam</span> Video</span>
<div class="media-overlay"><span class="play-circle"><span class="material-symbols-outlined">play_arrow</span></span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew">
<img alt="Annual Day photo 5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZVCivML_bItmWzbD5J65HYfCDYnBmHh0oaMBmpOgSRv1ecKJckbpXjmsrSiw07faGmYD7qTgoCy-sWRoG57OPDTCgSS61kw0w0TkUIdqoloksfWuLo88U9MjKZ20w_Jgly9qwtTFiLgSaRh6wPkimPdS6Cy_FM5JP1IO8fNtvfqPfAm63tU93PC_S5QKLUKcJ1TYCp0zpAUR6eB-L6XwfhRrBZCQd0XT1IKKkdJGi-wKRTC6tRQqew"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q">
<img alt="Annual Day photo 6" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media media--video" data-type="video" data-src="assets/videos/hero.mp4">
<img alt="Prize distribution video" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEzSG6mdfW96059TNF1M1hivs6iTXZAr-vLQoKEhcbEjF7aiMXFuPqDTvOOwnwLS14mX2a0qvy96Ziym73h1CwNdqUiJhEMUvC9pvHakyvlukSDnE8A732JP02zde5D3fabGIIhHLU983zv_Nff4n-XdZunzIQpJgvpKuyNUFGokxj4o-ESTmvvx0uEslQ8cYhdbSpa2e-eovTg7Lb7XhXzR3KlgSVgFjYvnt0_mUO2F3494VEtD2g1g"/>
<span class="media-badge"><span class="material-symbols-outlined">videocam</span> Video</span>
<div class="media-overlay"><span class="play-circle"><span class="material-symbols-outlined">play_arrow</span></span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida/AP1WRLvj2juMHe6Ny1Drz8c5bleO9fp0KfpZtEsdRb8dV9gJQHYn7VM5hdyFS8ogfM_BnBHoew1ubfI-j1pyDVBTU4WSfR6SWpbl44-9NiSAPmFrk1yZRpGYCsZFizVlznlE9WiX7U3zbpWDkc7PcUUElVs97VZ7H4C49cUTtUri1ZOUTea6aDCksnljY-O0PjMziusbGqNDYISAGi13nq8XdaJF3_HG6suvYxrrOEQAwYsf5UYVcaTmV5R380A">
<img alt="Annual Day photo 7" src="https://lh3.googleusercontent.com/aida/AP1WRLvj2juMHe6Ny1Drz8c5bleO9fp0KfpZtEsdRb8dV9gJQHYn7VM5hdyFS8ogfM_BnBHoew1ubfI-j1pyDVBTU4WSfR6SWpbl44-9NiSAPmFrk1yZRpGYCsZFizVlznlE9WiX7U3zbpWDkc7PcUUElVs97VZ7H4C49cUTtUri1ZOUTea6aDCksnljY-O0PjMziusbGqNDYISAGi13nq8XdaJF3_HG6suvYxrrOEQAwYsf5UYVcaTmV5R380A"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA">
<img alt="Annual Day photo 8" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxFf1iR-fZ3ARbf0Jb1PNjorBa8cpgPVL-w_P4OsAfjXdIb8A1E_x95gl_w2j4vW9grj2ypkMgh0yCKFxAjESyp2Ucx4NsnBi5XDuP7ix-Up85kKqoPpxUlzKqRnhXlpTJpv56yXLUhsTit3BEJblNQ91Ww4jEBCL6Zs1nHGWbS7_cgkUZ0mEDgqrtnmZRXATqFK9e2mQ2lqRQKsH_bNLLr2t1jZgnqlrKkc1ULfSMa-7V_H-fGR4HA"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

<div class="media" data-type="image" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q">
<img alt="Annual Day photo 9" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrAUxLGmK3HTZovHjtQNhyL7wUTcT2jRJ96hODtSIBdo8qX0rVDZxVC80sgUH-7rXb6ST-Qwiwun7ss1-lEEY3GyrCE5hTzOwdYmmM0FdKq2XxQogHlgw_VzqsZ-cOleFWCWBPHyxMhuWz33G967YtwYfeBdKsHdkp25A7OJUvaoxIIHqemZRxxk9SFsNfNvgvPRH6WV9r-jdaAboWc0m9FNQ7HHNZtY5Cnx7dSqzddmLBjWAFw6dn4Q"/>
<div class="media-overlay"><span class="material-symbols-outlined">zoom_in</span></div>
</div>

</div>
</div>
</section>

<!-- Media Viewer (slideshow + player) -->
<div class="lightbox" id="lightbox">
<button class="lb-close" id="lbClose" aria-label="Close"><span class="material-symbols-outlined">close</span></button>
<button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous"><span class="material-symbols-outlined">chevron_left</span></button>
<div class="lb-stage" id="lbStage"></div>
<button class="lb-nav lb-next" id="lbNext" aria-label="Next"><span class="material-symbols-outlined">chevron_right</span></button>
<div class="lb-counter" id="lbCounter">1 / 12</div>
</div>

<!-- Footer -->
<?php include 'components/footer.php';?>
</body></html>
