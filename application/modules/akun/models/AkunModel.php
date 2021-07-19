<?php

class AkunModel extends CI_Model {

    public function m_show_details_account($id_customer)
    {
        $this->db->select()
            ->from('customer')
            ->where("id_customer", $id_customer);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_show_use_referal($referal)
    {
        $this->db->select("b.nama_pengirim")
            ->from('customer AS a')
            ->join('order_customer AS b','a.referal_code=b.referal_code')
            ->where("a.referal_code", $referal);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_show_details_account_driver($id_driver)
    {
        $this->db->select()
            ->from('rider')
            ->where("id_rider", $id_driver);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }
    
}