<?php
// Placeholder shown when a list or calculation has no rows yet.
// Expects: icon (Font Awesome class), title, text, actionUrl, actionLabel.
?>
<div class="empty-state">
  <span class="empty-icon" aria-hidden="true"><i class="fas <?= esc($icon) ?>"></i></span>
  <h3><?= esc($title) ?></h3>
  <p><?= esc($text) ?></p>
  <a href="<?= site_url($actionUrl) ?>" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> <?= esc($actionLabel) ?></a>
</div>
