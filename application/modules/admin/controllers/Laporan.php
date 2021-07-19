<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LaporanModel', 'laporan');
        $this->load->model('CustomersModel', 'customers');
        $this->load->model('DriversModel', 'drivers');
        is_logged_in();
    }
    public function omset_jarak()
    {
        $data['title'] = 'Laporan Omset Dan Jarak';
        
        $data['customers'] = $this->customers->getAllCustomers();
        $data['drivers'] = $this->drivers->getAllDrivers();
        adminView('laporan/omset_jarak', $data);
    }
    public function omset_member()
    {
        $data['title'] = 'Laporan Omset By Member';
        
        $data['members'] = $this->customers->getAllMembers();
        $data['drivers'] = $this->drivers->getAllDrivers();
        adminView('laporan/omset_member', $data);
    }

    public function omset_jarak_dt()
    {
        $laporan = $this->laporan->laporan_omset_jarak();
        if($laporan){

            $data['draw'] = 1;
            $data['recordsTotal']=count($laporan);
            $data['recordsFiltered']=count($laporan);
            $data['data']=$laporan;
        }else {
            $data['draw'] = 0;
            $data['recordsTotal'] = 0;
            $data['recordsFiltered'] = 0;
            $data['data']="";
        }
        $res = json_encode($data);
        // $res = json_encode($this->input->post());
        echo $res;
    }
    public function omset_member_dt()
    {
        $laporan = $this->laporan->laporan_omset_member();
        if($laporan){

            $data['draw'] = 1;
            $data['recordsTotal']=count($laporan);
            $data['recordsFiltered']=count($laporan);
            $data['data']=$laporan;
        }else {
            $data['draw'] = 0;
            $data['recordsTotal'] = 0;
            $data['recordsFiltered'] = 0;
            $data['data']="";
        }
        $res = json_encode($data);
        // $res = json_encode($this->input->post());
        echo $res;
    }
    // public function export_omset_jarak()
    // {
    //     $laporan = $this->laporan->laporan_omset_jarak();

    //     $spreadsheet = new Spreadsheet;

    //     $spreadsheet->setActiveSheetIndex(0)
    //                 ->setCellValue('A1', 'No')
    //                 ->setCellValue('B1', 'Tanggal')
    //                 ->setCellValue('C1', 'TrxID')
    //                 ->setCellValue('D1', 'TimeOrder')
    //                 ->setCellValue('E1', 'Kurir')
    //                 ->setCellValue('F1', 'Jarak')
    //                 ->setCellValue('G1', 'Overweight')
    //                 ->setCellValue('H1', 'Oversize')
    //                 ->setCellValue('I1', 'Normal')
    //                 ->setCellValue('J1', 'Cargo')
    //                 ->setCellValue('K1', 'Nama Pengirim')
    //                 ->setCellValue('L1', 'Nama Penerima')
    //                 ->setCellValue('M1', 'Ongkir Final');

    // $kolom = 2;
    // $nomor = 1;
    //     foreach($laporan as $l) {

    //         $spreadsheet->setActiveSheetIndex(0)
    //                     ->setCellValue('A' . $kolom, $nomor)
    //                     ->setCellValue('B' . $kolom, tanggal_indo($l->Tanggal))
    //                     ->setCellValue('C' . $kolom, $l->TrxID)
    //                     ->setCellValue('D' . $kolom, $l->TimeOrder)
    //                     ->setCellValue('E' . $kolom, $l->Kurir)
    //                     ->setCellValue('F' . $kolom, $l->Jarak." km")
    //                     ->setCellValue('G' . $kolom, "")
    //                     ->setCellValue('H' . $kolom, "")
    //                     ->setCellValue('I' . $kolom, "")
    //                     ->setCellValue('J' . $kolom, $l->Cargo)
    //                     ->setCellValue('K' . $kolom, ucwords($l->Nama_Pengirim))
    //                     ->setCellValue('L' . $kolom, "")
    //                     ->setCellValue('M' . $kolom, "Rp. ".format_rupiah($l->Ongkir_Final));

    //         $kolom++;
    //         $nomor++;

    //     }

    //     $writer = new Xlsx($spreadsheet);

    //     header('Content-Type: application/vnd.ms-excel');
	//     header('Content-Disposition: attachment;filename="laporan_omset_jarak.xlsx"');
	//     header('Cache-Control: max-age=0');

	//     $writer->save('php://output');
    // }
}