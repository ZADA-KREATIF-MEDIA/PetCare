<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
    public function index ()
    {   
        $data['title']="Dashboard";
        templateAdmin('admin/dashboard', $data);
    }

}
