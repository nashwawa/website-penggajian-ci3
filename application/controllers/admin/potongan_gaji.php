<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class potongan_gaji extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        if($this->session->userdata('hak_akses')<>'1'){
            redirect('Dashboard');
        }
    }
	public function index(){
        $this->db->from('potongan_gaji');
        // $this->db->order_by('nama_pegawai','ASC');
        $pot_gaji = $this->db->get()->result_array();	
        // mengganti sesuai halaman(dekat profil)
		$data = array(
			'judul_halaman' => 'Setting Potongan Gaji' ,
            'pot_gaji'          => $pot_gaji
		);
		$this->template->load('templates','admin/potonganGaji',$data);
	}

    public function tambah_data()
    {
        $potongan = $this->input->post('potongan');
        $jml_potongan = $this->input->post('jml_potongan');
    
        if (empty($potongan) || empty($jml_potongan)) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-warning alert-dismissible show fade" style="font-size: 17px;">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        Gagal: Form potongan dan jumlah potongan tidak boleh kosong.
                    </div>
                </div>
            ');
            redirect('admin/potongan_gaji');
            return; // stop eksekusi
        }
    
        $data = array(
            'potongan'       => $potongan,
            'jml_potongan'   => $jml_potongan
        );
    
        $this->db->insert('potongan_gaji', $data);
    
        $this->session->set_flashdata('alert', '
            <div class="alert alert-info alert-dismissible show fade" style="font-size: 17px;">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Berhasil menambahkan potongan gaji.
                </div>
            </div>
        ');
        
        redirect('admin/potongan_gaji');
    }
    

    public function delete_data($id){
        $where = array(
            'id_potongan'    => $id
        );
        $this->db->delete('potongan_gaji',$where);
        $this->session->set_flashdata('alert','
         <div class="alert alert-danger alert-dismissible show fade" style="font-size: 17px;">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                         Berhasil menghapus potongan gaji.
                      </div>
                    </div>
        ');
        redirect('admin/potongan_gaji');
    }  
    
    public function edit($id_potongan){
        $this->db->from('potongan_gaji')->where('id_potongan', $id_potongan);
        $pot_gaji = $this->db->get()->row();
        $data = array(
            'judul_halaman' => 'Edit Data potongan gaji',
            'pot_gaji' => $pot_gaji
        );
        $this->template->load('templates', 'admin/potonganGaji_edit', $data);
    }
    public function update(){
        $data = array(
            'potongan'                   => $this->input->post('potongan'),
            'jml_potongan'               => $this->input->post('jml_potongan'),
            
        );
        $where = array('id_potongan'  => $this->input->post('id_potongan'));
        $this->db->update('potongan_gaji', $data, $where);
        $this->session->set_flashdata('alert',' <div class="alert alert-dark alert-dismissible show fade" style="font-size: 17px;">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Berhasil mengupdate potongan gaji
                      </div>
                    </div>
        ');
     
        redirect('admin/potongan_gaji');
    }    
       
}