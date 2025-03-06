<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0 text-center">Daftar Alter</h3>
          </div>
          <div class="card-body">
            <div class="mb-3 ">
              <a class="btn btn-success btn-sm" href="<?php echo site_url('dataalter/forminputalter'); ?>">
                <i class="fas fa-plus-circle"></i> Tambah Data Alter
              </a>
            </div>
            <!-- Tabel Data -->
            <table class="table table-bordered table-hover table-striped">
              <thead class="bg-light">
                <tr>
                  <th class="text-center" style="width: 5%;">No.</th>
                  <th class="text-center" style="width: 20%;">Kode</th>
                  <th class="text-center">Nama Peserta</th>
                  <th class="text-center" style="width: 20%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0;
                foreach ($dataalter as $row): $no++ ?>
                  <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td class="text-center"><?= htmlspecialchars($row->kode); ?></td>
                    <td class="text-center"><?= htmlspecialchars($row->nama); ?></td>
                    <td class="text-center">
                      <a class="btn btn-warning btn-sm" href="<?php echo site_url('dataalter/formeditalter/'); ?><?= $row->id; ?>">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="<?php echo site_url('dataalter/hapusalter/'); ?><?= $row->id; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        <i class="fas fa-trash-alt"></i> Hapus
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div><!-- /.container-fluid -->
