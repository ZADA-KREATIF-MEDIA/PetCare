<div class="container-fluid ">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-8">
                <form action="<?= base_url('admin/pesanan/update_save') ?>" method="POST">
                    <input type="hidden" name="id" id="id" value="<?= $pesanan->id; ?>" />
                    <div class="form-group">
                        <label><strong>Nama Customer : </strong></label>
                        <input type="text" value="<?= $pesanan->id_user ?>" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk ...." readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Alamat Pick-UP : </strong></label>
                        <input type="text" value="<?= $pesanan->alamat_pengambilan ?>" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk ...." readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Alamat Pengantaran : </strong></label>
                        <input type="text" value="<?= $pesanan->alamat_pengantaran ?>" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk ...." readonly>
                    </div>
            </div>
            <!-- button trigger -->
            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">TERIMA PESANAN</span>
            </button>
            <button  class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-cross"></i>
                </span>
                <span class="text">TOLAK PESANAN</span>
            </button>
            <button onclick="window.history.go(-1); return false;" class="btn btn-dark btn-icon-split">
                <span class="icon text-white-50">
                    X
                </span>
                <span class="text">Kembali</span>
            </button>
            <!-- end button trigger -->
            </form>
        </div>
    </div>
</div>