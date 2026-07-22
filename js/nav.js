/* ============================================================
   Responsive navigation — hamburger drawer for tablet & phone.
   Desktop (>=1024px) is untouched (pure CSS hover menu).
   Shared across all pages via <script src="js/nav.js" defer>.
   ============================================================ */
(function () {
  function init() {
    var nav = document.querySelector('.site-nav');
    if (!nav) return;
    var inner = nav.querySelector('.nav-inner');
    var menu = nav.querySelector('.nav-menu');
    var actions = nav.querySelector('.nav-actions');
    if (!inner || !menu) return;

    var MOBILE = 1024; // breakpoint that matches header.css

    // 1) Build the hamburger button
    var burger = document.createElement('button');
    burger.className = 'nav-hamburger';
    burger.setAttribute('aria-label', 'Toggle navigation menu');
    burger.setAttribute('aria-expanded', 'false');
    burger.innerHTML = '<span></span><span></span><span></span>';
    inner.appendChild(burger);

    // 2) Clone the Portal Login / Apply buttons into the drawer
    if (actions) {
      var mobActions = document.createElement('div');
      mobActions.className = 'nav-mobile-actions';
      mobActions.innerHTML = actions.innerHTML;
      menu.appendChild(mobActions);
    }

    function closeMenu() {
      nav.classList.remove('nav-open');
      burger.classList.remove('active');
      burger.setAttribute('aria-expanded', 'false');
    }

    // 3) Toggle the drawer
    burger.addEventListener('click', function () {
      var open = nav.classList.toggle('nav-open');
      burger.classList.toggle('active', open);
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    // 4) Caret taps expand/collapse submenus (mobile only)
    nav.querySelectorAll('.nav-caret').forEach(function (caret) {
      caret.addEventListener('click', function (e) {
        if (window.innerWidth < MOBILE) {
          e.preventDefault();
          e.stopPropagation();
          var item = caret.closest('.nav-item');
          if (item) item.classList.toggle('open');
        }
      });
    });

    // 5) Tapping a normal link closes the drawer
    menu.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        if (window.innerWidth < MOBILE && !a.querySelector('.nav-caret')) {
          closeMenu();
        }
      });
    });

    // 6) Reset everything when resizing up to desktop
    window.addEventListener('resize', function () {
      if (window.innerWidth >= MOBILE) {
        closeMenu();
        nav.querySelectorAll('.nav-item.open').forEach(function (i) {
          i.classList.remove('open');
        });
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
