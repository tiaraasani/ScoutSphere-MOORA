<div class="card-body">
    <h1 class="text-center mb-1 text-success">Hasil Optimasi</h1>
    <p class="text-center text-muted mb-2">Note: hasil maksimum - minimum</p>

    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="bg-success text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Peserta</th>
                    <th class="text-center">Maksimum</th>
                    <th class="text-center">Minimum</th>
                    <th class="text-center">Hasil Hitung Optimasi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1; 
                foreach ($datahasil as $row): 
            ?>
                <tr class="text-center">
                    <td><?= $no++; ?></td>
                    <td><?= esc($row->nama_peserta); ?></td>
                    <td><?= esc($row->maximum); ?></td>
                    <td><?= esc($row->minimum); ?></td>
                    <td><?= esc($row->skor_preferensi); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
