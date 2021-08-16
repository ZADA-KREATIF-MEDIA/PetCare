<?= $this->session->flashdata('message'); ?>
<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">List Ganti Driver</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="col-12 blog-content">
            <?php if(count($order) > 0):?>
                <?php foreach($order as $orders):?>
                <div class="row my-3 my-lg-5 border border-rounded" style="cursor:pointer;">
                    <div class="col-md-2 d-none d-md-block">
                        <img src="<?php echo base_url();?>assets/frontend/img/box_on_porses.png" alt="box_on_porses" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-10 mt-3">
                        <h5><?php echo $orders['id_orderan']; ?></h5>
                        <div class="col-12 pl-0">
                            <span>Alamat Terakhir:</span><br>
                            <span><?php echo $orders['alamat'];?></span><br>
                            <span>Jarak Ditempuh :</span><br>
                            <span><?php echo $orders['jarak_tempuh_driver_lama'];?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            <?php else:?>
            <h1 class="text-center"><i class="fas fa-archive"></i></h1>
            <?php endif;?>
        </div>
    </div>
</div>