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
<?= $this->session->flashdata('message'); ?>
<div class="site-section">
    <div class="container">
        <div class="col-12 blog-content">
            <?php if(count($order) > 0):?>
                <?php foreach($order as $orders):?>
                <div class="row my-3 my-lg-5" style="cursor:pointer;">
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
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="">Koordinat Asal</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center" id="koordinatAsal" readonly value="<?php echo $orders['koordinat_asal'];?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-info clipboard" data-toggle="tooltip" data-placement="top" title="Copy To Clipboard" data-clipboard-text="<?php echo $orders['koordinat_asal'];?>"><i class="far fa-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Koordinat Tujuan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center" id="koordinatAsal" readonly value="<?php echo $orders['koordinat_tujuan'];?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-info clipboard" data-toggle="tooltip" data-placement="top" title="Copy To Clipboard" data-clipboard-text="<?php echo $orders['koordinat_tujuan'];?>"><i class="far fa-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="patokanAsal">Patokan Asal</label>
                                <textarea class="form-control" id="patokanAsal" readonly><?php echo $orders['patokan_asal'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="patokanTujuan">Patokan Tujuan</label>
                                <textarea class="form-control" id="patokanTujuan" readonly><?php echo $orders['patokan_tujuan'];?></textarea>
                            </div>
                        </div>
                        <?php if($orders['status_order'] == "order"):?>
                            <span class="badge badge-info text-uppercase">Order</span>
                        <?php elseif($orders['status_order'] == "proses"):?>
                            <span class="badge badge-primary text-uppercase">Proses</span>
                        <?php else:?>
                            <span class="badge badge-success text-uppercase">Diterima</span>
                        <?php endif;?>
                        <button class="btn btn-success btn-sm float-right" type="button" onclick="prosesOrderanSelesai('<?php echo $orders['id_order'];?>')">Selesai</button>
                        <?php if($orders['id_rider'] == $orders['id_driver_baru']):?>
                            <button class="btn btn-dark btn-sm float-right mr-2" onclick="prosesOrderanDariGanti('<?php echo $orders['id_order'];?>','<?php echo $orders['koordinat_tujuan'];?>','<?php echo $orders['koordinat'];?>')">Proses Driver Baru</button>
                        <?php else:?>
                            <button class="btn btn-primary btn-sm float-right mr-2" onclick="prosesOrderan('<?php echo $orders['id_order'];?>')">Proses</button>
                        <?php endif;?>
                        <?php if($orders['status_order']=="proses"):?>
                            <button class="btn btn-danger btn-sm float-right mr-2" onclick="gantiDriver('<?php echo $orders['id_order'];?>', '<?php echo $orders['koordinat_tujuan']?>')">Ganti Driver</button>
                        <?php else:?>
                            <button class="btn btn-dark btn-sm float-right mr-2" onclick="cekOrderan('<?php echo $orders['id_order'];?>')">Cek</button>
                        <?php endif;?>
                    </div>
                </div>
                <?php endforeach;?>
            <?php else:?>
            <h1 class="text-center">Belum Ada Orderan Masuk</h1>
            <?php endif;?>
        </div>
    </div>
</div>
<!-- Modal Cek Order -->
<div class="modal fade" id="modalCekOrder" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Orderan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('order/update_order_detail_driver');?>
            <input type="hidden" name="id_customer" id="idCustomer" >
            <input type="hidden" name="level_user" id="levelCustomer" >
            <input type="hidden" name="total_sebelum" id="totalSebelumnya">
            <input type="hidden" name="ongkir" id="ongkir">
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_order_db">ID ORDER</label>
                    <input type="text" class="form-control" id="id_order_db" name="id_order_db" value="" readonly>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="overweight" value="overweight" name="berat_barang[]">
                            <label class="form-check-label" for="overweight">Overweight</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="oversize" value="oversize" name="berat_barang[]">
                            <label class="form-check-label" for="oversize">Oversize</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="normal" value="normal" name="berat_barang[]">
                            <label class="form-check-label" for="normal">Normal</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea class="form-control" name="catatan" id="catatan" name="catatan" placeholder="Masukkan catatan"></textarea>
                </div>
                <div class="alert alert-info" role="alert">
                    <span class="font-weight-bold">Barang yang dikirim maksimal memiliki volume 40x40x40 dan berat barang maksimal 10 kg. Jika melebihi ukuran tersebut maka akan dikenakan biaya tambahan ketika kurir crosscheck kembali.</span>
                </div>
                <hr class="style-two my-3">
                <h6 class="font-weight-bold">Data Pengirim</h6>
                <div class="row">
                    <div class="col-6">
                        <span class="text-muted">Nama Pengirim</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right" id="namaPengirim"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">Nomor Handphone Pengirim</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right" id="noHpPengirim"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">Alamat Pengirim</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right" id="alamatPengirim"></span>
                    </div>
                </div>
                <hr class="style-two my-3">
                <h6 class="font-weight-bold">Data Penerima</h6>
                <div class="row">
                    <div class="col-6">
                        <span class="text-muted">Nama Penerima</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right" id="namaPenerima"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">Nomor Handphone Penerima</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right" id="noHpPenerima"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">Alamat Penerima</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right" id="alamatPenerima"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary text-uppercase" id="btnSimpanCekOrder">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Modal Proses Order-->
<div class="modal fade" id="modalProsesOrder" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Proses Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php echo form_open_multipart('order/proses_orderan');?>
        <div class="modal-body">
            <div class="form-group">
                <label for="gambarAmbil">Gambar Barang Pengambilan</label>
                <input type="file" class="form-control" id="gambarAmbil"  name="foto_ambil" required="">
            </div>
            <!-- <div class="form-group d-none" id="uangDiterima">
                <label for="uang_diterima">Uang Di Terima</label>
                <input type="text" class="form-control uang" id="uang_diterima" name="uang_diterima" placeholder="Uang diterima" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div> -->
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id_orderan" id="idOrderanProses">
            <input type="hidden" name="nama_rider" value="<?php echo $this->session->userdata('rider_nama_rider');?>">
            <button type="submit" class="btn btn-primary text-uppercase">Simpan</button>
        </div>
        <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Modal Selesai Order -->
<div class="modal fade" id="modalSelesaiOrder" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selesai Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('order/selesai_orderan');?>
            <div class="modal-body">
                <label for="gambar_diterima">Foto Barang Diterima</label>
                <input type="file" class="form-control" id="gambar_diterima" name="foto_antar" required="">
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idOrderSelesai" name="id_orderan">
                <input type="hidden" name="nama_rider" value="<?php echo $this->session->userdata('rider_nama_rider');?>">
                <button type="submit" class="btn btn-primary text-uppercase">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

