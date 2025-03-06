<h1 class="text-center mb-1 text-success">Hasil Keputusan</h1>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- Tabel Hasil Keputusan -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead class="bg-success text-white">
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Nama Peserta</th>
                  <th class="text-center">Hasil Nilai</th>
                  <th class="text-center">Peringkat</th>
                  <th class="text-center">Status Kelolosan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  foreach ($datahasil as $row):
                    // Tentukan status kelolosan berdasarkan rank_position
                    $status_kelolosan = ($row->peringkat <= 3) ? 'Lolos' : 'Tidak Lolos';
                ?>
                  <tr class="text-center">
                    <td><?= $no++; ?></td>
                    <td><?= esc($row->nama_peserta); ?></td>
                    <td><?= esc($row->skor_preferensi); ?></td>
                    <td><?= esc($row->peringkat); ?></td>
                    <td>
                      <span class="badge <?= $status_kelolosan == 'Lolos' ? 'badge-success' : 'badge-danger'; ?>">
                        <?= esc($status_kelolosan); ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
