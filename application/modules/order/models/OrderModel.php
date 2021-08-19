<?php

class OrderModel extends CI_Model {
    protected $table    = 'transaksi';
    
    public function getAllProduk()
    {
        $this->db->select('a.id,a.nama_produk,a.harga,a.gambar,a.stock, b.nama')
                ->from('produk as a')
                ->join('kategori as b','a.id_kategori = b.id','left')
                ->where('a.stock > 0');
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function getAllKeranjang()
    {
        $this->db->select('id, koordinat_pengambilan, alamat_pengambilan, koordinat_pengantaran, alamat_pengantaran')
                ->from($this->table)
                ->where('id_user', $this->session->userdata('user_id'))
                ->where('status =','keranjang');
        $query = $this->db->get_compiled_select();
        $transaksi  = $this->db->query($query)->row_array();

        $this->db->select('a.id, a.harga, a.jumlah, b.nama_produk, b.gambar')
                ->from('detail_transaksi as a')
                ->join('produk as b','a.id_produk = b.id','left')
                ->where('id_transaksi',$transaksi['id']);
        $query = $this->db->get_compiled_select();
        $produk  = $this->db->query($query)->result_array();
        $hasil['id_transaksi']          = $transaksi['id'];
        $hasil['koordinat_pengambilan'] = $transaksi['koordinat_pengambilan'];
        $hasil['alamat_pengambilan']    = $transaksi['alamat_pengambilan'];
        $hasil['koordinat_pengantaran'] = $transaksi['koordinat_pengantaran'];
        $hasil['alamat_pengantaran']    = $transaksi['alamat_pengantaran'];
        $i = 0;
        foreach($produk as $p){
            $hasil['produk'][$i]['id'] = $p['id'];
            $hasil['produk'][$i]['harga'] = $p['harga'];
            $hasil['produk'][$i]['jumlah'] = $p['jumlah'];
            $hasil['produk'][$i]['nama_produk'] = $p['nama_produk'];
            $hasil['produk'][$i]['gambar'] = $p['gambar'];
            $i++;
        }
        return $hasil;
    }

    public function getBarangById($id)
    {
        $this->db->select('a.id,a.nama_produk,a.harga,a.gambar,a.stock, b.nama')
                ->from('produk as a')
                ->join('kategori as b','a.id_kategori = b.id','left')
                ->where('a.id',$id);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }
    
    public function getDetailTransaksiById($id)
    {
        $this->db->select()
                ->from('detail_transaksi')
                ->where('id',$id);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function storeKeranjang($post)
    {
        $this->db->select('koordinat_alamat, alamat')
                ->from('user')
                ->where('id', $this->session->userdata('user_id'));
        $query  = $this->db->get_compiled_select();
        $data_user = $this->db->query($query)->row_array();
        
        $this->db->select('a.stock')
                ->from('produk as a')
                ->where('a.id',$post['id_produk']);
        $query = $this->db->get_compiled_select();
        $data_produk  = $this->db->query($query)->row_array();

        $this->db->select('a.id')
                ->from('transaksi as a')
                ->where('a.id_user',$post['id_user'])
                ->where('a.status','keranjang');
        $query = $this->db->get_compiled_select();
        $data_keranjang  = $this->db->query($query)->row_array();
       
        $stock_update = $data_produk['stock'] - $post['jumlah'];
        if($data_keranjang != ""){
            $insert_id = $data_keranjang['id'];
        } else {
            $transaksi = [
                'id_user'               => $post['id_user'],
                'status'                => 'keranjang',
                'koordinat_pengambilan' => $data_user['koordinat_alamat'],
                'alamat_pengambilan'    => $data_user['alamat'],
                'koordinat_pengantaran' => $data_user['koordinat_alamat'],
                'alamat_pengantaran'    => $data_user['alamat'],
            ];
            $this->db->insert('transaksi', $transaksi);
            $insert_id = $this->db->insert_id();
        }
        $detail_transaksi = [
            'id_transaksi'  => $insert_id,
            'id_produk'     => $post['id_produk'],
            'harga'         => $post['harga'],
            'jumlah'        => $post['jumlah'],
            'catatan'       => $post['catatan']
        ];
        $update = [
            'id'        => $post['id_produk'],
            'stock'     => $stock_update 
        ];
        $this->db->insert('detail_transaksi',$detail_transaksi);
        $this->db->select()
            ->from('produk')
            ->where("id" , $post['id_produk']);
        $query = $this->db->set($update)->get_compiled_update();
        $this->db->query($query);
        return true;
    }

    public function updateKeranjang($post)
    {
        $this->db->select('a.stock')
                ->from('produk as a')
                ->where('a.id',$post['id_produk']);
        $query = $this->db->get_compiled_select();
        $data_produk  = $this->db->query($query)->row_array();
        $stock_update = ($data_produk['stock'] + $post['jumlah_sebelumnya']) - $post['jumlah'];
        $update_dt = [
            'id'        => $post['id'],
            'harga'     => $post['harga'],
            'catatan'   => $post['catatan'],
            'jumlah'    => $post['jumlah']
        ];
        $update_stock = [
            'id'        => $post['id_produk'],
            'stock'     => $stock_update 
        ];
        $this->db->select()
            ->from('detail_transaksi')
            ->where("id" , $post['id']);
        $query1 = $this->db->set($update_dt)->get_compiled_update();
        $this->db->query($query1);

        $this->db->select()
            ->from('produk')
            ->where("id" , $post['id_produk']);
        $query2 = $this->db->set($update_stock)->get_compiled_update();
        $this->db->query($query2);
        return true;
    }

    public function hapusItemKeranjang($post)
    {
        $update = [
            'id'        => $post['id_produk'],
            'stock'     => $post['stock'] 
        ];
        // print('<pre>');print_r($update);exit();
        $this->db->select()
            ->from('produk')
            ->where("id" , $post['id_produk']);
        $update = $this->db->set($update)->get_compiled_update();
        $this->db->query($update);
        $this->db->from('detail_transaksi')
            ->where("id", $post['id']);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }

    public function updateAlamat($post)
    {
        $this->db->select()
            ->from('transaksi')
            ->where("id", $post['id']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function getOngkir()
    {
        $this->db->select()
                ->from('tarif_ongkir')
                ->limit(1);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }
    /*----- old ------*/
    private function _uploadImage($nama_rider,$id_order,$status_order)
    {

        $nama_file                      = str_replace(" ","",strtolower($nama_rider)).time().$id_order;
        if($status_order=="proses"){
            $config['upload_path']          = './assets/frontend/img/foto_ambil/';
        }else{
            $config['upload_path']          = './assets/frontend/img/foto_antar/';
        }
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = $nama_file;
        $config['overwrite']			= true;
        // $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if($status_order=="proses"){
            if ($this->upload->do_upload('foto_ambil')) {
                return $this->upload->data("file_name");
            }
        }else{
            if ($this->upload->do_upload('foto_antar')) {
                return $this->upload->data("file_name");
            }
        }
        
        return "profile.png";
    }

    public function m_save_daftar($post)
    {
        $this->db->insert('customer', $post);
        return true;
    }

    public function m_get_data_customer($id_customer)
    {
        $this->db->select()
                ->from('customer')
                ->where('customer.id_customer', $id_customer);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_save_order_detail_customer_tmp($post)
    {
        $this->db->insert('order_detail_customer_tmp', $post);
        return true;
    }

    public function m_get_tmp_by_id($id_customer)
    {
        $this->db->select()
                ->from('order_detail_customer_tmp')
                ->where('id_customer', $id_customer);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }
    
    /*--------- Orders ----------*/
    public function m_get_tarif_barang($id_order)
    {
        $this->db->select("ongkir,total")
            ->from('order_customer')
            ->where("id_order", $id_order);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_get_data_order_customer_tmp($id_customer)
    {
        $this->db->select()
            ->from('order_detail_customer_tmp')
            ->where("id_customer", $id_customer);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        // print('<pre>');print_r($query);exit();
        return $data;
    }

    public function m_show_order_detail_customer_tmp($id)
    {
        $this->db->select()
            ->from('order_detail_customer_tmp')
            ->where("id_barang", $id);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_count_subtotal($id_customer)
    {
        $this->db->select_sum('total')
                ->where('id_customer', $id_customer);
        $query = $this->db->get('order_detail_customer_tmp')->row_array();
        return $query;
    }

    public function m_count_charge($id_order)
    {
        $this->db->select_sum('charge')
                ->where('id_order', $id_order);
        $query = $this->db->get('order_detail_customer')->row_array();
        return $query;
    }

    public function m_destroy_order_detail_customer_tmp($id)
    {
        $this->db->select()
            ->from('order_detail_customer_tmp')
            ->where("id_barang", $id);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }

    public function m_update_order_detail_customer_tmp($post)
    {
        $this->db->select()
            ->from('order_detail_customer_tmp')
            ->where("id_barang" , $post['id_barang']);
        $query = $this->db->set($post)->get_compiled_update();
        // print('<pre>');print_r($query);exit();
        $this->db->query($query);
        return true;	
    }

    public function m_update_id_trx_detail_cust($post)
    {
        $this->db->select()
            ->from('order_detail_customer_tmp')
            ->where("id_barang" , $post['id_barang']);
        $query = $this->db->set($post)->get_compiled_update();
        // print('<pre>');print_r($query);exit();
        $this->db->query($query);
        return true;	
    }

    public function m_get_data_ongkir($level)
    {
        $this->db->select()
            ->from('tarif_ongkir')
            ->where("kategori_harga", $level);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_get_referal($referal_code)
    {
        $this->db->select()
            ->from('customer')
            ->where("referal_code", $referal_code);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_get_diskon($id_customer)
    {
        $this->db->select("diskon")
            ->from('customer')
            ->where("id_customer", $id_customer);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_save_to_order($post)
    {
        $this->db->insert('order_customer', $post);
        return true;
    }

    public function m_save_to_order_detail_customer($post_detail)
    {
        // $this->db->insert_batch('order_detail_customer', $post_detail);
        // return true;
        $this->db->insert('order_detail_customer', $post_detail);
        return true;
    }

    public function m_destroy_all_order_detail_customer_tmp($id_customer)
    {
        $this->db->select()
            ->from('order_detail_customer_tmp')
            ->where("id_customer", $id_customer);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }

    public function m_get_list_order_customer($id_order)
    {
        $this->db->select()
            ->from('order_detail_customer')
            ->where("id_order", $id_order);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_get_level_customer($id_customer)
    {
        $this->db->select('level')
            ->from('customer')
            ->where("id_customer", $id_customer);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    /*--------- Riwayat Order ---------*/
    public function m_get_order_customer($id_customer)
    {
        $this->db->select()
            ->from('order_customer AS a')
            ->join('rider AS b', 'a.id_rider=b.id_rider', 'left')
            ->where("a.id_customer", $id_customer)
            ->order_by('a.tanggal_order', 'DESC');
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_get_detail_order_customer($id_order)
    {
        $this->db->select()
            ->from('order_customer AS a')
            ->join('rider AS b', 'a.id_rider=b.id_rider', 'left')
            ->where("id_order", $id_order);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    /*---------- Driver ---------*/
    public function m_get_order_driver_masuk($id_rider)
    {
        $this->db->select()
            ->from('order_customer AS a')
            ->join('ganti_driver AS b','b.id_orderan=a.id_order','left')
            ->where("a.id_rider", $id_rider)
            ->where("status_order != 'selesai'");
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_update_order_detail_customer($post)
    {
        $this->db->select()
            ->from('order_detail_customer')
            ->where("id_order" , $post['id_order']);
        $query = $this->db->set($post)->get_compiled_update();
        // print('<pre>');print_r($query);exit();
        $this->db->query($query);
        return true;	
    }

    public function m_update_order_customer($post_order_customer)
    {
        $this->db->select()
            ->from('order_customer')
            ->where("id_order" , $post_order_customer['id_order']);
        $query = $this->db->set($post_order_customer)->get_compiled_update();
        // print('<pre>');print_r($query);exit();
        $this->db->query($query);
        return true;	
    }

    public function m_save_order_driver($post_order_driver)
    {
        $this->db->insert('order_driver', $post_order_driver);
        return true;
    }

    public function m_save_proses_orderan_driver()
    {
        $id_order = $this->input->post('id_orderan');
        $nama_rider = $this->input->post('nama_rider',true);
        $uang_diterima = str_replace(".","",$this->input->post('uang_diterima', true));
        $status_order = "proses";

        $data = [
            "id_order" => $id_order,
            "uang_diterima" => $uang_diterima,
            "gambar_pengambilan" =>$this->_uploadImage($nama_rider,$id_order,$status_order)
        ];
        $data_oc = [
            "id_order" => $id_order,
            "status_order" => $status_order,
        ];
        // print('<pre>');print_r($data);exit();
        $this->db->where('id_order', $id_order)
                ->update('order_customer', $data_oc);
        $this->db->where('id_order', $id_order)
                ->update('order_driver', $data);
    }

    public function m_save_selesai_orderan_driver()
    {
        $id_order = $this->input->post('id_orderan',true);
        $nama_rider = $this->input->post('nama_rider',true);
        $status_order = "selesai";
        $data = [
            "id_order" => $id_order,
            "gambar_pengantaran" =>$this->_uploadImage($nama_rider,$id_order,$status_order)
        ];
        $data_oc = [
            "id_order" => $id_order,
            "status_order" => $status_order,
        ];
        // print('<pre>');print_r($data);
        // print('<pre>');print_r($data_oc);exit();
        $this->db->where('id_order', $id_order)
            ->update('order_customer', $data_oc);
        $this->db->where('id_order', $id_order)
                ->update('order_driver', $data);
    }

    public function m_get_order_driver_selesai($id_rider)
    {
        $this->db->select()
            ->from('order_customer')
            ->where("id_rider", $id_rider)
            ->where("status_order = 'selesai'");
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_get_detail_order_driver_selesai($id_order)
    {
        $this->db->select('a.id_order,a.nama_pengirim,a.nama_penerima,a.no_telpn_penerima,a.no_telpn_pengirim,a.jenis_pembayaran,a.alamat_asal,a.alamat_tujuan,a.status_order,b.gambar_pengambilan,b.gambar_pengantaran,b.volume_barang,b.berat_barang,b.status_berat')
            ->from('order_customer AS a')
            ->join('order_driver AS b', 'a.id_order=b.id_order')
            ->where("a.id_order", $id_order)
            ->where("status_order = 'selesai'");
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_save_ganti_driver($post)
    {
        $this->db->insert('ganti_driver', $post);
        return true;
    }

    public function m_update_rider_order_customer($update)
    {
        $this->db->select()
            ->from('order_customer')
            ->where("id_order" , $update['id_order']);
        $query = $this->db->set($update)->get_compiled_update();
        // print('<pre>');print_r($query);exit();
        $this->db->query($query);
        return true;	
    }

    public function m_get_order_driver_ganti($id_rider)
    {
        $this->db->select()
            ->from('ganti_driver')
            ->where("id_driver_lama",$id_rider);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_update_jarak_tempuh_driver_baru($post)
    {
        $this->db->select()
            ->from('ganti_driver')
            ->where("id_orderan" , $post['id_orderan']);
        $query = $this->db->set($post)->get_compiled_update();
        // print('<pre>');print_r($query);exit();
        $this->db->query($query);
        return true;	
    }

}