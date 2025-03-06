<div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengajar</th>
                    <?php foreach ($kriteria as $k): ?>
                        <th><?= $k['namakriteria']; ?></th>
                    <?php endforeach; ?>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=0;foreach ($dataByPengajar as $idPengajar => $pengajarData): $no++ ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $pengajarData['nama']; ?></td>
                        <?php foreach ($kriteria as $k): ?>
                            <td><?= $pengajarData['data'][$k['id']] ?? '-'; ?></td>
                        <?php endforeach; ?>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $idPengajar; ?>">Edit</button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?= $idPengajar; ?>">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>