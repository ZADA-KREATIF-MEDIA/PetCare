<?php

class HomeModel extends CI_Model {

    public function m_get_iklan()
    {
        $this->db->select()
            ->from('iklan')
            ->where("status = 'aktif'");
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_save_daftar($post)
    {
        $this->db->insert('customer', $post);
        return true;
    }
    
}