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
        $this->form_validation->set_rules('no_telpn', 'Nomor Telphon', 'required|is_unique[customer.no_telpn]');
        if ($this->form_validation->run() == FALSE) {
            $_SESSION['msg'] = 'sama';
            redirect('home/daftar');
        }else{
            $post = [
                'nama'      => $this->input->post('nama',true),
                'password'  => password_hash($this->input->post('password', true),PASSWORD_DEFAULT),
                'email'     => $this->input->post('email', true),
                'alamat'    => $this->input->post('alamat', true),
                'no_telpn'  => $this->input->post('no_telpn', true),
                'tanggal_bergabung'  => date('Y-m-d H:i:s')
            ];
            // print('<pre>');print_r($post);exit();
            $this->mod->m_save_daftar($post);
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            //         Registrasi Berhasil
            //     </div>');
            $_SESSION['msg'] = 'berhasil';
            redirect('home/show_login');
        }
    }

    public function driver()
    {
        $data['title'] = "Driver";
        
        $this->load->view('templates/frontend/depan/header',$data);
        $this->load->view('templates/frontend/depan/menu_driver');
        $this->load->view('driver');
        $this->load->view('templates/frontend/depan/footer');
    }

    /*--------- Auth ----------*/
    public function login()
    {
        $no_telpn = $this->input->post('no_telpn');
        $password = $this->input->post('password');
        $user = $this->db->get_where('customer', ['no_telpn' => $no_telpn])->row_array();
        // print('<pre>');print_r($user);
        if($user) {
            if(password_verify($password, $user['password'])) {
                //echo "sini";
                $data = [

                    'cust_id_customer'   => $user['id_customer'],
                    'cust_nama'          => $user['nama'],
                    'cust_no_telpn'      => $user['no_telpn'],
                    'cust_level'         => $user['level'],
                    'cust_email'         => $user['email']
                ];
                $this->session->set_userdata($data);
                $_SESSION['msg'] = 'berhasil_login';
                redirect('/order');
            } else {
                
                $_SESSION['msg'] = 'gagal_salah';
                redirect('home/show_login');
            }
        }else{
            
            $driver = $this->db->get_where('rider',['no_telpn' => $no_telpn])->row_array();
            print('<pre>');print_r($driver);
            if($driver){
                if(password_verify($password, $driver['password'])) {
                    echo "sini";
                    $data = [
                        'rider_id_rider'      => $driver['id_rider'],
                        'rider_nama_rider'    => $driver['nama_rider'],
                        'rider_no_telpn'      => $driver['no_telpn'],
                        'rider_level'         => 'driver'
                    ];
                    $this->session->set_userdata($data);
                    $_SESSION['msg'] = 'berhasil_login';
                    redirect('home/driver');
                }else{
                    $_SESSION['msg'] = 'gagal_salah';
                    redirect('home/show_login');
                }
            }else{
                $_SESSION['msg'] = 'gagal_kosong';
                redirect('home/show_login');
            }
        }
    }

    public function logout()
	{
		session_destroy();
		redirect('/');
	}
}