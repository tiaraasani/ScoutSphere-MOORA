<?php
// Participants ranked within the top three are accepted.
$passingRank = 3;
?>
<div class="content">
  <div class="container-fluid">
    <div class="step-note">
      <i class="fas fa-info-circle" aria-hidden="true"></i>
      <p>Peserta diurutkan dari skor preferensi tertinggi. Tiga peringkat teratas dinyatakan <strong>Lolos</strong>.</p>
    </div>
    <div class="card">
      <div class="card-header"><h2 class="card-title">Peringkat Akhir</h2></div>
      <?php if ($rows === []): ?>
        <?= view('partials/empty_state', [
            'icon'        => 'fa-trophy',
            'title'       => 'Belum ada peringkat',
            'text'        => 'Peringkat muncul setelah matriks penilaian terisi.',
            'actionUrl'   => 'matrix/create',
            'actionLabel' => 'Isi matriks penilaian',
        ]) ?>
      <?php else: ?>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col" class="col-index">Peringkat</th>
                  <th scope="col">Nama Peserta</th>
                  <th scope="col" class="text-num">Skor Preferensi</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rows as $row): ?>
                  <?php $passed = (int) $row->peringkat <= $passingRank ?>
                  <tr>
                    <td><span class="rank-badge rank-<?= esc($row->peringkat) ?>"><?= esc($row->peringkat) ?></span></td>
                    <td><strong><?= esc($row->nama_peserta) ?></strong><br><small class="text-muted"><?= esc($row->kode_peserta) ?></small></td>
                    <td class="text-num"><?= esc($row->skor_preferensi) ?></td>
                    <td>
                      <span class="badge <?= $passed ? 'badge-pass' : 'badge-fail' ?>">
                        <i class="fas <?= $passed ? 'fa-check' : 'fa-times' ?>" aria-hidden="true"></i>
                        <?= $passed ? 'Lolos' : 'Tidak Lolos' ?>
                      </span>
                    </td>
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
