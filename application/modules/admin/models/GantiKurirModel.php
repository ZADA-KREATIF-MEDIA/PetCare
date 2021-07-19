<?php

class GantiKurirModel extends CI_Model {

  
    public function getAllGantiKurir()
    {
        $this->db->select('gd.*,r.nama_rider AS driver_lama,(SELECT nama_rider FROM rider WHERE id_rider=id_driver_baru) AS driver_baru, oc.tanggal_order');
        $this->db->from('ganti_driver AS gd');
        $this->db->join(' order_customer AS oc','oc.id_order=gd.id_orderan');
        $this->db->join('rider AS r','r.id_rider=gd.id_driver_lama');
        $this->db->order_by('id_driver_baru','ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function update_kurir()
    {
        $id_order = $this->input->post('id_order', true);

        $data = [
            "id_driver_baru" => $this->input->post('id_rider',true)
        ];
        try{
            $this->db->where('id_orderan', $id_order);
            $this->db->update('ganti_driver', $data);
            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}