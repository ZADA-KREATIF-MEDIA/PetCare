<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrdersModel', 'orders');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Orders';
        $data['orders'] = $this->orders->getAllOrders();
        $data['drivers'] = $this->orders->getAllAvailableKurir();
        adminView('orders/index', $data);
    }

    public function pilih_kurir()
    {
        if($this->orders->update_kurir()){
            $this->session->set_flashdata('success', 'Sukses memilih kurir');
            
        }else{
            $this->session->set_flashdata('danger', 'Gagal memilih kurir');
        }
        redirect('admin/orders');
    }
    public function lunas_bayar($id)
    {

        if($this->orders->update_lunas_bayar($id)){
            $this->session->set_flashdata('success', 'Status bayar berhasil diperbarui');
            
        }else{
            $this->session->set_flashdata('danger', 'Status bayar gagal diperbarui');
        }
        redirect('admin/orders');

    }
    public function batal_pesanan($id_order)
    {

        if($this->orders->batal_pesanan($id_order)){
            $this->session->set_flashdata('success', 'Pesanan telah dibatalkan');
            
        }else{
            $this->session->set_flashdata('danger', 'Pesanan gagal dibatalkan');
        }
        redirect('admin/orders');

    }
    public function paid_billing()
    {
        
        if($this->orders->paid_billing()){
            $this->session->set_flashdata('success', 'Billing sukses dibayarkan');
            
        }else{
            $this->session->set_flashdata('danger', 'Billing gagal dibayarkan');
        }
        redirect('admin/orders');
    }
}