<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller { 
    
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('hak_akses')<>'2'){
            redirect('pegawai/Dashboard');
        }
    }

    public function index()
    {
        $id_pegawai = $this->session->userdata('id_pegawai');
        $data['judul'] = "Dashboard";
        $data['pegawai'] = $this->db->get_where('data_pegawai', ['id_pegawai' => $id_pegawai])->row();

        $this->template->load('templates', 'dashboardP', $data);
    }
}

