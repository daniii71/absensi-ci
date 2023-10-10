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

public function getDataPembayaran() {
    $this->db->select('pembayaran.id, pembayaran.jenis_pembayaran, pembayaran.total_pembayaran, siswa.nama_siswa, kelas.tingkat_kelas, kelas.jurusan_kelas');
    $this->db->from('pembayaran');
    $this->db->join('siswa', 'siswa.id_siswa = pembayaran.id_siswa', 'left');
    $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
    $query = $this->db->get();

    return $query->result();
}

public function getDataSiswa()
    {
        $this->db->select('siswa.id_siswa, siswa.nama_siswa, siswa.nisn, siswa.gender, kelas.tingkat_kelas, kelas.jurusan_kelas');
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
        $query = $this->db->get();

        return $query->result();
    }

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
    public function register_user($data) { 
        // Masukkan data ke dalam tabel 'users' dan kembalikan hasilnya 
        return $this->db->insert('user', $data); 
    }

}
?>