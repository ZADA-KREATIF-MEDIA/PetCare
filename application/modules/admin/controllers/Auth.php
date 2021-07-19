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
        if ($this->session->userdata('username')) {
            redirect('admin/dashboard');
        }
        
        $data['title'] = 'Login Page';
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/index', $data);
        } else {
            $this->_login();
        }
        
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->admin->getAdmin($username);

        if ($user) {

            if ($user->status == "aktif") {
                if (password_verify($password, $user->password)) {
                    $data = [
                        'id_admin' => $user->id_admin,
                        'username' => $user->username,
                        'level' => $user->level
                    ];

                    $this->session->set_userdata($data);
                    // if ($user['level'] == 1) {
                        redirect('admin/dashboard');
                    // } else {
                    //     redirect('user');
                    // }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password !</div>');
                    redirect('admin/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This username has been not activated</div>');
                redirect('admin/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            This username is not registered
          </div>');
            redirect('admin/auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
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
