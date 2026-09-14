<?php
// One numeric input per criterion. Expects $criteria (list<object>) and optional $values (criterion id => value).
$values = $values ?? [];
?>
<fieldset class="mb-0">
  <legend>Nilai per Kriteria</legend>
  <div class="form-grid">
    <?php foreach ($criteria as $criterion): ?>
      <?php $field = 'values.' . $criterion->id ?>
      <?php $isBenefit = $criterion->jenis === 'benefit' ?>
      <div class="form-group mb-0">
        <label for="<?= field_id($field) ?>">
          <code class="kode"><?= esc($criterion->kriteria) ?></code> <?= esc($criterion->nama) ?>
          <span class="badge <?= $isBenefit ? 'badge-benefit' : 'badge-cost' ?> ml-1"><?= $isBenefit ? 'Benefit' : 'Cost' ?></span>
        </label>
        <input type="number" class="<?= field_class($field) ?>" id="<?= field_id($field) ?>"
               name="values[<?= esc($criterion->id) ?>]" step="any" min="0" inputmode="decimal"
               value="<?= esc(old($field, $values[$criterion->id] ?? '', false)) ?>" required<?= field_describedby($field) ?>>
        <?= field_feedback($field) ?>
      </div>
    <?php endforeach ?>
  </div>
</fieldset>
