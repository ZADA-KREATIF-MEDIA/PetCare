<?= $this->session->flashdata('message'); ?>
<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Order Driver Detail</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="col-12 blog-content">
            <div class="card">
                <div class="card-header">
                    <?php echo $detail['id_order'];?>
                    <span class="badge badge-success float-right text-uppercase p-2"><?php echo $detail['status_order'];?></span>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <img src="<?php echo base_url();?>assets/frontend/img/foto_ambil/<?php echo $detail['gambar_pengambilan']; ?>" alt="ambil" class="img-thumbnail img-order-driver"><br>
                            <span>Pengambilan Barang</span>
                        </div>
                        <div class="col-6">
                            <img src="<?php echo base_url();?>assets/frontend/img/foto_antar/<?php echo $detail['gambar_pengantaran']; ?>" alt="ambil" class="img-thumbnail img-order-driver"><br>
                            <span>Barang Sampai</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <span class="text-muted">Nama Pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['nama_pengirim'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Nomor Telpon Pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['no_telpn_pengirim'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Alamat Pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['alamat_asal'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Nama Penerima</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['nama_penerima'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Nomor Telpon Penerima</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['no_telpn_penerima'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Alamat Penerima</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['alamat_tujuan'];?></span>
                        </div>
                    </div>
                    <hr class="style-two my-3">
                    <div class="row mt-4">
                        <div class="col-6">
                            <span class="text-muted">Volume Barang</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['volume_barang'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Berat Barang</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['berat_barang'];?>kg</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted">Status Berat</span>
                        </div>
                        <div class="col-6">
                            <span class="text-muted float-right"><?php echo $detail['status_berat'];?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>