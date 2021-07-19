<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrdersModel', 'orders');
        $this->load->model('CustomersModel', 'customers');
        $this->load->model('AdminModel', 'admin');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';

        $this->form_validation->set_rules('date_start', 'Tanggal Awal', 'trim|required');
        $this->form_validation->set_rules('date_end', 'Tanggal Akhir', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $total_pesanan = $this->orders->countOrders();
            $total_pelanggan = $this->orders->countCustomer();
            $order_hari_ini = $this->orders->order_hari_ini();
            $total_jarak = $this->orders->countJarak();
            $pesanan_selesai = $this->orders->countOrdersDone();
        }else{
            $date_start = $this->input->post('date_start');
            $date_end = $this->input->post('date_end');
            $date_range = [
                "date_start" => $date_start,
                "date_end" => $date_end
            ];

            $total_pesanan = $this->orders->countOrders($date_range);
            $total_pelanggan = $this->orders->countCustomer($date_range);
            $order_hari_ini = $this->orders->order_hari_ini($date_range);
            $total_jarak = $this->orders->countJarak($date_range);
            $pesanan_selesai = $this->orders->countOrdersDone($date_range);

        }

        $data['total_pesanan'] = $total_pesanan;
        $data['pesanan_selesai'] = $pesanan_selesai;
        $data['total_jarak'] = round($total_jarak->jarak,2);
        $data['order_hari_ini'] = $order_hari_ini;
        $data['total_pelanggan'] = $total_pelanggan->total_customer;

        adminView('dashboard/index', $data);
    }

    public function changepassword()
    {
        $username = $this->session->userdata('username');
        $old_password = $this->input->post('old_password');
        $new_password1 = $this->input->post('new_password1');
        $new_password2 = $this->input->post('new_password2');

        $user = $this->admin->getAdmin($username);
        if(password_verify($old_password, $user->password)){
            
            if(trim($new_password1) != trim($new_password2)){
                $this->session->set_flashdata('danger', 'Password baru dan konfirmasi password baru tidak sama');
            }else{
                $data = [
                    "id_admin"=>$user->id_admin,
                    "password"=>password_hash($new_password1, PASSWORD_DEFAULT),
                ];
                $this->admin->changePassword($data);
                $this->session->set_flashdata('success', 'Password berhasil diperbarui');
                
            }
        }else{
            $this->session->set_flashdata('danger', 'Password lama salah');
        }
        redirect('admin/dashboard');
    }
}
