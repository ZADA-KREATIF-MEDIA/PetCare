<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Drivers extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DriversModel', 'driver');
        is_logged_in(3);
    }
    public function index()
    {
        $data['title'] = 'Driver';
        $data['drivers'] = $this->driver->getAllDrivers();
        adminView('drivers/index', $data);
    }
    public function create()
    {
        $data['title'] = 'Tambah Kurir';
        adminView('drivers/form', $data);
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Kurir';
        $data['driver'] = $this->driver->getDriver($id);
        adminView('drivers/form', $data);
    }
    public function store()
    {
        $this->form_validation->set_rules('nama_rider', 'Nama Kurir', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('plat_nomor', 'No. Plat', 'required');
        $this->form_validation->set_rules('tanggal_bergabung', 'Tanggal Bergabung', 'required');
        $this->form_validation->set_rules('status', 'Status Kurir', 'required');
        // var_dump($_FILES);
        // die;
        if ($this->form_validation->run() == FALSE) {
            redirect('admin/drivers');
        } else {
            $this->driver->create();
            $this->session->set_flashdata('success', 'Data Kurir Berhasil Ditambah');
            redirect('admin/drivers');
        }
    }
    public function update()
    {
        $this->form_validation->set_rules('nama_rider', 'Nama Kurir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('plat_nomor', 'No. Plat', 'required');
        $this->form_validation->set_rules('status', 'Status Kurir', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/drivers');
        } else {
            $this->driver->update();
            $this->session->set_flashdata('success', 'Data Kurir Berhasil Diperbarui');
            redirect('admin/drivers');
        }
    }

    public function status_driver()
    {
        $id_driver = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        if($status == "aktif"){
            $status_driver = "tidak";
        }else if($status =="tidak"){
            $status_driver = "aktif";
        }

        if($this->driver->update_status_driver($id_driver,$status_driver)){
            $this->session->set_flashdata('success', 'Status kurir berhasil diperbarui');
            
        }else{
            $this->session->set_flashdata('danger', 'Status kurir gagal diperbarui');
        }
        redirect('admin/drivers');

    }
    public function delete($id)
    {
        $driver = $this->driver->getDriver($id);

        if($driver){
            if($this->driver->delete($id)){
                $img_file = "./assets/backend/img/driver/".$driver->foto;
                unlink($img_file);
            }
            $this->session->set_flashdata('success', 'Data Kurir Berhasil Dihapus');
        }
        redirect('admin/drivers');;
    }
    
}