<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MX_Controller
{
    public function index ()
    {
        $data['tanggal']=date('d-m-Y');
        $data['title']="Admin";
        templateAdmin('admin/admin/index', $data);
    }

}
