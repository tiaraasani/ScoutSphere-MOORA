<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Matriks</h3>
        </div>

        <form action="<?= site_url('datamatriks/simpanmatriks'); ?>" method="POST">
          <div class="card-body">
            <!-- Dropdown untuk memilih Peserta -->
            <div class="form-group">
              <label for="kode_peserta">Kode Peserta</label>
              <select class="form-control" name="kode_peserta" id="kode_peserta" required>
                <option value="">-- Pilih Peserta --</option>
                <?php foreach ($alternatif as $row): ?>
                  <option value="<?= $row->id; ?>">
                    <?= $row->kode . ' - ' . $row->nama; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Input Nilai Matriks untuk Setiap Kriteria -->
            <div class="form-group">
              <label>Nilai Matriks</label>
              <?php foreach ($kriteria as $krit): ?>
                <div class="mb-3">
                  <label for="C<?= $krit->id; ?>" class="form-label">
                    <?= $krit->kriteria; ?> (<?= ucfirst($krit->jenis); ?>)
                  </label>
                  <input type="number" name="C<?= $krit->id; ?>"
                         id="C<?= $krit->id; ?>"
                         class="form-control"
                         placeholder="Nilai untuk <?= $krit->kriteria; ?>"
                         required>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="card-footer">
            <center>
              <button type="submit" class="btn btn-primary">Submit</button>
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
