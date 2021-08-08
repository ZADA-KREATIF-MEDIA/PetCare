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
                                <button type="button" onclick="beli()" class=" mt-2 btn btn-sm btn-block btn-success text-uppercase">beli</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>