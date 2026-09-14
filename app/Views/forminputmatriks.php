<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 col-xl-8">
        <form action="<?= site_url('matrix') ?>" method="post" novalidate>
          <?= csrf_field() ?>
          <div class="card">
            <div class="card-header"><h2 class="card-title">Penilaian Peserta</h2></div>
            <div class="card-body">
              <?php if ($criteria === []): ?>
                <div class="step-note">
                  <i class="fas fa-info-circle" aria-hidden="true"></i>
                  <p>Belum ada kriteria. <a href="<?= site_url('criteria/create') ?>">Tambahkan kriteria</a> terlebih dahulu sebelum mengisi matriks.</p>
                </div>
              <?php endif ?>
              <div class="form-group">
                <label for="<?= field_id('alternative_id') ?>">Peserta <span class="required-mark" aria-hidden="true">*</span></label>
                <select class="<?= field_class('alternative_id', 'custom-select') ?>" id="<?= field_id('alternative_id') ?>" name="alternative_id" required<?= field_describedby('alternative_id') ?>>
                  <option value="">Pilih peserta</option>
                  <?php foreach ($alternatives as $alternative): ?>
                    <option value="<?= esc($alternative->id) ?>" <?= (string) old('alternative_id') === (string) $alternative->id ? 'selected' : '' ?>>
                      <?= esc($alternative->kode . ' - ' . $alternative->nama) ?>
                    </option>
                  <?php endforeach ?>
                </select>
                <?= field_feedback('alternative_id') ?>
                <small class="form-text">Peserta yang sudah punya penilaian tidak bisa ditambah lagi, gunakan menu Edit di daftar matriks.</small>
              </div>
              <?= view('partials/matrix_value_fields', ['criteria' => $criteria]) ?>
            </div>
            <div class="card-footer form-actions">
              <a href="<?= site_url('matrix') ?>" class="btn btn-default">Batal</a>
              <button type="submit" class="btn btn-primary" <?= $criteria === [] ? 'disabled' : '' ?>><i class="fas fa-save" aria-hidden="true"></i> Simpan Penilaian</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
