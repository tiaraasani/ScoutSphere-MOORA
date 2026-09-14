<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Daftar Kriteria <span class="count-badge ml-2"><?= count($criteria) ?></span></h2>
        <a class="btn btn-primary btn-sm" href="<?= site_url('criteria/create') ?>">
          <i class="fas fa-plus" aria-hidden="true"></i> Tambah Kriteria
        </a>
      </div>

      <?php if ($criteria === []): ?>
        <?= view('partials/empty_state', [
            'icon'        => 'fa-sliders-h',
            'title'       => 'Belum ada kriteria',
            'text'        => 'Tentukan kriteria penilaian, bobotnya, dan apakah nilai tinggi itu baik (benefit) atau buruk (cost).',
            'actionUrl'   => 'criteria/create',
            'actionLabel' => 'Tambah kriteria pertama',
        ]) ?>
      <?php else: ?>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover">
              <caption class="sr-only">Daftar kriteria penilaian</caption>
              <thead>
                <tr>
                  <th scope="col" class="col-index">No.</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Nama Kriteria</th>
                  <th scope="col" class="text-num">Bobot</th>
                  <th scope="col">Jenis</th>
                  <th scope="col" class="text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($criteria as $index => $criterion): ?>
                  <?php $isBenefit = $criterion->jenis === 'benefit' ?>
                  <tr>
                    <td class="col-index"><?= $index + 1 ?></td>
                    <td><code class="kode"><?= esc($criterion->kriteria) ?></code></td>
                    <td><?= esc($criterion->nama) ?></td>
                    <td class="text-num"><?= esc($criterion->bobot) ?></td>
                    <td>
                      <span class="badge <?= $isBenefit ? 'badge-benefit' : 'badge-cost' ?>">
                        <i class="fas <?= $isBenefit ? 'fa-arrow-up' : 'fa-arrow-down' ?>" aria-hidden="true"></i>
                        <?= $isBenefit ? 'Benefit' : 'Cost' ?>
                      </span>
                    </td>
                    <td class="actions">
                      <a class="btn btn-action" href="<?= site_url('criteria/' . esc($criterion->id, 'url') . '/edit') ?>">
                        <i class="fas fa-pen" aria-hidden="true"></i> Edit<span class="sr-only"> <?= esc($criterion->nama) ?></span>
                      </a>
                      <form action="<?= site_url('criteria/' . esc($criterion->id, 'url') . '/delete') ?>" method="post" class="d-inline"
                            data-confirm="Hapus kriteria <?= esc($criterion->nama) ?> beserta nilai matriksnya?">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-action btn-action-danger">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i> Hapus<span class="sr-only"> <?= esc($criterion->nama) ?></span>
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
