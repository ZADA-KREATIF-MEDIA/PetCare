<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form action="<?= base_url('admin/admin/update_save') ?>" method="POST">
                    <input type="hidden" name="id" id="id" value="<?= $admin->id; ?>" />
                    <div class="form-group">
                        <label><strong>E-mail : </strong></label>
                        <input type="text" value="<?= $admin->email; ?>" class="form-control" name="email" placeholder="enter valid email ..." required>
                    </div>
                    <div class="form-group">
                        <label><strong>Password : </strong></label>
                        <input type="text" value="<?= $admin->password ?>" class="form-control" name="password" placeholder="enter strong password ..." required>
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
                    </button 
                    </form>
            </div>
        </div>
    </div>
</div>