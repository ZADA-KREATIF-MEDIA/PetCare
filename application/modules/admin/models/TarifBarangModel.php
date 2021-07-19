<?php

class TarifBarangModel extends CI_Model {

  
    public function getAllTarif()
    {
        $query = $this->db->get('tarif_barang');
        return $query->result();
    }
  
    public function create()
    {
        $data = [
            "harga_overweight" => $this->input->post('harga_overweight',true),
            "harga_oversize" => $this->input->post('harga_oversize', true),
            "harga_normal" => $this->input->post('harga_normal', true),
            "kategori" => $this->input->post('kategori', true),
            "status" => $this->input->post('status', true)
        ];

        $this->db->insert('tarif_barang', $data);
    }
    
    public function update()
    {
        $id = $this->input->post('id_tarif_barang');

        $data = [
            "harga_overweight" => $this->input->post('harga_overweight',true),
            "harga_oversize" => $this->input->post('harga_oversize', true),
            "harga_normal" => $this->input->post('harga_normal', true),
            "kategori" => $this->input->post('kategori', true),
            "status" => $this->input->post('status', true)
        ];
        $this->db->where('id', $id);
        $this->db->update('tarif_barang', $data);
    }

    public function delete($id)
    {
        $this->db->delete('tarif_barang', ['id' => $id]);

    }
    
}