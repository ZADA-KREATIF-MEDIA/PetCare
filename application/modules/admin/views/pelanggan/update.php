<div class="container-fluid ">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form action="<?= base_url('admin/pelanggan/update_save') ?>" method="POST">
                    <input type="hidden" name="id" id="id" value="<?= $pelanggan->id; ?>" />
                    <div class="form-group">
                        <label><strong>Nama pelanggan : </strong></label>
                        <input type="text" value="<?= $pelanggan->nama ?>" class="form-control" name="nama" placeholder="Nama pelanggan ...." required>
                    </div>

                    <div class="form-group">
                        <label><strong>Alamat : </strong></label>
                        <input type="text" value="<?= $pelanggan->alamat ?>" class="form-control" name="alamat" placeholder="Alamat pelanggan ..." required>
                    </div>

                    <div class="form-group">
                        <label><strong>No Telephone : </strong></label>
                        <input type="number" value="<?= $pelanggan->no_hp ?>" class="form-control" name="no_hp" placeholder="No Telephone ..." maxlength="12" required>
                    </div>
                    <div class="form-group">
                        <label><strong>Kordinat Alamat : </strong></label>
                        <input type="text" value="<?= $pelanggan->koordinat_alamat ?>" class="form-control" name="koordinat_alamat" placeholder="Koordinat alamat ..." required>
                    </div>


            </div>
            <!-- button trigger -->
            <button type="submit" class="btn btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">Update</span>
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