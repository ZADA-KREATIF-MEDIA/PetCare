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
        $post = [
            'nama'      => $this->input->post('nama', true),
            'id_kategori'      => $this->input->post('id_kategori', true),
            'harga'      => $this->input->post('harga', true),
            'gambar'      => $this->input->post('gambar', true),
        ];
        print("<pre>" . print_r($post, true) . "</pre>");


        $config['upload_path'] = './assets/backend/img/gambar_produk';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['encrypt_name']            = TRUE;
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            echo "errod if 1";
        } else {

            $this->mod->save($post);
            echo "error 2";
        }

        //$this->mod->save($post);
        //redirect('admin/produk/index');
    }
    public function update($id)
    {
        $data['title'] = "Update Data produk";
        $data['produk'] = $this->mod->getById($id);
        //print("<pre>".print_r($post,true)."</pre>");
        templateAdmin('admin/produk/update', $data);
    }
    public function update_save()
    {
        $id = $this->input->post('id');
        echo $id;
        $data['nama'] = $this->input->post('nama');
        $data['id_kategori'] = $this->input->post('id_kategori');
        $data['harga'] = $this->input->post('harga');
        $data['status_nama'] = $this->input->post('status_nama');
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
