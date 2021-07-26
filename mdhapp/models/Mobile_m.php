<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobile_m extends CI_Model
{

    // Get Notice Data For Notice List In Jquery Call
    public function scrolNotice($limit, $start)
    {
        $q1 = $this->db->select('
                typepengumuman.nama_type,
                pengumuman.title,
                pengumuman.tanggal,
                pengumuman.image,
                pengumuman.id
        ')
            ->join('typepengumuman', 'typepengumuman.id=pengumuman.id_type')
            ->order_by('pengumuman.id', 'DESC')
            ->limit($limit, $start)
            ->get('pengumuman');
        return $q1;
    }

    // Get Award Data For Award List In Jquery Call
    public function scrollAward($limit, $start)
    {
        $q1 = $this->db
            ->select('typereward.nama_type,reward.id,reward.tanggal,reward.image,reward.deskripsi')
            ->join('typereward', 'typereward.id=reward.id_type')
            ->order_by('reward.id', 'DESC')
            ->limit($limit, $start)
            ->get('reward');
        return $q1;
    }

    // Get Notification Data For Notification List In Jquery Call
    public function scrollNotif($limit, $start)
    {
        $q1 = $this->db
            ->where('id_pegawai', $this->session->userdata('id'))
            ->order_by('id', 'DESC')
            ->limit($limit, $start)
            ->get('notifpegawai');
        return $q1;
    }

    // Get News Data For News List In Jquery Call
    public function newsScroll($limit, $start)
    {
        $q1 = $this->db
            ->select('catberita.nama_cat,
                              berita.title,
                              berita.image,
                              berita.date,
                              berita.isi,
                              berita.id,
                              berita.view')
            ->join('catberita', 'catberita.id=berita.id_cat')
            ->order_by('berita.id', 'desc')
            ->limit($limit, $start)
            ->get('berita');
        return $q1;
    }

    // Get Attendance Reports For Seacrh From Date To Date
    public function laporanAbsensi($cari)
    {
        $query = $this->db->query("SELECT * FROM mdh_absensi 
                                    WHERE id_pegawai='" . $this->session->userdata('id') . "'
                                    AND date BETWEEN '" . $cari['awal'] . "' AND '" . $cari['akhir'] . "'")->result();
        return $query;
    }

    // Get Leave Reports For Seacrh From Date To Date
    public function laporanCuti($cari)
    {
        $query = $this->db->query("SELECT 
                            mdh_typecuti.nama_type, 
                            mdh_cuti.alasan, 
                            mdh_cuti.id, 
                            mdh_cuti.tanggal_cuti, 
                            mdh_cuti.sampai_tanggal,
                            mdh_cuti.tanggal_izin,
                            mdh_cuti.isi,
                            mdh_cuti.status
                            FROM mdh_cuti 
                            JOIN mdh_typecuti ON mdh_typecuti.id=mdh_cuti.id_type 
                            WHERE mdh_cuti.id_pegawai = '1' 
                            AND tanggal_cuti BETWEEN '" . $cari['awal'] . "' AND '" . $cari['akhir'] . "'")->result();
        return $query;
    }

    // Get Task Reports For Seacrh From Date To Date
    public function laporanTugas($cari)
    {
        $query = $this->db->query("SELECT * FROM mdh_tugas WHERE id_pegawai = '1' 
                                AND tanggal_buat BETWEEN '" . $cari['awal'] . "' 
                                AND '" . $cari['akhir'] . "'")->result();
        return $query;
    }

    // Get Overtime Data For Jquery Scroll 
    public function scrollOvertime($limit, $start)
    {
        $q1 = $this->db
            ->order_by('id', 'DESC')
            ->where('id_pegawai', $this->session->userdata('id'))
            ->limit($limit, $start)
            ->get('lembur');
        return $q1;
    }

    // Get Salary Data For Jquery Scroll 
    public function scrollSalary($limit, $start)
    {
        $q1 = $this->db
            ->where('id_pegawai', $this->session->userdata('id'))
            ->order_by('id', 'DESC')
            ->limit($limit, $start)
            ->get('gaji');
        return $q1;
    }
}
