<div class="card-body">
    <h1 class="text-center mb-1 text-primary">Hasil Normalisasi Berbobot</h1>

    <div class="table-responsive ">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-info text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Peserta</th>
                    <?php
                    // Mengambil kriteria unik secara dinamis berdasarkan query
                    $kriteria_terdaftar = [];
                    foreach($dataopt as $d){
                        $kriteria_terdaftar[$d->kode_kriteria] = $d->nama_kriteria;
                    }
                    foreach ($kriteria_terdaftar as $k =>$nama) {
                        echo "<th class='text-center'>" . esc($k) . " - " . esc($nama) . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kelompokkan data berdasarkan nama peserta
                $data_per_peserta = [];
                foreach ($dataopt as $d) {
                    $data_per_peserta[$d->nama_peserta][$d->nama_kriteria] = $d->nilai_berbobot;
                }

                // Tampilkan data tanpa duplikasi
                $no = 1;
                foreach ($data_per_peserta as $nama_peserta => $nilai_kriteria):
                ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= esc($nama_peserta); ?></td>
                        <?php
                        // Tampilkan nilai berbobot per kriteria
                        foreach ($kriteria_terdaftar as $k) {
                            $nilai_berbobot = $nilai_kriteria[$k] ?? 0; // Nilai default 0 jika tidak ditemukan
                            echo "<td>" . esc($nilai_berbobot) . "</td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
