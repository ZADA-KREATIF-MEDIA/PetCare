<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
            <!--button trigger-->
            <!-- <a href="<?= base_url('admin/produk/create') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
                <span class="icon text-white">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a> -->
            <!--end button trigger-->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>No.</th>
                            <th>Nama Customer</th>
                            <th>No Telephone</th>
                            <th>Alamat</th>
                            <th>Kordinat alamat</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Customer</th>
                            <th>No Telephone</th>
                            <th>Alamat</th>
                            <th>Kordinat alamat</th>
                            <th>aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($pelanggan as $data) :
                        ?>
                            <tr>
                                <td><?php echo $nomor++; ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['no_hp'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td><?= $data['koordinat_alamat'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/pelanggan/update/') . $data['id']; ?>" class="btn btn-warning btn-circle btn-sm" alt="edit">
                                        <i class="fas fa-book"></i>
                                    </a>
                                    <a href="<?= base_url('admin/pelanggan/delete/') . $data['id']; ?>" class="btn btn-danger btn-circle btn-sm" alt="delete">
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