<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
            <!--button trigger-->
            <a href="<?= base_url('admin/produk/create') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
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
                            <th>No.</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori Produk</th>
                            <th>Harga</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori Produk</th>
                            <th>Harga</th>
                            <th>aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($produk as $data) :
                        ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $data['gambar'] ?></td>
                                <td><?= $data['nama_produk'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td>Rp. <?= number_format($data['harga']); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/produk/update/') . $data['id']; ?>" class="btn btn-warning btn-circle btn-sm" alt="edit">
                                        <i class="fas fa-book"></i>
                                    </a>
                                    <a href="<?= base_url('admin/produk/delete/') . $data['id']; ?>" class="btn btn-danger btn-circle btn-sm" alt="delete">
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