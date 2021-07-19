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
                <h6 class="m-0 font-weight-bold text-primary">Data Users <sup>Klik untuk minimize</sup>
                <a href="#" data-toggle="modal" data-target="#formuser" class="btn btn-primary btn-sm float-right tambah-user"><i class="fa fa-plus"></i> User</a></h6>
            </a>
        </div>
        <div class="collapse show" id="collapseFilterData">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                
                    <tbody>
                    <?php
                    $no=1;
                    foreach($users as $row){
                    
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->username ?></td>
                        <td>
                        <?php
                            if($row->level == 1){
                                echo "Superadmin";
                            }else if($row->level ==2){
                                echo "Admin";
                            }else{
                                echo "Operator";
                            }
                        ?></td>
                        <td><?= ucwords($row->status) ?></td>
                      
                        <th>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item edit-user" data-toggle="modal" data-target="#formuser" href="#" data-idadmin="<?= $row->id_admin ?>" data-username="<?= $row->username ?>" data-level="<?= $row->level ?>" data-status="<?= $row->status ?>">Edit</a>
                                <a class="dropdown-item button-konfirmasi text-primary" data-konfirmasi="Status user akan di nonaktifkan" href="<?= base_url('admin/users/status_user/'.$row->id_admin.'/'.$row->status) ?>">
                                <?= $row->status=="aktif" ? "Blokir User" : "Aktifkan" ?>
                                </a>
                                <a class="dropdown-item button-konfirmasi text-danger" data-konfirmasi="Data ini akan dihapus" href="<?= base_url('admin/users/delete/').$row->id_admin ?>">Hapus</a>
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

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="formuser" tabindex="-1" role="dialog" aria-labelledby="formuserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formuserLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="form-user">
            <div class="form-group">
                <label for="">Username</label>
                <input type="hidden" name="id_admin" id="id_admin">
                <input type="varchar" name="username" class="form-control" id="username" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" id="password" minlength="6">
                <small id="pwdHelp" class="form-text text-muted"></small>

            </div>
            <div class="form-group">
                <label for="">Level</label>
                <?php if($this->session->userdata('level') == 1){ ?>
                <select name="level" id="level" class="form-control">
                    <option value="2">Admin</option>
                    <option value="3">Operator</option>
                </select>
                <?php }else{ ?>
                    <input type="hidden" name="level" class="form-control" value="3">
                    <input type="text" class="form-control" readonly value="Operator">
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="aktif" value="aktif">
                    <label class="form-check-label" for="">
                        Aktif
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="tidak" value="tidak">
                    <label class="form-check-label" for="">
                        Tidak
                    </label>
                </div>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" form="form-user" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>