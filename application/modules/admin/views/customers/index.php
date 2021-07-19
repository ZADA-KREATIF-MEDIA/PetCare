<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>


<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800">Data Pelanggan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4 border-left-warning">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><a href="<?//= base_url('admin/customers/export') ?>" class="btn btn-outline-success btn-sm pull-right"><i class="fa fa-file-excel"></i> Export Excel</a></h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataPelanggan" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Handphone</th>
            <th>Level</th>
            <th></th>
          </tr>
        </thead>
       
        <tbody>
        <?php
        $no=1;
        foreach($customers as $row){
        
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td width="30%"><?= ucwords($row->nama) ?></td>
            <td><?= $row->email ?></td>
            <td><?= $row->alamat ?></td>
            <td><?= $row->no_telpn ?></td>
            <td><?= ucwords($row->level) ?></td>
            <th>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a data-toggle="modal" data-target="#detailCustomer" class="dropdown-item detail-customer" href="#" data-customer="<?= ucwords($row->nama); ?>" data-kodereferal="<?= $row->referal_code; ?>" data-bergabung="<?= tanggal_indo($row->tanggal_bergabung); ?>" data-level="<?= ucwords($row->level); ?>" data-status="<?= ucwords($row->status); ?>" data-diskon="<?= $row->diskon; ?>">Detail</a>
                    <?php if($row->level == "customer"){ ?>
                    <a class="dropdown-item button-konfirmasi text-success" data-konfirmasi="Pelanggan ini akan menjadi member" href="<?= base_url('admin/customers/verifikasi_member/').$row->id_customer ?>">Verifikasi Member</a>
                    <?php } ?>
                    <?php if($row->level == "member"){ ?>
                    <a data-toggle="modal" data-target="#formSettingDiskon" class="dropdown-item setting-diskon text-success" href="#" data-idcustomer="<?= $row->id_customer ?>" data-customer="<?= ucwords($row->nama); ?>" data-diskon="<?= $row->diskon; ?>">Setting Diskon</a>
                    <?php } ?>
                    <a class="dropdown-item button-konfirmasi text-danger" data-konfirmasi="Status pelanggan ini akan di nonaktifkan" href="<?= base_url('admin/customers/status_customer/'.$row->id_customer.'/'.$row->status) ?>">
                      <?= $row->status=="aktif" ? "Blokir Pelanggan" : "Aktifkan" ?>
                    </a>
                    <a data-toggle="modal" data-target="#editPasswordCustomer" class="dropdown-item password-customer" href="#" data-idcustomer="<?= $row->id_customer ?>" data-namacustomer="<?= ucwords($row->nama) ?>">Edit Password</a>
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
<!-- /.container-fluid -->


<div class="modal fade" id="editPasswordCustomer" tabindex="-1" role="dialog" aria-labelledby="editPasswordCustomerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPasswordCustomerLabel">Edit Password <span class="passwordcust-name"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/customers/edit_password') ?>" method="post" id="passwordcust">
          <div class="form-group">
            <label>Password Baru <sup class="text-danger">panjang miniman 6 karakter</sup></label>
            <input type="hidden" name="id_customer" value="id_customer" id="id_customer">
            <input type="text" name="password" class="form-control" id="password" minlength="6" required placeholder="masukkan password baru...">
            <small id="" class="form-text text-danger">Jika mengubah password, maka password yang lama akan dihapus</small>
           
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" form="passwordcust" name="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="detailCustomer" tabindex="-1" role="dialog" aria-labelledby="detailCustomerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailCustomerLabel">Detail Pelanggan <span class="modal-cust-name"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table width="100" class="table">
          <thead>
            <tr>
                <th>Tanggal Bergabung</th>
                <th>:</th>
                <td class="bergabung"></td>
            </tr>
            <tr>
                <th>Status</th>
                <th>:</th>
                <td class="status"></td>
            </tr>
            <tr>
                <th>Level</th>
                <th>:</th>
                <td class="level"></td>
            </tr>
            <tr>
                <th>Kode Referal</th>
                <th>:</th>
                <td class="kodereferal"></td>
            </tr>
            <tr>
                <th>Diskon</th>
                <th>:</th>
                <td class="diskon"></td>
            </tr>
            
          </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="formSettingDiskon" tabindex="-1" role="dialog" aria-labelledby="formSettingDiskonLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formSettingDiskonLabel">Setting Diskon Pelanggan <span class="modal-cust-name"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/customers/setting_diskon') ?>" id="setting_diskon" method="post">
            <div class="form-group">
                <input type="hidden" name="id_customer" id="id_cust_diskon">
                <input type="number" name="diskon" class="form-control" id="diskon" placeholder="Jumlah diskon 0-100 (%)" min="0" max="100" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" name="submit" form="setting_diskon" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>