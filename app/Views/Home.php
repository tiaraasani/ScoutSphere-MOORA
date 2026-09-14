<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-4 mb-3 mb-md-0">
        <a href="<?= site_url('alternatives') ?>" class="stat-card">
          <span class="stat-icon stat-icon-primary" aria-hidden="true"><i class="fas fa-users"></i></span>
          <span>
            <span class="stat-label">Peserta</span>
            <span class="stat-value d-block"><?= esc($alternativeCount) ?></span>
            <span class="stat-link d-block">Kelola data peserta</span>
          </span>
        </a>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <a href="<?= site_url('criteria') ?>" class="stat-card">
          <span class="stat-icon stat-icon-brand" aria-hidden="true"><i class="fas fa-sliders-h"></i></span>
          <span>
            <span class="stat-label">Kriteria</span>
            <span class="stat-value d-block"><?= esc($criteriaCount) ?></span>
            <span class="stat-link d-block">Atur bobot dan jenis</span>
          </span>
        </a>
      </div>
      <div class="col-md-4">
        <a href="<?= site_url('matrix') ?>" class="stat-card">
          <span class="stat-icon stat-icon-info" aria-hidden="true"><i class="fas fa-table"></i></span>
          <span>
            <span class="stat-label">Peserta Dinilai</span>
            <span class="stat-value d-block"><?= esc($matrixCount) ?> <small class="text-muted" style="font-size:1rem">/ <?= esc($alternativeCount) ?></small></span>
            <span class="stat-link d-block">Isi matriks penilaian</span>
          </span>
        </a>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-7">
        <div class="card h-100">
          <div class="card-header">
            <h2 class="card-title">Peringkat Teratas</h2>
            <a href="<?= site_url('results/decision') ?>" class="btn btn-sm btn-default">Lihat semua <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
          </div>
          <?php if ($topResults === []): ?>
            <?= view('partials/empty_state', [
                'icon'        => 'fa-trophy',
                'title'       => 'Belum ada peringkat',
                'text'        => 'Peringkat muncul setelah kriteria, peserta, dan matriks penilaian terisi.',
                'actionUrl'   => 'matrix/create',
                'actionLabel' => 'Isi matriks penilaian',
            ]) ?>
          <?php else: ?>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="col-index">Rank</th>
                      <th scope="col">Nama Peserta</th>
                      <th scope="col" class="text-num">Skor Preferensi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($topResults as $row): ?>
                      <tr>
                        <td><span class="rank-badge rank-<?= esc($row->peringkat) ?>"><?= esc($row->peringkat) ?></span></td>
                        <td><strong><?= esc($row->nama_peserta) ?></strong><br><small class="text-muted"><?= esc($row->kode_peserta) ?></small></td>
                        <td class="text-num"><?= esc($row->skor_preferensi) ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php endif ?>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card">
          <div class="card-header"><h2 class="card-title">Aksi Cepat</h2></div>
          <div class="card-body quick-actions">
            <a href="<?= site_url('alternatives/create') ?>" class="quick-action"><i class="fas fa-user-plus" aria-hidden="true"></i> Tambah peserta</a>
            <a href="<?= site_url('criteria/create') ?>" class="quick-action"><i class="fas fa-plus-circle" aria-hidden="true"></i> Tambah kriteria</a>
            <a href="<?= site_url('matrix/create') ?>" class="quick-action"><i class="fas fa-edit" aria-hidden="true"></i> Isi matriks penilaian</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header"><h2 class="card-title">Alur Perhitungan MOORA</h2></div>
          <div class="card-body">
            <ol class="steps">
              <li><strong>Normalisasi</strong><span>Nilai dibagi akar jumlah kuadrat per kriteria.</span></li>
              <li><strong>Pembobotan</strong><span>Nilai ternormalisasi dikalikan bobot kriteria.</span></li>
              <li><strong>Optimasi</strong><span>Jumlah benefit dikurangi jumlah cost.</span></li>
              <li><strong>Keputusan</strong><span>Peserta diurutkan dari skor tertinggi.</span></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
