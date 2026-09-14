<div class="content">
  <div class="container-fluid">
    <div class="step-note">
      <i class="fas fa-info-circle" aria-hidden="true"></i>
      <p>Rumus: <em>y<sub>i</sub> = &sum; benefit &minus; &sum; cost</em>. Nilai berbobot kriteria benefit dijumlahkan, lalu dikurangi jumlah nilai berbobot kriteria cost. Hasilnya adalah skor preferensi tiap peserta.</p>
    </div>
    <div class="card">
      <div class="card-header"><h2 class="card-title">Skor Preferensi</h2></div>
      <?php if ($rows === []): ?>
        <?= view('partials/empty_state', [
            'icon'        => 'fa-chart-line',
            'title'       => 'Belum ada skor',
            'text'        => 'Skor dihitung otomatis setelah matriks penilaian terisi.',
            'actionUrl'   => 'matrix/create',
            'actionLabel' => 'Isi matriks penilaian',
        ]) ?>
      <?php else: ?>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col" class="col-index">No.</th>
                  <th scope="col">Nama Peserta</th>
                  <th scope="col" class="text-num">&sum; Benefit</th>
                  <th scope="col" class="text-num">&sum; Cost</th>
                  <th scope="col" class="text-num">Skor Preferensi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $index => $row): ?>
                  <tr>
                    <td class="col-index"><?= $index + 1 ?></td>
                    <td><?= esc($row->nama_peserta) ?><br><small class="text-muted"><?= esc($row->kode_peserta) ?></small></td>
                    <td class="text-num"><?= esc($row->maximum) ?></td>
                    <td class="text-num"><?= esc($row->minimum) ?></td>
                    <td class="text-num"><strong><?= esc($row->skor_preferensi) ?></strong></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>
