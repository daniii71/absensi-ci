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

    public function updateUserFoto($user_id, $foto)
    {
        $data = ['foto' => $foto];
        $this->db->where('id', $user_id);
        $this->db->update('User', $data);
    }

    function get_data($table){
        return $this->db->get($table);
    }

    public function get_by_id($table, $id_column, $id) {
        $data = $this->db->where($id_column, $id)->get($table);
        return $data;
    }

    public function addAbsensi($data) {
        // Fungsi ini digunakan untuk menambahkan data absensi.
        // Anda dapat mengisi tanggal dan jam masuk sesuai dengan waktu saat ini.
        // Anda juga harus mengatur status ke "belum done".
        $data['tanggal'] = date('Y-m-d');
        $data['jam_masuk'] = date('H:i:s');
        $data['status'] = 'belum done';
    
        // Selanjutnya, masukkan data ini ke tabel "absensi".
        $this->db->insert('absensi', $data);
    
        // Kembalikan ID dari data yang baru saja ditambahkan
        return $this->db->insert_id();
    }

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

    public function updateAbsensi($absen_id, $data) {
        // Perbarui data absensi berdasarkan $absen_id
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }

    public function batalPulang($absen_id) {
        $data = array(
            'jam_pulang' => null,
            'status' => 'belum done'
        );
    
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }



    // update untuk mengumbah absensi 
    function get_id_employee($id)
    {
        $this->db->where('id_user', $id);
        $this->db->get('user',)->row();
    }
    
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

    public function update_absen($absen_id, $data) 
    {
        $this->db->where('id', $absen_id);
        $this->db->update('absensi', $data);
    }   

    public function update_data($table, $data, $where)
    {
       $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

}

?>