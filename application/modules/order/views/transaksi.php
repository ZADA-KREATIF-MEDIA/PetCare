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
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            Transaksi <?= $t['tanggal'] ?>
                        </div>
                        <div class="float-right">
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
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6 mb-2">
                                <h5 class="card-title">Alamat Pengantaran</h5>
                                <p class="card-text"><?= $t['alamat_pengantaran'] ?></p>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-2">
                                <h5 class="card-title">Alamat Pengambilan</h5>
                                <p class="card-text"><?= $t['alamat_pengambilan'] ?></p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-info btn-sm rounded" onclick="detailTransaksi(<?= $t['id'] ?>)">Detail</button>
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
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
