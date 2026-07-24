/* ============================================================
   Admin panel — shared behaviour
   - sidebar toggle (mobile)
   - generic modal open/close via [data-open="#id"] and [data-close]
   - row delete via [data-del] -> styled confirmation popup, then
     removes closest tr / card and fires an "admin:rowdeleted" event
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

    // Build the shared delete-confirmation modal once and add it to the page
    var confirmModal = document.createElement('div');
    confirmModal.className = 'modal';
    confirmModal.id = 'confirmModal';
    confirmModal.innerHTML =
      '<div class="modal-box" style="max-width:400px">' +
        '<div class="modal-head"><h3>Confirm Delete</h3>' +
          '<button class="modal-close" data-close><span class="material-symbols-outlined">close</span></button></div>' +
        '<div class="modal-body" style="text-align:center">' +
          '<span class="material-symbols-outlined" style="font-size:46px;color:var(--red)">warning</span>' +
          '<p id="confirmMsg" style="margin-top:10px">Are you sure you want to delete this item? This action cannot be undone.</p>' +
        '</div>' +
        '<div class="modal-foot">' +
          '<button class="btn btn-ghost" data-close>Cancel</button>' +
          '<button class="btn btn-danger" id="confirmDeleteBtn"><span class="material-symbols-outlined">delete</span> Delete</button>' +
        '</div>' +
      '</div>';
    document.body.appendChild(confirmModal);

    // Generic modal open buttons: [data-open="#modalId"]
    document.querySelectorAll('[data-open]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var m = document.querySelector(btn.getAttribute('data-open'));
        if (m) m.classList.add('open');
      });
    });
    // Close: [data-close] inside a .modal, or clicking backdrop
    // (confirmModal is already in the DOM, so it is covered here too)
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

    // Row / card delete -> confirm via popup
    var pendingRow = null;
    document.addEventListener('click', function (e) {
      var del = e.target.closest && e.target.closest('[data-del]');
      if (!del) return;
      e.preventDefault();
      pendingRow = del.closest('tr') || del.closest('[data-item]');
      if (!pendingRow) return;
      // Optional custom message via data-del="Delete this notice?"
      var msg = del.getAttribute('data-del');
      document.getElementById('confirmMsg').textContent =
        (msg && msg.length > 1) ? msg : 'Are you sure you want to delete this item? This action cannot be undone.';
      confirmModal.classList.add('open');
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
      if (pendingRow) {
        var row = pendingRow;
        pendingRow = null;
        row.remove();
        // let pages update counts / pagination (detail.row carries the removed
        // element so DB-backed pages can read its data-id and call their API)
        document.dispatchEvent(new CustomEvent('admin:rowdeleted', { detail: { row: row } }));
      }
      confirmModal.classList.remove('open');
    });
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
