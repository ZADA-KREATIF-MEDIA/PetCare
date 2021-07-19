<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gantikurir extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GantiKurirModel', 'ganti_kurir');
        $this->load->model('OrdersModel', 'orders');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Data Ganti Kurir';
        $data['ganti_kurir'] = $this->ganti_kurir->getAllGantiKurir();
        $data['drivers'] = $this->orders->getAllAvailableKurir();
        adminView('gantikurir/index', $data);
    }

    public function ganti_kurir()
    {
        if($this->ganti_kurir->update_kurir()){
            $this->orders->update_kurir();
            $this->session->set_flashdata('success', 'Sukses mengganti kurir');
            
        }else{
            $this->session->set_flashdata('danger', 'Gagal mengganti kurir');
        }
        redirect('admin/gantikurir');
    }
}