<section class="content">
  <div class="container-fluid">
    <!-- <div class="row"> -->
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Peserta</h3>
        </div>
        <form action="<?= site_url('dataalter/simpanalter'); ?>" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Nama Peserta</label>
              <input type="text" class="form-control" name="nama" placeholder="Isi Nama Peserta">
            </div>
            <div class="form-group">
              <label>Kode Peserta</label>
              <input type="text" class="form-control" name="kode" placeholder="Isi Kode Peserta">
            </div>
          </div>
          <div class="card-footer">
            <center>
              <button type="submit" class="btn btn-success">Submit</button>
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>