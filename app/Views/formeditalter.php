<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-xl-6">
        <form action="<?= site_url('alternatives/' . esc($alternative->id, 'url') . '/update') ?>" method="post" novalidate>
          <?= csrf_field() ?>
          <div class="card">
            <div class="card-header"><h2 class="card-title">Informasi Peserta</h2></div>
            <div class="card-body">
              <div class="form-group">
                <label for="field-kode">Kode Peserta</label>
                <input type="text" class="form-control" id="field-kode" value="<?= esc($alternative->kode) ?>" readonly aria-describedby="kode-help">
                <small class="form-text" id="kode-help">Kode tidak dapat diubah karena dipakai sebagai pengenal di matriks penilaian.</small>
              </div>
              <div class="form-group mb-0">
                <label for="<?= field_id('nama') ?>">Nama Peserta <span class="required-mark" aria-hidden="true">*</span></label>
                <input type="text" class="<?= field_class('nama') ?>" id="<?= field_id('nama') ?>" name="nama"
                       value="<?= esc(old('nama', $alternative->nama, false)) ?>" maxlength="100" autocomplete="off" required<?= field_describedby('nama') ?>>
                <?= field_feedback('nama') ?>
              </div>
            </div>
            <div class="card-footer form-actions">
              <a href="<?= site_url('alternatives') ?>" class="btn btn-default">Batal</a>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save" aria-hidden="true"></i> Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
