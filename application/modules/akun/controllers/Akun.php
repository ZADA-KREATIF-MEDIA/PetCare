<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AkunModel', 'mod');
    }
    
    public function index()
    {
        is_logged_in_user();
        $data['title']  = 'Akun';
        $id_customer    = $this->session->userdata('cust_id_customer');
        $data['akun']   = $this->mod->m_show_details_account($id_customer);
        if($data['akun']['referal_code']!=""){
            $referal = $data['akun']['referal_code'];
            $data['pengguna_referal'] = $this->mod->m_show_use_referal($referal);
        }
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu');
        $this->load->view('index');
        $this->load->view('templates/frontend/depan/footer');
    }

    public function akun_driver()
    {
        is_logged_in_rider();
        $id_driver      =  $this->session->userdata('rider_id_rider');
        $data['title']  = "Akun Driver";
        $data['akun'] = $this->mod->m_show_details_account_driver($id_driver);
        // print('<pre>');print_r($data);exit();
        $this->load->view('templates/frontend/depan/header', $data);
        $this->load->view('templates/frontend/depan/menu_driver');
        $this->load->view('akun_driver',$data);
        $this->load->view('templates/frontend/depan/footer');
    }


}