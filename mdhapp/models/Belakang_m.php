<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belakang_m extends CI_Model
{

     // Check Admin Login Condition in query
    public function checkLog($data)
    {
        $data = $this->db->where('email', $data['email'])
            ->where('password', $data['password'])
            ->get('admin');
        return $data;
    }

    // Get Today Attendance for admin panel
    public function todayAttendance()
    {
        $query = $this->db
            ->join('pegawai', 'pegawai.id=absensi.id_pegawai')
            ->select('
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            absensi.image_masuk,
                            absensi.id,
                            absensi.date,
                            absensi.jam_masuk
                        ')
            ->where('absensi.date', date('Y-m-d'))
            ->get('absensi')->result();
        return $query;
    }

    // Count of attendance in today attendance
    public function countAttendance($date, $id)
    {
        $query = $this->db->query("SELECT count(id) as total FROM mdh_absensi 
        WHERE left(date,7)='" . $date . "' 
        AND id_pegawai='" . $id . "'
        GROUP BY id_pegawai")->row();
        return $query;
    }


    // Count of Hours Works Time for Slip Salary
    public function countHours($date, $id)
    {
        $query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`total_kerja`)) ) as hours FROM `mdh_absensi`
        WHERE left(date,7)='" . $date . "' 
        AND id_pegawai='" . $id . "'
        GROUP BY id_pegawai")->row();
        return $query;
    }

    // Count Overtime Work Hours Time For Slip Salary
    public function countLembur($date, $id)
    {
        $query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`jumlah_jam`)) ) as hours FROM `mdh_lembur`
        WHERE left(date,7)='" . $date . "' 
        AND id_pegawai='" . $id . "'
        GROUP BY id_pegawai")->row();
        return $query;
    }

    // Realtime Hours Work Attendance
    public function realtimeHours($id)
    {
        $query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`total_kerja`)) ) as hours FROM `mdh_absensi`
        WHERE id_pegawai='" . $id . "'
        GROUP BY id_pegawai");
        return $query;
    }

    // Realtime Hours work  Overtime
    public function realtimeOvertime($id)
    {
        $query = $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`jumlah_jam`)) ) as hours FROM `mdh_lembur`
        WHERE id_pegawai='" . $id . "'
        GROUP BY id_pegawai");
        return $query;
    }

    // Get Total Employee Salary Benefit for Admin Dashboard
    public function benefitSalary()
    {
        $query = $this->db->query("SELECT SUM(besar_gaji) AS jumlah FROM mdh_pegawai")->result();
        return $query;
    }

    // Get Attendance Analytic For Admin Dashboard
    public function analyticAttendance()
    {
        $query = $this->db->query("SELECT COUNT(id) AS total, date FROM mdh_absensi
        GROUP BY date 
        ORDER BY id DESC
        LIMIT 8")->result();
        return $query;
    }


    // Get New Raimburse For Admin Dashboard
    public function rembesDashboard()
    {
        $query = $this->db
            ->select('
                        pegawai.nama_awal,
                        pegawai.nama_akhir,
                        rembes.tanggal_diminta,
                        rembes.nominal_diminta,
                        rembes.title
                    ')
            ->join('pegawai', 'pegawai.id=rembes.id_pegawai')
            ->order_by('rembes.id', 'DESC')
            ->limit(5)
            ->get('rembes')->result();
        return $query;
    }

    // Get New Leave For Admin Dashboard
    public function leaveDashboard()
    {
        $query = $this->db
            ->select('
                        pegawai.nama_awal,
                        pegawai.nama_akhir,
                        typecuti.nama_type,
                        cuti.tanggal_cuti,
                        cuti.sampai_tanggal,
                    ')
            ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
            ->join('typecuti', 'typecuti.id=cuti.id_type')
            ->order_by('cuti.id', 'desc')
            ->limit(5)
            ->get('cuti')->result();
        return $query;
    }
}
