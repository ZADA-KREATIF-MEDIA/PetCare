<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>


<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800">Data Ganti Kurir</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4 border-left-danger">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><a href="<?//= base_url('admin/customers/export') ?>" class="btn btn-outline-success btn-sm pull-right"><i class="fa fa-file-excel"></i> Export Excel</a></h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>TRX ID</th>
            <th>Alamat</th>
            <th>Tanggal</th>
            <th>Koordinat</th>
            <th>Jarak Sebelumnya</th>
            <th>Driver Sebelumnya</th>
            <th>Driver Pengganti</th>
          </tr>
        </thead>
       
        <tbody>
        <?php
        $no=1;
        foreach($ganti_kurir as $row){
        
        ?>
          <tr>
            <td><?= $row->id_orderan ?></td>
            <td><?= $row->alamat ?></td>
            <td><?= tanggal_indo($row->tanggal) ?></td>
            <td><?= $row->koordinat ?></td>
            <td><?= $row->jarak_tempuh_driver_lama ?></td>
            <td><?= ucwords($row->driver_lama) ?></td>
            <td class="d-flex justify-content-center">
                <?php
                    if($row->driver_baru != NULL){
                        echo ucwords($row->driver_baru);
                    }else{
                        echo '<a data-toggle="modal" data-target="#formGantiKurir" data-orderid="'.$row->id_orderan.'" href="#" class="btn btn-danger btn-sm pilih-kurir"><i class="fa fa-retweet"></i> Kurir</a>';
                    }
                ?>
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
<div class="modal fade" id="formGantiKurir" tabindex="-1" role="dialog" aria-labelledby="formGantiKurirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formGantiKurirLabel">Pilih Kurir Untuk Orderan #<span class="pilihkurir-orderId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="pilihkurir" action="<?= base_url('admin/gantikurir/ganti_kurir') ?>" method="post">
          <div class="form-group">
            <label for="">Pilih Kurir</label>
            <input type="hidden" name="id_order" class="value_id_order">
            <select name="id_rider" class="select2 form-control" id="" required style="width: 100%;">
              <?php  
                foreach($drivers as $d){
                  echo "<option value='".$d->id_rider."'>".ucwords($d->nama_rider)."</option>";
                }
              ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <input type="submit" form="pilihkurir" name="submit" class="btn btn-primary" value="Simpan">
      </div>
    </div>
  </div>
</div>