<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PesananModel', 'mod');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "pesanan";
        $data['pesanan'] = $this->mod->getAllJoin(); //ambil data pesanan dan model yang berelasi 
        templateAdmin('admin/pesanan/index', $data);
    }
    public function update($id)
    {
        
        $data['title'] = "Update Data pesanan";
        $data['pesanan'] = $this->mod->getById($id);
        //$data['kategori'] = $this->mod2->getAll();
        //print("<pre>".print_r($data,true)."</pre>");
        templateAdmin('admin/pesanan/update', $data);
    }
    public function update_save()
    {
        $id = $this->input->post('id');
        $data['nama_pesanan'] = $this->input->post('nama_pesanan');
        $data['id_kategori'] = $this->input->post('id_kategori');
        $data['harga'] = $this->input->post('harga');
        //print("<pre>".print_r($data,true)."</pre>");
        $this->mod->update($data, $id);
        redirect('admin/pesanan/index');
    }
    public function delete($id)
    {
        $this->mod->delete($id);
        redirect(site_url('admin/pesanan/index'));
    }

}
