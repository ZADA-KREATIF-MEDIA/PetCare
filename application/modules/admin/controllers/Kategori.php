<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kategori extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KategoriModel', 'mod');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "Kategori";
        $data['kategori'] = $this->mod->getAll();
        templateAdmin('admin/kategori/index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Data Kategori";
        templateAdmin('admin/kategori/create', $data);
    }
    public function store()
    {
        $post = [
            'nama'      => $this->input->post('nama', true),
        ];
        $this->mod->save($post);
        redirect('admin/kategori/index');
    }
    public function update($id)
    {
        $data['title'] = "Update Data Kategori";
        $data['kategori'] = $this->mod->getById($id);
        templateAdmin('admin/kategori/update', $data);
    }
    public function update_save()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $id = $this->input->post('id');
        $data['nama'] = $this->input->post('nama');
        $this->mod->update($data, $id);
        redirect('admin/kategori/index');
    }
    public function delete($id)
    {
        $this->mod->delete($id);
        redirect(site_url('admin/kategori/index'));
    }
}
