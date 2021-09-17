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
            'produk'    =>  $this->mod->getAllProduk(),
            'kategori'  =>  $this->mod->getAllKategori()
        ];

        $this->load->view('templates/frontend/index',$data);
    }

    public function kategori()
    {
        $kategori = $this->input->post('kategori');
        if($kategori == 0){
            unset($_SESSION['kode_kategori']);
            redirect('order');
        } else {
            $data = [
                'title'     => 'Order',
                'content'   => 'order/kategori',
                'produk'    =>  $this->mod->getAllProdukByKategori($kategori),
                'kategori'  =>  $this->mod->getAllKategori()
            ];
            $_SESSION['kode_kategori'] = $kategori;
            $this->load->view('templates/frontend/index',$data);
        }
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
        $kode                       = rand(100,999);
        if($biaya_ongkir != ""){
            $post = [
                'id'                => $this->input->post('id_transaksi'),
                'ongkir'            => $biaya_ongkir,
                'total_pembelian'   => $total + $kode,
                'status'            => 'proses',
                'tanggal'           => date("Y-m-d H:i:s"),
                'catatan'           => $this->input->post('catatan'),
                'kode_uniq'         => $kode
            ];
        } else {
            $post = [
                'id'                => $this->input->post('id_transaksi'),
                'ongkir'            => $biaya_ongkir_pengambilan + $biaya_ongkir_pengantaran,
                'total_pembelian'   => $total + $kode,
                'status'            => 'proses',
                'catatan'           => $this->input->post('catatan'),
                'tanggal'           => date("Y-m-d H:i:s"),
                'kode_uniq'         => $kode
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

    
}