<?php

class M_model extends CI_Model
{
    function get_data($table)
    {
        return $this->db->get($table);
    }

    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
    public function delete($table, $field, $id) {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }

    public function tambah_data($table, $data)
    {
        $data = $this->db->insert($table, $data);
        return $this->db->insert_id();

    }
    public function get_by_id($table, $id_column, $id)
    {
        $data = $this->db->where($id_column, $id)->get($table);
        return $data;
    }

    public function ubah_data($table, $data, $where)
    {
       $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    // ubah data 
    public function get_by_nisn($nisn){
        $this->db->select('id_siswa');
        $this->db->from('siswa');
        $this->db->where('nisn', $nisn);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->id_siswa;
        } else {
            return false;
        }
    }

    function tampil_id_kelas_byid($id)
        {
            $ci = &get_instance();
            $ci -> load->database();
            $result = $ci->db->where('id_siswa', $id)->get('siswa');
            foreach ($result->result() as $c) {
                $stmt = $c->id_kelas;
                return $stmt;
            }
        }

        // untuk menambah data pembayaran
public function getDataPembayaran() {
    $this->db->select('pembayaran.id, pembayaran.jenis_pembayaran, pembayaran.total_pembayaran, siswa.nama_siswa, kelas.tingkat_kelas, kelas.jurusan_kelas');
    $this->db->from('pembayaran');
    $this->db->join('siswa', 'siswa.id_siswa = pembayaran.id_siswa', 'left');
    $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
    $query = $this->db->get();

    return $query->result();
}

// untuk data  siswa
public function getDataSiswa()
    {
        $this->db->select('siswa.id_siswa, siswa.nama_siswa, siswa.nisn, siswa.gender, kelas.tingkat_kelas, kelas.jurusan_kelas');
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
        $query = $this->db->get();

        return $query->result();
    }

    // untuk data kelass by id tingkat jurusan 
    public function getKelasByTingkatJurusan($tingkat_kelas, $jurusan_kelas)
    {
        $this->db->select('id');
        $this->db->where('tingkat_kelas', $tingkat_kelas);
        $this->db->where('jurusan_kelas', $jurusan_kelas);
        $query = $this->db->get('kelas');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return false;
        }
    }

    //  fungsi untuk mengambil nama mapel dengan nama tabel anda
    public function get_mapel_by_id($id_mapel)
    {
        // ganti 'mapel' dengan nama tabel mapel tersebut 
        $this->db->select('nama_mapel');
        $this->db->where('id', $id_mapel);
        $query = $this->db->get('mapel');

        // priksa apakah query berhasil
        if ($query->num_rows() > 0) {
            return $query->row();  
        } else {
            return null;
        }
    }

    // untuk register user 
    public function register_user($data) { 
        // Masukkan data ke dalam tabel 'users' dan kembalikan hasilnya 
        return $this->db->insert('user', $data); 
    }

    // ini untuk get function bulanan 
    // public function getRekapPerBulan($bulan) {
    //     $this->db->select('MONTH(tanggal) as bulan, COUNT(*) as total_absensi');
    //     $this->db->from('absensi');
    //     $this->db->where('MONTH(tanggal)', $bulan); // Menyaring data berdasarkan bulan
    //     $this->db->group_by('bulan');
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    // untuk mingguan 
    public function getRekapPerMinggu($start_date, $end_date) {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('tanggal >=', $start_date); 
        $this->db->where('tanggal <=', $end_date);
        $query = $this->db->get();
        return $query->result();
    }

    // ini untuk function rekap hari dan bulan
    public function getRekapHarianByBulan($bulan) {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('MONTH(absensi.tanggal )', $bulan);
        $query = $this->db->get();
        return $query->result_array();
    }

    // ini function get harian
    public function getPerHari($tanggal)
        {
            $this->db->from('absensi');
            $this->db->select('absensi.*, user.username');
            $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
            $this->db->where('absensi.tanggal', $tanggal);
            $query = $this->db->get();
            return $query->result_array();
        }

        // untuk fanction update
        public function update_image($user_id, $new_image) {
            $data = array(
                'image' => $new_image
            );
    
            $this->db->where('id', $user_id); // Sesuaikan dengan kolom dan nama tabel yang sesuai
            $this->db->update('user', $data); // Sesuaikan dengan nama tabel Anda
    
            return $this->db->affected_rows(); // Mengembalikan jumlah baris yang diupdate
        }
        
        // get image 
        public function get_current_image($user_id) {
            $this->db->select('image');
            $this->db->from('user'); // Gantilah 'user_table' dengan nama tabel Anda
            $this->db->where('id', $user_id);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->image;
            }
    
            return null; // Kembalikan null jika data tidak ditemukan
        }

        // cek izin
        public function cek_izin($id_karyawan, $tanggal)
        {
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
    
        // cek absen 
        public function cek_absen($id_karyawan, $tanggal)
        {
            $this->db->where('id_karyawan', $id_karyawan);
            $this->db->where('tanggal', $tanggal);
            $query = $this->db->get('absensi');
    
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        // get bulanan 
        public function getBulanan($bulan)
    {
        $this->db->select('absensi.*, user.username');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where("DATE_FORMAT(tanggal, '%m') = ", $bulan); // Perbaikan di sini
        $query = $this->db->get();
        return $query->result();
    }

    // get data harian
    public function getHarianData($date)
    {
        $this->db->select('absensi.*, user.nama_depan, user.nama_belakang');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('tanggal', $date);
        $query = $this->db->get();
        return $query->result();
    }

    // get data bulanan 
    public function get_bulanan($date)
    {
        $this->db->from('absensi');
        $this->db->where("DATE_FORMAT(absensi.tanggal, '%m') =", $date);
        $query = $this->db->get();
        return $query->result();
    }
}
?>