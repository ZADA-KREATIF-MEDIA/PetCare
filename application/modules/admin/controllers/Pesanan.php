<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PesananModel', 'mod');
        $this->load->model('KategoriModel', 'mod2');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "pesanan";
        $data['pesanan'] = $this->mod->getAll(); //ambil data pesanan dan model yang berelasi 
        templateAdmin('admin/pesanan/index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Data pesanan";
        //$data['kategori'] = $this->mod2->getAll(); //ambil semua data kategori
        templateAdmin('admin/pesanan/create', $data);
    }
    public function store()
    {
        $config['upload_path']          = './assets/gambar_pesanan/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            redirect('admin/pesanan/create', $error);
        } else {
            $file = $this->upload->data();
            $file_names = $file['raw_name'] . $file['file_ext'];
            $data = array('gambar' => $this->upload->data());
            $data['nama_pesanan'] = $this->input->post('nama_pesanan');
            $data['id_kategori'] = $this->input->post('id_kategori');
            $data['gambar'] = $file_names;
            $data['harga'] = $this->input->post('harga');
            $this->mod->save($data);
            redirect('admin/pesanan/index');
        }
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
