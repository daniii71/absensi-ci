<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Auth extends CI_Controller { 
 
    function __construct() 
    { 
        parent::__construct(); 
        $this->load->model('m_model'); 
  $this->load->database(); 
    } 
 
    public function index()   
    {   
     $this->load->view('auth/login');   
    }   
    public function aksi_login() {  
        $email = $this->input->post('email', true);   
        $password = $this->input->post('password', true);   
        $data = [ 'email' => $email, ];   
        $query = $this->m_model->getwhere('user', $data);   
        $result = $query->row_array();   
          
        if (!empty($result) || md5($password) === $result['password']) {   
        $data = [   
            'logged_in' => TRUE,   
            'email' => $result['email'],   
            'username' => $result['username'],   
            'role' => $result['role'],   
            'id' => $result['id'],   
        ];   
        $this->session->set_userdata($data);   
        if ($this->session->userdata('role') == 'admin') {   
            redirect(base_url()."admin");   
        }elseif($this->session->userdata('role') == 'karyawan'){ 
            redirect(base_url()."employee/karyawan") ; 
        } else {   
            redirect(base_url()."auth");   
        }   
        } else {   
        redirect(base_url()."auth");   
        }   
    } 
 
    // ini register
    public function register() { 
        $this->load->view('auth/register'); 
    } 
 
    public function aksi_register() {  
        $username = $this->input->post('username', true);  
        $email    = $this->input->post('email', true);  
        $nama_depan    = $this->input->post('nama_depan', true);  
        $nama_belakang    = $this->input->post('nama_belakang', true);  
        $password = $this->input->post('password', true); 
        $role = $this->input->post('Role', true); 
       
        // password harus lebih dari 8
        if (strlen($password) < 8) { 
            // Password 
            redirect(base_url() . "auth/register"); 
        } 
       
        // Hash the password 
        $hashed_password = md5($password); 
       
        $data = [
            'username' => $username,
            'email' => $email,
            'nama_depan' => $nama_depan, // Change $firstName to $nama_depan
            'nama_belakang' => $nama_belakang, // Change $lastName to $nama_belakang
            'password' => $hashed_password,
            'role' => 'user'
        ];
        
       
      // Muat model database dan masukkan data 
    $this->load->model('M_model'); 
    $registration_result = $this->M_model->register_user($data); 
    
    if ($registration_result) { 
        // Pendaftaran berhasil 
      $this->session->set_userdata([ 
          'logged_in' => TRUE, 
          'email' => $email, 
          'username' => $username, 
          'nama_depan' => $nama_depan, 
          'nama_belakang' => $nama_belakang, 
          'role' => 'user' 
      ]); 
 
        redirect(base_url() . "auth"); 
    } else { 
        // Pendaftaran gagal, tangani sesuai dengan kebutuhan Anda 
        redirect(base_url() . "auth/register"); 
    } 
    }

    // ini untuk hasil text register admin

    public function register_admin()
    {
        $this->load->view('auth/register_admin');
    }

    public function aksi_register_admin()
    {
        $username = $this->input->post('username', true);
        $email = $this->input->post('email', true);
        $nama_depan = $this->input->post('nama_depan', true);
        $nama_belakang = $this->input->post('nama_belakang', true);
        $password = $this->input->post('password', true);
        $role = $this->input->post('role', true); // Menambahkan role

        // Password harus lebih dari 8 karakter
        if (strlen($password) < 8) {
            // Password kurang dari 8 karakter
            redirect(base_url() . "auth/register_admin");
        }

        // Hash the password (gunakan metode hash yang lebih aman daripada md5)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'username' => $username,
            'email' => $email,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'password' => $hashed_password,
            'role' => 'admin'
        ];

        // Muat model database dan masukkan data
        $this->load->model('M_model');
        $registration_result = $this->M_model->register_user($data);

        if ($registration_result) {
            // Pendaftaran berhasil
            $this->session->set_userdata([
                'logged_in' => TRUE,
                'email' => $email,
                'username' => $username,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'role' => 'admin'
            ]);

            redirect(base_url() . "auth");
        } else {
            // Pendaftaran gagal, tangani sesuai kebutuhan Anda
            redirect(base_url() . "auth/register_admin");
        }
    }

    // untuk kembali ke halaman awal
    function logout() { 
        $this->session->sess_destroy(); 
        redirect(base_url('auth')); 
    } 
}
?>