<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?>&nbsp;&nbsp; - </h6>
            <h6 class="float-left font-weight-bold text-danger">&nbsp;&nbsp;Tanggal : <?= $tanggal ?> </h6>
            <!--button trigger-->
            <!-- <a href="<?= base_url('admin/pesanan/create') ?>" class="btn btn-primary btn-icon-split btn-sm float-right disabled">
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
                            <th>KODE UNIQ</th>
                            <th width="130px">ID USER - NAMA</th>
                            <th width="150px">ALAMAT PICK-UP</th>
                            <th width="150px">TOTAL PEMBELIAN</th> 
                            <th>ONGKIR</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>KODE UNIQ</th>
                            <th>ID USER - NAMA</th>
                            <th>ALAMAT PICK-UP</th>
                            <th>TOTAL PEMBELIAN</th>
                            <th>ONGKIR</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($pesanan as $data) :
                        ?>
                            <tr>
                                <td><?php echo $nomor++; ?></td>
                                <td><?= $data['kode_uniq']; ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['alamat_pengambilan'] ?></td>
                                <!-- <td><?= $data['koordinat_pengambilan'] ?></td>
                                <td><?= $data['koordinat_pengantaran'] ?></td> -->
                                <td>Rp. <?= number_format($data['total_pembelian']); ?></td>
                                <td>Rp. <?= number_format($data['ongkir']); ?></td>
                                <td>
                                    <?php
                                    if ($data['status'] == 'proses') {
                                        echo "<span class='alert alert-success btn-block'>Baru</span>";
                                    } else if ($data['status'] == 'diantar') {
                                        echo "<span class='alert alert-danger btn-block' >Di Antar</span>";
                                    } else if ($data['status'] == 'diambil') {
                                        echo "<span class='alert alert-warning btn-block'>Di Ambil</span>";
                                    } else if ($data['status'] == 'selesai') {
                                        echo "<span class='alert alert-primary btn-block'>Selesai</span>";
                                    }
                                    ?>

                                </td>
                                <td>
                                    <a href="<?= base_url('admin/pesanan/update/') . $data['id']; ?>" class="btn btn-warning btn-circle btn-sm" alt="edit">
                                        <i class="fas fa-book"></i>
                                    </a>
                                    <a href="<?= base_url('admin/pesanan/delete/') . $data['id']; ?>" class="btn btn-danger btn-circle btn-sm" alt="delete">
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