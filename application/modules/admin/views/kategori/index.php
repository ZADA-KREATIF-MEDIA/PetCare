<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
            <a href="<?= base_url('admin/kategori/create') ?>" class="btn btn-success btn-sm float-right">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th width='15%'>No</th>
                            <th>Nama Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>System Architect</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>