<!-- Hitung MIN/MAX -->
<h1>Hasil Hitung</h1>
<div class="card-body">
    <p>Note: B = Benefit <br> C = Cost</p>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>C1 = Jenis Usaha [B] | max</th>
                <th>C2 = Jumlah Pekerja [B] | max</th>
                <th>C3 = Modal Usaha [C] | min</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach($dataminmax as $row):
                $no++;
            ?>
            <tr>
                <th>Nilai Max/Min Kriteria</th>
                <td><?= $row->maxminK1; ?></td>
                <td><?= $row->maxminK2; ?></td>
                <td><?= $row->maxminK3; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
