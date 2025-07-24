<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Pastikan autoload Composer dimasukkan
require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;

class Slip_gaji extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // if($this->session->userdata('level') != 'admin'){
        //     redirect('home');
        // }


    }

    public function index(){
        $this->db->from('data_pegawai');
        $slip_gaji = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Laporan Gaji',
            'slip_gaji'      => $slip_gaji
        );

        $this->template->load('templates','admin/slipGaji',$data);
    }

    public function cetakSlipGaji(){
        if ($this->input->post('bulan') && $this->input->post('tahun')) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $bulantahun = $bulan.$tahun;
        $nama = $this->input->post('nama_pegawai');

        $potongan = $this->db->get('potongan_gaji')->result_array();
        $jml_potongan = 0;
        foreach($potongan as $p){
            $jml_potongan += $p['jml_potongan'];
        }    

        $data['slip_gaji'] = $this->db->query("
            SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport,
             data_jabatan.uang_makan, data_kehadiran.alpha FROM data_pegawai 
             INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
              WHERE data_kehadiran.nama_pegawai='$nama'")->row_array();
    
        $data['judul_halaman'] = 'Cetak Absensi';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['potongan'] = $jml_potongan;
    
        $this->load->view('admin/cetakSlipGaji', $data);
    }
    

    public function exportExcel()
    {
        if (isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $nama = $this->input->get('nama');

        if (!$nama) {
            show_error("Nama pegawai tidak ditemukan. Pastikan nama dipilih sebelum ekspor.");
        }

        $data['slip_gaji'] = $this->db->query("
            SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, 
                data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, 
                data_kehadiran.alpha 
            FROM data_pegawai 
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik 
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan 
            WHERE data_kehadiran.nama_pegawai = '$nama'
        ")->row_array();

        $data['judul_halaman'] = 'Cetak Slip Gaji Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_slip_gaji_{$bulantahun}.xls");

        $alpha = $data['slip_gaji']['alpha'] ?? 0;
        $potonganPerAlpha = 100000; // Potongan per hari alpha
        $jml_potongan = $alpha * $potonganPerAlpha;
        $data['jml_potongan'] = $jml_potongan;


        $this->load->view('admin/cetakSlipGaji', $data);
    }

    public function exportPdf()
    {
        if (isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $nama = $this->input->get('nama');

        if (!$nama) {
            show_error("Nama pegawai tidak ditemukan. Pastikan nama dipilih sebelum ekspor.");
        }

        $data['slip_gaji'] = $this->db->query("
            SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, 
                data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, 
                data_kehadiran.alpha 
            FROM data_pegawai 
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik 
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan 
            WHERE data_kehadiran.nama_pegawai = '$nama'
        ")->row_array();

        $data['judul_halaman'] = 'Cetak Slip Gaji Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $alpha = $data['slip_gaji']['alpha'] ?? 0;
        $potonganPerAlpha = 100000; // Potongan per hari alpha
        $jml_potongan = $alpha * $potonganPerAlpha;
        $data['jml_potongan'] = $jml_potongan;


        $html = $this->load->view('admin/cetakSlipGaji', $data, true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("laporan_slip_gaji_{$bulantahun}.pdf", array("Attachment" => 1));
    }
}
