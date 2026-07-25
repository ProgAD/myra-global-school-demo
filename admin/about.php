<?php
$page_name = 'about';   // sidebar highlight + topbar heading
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ../login.html'); exit; }
require_once __DIR__ . '/../components/about-data.php';
$about = about_data();
function ap($p){ return '../' . ltrim((string)$p, '/'); }   // admin-relative path
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>About Page | Admin | Myra Global School</title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&amp;family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="admin.css" rel="stylesheet"/>
<style>
.ed-panel{margin-bottom:20px;}
.ed-body{display:grid;grid-template-columns:220px 1fr;gap:26px;padding:22px;}
.ed-photo{display:flex;flex-direction:column;gap:10px;}
.ed-photo img{width:100%;height:180px;object-fit:cover;border-radius:12px;border:1px solid var(--line);background:var(--bg);}
.ed-photo .file-lbl{cursor:pointer;justify-content:center;}
.ed-fields{min-width:0;}
.ed-fields .field:last-child{margin-bottom:0;}
.ed-actions{position:sticky;bottom:0;display:flex;justify-content:flex-end;gap:12px;padding:16px 0;background:linear-gradient(transparent,var(--bg) 40%);}
.ed-alert{display:none;align-items:center;gap:10px;font-weight:600;font-size:14px;padding:13px 16px;border-radius:10px;margin-bottom:16px;}
.ed-alert.show{display:flex;}
.ed-alert.ok{background:var(--green-bg);color:var(--green);border:1px solid #b6e4cb;}
.ed-alert.err{background:var(--red-bg);color:var(--red);border:1px solid #f3c9c9;}
.ed-alert .material-symbols-outlined{font-size:20px;}
.ed-hint{color:var(--muted);font-size:12px;margin-top:6px;}
@media(max-width:640px){ .ed-body{grid-template-columns:1fr;} }
</style>
<script src="admin.js" defer></script>
</head>
<body>
<div class="admin">
<?php include '../components/admin-sidebar.php'; ?>
<div class="main">
<?php include '../components/admin-topbar.php'; ?>

<div class="content">
<div class="page-head">
<div>
<h2>About Page</h2>
<p>Edit the content and photos shown on the public About page.</p>
</div>
<a class="btn btn-ghost" href="../about.php" target="_blank" rel="noopener"><span class="material-symbols-outlined">open_in_new</span> View live page</a>
</div>

<div class="ed-alert ok" id="okBox"><span class="material-symbols-outlined">check_circle</span><span id="okMsg"></span></div>
<div class="ed-alert err" id="errBox"><span class="material-symbols-outlined">error</span><span id="errMsg"></span></div>

<form id="aboutForm" enctype="multipart/form-data">

<!-- Principal -->
<div class="panel ed-panel">
<div class="panel-head"><h3>Principal's Message</h3></div>
<div class="ed-body">
<div class="ed-photo">
<img id="prevPrincipal" src="<?= htmlspecialchars(ap($about['principal']['photo'])) ?>" alt="Principal photo"/>
<label class="btn btn-ghost btn-sm file-lbl"><span class="material-symbols-outlined">upload</span> Change photo
<input type="file" name="principal_photo" accept=".jpg,.jpeg,.png,.webp" data-prev="prevPrincipal" hidden/></label>
<span class="ed-hint">JPG, PNG or WEBP · max 3 MB</span>
</div>
<div class="ed-fields">
<div class="field"><label>Message</label><textarea class="finput" name="principal_message" rows="4"><?= htmlspecialchars($about['principal']['message']) ?></textarea></div>
<div class="field"><label>Supporting line</label><textarea class="finput" name="principal_sub" rows="3"><?= htmlspecialchars($about['principal']['sub']) ?></textarea></div>
</div>
</div>
</div>

<!-- Vice Principal -->
<div class="panel ed-panel">
<div class="panel-head"><h3>Vice Principal's Message</h3></div>
<div class="ed-body">
<div class="ed-photo">
<img id="prevVice" src="<?= htmlspecialchars(ap($about['vice']['photo'])) ?>" alt="Vice Principal photo"/>
<label class="btn btn-ghost btn-sm file-lbl"><span class="material-symbols-outlined">upload</span> Change photo
<input type="file" name="vice_photo" accept=".jpg,.jpeg,.png,.webp" data-prev="prevVice" hidden/></label>
<span class="ed-hint">JPG, PNG or WEBP · max 3 MB</span>
</div>
<div class="ed-fields">
<div class="field"><label>Message</label><textarea class="finput" name="vice_message" rows="4"><?= htmlspecialchars($about['vice']['message']) ?></textarea></div>
<div class="field"><label>Supporting line</label><textarea class="finput" name="vice_sub" rows="3"><?= htmlspecialchars($about['vice']['sub']) ?></textarea></div>
</div>
</div>
</div>

<!-- Team -->
<div class="panel ed-panel">
<div class="panel-head"><h3>Our Team</h3></div>
<div class="ed-body">
<div class="ed-photo">
<img id="prevTeam" src="<?= htmlspecialchars(ap($about['team']['photo'])) ?>" alt="Team photo"/>
<label class="btn btn-ghost btn-sm file-lbl"><span class="material-symbols-outlined">upload</span> Change photo
<input type="file" name="team_photo" accept=".jpg,.jpeg,.png,.webp" data-prev="prevTeam" hidden/></label>
<span class="ed-hint">Group photo · JPG, PNG or WEBP · max 3 MB</span>
</div>
<div class="ed-fields">
<div class="field"><label>Caption title</label><input class="finput" name="team_title" type="text" value="<?= htmlspecialchars($about['team']['captionTitle']) ?>"/></div>
<div class="field"><label>Caption text</label><input class="finput" name="team_text" type="text" value="<?= htmlspecialchars($about['team']['captionText']) ?>"/></div>
</div>
</div>
</div>

<!-- Mission & Vision -->
<div class="panel ed-panel">
<div class="panel-head"><h3>Mission &amp; Vision</h3></div>
<div class="ed-body" style="grid-template-columns:1fr;">
<div class="field-row">
<div class="field"><label>Our Mission</label><textarea class="finput" name="mission" rows="4"><?= htmlspecialchars($about['mission']) ?></textarea></div>
<div class="field"><label>Our Vision</label><textarea class="finput" name="vision" rows="4"><?= htmlspecialchars($about['vision']) ?></textarea></div>
</div>
</div>
</div>

<div class="ed-actions">
<button class="btn btn-primary" id="saveBtn" type="submit"><span class="material-symbols-outlined">save</span> Save changes</button>
</div>

</form>
</div>
</div>
</div>

<script>
(function(){
  var form = document.getElementById('aboutForm');
  var btn  = document.getElementById('saveBtn');
  var okB  = document.getElementById('okBox'), okM = document.getElementById('okMsg');
  var errB = document.getElementById('errBox'), errM = document.getElementById('errMsg');

  /* local preview when a photo is chosen */
  form.querySelectorAll('input[type=file]').forEach(function(inp){
    inp.addEventListener('change', function(){
      var img = document.getElementById(inp.getAttribute('data-prev'));
      if (img && inp.files && inp.files[0]) img.src = URL.createObjectURL(inp.files[0]);
    });
  });

  function alert(box, span, msg){ span.textContent = msg; box.classList.add('show'); box.scrollIntoView({behavior:'smooth', block:'center'}); }
  function clear(){ okB.classList.remove('show'); errB.classList.remove('show'); }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    clear();
    btn.disabled = true;
    var label = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined">progress_activity</span> Saving…';

    fetch('../actions/admin/about/save.php', { method:'POST', body:new FormData(form) })
      .then(function(r){ return r.json().then(function(d){ return {ok:r.ok, d:d}; }); })
      .then(function(res){
        if (res.d && res.d.success){
          alert(okB, okM, res.d.message || 'Saved.');
          // refresh previews to the stored files (cache-busted) & clear file inputs
          var d = res.d.data || {};
          var bust = '?t=' + Date.now();
          if (d.principal) document.getElementById('prevPrincipal').src = '../' + d.principal.photo + bust;
          if (d.vice)      document.getElementById('prevVice').src      = '../' + d.vice.photo + bust;
          if (d.team)      document.getElementById('prevTeam').src      = '../' + d.team.photo + bust;
          form.querySelectorAll('input[type=file]').forEach(function(i){ i.value=''; });
        } else {
          alert(errB, errM, (res.d && res.d.message) || 'Could not save. Please try again.');
        }
      })
      .catch(function(){ alert(errB, errM, 'Could not reach the server. Please try again.'); })
      .finally(function(){ btn.disabled = false; btn.innerHTML = label; });
  });
})();
</script>
</body></html>
