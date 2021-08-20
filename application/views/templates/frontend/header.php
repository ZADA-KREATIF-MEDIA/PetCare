<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-page header-inner-pages">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="index.html">Arsha</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                    <li id="home"><a href="<?= base_url('/')?>">Home</a></li>
                <?php if($this->session->userdata('user_id')):?>
                    <li id="order"><a href="<?= base_url('/order') ?>">Produk</a></li>
                    <li id="produk"><a href="<?= base_url('/order/checkout') ?>">Checkout</a></li>
                    <li id="transaksi"><a href="<?= base_url('/order/transaksi')?>">Transaksi</a></li>
                <?php endif; ?>    
            </ul>
        </nav><!-- .nav-menu -->
        <?php if($this->session->userdata('user_id')):?>
                <a href="<?= base_url('home/logout') ?>" class="get-started-btn scrollto">Logout</a>
            <?php else:?>
                <a href="<?= base_url('home/show_login') ?>" class="get-started-btn scrollto">Login</a>
        <?php endif;?>
    </div>
</header><!-- End Header -->