<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form action="<?= base_url('admin/kategori/update_save') ?>" method="POST">
                <input type="hidden" name="id" id="id" value="<?= $kategori->id; ?>"/>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" value="<?= $kategori->nama ?>" placeholder="Masukan nama kategori produk/layanan ....." required>
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>