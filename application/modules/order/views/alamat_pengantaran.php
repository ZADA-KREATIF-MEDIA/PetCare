<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="<?= base_url('checkout') ?>">Checkout</a></li>
                <li>Alamat Pengantaran</li>
            </ol>
            <h2>Alamat Pengantaran</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <?= form_open('order/update_alamat_pengantaran')?>
                <div class="form-group">
                    <label for="address">Cari Alamat</label>
                    <div class="input-group">
                        <input type="text" id="address" class="form-control" placeholder="Masukkan alamat pengantaran">
                        <div class="input-group-append">
                            <button type="button" class="input-group-text" id="basic-addon2" onclick="getlatlang()"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text bg-success text-white"  onclick="getLocation()"><i class="fas fa-map-marker-alt"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detailAlamat">Detail Alamat</label>
                    <textarea  id="detailAlamat" name="alamat_pengantaran" class="form-control"></textarea>
                </div>
                <div id="map" style="width:100%;height:350px;"></div>
                <input type="hidden" name="id_transaksi" value="<?= $this->uri->segment(2) ?>">
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="latitude" id="latitude">
                <button type="submit" class="btn btn-success btn-success btn-block mt-3 text-uppercase">simpan</button>
            <?= form_close() ?>
        </div>
    </section>
</main>