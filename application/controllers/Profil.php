<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // pastikan database aktif
    }

    public function index() {
        $id = $this->session->userdata('id_pegawai'); // Pastikan user sudah login dan session tersedia

        $query = $this->db->get_where('data_pegawai', ['id_pegawai' => $id]);
        $data['pegawai'] = $query->row();

      
        $this->template->load('templates','profil',$data);
    }
}
