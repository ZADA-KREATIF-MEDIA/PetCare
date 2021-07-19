<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Customers extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CustomersModel', 'customer');
        is_logged_in(3);
    }
    public function index()
    {
        $data['title'] = 'Customers';
        $data['customers'] = $this->customer->getAllCustomers();
        adminView('customers/index', $data);
    }

    public function verifikasi_member($id)
    {
        $referal_code = $this->referal_code(8);
        $data = [
            'referal_code' => $referal_code,
            'level' => 'member'
        ];
        if($this->customer->verifikasi_member($id,$data)){
            $this->session->set_flashdata('success', 'KODE REFERAL : '.$referal_code.'');
            
        }else{
            $this->session->set_flashdata('danger', 'Member gagal diaktifkan');
        }
        redirect('admin/customers');
    }
    public function setting_diskon()
    {
        
        if($this->customer->setting_diskon()){
            $this->session->set_flashdata('success', 'Setting Diskon Berhasil');
            
        }else{
            $this->session->set_flashdata('danger', 'Setting Diskon Gagal');
        }
        redirect('admin/customers');
    }
    public function status_customer()
    {
        $id_cust = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        if($status == "aktif"){
            $status_cust = "tidak";
        }else if($status =="tidak"){
            $status_cust = "aktif";
        }

        if($this->customer->update_status_customer($id_cust,$status_cust)){
            $this->session->set_flashdata('success', 'Status pelanggan berhasil diperbarui');
            
        }else{
            $this->session->set_flashdata('danger', 'Status pelanggan gagal diperbarui');
        }
        redirect('admin/customers');

    }
    static function referal_code($length)
        {
        $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
        }
        return $string;
    }
    public function edit_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/customers');
        } else {
            $this->customer->edit_password();
            $this->session->set_flashdata('success', 'Password customer berhasil diperbarui');
            redirect('admin/customers');
        }
    }
    public function export()
    {
            $semua_pengguna = $this->customer->getAllCustomers();

          $spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'Nama')
                      ->setCellValue('C1', 'Email')
                      ->setCellValue('D1', 'Alamat')
                      ->setCellValue('E1', 'No Telepon')
                      ->setCellValue('F1', 'Referral Code')
                      ->setCellValue('G1', 'Tanggal Bergabung')
                      ->setCellValue('H1', 'Level');

          $kolom = 2;
          $nomor = 1;
          foreach($semua_pengguna as $pengguna) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, strtoupper($pengguna->nama))
                           ->setCellValue('C' . $kolom, $pengguna->email)
                           ->setCellValue('D' . $kolom, $pengguna->alamat)
                           ->setCellValue('E' . $kolom, $pengguna->no_telpn)
                           ->setCellValue('F' . $kolom, $pengguna->referal_code)
                           ->setCellValue('G' . $kolom, tanggal_indo($pengguna->tanggal_bergabung))
                           ->setCellValue('H' . $kolom, ucwords($pengguna->level));

               $kolom++;
               $nomor++;

          }

          $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="daftar_pelanggan.xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
    }
    
}