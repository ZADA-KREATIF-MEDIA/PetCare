<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('tanggal_indo')) {
  function tanggal_indo($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    // $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $waktu = substr($date,11,5);
    $hari = date("w",strtotime($date));
    // $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;
    $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;

    return $result;
  }
}

function adminView($page = null, $data = null)
{
    $ci = get_instance();

    $ci->load->view('templates/backend/layout/header', $data);
    $ci->load->view('templates/backend/layout/menu', $data);
    $ci->load->view('templates/backend/layout/navbar', $data);
    $ci->load->view($page, $data);
    $ci->load->view('templates/backend/layout/footer', $data);
}
function format_rupiah($number)
{

    if ($number == '') $number = 0;
    return number_format($number, 0, '.', ',');
}

function is_logged_in($level=null)
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect('admin/auth');
    }else {
    //     $role_id = $ci->session->userdata('role_id');
    //     $menu = $ci->uri->segment(1);

    //     $query = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

    //     $menu_id = $query['id'];

    //     $userAccess = $ci->db->get_where('user_access_menu', [
    //         'role_id' => $role_id,
    //         'menu_id' => $menu_id
    //     ]);

        if ($level !=null AND $level == $ci->session->userdata('level')) {
            redirect('admin/auth/blocked');
        }
    }
}

function is_logged_in_user()
{
    $ci = get_instance();

    if (!$ci->session->userdata('cust_id_customer')) {
        redirect('home/show_login');
    }
}

function is_logged_in_rider()
{
    $ci = get_instance();

    if (!$ci->session->userdata('rider_id_rider')) {
        redirect('home/show_login');
    }
}

// function check_access($role_id, $menu_id)
// {
//     $ci = get_instance();

//     $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

//     if ($result->num_rows() > 0) {
//         return "checked='checked'";
//     }
// }