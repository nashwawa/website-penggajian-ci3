<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah_password extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Pastikan user sudah login
        // if (!$this->session->userdata('id_pegawai')) {
        //     redirect('auth');
        // }
    }

    public function index() {
        $data = array(
            'judul_halaman' => 'Ganti Password',
        );
        $this->template->load('templates', 'admin/gantiPassword', $data);
    }

    public function ubahPasswordAksi() {
        $password_baru = $this->input->post('password_baru');
        $konfirmasi_password = $this->input->post('konfirmasi_password');

        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|matches[konfirmasi_password]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required');

        if ($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($password_baru));
            $id = array('id_pegawai' => $this->input->post('id_pegawai'));

            $this->db->update('data_pegawai', $data, $id);

            $this->session->set_flashdata('alert', '
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 16px;">
                    <strong>Berhasil!</strong> Password berhasil diperbarui.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ');

            redirect('auth');
        } else {
            $data = array('judul_halaman' => 'Ganti Password');
            $this->template->load('templates', 'admin/gantiPassword', $data);
        }
    }
}
