<?php

class LaporanModel extends CI_Model {

  
    public function laporan_omset_jarak()
    {
        $date_start = $this->input->post('filter')['date_start'];
        $date_end = $this->input->post('filter')['date_end'];
        $kurir = $this->input->post('filter')['kurir'];
        $pengirim = $this->input->post('filter')['customer'];
        $jenis_pembayaran = $this->input->post('filter')['jenis_pembayaran'];
        $status_pembayaran = $this->input->post('filter')['status_pembayaran'];
        $jarak_awal = $this->input->post('filter')['jarak_awal'];
        $jarak_akhir = $this->input->post('filter')['jarak_akhir'];

        $this->db->select('DATE(oc.tanggal_order) AS Tanggal, oc.id_order AS TrxID,
                            TIME(oc.tanggal_order) AS TimeOrder, r.nama_rider AS Kurir,oc.jarak as Jarak,
                            c.nama AS Nama_Pengirim, oc.total AS Ongkir_Final, oc.nama_penerima as Nama_Penerima, odr.status_berat as Kondisi_Barang');
        $this->db->from('order_customer AS oc');
        $this->db->join('rider AS r','r.id_rider=oc.id_rider');
        $this->db->join('order_detail_customer AS od','od.id_order=oc.id_order');
        $this->db->join('customer AS c','c.id_customer=oc.id_customer');
        $this->db->join('order_driver AS odr','odr.id_order=oc.id_order');
        $this->db->where('oc.status_order =','selesai');


        if($date_start != "" && $date_end != ""){
            $this->db->where('oc.tanggal_order >=', $date_start);
            $this->db->where('oc.tanggal_order <=', $date_end);
        }
        if($jenis_pembayaran != ""){
            $this->db->where('LOWER(oc.jenis_pembayaran)', $jenis_pembayaran);
        }
        if($status_pembayaran != ""){
            $this->db->where('LOWER(oc.status_pembayaran)', $status_pembayaran);
        }
        if($kurir != ""){
            $this->db->where('oc.id_rider', $kurir);
        }
        if($pengirim != ""){
            $this->db->where('oc.id_customer', $pengirim);
        }
        if($jarak_awal != "" && $jarak_akhir != ""){
            $this->db->where('oc.jarak >=', $jarak_awal);
            $this->db->where('oc.jarak <=', $jarak_akhir);
        }
        $this->db->order_by('r.nama_rider','ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function laporan_omset_member()
    {
        $date_start = $this->input->post('filter')['date_start'];
        $date_end = $this->input->post('filter')['date_end'];
        $kurir = $this->input->post('filter')['kurir'];
        $member = $this->input->post('filter')['member'];
        $jenis_pembayaran = $this->input->post('filter')['jenis_pembayaran'];
        $status_pembayaran = $this->input->post('filter')['status_pembayaran'];
        $jarak_awal = $this->input->post('filter')['jarak_awal'];
        $jarak_akhir = $this->input->post('filter')['jarak_akhir'];

        // $this->db->select('oc.tanggal_order AS tanggal,c.nama AS member,c.referal_code AS kode_referal,
        //                     (SELECT GROUP_CONCAT(c.nama SEPARATOR ", ") FROM customer AS c WHERE c.level != "member" AND c.referal_code=kode_referal GROUP BY c.referal_code) AS child,
        //                     oc.jarak, oc.charge AS ongkir, r.nama_rider AS kurir');
        $this->db->select('oc.tanggal_order AS tanggal, (SELECT nama FROM customer WHERE referal_code=oc.referal_code LIMIT 1) AS member,
        oc.referal_code kode_referal,(SELECT nama FROM customer WHERE id_customer=oc.id_customer LIMIT 1) AS child,oc.jarak, oc.total AS ongkir, r.nama_rider AS kurir');
        $this->db->from('order_customer AS oc');
        $this->db->join('rider AS r','r.id_rider=oc.id_rider');
        $this->db->join('customer AS c','c.referal_code=oc.referal_code');
        $this->db->where('oc.status_order','selesai');        
        if($member != ""){
            $this->db->where('c.id_customer', $member);
        }       

        // if($date_start != "" && $date_end != ""){
            $this->db->where('oc.tanggal_order >=', $date_start);
            $this->db->where('oc.tanggal_order <=', $date_end);
        // }
        if($kurir != ""){
            $this->db->where('oc.id_rider', $kurir);
        }
        if($jenis_pembayaran != ""){
            $this->db->where('LOWER(oc.jenis_pembayaran)', $jenis_pembayaran);
        }
        if($status_pembayaran != ""){
            $this->db->where('LOWER(oc.status_pembayaran)', $status_pembayaran);
        }
        // if($kode_referal != ""){
        //     $this->db->where('oc.referal_code', $kode_referal);
        //     // $this->db->where('c.referal_code', $kode_referal);
        // }else{
            
            $this->db->where('oc.referal_code IS NOT NULL');
            $this->db->where('oc.referal_code !=',' ');
        // }
       
        if($jarak_awal != "" && $jarak_akhir != ""){
            $this->db->where('oc.jarak >=', $jarak_awal);
            $this->db->where('oc.jarak <=', $jarak_akhir);
        }
        $this->db->order_by('oc.tanggal_order','DESC');
        $query = $this->db->get();
        return $query->result();
    }
  
    
}