/* ============================================================
   Admin panel — shared behaviour
   - sidebar toggle (mobile)
   - generic modal open/close via [data-open="#id"] and [data-close]
   - row delete via [data-del] (removes closest tr / card)
   ============================================================ */
(function () {
  function init() {
    // Sidebar drawer (mobile)
    var sb = document.getElementById('sidebar');
    var ov = document.getElementById('overlay');
    var hb = document.getElementById('hamburger');
    function closeNav() { if (sb) sb.classList.remove('open'); if (ov) ov.classList.remove('show'); }
    if (hb) hb.addEventListener('click', function () {
      if (sb) sb.classList.toggle('open');
      if (ov) ov.classList.toggle('show');
    });
    if (ov) ov.addEventListener('click', closeNav);

    // Generic modal open buttons: [data-open="#modalId"]
    document.querySelectorAll('[data-open]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var m = document.querySelector(btn.getAttribute('data-open'));
        if (m) m.classList.add('open');
      });
    });
    // Close: [data-close] inside a .modal, or clicking backdrop
    document.querySelectorAll('.modal').forEach(function (modal) {
      modal.addEventListener('click', function (e) {
        if (e.target === modal || (e.target.closest && e.target.closest('[data-close]'))) {
          modal.classList.remove('open');
        }
      });
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') document.querySelectorAll('.modal.open').forEach(function (m) { m.classList.remove('open'); });
    });

    // Row / card delete
    document.addEventListener('click', function (e) {
      var del = e.target.closest && e.target.closest('[data-del]');
      if (!del) return;
      var row = del.closest('tr') || del.closest('[data-item]');
      if (row && window.confirm('Delete this item? This cannot be undone.')) row.remove();
    });
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
