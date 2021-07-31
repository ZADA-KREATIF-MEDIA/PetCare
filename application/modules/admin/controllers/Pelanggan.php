<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PelangganModel', 'mod');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "pelanggan";
        $data['pelanggan'] = $this->mod->getAll();
        templateAdmin('admin/pelanggan/index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Data pelanggan";
        templateAdmin('admin/pelanggan/create', $data);
    }
    // public function store()
    // {
    //     $post = [
    //         'nama'      => $this->input->post('nama', true),
    //     ];
    //     $this->mod->save($post);
    //     redirect('admin/pelanggan/index');
    // }
    public function update($id)
    {
        $data['title'] = "Update Data Pelanggan";
        $data['pelanggan'] = $this->mod->getById($id);
        templateAdmin('admin/pelanggan/update', $data);
    }
    public function update_save()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $id = $this->input->post('id');
        $data['nama'] = $this->input->post('nama');
        $data['no_hp'] = $this->input->post('no_hp');
        $data['alamat'] = $this->input->post('alamat');
        $data['koordinat_alamat'] = $this->input->post('koordinat_alamat');
        $this->mod->update($data, $id);
        redirect('admin/pelanggan/index');
    }
    public function delete($id)
    {
        $this->mod->delete($id);
        redirect(site_url('admin/pelanggan/index'));
    }
}
