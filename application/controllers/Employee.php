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
            // Set zona waktu ke 'Asia/Jakarta'
            date_default_timezone_set('Asia/Jakarta');
    
            $data['absensi'] = $this->user_model->get_data('absensi')->result();
            $this->load->view('employee/absensi', $data);
        } else {
            redirect('absensi');
        }
    }

    // untuk menu update absen
    public function update_absen($id)
    {
        $data['absensi']=$this->user_model->get_by_id('absensi', 'id', $id)->result();
        $this->load->view('employee/update', $data);
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

    // untuk menu izin
	public function menu_izin() {
        if ($this->session->userdata('role') === 'karyawan') {
            $user_id = $this->session->userdata('id');
            $this->form_validation->set_rules('keterangan', 'Keterangan Izin', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('employee/menu_izin');
            } else {
                $data = array(
                    'id_karyawan' => $user_id,
                    'keterangan' => $this->input->post('keterangan'), // Mengambil data dari form input
                );
    
                // Memanggil fungsi untuk menambahkan izin
                $this->karyawan_model->addIzin($data);
    
                // Redirect ke halaman history_absen
                redirect('employee/absensi');
            }
        } else {
            redirect('other_page');
        }
    }
    
    // Public untuk pulang 
    public function pulang($id) {
        $this->user_model->updateStatusPulang($id);
        redirect('employee/absensi');
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
    
}

?>