<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="float-left font-weight-bold text-primary">Data <?= $title ?></h6>
            <a href="<?= base_url('admin/kategori/create') ?>" class="btn btn-success btn-sm float-right">+ Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th width='15%'>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($kategori as $data) :

                        ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td> 
                                <a href="<?= base_url('admin/kategori/update/').$data['id'];?>" class="btn btn-warning btn-circle btn-sm" alt="edit">
                                        <i class="fas fa-book"></i>
                                    </a>
                                    <a href="<?= base_url('admin/kategori/delete/').$data['id'];?>" class="btn btn-danger btn-circle btn-sm" alt="delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>