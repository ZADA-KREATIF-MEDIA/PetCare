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
                <h5 class="card-title"><?php echo $akun['nama']; ?></h5>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <p class="card-text text-muted">Nomor Telpon</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="card-text float-lg-right"><?php echo $akun['no_telpn'];?></p>            
                    </div>
                    <div class="col-12 col-md-6 text-muted">
                        <p class="card-text">Email</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="card-text float-lg-right"><?php echo $akun['email'];?></p>            
                    </div>
                    <div class="col-12 col-md-6 text-muted">
                        <p class="card-text">Alamat</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="card-text float-lg-right"><?php echo $akun['alamat'];?></p>            
                    </div>
                    <div class="col-12 col-md-6 text-muted">
                        <p class="card-text">Level</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="card-text float-lg-right"><?php echo $akun['level'];?></p>            
                    </div>
                    <div class="col-12 col-md-6 text-muted">
                        <p class="card-text">Tanggal Bergabung</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="card-text float-lg-right"><?php echo $akun['tanggal_bergabung'];?></p>            
                    </div>
                    <?php if($akun['referal_code']!=""):?>
                        <div class="col-12 col-md-6 text-muted">
                            <p class="card-text">Referal Code</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="card-text float-lg-right"><?php echo $akun['referal_code'];?></p>            
                        </div>
                    <?php endif;?>
                </div>
                <?php if($akun['referal_code'] != null): ?>
                    <h5 class="pt-3">Pengguna Referal Code</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                foreach($pengguna_referal as $val):
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php echo $val['nama_pengirim'];?></td>
                            </tr>
                            <?php 
                                $i++;
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>