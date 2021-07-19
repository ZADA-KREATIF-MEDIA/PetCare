<?php

class IklanModel extends CI_Model {

  
    public function getAllIklan()
    {
        $query = $this->db->get('iklan');
        return $query->result();
    }
    public function getIklan($id)
    {
        $query = $this->db->get_where('iklan', ['id_iklan' => $id]);
        return $query->row();
    }
    public function update_status_iklan($id_iklan,$status_iklan)
    {
        $data = [
            "status" => $status_iklan
        ];
        try{
            $this->db->where('id_iklan', $id_iklan);
            $this->db->update('iklan', $data);
            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function create_iklan()
    {
        
        $status = $this->input->post('status', true);
        $gambar_iklan = time();
        $data = [
            "gambar_iklan" =>$this->_uploadImage($gambar_iklan),
            "status" => $status,
        ];

        $this->db->insert('iklan', $data);
    }
    public function update()
    {
        $id_iklan = $this->input->post('id_iklan');
        $old_image = $this->input->post('old_image', true);
        $status = $this->input->post('status', true);
        $newgambar_iklan = time();

        if (!empty($_FILES["gambar_iklan"]["name"])) {
            $gambar_iklan = $this->_uploadImage($newgambar_iklan);
            if($old_image != "default.png"){
                $img_file = "./assets/frontend/img/iklan/".$old_image;
                unlink($img_file);
            }
        } else {
            $gambar_iklan = $old_image;
        }
        
        
        $data = [
            "gambar_iklan" => $gambar_iklan,
            "status" => $status
        ];
       
        $this->db->where('id_iklan', $id_iklan);
        $this->db->update('iklan', $data);
    }
    public function delete($id)
    {
        try{

            $this->db->delete('iklan', ['id_iklan' => $id]);
            return true;
        }catch(\SQLException $e){
            return $e->getMessage();
        }

    }
    private function _uploadImage($gambar_iklan)
    {

        $config['upload_path']          = './assets/frontend/img/iklan/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = $gambar_iklan;
        $config['overwrite']			= true;
        // $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_iklan')) {
            return $this->upload->data("file_name");
        }
        
        return "default.png";
    }
    
}