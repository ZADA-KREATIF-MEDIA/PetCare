<!-- Begin Page Content -->
<div class="container-fluid">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>
<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800">Laporan Omset By Member</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4 border-left-success">
    <a href="#collapseFilterData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseFilterData">
        <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
    </a>
    <div class="collapse show" id="collapseFilterData">
        <div class="card-body">
        <form action="" id="form_filter">
            <div class="table-responsive">
                
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="date_start" required value="<?php echo date('Y-m-d'); ?>" >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="date_end" required value="<?php echo date('Y-m-d'); ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Kurir</label>
                                    <select name="kurir" id="" class="select2 form-control" style="width: 100%;">
                                    <option value="">- Pilih Kurir -</option>
                                        <?php foreach($drivers as $d){
                                            echo "<option value='".$d->id_rider."'>".ucwords($d->nama_rider)."</option>";  
                                        } ?>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                    <label>Jenis Pembayaran</label>
                                    <select name="jenis_pembayaran" id="" class="form-control">
                                      <option value="">- Jenis Pembayaran -</option>
                                      <option value="cash">Cash</option>
                                      <option value="cod">COD</option>
                                      <option value="billing">Billing</option>
                                      <option value="cod billing">COD Billing</option>
                                    </select>
                              </div>
                            </div>
                                    
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Member</label>
                                        <select name="member" id="" class="select2 form-control" style="width: 100%;">
                                            <option value="">- Pilih Member -</option>
                                            <?php foreach($members as $c){
                                                echo "<option value='".$c->id_customer."'>".ucwords($c->nama)."</option>";  
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <label>Status Pembayaran</label>
                                  <select name="status_pembayaran" id="" class="form-control">
                                    <option value="">- Status Pembayaran -</option>
                                    <option value="belum">Belum Lunas</option>
                                    <option value="lunas">Lunas</option>
                                  </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="">Jarak Awal</label>
                                    <input type="number" class="form-control" name="jarak_awal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="">Jarak Akhir</label>
                                    <input type="number" class="form-control" name="jarak_akhir">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                
            </div>
        </div>
        <div class="card-footer">
            <input type="reset" name="reset" class="btn btn-secondary" value="Reset">
            <input type="submit" name="submit" class="btn btn-primary" value="Filter">
        </div>
        </form>
    </div>
</div>
<div class="card shadow mb-4 border-left-warning">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
        
      <table class="table table-bordered" id="tables_tar" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!-- <th>No</th> -->
            <th>Tanggal</th>
            <th>Member</th>
            <th>Referal</th>
            <th>Child</th>
            <th>Jarak</th>
            <th>Ongkir</th>
            <th>Kurir</th>
          </tr>
        </thead>
       
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<script>
  var scr_dt = function(argument) {
    var _reportingPel = function() {
      // var dt_tables

      $(document).ready(function() {
        initBankTable();
      })


      var initBankTable = function(data) {
        var dt_tables = $('#tables_tar').DataTable({
          destroy: true,
          processing: true,
          serverSide: false,
          fixedColumns: true,
          stateSave: true,
          ajax: {
            type: "POST",
            url: "<?= base_url('admin/laporan/omset_member_dt') ?>",
            data: function(d) {
              d.filter = getFormData($('#form_filter').serializeArray())
            }
          },
          columns: [
        //     {
        //     data: "no",
        //     defaultContent: "-"
        //   },
          {
            data: "tanggal",
            defaultContent: "-",
            width:"12%"
          },
          {
            data: "member",
            defaultContent: "-"
          },
          {
            data: "kode_referal",
            defaultContent: "-"
          },
          {
            data: "child",
            defaultContent: "-"
          },
          {
            data: "jarak",
            defaultContent: "-"
          },
          {
            data: "ongkir",
            defaultContent: "",
            render: function(data) {
              var iData = $.fn.dataTable.render.number(',').display(data);

              if (data != null) {
                return 'Rp. ' + iData
              } else {
                return "-"
              }

            },
            width:"10%"
          },
          {
            data: "kurir",
            defaultContent: "-"
          }
          ],
          columnDefs: [{
            targets: 0,
            width: "5%",
            searchable: false,
            orderable: true
          },
          {
            targets: 5,
            width: "30%",
            searchable: false,
            orderable: true
          },
          ],
          order: [
          [0, 'asc']
          ],
          autoWidth: true,
          searching: true,
          pageLength: 10,
          scrollY: '45vh',
          scrollX: false,
          scrollCollapse: false,
          dom: '<"datatable-header"fl><"datatable-scroll-wrap"tr><"datatable-footer"iBp>',
          buttons: [
            { extend: 'excelHtml5'},
            { extend: 'csvHtml5'},
            { extend: 'pdfHtml5'}
          ],
          language: {
            search: '<span>Search:</span> _INPUT_',
            searchPlaceholder: 'Type to Search...',
            lengthMenu: '<span>Show:</span> _MENU_',
            emptyTable: 'Tidak Ada Data',
            processing: '<i class="icon-spinner2 spinner"></i> Proses Pengambilan Data Mohon tunggu sebentar',
            paginate: {
              'first': 'First',
              'last': 'Last',
              'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
              'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
            }
          },
        })
        $('#dt_search').keyup(delay(function(event) {
          dt_tables.search($(this).val()).draw()
        }, 500));

        $('#length_datatable').change(function(event) {
          dt_tables.page.len($(this).val()).draw()
        });

        $('#form_filter').submit(function(event) {
          event.preventDefault()
        

          // not use filter
          $('#dropdown_filter').dropdown()
          dt_tables.ajax.reload()

        });
      }
      var getFormData = function(formData) {
        var dataJson = {};
        $.each(formData, function(index, val) {
          dataJson[val.name] = val.value;
        });
        return dataJson;
      }

      const delay = function(callback, ms) {
        var timer = 0;
        return function() {
          var context = this,
          args = arguments;
          clearTimeout(timer);
          timer = setTimeout(function() {
            callback.apply(context, args);
          }, ms || 0);
        };
      }

    }

    return {
      init: function() {
        _reportingPel()
      }
    }
  }()

  document.addEventListener('DOMContentLoaded', function() {
    scr_dt.init()
  })
</script>