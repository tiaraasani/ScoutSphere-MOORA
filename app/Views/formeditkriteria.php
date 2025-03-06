<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Edit Data Kriteria</h3>
        </div>
        <?php
        $no = 0;
        foreach ($datakr as $row)
          $no++;
        ?>

        <form action="<?= site_url('datakr/editkr/' . $row->id); ?>" method="POST">
          <div class="card-body">

            <div class="form-group">
              <label>Kode Kriteria</label>
              <input type="text" class="form-control" name="kode" value="<?= $row->kriteria; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nama Kriteria</label>
              <input type="text" class="form-control" name="nama" value="<?= $row->nama; ?>">
            </div>
            <div class="form-group">
              <label>Bobot Kriteria</label>
              <input type="text" class="form-control" name="bobot" value="<?= $row->bobot; ?>">
            </div>
            <div class="form-group">
              <label>Tipe Kriteria</label>
              <input type="text" class="form-control" name="tipe" value="<?= $row->jenis; ?>">
            </div>

            <!-- Submit Button -->
            <div class="card-footer">
              <center>
                <button type="submit" class="btn btn-warning">Update</button>
              </center>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>