<?php

class TarifOngkirModel extends CI_Model {

  
    public function getAllTarif()
    {
        $query = $this->db->get('tarif_ongkir');
        return $query->result();
    }
  
    public function create()
    {
        $data = [
            "jarak_minimal" => $this->input->post('jarak_minimal',true),
            "status_jarak_minimal" => $this->input->post('status_jarak_minimal', true),
            "harga_jarak_minimal" => $this->input->post('harga_jarak_minimal', true),
            "harga" => $this->input->post('harga', true),
            "kategori_harga" => $this->input->post('kategori_harga', true)
        ];

        $this->db->insert('tarif_ongkir', $data);
    }
    
    public function update()
    {
        $id = $this->input->post('id_tarif');

        $data = [
            "jarak_minimal" => $this->input->post('jarak_minimal',true),
            "status_jarak_minimal" => $this->input->post('status_jarak_minimal', true),
            "harga_jarak_minimal" => $this->input->post('harga_jarak_minimal', true),
            "harga" => $this->input->post('harga', true),
            "kategori_harga" => $this->input->post('kategori_harga', true)
        ];
        $this->db->where('id', $id);
        $this->db->update('tarif_ongkir', $data);
    }

    public function delete($id)
    {
        $this->db->delete('tarif_ongkir', ['id' => $id]);

    }
    
}