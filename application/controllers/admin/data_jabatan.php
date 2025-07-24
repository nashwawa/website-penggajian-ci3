<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_jabatan extends CI_Controller {  
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
    }           

    public function index(){
        $this->db->from('data_jabatan');
        $this->db->order_by('nama_jabatan','ASC');
        $jabatan = $this->db->get()->result_array();	
        // mengganti sesuai halaman(dekat profil)
		$data = array(
			'judul_halaman' => 'Data Jabatan' ,
            'jabatan'          => $jabatan
		);
		$this->template->load('templates','admin/datajabatan',$data);
	}

    public function simpan(){
        // Mengecek apakah username sudah ada di database
        $this->db->from('data_jabatan');  // Mengambil data dari tabel 'pelanggan'
        $data = $this->db->get()->result_array();  // Mengeksekusi query dan mengambil hasilnya dalam bentuk array
        $data = array(
            'nama_jabatan'       => $this->input->post('nama_jabatan'),
            'gaji_pokok'   => $this->input->post('gaji_pokok'),
            'tj_transport'      => $this->input->post('tj_transport'),
            'uang_makan'      => $this->input->post('uang_makan'),
        );

        // Menyimpan data ke dalam tabel 'pelanggan'
        $this->db->insert('data_jabatan', $data);

        // Menampilkan pesan bahwa pelanggan baru berhasil ditambahkan
        $this->session->set_flashdata('alert', '
            <div class="alert alert-info alert-dismissible show fade" style="font-size: 17px;">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Berhasil menambahkan jabatan.
                </div>
            </div>
        ');
        
        // Mengarahkan kembali ke halaman pelanggan setelah proses selesai
        redirect('admin/data_jabatan');
    }

    public function delete_data($id){
        $where = array(
            'id_jabatan'    => $id
        );
        $this->db->delete('data_jabatan',$where);
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
    
    public function edit($id_jabatan){
        $this->db->from('data_jabatan')->where('id_jabatan', $id_jabatan);
        $jabatan = $this->db->get()->row();
        $data = array(
            'judul_halaman' => 'Edit Data jabatan',
            'jabatan' => $jabatan
        );
        $this->template->load('templates', 'admin/dataJabatan_edit', $data);
    }

    public function update(){
        $data = array(
            'nama_jabatan'       => $this->input->post('nama_jabatan'),
            'gaji_pokok'   => $this->input->post('gaji_pokok'),
            'tj_transport'      => $this->input->post('tj_transport'),
            'uang_makan'      => $this->input->post('uang_makan'),
        );
        $where = array('id_jabatan'  => $this->input->post('id_jabatan'));
        $this->db->update('data_jabatan', $data, $where);
        $this->session->set_flashdata('alert',' <div class="alert alert-dark alert-dismissible show fade" style="font-size: 17px;">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Berhasil mengupdate data jabatan
                      </div>
                    </div>
        ');
     
        redirect('admin/data_jabatan');
    }  
    
}

