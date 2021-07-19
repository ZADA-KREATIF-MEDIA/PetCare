<?= $this->session->flashdata('message'); ?>
<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Akun</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detail Akun
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 d-none d-md-block">
                        <img src="<?php echo base_url()?>assets/backend/img/driver/<?php echo $akun['foto']?>" alt="foto" class="img-order-driver">
                    </div>
                    <div class="col-md-8 col-12">
                        <h5 class="card-title"><?php echo $akun['nama_rider']; ?></h5>
                        <div class="mt-3">
                            <span><?php echo $akun['plat_nomor'];?></span><br>
                            <span><?php echo $akun['no_telpn'];?></span><br>
                            <span><?php echo $akun['alamat'];?></span><br>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>