<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->library('session');
    }
    public function index() {                        
      $this->load->view('form_login');
  }

  public function login() {
      $username = $this->input->post('username', true);
      $password = md5($this->input->post('password', true)); // hash MD5

      // Ambil data dari database
      $this->db->from('data_pegawai');
      $this->db->where('username', $username);
      $cek = $this->db->get()->row();
      

      // Jika username tidak ditemukan
      if ($cek == NULL) {
          $this->session->set_flashdata('notifikasi', '
              <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                  <div class="alert-body">
                      <button class="close" data-dismiss="alert"><span>×</span></button>
                      Username tidak ditemukan.
                  </div>
              </div>
          ');
          redirect('auth');
      } 
      // Jika password cocok

      if ($password == $cek->password) {
        $data = array(
            'id_pegawai'    => $cek->id_pegawai,
            'username'      => $cek->username,
            'hak_akses'     => $cek->hak_akses,
            'nama_pegawai'  => $cek->nama_pegawai,
            'photo'         => $cek->photo,
            'nik'         => $cek->nik
            
        );
        $this->session->set_userdata($data);
    
        // Arahkan sesuai hak akses
        if ($cek->hak_akses == '1') {
            redirect('Dashboard');
        } else if ($cek->hak_akses == '2') {
            redirect('pegawai/Dashboard');
        } else {
            redirect('auth');
        }
    }
    
      // Jika password salah
      else {
          $this->session->set_flashdata('notifikasi', '
              <div class="alert alert-dark alert-dismissible show fade" style="font-size: 17px;">
                  <div class="alert-body">
                      <button class="close" data-dismiss="alert"><span>×</span></button>
                      Password salah.
                  </div>
              </div>
          ');
          redirect('auth');
      }
  }

  public function logout() {
      $this->session->sess_destroy();
      redirect('auth');
  }

}

