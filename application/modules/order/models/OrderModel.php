<?php

class OrderModel extends CI_Model {

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