<?php

class DriversModel extends CI_Model {

  
    public function getAllDrivers()
    {
        $query = $this->db->get('rider');
        return $query->result();
    }
    
    public function getDriver($id)
    {
        $query = $this->db->get_where('rider', ['id_rider' => $id]);
        return $query->row();
    }
  
    public function create()
    {
        $nama_rider = $this->input->post('nama_rider',true);
        $alamat = $this->input->post('alamat', true);
        $no_telpn = $this->input->post('no_telpn', true);
        $plat_nomor = $this->input->post('plat_nomor', true);
        $status = $this->input->post('status', true);
        $tanggal_bergabung = $this->input->post('tanggal_bergabung', true);
        $data = [
            "nama_rider" => $nama_rider,
            "no_telpn" => $no_telpn,
            "password" => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
            "alamat" => $alamat,
            "plat_nomor" => $plat_nomor,
            "status" => $status,
            "tanggal_bergabung" => $tanggal_bergabung,
            "foto" =>$this->_uploadImage($nama_rider)
        ];

        $this->db->insert('rider', $data);
    }
    
    public function update()
    {
        $id = $this->input->post('id_rider');
        $nama_rider = $this->input->post('nama_rider',true);
        $alamat = $this->input->post('alamat', true);
        $plat_nomor = $this->input->post('plat_nomor', true);
        $no_telpn = $this->input->post('no_telpn', true);
        $status = $this->input->post('status', true);
        $old_image = $this->input->post('old_image', true);
        $password = $this->input->post('password', true);

        if (!empty($_FILES["foto"]["name"])) {
            $foto = $this->_uploadImage($nama_rider);
            if($old_image != "profile.png"){
                $img_file = "./assets/backend/img/driver/".$old_image;
                unlink($img_file);
            }
        } else {
            $foto = $old_image;
        }
        
        
        $data = [
            "nama_rider" => $nama_rider,
            "alamat" => $alamat,
            "no_telpn" => $no_telpn,
            "plat_nomor" => $plat_nomor,
            "status" => $status,
            "foto" => $foto
        ];
        if(!empty($password)){
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            // var_dump($data);
            // die;
        }
        $this->db->where('id_rider', $id);
        $this->db->update('rider', $data);
    }

    public function update_status_driver($id_driver,$status_driver)
    {
        $data = [
            "status" => $status_driver
        ];
        try{
            $this->db->where('id_rider', $id_driver);
            $this->db->update('rider', $data);
            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function delete($id)
    {
        try{

            $this->db->delete('rider', ['id_rider' => $id]);
            return true;
        }catch(\SQLException $e){
            return $e->getMessage();
        }

    }
    private function _uploadImage($nama_rider)
    {

        $nama_file = str_replace(" ","",strtolower($nama_rider)).time();
        $config['upload_path']          = './assets/backend/img/driver/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = $nama_file;
        $config['overwrite']			= true;
        // $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        
        return "profile.png";
    }
}