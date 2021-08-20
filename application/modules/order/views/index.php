<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <h2>Produk</h2>
        </div>
    </section><!-- End Breadcrumbs -->
    <?= $this->session->flashdata('message'); ?>
    <section class="inner-page">
        <div class="container">
            <?php if($this->session->userdata('user_nama') != ""):?>
                <h1>Selamat Datang <?= $this->session->userdata('user_nama') ?></h1>
            <?php endif;?>
            <h1 class="text-center">Daftar Produk</h1>
            <div class="col-12 row">
                <?php foreach($produk as $p):?>
                    <div class="col-sm-12 col-md-4">
                        <div class="card" >
                            <img src="<?= base_url('assets/gambar_produk/'.$p['gambar'])?>" class="card-img-top img-fluid" alt="gambar-produk">
                            <div class="card-body">
                                <h5 class="card-title"><?= $p['nama_produk'] ?></h5>
                                <h6>Stock <span class="badge badge-info"><?= $p['stock'] ?></span></h6>
                                <span class="card-text">Rp. <?= number_format($p['harga'],0,',','.') ?></span> |
                                <span class="card-text"><?= $p['nama'] ?></span>
                                <?php if($this->session->userdata('user_nama') != ""):?>
                                    <button type="button" onclick="beli(<?= $p['id'] ?>)" class="mt-2 btn btn-sm btn-block btn-success text-uppercase">beli</button>
                                <?php else:?>
                                    <a href="<?= base_url('home/show_login') ?>" class="mt-2 btn btn-sm btn-block btn-dark text-uppercase">login</a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
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