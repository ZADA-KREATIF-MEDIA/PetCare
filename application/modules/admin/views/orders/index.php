<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>
<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800">Data Pesanan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4 border-left-danger">
  <!-- <div class="card-header py-3"> -->
    <!-- <h6 class="m-0 font-weight-bold text-primary">Orders Data</h6> -->
  <!-- </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>TRX ID</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Kab.Asal</th>
            <th>Kab.Tujuan</th>
            <th>Total</th>
            <th>Status</th>
            <th>Bayar</th>
            <th>Kurir</th>
            <th></th>
          </tr>
        </thead>
       
        <tbody>
        <?php
        $no=1;
        foreach($orders as $row){
        
        ?>
          <tr>
            <td><?= $row->id_order ?></td>
            <td><?= ucwords($row->nama) ?></td>
            <td><?= tanggal_indo($row->tanggal_order) ?></td>
            <td><?= ucwords($row->kabupaten_asal) ?></td>
            <td><?= ucwords($row->kabupaten_tujuan) ?></td>
            <td><?= format_rupiah($row->total) ?></td>
            <td>
                <?php 
                $denda = ($row->total - $row->harga_cod) - $row->ongkir;

                $order = $row->status_order;
                if($order == "order"){
                    echo "<span class='badge badge-primary'>Order</span>";
                }else if($order == "proses"){
                    echo "<span class='badge badge-warning'>Proses</span>";
                }else if($order == "selesai"){
                    echo "<span class='badge badge-success'>Selesai</span>";
                }else{
                    echo "<span class='badge badge-danger'>Batal</span>";
                }
                ?>
            </td>
             <td><?= ucwords($row->status_pembayaran) ?></td>
             <td><?= $row->nama_rider=='' ? '-' : ucwords($row->nama_rider) ?></td>
             <th>
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Aksi
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a data-toggle="modal" data-target="#detailOrder" class="dropdown-item detail-order" href="#" data-orderid="<?= $row->id_order ?>" data-alamatasal="<?= $row->alamat_asal.' <b> [ '.$row->koordinat_asal.' </b>] ' ?>" data-alamattujuan="<?= $row->alamat_tujuan.' <b> [ '.$row->koordinat_tujuan.' ] </b>' ?>" data-jarak="<?= $row->jarak ?>" data-verifikasidriver="<?= ucwords($row->verifikasi_driver) ?>" data-notelppenerima="<?= $row->no_telpn_penerima ?>" data-kodereferal="<?= $row->referal_code ?>" data-penerima="<?= ucwords($row->nama_penerima) ?>" data-volumebarang="<?= $row->volume_barang ?>" data-beratbarang="<?= $row->berat_barang ?>" data-catatan="<?= $row->catatan ?>" data-gambarpengambilan="<?= $row->gambar_pengambilan ?>" data-gambarpengantaran="<?= $row->gambar_pengantaran ?>" data-kondisibarang="<?= $row->kondisi_barang ?>" data-pengirim="<?= ucwords($row->nama_pengirim) ?>" data-notelppengirim="<?= $row->no_telpn_pengirim ?>" data-ongkir="<?= format_rupiah($row->ongkir) ?>" data-subtotal="<?= format_rupiah($row->ongkir) ?>" data-denda="<?= format_rupiah($denda) ?>" data-jenispembayaran="<?= ucwords($row->jenis_pembayaran) ?>" data-diskon="<?= format_rupiah($row->diskon) ?>" data-paid="<?= format_rupiah($row->paid) ?>" data-paidby="<?= ucwords($row->paid_by) ?>" data-hargacod="<?= format_rupiah($row->harga_cod) ?>" data-patokanasal="<?= $row->patokan_asal ?>" data-patokantujuan="<?= $row->patokan_tujuan ?>" data-hargabarang="<?= format_rupiah($row->harga_cod) ?>">Detail</a>
                  <?php if($row->nama_rider == "" && $order == "order"){ ?>
                  <a data-toggle="modal" data-target="#formPilihKurir" data-orderid="<?= $row->id_order ?>" href="#" class="dropdown-item pilih-kurir text-success">Pilih Kurir</a>
                  <?php }
                    if($order == "order"){
                  ?>
                    <a class="dropdown-item button-konfirmasi text-danger" data-konfirmasi="Akan membatalkan pesanan ini" href="<?= base_url('admin/orders/batal_pesanan/').$row->id_order ?>">Batalkan</a>
                  <?php
                    }
                    if(strtolower($row->jenis_pembayaran) == "billing" || strtolower($row->jenis_pembayaran) == "cod billing"){
                      if($row->status_pembayaran != "lunas"){
                  ?>
                    <a data-toggle="modal" data-target="#bayarBilling" class="dropdown-item bayar-billing text-primary" href="#" data-orderid="<?= $row->id_order ?>" data-totalbayarrp="<?= format_rupiah($row->total) ?>" data-totalbayar="<?= $row->total ?>" data-paid="<?= format_rupiah($row->paid) ?>">Bayar</a>
                  <?php }} ?>
                  <?php if($row->status_pembayaran == "belum" && $order != "batal"){ ?>
                  <a class="dropdown-item button-konfirmasi text-success" data-konfirmasi="Ubah status bayar menjadi lunas" href="<?= base_url('admin/orders/lunas_bayar/').$row->id_order ?>">Lunas Bayar</a>
                  <?php } ?>
                  
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

<div class="modal fade" id="bayarBilling" tabindex="-1" role="dialog" aria-labelledby="bayarBillingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bayarBillingLabel">Pembayaran Billing Orderan #<span class="billing-orderid"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/orders/paid_billing') ?>" method="post" id="billingPaid">
          <div class="form-group">
            <label>Nominal Bayar</label>
            <input type="hidden" name="id_order" value="id_order" id="id_order">
            <input type="hidden" name="total_bayar" value="total_bayar" id="total_bayar">
            <input type="hidden" name="dibayar" value="dibayar" id="dibayar">
            <input type="number" name="paid" class="form-control" id="paid" required placeholder="nominal bayar...">
            <small id="emailHelp" class="form-text text-muted">Jika nominal bayar sama dengan total bayar, maka secara otomatis status pembayaran akan diverifikasi menjadi lunas</small>
            <small id="emailHelp" class="form-text h5 mt-2 text-danger">Total Bayar (Rp) : <span class="billing-totalbayar"></span></small>
            <small id="emailHelp" class="form-text h5 mt-2 text-danger">Dibayar (Rp) : <span class="billing-dibayar"></span></small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" form="billingPaid" name="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="formPilihKurir" tabindex="-1" role="dialog" aria-labelledby="formPilihKurirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formPilihKurirLabel">Pilih Kurir Untuk Orderan #<span class="pilihkurir-orderId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="pilihkurir" action="<?= base_url('admin/orders/pilih_kurir') ?>" method="post">
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

<div class="modal fade" id="detailOrder" tabindex="-1" role="dialog" aria-labelledby="detailOrderLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailOrderLabel">Detail Order #<span class="modal-orderId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table width="100" class="table table-borderless">
            <tr>
                <th width="10%">Asal</th>
                <th>:</th>
                <td colspan="2" class="alamatasal"></td>
            </tr>
            <tr>
                <th>Tujuan</th>
                <th>:</th>
                <td colspan="2" class="alamattujuan"></td>
            </tr>
        </table>
        <div class="row">
          <div class="col-md-5">
            <table class="table table-borderless">
              <tr>
                <th width="30%">Titik Jemput</th>
                <td class="patokanasal"></td>
              </tr>
              <tr>
                <th>Titik Antar</th>
                <td class="patokantujuan"></td>
              </tr>
              <tr>
                <th>Pengirim</th>
                <td class="pengirim"></td>
              </tr>
              <tr>
                <th>Penerima</th>
                <td class="penerima"></td>
              </tr>
              <tr>
                <th>Jarak</th>
                <td class="jarak"></td>
              </tr>
              <tr>
                <th>Cara Bayar</th>
                <td class="jenispembayaran"></td>
              </tr>
            </table>
          </div>
          <div class="col-md-3">
              <table class="table table-borderless">
                <tr>
                <th>Ongkir</th>
                <td class="ongkir"></td>
                </tr>
                <tr>
                  <th>Subtotal</th>
                  <td class="subtotal"></td>
                </tr>
                <tr>
                  <th>Denda</th>
                  <td class="denda"></td>
                </tr>
                <tr>
                  <th>Harga Barang</th>
                  <td class="hargacod"></td>
                </tr>
                <tr>
                  <th>Diskon</th>
                  <td class="diskon"></td>
                </tr>
                <tr>
                  <th>Terbayar</th>
                  <td class="paid"></td>
                </tr>
              </table>
          </div>
          <div class="col-md-4">
            <table class="table table-borderless">
              
              <tr style="display:none">
                <th>Volume</th>
                <td class="volumebarang"></td>
              </tr>
              <tr style="display:none">
                <th>Berat</th>
                <td class="beratbarang"></td>
              </tr>
              <tr>
                <th>Kode Referal</th>
                <td class="kodereferal"></td>
              </tr>
              <tr>
                <th>Dibayar Oleh</th>
                <td class="paidby"></td>
              </tr>
              <tr>
                <th>Pengambilan</th>
                <td class="gambarpengambilan"></td>
              </tr>
              <tr>
                <th>Pengantaran</th>
                <td class="gambarpengantaran"></td>
              </tr>
              <tr>
                <th>Catatan</th>
                <td class="catatan"></td>
              </tr>
              <tr>
                <th>Kondisi</th>
                <td class="kondisibarang"></td>
              </tr>
              
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>