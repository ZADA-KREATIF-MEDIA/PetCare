<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <form action="<?= base_url('admin/kategori/store') ?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" id="nama_kategori" placeholder="Masukan nama kategori produk/layanan .....">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>