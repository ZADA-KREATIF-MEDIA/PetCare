<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3">
            <a href="#collapseFilterData" class="" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseFilterData">
                <h6 class="m-0 font-weight-bold text-primary">Setting Tarif Ongkir <sup>Klik untuk minimize</sup>
                <a href="#" data-toggle="modal" data-target="#formTarif" class="btn btn-primary btn-sm float-right tambah-tarif"><i class="fa fa-plus"></i> Tarif Ongkir</a></h6>
            </a>
        </div>
        <div class="collapse show" id="collapseFilterData">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Jarak Min</th>
                        <th>Status Jarak</th>
                        <th>Harga Jarak Min</th>
                        <th>Harga</th>
                        <th>Kategori Harga</th>
                        <th></th>
                    </tr>
                    </thead>
                
                    <tbody>
                    <?php
                    $no=1;
                    foreach($tarifongkir as $row){
                    
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->jarak_minimal." km" ?></td>
                        <td><?= ucwords($row->status_jarak_minimal) ?></td>
                        <td><?= "Rp. ".format_rupiah($row->harga_jarak_minimal) ?></td>
                        <td><?= "Rp. ".format_rupiah($row->harga) ?></td>
                        <td><?= ucwords($row->kategori_harga) ?></td>
                        <th>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item edit-tarif" data-toggle="modal" data-target="#formTarif" href="#" data-idtarif="<?= $row->id ?>" data-jarakminimal="<?= $row->jarak_minimal ?>" data-statusjarakminimal="<?= $row->status_jarak_minimal ?>" data-hargajarakminimal="<?= $row->harga_jarak_minimal ?>" data-harga="<?= $row->harga ?>" data-kategoriharga="<?= $row->kategori_harga ?>">Edit</a>
                                <a class="dropdown-item button-konfirmasi text-danger" data-konfirmasi="Data tarif ongkir akan dihapus" href="<?= base_url('admin/tarif/delete_ongkir/').$row->id ?>">Hapus</a>
                                
                                </div>
                            </div>
                        </th>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    

    <div class="card shadow mb-4 border-left-warning">
        <div class="card-header py-3">
            <a href="#collapseIklan" class="" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseIklan">
                <h6 class="m-0 font-weight-bold text-primary">Setting Iklan <sup>Klik untuk minimize</sup>
                <a href="#" data-toggle="modal" data-target="#formIklan" class="btn btn-primary btn-sm float-right tambah-iklan"><i class="fa fa-plus"></i> Iklan</a></h6>
            </a>
        </div>
        <div class="collapse show" id="collapseIklan">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar<sup class="text-danger">* Klik gambar untuk melihat ukuran lebih besar</sup></th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                
                    <tbody>
                    <?php
                    $no=1;
                    foreach($iklan as $row){
                    
                    ?>
                    <tr>
                        <td width="5%"><?= $no++ ?></td>
                        <td clas="text-center">
                            <center><a href="<?= base_url('assets/frontend/img/iklan/'.$row->gambar_iklan) ?>" target="_blank">
                            <img src="<?= base_url('assets/frontend/img/iklan/'.$row->gambar_iklan) ?>" class="img-thumbnail" alt="gambar iklan"  width="15%">
                            </a></center>    
                        </td>
                        <td><?= $row->status=="aktif" ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Nonaktif</span>" ?></td>
                      
                        <td width="15%">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item edit-iklan" data-toggle="modal" data-target="#formIklan" href="#" data-idiklan="<?= $row->id_iklan ?>" data-gambariklan="<?= $row->gambar_iklan ?>" data-status="<?= $row->status ?>">Edit</a>
                                <a class="dropdown-item button-konfirmasi text-success" href="<?= base_url('admin/tarif/status_iklan/'.$row->id_iklan.'/'.$row->status) ?>">
                                <?= $row->status=="aktif" ? "Nonaktifkan" : "Aktifkan" ?></a>
                                <a class="dropdown-item button-konfirmasi text-danger" data-konfirmasi="Iklan ini akan di hapus" href="<?= base_url('admin/tarif/delete_iklan/'.$row->id_iklan) ?>">
                                Hapus
                                </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="formTarif" tabindex="-1" role="dialog" aria-labelledby="formTarifLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formTarifLabel">Tambah Tarif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="formtarif">
            <div class="form-group">
                <label for="">Jarak Minimal</label>
                <input type="hidden" name="id_tarif" id="id_tarif">
                <input type="number" name="jarak_minimal" class="form-control" id="jarak_minimal" required>
            </div>
            <div class="form-group">
                <label for="">Harga Jarak Minimal</label>
                <input type="number" name="harga_jarak_minimal" class="form-control" id="harga_jarak_minimal" required>
            </div>
            <div class="form-group">
                <label for="">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Status Jarak Min</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_jarak_minimal" id="aktif" value="aktif">
                            <label class="form-check-label" for="">
                                Aktif
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_jarak_minimal" id="tidak" value="tidak">
                            <label class="form-check-label" for="">
                                Tidak
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kategori Harga</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="kategori_harga" id="customer" value="customer">
                            <label class="form-check-label" for="">
                                Customer
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori_harga" id="member" value="member">
                            <label class="form-check-label" for="">
                                Member
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
                    
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" form="formtarif" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!-- ==================================================================== -->
<div class="modal fade" id="formIklan" tabindex="-1" role="dialog" aria-labelledby="formIklanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formIklanLabel">Tambah Banner Iklan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/tarif/create_iklan') ?>" method="post" id="form-iklan" enctype="multipart/form-data">
        
            <div class="form-group">
                <label for="foto">Gambar Iklan</label>
                <input type="hidden" name="id_iklan" id="id_iklan">
                <input type="hidden" name="old_image" id="old_image">
                <input type="file" id="gambar_iklan" name="gambar_iklan" accept=".png,.jpg,.jpeg" class="form-control" required>
                <small id="info" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="aktif_statusiklan" value="aktif" checked>
                    <label class="form-check-label" for="">
                        Aktif
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="tidak_statusiklan" value="tidak">
                    <label class="form-check-label" for="">
                        Tidak
                    </label>
                </div>
            </div>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" form="form-iklan" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>