<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends MX_Controller
{
    public function index ()
    {
        $data['tanggal']=date('d-m-Y');
        $data['title']="Tarif";
        templateAdmin('admin/tarif/index', $data);
    }

}
