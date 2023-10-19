<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    function get_data($table)
    {
        return $this->db->get($table);
    }

    // rekap karyawan
    public function getKaryawan() {
        $query = $this->db->get('absensi');
        return $query->result_array();
    }

    // rekap harian
    public function getRekapHarian($tanggal)
    {
        $this->db->select(
            'absensi.id, absensi.tanggal, absensi.kegiatan, absensi.id_karyawan, absensi.jam_masuk, absensi.jam_pulang, absensi.status'
        );
        $this->db->from('absensi');
        $this->db->where('absensi.tanggal', $tanggal); // Menyaring data berdasarkan tanggal
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // rekap absensi last 
    public function getAbsensiLast7Days() {
        $this->load->database();
        $end_tanggal = date('Y-m-d');
        $start_tanggal = date('Y-m-d', strtotime('-7 days', strtotime($end_tanggal)));            
        $query = $this->db->select('tanggal, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status, COUNT(*) AS total_absences')
                            ->from('absensi')
                            ->where('tanggal >=', $start_tanggal)
                            ->where('tanggal <=', $end_tanggal)
                            ->group_by('tanggal, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status')
                            ->get();

        return $query->result_array();
    }
    
    // rekap bulanan 
    public function getRekapPerBulan($bulan)
        {
            $this->db->select("absensi.*, user.username");
            $this->db->from("absensi");
            $this->db->join("user", "absensi.id_karyawan = user.id", "left");
            $this->db->where("DATE_FORMAT(tanggal, '%m') = ", $bulan); // Perbaikan di sini
            $query = $this->db->get();
            return $query->result();
        }
    
        // untuk get export 
    public function getExportKaryawan() {
        $this->db->select('absensi.id, user.username, absensi.kegiatan, absensi.tanggal, absensi.jam_masuk, absensi.jam_pulang, absensi.status');
        $this->db->from('absensi');
        $this->db->join('user', 'user.id = absensi.id_karyawan', 'left');
        $query = $this->db->get();
    
        return $query->result();
    }

    // untuk get rekap hari dan bulan 
    public function getRekapHarianByBulan($bulan) {
        $this->db->select('absensi.*, user.username');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('MONTH(absensi.tanggal)', $bulan);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // untuk export data harian
    public function exportDataRekapHarian($tanggal_awal, $tanggal_akhir) {
        $this->db->select('tanggal, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->where('tanggal >=', $tanggal_awal);
        $this->db->where('tanggal <=', $tanggal_akhir);
        $this->db->group_by('tanggal');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // export data rekap mingguan
    public function exportDataRekapMingguan() {
        $this->db->select('WEEK(tanggal) as minggu, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->group_by('minggu');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // export data rakap bulan 
    public function exportDataRekapBulanan() {
        $this->db->select('MONTH(tanggal) as bulan, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>