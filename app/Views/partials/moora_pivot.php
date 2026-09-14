<?php
// Pivot of MOORA view rows: one row per participant, one column per criterion.
// Expects $rows (list<object>), $valueField (column holding the value) and $emptyTitle/$emptyText.
$criteriaHeaders   = [];
$rowsByParticipant = [];

foreach ($rows as $row) {
    $criteriaHeaders[$row->kode_kriteria]                       = $row->nama_kriteria;
    $rowsByParticipant[$row->nama_peserta][$row->kode_kriteria] = $row->{$valueField};
}
?>
<?php if ($rowsByParticipant === []): ?>
  <?= view('partials/empty_state', [
      'icon'        => 'fa-calculator',
      'title'       => $emptyTitle,
      'text'        => $emptyText,
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
            <?php foreach ($criteriaHeaders as $code => $name): ?>
              <th scope="col" class="text-num" title="<?= esc($name) ?>"><?= esc($code) ?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
          <?php $number = 1 ?>
          <?php foreach ($rowsByParticipant as $participant => $valuesByCriterion): ?>
            <tr>
              <td class="col-index"><?= $number++ ?></td>
              <td><?= esc($participant) ?></td>
              <?php foreach ($criteriaHeaders as $code => $name): ?>
                <td class="text-num"><?= esc($valuesByCriterion[$code] ?? 0) ?></td>
              <?php endforeach ?>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer text-muted small">
    Kolom: <?php foreach ($criteriaHeaders as $code => $name): ?><code class="kode"><?= esc($code) ?></code> <?= esc($name) ?>&nbsp;&nbsp;<?php endforeach ?>
  </div>
<?php endif ?>
