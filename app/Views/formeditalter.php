<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Data Alternatif</h3>
        </div>
        <?php
        $no = 0;
        foreach ($dataalter as $row) {
          $no++;
        ?>

          <form action="<?= site_url('dataalter/editalter/' . $row->id); ?>" method="POST">
            <div class="card-body">
              <div class="form-group">
                <label>Kode Peserta</label>
                <input type="text" class="form-control" name="kode" value="<?= $row->kode; ?>" readonly>
              </div>
              <div class="form-group">
                <label>Nama Peserta</label>
                <input type="text" class="form-control" name="nama" value="<?= $row->nama; ?>" placeholder="Isi Nama Peserta">
              </div>
            </div>
          <?php } ?>
          <!-- Submit Button -->
          <div class="card-footer">
            <center>
              <button type="submit" class="btn btn-primary">Update</button>
            </center>
          </div>
          </form>
      </div>
    </div>
  </div>
</section>