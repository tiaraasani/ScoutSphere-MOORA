<div class="content">
  <div class="container-fluid">
    <div class="step-note">
      <i class="fas fa-info-circle" aria-hidden="true"></i>
      <p>Rumus: <em>x*<sub>ij</sub> = x<sub>ij</sub> / &radic;(&sum; x<sub>ij</sub>&sup2;)</em>. Setiap nilai dibagi akar dari jumlah kuadrat seluruh nilai pada kriteria yang sama, sehingga semua kriteria berada pada skala yang sebanding.</p>
    </div>
    <div class="card">
      <div class="card-header"><h2 class="card-title">Matriks Ternormalisasi</h2></div>
      <?= view('partials/moora_pivot', [
          'rows'       => $rows,
          'valueField' => 'nilai_normalisasi',
          'emptyTitle' => 'Belum ada data untuk dinormalisasi',
          'emptyText'  => 'Isi matriks penilaian terlebih dahulu, hasil normalisasi akan dihitung otomatis.',
      ]) ?>
    </div>
  </div>
</div>
