<?php
class PelangganModel extends CI_Model
{
    protected $table = 'user';
    
    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function getAllJoin()
    {
        $this->db
            ->select('pelanggan.id,pelanggan.nama_pelanggan,pelanggan.harga,pelanggan.gambar,pelanggan.id_kategori,kategori.nama')
            ->from($this->table)
            ->join('kategori', 'pelanggan.id_kategori = kategori.id', 'LEFT');
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
