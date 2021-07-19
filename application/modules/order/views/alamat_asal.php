<?= $this->session->flashdata('message'); ?>
<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Alamat Asal</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="site-section">
    <div class="container">       
        <div class="col-md-12 blog-content">
            <div class="card">
                <div class="card-header">
                    Alamat Pengirim
                    <!-- <button class="btn btn-success btn-sm float-right" type="button" onclick="getLocation()"><i class="fas fa-map-marker-alt"></i></button> -->
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Alamat" id="address" name="address" onchange="getlatlang()" >
                        <div class="input-group-append">
                            <button class="btn btn-light" type="button" onclick="getlatlang()">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div id="map" style="width:100%;height:350px;"></div>
                    <div class="form-group">
                        <label for="detailAlamat">Alamat</label>
                        <textarea id="detailAlamat" class="form-control"></textarea>
                    </div>
                    <?php echo form_open('order/save_alamat_asal');?>
                        <input type="hidden" name="kabupaten" value="" id="kabupaten">
                        <input type="hidden" name="alamat" value="" id="alamat">
                        <input type="hidden" name="latitude" value="" id="latitude">
                        <input type="hidden" name="longitude" value="" id="longitude">
                        <button class="btn btn-success text-uppercase" type="submit">Simpan</button>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>