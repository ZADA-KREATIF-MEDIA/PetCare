<?php
class ProdukModel extends CI_Model
{
    protected $table = 'produk';
    

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function getAllJoin()
    {
        $this->db->select('*')
            ->from($this->table)
            ->join('kategori', 'produk.id_kategori = kategori.id', 'LEFT'); //kostumisari query//
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getByID($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id' => $id));
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }
}
