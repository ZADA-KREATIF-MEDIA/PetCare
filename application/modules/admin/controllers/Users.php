<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel', 'admin');
        is_logged_in(3);
    }
    public function index()
    {
        $data['title'] = 'Data Users';
        $data['users'] = $this->admin->getAllUsers();

        adminView('users/index', $data);
    }
    public function create()
    {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $username=$this->input->post('username', true);
        $user = $this->admin->getAdmin($username);
        if($user->username == $username){
            $this->session->set_flashdata('danger', 'Username sudah terdaftar');
            redirect('admin/users');
        }else{
            if ($this->form_validation->run() == FALSE) {
                redirect('admin/users');
            } else {
                $this->admin->create();
                $this->session->set_flashdata('success', 'Data User Berhasil Ditambah');
                
                redirect('admin/users');
            }
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/users');
        } else {
            $this->admin->update();
            $this->session->set_flashdata('success', 'Data User Berhasil Diperbarui');
            redirect('admin/users');
        }
    }
    public function status_user()
    {
        $id_admin = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        if($status == "aktif"){
            $status_user = "tidak";
        }else if($status =="tidak"){
            $status_user = "aktif";
        }

        if($this->admin->update_status_user($id_admin,$status_user)){
            $this->session->set_flashdata('success', 'Status user berhasil diperbarui');
            
        }else{
            $this->session->set_flashdata('danger', 'Status user gagal diperbarui');
        }
        redirect('admin/users');

    }
    public function delete($id)
    {
        $this->admin->delete($id);
        $this->session->set_flashdata('success', 'Data User Berhasil Dihapus');
        redirect('admin/users');;
    }
}