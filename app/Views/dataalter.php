<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Daftar Peserta <span class="count-badge ml-2"><?= count($alternatives) ?></span></h2>
        <a class="btn btn-primary btn-sm" href="<?= site_url('alternatives/create') ?>">
          <i class="fas fa-plus" aria-hidden="true"></i> Tambah Peserta
        </a>
      </div>

      <?php if ($alternatives === []): ?>
        <?= view('partials/empty_state', [
            'icon'        => 'fa-users',
            'title'       => 'Belum ada peserta',
            'text'        => 'Tambahkan peserta yang akan dinilai. Kode peserta dipakai sebagai pengenal di matriks penilaian.',
            'actionUrl'   => 'alternatives/create',
            'actionLabel' => 'Tambah peserta pertama',
        ]) ?>
      <?php else: ?>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover">
              <caption class="sr-only">Daftar peserta yang dinilai</caption>
              <thead>
                <tr>
                  <th scope="col" class="col-index">No.</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Nama Peserta</th>
                  <th scope="col" class="text-right">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($alternatives as $index => $alternative): ?>
                  <tr>
                    <td class="col-index"><?= $index + 1 ?></td>
                    <td><code class="kode"><?= esc($alternative->kode) ?></code></td>
                    <td><?= esc($alternative->nama) ?></td>
                    <td class="actions">
                      <a class="btn btn-action" href="<?= site_url('alternatives/' . esc($alternative->id, 'url') . '/edit') ?>">
                        <i class="fas fa-pen" aria-hidden="true"></i> Edit<span class="sr-only"> <?= esc($alternative->nama) ?></span>
                      </a>
                      <form action="<?= site_url('alternatives/' . esc($alternative->id, 'url') . '/delete') ?>" method="post" class="d-inline"
                            data-confirm="Hapus peserta <?= esc($alternative->nama) ?> beserta nilai matriksnya?">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-action btn-action-danger">
                          <i class="fas fa-trash-alt" aria-hidden="true"></i> Hapus<span class="sr-only"> <?= esc($alternative->nama) ?></span>
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
