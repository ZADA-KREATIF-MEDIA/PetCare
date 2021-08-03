<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li>Login Page</li>
            </ol>
            <h2>Login</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="col-md-8 col-sm-12 mx-auto">
                <div class="form-group">
                    <label for="no_hp">Nomor Handphone</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control">
                </div>
                <button class="btn btn-success btn-success btn-block">Login</button>
                <a class="btn btn-link btn-block" href="<?= base_url('home/daftar') ?>">Daftar</a>
            </div>
        </div>
    </section>

</main>