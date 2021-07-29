<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TarifModel', 'mod');
    }
    public function index()
    {
        $data['tanggal'] = date('d-m-Y');
        $data['title'] = "Tarif";
        $data['tarif'] = $this->mod->getAll();
        templateAdmin('admin/tarif/index', $data);
    }
    public function create()
    {
        $data['title'] = "Tambah Data tarif";
        templateAdmin('admin/tarif/create', $data);
    }
    public function store()
    {
        $post = [
            'jarak_minimal'      => $this->input->post('jarak_minimal', true),
            'harga_jarak_minimal'      => $this->input->post('harga_jarak_minimal', true),
            'harga'      => $this->input->post('harga', true),
            'status_jarak_minimal'      => $this->input->post('status_jarak_minimal', true),
        ];

        //print("<pre>".print_r($post,true)."</pre>");
        $this->mod->save($post);
        redirect('admin/tarif/index');
    }
    public function update($id)
    {
        $data['title'] = "Update Data tarif";
        $data['tarif'] = $this->mod->getById($id);
       //print("<pre>".print_r($post,true)."</pre>");
        templateAdmin('admin/tarif/update', $data);
    }
    public function update_save()
    {
        $id = $this->input->post('id');
        echo $id;
        $data['jarak_minimal'] = $this->input->post('jarak_minimal');
        $data['harga_jarak_minimal'] = $this->input->post('harga_jarak_minimal');
        $data['harga'] = $this->input->post('harga');
        $data['status_jarak_minimal'] = $this->input->post('status_jarak_minimal');
        //print("<pre>".print_r($data,true)."</pre>");
        $this->mod->update($data, $id);
        redirect('admin/tarif/index');
    }
    public function delete($id)
    {
        $this->mod->delete($id);
        redirect(site_url('admin/tarif/index'));
    }

}
