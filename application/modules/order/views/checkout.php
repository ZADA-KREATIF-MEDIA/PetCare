<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <h2>Keranjang Belanja</h2>
        </div>
    </section><!-- End Breadcrumbs -->
    <?= $this->session->flashdata('message'); ?>
    <section class="inner-page">
        <div class="container">
            <div class="col-12">
                <div class="card mb-3">
                    <h5 class="card-header">Alamat</h5>
                    <div class="card-body row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <h5 class="card-title">Alamat Pengambilan</h5>
                            <p class="card-text"><?= $produk['alamat_pengambilan']?></p>
                            <a href="<?= base_url('alamat_pengambilan/'.$produk['id_transaksi'])?>" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h5 class="card-title">Alamat Pengantaran</h5>
                            <p class="card-text"><?= $produk['alamat_pengantaran'] ?></p>
                            <a href="<?= base_url('alamat_pengantaran/'.$produk['id_transaksi']) ?>" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">Produk</h5>
                    <div class="card-body row">
                        <?php
                            $total_produk = 0;
                            foreach($produk['produk'] as $p):?>
                            <div class="col-sm-12 col-md-6 mb-3 row">
                                <div class="col-4">
                                    <img src="<?= base_url('assets/gambar_produk/'.$p['gambar']) ?>" class="img-thumbnail" alt="gambar-produk">
                                </div>
                                <div class="col-8">
                                    <h5 class="card-title"><?= $p['nama_produk']?></h5>
                                    <p class="card-text"><?= $p['jumlah'].' x '.number_format($p['harga'],0,',','.')?>&nbsp;=&nbsp;<?= number_format($p['harga']*$p['jumlah'],0,',','.')?></p>
                                    <button type="button" class="btn btn-primary" onclick="updateKeranjang(<?= $p['id']?>)">Edit</button>
                                    <a href="<?= base_url('/order/hapus/'.$p['id']) ?>" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>    
                        <?php
                            $total_produk += ($p['jumlah']*$p['harga']);
                            endforeach;?>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item ">
                                Subtotal Produk
                                <div class="float-right"><?= number_format($total_produk,0,',','.'); ?></div>
                                <input type="hidden" id="valueSubtotalProduk" value="<?= $total_produk ?>">
                        </li>
                        <li class="list-group-item">
                            Biaya Pengambilan (<span id="jarakPengambilan"></span>)
                            <div class="float-right" id="biayaOngkirPengambilan"></div>
                            <input type="hidden" id="valueBiayaOngkirPengambilan" value="<?= $_SESSION['hasil_pengambilan']; ?>">
                        </li>
                        <li class="list-group-item">
                            Biaya Pengantaran (<span id="jarakPengantaran"></span>)
                            <div class="float-right" id="biayaOngkirPengantaran"></div>
                            <input type="hidden" id="valueBiayaOngkirPengantaran" value="<?= $_SESSION['hasil_pengantaran'] ?>">
                        </li>
                        <li class="list-group-item">
                            Total
                            <div class="float-right" id="totalBelanja"></div>
                            <input type="hidden" id="valueTotalBelanja">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<div class="modal fade" id="editKeranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulBarang">Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('order/updateDetailKeranjang') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Masukkan Jumlah Pembelian</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="jumlah_pembelian">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" name="jumlah_pembelian" class="form-control input-number text-center" id="inputPembelian" min="1" value="1" max="100">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="jumlah_pembelian">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" id="catatan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <input type="hidden" name="harga" id="harga">
                    <input type="hidden" name="jumlah_sebelumnya" id="jumlahSebelumnya">
                    <button type="submit" class="btn btn-success text-uppercase">beli</button>
                </div>
            <?= form_close()?>
        </div>
    </div>
</div>