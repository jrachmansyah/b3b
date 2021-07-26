<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobilelib
{

    protected $_mdh;

    // Construct for mobile library
    public function __construct()
    {
        $this->_mdh     = get_instance();
    }

    // Theme Function for includes header and footer automatic
    public function theme($theme, $data)
    {

        // Checkin Session
        // Checkin Employee Session
        if ($this->_mdh->session->userdata('id') == null) {
            return redirect('mobile/login');
        } else {

            $iam             = $this->_mdh->db
                ->where('id', $this->_mdh->session->userdata('id'))
                ->get('pegawai')->row();

            if ($iam->status == 2) {
                session_destroy();
                $this->_mdh->session->set_flashdata('flash', 'Sorry, Your Account In Banned, contact your head office for this problem');
                return redirect('mobile/login');
            } else {
                $data['me']     = $this->_mdh->db
                    ->where('id', $this->_mdh->session->userdata('id'))
                    ->get('pegawai')->row();
            }
        }

        // Checkin User Agent
        // Checkin User Agent Mobile Or Computer Open
        if ($this->_mdh->agent->is_mobile() == false) {
            return redirect('scan');
        }

        $data['sett']       = $this->_mdh->db
            ->join('mobile', 'mobile.status=pengaturan.status')
            ->join('attendance', 'attendance.status=pengaturan.status')
            ->join('payroll', 'payroll.status=pengaturan.status')
            ->get('pengaturan')->row();
        $this->_mdh->load->view('mobile/fungsi/header.mdh.php', $data);
        $this->_mdh->load->view($theme, $data);
        $this->_mdh->load->view('mobile/fungsi/footer.mdh.php', $data);
    }
}
