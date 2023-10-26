<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        // load model dan libry yang di perlukan 
		$this->load->model('user_model');
		$this->load->model('m_model');
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
		$data['absensi'] = $this->user_model->get_data('absensi')->result();
        $this->load->view('employee/dashboard', $data);
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

		public function menu_absensi()
		{
			$this->load->view('employee/menu_absensi');
		}
		
        // untuk menu absensi
        public function aksi_absensi() {
			date_default_timezone_set('Asia/Jakarta');
			$jam_masuk = date('H:i:s');

            if ($this->session->userdata('role') === 'karyawan') {
                $user_id = $this->session->userdata('id'); // Ambil id pengguna yang sedang login
                $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required');
                
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('employee/menu_absensi');
                } else {
                    
                    $data = array(
                        'id_karyawan' => $user_id, // Tetapkan id_karyawan berdasarkan pengguna yang sedang login
                        'kegiatan' => $this->input->post('kegiatan'),
                        'tanggal' => date('Y-m-d'),
                        'jam_masuk' => $jam_masuk,
                        'jam_pulang' => $jam_pulang,
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

		// untuk function update
        public function update_absen($id)
	{
		$data['absensi']=$this->user_model->get_by_id('absensi', 'id', $id)->result();
		$this->load->view('employee/update', $data);
	}

        // untuk menu update absen
            public function update() 
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
                    redirect(base_url('employee/absensi'));
                }
                else
                {
                    redirect(base_url('employee/update/'.$this->input->post('id')));
                }
            }

            public function menu_izin()
	        {
	        	$this->load->view('employee/menu_izin');
	        }

    // untuk aksi izin nya 
	public function aksi_izin() {
		$id_karyawan = $this->session->userdata('id');
		$tanggal_sekarang = date('Y-m-d'); // Mendapatkan tanggal hari ini

			$data = [
				'id_karyawan' => $id_karyawan,
				'kegiatan' => '-',
				'status' => 'true',
				'keterangan_izin' => $this->input->post('keterangan_izin'),
				'jam_masuk' => '00:00:00', // Mengosongkan jam_masuk
				'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
				'tanggal' => date('Y-m-d'), // Menyimpan tanggal izin
			];
			$this->user_model->tambah_data('absensi', $data);
			$this->session->set_flashdata('berhasil_izin', 'Berhasil Izin.');
	
		redirect(base_url('employee/absensi'));
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
            redirect(base_url('employee/update_izin/'.$this->input->post('id')));
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

    // function unruk profile 
	public function profile()
	{
		$data['akun'] = $this->user_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
		$this->load->view('employee/profile', $data);
	}

	// edit profile
    public function edit_profile()
	{
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$nama_depan = $this->input->post('nama_depan');
		$nama_belakang = $this->input->post('nama_belakang');

		$data = array(
			'email' => $email,
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
		);

		if (!empty($password_baru)) {
			if ($password_baru === $konfirmasi_password) {
				$data['password'] = md5($password_baru);
				$this->session->set_flashdata('ubah_password', 'Berhasil mengubah password');
			} else {
				$this->session->set_flashdata('kesalahan_password', 'Password baru dan Konfirmasi password tidak sama');
				redirect(base_url('employee/profile'));
			}
		}

		$this->session->set_userdata($data);
		$update_result = $this->m_model->ubah_data('user', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('employee/profile'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('employee/profile'));
		}
	}
	
    public function edit_foto() {
		$config['upload_path'] = './assets/images/karyawan/'; //'./assets/images/karyawan/'; // Lokasi penyimpanan gambar di server
		$config['allowed_types'] = 'jpg|jpeg|png'; // Tipe file yang diizinkan
		$config['max_size'] = 5120; // Maksimum ukuran file (dalam KB)
	
		$this->load->library('upload', $config);
	
		if ($this->upload->do_upload('userfile')) {
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
	
			// Update nama file gambar baru ke dalam database untuk user yang sesuai
			$user_id = $this->session->userdata('id'); // Ganti ini dengan cara Anda menyimpan ID user yang sedang login
			$current_image = $this->m_model->get_current_image($user_id); // Dapatkan nama gambar saat ini
	
			if ($current_image !== 'User.png') {
				// Hapus gambar saat ini jika bukan 'User.png'
				unlink('./assets/images/karyawan/' . $current_image);
			}
	
			$this->m_model->update_image($user_id, $file_name); // Gantilah 'm_model' dengan model Anda
			$this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');

	
			// Redirect atau tampilkan pesan keberhasilan
			redirect('employee/profile'); // Gantilah dengan halaman yang sesuai
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_profile', $error['error']);
			redirect('employee/profile');
			// Tangani kesalahan unggah gambar
		}
	}
}

?>