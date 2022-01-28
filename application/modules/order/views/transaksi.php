<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <h2>Transaksi</h2>
        </div>
    </section><!-- End Breadcrumbs -->
    <?= $this->session->flashdata('message'); ?>
    <section class="inner-page">
        <div class="container">
            <?php foreach($transaksi as $t):?>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="float-left">
                            Transaksi <?= $t['tanggal'] ?>
                        </div>
                        <div class="float-right">
                            <?php if($t['jenis_transaksi'] == "self_service"):?>
                                <span class="badge badge-pill badge-dark p-2">Self Service</span>
                            <?php elseif($t['jenis_transaksi'] == "pengantaran"):?>
                                <span class="badge badge-pill badge-info p-2">Pengantaran</span>
                            <?php else:?>
                                <span class="badge badge-pill badge-primary p-2">Penjemputan-Pengantaran</span>
                            <?php endif; ?>
                            <?php if($t['status'] == "selesai"):?>
                                <span class="badge badge-pill badge-success p-2"><?= $t['status'] ?></span>
                            <?php elseif($t['status'] == "proses"):?>
                                <span class="badge badge-pill badge-info p-2"><?= $t['status'] ?></span>
                            <?php elseif($t['status'] == "diantar"):?>
                                <span class="badge badge-pill badge-dark p-2"><?= $t['status'] ?></span>
                            <?php else :?>
                                <span class="badge badge-pill badge-primary p-2"><?= $t['status'] ?></span>
                            <?php endif; ?>
                            Rp <?= number_format($t['total_pembelian'],0,',','.')?>
                        </div>
                    </div>
                    <div class="card-body">
                    <span class="text-danger mb-2 font-weight-bold">*3 digit angka terakhir merupakan kode uniq untuk memverifikasi transaksi, pastikan lakukan pembayaran sesuai nominal yang tertera</span>
                    <hr>
                        <div class="row mb-3 <?php if($t['jenis_transaksi'] == "self_service"){ echo "d-none"; }?>">
                            <div class="col-sm-12 col-md-6 mb-2">
                                <h5 class="card-title">Alamat Pengantaran</h5>
                                <p class="card-text"><?= $t['alamat_pengantaran'] ?></p>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-2 <?php if($t['jenis_transaksi'] == "pengantaran"){ echo "d-none"; }?>">
                                <h5 class="card-title">Alamat Pengambilan</h5>
                                <p class="card-text"><?= $t['alamat_pengambilan'] ?></p>
                            </div>
                        </div>
                        <h6>Catatan order:</h6>
                        <p>
                            <?php if($t['catatan'] != ""){
                                echo $t['catatan'];
                            } else {
                                echo "-";
                            }?>
                        </p>
                        <button type="button" class="btn btn-info btn-sm rounded" onclick="detailTransaksi(<?= $t['id'] ?>)">Detail</button>
                        <a class="btn btn-outline-success btn-sm" target="_blank" href="https://wa.me/+6282293321335?text=Halo Saya Ingin Mengkonfirmasi pembayaran dengan kode transaksi <?= $t['kode_uniq']?> tanggal transaksi <?= $t['tanggal'] ?>"><i class="fab fa-whatsapp"></i>&nbsp;Konfirmasi pembayaran</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailTransaksi">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm text-uppercase rounded" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
