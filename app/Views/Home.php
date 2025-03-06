<div class="content">
  <div class="container-fluid">
  <div class="row">
      <div class="col-12 text-center mb-4">
        <h1 class="display-5 font-weight-bold">Pemilihan Pandega Berprestasi</h1>
        <h4 class="text-secondary">Wilayah Kalimantan Timur</h4>
      </div>
    </div>
    <div class="row">
      <!-- Card Alternatif -->
      <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="small-box bg-success shadow-sm">
          <div class="inner text-center">
            <h3><?= $jumlah_alter; ?></h3>
            <p>Data Alternatif</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?= site_url('dataalter/view'); ?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      
      <!-- Card Kriteria -->
      <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="small-box bg-danger shadow-sm">
          <div class="inner text-center">
            <h3><?= $jumlah_kriteria; ?></h3>
            <p>Data Kriteria</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?= site_url('datakriteria/view'); ?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      
      <!-- Card Matriks -->
      <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <div class="small-box bg-primary shadow-sm">
          <div class="inner text-center">
            <h3><?= $jumlah_kriteria; ?></h3>
            <p>Data Matriks</p>
          </div>
          <div class="icon">
            <i class="fas fa-hammer"></i>
          </div>
          <a href="<?= site_url('datakriteria/view'); ?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
