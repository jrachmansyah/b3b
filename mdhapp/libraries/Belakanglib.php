<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belakanglib
{

    protected $_mdh;

    // Construct For Admin Panel Library
    public function __construct()
    {
        $this->_mdh     = get_instance();
    }

    // Theme Library
    // This Library for includes header and footer admin panel automatic.
    public function theme($theme, $data)
    {
        // Checkin Session
        // Check Condition Admin session
        if ($this->_mdh->session->userdata('id_adm') == null) {
            return redirect('/');
        } else {
            $data['me']     = $this->_mdh->db
                ->where('id', $this->_mdh->session->userdata('id_adm'))
                ->get('admin')->row();
        }
        // Sett Variabel for defaulth data sett
        $data['sett']       = $this->_mdh->db
            ->join('mobile', 'mobile.status=pengaturan.status')
            ->join('attendance', 'attendance.status=pengaturan.status')
            ->join('payroll', 'payroll.status=pengaturan.status')
            ->get('pengaturan')->row();
        $this->_mdh->load->model('Belakang_m');
        $data['mdhatt']     = $this->_mdh->Belakang_m->todayAttendance();
        $data['notif']      = $this->_mdh->db->where('status', '0')->order_by('id', 'DESC')->limit(6)->get('notifadm')->result();
        $data['notifall']   = $this->_mdh->db->where('status', '0')->get('notifadm')->result();
        $this->_mdh->load->view('backend/fungsi/header.mdh.php', $data);
        $this->_mdh->load->view($theme, $data);
        $this->_mdh->load->view('backend/fungsi/footer.mdh.php', $data);
    }
}
