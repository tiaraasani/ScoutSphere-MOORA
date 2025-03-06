<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0 text-center">Daftar Kriteria</h3>
          </div>
          <div class="card-body">
            <!-- Tombol untuk menambah kriteria -->
            <div class="mb-3 ">
              <a class="btn btn-success btn-sm" href="<?php echo site_url('datakr/forminputkr'); ?>" style="width: 300px;">
                <i class="fas fa-plus-circle"></i> Tambah Kriteria
              </a>
            </div>
            <!-- Tabel Daftar Kriteria -->
            <table class="table table-bordered table-hover table-striped">
              <thead class="bg-light">
                <tr>
                  <th class="text-center" style="width: 5%;">No.</th>
                  <th class="text-center" style="width: 15%;">Kode Kriteria</th>
                  <th class="text-center" style="width: 30%;">Nama Kriteria</th>
                  <th class="text-center" style="width: 15%;">Nilai Kriteria</th>
                  <th class="text-center" style="width: 20%;">Tipe Kriteria</th>
                  <th class="text-center" style="width: 15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;
                foreach ($datakr as $row): $no++ ?>
                  <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td class="text-center"><?= htmlspecialchars($row->kriteria); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row->nama); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row->bobot); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row->jenis); ?></td>
                    <td class="text-center">
                      <a class="btn btn-warning btn-sm" href="<?php echo site_url('datakr/formeditkr/'); ?><?= $row->id; ?>">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="<?php echo site_url('datakr/hapuskr/'); ?><?= $row->id; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?');">
                        <i class="fas fa-trash-alt"></i> Hapus
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>