<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Matriks Penilaian <span class="count-badge ml-2"><?= count($alternatives) ?> peserta</span></h2>
        <a class="btn btn-primary btn-sm" href="<?= site_url('matrix/create') ?>">
          <i class="fas fa-plus" aria-hidden="true"></i> Tambah Penilaian
        </a>
      </div>

      <?php if ($criteria === []): ?>
        <?= view('partials/empty_state', [
            'icon'        => 'fa-sliders-h',
            'title'       => 'Kriteria belum ada',
            'text'        => 'Matriks membutuhkan minimal satu kriteria. Buat kriteria terlebih dahulu.',
            'actionUrl'   => 'criteria/create',
            'actionLabel' => 'Tambah kriteria',
        ]) ?>
      <?php elseif ($alternatives === []): ?>
        <?= view('partials/empty_state', [
            'icon'        => 'fa-table',
            'title'       => 'Belum ada peserta yang dinilai',
            'text'        => 'Pilih peserta lalu isi nilainya pada setiap kriteria.',
            'actionUrl'   => 'matrix/create',
            'actionLabel' => 'Tambah penilaian',
        ]) ?>
      <?php else: ?>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover">
              <caption class="sr-only">Nilai setiap peserta pada setiap kriteria</caption>
              <thead>
                <tr>
                  <th scope="col" class="col-index">No.</th>
                  <th scope="col">Peserta</th>
                  <?php foreach ($criteria as $criterion): ?>
                    <th scope="col" class="text-num" title="<?= esc($criterion->nama) ?>"><?= esc($criterion->kriteria) ?></th>
                  <?php endforeach ?>
                  <th scope="col" class="text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $number = 1 ?>
                <?php foreach ($alternatives as $alternative): ?>
                  <tr>
                    <td class="col-index"><?= $number++ ?></td>
                    <td><strong><?= esc($alternative->nama) ?></strong><br><small class="text-muted"><?= esc($alternative->kode) ?></small></td>
                    <?php foreach ($criteria as $criterion): ?>
                      <td class="text-num"><?= esc($values[$alternative->id][$criterion->id] ?? '-') ?></td>
                    <?php endforeach ?>
                    <td class="actions">
                      <a href="<?= site_url('matrix/' . esc($alternative->id, 'url') . '/edit') ?>" class="btn btn-action">
                        <i class="fas fa-pen" aria-hidden="true"></i> Edit<span class="sr-only"> nilai <?= esc($alternative->nama) ?></span>
                      </a>
                      <form action="<?= site_url('matrix/' . esc($alternative->id, 'url') . '/delete') ?>" method="post" class="d-inline"
                            data-confirm="Hapus seluruh nilai penilaian <?= esc($alternative->nama) ?>?">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-action btn-action-danger">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i> Hapus<span class="sr-only"> nilai <?= esc($alternative->nama) ?></span>
                        </button>
                      </form>
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
