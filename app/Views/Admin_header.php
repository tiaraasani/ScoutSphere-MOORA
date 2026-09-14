<?php
// Layout: document head and top bar. Expects optional $pageTitle from the controller.
$pageTitle = $pageTitle ?? 'Dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($pageTitle) ?> | ScoutSphere</title>
  <base href="<?= base_url('assets') ?>/">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@500;600;700&family=Source+Sans+3:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="css/app.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<a class="skip-link" href="#main-content">Langsung ke konten utama</a>
<div class="wrapper">

  <!-- Top bar -->
  <nav class="main-header navbar navbar-expand" aria-label="Bilah atas">
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Buka atau tutup menu samping">
          <i class="fas fa-bars" aria-hidden="true"></i>
        </a>
      </li>
      <li class="nav-item pl-2">
        <span class="topbar-title"><?= esc($pageTitle) ?></span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto align-items-center">
      <li class="nav-item">
        <form action="<?= site_url('logout') ?>" method="post" class="d-inline">
          <?= csrf_field() ?>
          <button type="submit" class="btn btn-sm btn-logout">
            <i class="fas fa-sign-out-alt" aria-hidden="true"></i> Keluar
          </button>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.top bar -->
