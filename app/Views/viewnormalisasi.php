<div class="card-body">
    <h1 class="text-center mb-9 text-primary">Hasil Normalisasi</h1>
    
    <div class="table-responsive ">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-info text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Peserta</th>
                    <?php
                    // Mengambil kriteria unik
                    $kriteria_terdaftar = [];
                    foreach($datanorm as $d){
                        $kriteria_terdaftar[$d->kode_kriteria] = $d->nama_kriteria;
                    }
                    foreach ($kriteria_terdaftar as $k => $nama) {
                        echo "<th class='text-center'>" . esc($k) . ' - ' . esc($nama) . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kelompokkan data berdasarkan nama peserta
                $data_per_peserta = [];
                foreach ($datanorm as $d) {
                    $data_per_peserta[$d->nama_peserta][$d->kode_kriteria] = $d->nilai_normalisasi;
                }

                // Tampilkan data tanpa duplikasi
                $no = 1;
                foreach ($data_per_peserta as $nama_peserta => $nilai_kriteria):
                ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= esc($nama_peserta); ?></td>
                        <?php
                        // Tampilkan nilai per kriteria
                        foreach ($kriteria_terdaftar as $k => $nama) {
                            // Pastikan nilai normalisasi ada untuk kode kriteria tertentu
                            $nilai_normalisasi = isset($nilai_kriteria[$k]) ? $nilai_kriteria[$k] : 0; // Nilai default 0 jika tidak ditemukan
                            echo "<td>" . esc($nilai_normalisasi) . "</td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
