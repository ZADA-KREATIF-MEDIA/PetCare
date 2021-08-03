<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li>Register Page</li>
            </ol>
            <h2>Register</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="col-12 row">
                <div class="form-group col-md-6 col-sm-12 pl-0">
                    <label for="no_hp">Nomor Handphone</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan nomor handphone">
                </div>
                <div class="form-group col-md-6 col-sm-12 pr-0">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control" placeholder="Masukkan nama">
                </div>
                <div class="form-group col-md-6 col-sm-12 pl-0">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Masukkan password">
                </div>
                <div class="form-group col-md-6 col-sm-12 pr-0">
                    <label for="address">Cari Alamat</label>
                    <div class="input-group">
                        <input type="text" id="address" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button type="button" class="input-group-text" id="basic-addon2" onclick="getlatlang()"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form- col-12 px-0">
                    <label for="detailAlamat">Detail Alamat</label>
                    <textarea  id="detailAlamat" class="form-control"></textarea>
                </div>
                <div id="map" style="width:100%;height:350px;"></div>
                <button class="btn btn-success btn-success btn-block">Daftar</button>
            </div>
        </div>
    </section>
</main>