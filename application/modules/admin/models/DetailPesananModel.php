<?php
class DetailPesananModel extends CI_Model
{
    protected $table = 'detail_transaksi';
    
    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function getAllJoin($id)
    {
        $this->db
            ->select('detail_transaksi.id_transaksi, p.nama_produk, detail_transaksi.harga, detail_transaksi.catatan, detail_transaksi.jumlah')
            ->from($this->table)
            ->join('produk p', 'detail_transaksi.id_produk = p.id', 'LEFT')
            ->join('transaksi t', 'detail_transaksi.id_transaksi = t.id', 'LEFT')
            ->where("detail_transaksi.id_transaksi=$id");
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
