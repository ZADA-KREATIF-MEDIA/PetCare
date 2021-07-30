<div class="container-fluid ">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form action="<?= base_url('admin/tarif/update_save') ?>" method="POST">
                    <input type="hidden" name="id" id="id" value="<?= $tarif->id; ?>" />
                    <div class="form-group">
                        <label><strong>Jarak Minimal : </strong></label>
                        <input type="number" class="form-control" name="jarak_minimal" value="<?= $tarif->jarak_minimal ?>" step="any" placeholder="Jarak Pengantaran Minimal ..." required>
                    </div>
                    <div class="form-group">
                        <label><strong>Tarif Jarak Minimal : </strong></label>
                        <input type="number" class="form-control" name="harga_jarak_minimal" value="<?= $tarif->harga_jarak_minimal ?>" placeholder="Tarif Jarak Pengantaran Minimal ..." required>
                    </div>
                    <div class="form-group">
                        <label><strong>Harga : </strong></label>
                        <input type="number" class="form-control" name="harga" value="<?= $tarif->harga ?>" placeholder="Tarif Pengiriman ..." required>
                    </div>
                    <div class="form-group">
                        <label><strong>Status tarif: </strong></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_jarak_minimal" value="aktif" <?php if ($tarif->status_jarak_minimal == 'aktif') echo 'checked' ?>>
                            <label class="form-check-label">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_jarak_minimal" value="tidak" <?php if ($tarif->status_jarak_minimal == 'tidak') echo 'checked' ?>>
                            <label class="form-check-label">
                                Tidak
                            </label>
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
</div>