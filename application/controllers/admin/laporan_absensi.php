<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Pastikan autoload Composer dimasukkan
require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;

class Laporan_absensi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
    }

    public function index(){
        $this->db->from('data_kehadiran');
       
        $lap_kehadiran = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Laporan Gaji',
            'lap_kehadiran'      => $lap_kehadiran
        );

        $this->template->load('templates','admin/laporanAbsensi',$data);
    }

    public function cetakLaporanAbsensi(){
        if ($this->input->post('bulan') && $this->input->post('tahun')) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $bulantahun = $bulan.$tahun;
    
        $data['lap_kehadiran'] = $this->db->query("
            SELECT * FROM data_kehadiran 
            WHERE bulan = '$bulantahun' 
            ORDER BY nama_pegawai ASC")->result_array();
    
        $data['judul_halaman'] = 'Cetak Absensi';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
    
        $this->load->view('admin/cetakLaporanAbsensi', $data);
    }
    

    public function exportExcel()
    {
        if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        } 

        $data['lap_kehadiran'] = $this->db->query("
        SELECT * FROM
            data_kehadiran WHERE bulan = '$bulantahun' ORDER BY nama_pegawai ASC")->result_array();

        $data['judul_halaman'] = 'Cetak Gaji Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
       

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_absensi_{$bulantahun}.xls");

        $this->load->view('admin/cetakLaporanAbsensi', $data);
    }

    public function exportPdf()
    {
        if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
        

        $data['lap_kehadiran'] = $this->db->query("
        SELECT * FROM
            data_kehadiran WHERE bulan = '$bulantahun' ORDER BY nama_pegawai ASC")->result_array();

        $data['judul_halaman'] = 'Cetak Absensi Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
       

        $html = $this->load->view('admin/cetakLaporanAbsensi', $data, true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("laporan_absensi_{$bulantahun}.pdf", array("Attachment" => 1));
    }
}
