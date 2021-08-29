<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel', 'mod');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('admin/login/v_login', $data);
    }
    function aksi_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $admin = $this->db->get_where('admin', ['email' => $email])->row_array();
        print('<pre>');
        print_r($admin);
        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                // echo "here";exit();
                $data = [
                    'email  '            => $admin['email'],
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Login Berhasil</div>');

                redirect('admin/pesanan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password salah</div>');

                redirect('admin/dashboard/index');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password Tidak di Temukan</div>');

            redirect('admin/dashboard/index');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin'));
    }
}
