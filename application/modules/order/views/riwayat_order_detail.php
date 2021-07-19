<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Detail Order</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section pb-0">
    <div class="container">
        <div class="col-12 blog-content">
            <div class="card mb-5">
                <div class="card-header">
                    ID ORDER : <?php echo $detail['id_order']; ?>
                    <span class="float-right font-weight-bold">Rp&nbsp;<?php echo number_format($detail['total'] + $charge['charge'],0,'.','.'); ?></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <span class="float-left">Nama pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['nama_pengirim']; ?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Nomor telpon pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['no_telpn_pengirim']; ?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Alamat pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['alamat_asal']; ?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Nama penerima</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['nama_penerima']; ?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Nomor telpon penerima</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['no_telpn_penerima']; ?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Alamat pengirim</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['alamat_tujuan']; ?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Tanggal Order</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['tanggal_order']; ?></span>
                        </div>
                        <?php if($detail['id_rider']!=""):?>
                        <div class="col-6">
                            <span class="float-left">Nama Driver</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['nama_rider'];?></span>
                        </div>
                        <div class="col-6">
                            <span class="float-left">Plat Nomor Driver</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right"><?php echo $detail['plat_nomor'];?></span>
                        </div>
                        <?php endif;?>
                        <?php if($detail['referal_code']!=""):?>
                            <div class="col-6">
                                <span class="float-left">Referal Code</span>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-dark float-right p-2"><?php echo $detail['referal_code'];?></span>
                            </div>
                        <?php endif;?>
                        <div class="col-6">
                            <span class="float-left">Status Order</span>
                        </div>
                        <div class="col-6">
                            <span class="float-right">
                            <?php if($detail['status_order'] == "order"):?>
                                <span class="badge badge-info text-uppercase">Order</span>
                            <?php elseif($detail['status_order'] == "proses"):?>
                                <span class="badge badge-primary text-uppercase">Proses</span>
                            <?php else:?>
                                <span class="badge badge-success text-uppercase">Diterima</span>
                            <?php endif;?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <h5>Barang</h5>
                    <div class="row">
                        <?php foreach($list_barang as $list):?>
                        <div class="col-12 mb-1 py-2 row">
                            <div class="col-6"><span>Volume barang</span></div>
                            <div class="col-6"><span class="float-right"><?php echo $list['volume_barang'];?></span></div>
                            <div class="col-6"><span>Berat barang</span></div>
                            <div class="col-6"><span class="float-right"><?php echo $list['berat_barang'];?>&nbsp;kg</span></div>
                            <div class="col-6"><span>Status berat</span></div>
                            <div class="col-6"><span class="float-right"><?php echo $list['status_berat'];?></span></div>
                            <div class="col-12"><span>Catatan:</span></div>
                            <div class="col-12"><p><?php echo $list['catatan'];?></p></div>
                         
                            <!--<div class="col-6"><span>Sub total</span></div>
                            <div class="col-6"><span class="float-right"><?php echo number_format($list['total'],0,'.','.');?></span></div> -->
                        </div>
                        <?php endforeach;?>
                        <div class="col-12 row">
                            <div class="col-6"><span>Charge</span></div>
                            <div class="col-6"><span class="float-right"><?php echo number_format($detail['subtotal'],0,'.','.');?></span></div>
                            <?php if($detail['harga_cod'] != 0):?>
                            <div class="col-6"><span>Harga Barang COD</span></div>
                            <div class="col-6"><span class="float-right"><?php echo number_format($detail['harga_cod'],0,'.','.');?></span></div>
                            <?php endif;?>
                            <div class="col-6">
                                <span>Ongkir</span>
                            </div>
                            <div class="col-6">
                                <span class="float-right"><?php echo number_format($detail['ongkir'],0,'.','.');?></span>
                            </div>
                            <?php if($detail['diskon'] != 0 || $detail['diskon'] != ""):?>
                                <div class="col-6">
                                    <span>Diskon</span>
                                </div>
                                <div class="col-6">
                                    <span class="float-right"><?php echo number_format($detail['diskon'],2,'.','.');?></span>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
