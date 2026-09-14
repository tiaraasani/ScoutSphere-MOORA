/**
 * ScoutSphere UI behaviour.
 *
 * - Confirmation dialogs for destructive forms (data-confirm).
 * - Show/hide toggle for password fields (data-toggle-password).
 * - Auto-dismiss success alerts after a short delay.
 * - Moves keyboard focus to the first invalid field after a failed submit.
 */
(function () {
  'use strict';

  document.addEventListener('submit', function (event) {
    var form = event.target;
    if (form.matches('[data-confirm]') && !window.confirm(form.getAttribute('data-confirm'))) {
      event.preventDefault();
    }
  });

  document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
    var input = document.getElementById(button.getAttribute('data-toggle-password'));
    if (!input) {
      return;
    }
    button.addEventListener('click', function () {
      var visible = input.type === 'text';
      input.type = visible ? 'password' : 'text';
      button.setAttribute('aria-pressed', String(!visible));
      button.setAttribute('aria-label', visible ? 'Tampilkan password' : 'Sembunyikan password');
      button.querySelector('.fas').className = visible ? 'fas fa-eye' : 'fas fa-eye-slash';
    });
  });

  document.querySelectorAll('.alert-success[data-autodismiss]').forEach(function (alert) {
    window.setTimeout(function () {
      alert.classList.add('fade');
      alert.classList.remove('show');
      window.setTimeout(function () { alert.remove(); }, 200);
    }, 5000);
  });

  var summary = document.getElementById('error-summary');
  var firstInvalid = document.querySelector('.is-invalid');
  if (summary) {
    summary.focus();
  } else if (firstInvalid) {
    firstInvalid.focus();
  }
})();
