<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends MX_Controller
{
    public function index ()
    {
        $data['tanggal']=date('d-m-Y');
        $data['title']="Pelanggan";
        templateAdmin('admin/pelanggan/index', $data);
    }

}
