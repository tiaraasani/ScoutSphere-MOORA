<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk | ScoutSphere</title>
  <base href="<?= base_url('assets') ?>/">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@500;600;700&family=Source+Sans+3:wght@400;600;700&display=swap">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="css/app.css">
</head>
<body>
<div class="auth-page">
  <section class="auth-brand" aria-label="Tentang aplikasi">
    <div>
      <span class="brand-mark" aria-hidden="true"><i class="fas fa-campground"></i></span>
      <div class="brand-text mt-3">ScoutSphere</div>
    </div>
    <div>
      <h1>Pemilihan Pandega Berprestasi</h1>
      <p>Sistem pendukung keputusan Kwartir Daerah Kalimantan Timur dengan metode MOORA untuk menilai peserta secara objektif dan transparan.</p>
    </div>
    <p class="auth-footnote">Akses hanya untuk pengurus yang berwenang.</p>
  </section>

  <main class="auth-form">
    <div class="auth-card">
      <h2>Masuk</h2>
      <p class="auth-lead">Gunakan akun pengurus untuk mengelola data penilaian.</p>

      <?php if (session()->getFlashdata('error') !== null): ?>
        <div class="alert alert-danger" role="alert">
          <i class="fas fa-exclamation-circle alert-icon" aria-hidden="true"></i>
          <div class="alert-body"><?= esc(session()->getFlashdata('error')) ?></div>
        </div>
      <?php endif ?>

      <form action="<?= site_url('login') ?>" method="post" novalidate>
        <?= csrf_field() ?>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username"
                 value="<?= esc(old('username', '', false)) ?>" maxlength="50"
                 autocomplete="username" autocapitalize="none" spellcheck="false" required autofocus>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" name="password"
                   maxlength="255" autocomplete="current-password" required>
            <div class="input-group-append">
              <button type="button" class="btn btn-toggle-password" data-toggle-password="password"
                      aria-label="Tampilkan password" aria-pressed="false">
                <i class="fas fa-eye" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
          <i class="fas fa-sign-in-alt" aria-hidden="true"></i> Masuk
        </button>
      </form>
    </div>
  </main>
</div>
<script src="js/app.js"></script>
</body>
</html>
