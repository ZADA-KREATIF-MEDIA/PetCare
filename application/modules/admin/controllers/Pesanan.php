<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PesananModel', 'mod');
        $this->load->model('DetailPesananModel', 'mod2');
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
        $data['detail_pesanan'] = $this->mod2->getAllJoin($id);
        //print("<pre>".print_r($data,true)."</pre>");
        templateAdmin('admin/pesanan/update', $data);
    }
    public function update_save()
    {
        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');
        //print("<pre>".print_r($data,true)."</pre>");
        $this->mod->update($data, $id);
        redirect('admin/pesanan/index');
    }
    public function cetak($id)
    {
        $data['title'] = "NOTA PESANAN";
        $data['pesanan'] = $this->mod->getById($id);
        $data['detail_pesanan'] = $this->mod2->getAllJoin($id);
        $this->load->view('admin/pesanan/cetak',$data);
    }
    public function delete($id)
    {
        $this->mod->restoreTransaksi($id);
        $this->mod->delete($id);
        redirect(site_url('admin/pesanan/index'));
    }

}
