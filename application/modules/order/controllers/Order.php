<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel', 'mod');
    }

    public function index()
    {
        // is_logged_in_user();
        $data = [
            'title'     => 'Order',
            'content'   => 'order/index',
            'produk'    =>  $this->mod->getAllProduk()
        ];
        $this->load->view('templates/frontend/index',$data);
    }

    public function show()
    {
        $data = $this->mod->getBarangById($this->input->post('id'));
        echo json_encode($data);
    }

    public function store_keranjang()
    {
        $post = [
            'id_user'   => $this->input->post('id_user'),
            'status'    => 'keranjang',
            'id_produk' => $this->input->post('id_produk'),
            'harga'     => $this->input->post('harga'),
            'catatan'   => $this->input->post('catatan'),
            'jumlah'    => $this->input->post('jumlah_pembelian')
        ];
        $this->mod->storeKeranjang($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan ke keranjang belanja</div>');
        redirect('order');
    }

    public function checkout()
    {
        $cek_keranjang = $this->mod->getAllKeranjang();
        if($cek_keranjang['id_transaksi'] == "" || $cek_keranjang['count_produk'] < 1){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Harap melakukan transaksi terlebih dahulu</div>');
            redirect('order');
        }
        $data = [
            'title'     => 'Checkout',
            'content'   => 'order/checkout',
            'produk'    => $this->mod->getAllKeranjang()
        ];
        $this->load->view('templates/frontend/index',$data);
    }

    public function showDetailKeranjang()
    {
        $dt = $this->mod->getDetailTransaksiById($this->input->post('id'));
        $db = $this->mod->getBarangById($dt['id_produk']);
        $data['id']         = $dt['id'];
        $data['id_produk']  = $db['id'];
        $data['jumlah']     = $dt['jumlah'];
        $data['catatan']    = $dt['catatan'];
        $data['stock']      = $db['stock'];
        $data['harga']      = $db['harga'];
        echo json_encode($data);
    }

    public function updateDetailKeranjang()
    {
        $post = [
            'id'                    => $this->input->post('id'),
            'id_produk'             => $this->input->post('id_produk'),
            'harga'                 => $this->input->post('harga'),
            'catatan'               => $this->input->post('catatan'),
            'jumlah'                => $this->input->post('jumlah_pembelian'),
            'jumlah_sebelumnya'     => $this->input->post('jumlah_sebelumnya')
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->updateKeranjang($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil update keranjang belanja</div>');
        redirect('checkout');
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        $detail = $this->mod->getDetailTransaksiById($id);
        $barang = $this->mod->getBarangById($detail['id_produk']);
        $stock = $barang['stock'] + $detail['jumlah'];
        $post = [
            'id'            => $id,
            'id_produk'     => $barang['id'],
            'stock'         => $stock
        ];
        $this->mod->hapusItemKeranjang($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus barang</div>');
        redirect('order/checkout');
    }

    public function alamat_pengambilan()
    {
        $data = [
            'title'     => 'Alamat Pengambilan',
            'content'   => 'order/alamat_pengambilan'
        ];
        $this->load->view('templates/frontend/index',$data);
    }

    public function update_alamat_pengambilan()
    {
        $post = [
            'id'                    => $this->input->post('id_transaksi'),
            'alamat_pengambilan'    => $this->input->post('alamat_pengambilan'),
            'koordinat_pengambilan' => $this->input->post('latitude').",".$this->input->post('longitude')
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->updateAlamat($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil update alamat pengambilan</div>');
        redirect('order/checkout');
    }

    public function alamat_pengantaran()
    {
        $data = [
            'title'     => 'Alamat Pengantaran',
            'content'   => 'order/alamat_pengantaran'
        ];
        $this->load->view('templates/frontend/index',$data);
    }

    public function update_alamat_pengantaran()
    {
        $post = [
            'id'                    => $this->input->post('id_transaksi'),
            'alamat_pengantaran'    => $this->input->post('alamat_pengantaran'),
            'koordinat_pengantaran' => $this->input->post('latitude').",".$this->input->post('longitude')
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->updateAlamat($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil update alamat pengantaran</div>');
        redirect('order/checkout');
    }

    public function hitung_harga_ongkir()
    {
        $jarak      = explode(" ",$this->input->post('jarak'));
        $dt_ongkir  = $this->mod->getOngkir();
        if($dt_ongkir['status_jarak_minimal'] == "aktif"){
            if($jarak[1] == "km"){
                $cek_selsih_jarak_minimal = $jarak[0] - 5;
                $hitung = round(($dt_ongkir['harga_jarak_minimal'] + ($cek_selsih_jarak_minimal *$dt_ongkir['harga']))*2);
                $hasil['status']    = 'bayar';
                $hasil['harga']     = $hitung;
                $hasil['harga_txt'] = number_format($hitung,0,',','.');
                $hasil['jarak']     = $this->input->post('jarak');
            } else{
                $hasil['status']    = 'free ongkir';
                $hasil['harga']     = 0;
                $hasil['harga_txt'] = 0;
                $hasil['jarak']     = $this->input->post('jarak');
            }
        } else {
            if($jarak[1] == "km"){
                $cek_selsih_jarak_minimal = $jarak[0] - 5;
                $hitung = round(($jarak[0] * $dt_ongkir['harga'])*2);
                $hasil['status']    = 'bayar';
                $hasil['harga']     = $hitung;
                $hasil['harga_txt'] = number_format($hitung,0,',','.');
                $hasil['jarak']     = $this->input->post('jarak');
            } else{
                $hasil['status']    = 'free ongkir';
                $hasil['harga']     =  0;
                $hasil['harga_txt'] =  0;
                $hasil['jarak']     = $this->input->post('jarak');
            }
        }
        $_SESSION['hasil_ongkir'] = $hitung;
        echo json_encode($hasil);
    }

    public function hitung_harga_pengambilan()
    {
        $jarak      = explode(" ",$this->input->post('jarak'));
        $dt_ongkir  = $this->mod->getOngkir();
        if($dt_ongkir['status_jarak_minimal'] == "aktif"){
            if($jarak[1] == "km"){
                $cek_selsih_jarak_minimal = $jarak[0] - 5;
                $hitung = round($dt_ongkir['harga_jarak_minimal'] + ($cek_selsih_jarak_minimal *$dt_ongkir['harga']));
                $hasil['status']    = 'bayar';
                $hasil['harga']     = $hitung;
                $hasil['harga_txt'] = number_format($hitung,0,',','.');
                $hasil['jarak']     = $this->input->post('jarak');
            } else{
                $hasil['status']    = 'free ongkir';
                $hasil['harga']     = 0;
                $hasil['harga_txt'] = 0;
                $hasil['jarak']     = $this->input->post('jarak');
            }
        } else {
            if($jarak[1] == "km"){
                $cek_selsih_jarak_minimal = $jarak[0] - 5;
                $hitung = round($jarak[0] * $dt_ongkir['harga']);
                $hasil['status']    = 'bayar';
                $hasil['harga']     = $hitung;
                $hasil['harga_txt'] = number_format($hitung,0,',','.');
                $hasil['jarak']     = $this->input->post('jarak');
            } else{
                $hasil['status']    = 'free ongkir';
                $hasil['harga']     =  0;
                $hasil['harga_txt'] =  0;
                $hasil['jarak']     = $this->input->post('jarak');
            }
        }
        $_SESSION['hasil_pengambilan'] = $hitung;
        echo json_encode($hasil);
    }

    public function hitung_harga_pengantaran()
    {
        $jarak      = explode(" ",$this->input->post('jarak'));
        $dt_ongkir  = $this->mod->getOngkir();
        if($dt_ongkir['status_jarak_minimal'] == "aktif"){
            if($jarak[1] == "km"){
                $cek_selsih_jarak_minimal = $jarak[0] - 5;
                $hitung = round($dt_ongkir['harga_jarak_minimal'] + ($cek_selsih_jarak_minimal *$dt_ongkir['harga']));
                $hasil['status']    = 'bayar';
                $hasil['harga']     = $hitung;
                $hasil['harga_txt'] = number_format($hitung,0,',','.');
                $hasil['jarak']     = $this->input->post('jarak');
            } else{
                $hasil['status']    = 'free ongkir';
                $hasil['harga']     = 0;
                $hasil['harga_txt'] = 0;
                $hasil['jarak']     = $this->input->post('jarak');
            }
        } else {
            if($jarak[1] == "km"){
                $cek_selsih_jarak_minimal = $jarak[0] - 5;
                $hitung = round($jarak[0] * $dt_ongkir['harga']);
                $hasil['status']    = 'bayar';
                $hasil['harga']     = $hitung;
                $hasil['harga_txt'] = number_format($hitung,0,',','.');
                $hasil['jarak']     = $this->input->post('jarak');
            } else{
                $hasil['status']    = 'free ongkir';
                $hasil['harga']     =  0;
                $hasil['harga_txt'] =  0;
                $hasil['jarak']     = $this->input->post('jarak');
            }
        }
        $_SESSION['hasil_pengantaran'] = $hitung;
        echo json_encode($hasil);
    }

    public function simpan_transaksi()
    {
        $biaya_ongkir               = $this->input->post('biaya_ongkir');
        $biaya_ongkir_pengambilan   = $this->input->post('biaya_ongkir_pengambilan');
        $biaya_ongkir_pengantaran   = $this->input->post('biaya_ongkir_pengantaran');
        $total                      = $this->input->post('total_belanja');
        if($biaya_ongkir != ""){
            $post = [
                'id'                => $this->input->post('id_transaksi'),
                'ongkir'            => $biaya_ongkir,
                'total_pembelian'   => $total,
                'status'            => 'proses'
            ];
        } else {
            $post = [
                'id'                => $this->input->post('id_transaksi'),
                'ongkir'            => $biaya_ongkir_pengambilan + $biaya_ongkir_pengantaran,
                'total_pembelian'   => $total,
                'status'            => 'proses',
                'tanggal'           => date("Y-m-d H:i:s")
            ];
        }
        // print('<pre>');print_r($post);exit();
        $this->mod->updateTransaksi($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil checkout keranjang</div>');
        redirect('order/transaksi');
    }

    public function transaksi()
    {
        $data = [
            'title'     => 'Alamat Pengantaran',
            'content'   => 'order/transaksi',
            'transaksi' => $this->mod->getTransaksi($this->session->userdata('user_id'))
        ];
        // print('<pre>');print_r($data['transaksi']);exit();
        $this->load->view('templates/frontend/index',$data);
    }

    public function detail_transaksi()
    {
        $data = $this->mod->getDetailTransaksi($this->input->post('id'));
        echo json_encode($data);
    }

    /*---------- Order Barang ----------*/
    public function aktifkan_lokasi()
    {
        $koordinat = $this->input->post('koordinat', true);
        if($koordinat !=""){
            $_SESSION['lokasi_sekarang'] = $koordinat;
            $data = 1;
        }else{
            $_SESSION['lokasi_sekarang'] = 0;
            $data = 0;
        }
        echo json_encode($data);
    }
    public function save_order_detail_customer_tmp()
    {
        $panjang        = $this->input->post('panjang', true);
        $lebar          = $this->input->post('lebar', true);
        $tinggi         = $this->input->post('tinggi', true);
        $berat_barang   = $this->input->post('berat_barang', true);
        $id_user        = $this->session->userdata('cust_id_customer');
        $level_user     = $this->session->userdata('cust_level');
        $tarif_barang   = $this->mod->m_get_tarif_barang($level_user);
        $berat = round(($panjang*$lebar*$tinggi)/6000,1);
        if(($berat_barang[0] == "overweight") && ($berat_barang[1] == "oversize")){
            echo "true 2 kondisi";
            $total = ceil($berat * ($tarif_barang['harga_overweight'] + $tarif_barang['harga_oversize']));
        }else if($berat_barang[0] == "overweight"){
            echo "true 1 overweight";
            $total = ceil($berat * $tarif_barang['harga_overweight']);
        }else if($berat_barang[0] == "oversize"){
            echo "true 1 oversize";
            $total = ceil($berat * $tarif_barang['harga_oversize']);
        }else{
            echo "normal";
            $total = ceil($berat * $tarif_barang['harga_normal']);
        }
        print('<pre>');print_r($berat_barang);
        print('<pre>');print_r($tarif_barang);
        $post = [
            'id_order'      => $this->input->post('id_order_db', true),
            'id_customer'   => $id_user,
            'volume_barang' => $panjang."x".$lebar."x".$tinggi,
            'berat_barang'  => $berat,
            'status_berat'  => $this->input->post('berat_barang', true),
            'catatan'       => $this->input->post('catatan', true),
            'total'         => $total
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_save_order_detail_customer_tmp($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Barang Berhasil DItambahkan
            </div>');
        redirect('order');
    }

    public function show_order_detail_customer_tmp()
    {
        $id = $this->input->post('id', true);
        $data = $this->mod->m_show_order_detail_customer_tmp($id);
        echo json_encode($data);
    }

    public function update_order_detail_customer_tmp()
    {
        $panjang        = $this->input->post('panjang', true);
        $lebar          = $this->input->post('lebar', true);
        $tinggi         = $this->input->post('tinggi', true);
        $berat_barang   = $this->input->post('berat_barang', true);
        $id_user        = $this->session->userdata('cust_id_customer');
        $level_user     = $this->session->userdata('cust_level');
        $tarif_barang   = $this->mod->m_get_tarif_barang($level_user);
        if(($berat_barang[0] == "overweight") && ($berat_barang[1] == "oversize")){
            echo "true 2 kondisi";
            $berat = round(($panjang*$lebar*$tinggi)/6000,1);
            $total = ceil($berat * ($tarif_barang['harga_overweight'] + $tarif_barang['harga_oversize']));
        }else if($berat_barang[0] == "overweight"){
            echo "true 1 overweight";
            $berat = round(($panjang*$lebar*$tinggi)/6000,1);
            $total = ceil($berat * $tarif_barang['harga_overweight']);
        }else if($berat_barang[0] == "oversize"){
            echo "true 1 oversize";
            $berat = round(($panjang*$lebar*$tinggi)/6000,1);
            $total = ceil($berat * $tarif_barang['harga_oversize']);
        }else{
            echo "normal";
            $berat = round(($panjang*$lebar*$tinggi)/6000,1);
            $total = ceil($berat * $tarif_barang['harga_normal']);
        }
        print('<pre>');print_r($berat_barang);
        print('<pre>');print_r($tarif_barang);
        $post = [
            'id_barang'     => $this->input->post('id_barang', true),
            'id_order'      => $this->input->post('id_order_db', true),
            'id_customer'   => $id_user,
            'volume_barang' => $panjang."x".$lebar."x".$tinggi,
            'berat_barang'  => $berat,
            'status_berat'  => $this->input->post('berat_barang', true),
            'catatan'       => $this->input->post('catatan', true),
            'total'         => $total
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_update_order_detail_customer_tmp($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Barang Berhasil Diupdate
            </div>');
        redirect('order');
    }

    public function destroy_order_detail_customer_tmp()
    {
        $id = $this->input->post('id', true);
        $data = $this->mod->m_destroy_order_detail_customer_tmp($id);
        print_r($id);
    }

    public function count_ongkir()
    {
        $cek_jarak = substr($this->input->post('jarak',true),3);
        if($cek_jarak == "m"){
            $jarak_1 = str_replace(' m', '', round($this->input->post('jarak',true)));
            $jarak = $jarak_1/1000;
        }else{
            // echo "here";
            $jarak_ori = substr($this->input->post('jarak',true),0,-3);
            $jarak_ori_2 = str_replace(",",".",$jarak_ori);
            $jarak = ceil($jarak_ori_2);
        }
        $level = $this->session->userdata('cust_level');
        $harga_ongkir = $this->mod->m_get_data_ongkir($level);
        if($harga_ongkir['status_jarak_minimal'] == "aktif"){
            if($jarak <= $harga_ongkir['jarak_minimal']){
                $total_ongkir = ceil(($jarak/2)) * $harga_ongkir['harga_jarak_minimal'];
            }else{
                $lebih_ongkir = $jarak - $harga_ongkir['jarak_minimal'];
                $total_ongkir = $harga_ongkir['harga_jarak_minimal'] + ($lebih_ongkir * $harga_ongkir['harga']);
            }
        }else{
            $total_ongkir = ceil(($jarak/2)) * $harga_ongkir['harga'];
        }
        print_r($total_ongkir);
        // echo $jarak;
    }

    public function save_to_order()
    {
        $id_customer    = $this->session->userdata('cust_id_customer');
        $cek_temp       = $this->mod->m_get_tmp_by_id($id_customer);  
        $referal_code   = $this->input->post('referal_code', true);
        $cek_referal    = $this->mod->m_get_referal($referal_code);
        $get_diskon     = $this->mod->m_get_diskon($id_customer);
        if($cek_referal !=""){
            $potongan_referal = 5/100;
        }else{
            $potongan_referal = 0;
        }
        if($get_diskon['diskon']!=""|| $get_diskon['diskon']!=0){
            $diskon = $get_diskon['diskon']/100;
        }else{
            $diskon = 0;
        }
        $harga_cod = str_replace(".","",$this->input->post('harga_cod', true));
        
        $jumlah = $this->db->count_all('order_customer')+1;
        $data_customer = $this->mod->m_get_data_customer($id_customer);
        $level  = $data_customer['level'];
        $dt     = explode(" ",$data_customer['tanggal_bergabung']);
        $date   = explode("-",$dt[0]);
        $thn    = substr($date[0],2);
        $bln    = $date[1];

        if($data_customer['level']=="customer"){
            $level_user = "CC";
        }else if($data_customer['level'] =="member"){
            $level_user = "MM";
        }else{
            $level_user = "B2B";
        }
        if($jumlah >= 1){
            $running_number = '000000'.$jumlah; 
        }else if($jumlah >9 && $jumlah< 100){
            $running_number = '00000'.$jumlah;
        }else if($jumlah >100 && $jumlah< 1000){
            $running_number = '0000'.$jumlah;
        }else if($jumlah >1000 && $jumlah< 10000){
            $running_number = '000'.$jumlah;
        }else if($jumlah >10000 && $jumlah< 100000){
            $running_number = '00'.$jumlah;
        }else if($jumlah >100000 && $jumlah< 1000000){
            $running_number = '0'.$jumlah;
        }else{
            $running_number = $jumlah;
        }
        
        $id_trx = $level_user.$thn.$bln.$running_number;
        $post =  [
            'id_order'              => $id_trx,
            'id_customer'           => $id_customer,
            'nama_pengirim'         => $this->input->post('pengirim', true),
            'nama_penerima'         => $this->input->post('penerima', true),
            'no_telpn_pengirim'     => $this->input->post('no_tlpn_pengirim', true),
            'no_telpn_penerima'     => $this->input->post('no_tlpn_penerima', true),
            'jenis_pembayaran'      => $this->input->post('jenis_pembayaran', true),
            'alamat_asal'           => $this->input->post('alamat_asal', true),
            'koordinat_asal'        => $this->input->post('koordinat_asal', true),
            'kabupaten_asal'        => $this->input->post('kabupaten_asal', true),
            'alamat_tujuan'         => $this->input->post('alamat_tujuan', true),
            'koordinat_tujuan'      => $this->input->post('koordinat_tujuan', true),
            'kabupaten_tujuan'      => $this->input->post('kabupaten_tujuan', true),
            'ongkir'                => $this->input->post('nominal_ongkir', true),
            'subtotal'              => $this->input->post('nominal_subtotal', true),
            'total'                 => ceil(($this->input->post('nominal_ongkir', true)+$harga_cod)-($potongan_referal+$diskon)),
            'tanggal_order'         => date('Y-m-d H:i:s'),
            'jarak'                 => str_replace(",",".",$this->input->post('jarak', true)),
            'verifikasi_customer'   => $this->input->post('verifikasi_customer', true),
            'referal_code'          => $referal_code,
            'diskon'                => $diskon+$potongan_referal,
            'patokan_asal'          => $this->input->post('patokan_asal', true),
            'patokan_tujuan'        => $this->input->post('patokan_tujuan', true),
            'harga_cod'             => $harga_cod,
            'paid_by'               => $this->input->post('paid_by', true)
        ];
        $temp = $this->mod->m_get_data_order_customer_tmp($id_customer);
        // print('<pre>');print_r($temp);
       
        // print('<pre>');print_r($temp);
        // print('<pre>');print_r($post_detail);
        // print('<pre>');print_r($post);exit();
        if($temp == "" ){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Harap isi data barang terlebih dahulu
        </div>');    
        }else{
            $post_detail = [
                'id_barang'     => $temp['id_barang'],
                'id_order'      => $id_trx,
                'id_customer'   => $temp['id_customer'],
                'volume_barang' => $temp['volume_barang'],
                'berat_barang'  => $temp['berat_barang'],
                'status_berat'  => $temp['status_berat'],
                'catatan'       => $temp['catatan'],
                'total'         => $temp['total']
            ];
            $this->mod->m_save_to_order($post);
            $this->mod->m_save_to_order_detail_customer($post_detail);
            $this->mod->m_destroy_all_order_detail_customer_tmp($id_customer);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Order Barang Berhasil
            </div>');
            $_SESSION['msg'] = "berhasil_order";
        }
        redirect('order');
    }
    
    /* ---------- Riwayat Order ----------*/
    public function show_riwayat_order()
    {
        $id_customer = $this->session->userdata('cust_id_customer');
        $data['title'] = 'Riwayat Order';
        $data['order'] = $this->mod->m_get_order_customer($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu');
        $this->load->view('riwayat_order',$data);
        $this->load->view('templates/frontend/depan/footer');
    }

    public function detail_riwayat()
    {
        $id_customer    = $this->session->userdata('cust_id_customer');
        $id_order       = $this->uri->segment(3);
        $data['title']  = 'Detail  Order';
        $data['detail'] = $this->mod->m_get_detail_order_customer($id_order);
        $data['list_barang'] = $this->mod->m_get_list_order_customer($id_order);
        $data['charge']     = $this->mod->m_count_charge($id_order);
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu');
        $this->load->view('riwayat_order_detail');
        $this->load->view('templates/frontend/depan/footer');
    }

    /*--------- Driver ----------*/
    public function order_driver_masuk()
    {
        is_logged_in_rider();
        $id_rider           = $this->session->userdata('rider_id_rider');
        $data['title']      = 'Orderan Masuk';
        $data['order']       = $this->mod->m_get_order_driver_masuk($id_rider);
        // print('<pre>');print_r($id_rider);
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu_driver');
        $this->load->view('list_order_masuk', $data);
        $this->load->view('templates/frontend/depan/footer');
    }

    public function detail_order_driver()
    {
        $id_customer    = $this->session->userdata('cust_id_customer');
        $id_order       = $this->input->post('id', true);
        $data['detail'] = $this->mod->m_get_detail_order_customer($id_order);
        $data['list_barang']    = $this->mod->m_get_list_order_customer($id_order);
        $data['level']          = $this->mod->m_get_level_customer($data['detail']['id_customer']);
        echo json_encode($data);
    }

    public function update_order_detail_driver()
    {
        $id_order       = $this->input->post('id_order_db', true);
        $panjang        = $this->input->post('panjang', true);
        $lebar          = $this->input->post('lebar', true);
        $tinggi         = $this->input->post('tinggi', true);
        $berat_barang   = $this->input->post('berat_barang', true);
        $id_user        = $this->input->post('id_customer',true);
        $level_user     = $this->input->post('level_user', true);
        // $tarif_barang   = $this->mod->m_get_tarif_barang($level_user);
        $tarif_barang   = $this->mod->m_get_tarif_barang($id_order);
        $total_sebelum  = $this->input->post('total_sebelum', true);
        $berat          = round(($panjang*$lebar*$tinggi)/6000,1);
        $harga_overweight   = ($tarif_barang['harga_overweight']*$total_sebelum)/100;
        $harga_oversize     = ($tarif_barang['harga_oversize']*$total_sebelum)/100;
        if(($berat_barang[0] == "overweight") && ($berat_barang[1] == "oversize")){
            echo "true 2 kondisi";
            // $total = ceil(($berat * $tarif_barang['harga_normal'])+ $harga_overweight + $harga_oversize);
            $total = $tarif_barang['total']+($tarif_barang['ongkir']*2);
            $charge = $tarif_barang['ongkir']*2;
        }else if($berat_barang[0] == "overweight"){
            echo "true 1 overweight";
            $total = $tarif_barang['total']+$tarif_barang['ongkir'];
            $charge = $tarif_barang['ongkir'];
        }else if($berat_barang[0] == "oversize"){
            echo "true 1 oversize";
            $total = $tarif_barang['total']+$tarif_barang['ongkir'];
            $charge = $tarif_barang['ongkir'];
        }else{
            echo "normal";
            $total = $tarif_barang['total'];
            $charge = 0;
        }

        // if($uang_diterima ==""){
        //     $status_pembayaran = 'belum';
        // }else{
        //     $status_pembayaran = 'sudah';
        // }
        // print('<pre>');print_r($harga_overweight);
        // print('<pre>');print_r($harga_oversize);
        // print('<pre>');print_r($berat_barang);
        // print('<pre>');print_r($tarif_barang);
        $post = [
            'id_order'      => $id_order,
            'id_customer'   => $id_user,
            'volume_barang' => $panjang."x".$lebar."x".$tinggi,
            'berat_barang'  => $berat,
            'status_berat'  => implode(",",$this->input->post('berat_barang', true)),
            'catatan'       => $this->input->post('catatan', true),
            'total'         => $total
        ];
        $post_order_customer = [
            'id_order'          => $id_order,
            'verifikasi_driver' => 'sudah',
            'subtotal'          => $charge,
            'total'             => $total
        ];
        $post_order_driver = [
            'id_order'      => $id_order,
            'volume_barang' => $panjang."x".$lebar."x".$tinggi,
            'berat_barang'  => $berat,
            'status_berat'  => implode(",",$this->input->post('berat_barang', true))
        ];
        // print('<pre>');print_r($post);
        // print('<pre>');print_r($post_order_customer);
        // print('<pre>');print_r($post_order_driver);exit();
        $this->mod->m_update_order_customer($post_order_customer);
        $this->mod->m_update_order_detail_customer($post);
        $this->mod->m_save_order_driver($post_order_driver);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Barang Berhasil Diupdate
            </div>');
        redirect('order/order_driver_masuk');
    }

    public function proses_orderan()
    {
        $this->mod->m_save_proses_orderan_driver();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Barang Berhasil Diupdate
        </div>');
        redirect('order/order_driver_masuk');
        
    }

    public function selesai_orderan()
    {
        $this->mod->m_save_selesai_orderan_driver();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil menyelesaikan orderan
        </div>');
        redirect('order/order_driver_masuk');
    }

    public function order_driver_selesai()
    {
        is_logged_in_rider();
        $data['title']  = "Orderan Selesai";
        $id_rider       = $this->session->userdata('rider_id_rider');
        $data['order']  = $this->mod->m_get_order_driver_selesai($id_rider);
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu_driver');
        $this->load->view('list_order_selesai', $data);
        $this->load->view('templates/frontend/depan/footer');

    }

    public function detail_order_driver_selesai()
    {
        is_logged_in_rider();
        $data['title']  = "Detail Orderan Selesai";
        $id_orderan     = $this->uri->segment(3);
        $data['detail'] = $this->mod->m_get_detail_order_driver_selesai($id_orderan);
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu_driver');
        $this->load->view('list_order_selesai_detail', $data);
        $this->load->view('templates/frontend/depan/footer');
    }

    public function ganti_driver()
    {
        $id_order   = $this->input->post('id',true);
        $alamat     = $this->input->post('alamat',true);
        $koordinat  = $this->input->post('koordinat', true);
        $jarak      = $this->input->post('jarak', true);
        $id_driver  = $this->input->post('id_driver', true);
        $post = [
            'id_orderan'  => $id_order,
            'alamat'    => $alamat,
            'koordinat' => implode(",",$koordinat),
            'jarak_tempuh_driver_lama'     => $jarak,
            'id_driver_lama' => $id_driver
        ];
        $update = [
            'id_order'  => $id_order,
            'id_rider'  => 0
        ];
        // print_r($post);
        $this->mod->m_save_ganti_driver($post);
        $this->mod->m_update_rider_order_customer($update);
        
    }

    public function order_driver_ganti()
    {
        is_logged_in_rider();
        $data['title']  = "Orderan Ganti  Driver";
        $id_rider       = $this->session->userdata('rider_id_rider');
        $data['order']  = $this->mod->m_get_order_driver_ganti($id_rider);
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu_driver');
        $this->load->view('list_order_ganti', $data);
        $this->load->view('templates/frontend/depan/footer');

    }

    public function update_jarak_tempuh_driver_baru()
    {
        $id = $this->input->post('id',true);
        $jarak = $this->input->post('jarak',true);
        $post = [
            'id_orderan' => $id,
            'jarak_tempuh_driver_baru' => $jarak
        ];
        $this->mod->m_update_jarak_tempuh_driver_baru($post);
        
    }

}