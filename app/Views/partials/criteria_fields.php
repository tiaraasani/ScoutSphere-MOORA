<?php
// Shared fields for the criteria create/edit forms.
// Expects $types (list<string>) and optional $criterion (object) for edit mode.
$criterion    = $criterion ?? null;
$selectedType = old('jenis', $criterion->jenis ?? '', false);
$typeHints    = [
    'benefit' => 'Nilai lebih tinggi lebih baik, misalnya prestasi atau keaktifan.',
    'cost'    => 'Nilai lebih rendah lebih baik, misalnya jumlah pelanggaran.',
];
?>
<div class="form-group">
  <label for="<?= field_id('nama') ?>">Nama Kriteria <span class="required-mark" aria-hidden="true">*</span></label>
  <input type="text" class="<?= field_class('nama') ?>" id="<?= field_id('nama') ?>" name="nama"
         value="<?= esc(old('nama', $criterion->nama ?? '', false)) ?>" maxlength="100" autocomplete="off" required<?= field_describedby('nama') ?>>
  <?= field_feedback('nama') ?>
</div>

<div class="form-group">
  <label for="<?= field_id('bobot') ?>">Bobot <span class="required-mark" aria-hidden="true">*</span></label>
  <input type="number" class="<?= field_class('bobot') ?>" id="<?= field_id('bobot') ?>" name="bobot" step="any" min="0" inputmode="decimal"
         value="<?= esc(old('bobot', $criterion->bobot ?? '', false)) ?>" required<?= field_describedby('bobot') ?>>
  <?= field_feedback('bobot') ?>
  <small class="form-text">Tingkat kepentingan kriteria, misalnya 0.35. Total bobot semua kriteria sebaiknya 1.</small>
</div>

<fieldset class="form-group mb-0">
  <legend>Jenis Kriteria <span class="required-mark" aria-hidden="true">*</span></legend>
  <?php foreach ($types as $type): ?>
    <div class="custom-control custom-radio mb-2">
      <input type="radio" class="custom-control-input<?= field_error('jenis') !== null ? ' is-invalid' : '' ?>"
             id="<?= field_id('jenis') ?>-<?= esc($type) ?>" name="jenis" value="<?= esc($type) ?>"
             <?= $selectedType === $type ? 'checked' : '' ?> required>
      <label class="custom-control-label" for="<?= field_id('jenis') ?>-<?= esc($type) ?>">
        <strong><?= esc(ucfirst($type)) ?></strong>
        <span class="d-block text-muted small"><?= esc($typeHints[$type] ?? '') ?></span>
      </label>
    </div>
  <?php endforeach ?>
  <?= field_feedback('jenis') ?>
</fieldset>
