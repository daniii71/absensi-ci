<?php
class user_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk menambahkan pengguna ke database
    public function registeruser($data)
    {
        $this->db->insert('user', $data);
    }

    // Fungsi untuk memeriksa kredensial pengguna saat login
    public function checkLogin($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();

        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }

    // Fungsi untuk mendapatkan data pengguna berdasarkan ID
    public function getuserByID($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    // untuk get user by id email 
    public function getUserByEmail($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    // Fungsi untuk mendapatkan data semua karyawan
    public function getAllKaryawan()
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('role', 'karyawan');
        $query = $this->db->get();

        return $query->result();
    }

    // Fungsi untuk memperbarui informasi profil pengguna
    public function updateProfile($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('User', $data);
    }

    // Fungsi untuk menghapus pengguna berdasarkan ID
    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('User');
    }

    // untuk update foto
    public function updateUserFoto($user_id, $foto)
    {
        $data = ['foto' => $foto];
        $this->db->where('id', $user_id);
        $this->db->update('User', $data);
    }

    // untuk nge get data 
    function get_data($table){
        return $this->db->get($table);
    }

    // untuk get by idb tabel
    public function get_by_id($table, $id_column, $id) {
        $data = $this->db->where($id_column, $id)->get($table);
        return $data;
    }

    // untuk add absen
    public function addAbsensi($data) {
        // Fungsi ini digunakan untuk menambahkan data absensi.
        $data['tanggal'] = date('Y-m-d');
        $data['jam_masuk'] = date('H:i:s');
        $data['status'] = 'belum done';
    
        // Selanjutnya, masukkan data ini ke tabel "absensi".
        $this->db->insert('absensi', $data);
    
        // Kembalikan ID dari data yang baru saja ditambahkan
        return $this->db->insert_id();
    }

    // absensi untuk pulang 
    public function setAbsensiPulang($absen_id) {
        // Fungsi ini digunakan untuk mengisi jam pulang dan mengubah status menjadi "pulang".
        $data = array(
            'jam_pulang' => date('H:i:s'),
            'status' => 'pulang'
        );

        // Ubah data absensi berdasarkan absen_id.
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }

    // ini untuk add izinya 
    public function addIzin($data) {
        // Fungsi ini digunakan untuk menambahkan izin.
        // Anda dapat mengisi tanggal saat ini sebagai tanggal izin.
        // Anda juga perlu mengatur status ke "done" dan jam masuk serta jam pulang ke NULL.
    
        $data = array(
            'id_karyawan' => $data['id_karyawan'], // Menggunakan data dari parameter
            'keterangan_izin' => $data['keterangan'],      // Menggunakan data dari parameter
            'tanggal' => date('Y-m-d'),
            'kegiatan' => '-',
            'jam_masuk' => '-',
            'jam_pulang' => '-',
            'status' => 'done'
        );
    
        // Selanjutnya, masukkan data ini ke tabel "absensi".
        $this->db->insert('absensi', $data);
    }


    // untuk function hapus absen
    public function hapusAbsensi($absen_id) {
        $this->db->where('id', $absen_id);
        $this->db->delete('absensi');
    }    

    // untuk update absensi
    public function updateAbsensi($absen_id, $data) {
        // Perbarui data absensi berdasarkan $absen_id
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }

    // update untuk mengumbah absensi 
    function get_id_employee($id)
    {
        $this->db->where('id_user', $id);
        $this->db->get('user',)->row();
    }
    
    // untuk get absensi by id 
    public function getAbsensiById($absensi_id) {
        // Assuming your table name is 'absensi', you can use CodeIgniter's query builder
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('id', $absensi_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row(); // Return a single row if found
        } else {
            return false; // Return false if no record is found
        }
    }

    // untuk update absen
    public function update_absen($absen_id, $data) 
    {
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }   

    // untuk update absen
    public function update_data($table, $data, $where)
    {
       $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    //  utnuk cek absen
    public function cek_absen($id_karyawan, $tanggal) {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('absensi');
    
        if ($query->num_rows() > 0) {
            return true; // Jika sudah ada entri absen untuk karyawan dan tanggal tertentu
        } else {
            return false; // Jika belum ada entri absen untuk karyawan dan tanggal tertentu
        }
    }

    //utnuk cek izin
    public function cek_izin($id_karyawan, $tanggal) {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'true'); // Hanya mencari entri dengan status izin
        $query = $this->db->get('absensi');

        if ($query->num_rows() > 0) {
            return true; // Jika sudah ada entri izin untuk karyawan dan tanggal tertentu
        } else {
            return false; // Jika belum ada entri izin untuk karyawan dan tanggal tertentu
        }
    }

    // untuk tambah data baru 
    public function tambah_data($table, $data)
    {
        $data = $this->db->insert($table, $data);
        return $this->db->insert_id();

    }
}

?>