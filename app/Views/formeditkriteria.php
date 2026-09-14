<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-xl-6">
        <form action="<?= site_url('criteria/' . esc($criterion->id, 'url') . '/update') ?>" method="post" novalidate>
          <?= csrf_field() ?>
          <div class="card">
            <div class="card-header"><h2 class="card-title">Informasi Kriteria</h2></div>
            <div class="card-body">
              <div class="form-group">
                <label for="field-kriteria">Kode Kriteria</label>
                <input type="text" class="form-control" id="field-kriteria" value="<?= esc($criterion->kriteria) ?>" readonly aria-describedby="kriteria-help">
                <small class="form-text" id="kriteria-help">Kode tidak dapat diubah karena dipakai di matriks penilaian.</small>
              </div>
              <?= view('partials/criteria_fields', ['types' => $types, 'criterion' => $criterion]) ?>
            </div>
            <div class="card-footer form-actions">
              <a href="<?= site_url('criteria') ?>" class="btn btn-default">Batal</a>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save" aria-hidden="true"></i> Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
