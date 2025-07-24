<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Pastikan autoload Composer dimasukkan
require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;

class Laporan_gaji extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
       
    }

    public function index(){
        $this->db->from('data_jabatan');
       
        $lap_gaji = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Laporan Gaji',
            'lap_gaji'      => $lap_gaji
        );

        $this->template->load('templates','admin/laporanGaji',$data);
    }

    public function cetakLaporanGaji(){
        if ($this->input->post('bulan') && $this->input->post('tahun')) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $bulantahun = $bulan . $tahun;

        $potongan = $this->db->get('potongan_gaji')->result_array();
        $jml_potongan = 0;
        foreach($potongan as $p){
            $jml_potongan += $p['jml_potongan'];
        }

        $data['cetak_gaji'] = $this->db->query("
            SELECT 
                data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin,
                data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, 
                data_jabatan.tj_transport, data_jabatan.uang_makan, 
                data_kehadiran.alpha
            FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik
            INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
            WHERE data_kehadiran.bulan = '$bulantahun'
            ORDER BY data_pegawai.nama_pegawai ASC
        ")->result_array();

        $data['judul_halaman'] = 'Cetak Gaji Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['potongan'] = $jml_potongan;

        $this->load->view('admin/cetakDataGaji', $data);
    }

    public function exportExcel()
    {
        if ($this->input->post('bulan') && $this->input->post('tahun')) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $bulantahun = $bulan . $tahun;

        $potongan = $this->db->get('potongan_gaji')->result_array();
        $jml_potongan = 0;
        foreach($potongan as $p){
            $jml_potongan += $p['jml_potongan'];
        }        

        $data['cetak_gaji'] = $this->db->query("
            SELECT 
                data_pegawai.nik, 
                data_pegawai.nama_pegawai, 
                data_pegawai.jenis_kelamin,
                data_jabatan.nama_jabatan, 
                data_jabatan.gaji_pokok, 
                data_jabatan.tj_transport, 
                data_jabatan.uang_makan, 
                data_kehadiran.alpha 
            FROM data_pegawai 
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik 
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan 
            WHERE data_kehadiran.bulan = '$bulantahun' 
            ORDER BY data_pegawai.nama_pegawai ASC
        ")->result_array();

        $data['judul_halaman'] = 'Cetak Gaji Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['potongan'] = $jml_potongan;

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_gaji_{$bulantahun}.xls");

        $this->load->view('admin/cetakDataGaji', $data);
    }

    public function exportPdf()
    {
        if ($this->input->post('bulan') && $this->input->post('tahun')) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $bulantahun = $bulan . $tahun;

        $potongan = $this->db->get('potongan_gaji')->result_array();
        $jml_potongan = 0;
        foreach($potongan as $p){
            $jml_potongan += $p['jml_potongan'];
        }
        

        $data['cetak_gaji'] = $this->db->query("
            SELECT 
                data_pegawai.nik, 
                data_pegawai.nama_pegawai, 
                data_pegawai.jenis_kelamin,
                data_jabatan.nama_jabatan, 
                data_jabatan.gaji_pokok, 
                data_jabatan.tj_transport, 
                data_jabatan.uang_makan, 
                data_kehadiran.alpha 
            FROM data_pegawai 
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik 
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan 
            WHERE data_kehadiran.bulan = '$bulantahun' 
            ORDER BY data_pegawai.nama_pegawai ASC
        ")->result_array();

        $data['judul_halaman'] = 'Cetak Gaji Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['potongan'] = $jml_potongan;

        $html = $this->load->view('admin/cetakDataGaji', $data, true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("laporan_gaji_{$bulantahun}.pdf", array("Attachment" => 1));
    }
}
