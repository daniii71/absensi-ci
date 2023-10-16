<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        // load model dan libry yang di perlukan 
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
	
	}

	public function karyawan()
	{
		$this->load->view('employee/karyawan');
	}

    public function dashboard()
    {
        $this->load->view('employee/dashboard');
    }

    // untuk absen 
            public function absensi()
        {
            if ($this->session->userdata('role') === 'karyawan') {
                date_default_timezone_set('Asia/Jakarta');
                $data['absensi'] = $this->user_model->get_data('absensi')->result();
                $this->load->view('employee/absensi', $data);
            } else {
                redirect('absensi');
            }
        }   


        
        // untuk menu absensi
        public function menu_absensi() {
            if ($this->session->userdata('role') === 'karyawan') {
                $user_id = $this->session->userdata('id'); // Ambil id pengguna yang sedang login
                $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required');
                
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('employee/menu_absensi');
                } else {
                    
                    date_default_timezone_set('Asia/Jakarta');
                    $jam_masuk = date('H:i:s');
                    
                    $data = array(
                        'id_karyawan' => $user_id, // Tetapkan id_karyawan berdasarkan pengguna yang sedang login
                        'kegiatan' => $this->input->post('kegiatan'),
                        'tanggal' => date('Y-m-d'),
                        'jam_masuk' => $jam_masuk,
                        'status' => 'belum done'
                    );
                    
                    // Menambahkan absensi dan mendapatkan ID data yang baru ditambahkan
                    $new_absensi_id = $this->user_model->addAbsensi($data);
                    
                    // Redirect ke halaman history_absen dengan membawa ID baru
                    redirect('employee/absensi/' . $new_absensi_id);
                }
            } else {
                redirect('other_page');
            }
        }


        public function update_absen($id)
	{
		$data['absensi']=$this->user_model->get_by_id('absensi', 'id', $id)->result();
		$this->load->view('employee/update', $data);
	}

        // untuk menu update absen
            public function aksi_update_absen() 
            {
                $id_karyawan = $this->session->userdata('id');
		        $data = [
		        	'kegiatan' => $this->input->post('kegiatan'),
		        ];
		        $eksekusi=$this->user_model->update_data
                ('absensi', $data, array('id'=>$this->input->post('id')));
                if($eksekusi)
                {
                    $this->session->set_flashdata('berhasil_update_absen', 'Berhasil mengubah kegiatan');
                    redirect(base_url('employee/update'));
                }
                else
                {
                    redirect(base_url('employee/update/'.$this->input->post('id')));
                }
            }

            public function izin()
	        {
	        	$this->load->view('employee/menu_izin');
	        }

    // untuk menu izin
	public function aksi_izin() {
		$id_karyawan = $this->session->userdata('id');
		$tanggal_sekarang = date('Y-m-d'); // Mendapatkan tanggal hari ini
	
		// Cek apakah sudah melakukan absen hari ini
		// $is_already_absent = $this->m_model->cek_absen($id_karyawan, $tanggal_sekarang);
	
		// Cek apakah sudah melakukan izin hari ini
		// $is_already_izin = $this->m_model->cek_izin($id_karyawan, $tanggal_sekarang);
	
		if ($is_already_absent) {
			$this->session->set_flashdata('gagal_izin', 'Anda sudah melakukan absen hari ini.');
		} elseif ($is_already_izin) {
			$this->session->set_flashdata('gagal_izin', 'Anda sudah mengajukan izin hari ini.');
		} else {
			$data = [
				'id_karyawan' => $id_karyawan,
				'kegiatan' => '-',
				'status' => 'true',
				'keterangan_izin' => $this->input->post('keterangan_izin'),
				'jam_masuk' => '00:00:00', // Mengosongkan jam_masuk
				'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
				'date' => $tanggal_sekarang, // Menyimpan tanggal izin
			];
			$this->m_model->tambah_data('absensi', $data);
			$this->session->set_flashdata('berhasil_izin', 'Berhasil Izin.');
		}
	
		redirect(base_url('employee/absen'));
	}

    // untuk aksi update
    public function aksi_update_izin()
    {
        $id_karyawan = $this->session->userdata('id');
		$data = [
			'keterangan_izin' => $this->input->post('keterangan_izin'),
		];
		$eksekusi=$this->m_model->update_data
        ('absensi', $data, array('id'=>$this->input->post('id')));
        if($eksekusi)
        {
            $this->session->set_flashdata('berhasil_update_izin', 'Berhasil mengubah keterangan');
            redirect(base_url('employee/update'));
        }
        else
        {
            redirect(base_url('employee/izin/update_izin/'.$this->input->post('id')));
        }
    }

    
    // Public untuk pulang 
    public function pulang($id) {
        $this->user_model->setAbsensiPulang($id);
        redirect('employee/absensi');   
    }

    // ini funtion untuk menghapus
    public function hapus($id)
{
    $this->m_model->delete('absensi', 'id', $id);
    $this->session->set_flashdata(
        'berhasil_menghapus',
        'Data berhasil dihapus.'
    );
    redirect(base_url('employee/absensi'));
}


    // Public buat batal pulang 
    public function batal_pulang($id) {
        // Di sini Anda dapat menambahkan logika untuk membatalkan pulang berdasarkan ID yang diberikan
        // Misalnya, Anda dapat mengubah status dari 'pulang' menjadi 'belum done' atau melakukan sesuatu sesuai kebutuhan Anda.
        
        // Contoh: Mengubah status pulang menjadi 'belum done'
        $this->user_model->updateStatusBatalPulang($id);
    
        // Redirect kembali ke halaman absensi atau halaman yang sesuai
        redirect('employee/absensi');
    }
    


    // funtion unruk profile 
    public function profile()
	{
		$data['akun'] = $this->user_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
		$this->load->view('employee/profile', $data);
	}

    // untuk mengubah profile 

    public function edit_foto() 
    {
        // Pastikan pengguna sudah login dan memiliki sesi aktif
        if (!$this->session->userdata('user_id')) {
            redirect('login'); // Redirect ke halaman login jika tidak ada sesi aktif
        }
    
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/images/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Ukuran maksimum gambar dalam KB
        $config['file_name'] = 'user_model' . $this->session->userdata('user_id'); // Nama file yang akan disimpan
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('userfile')) {
            // Jika upload berhasil, simpan nama file di database
            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['file_name'];
    
            // Simpan nama file ke database (misalnya, tabel 'user')
            $user_id = $this->session->userdata('user_id');
            $this->user_model->updateUserImage($user_id, $file_name);
    
            // Redirect kembali ke halaman profil
            redirect('employee/profile');
        } else {
            // Jika upload gagal, tampilkan pesan kesalahan atau validasi
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('employee/edit_foto', $error);
        }
    }

    // untuk edit profile nya 

}

?>