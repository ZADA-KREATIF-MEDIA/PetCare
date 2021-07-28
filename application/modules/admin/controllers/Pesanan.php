<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends MX_Controller
{
    public function index ()
    {
        $data['tanggal']=date('d-m-Y');
        $data['title']="Pesanan";
        templateAdmin('admin/pesanan/index', $data);
    }

}
