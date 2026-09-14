<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 col-xl-8">
        <form action="<?= site_url('matrix/' . esc($alternative->id, 'url') . '/update') ?>" method="post" novalidate>
          <?= csrf_field() ?>
          <div class="card">
            <div class="card-header"><h2 class="card-title">Penilaian Peserta</h2></div>
            <div class="card-body">
              <div class="form-group">
                <label for="field-alternative">Peserta</label>
                <input type="text" class="form-control" id="field-alternative"
                       value="<?= esc($alternative->kode . ' - ' . $alternative->nama) ?>" readonly>
              </div>
              <?= view('partials/matrix_value_fields', ['criteria' => $criteria, 'values' => $values]) ?>
            </div>
            <div class="card-footer form-actions">
              <a href="<?= site_url('matrix') ?>" class="btn btn-default">Batal</a>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save" aria-hidden="true"></i> Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
