
<div class="site-section-cover overlay inner-page bg-light" style="background-image: url('<?php echo base_url();?>assets/frontend/depan/images/box.jpg')" data-aos="fade">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="box-shadow-content">
                    <div class="block-heading-1">
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Order Paket</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->session->flashdata('message'); ?>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 blog-content mt-3 mt-md-0 order-last order-md-first">  
                <?php echo form_open('order/save_to_order');?>
                <div class="card">
                    <div class="card-header">
                        Data Pengirim <button class="btn-sm btn-info float-right" type="button" onclick="getLocation()"><i class="fas fa-map-marker-alt"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_order">ID ORDER</label>
                            <input type="text" class="form-control" id="id_order" name="id_order" value="<?php echo $id_orderan; ?>" readonly style="background-color:#e9ecef !important;">
                        </div>
                        <div class="form-group">
                            <label for="alamat_asal">Alamat Asal</label>
                            <?php if(isset($_SESSION['alamat_asal'])&&$_SESSION['alamat_asal']!=""):?>
                                <textarea name="alamat_asal" id="alamat_asal" class="form-control" placeholder="Masukkan alamat asal" required="" onclick="gotoAsal()"><?php echo $_SESSION['alamat_asal']['alamat']?></textarea>
                                <input type="hidden" name="koordinat_asal" value="<?php echo $_SESSION['alamat_asal']['koordinat']?>">
                                <input type="hidden" name="kabupaten_asal" value="<?php echo $_SESSION['alamat_asal']['kabupaten']?>">
                            <?php else:?>
                                <textarea name="alamat_asal" id="alamat_asal" class="form-control" placeholder="Masukkan alamat asal" required="" onclick="gotoAsal()"></textarea>
                            <?php endif;?>
                        </div>
                        <div class="form-group">
                            <label for="patokan_asal">Patokan Alamat Asal</label>
                            <textarea name="patokan_asal" id="patokan_asal" class="form-control" placeholder="Mis. Rumah Warna Biru"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="alamat_tujuan">Alamat Tujuan</label>
                            <?php if(isset($_SESSION['alamat_penerima'])&&$_SESSION['alamat_penerima']!=""):?>
                                <textarea name="alamat_tujuan" id="alamat_tujuan" class="form-control" placeholder="Masukkan alamat tujuan" required="" onclick="gotoPenerima()"><?php echo $_SESSION['alamat_penerima']['alamat']?></textarea>
                                <input type="hidden" name="koordinat_tujuan" value="<?php echo $_SESSION['alamat_penerima']['koordinat']?>">
                                <input type="hidden" name="kabupaten_tujuan" value="<?php echo $_SESSION['alamat_penerima']['kabupaten']?>">
                            <?php else:?>
                                <textarea name="alamat_tujuan" id="alamat_tujuan" class="form-control" placeholder="Masukkan alamat tujuan" required="" onclick="gotoPenerima()"></textarea>
                            <?php endif;?>
                        </div>
                        <div class="form-group">
                            <label for="patokan_tujuan">Patokan Alamat Tujuan</label>
                            <textarea name="patokan_tujuan" id="patokan_tujuan" class="form-control" placeholder="Mis. Rumah Warna Biru"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pengirim">Pengirim</label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim" readonly value="<?php echo $this->session->userdata('cust_nama');?>" style="background-color:#e9ecef !important;">
                        </div>
                        <div class="form-group">
                            <label for="no_tlpn_pengirim">Nomor Telpon Pengirim</label>
                            <input type="text" class="form-control" id="no_tlpn_pengirim" name="no_tlpn_pengirim" placeholder="Masukkan nomor telpon penerima" value="<?php echo $this->session->userdata('cust_no_telpn');?>" readonly style="background-color:#e9ecef !important;">
                        </div>
                        <div class="form-group">
                            <label for="penerima">Penerima</label>
                            <input type="text" class="form-control" id="penerima" name="penerima" placeholder="Masukkan nama penerima" required="">
                        </div>
                        <div class="form-group">
                            <label for="no_tlpn_penerima">Nomor Telpon Penerima</label>
                            <input type="text" class="form-control" id="no_tlpn_penerima" name="no_tlpn_penerima" placeholder="Masukkan nomor telpon penerima" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="14" required="">
                        </div>
                        <div class="form-group">
                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                            <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" required="">
                                <option disabled>Pilih Metode Pembayaran</option>
                                <option value="cash" selected>Cash</option>
                                <option value="cod">COD</option>
                                <option value="billing">Billing</option>
                                <option value="cod_billing">COD Billing</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="inputHargaCOD">
                            <label for="harga_barang">Harga Barang Yang Di Ambil</label>
                            <input type="text" name="harga_cod" class="form-control uang" id="harga_barang" placeholder="Masukkan harga">
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_by" id="paid_by" value="pengirim" checked>
                                <label class="form-check-label" for="paid_by">
                                    Pengirim
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paid_by" id="paid_by" value="penerima">
                                <label class="form-check-label" for="paid_by">
                                    Penerima
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="referal_code">Referal Code</label>
                            <input type="text" class="form-control" id="referal_code" name="referal_code" placeholder="Masukkan referal code">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="float-left" id="judulOngkir">Ongkir</span>
                            </div>
                            <div class="col-6">
                                <span class="float-right" id="nominalOngkir"></span>
                                <input type="hidden" id="jarak" name="jarak">
                                <input type="hidden" id="inputNominalOngkir" name="nominal_ongkir">
                            </div>
                            <div class="col-6">
                                <span class="float-left">Total</span>
                            </div>
                            <div class="col-6">
                                <span class="float-right" id="nominalTotal"></span>
                                <input type="hidden" name="nominal_total" id="inputNominalTotal">
                            </div>
                        </div>
                        <hr class="style-two">
                        <span class="text-danger font-weight-bold">*Sebelum di verifikasi oleh driver harga bisa berubah</span><br>
                        <span class="font-weight-bold" data-toggle="modal" data-target="#modalPersyaratan" style="cursor:pointer">*Selengkapnya tentang persyaratan pengiriman</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="sudah" id="verifikasi_customer" name="verifikasi_customer" required="">
                            <label class="form-check-label" for="verifikasi_customer">
                                Menyetujui Persyaratan Pengiriman.
                            </label>
                        </div>
                        <button class="btn btn-success btn-block text-uppercase mt-2" type="submit">order</button>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
            <div class="col-md-6 sidebar  order-first order-md-last">
                <div class="card">
                    <div class="card-header">
                        List Barang
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary <?php if($tmp_order != ""){ echo "d-none"; }?>" type="button" onclick="tambahBarang()">Masukkan Barang</button>
                        <?php if($tmp_order !=""):?>
                            <div class="row border rounded mt-3">
                                <div class="col-md-4 py-md-2 pt-5 d-none d-md-block">
                                    <img src="<?php echo base_url()?>assets/frontend/img/box.png" alt="box" class="img-fluid">
                                </div>
                                <div class=" col-12 col-md-8 py-2">
                                    <div class="col-6 font-weight-bold">Catatan</div>
                                    <div class="col-6"><?php echo $tmp_order['catatan']; ?></div>
                                    <div class="col-12">
                                        <span class="text-success" style="cursor:pointer;" onclick="editTmp(<?php echo $tmp_order['id_barang'];?>)">Edit</span>&nbsp;||&nbsp;<span class="text-danger" onclick="hapusTmp(<?php echo $tmp_order['id_barang']; ?>)" style="cursor:pointer;">Hapus</span>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Barang -->
<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('order/save_order_detail_customer_tmp');?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id_order_db" name="id_order_db" value="<?php echo date("YmdHis"); ?><?php echo $_SESSION["cust_id_customer"]?>" readonly>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <input type="hidden" name="berat_barang" value="normal">
                    <textarea class="form-control" name="catatan" id="catatan" name="catatan" placeholder="Masukkan catatan"></textarea>
                </div>
                <div class="alert alert-info" role="alert">
                    <span class="font-weight-bold">Barang yang dikirim maksimal memiliki volume 40x40x40 dan berat barang maksimal 10 kg. Jika melebihi ukuran tersebut maka akan dikenakan biaya tambahan ketika kurir crosscheck kembali.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submot" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Modal Tambah Edit -->
<div class="modal fade" id="modalBarangEdit" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('order/update_order_detail_customer_tmp');?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_order_db_edit">ID ORDER</label>
                    <input type="text" class="form-control" id="id_order_db_edit" name="id_order_db" value="<?php echo $id_orderan; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="catatan_edit">Catatan</label>
                    <textarea class="form-control" name="catatan" id="catatan_edit" name="catatan" placeholder="Masukkan catatan"></textarea>
                </div>
                <div class="alert alert-info" role="alert">
                    <span class="font-weight-bold">Barang yang dikirim maksimal memiliki volume 40x40x40 dan berat barang maksimal 10 kg. Jika melebihi ukuran tersebut maka akan dikenakan biaya tambahan ketika kurir crosscheck kembali.</span>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_barang" id="idBarang">
                <input type="hidden" name="berat_barang" value="normal">
                <button type="submot" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!-- Modal Persyaratan -->
<div class="modal fade" id="modalPersyaratan" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Persyaratan Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                Pengirim menjamin bahwa barang yang dikirim tidak melanggar peraturan dan perundangan yang berlaku di wilayah NKRI
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal COD-->
<div class="modal fade" id="modalCOD" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Term Of Service COD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Anter#Anter akan membayar barang COD saat pengambilan barang</li>
                    <li>Pengirim wajib mengembalikan senilai barang yang di-COD-kan ditambah nilai ongkos kirim kepada Anter#Anter bila ada pembatalan transaksi/ penerima menolak membayar transaksi</li>
                </ol>
            </div>
        </div>
    </div>
</div>