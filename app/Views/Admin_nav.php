<?php
// Layout: sidebar navigation and page header.
// Expects optional $pageTitle, $pageSubtitle and $breadcrumbs (label => url|null).
$pageTitle    = $pageTitle ?? 'Dashboard';
$pageSubtitle = $pageSubtitle ?? null;
$breadcrumbs  = $breadcrumbs ?? [];
$username     = (string) (session()->get('username') ?? 'admin');
$initials     = mb_strtoupper(mb_substr($username, 0, 2));

$menu = [
    'Utama' => [
        ['label' => 'Dashboard', 'url' => '/', 'icon' => 'fa-home', 'match' => '/'],
    ],
    'Master Data' => [
        ['label' => 'Data Peserta', 'url' => 'alternatives', 'icon' => 'fa-users', 'match' => 'alternatives*'],
        ['label' => 'Data Kriteria', 'url' => 'criteria', 'icon' => 'fa-sliders-h', 'match' => 'criteria*'],
        ['label' => 'Matriks Penilaian', 'url' => 'matrix', 'icon' => 'fa-table', 'match' => 'matrix*'],
    ],
    'Perhitungan MOORA' => [
        ['label' => 'Normalisasi', 'url' => 'results/normalization', 'icon' => 'fa-calculator', 'match' => 'results/normalization'],
        ['label' => 'Normalisasi Berbobot', 'url' => 'results/weighted', 'icon' => 'fa-balance-scale', 'match' => 'results/weighted'],
        ['label' => 'Hasil Optimasi', 'url' => 'results/optimization', 'icon' => 'fa-chart-line', 'match' => 'results/optimization'],
        ['label' => 'Hasil Keputusan', 'url' => 'results/decision', 'icon' => 'fa-trophy', 'match' => 'results/decision'],
    ],
];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= site_url('/') ?>" class="brand-link">
    <span class="brand-mark" aria-hidden="true"><i class="fas fa-campground"></i></span>
    <span class="brand-text">ScoutSphere<small>Pandega Berprestasi</small></span>
  </a>

  <div class="sidebar">
    <nav aria-label="Menu utama">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <?php foreach ($menu as $section => $items): ?>
          <li class="nav-section-label" aria-hidden="true"><?= esc($section) ?></li>
          <?php foreach ($items as $item): ?>
            <?php $active = url_is($item['match']) ?>
            <li class="nav-item">
              <a href="<?= site_url($item['url']) ?>" class="nav-link <?= $active ? 'active' : '' ?>" <?= $active ? 'aria-current="page"' : '' ?>>
                <i class="nav-icon fas <?= esc($item['icon']) ?>" aria-hidden="true"></i>
                <p><?= esc($item['label']) ?></p>
              </a>
            </li>
          <?php endforeach ?>
        <?php endforeach ?>
      </ul>
    </nav>

    <div class="sidebar-footer">
      <span class="avatar" aria-hidden="true"><?= esc($initials) ?></span>
      <div>
        <div class="name"><?= esc($username) ?></div>
        <div class="role">Administrator</div>
      </div>
    </div>
  </div>
</aside>

<div class="content-wrapper">
  <main id="main-content" tabindex="-1">
    <div class="content-header">
      <div class="container-fluid">
        <div class="page-header">
          <nav aria-label="Breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Dashboard</a></li>
              <?php $lastLabel = array_key_last($breadcrumbs) ?>
              <?php foreach ($breadcrumbs as $label => $url): ?>
                <?php if ($label === $lastLabel): ?>
                  <li class="breadcrumb-item active" aria-current="page"><?= esc($label) ?></li>
                <?php elseif ($url === null): ?>
                  <li class="breadcrumb-item"><?= esc($label) ?></li>
                <?php else: ?>
                  <li class="breadcrumb-item"><a href="<?= site_url($url) ?>"><?= esc($label) ?></a></li>
                <?php endif ?>
              <?php endforeach ?>
            </ol>
          </nav>
          <h1 class="page-title"><?= esc($pageTitle) ?></h1>
          <?php if ($pageSubtitle !== null): ?>
            <p class="page-subtitle"><?= esc($pageSubtitle) ?></p>
          <?php endif ?>
        </div>
        <?= view('partials/alerts') ?>
      </div>
    </div>
