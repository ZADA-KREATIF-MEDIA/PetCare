<?php
class ProdukModel extends CI_Model
{
    protected $table='produk';

    public function getAllkategori()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function getKategoriByid($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    public function saveKategori($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }
    public function updateSave($data,$id)
    {
        return $this->db->update($this->table, $data, array('id' => $id));
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }
}
