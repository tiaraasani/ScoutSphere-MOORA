<div class="content">
  <div class="container-fluid">
    <div class="step-note">
      <i class="fas fa-info-circle" aria-hidden="true"></i>
      <p>Rumus: <em>y<sub>ij</sub> = w<sub>j</sub> &times; x*<sub>ij</sub></em>. Nilai ternormalisasi dikalikan bobot kriteria, sehingga kriteria yang lebih penting memberi pengaruh lebih besar.</p>
    </div>
    <div class="card">
      <div class="card-header"><h2 class="card-title">Matriks Ternormalisasi Berbobot</h2></div>
      <?= view('partials/moora_pivot', [
          'rows'       => $rows,
          'valueField' => 'nilai_berbobot',
          'emptyTitle' => 'Belum ada data untuk dibobotkan',
          'emptyText'  => 'Isi matriks penilaian terlebih dahulu, hasil pembobotan akan dihitung otomatis.',
      ]) ?>
    </div>
  </div>
</div>
