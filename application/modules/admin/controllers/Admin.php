<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('AdminModel', 'mod');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "Admin";
        $data['admin'] = $this->mod->getAll();
        templateAdmin('admin/admin/index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Data admin";
        templateAdmin('admin/admin/create', $data);
    }
    public function store()
    {
        $password = $this->input->post('password', true);
        $post = [
            'email'      => $this->input->post('email', true),
            'password'      => password_hash($password, PASSWORD_BCRYPT),
        ];
        $this->mod->save($post);
        redirect('admin/admin/index');
    }
    public function update($id)
    {
        $data['title'] = "Update Data admin";
        $data['admin'] = $this->mod->getById($id);
        templateAdmin('admin/admin/update', $data);
    }
    public function update_save()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $id = $this->input->post('id');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $this->mod->update($data, $id);
        redirect('admin/admin/index');
    }
    public function delete($id)
    {
        $this->mod->delete($id);
        redirect(site_url('admin/admin/index'));
    }
}
