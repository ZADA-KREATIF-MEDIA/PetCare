<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Produk extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProdukModel', 'mod');
        $this->load->model('KategoriModel', 'mod2');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "produk";
        $data['produk'] = $this->mod->getAllJoin(); //ambil data produk dan model yang berelasi 
        templateAdmin('admin/produk/index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Data produk";
        $data['kategori'] = $this->mod2->getAll(); //ambil semua data kategori
        templateAdmin('admin/produk/create', $data);
    }
    public function store()
    {
        $config['upload_path']          = './assets/gambar_produk/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            redirect('admin/produk/create', $error);
        } else {
            $file = $this->upload->data();
            $file_names = $file['raw_name'] . $file['file_ext'];
            $data = array('gambar' => $this->upload->data());
            $data['nama_produk'] = $this->input->post('nama_produk');
            $data['id_kategori'] = $this->input->post('id_kategori');
            $data['gambar'] = $file_names;
            $data['harga'] = $this->input->post('harga');
            $this->mod->save($data);
            redirect('admin/produk/index');
        }
    }
    public function update($id)
    {
        $data['title'] = "Update Data produk";
        $data['produk'] = $this->mod->getById($id);
        $data['kategori'] = $this->mod2->getAll();
        //print("<pre>".print_r($data,true)."</pre>");
        templateAdmin('admin/produk/update', $data);
    }
    public function update_save()
    {
        $id = $this->input->post('id');
        $data['nama_produk'] = $this->input->post('nama_produk');
        $data['id_kategori'] = $this->input->post('id_kategori');
        $data['harga'] = $this->input->post('harga');
        //print("<pre>".print_r($data,true)."</pre>");
        $this->mod->update($data, $id);
        redirect('admin/produk/index');
    }
    public function delete($id)
    {
        $this->mod->delete($id);
        redirect(site_url('admin/produk/index'));
    }
}
