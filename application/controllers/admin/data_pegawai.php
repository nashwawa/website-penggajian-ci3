<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_pegawai extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
    }
	public function index(){
        $this->db->from('data_pegawai');
        $this->db->order_by('nama_pegawai','ASC');
        $pegawai = $this->db->get()->result_array();	
        // mengganti sesuai halaman(dekat profil)
		$data = array(
			'judul_halaman' => 'Data pegawai' ,
            'pegawai'          => $pegawai
		);
		$this->template->load('templates','admin/dataPegawai',$data);
	}
    public function simpan() {
        // Mengecek apakah username sudah ada di database
        $this->db->from('data_pegawai');
        $this->db->where('nama_pegawai', $this->input->post('nama_pegawai'));
        $cek = $this->db->get()->result_array();
    
        if (!empty($cek)) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        Username sudah ada.
                    </div>
                </div>
            ');
        } else {
            $photo = $_FILES['photo']['name'];
            $nama_file = date("YmdHis") . '.jpg';
    
            if ($photo != '') {
                $config['upload_path'] = FCPATH . 'assets/photo/';
                $config['allowed_types']    = 'jpg|jpeg|png|tiff';
                $config['max_size']         = 5120; // 5 MB
                $config['file_name']        = $nama_file;
    
                $this->load->library('upload', $config);
    
                // Validasi ukuran sebelum upload
                if ($_FILES['photo']['size'] >= 500 * 1024) {
                    $this->session->set_flashdata('alert', '
                        <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                Ukuran file terlalu besar. Maksimal 5MB.
                            </div>
                        </div>
                    ');
                    redirect('admin/data_pegawai');
                    return;
                }
    
                // Upload file
                if (!$this->upload->do_upload('photo')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('alert', '
                        <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                Gagal upload foto: ' . $error . '
                            </div>
                        </div>
                    ');
                    redirect('admin/data_pegawai');
                    return;
                } else {
                    $photo = $this->upload->data('file_name');
                }
            }
    
            $data = array(
                'nik'            => $this->input->post('nik'),
                'nama_pegawai'   => $this->input->post('nama_pegawai'),
                'username'   => $this->input->post('username'),
                'password'    => md5($this->input->post('password')),
                'jabatan'        => $this->input->post('jabatan'),
                'no_tlp'        => $this->input->post('no_tlp'),
                'email'        => $this->input->post('email'),
                'tanggal_masuk'  => $this->input->post('tanggal_masuk'),
                'status'         => $this->input->post('status'),
                'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                'hak_akses'  => $this->input->post('hak_akses'),
                'photo'          => $photo,
            );
    
            $this->db->insert('data_pegawai', $data);
    
            $this->session->set_flashdata('alert', '
                <div class="alert alert-info alert-dismissible show fade" style="font-size: 17px;">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        Berhasil menambahkan pegawai.
                    </div>
                </div>
            ');
        }
    
        redirect('admin/data_pegawai');
    }
    
    
    public function delete_data($id){
        $where = array(
            'id_pegawai'    => $id
        );
        $this->db->delete('data_pegawai',$where);
        $this->session->set_flashdata('alert','
         <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                         Berhasil menghapus pegawai.
                      </div>
                    </div>
        ');
        redirect('admin/data_pegawai');
    }  
    
    public function edit($id_pegawai){
        $this->db->from('data_pegawai')->where('id_pegawai', $id_pegawai);
        $pegawai = $this->db->get()->row();
    
        // Ambil semua jabatan dari tabel data_jabatan
        $jabatan = $this->db->get('data_jabatan')->result();
    
        $data = array(
            'judul_halaman' => 'Edit Data Pegawai',
            'pegawai'       => $pegawai,
            'jabatan'       => $jabatan // Tambahkan ini
        );
    
        $this->template->load('templates', 'admin/dataPegawai_edit', $data);
    }
    
    
    public function update()
    {
        $id             = $this->input->post('id_pegawai');
        $nik            = $this->input->post('nik');
        $nama_pegawai   = $this->input->post('nama_pegawai');
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $no_tlp         = $this->input->post('no_tlp');
        $email          = $this->input->post('email');
        $jabatan        = $this->input->post('jabatan');
        $tanggal_masuk  = $this->input->post('tanggal_masuk');
        $status         = $this->input->post('status');
        $jenis_kelamin  = $this->input->post('jenis_kelamin');
        $hak_akses      = $this->input->post('hak_akses');

        // Ambil data lama untuk keperluan cek photo dan password
        $pegawai_lama = $this->db->get_where('data_pegawai', ['id_pegawai' => $id])->row();

        // Handle upload foto
        $photo = $_FILES['photo']['name'];
        if ($photo) {
            $config['upload_path']      = './assets/photo/';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 2048;
            $config['file_name']        = 'photo_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {
                // Hapus foto lama jika ada
                if ($pegawai_lama->photo && file_exists(FCPATH . 'assets/photo/' . $pegawai_lama->photo)) {
                    unlink(FCPATH . 'assets/photo/' . $pegawai_lama->photo);
                }

                $photo = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Upload foto gagal: ' . $this->upload->display_errors());
                redirect('admin/data_pegawai/edit/' . $id);
                return;
            }
        } else {
            $photo = $pegawai_lama->photo; // Tidak upload, pakai foto lama
        }

        // Handle password
        if (!empty($password)) {
            $password_hash = md5($password); // atau password_hash jika sudah migrasi
        } else {
            $password_hash = $pegawai_lama->password; // Tidak ubah password
        }

        // Siapkan data untuk update
        $data = [
            'nik'           => $nik,
            'nama_pegawai'  => $nama_pegawai,
            'username'      => $username,
            'password'      => $password_hash,
            'no_tlp'       => $no_tlp,
            'email'       => $email,
            'jabatan'       => $jabatan,
            'tanggal_masuk' => $tanggal_masuk,
            'status'        => $status,
            'jenis_kelamin' => $jenis_kelamin,
            'hak_akses'     => $hak_akses,
            'photo'         => $photo
        ];

        // Eksekusi update
        $this->db->where('id_pegawai', $id);
        $this->db->update('data_pegawai', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data pegawai berhasil diupdate.</div>');
        redirect('admin/data_pegawai');
    }

}
