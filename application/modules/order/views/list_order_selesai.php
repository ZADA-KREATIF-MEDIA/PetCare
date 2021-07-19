<?= $this->session->flashdata('message'); ?>
<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">List Order Driver</h1>
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
                <div class="row" style="cursor:pointer;">
                    <div class="col-md-2 d-none d-md-block">
                        <?php if($orders['status_order'] == "order"):?>
                            <img src="<?php echo base_url();?>assets/frontend/img/box_order.png" alt="box_order" class="img-fluid">
                        <?php elseif($orders['status_order'] == "proses"):?>
                            <img src="<?php echo base_url();?>assets/frontend/img/box_on_porses.png" alt="box_on_porses" class="img-fluid">
                        <?php else:?>
                            <img src="<?php echo base_url();?>assets/frontend/img/box_selesai.png" alt="box_selesai" class="img-fluid">
                        <?php endif;?>
                    </div>
                    <div class="col-12 col-md-10">
                        <h5><?php echo $orders['id_order']; ?></h5>
                        <div class="row">
                            <div class="col-6">
                                <span>Pengirim:</span><br>
                                <span><?php echo $orders['nama_pengirim'];?></span><br>
                                <span><?php echo $orders['no_telpn_pengirim'];?></span>
                            </div>
                            <div class="col-6">
                                <span class="float-right">Penerima:</span><br>
                                <span class="float-right"><?php echo $orders['nama_penerima'];?></span><br>
                                <span class="float-right"><?php echo $orders['no_telpn_penerima'];?></span>
                            </div>
                        </div>
                        <?php if($orders['status_order'] == "order"):?>
                            <span class="badge badge-info text-uppercase">Order</span>
                        <?php elseif($orders['status_order'] == "proses"):?>
                            <span class="badge badge-primary text-uppercase">Proses</span>
                        <?php else:?>
                            <span class="badge badge-success text-uppercase">Diterima</span>
                        <?php endif;?>
                        <a href="<?php echo base_url();?>order/detail_order_driver_selesai/<?php echo $orders['id_order']?>" class="btn btn-dark btn-sm float-right mr-2" type="button">Detail</a>
                    </div>
                </div>
                <?php endforeach;?>
            <?php else:?>
            <h1 class="text-center">Belum Ada Orderan Masuk</h1>
            <?php endif;?>
        </div>
    </div>
</div>