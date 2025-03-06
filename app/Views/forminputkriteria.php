<section class="content">
  <div class="container-fluid">
    <!-- <div class="row"> -->
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Kriteria</h3>
        </div>
        <form action="<?= site_url('datakr/simpankr'); ?>" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Kode Kriteria</label>
              <input type="text" class="form-control" name="kriteria" placeholder="Isi Kode Kriteria">
            </div>
            <div class="form-group">
              <label>Nama Kriteria</label>
              <input type="text" class="form-control" name="nama" placeholder="Isi Nama">
            </div>
            <div class="form-group">
              <label>Nilai Bobot</label>
              <input type="text" class="form-control" name="bobot" placeholder="Isi Nilai Bobot">
            </div>
            <div class="form-group">
              <label>Jenis Kriteria</label>
              <input type="text" class="form-control" name="jenis" placeholder="Isi Jenis Kriteria">
            </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <center>
              <button type="submit" class="btn btn-warning">Submit</button>
            </center>
          </div>
        </form>
      </div>