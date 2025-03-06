<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0 text-center">Daftar Matriks</h3>
          </div>
          <div class="card-body">
            <!-- Tombol untuk menambah matriks -->
            <div class="mb-3 ">
              <a class="btn btn-success btn-sm" href="<?php echo site_url('datamatriks/forminputmatriks'); ?>" style="width: 200px;">
                <i class="fas fa-plus-circle"></i> Tambah Matriks
              </a>
            </div>
            <!-- Tabel Daftar Matriks -->
            <table class="table table-bordered table-hover table-striped">
              <thead class="bg-light">
                <tr>
                  <th class="text-center" style="width: 5%;">No.</th>
                  <th class="text-center" style="width: 15%;">Kode Peserta</th>
                  <?php foreach ($kriteria as $k): ?>
                    <th class="text-center"><?= $k->kriteria; ?></th>
                  <?php endforeach; ?>
                  <th class="text-center" style="width: 15%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($alternatif as $alt): ?>
                  <?php
                  // Periksa apakah peserta memiliki data di tabel matriks
                  $datapeserta = false;
                  foreach ($datamatriks as $dm) {
                    if ($dm->id_peserta == $alt->id) {
                      $datapeserta = true;
                      break;
                    }
                  }
                  ?>
                  <?php if ($datapeserta): // Tampilkan hanya jika peserta memiliki data di matriks 
                  ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= $alt->kode; ?></td>
                      <?php foreach ($kriteria as $k): ?>
                        <?php
                        // Cari nilai yang sesuai di matriks
                        $nilai = '-';
                        foreach ($datamatriks as $dm) {
                          if ($dm->id_peserta == $alt->id && $dm->id_kriteria == $k->id) {
                            $nilai = $dm->nilai;
                            break;
                          }
                        }
                        ?>
                        <td class="text-center"><?= $nilai; ?></td>
                      <?php endforeach; ?>
                      <td class="text-center">
                        <a href="<?= site_url('datamatriks/formeditmatriks/' . $alt->id); ?>" class="btn btn-primary btn-sm">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= site_url('datamatriks/hapusmatriks/' . $alt->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                          <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</div>