<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel', 'mod');
    }
    
    public function index()
    {
        $data = [
            'content'   => 'index',
            'title'     => 'Home'
        ];
        $this->load->view('templates/frontend/index',$data);
    }
    
    public function show_login()
    {
        $data = [
            'content'   => 'login',
            'title'     => 'Login'
        ];
        $this->load->view('templates/frontend/index',$data);
    }

    public function daftar()
    {
        $data = [
            'content'   => 'register',
            'title'     => 'Register'
        ];
        $this->load->view('templates/frontend/index',$data);
    }

    public function save_daftar()
    {
        $post = [
            'no_hp'             => $this->input->post('no_hp'),
            'nama'              => $this->input->post('nama'),
            'password'          => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
            'koordinat_alamat'  => $this->input->post('latitude').",".$this->input->post('longitude'),
            'alamat'            => $this->input->post('alamat')
        ];
        $this->mod->saveUser($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi Berhasil</div>');
        redirect('home/show_login');
    }

    /*--------- Auth ----------*/
    public function login()
    {
        
        $no_telpn = $this->input->post('no_hp');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['no_hp' => $no_telpn])->row_array();
        print('<pre>');print_r($user);
        if($user) {
            if(password_verify($password, $user['password'])) {
                // echo "here";exit();
                $data = [
                    'user_id'            => $user['id'],
                    'user_nama'          => $user['nama'],
                    'user_no_telpn'      => $user['no_telpn'],
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Login Berhasil</div>');
                redirect('order');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password salah</div>');
                redirect('home/show_login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password Tidak di Temukan</div>');
                redirect('home/show_login');
        } 
    }

    public function logout()
	{
		session_destroy();
		redirect('/');
	}
}