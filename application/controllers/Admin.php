<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load model yang diperlukan
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('admin/index');
	}

	// untuk daftar karyawan
	public function daftar_karyawan() {
        $data['absensi'] = $this->admin_model->getKaryawan();
        $this->load->view('admin/daftar_karyawan', $data);
    }


	// ini untuk function aksi login admin
		public function aksi_login()
	{  
		$email = $this->input->post('email', true);   
		$password = $this->input->post('password', true);   
		$data = ['email' => $email];   
		$query = $this->m_model->getwhere('user', $data);   
		$result = $query->row_array();   
		
		if (!empty($result) && md5($password) === $result['password']) {   
			if ($result['role'] == 'admin') { // Periksa apakah rolenya adalah 'admin'
				$data = [   
					'logged_in' => TRUE,   
					'email' => $result['email'],   
					'username' => $result['username'],   
					'role' => $result['role'],   
					'id' => $result['id'],   
				];   
				$this->session->set_userdata($data);
                if ($this->session->userdata('role') == 'admin') {
                    redirect(base_url() . 'admin');
                }elseif($this->session->userdata('role') == 'karyawan'){ 
                    redirect(base_url() . 'karyawan');
                } else {
                    redirect(base_url() . 'auth');
                }
			}
		} else {   
			echo "Login Gagal: Username atau Password Salah";   
			redirect(base_url() . "auth");
		}
	}

	// dan ini untuk data harian
    public function getRekapHarian($tanggal) {
        $this->db->select('absensi.id, absensi.tanggal, absensi.kegiatan, absensi.id_karyawan, absensi.jam_masuk, absensi.jam_pulang, absensi.status');
        $this->db->from('absensi');
        $this->db->where('absensi.tanggal', $tanggal); // Menyaring data berdasarkan tanggal
        $query = $this->db->get();
        return $query->result_array();
    }

    // ini untuk merekap data mingguan
    public function rekap_mingguan() {
        $data['absensi'] = $this->admin_model->getAbsensiLast7Days();     
        $this->load->view('admin/rekap_mingguan', $data);
    }    
    
    // untuk data rekap bulanan
    public function rekap_bulanan() {
        $bulan = $this->input->get('bulan'); // Ambil bulan dari parameter GET
        $data['rekap_bulanan'] = $this->admin_model->getRekapBulanan($bulan);
        $data['rekap_harian'] = $this->admin_model->getRekapHarianByBulan($bulan);
        $this->load->view('admin/rekap_bulanan', $data);
    }
    
    
    // untuk meng export rekapan yang kita buat dari yang harian, mingguan, dan bulanan
    public function export_rekapan($tanggal_awal, $tanggal_akhir) {
        // Ambil data rekap untuk diekspor
        $data['rekapan'] = $this->admin_model->exportDataRekapHarian($tanggal_awal, $tanggal_akhir);
        // Tambahkan logika ekspor data rekap harian ke dalam file, misalnya Excel atau CSV
    }

}

?>