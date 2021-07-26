<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Library
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('Mobilelib');
        $this->load->library('User_agent');

        //Model
        $this->load->model('Mobile_m');

        // Defaulth Timezone
        $timezone = $this->db->get('pengaturan')->row();
        date_default_timezone_set($timezone->timezone);
    }

    /* ======================== Welcome Function  ====================== */

    public function index()
    {
        $data['page']       = "Welcome";
        $data['sett']       = $this->db
            ->join('mobile', 'mobile.status=pengaturan.status')
            ->join('attendance', 'attendance.status=pengaturan.status')
            ->join('payroll', 'payroll.status=pengaturan.status')
            ->get('pengaturan')->row();
        $this->load->view('mobile/index.mdh.php', $data);
    }

    /* ======================== Scan Function ====================== */

    // the scan function only runs when it is opened on the computer

    public function scan()
    {
        // Condition for check user agent, computer or mobile
        if ($this->agent->is_mobile() == true) {
            return redirect('/mobile');
        }
        $data['page']       = "Scan Mobile System";
        $data['sett']       = $this->db
            ->join('mobile', 'mobile.status=pengaturan.status')
            ->join('attendance', 'attendance.status=pengaturan.status')
            ->join('payroll', 'payroll.status=pengaturan.status')
            ->get('pengaturan')->row();
        return $this->load->view('scan.mdh.php', $data);
    }

    /* ======================== Welcome Carousel Function ====================== */

    public function welcome()
    {
        $data['page']       = "Welcome";
        $data['sett']      = $this->db
            ->join('mobile', 'mobile.status=pengaturan.status')
            ->join('attendance', 'attendance.status=pengaturan.status')
            ->join('payroll', 'payroll.status=pengaturan.status')
            ->get('pengaturan')->row();
        $this->load->view('mobile/welcome.mdh.php', $data);
    }

    /* ======================== Login Function ====================== */

    public function login()
    {
        // whether the session is checked or not
        if ($this->session->userdata('id') != null) {
            return redirect('mobile/dashboard');
        }
        // Validation for Mobile Login
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Condition for appear login page
        if ($this->form_validation->run() == false) {
            $data['page']       = "Employee Login";
            $data['sett']       = $this->db
                ->join('mobile', 'mobile.status=pengaturan.status')
                ->join('attendance', 'attendance.status=pengaturan.status')
                ->join('payroll', 'payroll.status=pengaturan.status')
                ->get('pengaturan')->row();
            $this->load->view('mobile/login.mdh.php', $data);
        } else {

            // Condition for login check
            $data['email']      = $this->input->post('email', true);
            $data['password']   = sha1($this->input->post('password', true));
            $check = $this->db->where('email', $data['email'])
                ->where('password', $data['password'])
                ->get('pegawai');
            if (count($check->result() == 1)) {
                foreach ($check->result() as $mdh) {
                    // variabel for insert session
                    $akun['log']        = "Atos Login Bager";
                    $akun['id']         = $mdh->id;
                    $akun['status']     = $mdh->status;
                    // function for insert session
                    $this->session->set_userdata($akun);
                }

                // redirecting
                if ($this->session->userdata('status') == 2) {
                    $this->session->set_flashdata('flash', 'This Account In Banned, Contact Your Head Office for This Problem');
                    return redirect('mobile/login');
                } else {
                    return redirect('mobile/dashboard');
                }
            } else {
                $this->session->set_flashdata('flash', 'Your Account Not Valid');
                return redirect('mobile/login');
            }
        }
    }

    /* ======================== Dashboard Function ====================== */

    function dashboard()
    {
        $data['page']       = "Employee Dashboard";
        $data['sett']       = $this->db
            ->join('mobile', 'mobile.status=pengaturan.status')
            ->join('attendance', 'attendance.status=pengaturan.status')
            ->join('payroll', 'payroll.status=pengaturan.status')
            ->get('pengaturan')->row();
        $data['slid']       = $this->db->get('slider')->result();
        $data['notice']     = $this->db
            ->select('typepengumuman.nama_type,pengumuman.title,pengumuman.tanggal,pengumuman.image,pengumuman.id')
            ->join('typepengumuman', 'typepengumuman.id=pengumuman.id_type')
            ->order_by('pengumuman.id', 'DESC')
            ->limit(5)
            ->get('pengumuman')->result();
        $data['news']       = $this->db
            ->select('catberita.nama_cat,
                          berita.title,
                          berita.image,
                          berita.date,
                          berita.isi,
                          berita.id,
                          berita.view')
            ->join('catberita', 'catberita.id=berita.id_cat')
            ->order_by('berita.id', 'desc')
            ->limit(5)
            ->get('berita')->result();
        $this->mobilelib->theme('mobile/page/index.mdh.php', $data);
    }

    /* ======================== Leave Function ====================== */

    function leave($param1 = '', $param2 = '')
    {

        // Leave List Parameter
        if ($param1 == 'list') {
            $this->form_validation->set_rules('id_type', 'Type Name', 'required');
            $this->form_validation->set_rules('alasan', 'Reason', 'required');
            $this->form_validation->set_rules('tanggal_cuti', 'Start Date', 'required');
            $this->form_validation->set_rules('sampai_tanggal', 'End Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Leave";
                $data['type']       = $this->db->get('typecuti')->result();

                // Get Leave Approval Query
                $data['approve']    = $this->db
                    ->select('typecuti.nama_type, 
                              cuti.alasan,cuti.id, 
                              cuti.tanggal_cuti,
                              cuti.sampai_tanggal, 
                              cuti.tanggal_izin')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.status', '1')
                    ->where('cuti.id_pegawai', $this->session->userdata('id'))
                    ->order_by('cuti.id', 'desc')
                    ->get('cuti')
                    ->result();

                // Get Leave Pending Query
                $data['pending']    = $this->db
                    ->select('typecuti.nama_type, 
                              cuti.alasan,cuti.id, 
                              cuti.tanggal_cuti,
                              cuti.sampai_tanggal, 
                              cuti.tanggal_izin')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.status', '0')
                    ->where('cuti.id_pegawai', $this->session->userdata('id'))
                    ->order_by('cuti.id', 'desc')
                    ->get('cuti')
                    ->result();

                // Get All Leave Data Query
                $data['all']        = $this->db
                    ->select('typecuti.nama_type, 
                              cuti.alasan,cuti.id, 
                              cuti.tanggal_cuti,
                              cuti.sampai_tanggal,
                              cuti.isi, 
                              cuti.status,
                              cuti.tanggal_izin')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.status', '0')
                    ->where('cuti.id_pegawai', $this->session->userdata('id'))
                    ->order_by('cuti.id', 'desc')
                    ->get('cuti')
                    ->result();
                return $this->mobilelib->theme('mobile/leave/index.mdh.php', $data);

                // Condition for insert new leave
            } else {

                // Insert New Leave
                $data['id_pegawai']         = $this->session->userdata('id');
                $data['id_type']            = $this->input->post('id_type', true);
                $data['alasan']             = $this->input->post('alasan', true);
                $data['tanggal_cuti']       = $this->input->post('tanggal_cuti', true);
                $data['sampai_tanggal']     = $this->input->post('sampai_tanggal', true);
                $data['isi']                = $this->input->post('isi', true);
                $data['tanggal_izin']       = date('Y-m-d');
                $insert = $this->db->insert('cuti', $data);
                // Insert Leave End


                // Insert Admin Notif
                $detail = $this->db->where('id', $this->session->userdata('id'))->get('pegawai')->row();
                $notif['id_pegawai']        = $this->session->userdata('id');
                $notif['title']             = 'request for leave from';
                $notif['isi']               = 'request for leave from ' . $detail->nama_awal . ' ' . $detail->nama_akhir
                    . ' From date ' . $data['tanggal_cuti'] . ' To Date ' . $data['sampai_tanggal'] . ' waiting Admin Approval';
                $notif['tanggal_notifikasi'] = date('Y-m-d');
                $this->db->insert('notifadm', $notif);
                // Insert Admin Notif End

                $this->session->set_flashdata('flash', 'leave request sent successfully');
                return redirect('leave/list');
            }
        }
    }

    /* ======================== Task Function ====================== */

    function task($param1 = '', $param2 = '', $param3 = '')
    {

        // List Task Parameter
        if ($param1 == 'list') {
            $this->form_validation->set_rules('title', 'Task Name', 'required');
            $this->form_validation->set_rules('isi', 'Task Detail', 'required');

            // condition for appear task page
            if ($this->form_validation->run() == false) {
                $data['page']           = "My Task";

                // Get Done Task Query
                $data['done']           = $this->db
                    ->where('status_selesai', '1')
                    ->where('id_pegawai', $this->session->userdata('id'))
                    ->order_by('id', 'DESC')
                    ->get('tugas')->result();

                // Get Pogress Task Query
                $data['prog']           = $this->db
                    ->where('status_selesai', '2')
                    ->where('id_pegawai', $this->session->userdata('id'))
                    ->order_by('id', 'DESC')
                    ->get('tugas')->result();

                // Get Pending Task Query
                $data['pending']        = $this->db
                    ->where('status_selesai', '0')
                    ->where('id_pegawai', $this->session->userdata('id'))
                    ->order_by('id', 'DESC')
                    ->get('tugas')
                    ->result();

                // Get All Task Data Query
                $data['all']            = $this->db
                    ->where('id_pegawai', $this->session->userdata('id'))
                    ->get('tugas')->result();
                return $this->mobilelib->theme('mobile/task/list.mdh.php', $data);

                // Condition for insert new task
            } else {

                // Insert New Task
                $data['title']           = $this->input->post('title', true);
                $data['id_pegawai']           = $this->session->userdata('id');
                $data['tanggal_buat']           = date('Y-m-d');
                $data['tanggal_progress']           = $this->input->post('tanggal_progress', true);
                $data['deadline']           = $this->input->post('deadline', true);
                $data['isi']                = $this->input->post('isi');

                $mdh['upload_path']        = './mdhdesign/uploads/task/';
                $mdh['allowed_types']      = 'png|jpg|jpeg|docx|ppt|csv|xls|txt|pdf';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'task-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);
                if (!empty($_FILES['file']['name'])) {
                    if ($this->upload->do_upload('file')) {
                        $image = $this->upload->data();

                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['file']      = $image['file_name'];
                    }
                }
                $this->db->insert('tugas', $data);
                // Insert new task end

                $this->session->set_flashdata('flash', 'Task Created Success');
                return redirect('task/list');
            }
        }

        // Detail Task Parameter
        if ($param1 == 'detail') {
            $data['page']           = "Task Detail";
            $data['de']             = $this->db
                ->where('id', $param2)
                ->get('tugas')->row();
            $data['plist']          = $this->db->where('id_tugas', $param2)->order_by('id', 'DESC')->get('progress')->result();
            $data['persentase']     = $this->db->query("SELECT sum(persentase) as total FROM mdh_progress WHERE id_tugas='" . $param2 . "' GROUP BY id_tugas ")->row();
            return $this->mobilelib->theme('mobile/task/detail.mdh.php', $data);
        }


        // Add Task Progress Parameter
        if ($param1 == 'addProgress') {
            $this->form_validation->set_rules('nama_progress', 'Progress Name', 'required');
            $this->form_validation->set_rules('progress_isi', 'Detail Progress', 'required');
            $this->form_validation->set_rules('persentase', 'Persentase', 'required');

            // Condition for false and redirect
            if ($this->form_validation->run() == false) {
                return redirect($_SERVER['HTTP_REFERER']);
            } else {

                // Codition for new insert progress
                $data['id_tugas']       = $this->input->post('id_tugas');
                $data['nama_progress']  = $this->input->post('nama_progress');
                $data['progress_isi']   = $this->input->post('progress_isi');
                $data['persentase']     = $this->input->post('persentase');
                $data['date']           = date('Y-m-d');
                $this->db->insert('progress', $data);
                // Insert New Task End

                // Update Status Task, Pending to progress status
                $update['status_selesai']       = '2';
                $this->db->where('id', $data['id_tugas'])->update('tugas', $update);
                // Update Task End

                $this->session->set_flashdata('flash', 'Progress Has been added');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Update Task Parameter
        if ($param1 == 'edit') {

            // Form Validation for form update
            $this->form_validation->set_rules('title', 'Task Name', 'required');
            $this->form_validation->set_rules('isi', 'Task Detail', 'required');

            // Condition for form validatation false
            if ($this->form_validation->run() == false) {
                return redirect($_SERVER['HTTP_REFERER']);
            } else {

                // update task start
                $data['title']           = $this->input->post('title', true);
                $data['id_pegawai']           = $this->session->userdata('id');
                $data['tanggal_buat']           = date('Y-m-d');
                $data['tanggal_progress']           = $this->input->post('tanggal_progress', true);
                $data['deadline']           = $this->input->post('deadline', true);
                $data['isi']                = $this->input->post('isi');

                $mdh['upload_path']        = './mdhdesign/uploads/task/';
                $mdh['allowed_types']      = 'png|jpg|jpeg|docx|ppt|csv|xls|txt|pdf';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'task-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['file']['name'])) {
                    if ($this->upload->do_upload('file')) {
                        $image = $this->upload->data();
                        $q1 = $this->db->where('id', $this->input->post('id'))->get('tugas')->row();
                        if ($q1->file != null) {
                            $target = $mdh['upload_path'] . '/' . $q1->file;
                            unlink($target);
                        }
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['file']      = $image['file_name'];
                    }
                }
                $this->db->where('id', $this->input->post('id'))->update('tugas', $data);
                // Update Task End

                $this->session->set_flashdata('flash', 'Task Updated Success');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Change Status From Progress or Pending To Done Task Parameter
        if ($param1 == 'done') {

            // Update Status Start
            $data['status_selesai']     = '1';
            $data['tanggal_selesai']    = date('Y-m-d');
            $this->db->where('id', $this->input->post('id_tugas'))->update('tugas', $data);
            // Update Status End

            $this->session->set_flashdata('flash', 'Your Task Has been cleared');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /* ======================== Raimburse Function ====================== */

    function raimbes($param1 = '', $param2 = '', $param3 = '')
    {
        // List Raimburse Parameter
        if ($param1 == 'list') {
            $this->form_validation->set_rules('title', 'Raimbes Name', 'required');
            $this->form_validation->set_rules('alasan_rembes', 'Raimbes detail', 'required');
            $this->form_validation->set_rules('nominal_diminta', 'Nominal', 'required');

            // Condition for appear page
            if ($this->form_validation->run() == false) {
                $data['page']       = "Raimbes";
                $data['q1']         = $this->db->where('status_rembes', '0')->order_by('id', 'DESC')->get('rembes')->result();
                $data['q2']         = $this->db->where('status_rembes', '1')->order_by('id', 'DESC')->get('rembes')->result();
                return $this->mobilelib->theme('mobile/rembes/list.mdh.php', $data);
            } else {
                // Condition for insert new raimburse parameter
                $data['title']           = $this->input->post('title', true);
                $data['id_pegawai']           = $this->session->userdata('id');
                $data['tanggal_diminta']           = date('Y-m-d');
                $data['alasan_rembes']                = $this->input->post('alasan_rembes');
                $data['nominal_diminta']                = $this->input->post('nominal_diminta');
                $mdh['upload_path']        = './mdhdesign/uploads/rembes/';
                $mdh['allowed_types']      = 'png|jpg|jpeg|docx|ppt|csv|xls|txt|pdf';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'raimbes-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['file_rembes']['name'])) {
                    if ($this->upload->do_upload('file_rembes')) {
                        $image = $this->upload->data();

                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['file_rembes']      = $image['file_name'];
                    }
                }
                $this->db->insert('rembes', $data);
                // Insert Raimburse End

                // New Notif Admin Start
                $detail = $this->db->where('id', $this->session->userdata('id'))->get('pegawai')->row();
                $notif['id_pegawai']        = $this->session->userdata('id');
                $notif['title']             = 'Raimbes Request';
                $notif['isi']               = 'Raimbes From ' . $detail->nama_awal . ' ' . $detail->nama_akhir
                    . ' Waiting Your Approval';
                $notif['tanggal_notifikasi'] = date('Y-m-d');
                $this->db->insert('notifadm', $notif);
                // New Notif Insert End

                $this->session->set_flashdata('flash', 'Raimbes Created Success');
                return redirect('raimbes/list');
            }
        }

        // Detail Raimburse Parameter
        if ($param1 == 'detail') {
            $data['page']           = "Detail Raimbes";
            $data['de']             = $this->db->where('id', $param2)->get('rembes')->row();
            $data['reply']          = $this->db->where('id_rembes', $param2)->order_by('id', 'DESC')->get('rerembes')->result();
            return $this->mobilelib->theme('mobile/rembes/detail.mdh.php', $data);
        }
    }

    /* ======================== Profile Account Function ====================== */

    function account($param1 = '', $param2 = '')
    {
        // Profile Appear Page Parameter
        if ($param1 == 'index') {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == false) {

                // Condition for appear Profile page
                $data['page']       = "My Account";
                return $this->mobilelib->theme('mobile/page/akun.mdh.php', $data);
            } else {

                // Condition for update or change  profile photo start
                $data['email']           = $this->input->post('email', true);
                $data['password']        = sha1($this->input->post('password', true));

                $mdh['upload_path']        = './mdhdesign/uploads/pegawai/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'pegawai-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['photo']['name'])) {
                    if ($this->upload->do_upload('photo')) {
                        $image = $this->upload->data();

                        $check = $this->db->where('id', $this->session->userdata('id'))->get('pegawai')->row();
                        if ($check->photo != null) {
                            $target = $mdh['upload_path'] . '/' . $check->photo;
                            unlink($target);
                        }
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['photo']      = $image['file_name'];
                    }
                }
                $this->db->where('id', $this->session->userdata('id'))->update('pegawai', $data);
                // Update End

                $this->session->set_flashdata('flash', 'Account Info Has Updated');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Update General Info Parameter
        if ($param1 == 'general') {

            // Validation for update general info
            $this->form_validation->set_rules('nama_awal', 'First Name', 'required');
            $this->form_validation->set_rules('nama_akhir', 'Last Nane', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('jk', 'Gender', 'required');
            $this->form_validation->set_rules('ponsel', 'Phone', 'required');

            // False Condition 
            if ($this->form_validation->run() == false) {
                return redirect($_SERVER['HTTP_REFERER']);
            } else {

                // Update General Info Begin
                $data['nama_awal']              = $this->input->post('nama_awal', true);
                $data['nama_akhir']             = $this->input->post('nama_akhir', true);
                $data['username']               = $this->input->post('username', true);
                $data['jk']                     = $this->input->post('jk', true);
                $data['ponsel']                 = $this->input->post('ponsel', true);
                $data['ttl']                    = $this->input->post('ttl', true);
                $data['deskripsi_pegawai']      = $this->input->post('deskripsi_pegawai', true);
                $data['pengalaman']             = $this->input->post('pengalaman', true);
                $this->db->where('id', $this->session->userdata('id'))->update('pegawai', $data);
                // Update General Info End

                $this->session->set_flashdata('flash', 'General Info Has Updated');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Update Bank Info Parameter
        if ($param1 == 'bank') {
            // Validation for bank info update
            $this->form_validation->set_rules('atas_nama', 'Bank name', 'required');
            $this->form_validation->set_rules('nomor_rek', 'Bank Account', 'required');
            if ($this->form_validation->run() == false) {
                return redirect($_SERVER['HTTP_REFERER']);
            } else {
                // Update Bank Info Begin
                $data['atas_nama']      = $this->input->post('atas_nama', true);
                $data['nomor_rek']      = $this->input->post('nomor_rek', true);
                $this->db->where('id', $this->session->userdata('id'))->update('pegawai', $data);
                // Update Bank Info End

                $this->session->set_flashdata('flash', 'Bank Info Has Updated');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Social Media Info Parameter
        if ($param1 == 'sosmed') {

            // Validation for social media
            $this->form_validation->set_rules('fb', 'Facebook Link', 'required');
            if ($this->form_validation->run() == false) {
                return redirect($_SERVER['HTTP_REFERER']);
            } else {

                // Update Social Media Info Begin
                $data['fb']                         = $this->input->post('fb', true);
                $data['ig']                         = $this->input->post('ig', true);
                $data['tw']                         = $this->input->post('tw', true);
                $this->db->where('id', $this->session->userdata('id'))->update('pegawai', $data);
                // Social Media Update End

                $this->session->set_flashdata('flash', 'Social Media Has Updated');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    /* ======================== News Function ====================== */

    function news($param1 = '', $param2 = '', $param3 = '')
    {
        // News List Appear Parameter
        if ($param1 == 'list') {
            $data['page']       = "News List";
            return $this->mobilelib->theme('mobile/news/list.mdh.php', $data);
        }

        // News Scroll Data Parameter for Jquery Call
        if ($param1 == 'scroll') {
            $output = '';
            $data = $this->Mobile_m->newsScroll($this->input->post('limit'), $this->input->post('start')); // get news data
            if ($data->num_rows() > 0) { // check news data
                foreach ($data->result() as $row) { // looping for news data
                    $output .= '
                    <div class="post-item">
                        <div class="post-asset image">
                            <img src="' . base_url() . 'mdhdesign/uploads/berita/' . $row->image . '" alt="' . $row->title . '">
                        </div>
                        <div class="post-header">
                            <h3 class="post-title"><a href="' . base_url('news/detail/' . $row->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $row->title))) . '" data-loader="show">' . $row->title . '</a></h3>
                            <p class="post-description">' . substr($row->isi, 0, 300) . '</p>
                            <span class="post-category badge badge-primary"><i class="fa fa-th-large"></i> ' . $row->nama_cat . '</span>
                            <span class="post-date"><i class="fa fa-clock-o"></i>' . $row->date . '</span>
                        </div>
                        <div class="post-footer">
                            <a href="' . base_url('news/detail/' . $row->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $row->title))) . '" class="post-author">
                                <span class="author-name "><b>Detail News</b></span>
                            </a>
                        </div>
                    </div>
                    <div class="form-mini-divider"></div>
				';
                }
            }
            echo $output;
        }

        // News Detail Parameter
        if ($param1 == 'detail') {
            $data['page']       = "News Detail";
            // Query select for get news detail
            $data['mdh']        = $this->db
                ->select('
                                        catberita.nama_cat,
                                        berita.title,
                                        berita.image,
                                        berita.date,
                                        berita.isi,
                                        berita.id,
                                        berita.view')
                ->join('catberita', 'catberita.id=berita.id_cat')
                ->where('berita.id', $param2)
                ->get('berita')->row();
            return $this->mobilelib->theme('mobile/news/detail.mdh.php', $data);
        }
    }

    /* ======================== Notice Function ====================== */

    function notice($param1 = '', $param2 = '', $param3 = '')
    {

        // Notice List Data Parameter
        if ($param1 == 'list') {
            $data['page']       = "Notice List";
            return $this->mobilelib->theme('mobile/notice/list.mdh.php', $data);
        }

        // Notice Detail Parameter
        if ($param1 == 'detail') {
            $data['page']       = "Notice Detail";
            $data['mdh']        = $this->db
                ->select('typepengumuman.nama_type,pengumuman.id,pengumuman.tanggal,pengumuman.image,pengumuman.isi,pengumuman.title')
                ->join('typepengumuman', 'typepengumuman.id=pengumuman.id_type')
                ->where('pengumuman.id', $param2)
                ->get('pengumuman')->row();
            return $this->mobilelib->theme('mobile/notice/detail.mdh.php', $data);
        }

        // Notice Data Scroll Parameter for Jquery Call
        if ($param1 == 'scroll') {
            $output = '';
            $data = $this->Mobile_m->scrolNotice($this->input->post('limit'), $this->input->post('start'));
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $row) {
                    $output .= '
                    <div class="product-item v2 mb-15 mr-2">
                    <a href="' . base_url('notice/detail/' . $row->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $row->title))) . '" data-loader="show">
                        <img class="product-image" alt="" src="' . base_url() . 'mdhdesign/uploads/notice/' . $row->image . '">
                        <h2 class="product-title">' . $row->title . '</h2>
                        <span class="product-info">
                            <span class=" badge badge-sm badge-primary">' . $row->nama_type . '</span>
                            <span class="cart-btn"><i class="fa fa-eye"></i></span>
                        </span>
                    </a>
                </div>
				';
                }
            }
            echo $output;
        }
    }

    /* ======================== Award Function ====================== */

    function award($param1 = '', $param2 = '', $param3 = '')
    {
        // Award List Parameter

        if ($param1 == 'list') {
            $data['page']       = "Award List";
            return $this->mobilelib->theme('mobile/reward/list.mdh.php', $data);
        }

        // Detail Reward Parameter
        if ($param1 == 'detail') {
            $data['page']       = "Award Detail";
            $data['mdh']        = $this->db
                ->select('typereward.nama_type,reward.id,reward.tanggal,reward.image,reward.deskripsi,pegawai.nama_awal,pegawai.nama_akhir')
                ->join('typereward', 'typereward.id=reward.id_type')
                ->join('pegawai', 'pegawai.id=reward.id_pegawai')
                ->where('reward.id', $param2)
                ->get('reward')->row();
            return $this->mobilelib->theme('mobile/reward/detail.mdh.php', $data);
        }

        // Scroll And Get Reward Data for Jquery Call
        if ($param1 == 'scroll') {
            $output = '';
            $data = $this->Mobile_m->scrollAward($this->input->post('limit'), $this->input->post('start'));
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $r) {
                    $output .= '
                    <div class="news-list-item">
                <div class="list-image">
                    <img src="' . base_url() . 'mdhdesign/uploads/reward/' . $r->image . '" alt="" width="100" height="100">
                </div>
                <div class="list-content">
                    <h2 class="list-title" style="margin-bottom: -10px;">
                        <a href="' . base_url('award/detail/' . $r->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", substr($r->deskripsi, 0, 10)))) . '">' . $r->nama_type . ' </a>
                    </h2>
                    <p style="margin-bottom: -0.5px;">' . substr($r->deskripsi, 0, 70) . '</p>
                    <span class="list-time badge badge-primary" >' . $r->tanggal . '</span>
                </div>
            </div>
            <div class="form-mini-divider"></div>
				';
                }
            }
            echo $output;
        }
    }

    /* ======================== Notification Function ====================== */

    function notif($param1 = '', $param2 = '')
    {

        // List Notification parameter
        if ($param1 == 'list') {
            $data['page']       = "Notification";
            return $this->mobilelib->theme('mobile/notif/list.mdh.php', $data);
        }

        // Scroll Data for Jquery Data Call
        if ($param1 == 'scroll') {
            $output = '';
            $data = $this->Mobile_m->scrollNotif($this->input->post('limit'), $this->input->post('start'));
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $r) {
                    $output .= '
                    <div class="news-list-item">
                <div class="list-image">
                    <img  src="' . base_url() . 'mdhdesign/mobile/image/notif.png" alt="" width="80px">
                </div>
                <div class="list-content">
                    <h2 class="list-title" style="margin-bottom: -10px;">
                        <a href="' . base_url('notif/detail/' . $r->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", substr($r->title, 0, 10)))) . '">' . $r->title . ' </a>
                    </h2>
                    <p style="margin-bottom: -0.5px;">' . substr($r->isi, 0, 70) . '</p>
                    <span class="list-time badge badge-primary" >' . $r->tanggal . '</span>
                </div>
            </div>
            <div class="form-mini-divider"></div>
				';
                }
            }
            echo $output;
        }

        // Notification Detail Parameter
        if ($param1 == 'detail') {
            $data['page']       = "Detail Notification";
            $data['mdh']        = $this->db->where('id', $param2)->get('notifpegawai')->row();
            return $this->mobilelib->theme('mobile/notif/detail.mdh.php', $data);
        }
    }

    /* ======================== Overtime Function ====================== */

    function overtime($param1 = '', $param2 = '', $param3 = '')
    {

        // Overtime List Parameter

        if ($param1 == 'list') {
            $this->form_validation->set_rules('title', 'Overtime Title', 'required');
            $this->form_validation->set_rules('date', 'Overtime Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Overtime List";
                return $this->mobilelib->theme('mobile/overtime/list.mdh.php', $data);
            } else {
                $data['title']      = $this->input->post('title', true);
                $data['date']       = $this->input->post('date', true);
                $data['isi_lembur'] = $this->input->post('isi_lembur', true);
                $data['id_pegawai'] = $this->session->userdata('id');
                $this->db->insert('lembur', $data);
                $this->session->set_flashdata('flash', 'Overtime Has been Created');
                return redirect('overtime/list');
            }
        }

        // Overtime Scroll and Get data for Jquery Call Parameter
        if ($param1 == 'scroll') {
            $output = '';
            $data = $this->Mobile_m->scrollOvertime($this->input->post('limit'), $this->input->post('start'));
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $r) {
                    $output .= '
                    <div class="news-list-item">
                <div class="list-image">
                    <img  src="' . base_url() . 'mdhdesign/mobile/image/overtime.png" alt="" width="80px">
                </div>
                <div class="list-content">
                    <h2 class="list-title" style="margin-bottom: -10px;">
                        <a href="' . base_url('overtime/detail/' . $r->id) . '">' . $r->title . ' </a>
                    </h2>
                    <p style="margin-bottom: -0.5px;">' . $r->jam_mulai . ' - ' . $r->sampai_jam . '</p>
                    <span class="list-time badge badge-primary" >' . $r->date . '</span>
                </div>
            </div>
            <div class="form-mini-divider"></div>
				';
                }
            }
            echo $output;
        }



        // View Detail Overtime Parameter
        if ($param1 == 'view') {

            // Condition For Overtime Begin ( Start Time )
            if ($param2 == 'start') {
                $check = $this->db->where('id', $param3)->get('lembur')->row();
                if ($check->jam_mulai != null) {
                    $this->session->set_flashdata('gagal', 'Sorry, Time Settling has been done');
                    return redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $data['jam_mulai']  = date('h:i A');
                    $this->db->where('id', $param3)->update('lembur', $data);
                    return redirect($_SERVER['HTTP_REFERER']);
                }
            }

            // Condition For Overtime End ( End Time )
            if ($param2 == 'end') {
                $check = $this->db->where('id', $param3)->get('lembur')->row();
                if ($check->sampai_jam != null) {
                    $this->session->set_flashdata('gagal', 'Sorry, Time Settling has been done');
                    return redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $mulai  = date_create($check->jam_mulai)->diff(date_create(date('h:i A')))->format('%H:%i');
                    $data['jumlah_jam']     = $mulai;
                    $data['date_selesai']   = date('Y-m-d');
                    $data['sampai_jam']     = date('h:i A');
                    $this->db->where('id', $param3)->update('lembur', $data);
                    return redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }

        // Detail Overtime Parameter
        if ($param1 == 'detail') {
            $this->form_validation->set_rules('title', 'Name', 'required');
            $this->form_validation->set_rules('des', 'Description', 'required');

            // View Page Condition
            if ($this->form_validation->run() == false) {
                $data['page']           = "Overtime Detail";
                $data['mdh']            = $this->db
                    ->where('id', $param2)->get('lembur')->row();
                $data['activity']       = $this->db
                    ->where('id_lembur', $param2)
                    ->order_by('id', 'DESC')
                    ->get('isilembur')->result();
                return $this->mobilelib->theme('mobile/overtime/index.mdh.php', $data);
            } else if ($this->input->post('add') != null) {

                // Insert Overtime Activity Condition
                $data['title']          = $this->input->post('title', true);
                $data['des']            = $this->input->post('des', true);
                $data['time']           = date('h:i A');
                $data['date']           = date('Y-m-d');
                $data['id_lembur']      = $param2;
                $this->db->insert('isilembur', $data);
                // Insert Overtime Activity End

                $this->session->set_flashdata('flash', 'Success Created');
                return redirect($_SERVER['HTTP_REFERER']);
            } else if ($this->input->post('edit') != null) {

                // Update Activity Condition Parameter
                $data['title']          = $this->input->post('title', true);
                $data['des']            = $this->input->post('des', true);
                $this->db->where('id', $this->input->post('id'))->update('isilembur', $data);
                // Update End

                return redirect('HTTP_FERERER');
            }
        }
    }

    /* ======================== Attendance Function ====================== */

    function attendance($param1 = '', $param2 = '', $param3 = '')
    {

        // View Detail Parameter
        if ($param1 == 'view') {
            $data['page']       = "Attendance";
            $data['q1']         = $this->db->where('date', date('Y-m-d'))->where('id_pegawai', $this->session->userdata('id'))->get('absensi');
            $data['q2']         = $this->db->where('id_pegawai', $this->session->userdata('id'))->order_by('id', 'DESC')->get('absensi')->result();
            return $this->mobilelib->theme('mobile/absensi/view.mdh.php', $data);
        }

        // Checkin Start ( Start Time ) Parameter
        if ($param1 == 'checkin') {
            $data['date']           = date('Y-m-d');
            $data['id_pegawai']     = $this->session->userdata('id');
            $data['long_masuk']     = $this->input->post('long_masuk', true);
            $data['latitude_masuk'] = $this->input->post('latitude_masuk', true);
            $data['jam_masuk']     = $this->input->post('jam_masuk', true);
            define('UPLOAD_DIR', './mdhdesign/uploads/absensi/');
            $image_parts = explode(";base64,", $this->input->post('image_masuk'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $namaimage = 'absen-masuk-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
            $file = UPLOAD_DIR . $namaimage . '.jpeg';
            file_put_contents($file, $image_base64);
            $data['image_masuk']   = $file;

            $this->db->insert('absensi', $data);
            $this->session->set_flashdata('flash', 'Check-in Success');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Checkout Start ( End Time ) Parameter
        if ($param1 == 'checkout') {
            $data['long_keluar']     = $this->input->post('long_keluar', true);
            $data['latitude_keluar'] = $this->input->post('latitude_keluar', true);
            $data['jam_keluar']     = $this->input->post('jam_keluar', true);
            $data['total_kerja']    = $this->input->post('total_kerja', true);
            define('UPLOAD_DIR', './mdhdesign/uploads/absensi/');
            $image_parts = explode(";base64,", $this->input->post('image_keluar'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $namaimage = 'absen-keluar-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
            $file = UPLOAD_DIR . $namaimage . '.jpeg';
            file_put_contents($file, $image_base64);
            $data['image_keluar']   = $file;

            $this->db->where('date', date('Y-m-d'))->where('id_pegawai', $this->session->userdata('id'))->update('absensi', $data);
            $this->session->set_flashdata('flash', 'Check-out Success');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Maps Tracker Parameter
        if ($param1 == 'tracker') {
            $data['page']       = "Map Tracker";
            $data['absen']      = $this->db->where('id', $param2)->get('absensi')->row();
            return $this->mobilelib->theme('mobile/absensi/map.mdh.php', $data);
        }
    }

    /* ======================== Maps Function ====================== */

    function maps($param1 = '', $param2 = '')
    {
        if ($param1 == 'today') {
            $data['page']       = "Today Tracker";
            $data['q1']         = $this->db->where('date', date('Y-m-d'))->where('id_pegawai', $this->session->userdata('id'))->get('absensi');
            return $this->mobilelib->theme('mobile/map/today.mdh.php', $data);
        }
    }

    /* ======================== Salary Function ====================== */

    function salary($param1 = '', $param2 = '')
    {

        // Salary List Parameter
        if ($param1 == 'list') {
            $data['page']       = "Salary List";
            return $this->mobilelib->theme('mobile/salary/list.mdh.php', $data);
        }

        // Salary Scroll Parameter
        if ($param1 == 'scroll') {
            $output = '';
            $data = $this->Mobile_m->scrollSalary($this->input->post('limit'), $this->input->post('start'));
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $r) {
                    $output .= '
                    <div class="news-list-item">
                <div class="list-image">
                    <img  src="' . base_url() . 'mdhdesign/mobile/image/overtime.png" alt="" width="80px">
                </div>
                <div class="list-content">
                    <h2 class="list-title" style="margin-bottom: -10px;">
                        <a href="' . base_url('salary/detail/' . $r->id) . '"> Salary | ' . $r->tanggal_gaji . ' </a>
                    </h2>
                    <p style="margin-bottom: -0.5px;">' . $r->jam_dibuat . ' | ' . number_format($r->nominal_diberikan) . '</p>
                    <span class="list-time badge badge-primary" >' . $r->nomorik . '</span>
                </div>
            </div>
            <div class="form-mini-divider"></div>
				';
                }
            }
            echo $output;
        }


        // Salary Detail Parameter
        if ($param1 == 'detail') {
            $data['page']       = "Salary Detail";
            $data['mdhg']       = $this->db->where('id', $param2)->get('gaji')->row();
            $data['tunjangan']  = $this->db->get('tunjangan')->result();
            $data['potongan']   = $this->db->get('potongan')->result();
            return $this->mobilelib->theme('mobile/salary/detail.mdh.php', $data);
        }
    }

    /* ======================== More Page Function ====================== */

    function more($param1 = '', $param2 = '')
    {
        // Log
        // if ($param1 == 'log') {
        //     $data['page']       = "My Log";
        //     return $this->mobilelib->theme('mobile/page/log.mdh.php', $data);
        // }

        // Company Page Parameter
        if ($param1 == 'company') {
            $data['page']       = "About Company";
            $data['mdh']        = $this->db->get('company')->row();
            return $this->mobilelib->theme('mobile/page/company.mdh.php', $data);
        }

        if ($param1 == 'app') {
            $data['page']       = "About App";
            return $this->mobilelib->theme('mobile/page/app.mdh.php', $data);
        }
    }

    /* ======================== Reports Function ====================== */

    function laporan($param1 = '', $param2 = '')
    {

        // Attendance Reports
        if ($param1 == 'absensi') {
            $this->form_validation->set_rules('awal', 'First Date', 'required');
            $this->form_validation->set_rules('akhir', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Attendance Reports";
                $data['mdh']    = $this->db
                    ->where('id_pegawai', $this->session->userdata('id'))
                    ->order_by('id', 'desc')
                    ->limit(10)
                    ->get('absensi')->result();
                return $this->mobilelib->theme('mobile/laporan/absensi.mdh.php', $data);
            } else {
                $data['page']   = "Attendance Reports";
                $cari['awal']   = $this->input->post('awal', true);
                $cari['akhir']  = $this->input->post('akhir', true);
                $data['mdh']    = $this->Mobile_m->laporanAbsensi($cari);
                return $this->mobilelib->theme('mobile/laporan/absensi.mdh.php', $data);
            }
        }

        // Leave Reports
        if ($param1 == 'cuti') {
            $this->form_validation->set_rules('awal', 'First Date', 'required');
            $this->form_validation->set_rules('akhir', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Leave Reports";
                $data['mdh']    = $this->db
                    ->select('typecuti.nama_type, 
                          cuti.alasan,cuti.id, 
                          cuti.tanggal_cuti,
                          cuti.sampai_tanggal, 
                          cuti.isi,
                          cuti.status,
                          cuti.tanggal_izin')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.id_pegawai', $this->session->userdata('id'))
                    ->order_by('cuti.id', 'desc')
                    ->limit(10)
                    ->get('cuti')
                    ->result();
                return $this->mobilelib->theme('mobile/laporan/cuti.mdh.php', $data);
            } else {
                $data['page']   = "Leave Reports";
                $cari['awal']   = $this->input->post('awal', true);
                $cari['akhir']  = $this->input->post('akhir', true);
                $data['mdh']    = $this->Mobile_m->laporanCuti($cari);
                return $this->mobilelib->theme('mobile/laporan/cuti.mdh.php', $data);
            }
        }

        // Task Reports
        if ($param1 == 'tugas') {
            $this->form_validation->set_rules('awal', 'First Date', 'required');
            $this->form_validation->set_rules('akhir', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Task Reports";
                $data['mdh']    = $this->db
                    ->where('id_pegawai', $this->session->userdata('id'))
                    ->order_by('id', 'DESC')
                    ->limit(10)
                    ->get('tugas')->result();
                return $this->mobilelib->theme('mobile/laporan/tugas.mdh.php', $data);
            } else {
                $data['page']   = "Task Reports";
                $cari['awal']   = $this->input->post('awal', true);
                $cari['akhir']  = $this->input->post('akhir', true);
                $data['mdh']    = $this->Mobile_m->laporanTugas($cari);
                return $this->mobilelib->theme('mobile/laporan/tugas.mdh.php', $data);
            }
        }

        // Overtime Reports
        if ($param1 == 'lembur') {
            $this->form_validation->set_rules('awal', 'First Date', 'required');
            $this->form_validation->set_rules('akhir', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Overtime Reports";
                return $this->mobilelib->theme('mobile/laporan/lembur.mdh.php', $data);
            } else {
                $data['page']   = "Overtime Reports";
                return $this->mobilelib->theme('mobile/laporan/lembur.mdh.php', $data);
            }
        }

        // Salary Reports
        if ($param1 == 'gaji') {
            $this->form_validation->set_rules('awal', 'First Date', 'required');
            $this->form_validation->set_rules('akhir', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Salary Reports";
                return $this->mobilelib->theme('mobile/laporan/gaji.mdh.php', $data);
            } else {
                $data['page']   = "Salary Reports";
                return $this->mobilelib->theme('mobile/laporan/gaji.mdh.php', $data);
            }
        }
    }


    /* ======================== Logout and Destroy Session Function ====================== */

    function logout()
    {
        $this->session->userdata('status');
        $this->session->userdata('id');
        $this->session->userdata('log');
        session_destroy();
        return redirect('mobile/login');
    }
}
