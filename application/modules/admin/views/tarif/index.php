<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
            <!--button trigger-->
            <a href="<?= base_url('admin/tarif/create') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
                <span class="icon text-white">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            <!--end button trigger-->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Name</th>
                            <th>Jarak Minimal</th>
                            <th>Tarif/Harga Minimal</th>
                            <th>Harga</th>
                            <th>status</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Jarak Minimal</th>
                            <th>Tarif/Harga Minimal</th>
                            <th>Harga</th>
                            <th>status</th>
                            <th>aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($tarif as $data) :

                        ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $data['jarak_minimal'] ?> (KM)</td>
                                <td>Rp. <?= number_format($data['harga_jarak_minimal']); ?></td>
                                <td>Rp. <?= number_format($data['harga']); ?></td>
                                <td>
                                    <?php
                                    if ($data['status_jarak_minimal'] == 'aktif') {
                                        echo "<span class='badge badge-success'>aktif</span>";
                                    } else {
                                        echo "<span class='badge badge-danger'>Tidak aktif</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/tarif/update/') . $data['id']; ?>" class="btn btn-warning btn-circle btn-sm" alt="edit">
                                        <i class="fas fa-book"></i>
                                    </a>
                                    <a href="<?= base_url('admin/tarif/delete/') . $data['id']; ?>" class="btn btn-danger btn-circle btn-sm" alt="delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>