<?php

class HomeModel extends CI_Model
{

    protected $table = 'user';

    public function saveUser($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }
}
