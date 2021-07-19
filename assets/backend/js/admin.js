const flashData = $('.flash-data').data('flashdata');
const flashDanger = $('.flash-danger').data('flashdata');

  if( flashData ){
      Swal.fire({
          title: 'Sukses',
          text: flashData,
          type: 'success'
      });
  }
  if( flashDanger ){
      Swal.fire({
          title: 'Gagal',
          text: flashDanger,
          type: 'warning'
      });
  }
$('.select2').select2();

$('.edit-iklan').on('click', function (e) {
  e.preventDefault();
  var idiklan = $(this).data('idiklan');
  var gambariklan = $(this).data('gambariklan');
  var status = $(this).data('status');

  $("#form-iklan").attr('action','tarif/update_iklan');
  $(".modal-title").html("Edit Banner Iklan");
  $("#info").html("Kosongkan gambar jika tetap menggunakan gambar sebelumnya");
  $("#id_iklan").val(idiklan);
  $("#old_image").val(gambariklan);
  $("#gambar_iklan").removeAttr("required");

  if(status=="aktif"){
    $("#aktif_statusiklan").val(status).prop('checked', true);
  }else{
    $("#tidak_statusiklan").val(status).prop('checked', true);
  }
});

$('.edit-tarif').on('click', function (e) {
  e.preventDefault();
  var idtarif = $(this).data('idtarif');
  var jarakminimal = $(this).data('jarakminimal');
  var statusjarakminimal = $(this).data('statusjarakminimal');
  var hargajarakminimal = $(this).data('hargajarakminimal');
  var harga = $(this).data('harga');
  var kategoriharga = $(this).data('kategoriharga');

  $("#formtarif").attr('action','tarif/update_tarif_ongkir');
  $(".modal-title").html("Edit Tarif Ongkir");
  $("#id_tarif").val(idtarif);
  $("#jarak_minimal").val(jarakminimal);

  if(statusjarakminimal=="aktif"){
    $("#aktif").val(statusjarakminimal).prop('checked', true);
  }else{
    $("#tidak").val(statusjarakminimal).prop('checked', true);
  }
  $("#harga_jarak_minimal").val(hargajarakminimal);
  $("#harga").val(harga);
  if(kategoriharga == "customer"){
    $("#customer").val(kategoriharga).prop('checked', true);
  }else{
    $("#member").val(kategoriharga).prop('checked', true);
  }
});

$('.edit-tarifBarang').on('click', function (e) {
  e.preventDefault();
  var idtarifbarang = $(this).data('idtarifbarang');
  var hargaoverweight = $(this).data('hargaoverweight');
  var hargaoversize = $(this).data('hargaoversize');
  var harganormal = $(this).data('harganormal');
  var kategori = $(this).data('kategori');
  var status = $(this).data('status');

  $("#form-tarifbarang").attr('action','tarif/update_tarif_barang');
  $(".modal-title").html("Edit Tarif Barang");
  $("#id_tarif_barang").val(idtarifbarang);
  $("#harga_overweight").val(hargaoverweight);
  $("#harga_oversize").val(hargaoversize);
  $("#harga_normal").val(harganormal);
  
  if(status=="aktif"){
    $("#aktif_tarifbarang").val(status).prop('checked', true);
  }else{
    $("#tidak_tarifbarang").val(status).prop('checked', true);
  }
  
  if(kategori == "customer"){
    $("#customer_tarifbarang").val(kategori).prop('checked', true);
  }else if(kategori == "member"){
    $("#member_tarifbarang").val(kategori).prop('checked', true);
  }else{
    $("#b2b_tarifbarang").val(kategori).prop('checked', true);
  }
});

$('.tambah-tarifBarang').on('click', function (e) {
  e.preventDefault();

  $("#form-tarifbarang").attr('action','tarif/create_tarif_barang');
  $(".modal-title").html("Tambah Tarif Barang");
  $("#id_tarif_barang").val();
  $("#harga_overweight").val();
  $("#harga_oversize").val()
  $("#harga_normal").val()
  $("#aktif").val('aktif');
  $("#tidak").val('tidak');
  $("#customer").val('customer');
  $("#member").val('member');
  $("#b2b").val('B2B');
  
});

$('.tambah-tarif').on('click', function (e) {
  e.preventDefault();

  $("#formtarif").attr('action','tarif/create_tarif_ongkir');
  $(".modal-title").html("Tambah Tarif Ongkir");
  $("#id_tarif").val();
  $("#jarak_minimal").val();
  $("#aktif").val('aktif')
  $("#tidak").val('tidak')
  $("#harga_jarak_minimal").val();
  $("#harga").val();
  $("#customer").val('customer');
  $("#member").val('member');
  
});
$('.edit-user').on('click', function (e) {
  e.preventDefault();
  var idadmin  = $(this).data('idadmin');
  var username = $(this).data('username');
  var level = $(this).data('level');
  var status = $(this).data('status');

  $("#form-user").attr('action','users/update');
  $(".modal-title").html("Edit User");
  $("#id_admin").val(idadmin);
  $("#username").val(username);
  $("#pwdHelp").html("Kosongkan password jika tidak akan diubah");
  $("#level").val(level).prop('selected');
  if(status=="aktif"){
    $("#aktif").val(status).prop('checked', true);
  }else{
    $("#tidak").val(status).prop('checked', true);
  }
  
});
$('.tambah-user').on('click', function (e) {
  e.preventDefault();

  $("#form-user").attr('action','users/create');
  $(".modal-title").html("Tambah User");
  $("#id_admin").val();
  $("#pwdHelp").html();
  $("#username").val();
  $("#aktif").val('aktif')
  $("#tidak").val('tidak')
  
});

$('.detail-customer').on('click', function (e) {
  e.preventDefault();
  var customer = $(this).data('customer');
  var bergabung = $(this).data('bergabung');
  var status = $(this).data('status');
  var level = $(this).data('level');
  var kodereferal = $(this).data('kodereferal');
  var diskon = $(this).data('diskon');

  if(bergabung){
    $(".modal-cust-name").html(customer);
    $(".bergabung").html(bergabung);
    $(".status").html(status);
    $(".level").html(level);
    if(kodereferal == ''){
      $(".kodereferal").html('-');
    }else{
      $(".kodereferal").html(kodereferal);
    }
    if(diskon == 0){
      $(".diskon").html('0 %');
    }else{
      $(".diskon").html(diskon+"%");
    }
  }
});
$('.setting-diskon').on('click', function (e) {
  e.preventDefault();
  var customer = $(this).data('customer');
  var id_customer = $(this).data('idcustomer');
  var diskon = $(this).data('diskon');

    $(".modal-cust-name").html(customer);
    $("#id_cust_diskon").val(id_customer);

    if(diskon == 0){
      $("#diskon").val(0);
    }else{
      $("#diskon").val(diskon);
    }
  
});

$('.pilih-kurir').on('click', function (e) {
  e.preventDefault();
  var orderid = $(this).data('orderid');
  $(".pilihkurir-orderId").html(orderid);
  $(".value_id_order").val(orderid);
});

$('.bayar-billing').on('click', function (e) {
  e.preventDefault();
  var orderid = $(this).data('orderid');
  var totalbayarrp = $(this).data('totalbayarrp');
  var totalbayar = $(this).data('totalbayar');
  var paid = $(this).data('paid');

  $(".billing-orderid").html(orderid);
  $("#id_order").val(orderid);
  $("#total_bayar").val(totalbayar);
  $("#dibayar").val(paid);
  $(".billing-totalbayar").html(totalbayarrp);
  $(".billing-dibayar").html(paid);
});

$('.password-customer').on('click', function (e) {
  e.preventDefault();
  var idcustomer = $(this).data('idcustomer');
  var namacustomer = $(this).data('namacustomer');

  $(".passwordcust-name").html(namacustomer);
  $("#id_customer").val(idcustomer);

});


$('.detail-order').on('click', function (e) {
  e.preventDefault();
  var orderid = $(this).data('orderid');
  var alamatasal = $(this).data('alamatasal');
  var alamattujuan = $(this).data('alamattujuan');
  var jarak = $(this).data('jarak');
  var verifikasidriver = $(this).data('verifikasidriver');
  var kodereferal = $(this).data('kodereferal');
  var notelppenerima = $(this).data('notelppenerima');
  var notelppengirim = $(this).data('notelppengirim');
  var penerima = $(this).data('penerima');
  var pengirim = $(this).data('pengirim');
  var volumebarang = $(this).data('volumebarang');
  var beratbarang = $(this).data('beratbarang');
  var ongkir = $(this).data('ongkir');
  var subtotal = $(this).data('subtotal');
  var catatan = $(this).data('catatan');
  var gambarpengambilan = $(this).data('gambarpengambilan');
  var gambarpengantaran = $(this).data('gambarpengantaran');
  var kondisibarang = $(this).data('kondisibarang');
  var denda = $(this).data('denda');
  var jenispembayaran = $(this).data('jenispembayaran');
  var diskon = $(this).data('diskon');
  var paid = $(this).data('paid');
  var paidby = $(this).data('paidby');
  var patokanasal = $(this).data('patokanasal');
  var patokantujuan = $(this).data('patokantujuan');
  var hargabarang = $(this).data('hargabarang');
  var hargacod = $(this).data('hargacod');

  if(alamatasal){
    $(".modal-orderId").html(orderid);
    $(".patokanasal").html(patokanasal);
    $(".patokantujuan").html(patokantujuan);
    $(".paidby").html(paidby);
    $(".hargabarang").html("Rp."+hargabarang);
    $(".hargacod").html("Rp."+hargacod);
    $(".alamatasal").html(alamatasal);
    $(".alamattujuan").html(alamattujuan);
    if(jarak != ''){
      $(".jarak").html(jarak+" km");
    }else{
      $(".jarak").html("");
    }
    
    if(kodereferal == ''){
      $(".kodereferal").html('-');
    }else{
      $(".kodereferal").html(kodereferal);
    }

    $(".pengirim").html(pengirim+" ( "+notelppengirim+" )");
    $(".penerima").html(penerima+" ( "+notelppenerima+" )");
    // $(".notelppengirim").html(notelppengirim);
    // $(".notelppenerima").html(notelppenerima);
    $(".volumebarang").html(volumebarang);
    $(".jenispembayaran").html(jenispembayaran);
    $(".diskon").html("Rp."+diskon);
    $(".ongkir").html("Rp."+ongkir);
    $(".subtotal").html("Rp."+subtotal);
    $(".beratbarang").html(beratbarang+" kg");
    $(".catatan").html(catatan);
    $(".denda").html("Rp."+denda);
    $(".paid").html("Rp."+paid);
    

    if(gambarpengambilan != ''){
      $(".gambarpengambilan").html('<a href="../assets/frontend/img/foto_ambil/'+gambarpengambilan+'" class="" target="_blank">Lihat Gambar</a>');
    }else{
      $(".gambarpengambilan").html("<span class='text-danger'>Gambar Kosong</span>");
    }
    if(gambarpengantaran != ''){
      $(".gambarpengantaran").html('<a href="../assets/frontend/img/foto_antar/'+gambarpengantaran+'" class="" target="_blank">Lihat Gambar</a>');
    }else{
      $(".gambarpengantaran").html("<span class='text-danger'>Gambar Kosong</span>");
    }
    $(".kondisibarang").html(kondisibarang);
  }
});


//tombol-hapus

$('.button-konfirmasi').on('click', function (e) {
  e.preventDefault();
  const href = $(this).attr('href');
  const pesan_konfirm = $(this).data('konfirmasi');

  Swal.fire({
      title: 'Apakah Anda Yakin ?',
      text: pesan_konfirm,
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText:'Batal',
      confirmButtonText: 'Ya, Konfirmasi!'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
})