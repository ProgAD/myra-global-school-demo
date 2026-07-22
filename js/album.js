/* ============================================================
   Album media viewer — image slideshow + video player.
   Click any tile to open; browse with prev/next arrows,
   arrow keys, Esc to close. Videos play with native controls.
   ============================================================ */
(function () {
  function init() {
    var grid = document.getElementById('mediaGrid');
    var lb = document.getElementById('lightbox');
    if (!grid || !lb) return;

    var stage = document.getElementById('lbStage');
    var counter = document.getElementById('lbCounter');
    var btnClose = document.getElementById('lbClose');
    var btnPrev = document.getElementById('lbPrev');
    var btnNext = document.getElementById('lbNext');

    var tiles = Array.prototype.slice.call(grid.querySelectorAll('.media'));

    // Build the media list from the grid
    var items = tiles.map(function (el) {
      var img = el.querySelector('img');
      return {
        type: el.getAttribute('data-type') || 'image',
        src: el.getAttribute('data-src') || (img ? img.getAttribute('src') : ''),
        alt: img ? img.getAttribute('alt') : ''
      };
    });

    var current = 0;

    function stopVideo() {
      var v = stage.querySelector('video');
      if (v) { try { v.pause(); } catch (e) {} }
    }

    function render(index) {
      current = (index + items.length) % items.length;
      var it = items[current];
      stage.innerHTML = '';
      var node;
      if (it.type === 'video') {
        node = document.createElement('video');
        node.src = it.src;
        node.controls = true;
        node.autoplay = true;
        node.setAttribute('playsinline', '');
      } else {
        node = document.createElement('img');
        node.src = it.src;
        node.alt = it.alt || '';
      }
      stage.appendChild(node);
      if (counter) counter.textContent = (current + 1) + ' / ' + items.length;
    }

    function open(index) {
      render(index);
      lb.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function close() {
      stopVideo();
      lb.classList.remove('open');
      stage.innerHTML = '';
      document.body.style.overflow = '';
    }
    function next() { stopVideo(); render(current + 1); }
    function prev() { stopVideo(); render(current - 1); }

    tiles.forEach(function (el, i) {
      el.addEventListener('click', function () { open(i); });
    });

    if (btnClose) btnClose.addEventListener('click', close);
    if (btnNext) btnNext.addEventListener('click', function (e) { e.stopPropagation(); next(); });
    if (btnPrev) btnPrev.addEventListener('click', function (e) { e.stopPropagation(); prev(); });

    // click the dark backdrop (not the media / controls) to close
    lb.addEventListener('click', function (e) { if (e.target === lb) close(); });

    document.addEventListener('keydown', function (e) {
      if (!lb.classList.contains('open')) return;
      if (e.key === 'Escape') close();
      else if (e.key === 'ArrowRight') next();
      else if (e.key === 'ArrowLeft') prev();
    });

    // Footer link micro-interaction (kept here so this page needs no inline JS)
    document.querySelectorAll('footer a').forEach(function (link) {
      link.addEventListener('mouseenter', function () { link.style.transform = 'translateX(4px)'; });
      link.addEventListener('mouseleave', function () { link.style.transform = 'translateX(0)'; });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
