<?php

class AdminModel extends CI_Model
{

    public function getAllUsers()
    {
        $username = $this->session->userdata('username');
        if($this->session->userdata('level') == 1){
            $this->db->where('username != ',$username);
            $query = $this->db->get('admin');
            return $query->result();

        }else if($this->session->userdata('level') == 2){
            $this->db->where('username != ',$username);
            $this->db->where('level != ',1);
            $query = $this->db->get('admin');
            return $query->result();
        }
    }
    public function create()
    {
        $data = [
            "username" => $this->input->post('username',true),
            "password" => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
            "level" => $this->input->post('level', true),
            "status" => $this->input->post('status', true)
        ];

        $this->db->insert('admin', $data);
    }
    public function update()
    {
        $id = $this->input->post('id_admin', true);
        $username = $this->input->post('username',true);
        $password = $this->input->post('password');
        $level = $this->input->post('level', true);
        $status = $this->input->post('status', true);

        if(empty($password)){
            $data = [
                "username" => $username,
                "level" => $level,
                "status" => $status
            ];
        }else{
            $data = [
                "username" => $username,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "level" => $level,
                "status" => $status
            ];
        }
        
        $this->db->where('id_admin', $id);
        $this->db->update('admin', $data);
    }

    public function update_status_user($id_admin,$status_user)
    {
        $data = [
            "status" => $status_user
        ];
        try{
            $this->db->where('id_admin', $id_admin);
            $this->db->update('admin', $data);
            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function getAdmin($username)
    {
        return $this->db->get_where('admin', ['username' => $username])->row();
    }


    public function changePassword($data)
    {
        $this->db->set('password', $data['password']);
        $this->db->where('id_admin', $data['id_admin']);
        $this->db->update('admin');
    }

    public function delete($id)
    {
        $this->db->delete('admin', ['id_admin' => $id]);

    }
}