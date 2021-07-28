<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel', 'admin');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('admin/dashboard');
        }

        $data['title'] = 'Login Page';
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/index', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->admin->getAdmin($email);



        if (password_verify($password, $user->password)) {
            $data = [
                'id' => $user->id,
                'email' => $user->email,

            ];
            $this->session->set_userdata($data);

            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password !</div>');
            redirect('admin/auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out
          </div>');
        redirect('admin/auth');
    }
    public function blocked()
    {
        $this->load->view('admin/auth/blocked');
    }
}
