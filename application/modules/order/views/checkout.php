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
                            <a href="#" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h5 class="card-title">Alamat Pengantaran</h5>
                            <p class="card-text"><?= $produk['alamat_pengantaran'] ?></p>
                            <a href="#" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">Produk</h5>
                    <div class="card-body row">
                        <?php foreach($produk['produk'] as $p):?>
                            <div class="col-sm-12 col-md-6 mb-3 row">
                                <div class="col-4">
                                    <img src="<?= base_url('assets/gambar_produk/'.$p['gambar']) ?>" class="img-thumbnail" alt="gambar-produk">
                                </div>
                                <div class="col-8">
                                    <h5 class="card-title"><?= $p['nama_produk']?></h5>
                                    <p class="card-text"><?= $p['jumlah'].' x '.number_format($p['harga'],0,',','.')?>&nbsp;=&nbsp;<?= number_format($p['harga']*$p['jumlah'],0,',','.')?></p>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="<?= base_url('/order/hapus/'.$p['id']) ?>" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>    
                        <?php endforeach;?>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
</main>
<div class="modal fade" id="beliModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulBarang">Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('order/store_keranjang') ?>
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
                        <label for="catatan">Catatn</label>
                        <textarea name="catatan" id="catatan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_user" id="id_user" value="<?= $this->session->userdata('user_id') ?>">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <input type="hidden" name="harga" id="harga">
                    <button type="submit" class="btn btn-success text-uppercase">beli</button>
                </div>
            <?= form_close()?>
        </div>
    </div>
</div>