<?php
class PesananModel extends CI_Model
{
    protected $table = 'transaksi';
    
    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function getAllJoin()
    {
        $this->db
            ->select('transaksi.id, user.nama,transaksi.alamat_pengambilan,transaksi.total_pembelian,transaksi.ongkir,transaksi.catatan,transaksi.status,transaksi.kode_uniq')
            ->from($this->table)
            ->join('user', 'transaksi.id_user = user.id', 'LEFT');
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
    
    public function restoreTransaksi($id)
    {
        $this->db->select('id_produk,jumlah')
                ->from('detail_transaksi')
                ->where('id_transaksi',$id);
        $query = $this->db->get_compiled_select();
        $trx  = $this->db->query($query)->result_array();
        $i=0;
        foreach($trx as $tr){
            $this->db->select('stock')
                    ->from('produk')
                    ->where('id',$tr['id_produk']);
            $query = $this->db->get_compiled_select();
            $produk  = $this->db->query($query)->row_array();
            $post[$i] = [
                'id'        => $tr['id_produk'],
                'stock'     => $tr['jumlah'] + $produk['stock']
            ];
            $i++;
        }
        // print('<pre>');print_r($post);exit();
        $this->db->update_batch('produk', $post, 'id');
        return true;
    }
}
