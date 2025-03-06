<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- Card untuk form -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Matriks</h3>
                </div>
                <form action="<?= site_url('datamatriks/editmatriks/' . $idPeserta); ?>" method="post">
                    <div class="card-body">
                        <!-- Nama Peserta -->
                        <div class="form-group">
                            <label for="nama_peserta">Nama Peserta</label>
                            <?php
                            $namaPeserta = null;
                            foreach ($alternatif as $alt) {
                                if ($alt->id == $idPeserta) {
                                    $namaPeserta = $alt->nama;
                                    break;
                                }
                            }
                            ?>
                            <input type="text" name="nama_peserta" value="<?= $namaPeserta; ?>" class="form-control" readonly>
                        </div>

                        <!-- Nilai Matriks -->
                        <div class="form-group">
                            <label for="nilai_matriks">Nilai Matriks</label>
                            <?php foreach ($kriteria as $krit): ?>
                                <div class="mb-3">
                                    <label for="C<?= $krit->id; ?>" class="form-label">
                                        <?= $krit->kriteria; ?> - <?= $krit->nama; ?>
                                    </label>
                                    <?php
                                    // Cari nilai untuk kriteria ini
                                    $nilaiMatriks = null;
                                    foreach ($datamatriks as $matriks) {
                                        if ($matriks->id_kriteria == $krit->id) {
                                            $nilaiMatriks = $matriks->nilai;
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="number" name="C<?= $krit->id; ?>"
                                           class="form-control"
                                           value="<?= $nilaiMatriks; ?>"
                                           placeholder="Nilai untuk <?= $krit->kriteria; ?>"
                                           required>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
