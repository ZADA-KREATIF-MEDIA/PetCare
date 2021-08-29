<div class="container-fluid ">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-8">
                <form action="<?= base_url('admin/pesanan/update_save') ?>" method="POST">
                    <input type="hidden" name="id" id="id" value="<?= $pesanan->id; ?>" />
                    <div class="form-group">
                        <label><strong>Nama Customer : </strong></label>
                        <input type="text" value="<?= $pesanan->id_user ?>" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk ...." readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Tanggal : </strong></label>
                        <input type="text" value="<?= $pesanan->tanggal ?>" class="form-control input-lg" name="tanggal" placeholder="Nama Produk ...." readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Alamat Pick-UP : </strong> 
                        <a href="https://www.google.com/maps/?q=<?= $pesanan->koordinat_pengambilan ?>" class="btn btn-success btn-circle btn-sm" target="_blank">
                                <i class="fas fa-map"></i>
                            </a> <- klik disini </label>
                        <input type="text" value="<?= $pesanan->alamat_pengambilan ?>" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk ...." readonly>

                    </div>
                    <div class="form-group">
                        <label><strong>Alamat Pengantaran : </strong></label>
                        <a href="https://www.google.com/maps/?q=<?= $pesanan->koordinat_pengambilan ?>" class="btn btn-danger btn-circle btn-sm" target="_blank">
                                <i class="fas fa-map"></i>
                            </a> <- Klik Disini</label>
                        <input type="text" value="<?= $pesanan->alamat_pengantaran ?>" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk ...." readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Catatan : </strong></label>
                        <input type="text" value="<?= $pesanan->catatan ?>" class="form-control input-lg" name="catatan" placeholder="Nama Produk ...." readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Status Pesanan : </strong></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="proses" <?php if ($pesanan->status == 'proses') echo 'checked' ?>>
                            <label class="form-check-label">
                                Pesanan Baru / Dalam Proses
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="diantar" <?php if ($pesanan->status == 'diantar') echo 'checked' ?>>
                            <label class="form-check-label ">
                                Pesanan Diantar
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="diambil" <?php if ($pesanan->status == 'diambil') echo 'checked' ?>>
                            <label class="form-check-label">
                                Pesanan Di Ambil
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="selesai" <?php if ($pesanan->status == 'selesai') echo 'checked' ?>>
                            <label class="form-check-label">
                                Pesanan Selesai
                            </label>
                        </div>


                    </div>
            </div>
            <hr>

            <h6 class="font-weight-bold text-primary">Detail Pesanan</h6>

            <hr>

            <table class="table mb-5  table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Catatan khusus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_pembelian = 0;
                    $total_barang = 0;
                    $nomor = 1;
                    foreach ($detail_pesanan as $data) :
                    ?>
                        <tr class="text-center">
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $data['nama_produk'] ?></td>
                            <td>Rp. <?= number_format($data['harga']) ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= $data['catatan'] ?></td>
                        </tr>
                    <?php
                        $total_pembelian = $total_pembelian += $data['harga'];
                        $total_barang = $total_barang += $data['jumlah'];
                    endforeach;

                    ?>
                    <tr class="text-center">
                        <td colspan="2"><strong>Total Pembelian : </strong></td>
                        <td>Rp <?= number_format($total_pembelian); ?></td>
                        <td><?= $total_barang; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- button trigger -->
            <button type="submit" class="btn btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">UPDATE</span>
            </button>
            <a href="<?= base_url('admin/pesanan/cetak/') . $pesanan->id; ?>" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">CETAK NOTA</span>
            </a>
            <!-- <button class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-cross"></i>
                </span>
                <span class="text">TOLAK PESANAN</span>
            </button>
            <button onclick="window.history.go(-1); return false;" class="btn btn-dark btn-icon-split">
                <span class="icon text-white-50">
                    X
                </span>
                <span class="text">Kembali</span>
            </button> -->
            <!-- end button trigger -->
            </form>

            <tabel>

            </tabel>
        </div>
    </div>
</div>