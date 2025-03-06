<base href="<?php echo base_url("assets") ?>/">
<!-- Main Sidebar Container -->
<style>
  .nav-sidebar .nav-link.active {
    background-color: #1f2d3d;
    color: #ffffff;
  }

  .nav-sidebar .nav-link:hover {
    background-color: #343a40;
    color: #ffffff;
  }

  .nav-treeview>.nav-item>.nav-link {
    padding-left: 40px;
  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Informatika</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="<?php echo site_url('Home/home'); ?>" class="nav-link <?= (uri_string() == 'Home/home') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>Home</p>
          </a>
        </li>

        <li class="nav-item <?= (uri_string() == 'datajs/view' || uri_string() == 'dataalter/view' || uri_string() == 'dataalter/forminputalter' || uri_string() == 'datakriteria/view' || uri_string() == 'databobot/view') ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= (uri_string() == 'datajs/view' || uri_string() == 'dataalter/view' || uri_string() == 'datakriteria/view' || uri_string() == 'databobot/view') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo site_url('dataalter/view'); ?>" class="nav-link <?= (uri_string() == 'dataalter/view') ? 'active' : '' ?>">
                <i class="fas fa-store"></i>
                <p>Data Peserta</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('datakriteria/view'); ?>" class="nav-link <?= (uri_string() == 'datakriteria/view') ? 'active' : '' ?>">
                <i class="fas fa-chart-bar"></i>
                <p>Data Kriteria</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('datamatriks/view'); ?>" class="nav-link <?= (uri_string() == 'datamatriks/view') ? 'active' : '' ?>">
                <i class="fas fa-hammer"></i>
                <p>Matriks</p>
              </a>
            </li>  
          </ul>
        </li>

        <li class="nav-item">
          <a href="<?php echo site_url('Home/callviewnormalisasi'); ?>" class="nav-link <?= (uri_string() == 'Home/callviewnormalisasi') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>Hitung Normalisasi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Home/callviewoptimasi'); ?>" class="nav-link <?= (uri_string() == 'Home/callviewoptimasi') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>Nilai Optimasi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Home/callviewhasil'); ?>" class="nav-link <?= (uri_string() == 'Home/callviewhasil') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>Hitung Optimasi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Home/callviewkeputusan'); ?>" class="nav-link <?= (uri_string() == 'Home/callviewkeputusan') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>Hasil Keputusan</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

  </div>
  <!-- /.content-header -->