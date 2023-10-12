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
    public function absensi()
    {
        if ($this->session->userdata('role') === 'karyawan') {
            // Set zona waktu ke 'Asia/Jakarta'
            date_default_timezone_set('Asia/Jakarta');
    
            $data['absensi'] = $this->user_model->get_data('absensi')->result();
            $this->load->view('employee/absensi', $data);
        } else {
            redirect('other_page');
        }
    }

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
    
    public function pulang($absensi_id) {
        if ($this->session->userdata('role') === 'karyawan') {
            $this->user_model->setAbsensiPulang($absensi_id);
    
            // Set pesan sukses
            $this->session->set_flashdata('success', 'Jam pulang berhasil diisi.');
    
            // Panggil fungsi JavaScript untuk menampilkan SweetAlert2
            echo '<script>showSweetAlert("Jam pulang berhasil diisi.");</script>';
    
            redirect('employee/absensi');
        } else {
            redirect('other_page');
        }
    } 

	// untuk profile 
	function profile()
	{
		$data['karyawan'] = $this->m_employee->get_id_employee($id);
		if ($data['karyawan']) {
			$data['title'] = 'profile_user';
			$this->template->load('back/template', 'back/profile', $data);
		} else {
			redirect('dashboard', 'refresh');
		}
	}
}

?>