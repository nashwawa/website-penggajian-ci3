<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_absensi extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
    }
    public function index(): void
    {
        // Cek apakah ada parameter 'bulan' dan 'tahun' dari URL (GET)
        if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];    
            $tahun = $_GET['tahun'];    
            $bulantahun = $bulan.$tahun; 
        } else {
            // Jika tidak ada parameter dari URL, ambil bulan dan tahun saat ini
            $bulan = date('m');           
            $tahun = date('Y');           
            $bulantahun = $bulan.$tahun;  
        }
        $this->db->select('data_kehadiran.*, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan'); // Pilih kolom yang akan ditampilkan, termasuk kolom dari tabel yang di-join
        $this->db->from('data_kehadiran');  // Tentukan tabel utama dari query
        $this->db->join('data_pegawai', 'data_kehadiran.nik = data_pegawai.nik');   // Join dengan tabel data_pegawai berdasarkan NIK
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.nama_jabatan'); // Join dengan tabel data_jabatan berdasarkan nama jabatan
        $this->db->where('data_kehadiran.bulan', $bulantahun);  // Filter berdasarkan kolom bulan pada tabel data_kehadiran
        $this->db->order_by('data_pegawai.nama_pegawai', 'ASC');  // Urutkan berdasarkan nama pegawai (ascending)
        $absensi = $this->db->get()->result_array();// Jalankan query dan simpan hasilnya dalam array
        
        $data = array(
            'judul_halaman' => 'Data Absensi',
            'absensi' => $absensi
        );

        // Load view template dengan data yang sudah disiapkan
        $this->template->load('templates', 'admin/dataAbsensi', $data);
    }

    public function input_absensi(): void
    {
        if ($this->input->post('submit', TRUE) == 'submit') {
            $post = $this->input->post();
            $simpan = [];

            foreach ($post['bulan'] as $key => $value) {
                if ($post['bulan'][$key] != '' || $post['nik'][$key] != '') {
                    $simpan[] = array(
                        'bulan'             => $post['bulan'][$key],
                        'nik'               => $post['nik'][$key],
                        'nama_pegawai'      => $post['nama_pegawai'][$key],
                        'jenis_kelamin'     => $post['jenis_kelamin'][$key],
                        'nama_jabatan'      => $post['nama_jabatan'][$key],
                        'hadir'             => $post['hadir'][$key],
                        'sakit'             => $post['sakit'][$key],
                        'alpha'             => $post['alpha'][$key],
                    );
                }
            }

            // Logika insert_batch langsung di sini
            if (count($simpan) > 0) {
                $this->db->insert_batch('data_kehadiran', $simpan);

                $this->session->set_flashdata('alert', '
                    <div class="alert alert-info alert-dismissible show fade" style="font-size: 17px;">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            Berhasil menambahkan data absensi.
                        </div>
                    </div>
                ');
            }

            redirect('admin/data_absensi');
        }

        if (isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $bulantahun = $bulan.$tahun;

        $this->db->select('data_pegawai.*, data_jabatan.nama_jabatan');
        $this->db->from('data_pegawai');
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.nama_jabatan');
        $this->db->where("NOT EXISTS (
            SELECT 1 FROM data_kehadiran
            WHERE data_kehadiran.nik = data_pegawai.nik 
            AND data_kehadiran.bulan = '$bulantahun'
        )", null, false);
        $this->db->order_by('data_pegawai.nama_pegawai', 'ASC');

        $input_absensi = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Form Input Absensi',
            'input_absensi' => $input_absensi,
            'bulantahun' => $bulantahun,
            'bulan' => $bulan, 
            'tahun' => $tahun  
        );

        $this->template->load('templates', 'admin/inputAbsensi', $data);
    }


    
       
}
