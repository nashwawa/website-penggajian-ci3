<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_gaji extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('hak_akses')<>'2'){
            redirect('pegawai/Dashboard');
        }
    }
	public function index() {
        // Cek parameter bulan dan tahun dari URL
        if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }

        // Ambil data potongan dari tabel potongan_gaji
        $potongan = $this->db->get('potongan_gaji')->result_array();
        $jml_potongan = 0;
        foreach($potongan as $p) {
            $jml_potongan += $p['jml_potongan'];
        }
        $nik=$this->session->userdata('nik');
        // Query data gaji pegawai berdasarkan bulan & join kehadiran dan jabatan
        $data['gaji'] = $this->db->query("
            SELECT data_pegawai.nama_pegawai, data_pegawai.nik, data_jabatan.gaji_pokok,
                data_jabatan.tj_transport, data_jabatan.uang_makan,
                data_kehadiran.alpha, data_kehadiran.bulan, data_kehadiran.id_kehadiran
            FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
            WHERE data_kehadiran.nik = '$nik'
            ORDER BY data_kehadiran.bulan DESC
        ")->result();


        // Kirim data ke view
        $data['judul_halaman'] = 'Data Penggajian';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['potongan'] = $jml_potongan;

        $this->template->load('templates', 'pegawai/dataGaji', $data);
    }

    public function cetak_gaji(){
        if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulantahun = $_GET['bulan']; // format: MMYYYY (contoh: 062025)
        } else {
            $bulantahun = date('mY');
        }
    
        $potongan = $this->db->get('potongan_gaji')->result_array();
        $jml_potongan = 0;
        foreach($potongan as $p) {
            $jml_potongan += $p['jml_potongan'];
        }
    
        $nik = $this->session->userdata('nik');
    
        $data['slip_gaji'] = $this->db->query("
            SELECT data_pegawai.nama_pegawai, data_pegawai.nik, data_jabatan.nama_jabatan,
                data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan,
                data_kehadiran.alpha, data_kehadiran.bulan, data_kehadiran.id_kehadiran
            FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
            WHERE data_kehadiran.nik = '$nik' AND data_kehadiran.bulan = '$bulantahun'
        ")->row_array();
    
        $data['judul_halaman'] = 'Cetak Gaji Pegawai';
        $data['bulan'] = substr($bulantahun, 0, 2);
        $data['tahun'] = substr($bulantahun, 2, 4);
        $data['potongan'] = $jml_potongan;
    
        $this->load->view('pegawai/cetakSlipGaji', $data);
    }
    
    

       
}