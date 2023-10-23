<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load model yang diperlukan
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('m_model');
        $this->load->helper('admin_helper');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $data['absensi'] = $this->admin_model->get_data('absensi')->result();
		$this->load->view('admin/index', $data);
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

    // untuk rekap absen
	public function absen()
	{
		$id_admin = $this->session->userdata('id');
		$data['absensi'] = $this->user_model->get_data('absensi')->result();
		$this->load->view('admin/absen', $data);
	}

    // untuk rekap bulanan 
    public function rekap_bulanan()
    {
        $bulan = $this->input->post('bulan');
        $data['absen'] = $this->m_model->getBulanan($bulan);
        $this->session->set_flashdata('bulan', $bulan);
        $this->load->view('admin/rekap_bulanan', $data);
    }
    
    // untuk rekap harian 
	public function rekap_harian()
    {
        $tanggal = $this->input->get('tanggal'); // Ambil tanggal dari parameter GET
        $data['rekap_harian'] = $this->admin_model->getRekapHarian($tanggal);
        $this->load->view('admin/rekap_harian', $data);
    }

    // untuk function rekap mingguan 
	public function rekap_mingguan() {
		$start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if ($start_date && $end_date) {
            $data['perminggu'] = $this->m_model->getRekapPerMinggu($start_date, $end_date);
        } else {
            $data['perminggu'] = []; // Atau lakukan sesuai dengan kebutuhan logika Anda jika tanggal tidak ada
        }

		$this->load->view('admin/rekap_mingguan', $data);
		// $data['absensi'] = $this->m_model->getPerMinggu();        
    }
	
    // ini bg untuk profile 
	public function profile()
	{
		$data['akun'] = $this->user_model->get_by_id('user', 'id', $this->session->userdata('id'))->result();
		$this->load->view('admin/profile', $data);
	}

    // ini untuk funtion edit profile
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
				redirect(base_url('admin/profile'));
			}
		}

		$this->session->set_userdata($data);
		$update_result = $this->m_model->ubah_data('user', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('admin/profile'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('admin/profile'));
		}
	}

    // function edit foto
	public function edit_foto() {
		$config['upload_path'] = './assets/images/user/'; // Lokasi penyimpanan gambar di server
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
				unlink('./assets/images/user/' . $current_image);
			}
	
			$this->m_model->update_image($user_id, $file_name); // Gantilah 'm_model' dengan model Anda
			$this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');

	
			// Redirect atau tampilkan pesan keberhasilan
			redirect('admin/profile'); // Gantilah dengan halaman yang sesuai
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_profile', $error['error']);
			redirect('admin/profile');
			// Tangani kesalahan unggah gambar
		}
	}

    // ini untuk function export
    public function export_admin()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderstyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderstyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
            ],
        ];

        // set judul
        $sheet->setCellValue('A1', 'DATA ABSESNI KARYAWAN');
        $sheet->mergeCells('A1:E1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);
        // set thead
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'NAMA KARYAWAN');
        $sheet->setCellValue('C3', 'KEGIATAN');
        $sheet->setCellValue('D3', 'TANGGAL');
        $sheet->setCellValue('E3', 'JAM MASUK');
        $sheet->setCellValue('F3', 'JAM PULANG');
        $sheet->setCellValue('G3', 'STATUS');

        // mengaplikasikan style thead
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // get dari database
        $data_siswa = $this->admin_model->getExportKaryawan();

        $no = 1;
        $numrow = 4;
        foreach ($data_siswa as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id);
            $sheet->setCellValue('B' . $numrow, $data->username);
            $sheet->setCellValue('C' . $numrow, $data->kegiatan);
            $sheet->setCellValue('D' . $numrow, $data->date);
            $sheet->setCellValue('E' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('F' . $numrow, $data->jam_pulang);
            $sheet->setCellValue('G' . $numrow, $data->status);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        // set panjang column
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(25);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        // set nama file saat di export
        $sheet->setTitle('LAPORAN DATA PEMBAYARAN');
        header(
            'Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment; filename="ABSEN KARYAWAN.xlsx"'
        );
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // export mingguan 
    public function export_mingguan()
    {
        $tanggal_akhir = date('Y-m-d');
        $tanggal_awal = date(
            'Y-m-d',
            strtotime('-7 days', strtotime($tanggal_akhir))
        );
        $tanggal_awal = date('W', strtotime($tanggal_awal));
        $tanggal_akhir = date('W', strtotime($tanggal_akhir));
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if (!empty($tanggal_awal && $tanggal_akhir)) {
            $style_col = [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' =>
                        \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                    'vertical' =>
                        \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'top' => [
                        'borderstyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                ],
            ];

            $style_row = [
                'alignment' => [
                    'vertical' =>
                        \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'top' => [
                        'borderstyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                ],
            ];

            // set judul
            $sheet->setCellValue('A1', 'REKAP DATA MINGGUAN');
            $sheet->mergeCells('A1:E1');
            $sheet
                ->getStyle('A1')
                ->getFont()
                ->setBold(true);
            // set thead
            $sheet->setCellValue('A3', 'NO');
            $sheet->setCellValue('B3', 'NAMA KARYAWAN');
            $sheet->setCellValue('C3', 'KEGIATAN');
            $sheet->setCellValue('D3', 'TANGGAL');
            $sheet->setCellValue('E3', 'JAM MASUK');
            $sheet->setCellValue('F3', 'JAM PULANG');
            $sheet->setCellValue('G3', 'KETERANGAN IZIN');

            // mengaplikasikan style thead
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);
            $sheet->getStyle('F3')->applyFromArray($style_col);
            $sheet->getStyle('G3')->applyFromArray($style_col);

            // get dari database
            $data_mingguan = $this->m_model->getAbsensiLast7Days(
                $tanggal_awal,
                $tanggal_akhir
            );

            $no = 1;
            $numrow = 4;
            foreach ($data_mingguan as $data) {
                $sheet->setCellValue('A' . $numrow, $data['id']);
                $sheet->setCellValue(
                    'B' . $numrow,
                    $data['nama_depan'] . ' ' . $data['nama_belakang']
                );
                $sheet->setCellValue('C' . $numrow, $data['kegiatan']);
                $sheet->setCellValue('D' . $numrow, $data['tanggal']);
                $sheet->setCellValue('E' . $numrow, $data['jam_masuk']);
                $sheet->setCellValue('F' . $numrow, $data['jam_pulang']);
                $sheet->setCellValue('G' . $numrow, $data['keterangan_izin']);

                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }

            // set panjang column
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(30);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(30);

            $sheet->getDefaultRowDimension()->setRowHeight(-1);

            $sheet
                ->getPageSetup()
                ->setOrientation(
                    \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
                );

            // set nama file saat di export
            $sheet->setTitle('LAPORAN REKAP DATA MINGGUAN');
            header(
                'Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet'
            );
            header(
                'Content-Disposition: attachment; filename="REKAP_MINGGUAN.xlsx"'
            );
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    // export harian 
    public function export_harian()
    {
        $date = date('Y-m-d');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if (!empty($date)) {
            $style_col = [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' =>
                        \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                    'vertical' =>
                        \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'top' => [
                        'borderstyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                ],
            ];

            $style_row = [
                'alignment' => [
                    'vertical' =>
                        \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'top' => [
                        'borderstyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                    ],
                ],
            ];

            // set judul
            $sheet->setCellValue('A1', 'REKAP DATA HARIAN');
            $sheet->mergeCells('A1:E1');
            $sheet
                ->getStyle('A1')
                ->getFont()
                ->setBold(true);
            // set thead
            $sheet->setCellValue('A3', 'NO');
            $sheet->setCellValue('B3', 'NAMA KARYAWAN');
            $sheet->setCellValue('C3', 'KEGIATAN');
            $sheet->setCellValue('D3', 'TANGGAL');
            $sheet->setCellValue('E3', 'JAM MASUK');
            $sheet->setCellValue('F3', 'JAM PULANG');
            $sheet->setCellValue('G3', 'KETERANGAN IZIN');

            // mengaplikasikan style thead
            $sheet->getStyle('A3')->applyFromArray($style_col);
            $sheet->getStyle('B3')->applyFromArray($style_col);
            $sheet->getStyle('C3')->applyFromArray($style_col);
            $sheet->getStyle('D3')->applyFromArray($style_col);
            $sheet->getStyle('E3')->applyFromArray($style_col);
            $sheet->getStyle('F3')->applyFromArray($style_col);
            $sheet->getStyle('G3')->applyFromArray($style_col);

            // get dari database
            $data_harian = $this->m_model->getHarianData($date);

            $no = 1;
            $numrow = 4;
            foreach ($data_harian as $data) {
                $sheet->setCellValue('A' . $numrow, $data->id);
                $sheet->setCellValue(
                    'B' . $numrow,
                    $data->nama_depan . ' ' . $data->nama_belakang
                );
                $sheet->setCellValue('C' . $numrow, $data->kegiatan);
                $sheet->setCellValue('D' . $numrow, $data->tanggal);
                $sheet->setCellValue('E' . $numrow, $data->jam_masuk);
                $sheet->setCellValue('F' . $numrow, $data->jam_pulang);
                $sheet->setCellValue('G' . $numrow, $data->keterangan_izin);

                $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
                $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

                $no++;
                $numrow++;
            }

            // set panjang column
            $sheet->getColumnDimension('A')->setWidth(5);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(20);
            $sheet->getColumnDimension('E')->setWidth(30);
            $sheet->getColumnDimension('F')->setWidth(30);
            $sheet->getColumnDimension('G')->setWidth(30);

            $sheet->getDefaultRowDimension()->setRowHeight(-1);

            $sheet
                ->getPageSetup()
                ->setOrientation(
                    \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
                );

            // set nama file saat di export
            $sheet->setTitle('LAPORAN REKAP DATA HARIAN');
            header(
                'Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet'
            );
            header(
                'Content-Disposition: attachment; filename="REKAP_HARIAN.xlsx"'
            );
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }

    // export karyawan
    public function export_karyawan()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $m_model->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderstyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
            ],
        ];

        $style_row = [
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderstyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
                ],
            ],
        ];

        // set judul
        $sheet->setCellValue('A1', 'DATA ABSESNI KARYAWAN');
        $sheet->mergeCells('A1:E1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);
        // set thead
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'NAMA KARYAWAN');
        $sheet->setCellValue('C3', 'KEGIATAN');
        $sheet->setCellValue('D3', 'TANGGAL');
        $sheet->setCellValue('E3', 'JAM MASUK');
        $sheet->setCellValue('F3', 'JAM PULANG');
        $sheet->setCellValue('G3', 'STATUS');

        // mengaplikasikan style thead
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        // get dari database
        $data_siswa = $this->admin_model->getExportKaryawan();

        $no = 1;
        $numrow = 4;
        foreach ($data_siswa as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id);
            $sheet->setCellValue('B' . $numrow, $data->username);
            $sheet->setCellValue('C' . $numrow, $data->kegiatan);
            $sheet->setCellValue('D' . $numrow, $data->tanggal); 
            $sheet->setCellValue('E' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('F' . $numrow, $data->jam_pulang);
            $sheet->setCellValue('G' . $numrow, $data->status);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        // set panjang column
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(25);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        // set nama file saat di export
        $sheet->setTitle('LAPORAN DATA PEMBAYARAN');
        header(
            'Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment; filename="ABSEN KARYAWAN.xlsx"'
        );
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // export rekap bulanan 
    public function export_rekap_bulanan()
    {
        // Ambil data rekap bulanan dari model sesuai bulan yang dipilih
        $bulan = $this->session->flashdata('bulan');
        $data = $this->m_model->get_bulanan($bulan);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $style_row = [
            'alignment' => [
                'vertical' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', 'REKAP BULANAN');
        $sheet->mergeCells('A1:E1');
        $sheet
            ->getStyle('A1')
            ->getFont()
            ->setBold(true);

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'KEGIATAN');
        $sheet->setCellValue('C3', 'TANGGAL');
        $sheet->setCellValue('D3', 'JAM MASUK');
        $sheet->setCellValue('E3', 'JAM PULANG');
        $sheet->setCellValue('F3', 'KETERANGAN');
        $sheet->setCellValue('G3', 'STATUS');

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);

        $data = $this->m_model->get_bulanan($bulan);

        $no = 1;
        $numrow = 4;
        foreach ($data as $data) {
            $sheet->setCellValue('A' . $numrow, $data->id);
            $sheet->setCellValue('B' . $numrow, $data->kegiatan);
            $sheet->setCellValue('C' . $numrow, $data->tanggal);
            $sheet->setCellValue('D' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('E' . $numrow, $data->jam_pulang);
            $sheet->setCellValue('F' . $numrow, $data->keterangan_izin);
            $sheet->setCellValue('G' . $numrow, $data->status);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(35);
        $sheet->getColumnDimension('E')->setWidth(40);
        $sheet->getColumnDimension('F')->setWidth(45);
        $sheet->getColumnDimension('G')->setWidth(50);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet
            ->getPageSetup()
            ->setOrientation(
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
            );

        $sheet->SetTitle('LAPORAN REKAP BULANAN');

        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header(
            'Content-Disposition: attachment; filename="REKAP BULANAN.xlsx"'
        );
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}

?>