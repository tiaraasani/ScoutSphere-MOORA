<?php
// Flash messages set by controllers: success, error, or validation errors keyed by field.
$success = session()->getFlashdata('success');
$error   = session()->getFlashdata('error');
$errors  = session()->getFlashdata('errors');
$errors  = is_array($errors) ? $errors : [];
?>
<?php if ($success !== null): ?>
  <div class="alert alert-success alert-dismissible fade show" role="status" data-autodismiss>
    <i class="fas fa-check-circle alert-icon" aria-hidden="true"></i>
    <div class="alert-body"><?= esc($success) ?></div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup pesan">&times;</button>
  </div>
<?php endif ?>

<?php if ($error !== null): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle alert-icon" aria-hidden="true"></i>
    <div class="alert-body"><?= esc($error) ?></div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup pesan">&times;</button>
  </div>
<?php endif ?>

<?php if ($errors !== []): ?>
  <div class="alert alert-danger" role="alert" id="error-summary" tabindex="-1">
    <i class="fas fa-exclamation-circle alert-icon" aria-hidden="true"></i>
    <div class="alert-body">
      <p class="mb-1"><strong>Data belum bisa disimpan.</strong> Periksa kembali isian berikut:</p>
      <ul class="mb-0 pl-3">
        <?php foreach ($errors as $field => $message): ?>
          <li><a href="#<?= esc(field_id((string) $field)) ?>"><?= esc($message) ?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
<?php endif ?>
