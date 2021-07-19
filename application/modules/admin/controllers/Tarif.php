<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TarifOngkirModel', 'tarifongkir');
        $this->load->model('TarifBarangModel', 'tarifbarang');
        $this->load->model('IklanModel', 'iklan');
        is_logged_in(3);
    }
    public function index()
    {
        $data['title'] = 'Setting Tarif';
        $data['tarifongkir'] = $this->tarifongkir->getAllTarif();
        $data['iklan'] = $this->iklan->getAllIklan();

        adminView('tarif/index', $data);
    }
    public function create_tarif_ongkir()
    {

        $this->form_validation->set_rules('jarak_minimal', 'Jarak Minimal', 'required');
        $this->form_validation->set_rules('status_jarak_minimal', 'Status Jarak Minimal', 'required');
        $this->form_validation->set_rules('harga_jarak_minimal', 'Harga Jarak Minimal', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('kategori_harga', 'Kategori Harga', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/tarif');
        } else {
            $this->tarifongkir->create();
            $this->session->set_flashdata('success', 'Data Tarif Ongkir Berhasil Ditambah');
            redirect('admin/tarif');
        }
    }
    public function create_tarif_barang()
    {

        $this->form_validation->set_rules('harga_overweight', 'Harga Overweight', 'required');
        $this->form_validation->set_rules('harga_oversize', 'Harga Oversize', 'required');
        $this->form_validation->set_rules('harga_normal', 'Harga Normal', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/tarif');
            $this->session->set_flashdata('success', 'Data Tarif Barang Gagal Ditambah');
        } else {
            $this->tarifbarang->create();
            $this->session->set_flashdata('success', 'Data Tarif Barang Berhasil Ditambah');
            redirect('admin/tarif');
        }
    }
    public function update_tarif_barang()
    {

        $this->form_validation->set_rules('harga_overweight', 'Harga Overweight', 'required');
        $this->form_validation->set_rules('harga_oversize', 'Harga Oversize', 'required');
        $this->form_validation->set_rules('harga_normal', 'Harga Normal', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/tarif');
        } else {
            $this->tarifbarang->update();
            $this->session->set_flashdata('success', 'Data Tarif Barang Berhasil Diperbarui');
            redirect('admin/tarif');
        }
    }
    public function update_tarif_ongkir()
    {

        $this->form_validation->set_rules('jarak_minimal', 'Jarak Minimal', 'required');
        $this->form_validation->set_rules('status_jarak_minimal', 'Status Jarak Minimal', 'required');
        $this->form_validation->set_rules('harga_jarak_minimal', 'Harga Jarak Minimal', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('kategori_harga', 'Kategori Harga', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/tarif');
        } else {
            $this->tarifongkir->update();
            $this->session->set_flashdata('success', 'Data Tarif Ongkir Berhasil Diperbarui');
            redirect('admin/tarif');
        }
    }
    public function delete_barang($id)
    {
        $this->tarifbarang->delete($id);
        $this->session->set_flashdata('success', 'Data Tarif Barang Berhasil Dihapus');
        redirect('admin/tarif');;
    }
    public function delete_ongkir($id)
    {
        $this->tarifongkir->delete($id);
        $this->session->set_flashdata('success', 'Data Tarif Ongkir Berhasil Dihapus');
        redirect('admin/tarif');;
    }
    public function status_iklan()
    {
        $id_iklan = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        if($status == "aktif"){
            $status_iklan = "tidak";
        }else if($status =="tidak"){
            $status_iklan = "aktif";
        }

        if($this->iklan->update_status_iklan($id_iklan,$status_iklan)){
            $this->session->set_flashdata('success', 'Status iklan berhasil diperbarui');
            
        }else{
            $this->session->set_flashdata('danger', 'Status iklan gagal diperbarui');
        }
        redirect('admin/tarif');

    }
    public function create_iklan()
    {
        $this->form_validation->set_rules('status', 'Status Iklan', 'required');
        // $this->form_validation->set_rules('gambar_iklan', 'Gambar Iklan', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/tarif');
        } else {
            $this->iklan->create_iklan();
            $this->session->set_flashdata('success', 'Data Iklan Berhasil Ditambah');
            redirect('admin/tarif');
        }
    }
    public function update_iklan()
    {
        $this->form_validation->set_rules('status', 'Status Iklan', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/tarif');
        } else {
            $this->iklan->update();
            $this->session->set_flashdata('success', 'Data Iklan Berhasil Diperbarui');
            redirect('admin/tarif');
        }
    }
    public function delete_iklan($id)
    {
        $iklan = $this->iklan->getIklan($id);

        if($iklan){
            if($this->iklan->delete($id)){
                $img_file = "./assets/frontend/img/iklan/".$iklan->gambar_iklan;
                unlink($img_file);
            }
            $this->session->set_flashdata('success', 'Data Iklan Berhasil Dihapus');
        }
        redirect('admin/tarif');;
    }
}