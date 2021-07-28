<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends MX_Controller
{
    public function index ()
    {
  
        $data['title']="Produk";
        templateAdmin('admin/produk/index', $data);
    }

}
