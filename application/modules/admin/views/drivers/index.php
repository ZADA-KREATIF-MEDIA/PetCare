
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800">Data Kurir</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4 border-left-success">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('admin/drivers/create') ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Kurir</a></h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php //if( $this->session->flashdata('success') ): ?>
    <!-- <div class="row mt-2">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?//= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div> -->
    <?php //endif; ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Profile</th>
            <th>Nama</th>
            <th>Handphone</th>
            <th>Alamat</th>
            <th>No.Plat</th>
            <th>Bergabung</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
       
        <tbody>
        <?php
        $no=1;
        foreach($drivers as $row){
        
        ?>
          <tr>
            <td width="10%">
            <?php if(empty($row->foto)){ ?>
              <a href="<?= base_url('assets/backend/img/driver/profile.png') ?>" target="_blank">
              <img src="<?= base_url('assets/backend/img/driver/profile.png') ?>" class="img-thumbnail" alt="<?= "photo ".$row->nama_rider ?>" width="100%"/></a>
            <?php }else{ ?>
              <a href="<?= base_url('assets/backend/img/driver/'.$row->foto) ?>" target="_blank">
              <img src="<?= base_url('assets/backend/img/driver/'.$row->foto) ?>" class="img-thumbnail" alt="<?= "photo ".$row->nama_rider ?>" width="100%"/></a>
            <?php } ?>
            </td>
            <td><?= ucwords($row->nama_rider) ?></td>
            <td><?= $row->no_telpn ?></td>
            <td><?= $row->alamat ?></td>
            <td width="15%"><?= strtoupper($row->plat_nomor) ?></td>
            <td><?= tanggal_indo($row->tanggal_bergabung) ?></td>
            <td><?= ucwords($row->status) ?></td>
            <th>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="<?= base_url('admin/drivers/edit/').$row->id_rider ?>">Edit</a>
                    <a class="dropdown-item button-konfirmasi" data-konfirmasi="Data kurir akan dihapus" href="<?= base_url('admin/drivers/delete/').$row->id_rider ?>">Hapus</a>
                    <a class="dropdown-item button-konfirmasi text-danger" data-konfirmasi="Status kurir akan di nonaktifkan" href="<?= base_url('admin/drivers/status_driver/'.$row->id_rider.'/'.$row->status) ?>">
                      <?= $row->status=="aktif" ? "Blokir Kurir" : "Aktifkan" ?>
                    </a>
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