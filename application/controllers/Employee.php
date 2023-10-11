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
        $this->load->view('employee/absensi');
    }
}
?>