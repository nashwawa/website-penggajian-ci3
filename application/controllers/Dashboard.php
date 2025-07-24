<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller { 
    
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
    }

    public function index() {
      
        $pegawai = $this->db->query("SELECT * FROM data_pegawai");
        $admin = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'admin'");
        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");

        $data = array(
            'judul_halaman'   => 'Dashboard',
            'pegawai'    => $pegawai->num_rows(),
            'admin'    => $admin->num_rows(),
            'jabatan'    => $jabatan->num_rows(),
            'kehadiran'    => $kehadiran->num_rows(),
        );
        $this->template->load('templates', 'dashboard', $data);
       
    }
}

