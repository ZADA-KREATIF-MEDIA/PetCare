<?php

class OrderModel extends CI_Model {
    protected $table    = 'transaksi';
    
    public function get_alamat_pengantaran()
    {
        $this->db->select('koordinat_pengantaran')
                ->from('transaksi')
                ->where('id_user', $this->session->userdata('user_id'))
                ->where('status','keranjang');
        $query  = $this->db->get_compiled_select();
        $data   = $this->db->query($query)->row_array();
        return $data;
    }

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

    public function getAllProdukByKategori($kategori)
    {
        $this->db->select('a.id,a.nama_produk,a.harga,a.gambar,a.stock, b.nama')
                ->from('produk as a')
                ->join('kategori as b','a.id_kategori = b.id','left')
                ->where('a.stock > 0')
                ->where('a.id_kategori',$kategori);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function getAllKategori()
    {
        $this->db->select()
                ->from('kategori');
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function cekJenisBelanjaan()
    {
        $this->db->select()
                ->from('transaksi')
                ->where('id_user', $this->session->userdata('user_id'))
                ->where('status','keranjang');
        $query = $this->db->get_compiled_select();
        $keranjang = $this->db->query($query)->row_array();

        $this->db->select('b.nama_produk,c.nama')
            ->from('detail_transaksi AS a')
            ->join('produk AS b','a.id_produk = b.id','left')
            ->join('kategori AS c','b.id_kategori = c.id','left')
            ->where('c.id',9)
            ->where('a.id_transaksi',$keranjang['id']);
        $query2 = $this->db->get_compiled_select();
        $barang = $this->db->query($query2)->num_rows();
        return $barang;
    }

    public function getAllKeranjang()
    {
        $this->db->select('id, koordinat_pengambilan, alamat_pengambilan, koordinat_pengantaran, alamat_pengantaran')
                ->from($this->table)
                ->where('id_user', $this->session->userdata('user_id'))
                ->where('status =','keranjang');
        $query = $this->db->get_compiled_select();
        $transaksi  = $this->db->query($query)->row_array();
        if($transaksi == "") {
            $hasil['count_produk']          = 0;
            return $hasil;
        }

        $this->db->select('a.id, a.harga, a.jumlah,a.catatan, b.nama_produk, b.gambar')
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
        $hasil['count_produk']          = count($produk);
        $i = 0;
        foreach($produk as $p){
            $hasil['produk'][$i]['id'] = $p['id'];
            $hasil['produk'][$i]['harga'] = $p['harga'];
            $hasil['produk'][$i]['jumlah'] = $p['jumlah'];
            $hasil['produk'][$i]['nama_produk'] = $p['nama_produk'];
            $hasil['produk'][$i]['gambar'] = $p['gambar'];
            $hasil['produk'][$i]['catatan'] = $p['catatan'];
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
        // print('<pre>');print_r($detail_transaksi);exit();
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

    public function updateTransaksi($post)
    {
        $this->db->select()
            ->from('transaksi')
            ->where("id", $post['id']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
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
    
    public function getTransaksi($id)
    {
        $this->db->select()
                ->from('transaksi')
                ->where('id_user', $id)
                ->where('status !=','keranjang');
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function getDetailTransaksi($id)
    {
        $this->db->select('a.harga as total_harga,a.catatan,a.jumlah,b.nama_produk,b.harga,c.nama')
                ->from('detail_transaksi as a')
                ->join('produk as b','b.id=a.id_produk')
                ->join('kategori as c','c.id=b.id_kategori')
                ->where('a.id_transaksi', $id);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        $this->db->select()
                ->from('transaksi')
                ->where('id',$id);
        $query2 = $this->db->get_compiled_select();
        $data2  = $this->db->query($query2)->row_array();
        
        $i = 0;
        $subtotal = 0;
        foreach ($data as $d){
            $hasil['detail'][$i]['nama_barang']   = $d['nama_produk'];
            $hasil['detail'][$i]['harga']         = number_format($d['harga'],0,',','.');
            $hasil['detail'][$i]['total_harga']   = number_format($d['total_harga'] * $d['jumlah'],0,',','.'); 
            $hasil['detail'][$i]['catatan']       = $d['catatan']; 
            $hasil['detail'][$i]['jumlah']        = $d['jumlah']; 
            $hasil['detail'][$i]['kategori']      = $d['nama']; 
            $subtotal += $d['jumlah'] * $d['total_harga'];
            $i++;
        }
        $hasil['ongkir']    = number_format($data2['ongkir'],0,',','.');
        $hasil['subtotal']  = number_format($subtotal,0,',','.');
        $hasil['total']     = number_format($data2['total_pembelian'],0,',','.');
        
        return $hasil;
    }
}