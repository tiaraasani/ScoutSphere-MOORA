<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-xl-6">
        <form action="<?= site_url('criteria') ?>" method="post" novalidate>
          <?= csrf_field() ?>
          <div class="card">
            <div class="card-header"><h2 class="card-title">Informasi Kriteria</h2></div>
            <div class="card-body">
              <div class="form-group">
                <label for="<?= field_id('kriteria') ?>">Kode Kriteria <span class="required-mark" aria-hidden="true">*</span></label>
                <input type="text" class="<?= field_class('kriteria') ?>" id="<?= field_id('kriteria') ?>" name="kriteria"
                       value="<?= esc(old('kriteria', '', false)) ?>" maxlength="10" autocomplete="off" required<?= field_describedby('kriteria') ?>>
                <?= field_feedback('kriteria') ?>
                <small class="form-text">Kode singkat seperti C1, C2. Maksimal 10 karakter.</small>
              </div>
              <?= view('partials/criteria_fields', ['types' => $types]) ?>
            </div>
            <div class="card-footer form-actions">
              <a href="<?= site_url('criteria') ?>" class="btn btn-default">Batal</a>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save" aria-hidden="true"></i> Simpan Kriteria</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
