<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MX_Controller
{
    public function index ()
    {
        $data['tanggal']=date('d-m-Y');
        $data['title']="Kategori";
        templateAdmin('admin/kategori/index', $data);
    }
    public function create()
    {
        $data['title']="Tambah Data Kategori";
        templateAdmin('admin/kategori/form',$data);
    }
    public function store()
    {
        $nama=$this->input->post('nama');
        echo $nama;
    }
    public function update()
    {

    }
    public function delete()
    {

    }

}
