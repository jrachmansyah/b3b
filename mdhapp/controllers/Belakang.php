<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belakang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Library
        $this->load->library('upload');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('Belakanglib');
        $this->load->library('table');

        // Helper 
        $this->load->helper('form');
        //Model
        $this->load->model('Belakang_m');

        // Lang defaulth Includes
        $this->set_language();

        // Sett Timezone Defaulth
        $timezone = $this->db->get('pengaturan')->row();
        date_default_timezone_set($timezone->timezone);
    }


    /* ======================== Admin Login Function ====================== */
    public function login()
    {
        // Validation Form For Admin Login Form
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {

            // Condition For already have a session or not
            if ($this->session->userdata('id_adm') != null) {
                return redirect('admin/dashboard');
            }

            $data['sett']           = $this->db
                ->join('mobile', 'mobile.status=pengaturan.status')
                ->join('attendance', 'attendance.status=pengaturan.status')
                ->join('payroll', 'payroll.status=pengaturan.status')
                ->get('pengaturan')->row();
            $data['page']           = "Admin Login";
            return $this->load->view('backend/other/login.mdh.php', $data);
        } else {

            // Insert Post For Email And Password 
            $data['email']          = $this->input->post('email', true);
            $data['password']       = sha1($this->input->post('password', true));
            // Variabel check user admin
            $checkData              = $this->Belakang_m->checkLog($data);

            // Condition For check Admin data
            if (count($checkData->result()) == 1) {
                foreach ($checkData->result() as $mdh) {
                    $akun['status']     = "Atos";
                    $akun['id_adm']         = $mdh->id;
                    $akun['role']       = $mdh->role;
                    $this->session->set_userdata($akun);
                }
                return redirect('admin/dashboard');
            } else {
                return redirect('admin/login');
            }
        }
    }

    /* ========================== Function For Set Language =============== */

    // Sett for defaulth Session Lang
    public function set_language()
    {
        $set_language = $this->session->userdata('language');
        if ($set_language) {
            $this->lang->load('belakang/general', $set_language);
        } else {
            $this->lang->load('belakang/general', 'indonesian'); // You Can Change Indonesian With English
        }
    }

    // Action For Swith Language
    public function ubahBahasa($language = 'indonesian')
    {
        $this->session->set_userdata('language', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }


    /* ========================== Dashboard Panel =============== */
    function dashboard()
    {
        $data['page']       = "Dashboard";

        // set of variables needed on the dashboard page
        $data['emp']        = $this->db->get('pegawai')->result();
        $data['dpt']        = $this->db->get('department')->result();
        $data['dsg']        = $this->db->get('designation')->result();
        $data['atd']        = $this->db->where('date', date('Y-m-d'))->get('absensi')->result();
        $data['tdn']        = $this->db->where('status_selesai', '1')->get('tugas')->result();
        $data['tpg']        = $this->db->where('status_selesai', '2')->get('tugas')->result();
        $data['td'] = $this->db
            ->where('status_selesai', '1')
            ->where('left(tanggal_buat,7)', date('Y-m'))
            ->get('tugas')->result();
        $data['tp'] = $this->db
            ->where('status_selesai', '2')
            ->where('left(tanggal_buat,7)', date('Y-m'))
            ->get('tugas')->result();
        $data['tn'] = $this->db
            ->where('status_selesai', '0')
            ->where('left(tanggal_buat,7)', date('Y-m'))
            ->get('tugas')->result();
        $data['esb']        = $this->Belakang_m->benefitSalary();
        $data['ana']        = $this->Belakang_m->analyticAttendance();
        $data['rmb']        = $this->Belakang_m->rembesDashboard();
        $data['lev']        = $this->Belakang_m->leaveDashboard();
        return $this->belakanglib->theme('backend/other/dashboard.mdh.php', $data);
    }

    /* ========================== Settings Function =============== */

    // The setting function has 7 parameters, including. general settings, attendance settings, 
    // teaching settings, sliders, admin, delete sliders, delete admin.

    function pengaturan($param1 = '', $param2 = '')
    {

        // General Settings
        if ($param1 == 'general') {

            // Condition Insert Type, General Sett or Welcome Mobile Sett
            $this->form_validation->set_rules('nama_system', 'System Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "General Settings";
                return $this->belakanglib->theme('backend/settings/general.mdh.php', $data);

                // Update General Sett
            } else if ($this->input->post('general') != null) {
                $data['nama_system']        = $this->input->post('nama_system', true);
                $data['banner_button']      = $this->input->post('banner_button', true);
                $data['banner_title']       = $this->input->post('banner_title', true);
                $data['banner_link']        = $this->input->post('banner_link', true);
                $data['timezone']           = $this->input->post('timezone', true);

                // Upload Company Logo 
                $mdh['upload_path']        = './mdhdesign/uploads/system/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'website-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                // Condition Upload, exist or not
                if (!empty($_FILES['logo_company']['name'])) {
                    if ($this->upload->do_upload('logo_company')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('pengaturan')->row();
                        if ($check->logo_company != null) {
                            $target = $mdh['upload_path'] . '/' . $check->logo_company;
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
                        $data['logo_company']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['banner_image']['name'])) {
                    if ($this->upload->do_upload('banner_image')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('pengaturan')->row();
                        if ($check->banner_image != null) {
                            $target = $mdh['upload_path'] . '/' . $check->banner_image;
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
                        $data['banner_image']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['admin_logo']['name'])) {
                    if ($this->upload->do_upload('admin_logo')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('pengaturan')->row();
                        if ($check->admin_logo != null) {
                            $target = $mdh['upload_path'] . '/' . $check->admin_logo;
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
                        $data['admin_logo']      = $image['file_name'];
                    }
                }

                // Query Builder Update
                $this->db->update('pengaturan', $data);

                $this->session->set_flashdata('flash', 'General Settings Has Been Change');
                return redirect('admin/settings/general');
            }
        }

        // Mobile Setting Parameter
        if ($param1 == 'mobile') {
            $this->form_validation->set_rules('welcome_button', 'Welcome Button', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Mobile Settings";
                return $this->belakanglib->theme('backend/settings/mobilesett.mdh.php', $data);
                // Update Mobile Sett
            } else if ($this->input->post('welcome') != null) {
                $data['welcome_button']             = $this->input->post('welcome_button', true);
                $data['feature1']                   = $this->input->post('feature1', true);
                $data['feature2']                   = $this->input->post('feature2', true);
                $data['feature3']                   = $this->input->post('feature3', true);

                $data['dfeature1']                  = $this->input->post('dfeature1', true);
                $data['dfeature2']                  = $this->input->post('dfeature2', true);
                $data['dfeature3']                  = $this->input->post('dfeature3', true);

                $mdh['upload_path']        = './mdhdesign/uploads/system/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'website-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['awalan']['name'])) {
                    if ($this->upload->do_upload('awalan')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->awalan != null) {
                            $target = $mdh['upload_path'] . '/' . $check->awalan;
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
                        $data['awalan']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['splash_screen1']['name'])) {
                    if ($this->upload->do_upload('splash_screen1')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->splash_screen1 != null) {
                            $target = $mdh['upload_path'] . '/' . $check->splash_screen1;
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
                        $data['splash_screen1']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['splash_screen2']['name'])) {
                    if ($this->upload->do_upload('splash_screen2')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->logo_company != null) {
                            $target = $mdh['upload_path'] . '/' . $check->logo_company;
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
                        $data['splash_screen2']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['splash_screen3']['name'])) {
                    if ($this->upload->do_upload('splash_screen3')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->splash_screen3 != null) {
                            $target = $mdh['upload_path'] . '/' . $check->splash_screen3;
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
                        $data['splash_screen3']      = $image['file_name'];
                    }
                }


                if (!empty($_FILES['img1']['name'])) {
                    if ($this->upload->do_upload('img1')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->img1 != null) {
                            $target = $mdh['upload_path'] . '/' . $check->img1;
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
                        $data['img1']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['img2']['name'])) {
                    if ($this->upload->do_upload('img2')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->img2 != null) {
                            $target = $mdh['upload_path'] . '/' . $check->img2;
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
                        $data['img2']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['img3']['name'])) {
                    if ($this->upload->do_upload('img3')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->img3 != null) {
                            $target = $mdh['upload_path'] . '/' . $check->img3;
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
                        $data['img3']      = $image['file_name'];
                    }
                }

                if (!empty($_FILES['qrcode']['name'])) {
                    if ($this->upload->do_upload('qrcode')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('mobile')->row();
                        if ($check->qrcode != null) {
                            $target = $mdh['upload_path'] . '/' . $check->qrcode;
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
                        $data['qrcode']      = $image['file_name'];
                    }
                }
                $this->db->update('mobile', $data);
                $this->session->set_flashdata('flash', 'Welcome Settings Has Been Change');
                return redirect('admin/settings/mobile');
            }
        }
        // Attendance Sett Parameter
        if ($param1 == 'absensi') {
            $this->form_validation->set_rules('jam_masuk', 'Checkin Time', 'required');
            $this->form_validation->set_rules('boleh_keluar', 'Checkout Time', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Attendance Settings";
                return $this->belakanglib->theme('backend/settings/absensi.mdh.php', $data);
            } else {
                $data['photo']          = $this->input->post('photo', true);
                $data['track']          = $this->input->post('track', true);
                $data['survey']         = $this->input->post('survey', true);
                $data['jam_masuk']      = $this->input->post('jam_masuk', true);
                $data['boleh_keluar']   = $this->input->post('boleh_keluar', true);
                $data['lang_kantor']    = $this->input->post('lang_kantor', true);
                $data['latitude_kantor'] = $this->input->post('latitude_kantor', true);
                $this->db->update('attendance', $data);
                $this->session->set_flashdata('flash', 'Attendance Settings Has Been Change');
                return redirect('admin/settings/attendance');
            }
        }

        // Employee Salary Sett Parameter
        if ($param1 == 'gaji') {
            $this->form_validation->set_rules('alamat', 'Address', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('pajak_gaji', 'Salary Tax', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Payroll Settings";
                return $this->belakanglib->theme('backend/settings/gaji.mdh.php', $data);
            } else {
                $data['alamat']     = $this->input->post('alamat', true);
                $data['phone']      = $this->input->post('phone', true);
                $data['email']      = $this->input->post('email', true);
                $data['pajak_gaji'] = $this->input->post('pajak_gaji', true);
                $mdh['upload_path']        = './mdhdesign/uploads/system/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'slip-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image_slip']['name'])) {
                    if ($this->upload->do_upload('image_slip')) {
                        $image = $this->upload->data();

                        $check = $this->db->get('payroll')->row();
                        if ($check->image_slip != null) {
                            $target = $mdh['upload_path'] . '/' . $check->image_slip;
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
                        $data['image_slip']      = $image['file_name'];
                    }
                }
                $this->db->update('payroll', $data);
                $this->session->set_flashdata('flash', 'Payroll Settings Has been Updated');
                return redirect('admin/settings/payroll');
            }
        }


        // Slider Parameters
        if ($param1 == 'slider') {
            $data['nama']        = $this->form_validation->set_rules('nama', 'Name Image', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Slider Mobile";

                // Table Library Function
                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );


                $this->table->set_template($mdhTable);

                // Table Colom For Slider 
                // You can change the table fields in this section
                $this->table->set_heading(array(
                    'No', // name of colom
                    $this->lang->line('gambar') . ' ' . $this->lang->line('nama'), // Name Of Colom
                    $this->lang->line('gambar'), // name of colom
                    $this->lang->line('action'), // name of colom
                    // you can add colom in this ex : slider title.
                ));
                // Query Get Slider Data 
                $sliderData  = $this->db->order_by('id', 'desc')->get('slider')->result();

                // Looping For Slider Data
                foreach ($sliderData as $technoilahi) {

                    // variable displays the slider image in the table
                    $photo = '<img width="75px" height="75px" class="img-circle" src="' . base_url() . 'mdhdesign/uploads/slider/' . $technoilahi->image . '">';
                    // variable displays the action in the table
                    $action = '<a href="#sliderEdit' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . base_url('belakang/pengaturan/delSlider/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>';
                    $this->table->add_row(array(
                        '#', // fill in the table column
                        $technoilahi->nama, // fill in the table column
                        $photo, // fill in the table column
                        $action, // fill in the table column
                        // You can add new information here
                    ));
                }

                $data['mdh']        = $this->table->generate();
                $data['slider']     = $this->db->get('slider')->result();
                return $this->belakanglib->theme('backend/settings/slider.mdh.php', $data);

                // Add Slider Condition
            } else if ($this->input->post('add') != null) {
                $data['nama']       = $this->input->post('nama', true);

                $mdh['upload_path']        = './mdhdesign/uploads/slider/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'slider-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $image = $this->upload->data();
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->insert('slider', $data);
                $this->session->set_flashdata('flash', 'Slider Hasbeen Added');
                return redirect('admin/slider');

                // Update SLider Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama']       = $this->input->post('nama', true);
                $mdh['upload_path']        = './mdhdesign/uploads/slider/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'slider-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {

                        $checkImage = $this->db->where('id', $this->input->post('id'))->get('slider')->row();
                        if ($checkImage->image != null) {
                            $target = $mdh['upload_path'] . '/' . $checkImage->image;
                            unlink($target);
                        }
                        $image = $this->upload->data();
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->where('id', $this->input->post('id'))->update('slider', $data);
                $this->session->set_flashdata('flash', 'Slider Has been Updated');
                return redirect('admin/slider');
            }
        }

        // Slider Delete Parameter
        if ($param1 == 'delSlider') {
            // Query Delete 
            $this->db->where('id', $param2)->delete('slider');
            $this->session->set_flashdata('flash', 'Slider Hasbeen Deleted');
            return redirect('admin/slider');
        }

        // Admin Data Parameters
        if ($param1 == 'admin') {
            $this->form_validation->set_rules('nama_awal', 'First Name', 'required');
            $this->form_validation->set_rules('nama_akhir', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_rules('alamat', 'Address', 'required');
            $this->form_validation->set_rules('jk', 'Gender', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('ttl', 'Date birth', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Admin Data";
                // Table Library
                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );
                $this->table->set_template($mdhTable);
                // Colum Table Information
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('nama_awal'),
                    $this->lang->line('nama_akhir'),
                    $this->lang->line('email'),
                    $this->lang->line('kelamin'),
                    $this->lang->line('photo'),
                    $this->lang->line('ultah'),
                    $this->lang->line('role'),
                    $this->lang->line('action')
                ));
                $adminData  = $this->db->order_by('id', 'desc')->get('admin')->result();
                foreach ($adminData as $technoilahi) {
                    // Condition Name Woman Or Man for gender
                    if ($technoilahi->jk == 'P') {
                        $gender = 'Woman';
                    } else {
                        $gender = 'Man';
                    }

                    // Variable Image
                    $photo = '<img width="75px" height="75px" class="img-circle" src="' . base_url() . 'mdhdesign/uploads/admin/' . $technoilahi->photo . '">';
                    // Role Condition
                    if ($technoilahi->role == '1') {
                        $role = 'Admin';
                    } else if ($technoilahi->role == '2') {
                        $role = 'Secretariat';
                    } else if ($technoilahi->role == '3') {
                        $role = 'HRD';
                    }

                    $action = '<a href="#adminEdit' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . base_url('admin/delAdmin/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>';
                    $this->table->add_row(array(
                        // Array fill in the table column
                        '#',
                        $technoilahi->nama_awal,
                        $technoilahi->nama_akhir,
                        $technoilahi->email,
                        $gender,
                        $photo,
                        $technoilahi->ttl,
                        $role,
                        $action,
                    ));
                }

                $data['mdh'] = $this->table->generate();
                $data['adm'] = $this->db->get('admin')->result();
                return $this->belakanglib->theme('backend/settings/admin.mdh.php', $data);

                // Add Admin Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_awal']          = $this->input->post('nama_awal', true);
                $data['nama_akhir']         = $this->input->post('nama_akhir', true);
                $data['alamat']        = $this->input->post('alamat', true);
                $data['jk']        = $this->input->post('jk', true);
                $data['role']        = $this->input->post('role', true);
                $data['email']        = $this->input->post('email', true);
                $data['username']        = $this->input->post('username', true);
                $data['password']        = sha1($this->input->post('password', true));
                $data['ttl']            = $this->input->post('ttl', true);
                $data['phone']            = $this->input->post('phone', true);

                $mdh['upload_path']        = './mdhdesign/uploads/admin/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'adminPhoto-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['photo']['name'])) {
                    if ($this->upload->do_upload('photo')) {
                        $image = $this->upload->data();
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
                $this->db->insert('admin', $data);
                $this->session->set_flashdata('flash', 'Admin Added Successfully');
                return redirect('admin/admin');
                // Update Admin Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_awal']          = $this->input->post('nama_awal', true);
                $data['nama_akhir']         = $this->input->post('nama_akhir', true);
                $data['alamat']         = $this->input->post('alamat', true);
                $data['jk']        = $this->input->post('jk', true);
                $data['role']        = $this->input->post('role', true);
                $data['email']        = $this->input->post('email', true);
                $data['username']        = $this->input->post('username', true);
                $data['password']        = sha1($this->input->post('password', true));
                $data['ttl']            = $this->input->post('ttl', true);
                $data['phone']            = $this->input->post('phone', true);

                $mdh['upload_path']        = './mdhdesign/uploads/admin/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'adminPhoto-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['photo']['name'])) {
                    $checkImage = $this->db->where('id', $this->input->post('id'))->get('admin')->row();
                    if ($checkImage->photo != null) {
                        $target = $mdh['upload_path'] . '/' . $checkImage->photo;
                        unlink($target);
                    }
                    if ($this->upload->do_upload('photo')) {
                        $image = $this->upload->data();
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
                $this->db->where('id', $this->input->post('id'))->update('admin', $data);
                $this->session->set_flashdata('flash', 'Admin Updated Successfully');
                return redirect('admin/admin');
            }
        }

        // Admin Delete Parameters
        if ($param1 == 'delAdmin') {
            $this->db->where('id', $param2)->delete('admin');
            $this->session->set_flashdata('flash', 'Admin Has been Deleted');
            return redirect('admin/admin');
        }
    }

    /* ========================== Company Information Function =============== */

    // in the company function, it has 4 parameters.
    // department and designation company, is master data that will always be used, 
    // so when deleting it, please be careful
    function company($param1 = '', $param2 = '')
    {
        // Department Parameter
        if ($param1 == 'department') {
            $data['nama_department']        = $this->form_validation->set_rules('nama_department', 'Department Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Department List";
                $data['dph']    = $this->db->order_by('id', 'desc')->get('department')->result();

                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );
                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('department') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action')
                ));
                $departmentData  = $this->db->order_by('id', 'desc')->get('department')->result();
                $no = 1;
                foreach ($departmentData as $technoilahi) {
                    $action = '<a href="#sliderEdit' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . base_url('admin/department/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_department,
                        $action,
                    ));
                }
                $data['mdh'] = $this->table->generate();
                return $this->belakanglib->theme('backend/company/department.mdh.php', $data);

                // Department Add Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_department']        = $this->input->post('nama_department', true);
                $this->db->insert('department', $data);
                $this->session->set_flashdata('flash', 'Department Success Added');
                return redirect('admin/department');

                // Department Update Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_department']        = $this->input->post('nama_department', true);
                $this->db->where('id', $this->input->post('id'))->update('department', $data);
                $this->session->set_flashdata('flash', 'Department Updated Success');
                return redirect('admin/department');
            }
        }

        // Delete Department Paramenter
        if ($param1 == 'delDepartment') {
            $this->db->where('id', $param2)->delete('department');
            $this->session->set_flashdata('flash', 'Department Hasbeen Deleted');
            return redirect('admin/department');
        }

        // Designation Parameter
        if ($param1 == 'designation') {
            $this->form_validation->set_rules('id_department', 'Department', 'required');
            $this->form_validation->set_rules('nama_designation', 'Designation Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Designation";
                $data['q1']     = $this->db->get('department')->result();
                $data['q2']     = $this->db->get('designation')->result();

                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );
                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('department') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('designation') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action')
                ));

                $query = $this->db->select(
                    'd.nama_department, designation.nama_designation, designation.id'
                )->join(
                    'department as d',
                    'd.id=designation.id_department'
                )->get('designation')->result();

                $no = 1;
                foreach ($query as $technoilahi) {
                    $action = '<a href="#designationEdit' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . base_url('admin/designation/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_department,
                        $technoilahi->nama_designation,
                        $action,
                    ));
                }

                $data['mdh']    = $this->table->generate();
                return $this->belakanglib->theme('backend/company/designation.mdh.php', $data);
            } else if ($this->input->post('add') != null) {
                $data['id_department']          = $this->input->post('id_department', true);
                $data['nama_designation']       = $this->input->post('nama_designation', true);
                $this->db->insert('designation', $data);
                $this->session->set_flashdata('flash', 'Designation Hasbeen Added');
                return redirect('admin/designation');
            } else if ($this->input->post('edit') != null) {
                $data['id_department']          = $this->input->post('id_department', true);
                $data['nama_designation']       = $this->input->post('nama_designation', true);
                $this->db->where('id', $this->input->post('id'))->update('designation', $data);
                $this->session->set_flashdata('flash', 'Designation Hasbeen Updated');
                return redirect('admin/designation');
            }
        }

        if ($param1 == 'delDesignation') {
            $this->db->where('id', $param2)->delete('designation');
            $this->session->set_flashdata('flash', 'Designation Hasbeen Deleted');
            return redirect('admin/designation');
        }
    }

    /* ========================== Employee Function =============== */

    // inside the employee function, we don't add delete in it, 
    // because that would jeopardize the derived data

    function pegawai($param1 = '', $param2 = '')
    {
        // Employee Add Condition
        if ($param1 == 'add') {
            // Validation Form For Employee
            $this->form_validation->set_rules('id_department', 'Department Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('id_designation', 'Designation Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Add Employee";
                $data['q1']     = $this->db->get('department')->result();
                return $this->belakanglib->theme('backend/employee/add.mdh.php', $data);
            } else {
                $data['id_department']          = $this->input->post('id_department', true);
                $data['id_designation']         = $this->input->post('id_designation', true);
                $data['nama_awal']         = $this->input->post('nama_awal', true);
                $data['nama_akhir']         = $this->input->post('nama_akhir', true);
                $data['jk']         = $this->input->post('jk', true);
                $data['ttl']         = $this->input->post('ttl', true);
                $data['tanggal_gabung']         = $this->input->post('tanggal_gabung', true);
                $data['alamat']         = $this->input->post('alamat', true);
                $data['email']         = $this->input->post('email', true);
                $data['password']         = sha1($this->input->post('password', true));
                $data['ponsel']         = $this->input->post('ponsel', true);
                $data['status']         = '1';
                $data['besar_gaji']         = $this->input->post('besar_gaji', true);
                $data['nomor_rek']         = $this->input->post('nomor_rek', true);
                $data['atas_nama']         = $this->input->post('atas_nama', true);
                $data['pengalaman']         = $this->input->post('pengalaman', true);
                $data['deskripsi_pegawai']         = $this->input->post('deskripsi_pegawai', true);

                $data['fb']         = $this->input->post('fb', true);
                $data['tw']         = $this->input->post('tw', true);
                $data['ig']         = $this->input->post('ig', true);
                $data['whatsapp']         = $this->input->post('whatsapp', true);

                $mdh['upload_path']        = './mdhdesign/uploads/pegawai/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'pegawai-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['photo']['name'])) {
                    if ($this->upload->do_upload('photo')) {
                        $image = $this->upload->data();
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
                $this->db->insert('pegawai', $data);
                $this->session->set_flashdata('flash', 'Employee Success Added');
                return redirect('admin/employee/add');
            }
        }

        // function parameter to get a designation from the id department sent by jquery 
        if ($param1 == 'designation') {
            $q = $this->db->where('id_department', $param2)->get('designation')->result();
            // HTML tag option for view in employee page
            $data = "<option value=''> - Choose Designation - </option>";
            foreach ($q as $value) {
                $data .= "<option value='" . $value->id . "'> " . $value->nama_designation . " </option>";
            }
            echo $data;
        }

        // Update Employee Parameters
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('id_department', 'Department Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('id_designation', 'Designation Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']   = "Edit Employee";
                $data['q1']     = $this->db->get('department')->result();
                $data['q2']     = $this->db->where('id', $param2)->get('pegawai')->row();
                return $this->belakanglib->theme('backend/employee/edit.mdh.php', $data);
            } else {
                $data['id_department']          = $this->input->post('id_department', true);
                $data['id_designation']         = $this->input->post('id_designation', true);
                $data['nama_awal']         = $this->input->post('nama_awal', true);
                $data['nama_akhir']         = $this->input->post('nama_akhir', true);
                $data['jk']         = $this->input->post('jk', true);
                $data['ttl']         = $this->input->post('ttl', true);
                $data['tanggal_gabung']         = $this->input->post('tanggal_gabung', true);
                $data['alamat']         = $this->input->post('alamat', true);
                $data['email']         = $this->input->post('email', true);
                $data['password']         = sha1($this->input->post('password', true));
                $data['ponsel']         = $this->input->post('ponsel', true);
                $data['status']         = '1';
                $data['besar_gaji']         = $this->input->post('besar_gaji', true);
                $data['nomor_rek']         = $this->input->post('nomor_rek', true);
                $data['atas_nama']         = $this->input->post('atas_nama', true);
                $data['pengalaman']         = $this->input->post('pengalaman', true);
                $data['deskripsi_pegawai']         = $this->input->post('deskripsi_pegawai', true);

                $data['fb']         = $this->input->post('fb', true);
                $data['tw']         = $this->input->post('tw', true);
                $data['ig']         = $this->input->post('ig', true);
                $data['whatsapp']         = $this->input->post('whatsapp', true);

                $mdh['upload_path']        = './mdhdesign/uploads/pegawai/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'pegawai-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['photo']['name'])) {
                    if ($this->upload->do_upload('photo')) {
                        $image = $this->upload->data();

                        $check = $this->db->where('id', $this->input->post('id'))->get('pegawai')->row();
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
                $this->db->where('id', $this->input->post('id'))->update('pegawai', $data);
                $this->session->set_flashdata('flash', 'Employee Success Added');
                return redirect('admin/employee/list');
            }
        }

        // Detail Parameter
        if ($param1 == 'detail') {
            $data['page']       = "Employee Detail";
            $data['emp']        = $this->db

                // Query select, to determine which data is given the right to appear
                ->select('
                    department.nama_department,
                    designation.nama_designation,
                    pegawai.nama_awal,
                    pegawai.nama_akhir,
                    pegawai.jk,
                    pegawai.ttl,
                    pegawai.tanggal_gabung,
                    pegawai.alamat,
                    pegawai.negara,
                    pegawai.username,
                    pegawai.email,
                    pegawai.ponsel,
                    pegawai.besar_gaji,
                    pegawai.photo,
                    pegawai.status,
                    pegawai.nomor_rek,
                    pegawai.atas_nama,
                    pegawai.pengalaman,
                    pegawai.deskripsi_pegawai,
                    pegawai.ig,
                    pegawai.fb,
                    pegawai.tw,
                    pegawai.whatsapp
                ')

                // Query Join Department and designation
                ->join('department', 'department.id=pegawai.id_department')
                ->join('designation', 'designation.id=pegawai.id_designation')
                ->where('pegawai.id', $param2)
                ->get('pegawai')->row();
            $data['tsk']        = $this->db
                ->where('id_pegawai', $param2)
                ->order_by('id', 'DESC')
                ->get('tugas')->result();
            $data['leave']      = $this->db
                ->where('id_pegawai', $param2)
                ->where('status', '1')
                ->get('cuti')->result();
            $data['abs']        = $this->db
                ->where('id_pegawai', $param2)
                ->get('absensi')->result();
            $data['rmb']        = $this->db
                ->where('id_pegawai', $param2)
                ->where('status_rembes', '1')
                ->get('rembes')->result();
            $data['absensi']    = $this->Belakang_m->realtimeHours($param2);
            $data['totalhour']  = $this->Belakang_m->realtimeOvertime($param2);
            return $this->belakanglib->theme('backend/employee/detail.mdh.php', $data);
        }

        // Employee List Parameter
        if ($param1 == 'list') {
            $data['page']       = "Employee List";
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table" >',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('department') . ' ' . $this->lang->line('nama'),
                $this->lang->line('designation') . ' ' . $this->lang->line('nama'),
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('photo'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select(
                    'dp.nama_department,
                    ds.nama_designation,
                    pegawai.nama_awal,
                    pegawai.nama_akhir,
                    pegawai.photo,
                    pegawai.ponsel,
                    pegawai.id'
                )
                ->join('department as dp', 'dp.id=pegawai.id_department')
                ->join('designation as ds', 'ds.id=pegawai.id_designation')
                ->where('pegawai.status', '1')
                ->get('pegawai')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $image = '<img width="80px" src="' . base_url() . 'mdhdesign/uploads/pegawai/' . $technoilahi->photo . '">';
                $action = '<a href="' . base_url('admin/employee/edit/' . $technoilahi->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                <a href="' . base_url('admin/employee/block/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                <a href="' . base_url('admin/employee/detail/' . $technoilahi->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $technoilahi->nama_awal))) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $technoilahi->nama_department,
                    $technoilahi->nama_designation,
                    $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir,
                    $image,
                    $action,
                ));
            }

            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/employee/list.mdh.php', $data);
        }

        // Employee List In Out Status
        if ($param1 == 'out') {
            $data['page']       = "Employee Out";
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table" >',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('department') . ' ' . $this->lang->line('nama'),
                $this->lang->line('designation') . ' ' . $this->lang->line('nama'),
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('photo'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select(
                    'dp.nama_department,
                    ds.nama_designation,
                    pegawai.nama_awal,
                    pegawai.nama_akhir,
                    pegawai.photo,
                    pegawai.ponsel,
                    pegawai.id'
                )
                ->join('department as dp', 'dp.id=pegawai.id_department')
                ->join('designation as ds', 'ds.id=pegawai.id_designation')
                ->where('pegawai.status', '2')
                ->get('pegawai')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $image = '<img width="80px" src="' . base_url() . 'mdhdesign/uploads/pegawai/' . $technoilahi->photo . '">';
                $action = '
                <a href="' . base_url('admin/employee/active/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                <a href="' . base_url('admin/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $technoilahi->nama_department,
                    $technoilahi->nama_designation,
                    $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir,
                    $image,
                    $action,
                ));
            }

            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/employee/list.mdh.php', $data);
        }

        // Action Out ( Active to Out Employee) Parameter
        if ($param1 == 'actionOut') {
            $data['status']     = '2';
            $this->db->where('id', $param2)->update('pegawai', $data);
            $this->session->set_flashdata('flash', 'Employee Success Drop Out');
            return redirect('admin/employee/list');
        }

        // Action Active (Out To Active Employee) Parameter
        if ($param1 == 'actionBack') {
            $data['status']     = '1';
            $this->db->where('id', $param2)->update('pegawai', $data);
            $this->session->set_flashdata('flash', 'Employee Success Drop Out');
            return redirect('admin/employee/list');
        }
    }

    /* ========================== Employee Attendance =============== */


    function absensi($param1 = '', $param2 = '')
    {
        // Today Attendance List Parameter
        if ($param1 == 'today') {
            $data['page']       = "Today Attendance";

            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table" >',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('jam_masuk'),
                $this->lang->line('jam_pulang'),
                $this->lang->line('gambar') . ' ' . $this->lang->line('jam_masuk'),
                $this->lang->line('gambar') . ' ' . $this->lang->line('jam_pulang'),
                $this->lang->line('total_work_hours'),
                $this->lang->line('action')
            ));
            $query        = $this->db
                ->select('
                                        pegawai.nama_awal,
                                        pegawai.nama_akhir,
                                        absensi.date,
                                        absensi.id,
                                        absensi.long_masuk,
                                        absensi.long_keluar,
                                        absensi.image_masuk,
                                        absensi.image_keluar,
                                        absensi.jam_masuk,
                                        absensi.jam_keluar,
                                        absensi.total_kerja,
                                        absensi.latitude_masuk,
                                        absensi.latitude_keluar
                                        ')
                ->join('pegawai', 'pegawai.id=absensi.id_pegawai')
                ->where('absensi.date', date('Y-m-d'))
                ->order_by('absensi.id', 'DESC')
                ->get('absensi')->result();

            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . '' . $technoilahi->nama_akhir;
                $masuk  = '<img src="' . base_url() . $technoilahi->image_masuk . '" width="80px">';
                if ($technoilahi->image_keluar != null) {
                    $keluar = '<img src="' . base_url() . $technoilahi->image_keluar . '" width="80px">';
                } else {
                    $keluar = '';
                }
                $action = '<a href="' . base_url('admin/attendance/track/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $name,
                    $technoilahi->jam_masuk,
                    $technoilahi->jam_keluar,
                    $masuk,
                    $keluar,
                    $technoilahi->total_kerja,
                    $action
                ));
            }

            $data['mdh']    = $this->table->generate();

            return $this->belakanglib->theme('backend/absensi/today.mdh.php', $data);
        }

        // Overtime Today List  Parameter
        if ($param1 == 'overtime') {
            $data['page']       = "Overtime";

            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table" >',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('time') . ' ' . $this->lang->line('start'),
                $this->lang->line('time') . ' ' . $this->lang->line('end'),
                $this->lang->line('action')
            ));

            $query        = $this->db
                ->select('
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            lembur.jam_mulai,
                            lembur.id,
                            lembur.sampai_jam,
                            ')
                ->join('pegawai', 'pegawai.id=lembur.id_pegawai')
                ->where('lembur.date', date('Y-m-d'))
                ->order_by('lembur.id', 'DESC')
                ->get('lembur')->result();

            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . '' . $technoilahi->nama_akhir;
                $action = '<a href="' . base_url('admin/overtime/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $name,
                    $technoilahi->jam_mulai,
                    $technoilahi->sampai_jam,
                    $action
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/absensi/overtime.mdh.php', $data);
        }

        // Overtime Detail Parameter
        if ($param1 == 'overtimeDetail') {
            $data['page']       = "Detail Overtime";
            $data['mdh']        = $this->db->where('id', $param2)->get('lembur')->row();
            $data['isi']        = $this->db->where('id_lembur', $param2)
                ->get('isilembur')->result();
            return $this->belakanglib->theme('backend/absensi/detailOvertime.mdh.php', $data);
        }

        // Maps Tracking Parameter
        if ($param1 == 'mapTrack') {
            $data['page']       = "Map Tracker Today";
            $data['absensi']        = $this->db
                ->select('
                                        pegawai.nama_awal,
                                        pegawai.nama_akhir,
                                        absensi.date,
                                        absensi.id,
                                        absensi.long_masuk,
                                        absensi.long_keluar,
                                        absensi.image_masuk,
                                        absensi.image_keluar,
                                        absensi.jam_masuk,
                                        absensi.jam_keluar,
                                        absensi.total_kerja,
                                        absensi.latitude_masuk,
                                        absensi.latitude_keluar
                                        ')
                ->join('pegawai', 'pegawai.id=absensi.id_pegawai')
                ->where('absensi.date', date('Y-m-d'))
                ->order_by('absensi.id', 'DESC')
                ->get('absensi');
            $data['q1']      = $this->db
                ->select('
                                        pegawai.nama_awal,
                                        pegawai.nama_akhir,
                                        absensi.date,
                                        absensi.id,
                                        absensi.long_masuk,
                                        absensi.long_keluar,
                                        absensi.image_masuk,
                                        absensi.image_keluar,
                                        absensi.jam_masuk,
                                        absensi.jam_keluar,
                                        absensi.total_kerja,
                                        absensi.latitude_masuk,
                                        absensi.latitude_keluar
                                        ')
                ->join('pegawai', 'pegawai.id=absensi.id_pegawai')
                ->where('absensi.date', date('Y-m-d'))
                ->order_by('absensi.id', 'ASC')
                ->limit(1)
                ->get('absensi');
            $data['no']      = $this->db
                ->where('status', '1')
                ->get('pegawai')->result();
            return $this->belakanglib->theme('backend/absensi/map.mdh.php', $data);
        }

        // Maps Tracker Where Get Attendance ID Parameter
        if ($param1 == 'tracker') {
            $data['page']       = "Map Tracker";
            $data['mdh']        = $this->db
                ->select('
                                        pegawai.nama_awal,
                                        pegawai.nama_akhir,
                                        absensi.date,
                                        absensi.id,
                                        absensi.long_masuk,
                                        absensi.long_keluar,
                                        absensi.image_masuk,
                                        absensi.image_keluar,
                                        absensi.jam_masuk,
                                        absensi.jam_keluar,
                                        absensi.total_kerja,
                                        absensi.latitude_masuk,
                                        absensi.latitude_keluar
                                        ')
                ->join('pegawai', 'pegawai.id=absensi.id_pegawai')
                ->where('absensi.id', $param2)
                ->order_by('absensi.id', 'DESC')
                ->get('absensi');
            return $this->belakanglib->theme('backend/absensi/tracker.mdh.php', $data);
        }
    }

    /* ========================== Employee Leave Function =============== */

    function leave($param1 = '', $param2 = '')
    {

        // Leave Type Parameters
        if ($param1 == 'type') {
            $this->form_validation->set_rules('nama_type', 'Type Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']           = "Tipe Cuti";
                $data['type']           = $this->db->get('typecuti')->result();
                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('tipe') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action')
                ));

                $query = $this->db->get('typecuti')->result();

                $no = 1;
                foreach ($query as $technoilahi) {
                    $action = '
                    <a href="' . base_url('admin/leave/delete/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    <a href="#editType' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-warning"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_type,
                        $action,
                    ));
                }
                $data['mdh']    = $this->table->generate();
                return $this->belakanglib->theme('backend/leave/type.mdh.php', $data);
            } else if ($this->input->post('add') != null) {

                $data['nama_type'] =  $this->input->post('nama_type', true);
                $this->db->insert('typecuti', $data);
                $this->session->set_flashdata('flash', 'Type Cuti Success Added');
                return redirect('admin/leave/type');
            } else if ($this->input->post('edit') != null) {

                $data['nama_type']  =  $this->input->post('nama_type', true);
                $this->db->where('id', $this->input->post('id'))->update('typecuti', $data);
                $this->session->set_flashdata('flash', 'Type Cuti Success Added');
                return redirect('admin/leave/type');
            }
        }

        // Leave Type Parameters
        if ($param1 == 'delete') {
            $this->db->where('id', $param2)->delete('typecuti');
            $this->session->set_flashdata('flash', 'Type Has been deleted');
            return redirect('admin/leave/type');
        }

        // Approval Employee Leave List Parameter
        if ($param1 == 'approved') {
            $data['page']           = "Cuti Disetujui";
            $data['modal']          = $this->db->get('cuti')->result();
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tipe') . ' ' . $this->lang->line('cuti'),
                $this->lang->line('alasan'),
                $this->lang->line('start'),
                $this->lang->line('end'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                ->join('typecuti', 'typecuti.id=cuti.id_type')
                ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                ->where('cuti.status', '1')
                ->get('cuti')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $action = '
                    <a href="#modal' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->nama_type,
                    $technoilahi->alasan,
                    $technoilahi->tanggal_cuti,
                    $technoilahi->sampai_tanggal,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/leave/approve.mdh.php', $data);
        }


        // Pending Employee Leave List Parameter
        if ($param1 == 'pending') {
            $data['page']           = "Menunggu Persetujuan Cuti";
            $data['modal']          = $this->db->get('cuti')->result();
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tipe') . ' ' . $this->lang->line('cuti'),
                $this->lang->line('alasan'),
                $this->lang->line('start'),
                $this->lang->line('end'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                ->join('typecuti', 'typecuti.id=cuti.id_type')
                ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                ->where('cuti.status', '0')
                ->get('cuti')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $action = '
                    <a href="#modal' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    <a href="' . base_url('belakang/leave/check/' . $technoilahi->id) . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                    <a href="' . base_url('belakang/leave/dismiss/' . $technoilahi->id) . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->nama_type,
                    $technoilahi->alasan,
                    $technoilahi->tanggal_cuti,
                    $technoilahi->sampai_tanggal,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/leave/approve.mdh.php', $data);
        }

        // Employee Leave Rejected List Parameter
        if ($param1 == 'rejected') {
            $data['page']           = "Cuti Ditolak";
            $data['modal']          = $this->db->get('cuti')->result();
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tipe') . ' ' . $this->lang->line('cuti'),
                $this->lang->line('alasan'),
                $this->lang->line('start'),
                $this->lang->line('end'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                ->join('typecuti', 'typecuti.id=cuti.id_type')
                ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                ->where('cuti.status', '2')
                ->get('cuti')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $action = '
                    <a href="#modal' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->nama_type,
                    $technoilahi->alasan,
                    $technoilahi->tanggal_cuti,
                    $technoilahi->sampai_tanggal,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/leave/approve.mdh.php', $data);
        }

        // Approval Action For Employee Leave Parameters
        if ($param1 == 'check') {
            $data['status']     = '1';
            $this->db->where('id', $param2)->update('cuti', $data);

            // Send Employee  function
            $q1 = $this->db->where('id', $param2)->get('cuti')->row();
            $q2 = $this->db->where('id', $q1->id_pegawai)->get('pegawai')->row();

            $notif['id_pegawai']        = $q2->id;

            // You Can Change For Title and Notif Description 
            $notif['title']             = 'Leave work permit decisions'; // Change Title In Here
            $notif['isi']               = 'application for your leave from work on' . $q1->tanggal_izin . ' 
                                            we have decided. You are allowed permission to leave work from the date you have 
                                            applied for it'; // Change Notif Description In Here
            $notif['tanggal']           = date('Y-m-d');
            $this->db->insert('notifpegawai', $notif);
            $this->session->set_flashdata('flash', 'application has been approved');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Reject Action For Employee Leave Parameter
        if ($param1 == 'dismiss') {
            $data['status']     = '2';
            $this->db->where('id', $param2)->update('cuti', $data);
            // Notif Employee

            $q1 = $this->db->where('id', $param2)->get('cuti')->row();
            $q2 = $this->db->where('id', $q1->id_pegawai)->get('pegawai')->row();
            $notif['id_pegawai']        = $q2->id;
            $notif['title']             = 'Leave work permit decisions';
            $notif['isi']               = 'sorry, your request for leave on ' . $q1->tanggal_izin . ', we cannot give it for now';
            $notif['tanggal']           = date('Y-m-d');
            $this->db->insert('notifpegawai', $notif);
            $this->session->set_flashdata('flash', 'application has been rejected');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /* ========================== Employee Raimburse Function =============== */

    function rembes($param1 = '', $param2 = '')
    {

        // Pending Raimburse  List Parameters
        if ($param1 == 'pending') {
            $data['page']           = "Pending Raimbes";
            $data['detail']         = $this->db->get('rembes')->result();
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tanggal'),
                $this->lang->line('nama'),
                $this->lang->line('alasan'),
                $this->lang->line('berkas'),
                $this->lang->line('totally'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            rembes.id,
                            rembes.alasan_rembes,
                            rembes.tanggal_diminta,
                            rembes.tanggal_disetujui,
                            rembes.title,
                            rembes.status_rembes,
                            rembes.nominal_diminta,
                            rembes.file_rembes,
                            pegawai.nama_akhir,
                            pegawai.nama_awal,
                                        ')
                ->join('pegawai', 'pegawai.id=rembes.id_pegawai')
                ->where('rembes.status_rembes', '0')
                ->get('rembes')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $nominal   = number_format($technoilahi->nominal_diminta);
                $file = '<a class="btn btn-sm btn-success" href="' . base_url() . 'mdhdesign/uploads/rembes/' . $technoilahi->file_rembes . '" target="_blank"><i class="fa fa-download"></i></a>';
                $action = '
                    <a href="#detail' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    <a href="#izinkan' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                    <a href="#rejected' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->tanggal_diminta,
                    $technoilahi->title,
                    $technoilahi->alasan_rembes,
                    $file,
                    $nominal,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/raimbes/list.mdh.php', $data);
        }

        // Approval Raimburse List Parameters
        if ($param1 == 'approved') {
            $data['page']           = "Approval Raimbes";
            $data['detail']         = $this->db->get('rembes')->result();
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tanggal'),
                $this->lang->line('nama'),
                $this->lang->line('alasan'),
                $this->lang->line('berkas'),
                $this->lang->line('totally'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            rembes.id,
                            rembes.alasan_rembes,
                            rembes.tanggal_diminta,
                            rembes.tanggal_disetujui,
                            rembes.title,
                            rembes.status_rembes,
                            rembes.nominal_diminta,
                            rembes.file_rembes,
                            pegawai.nama_akhir,
                            pegawai.nama_awal,
                                        ')
                ->join('pegawai', 'pegawai.id=rembes.id_pegawai')
                ->where('rembes.status_rembes', '1')
                ->get('rembes')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $nominal   = number_format($technoilahi->nominal_diminta);
                $file = '<a class="btn btn-sm btn-success" href="' . base_url() . 'mdhdesign/uploads/rembes/' . $technoilahi->file_rembes . '" target="_blank"><i class="fa fa-download"></i></a>';
                $action = '
                    <a href="#detail' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->tanggal_diminta,
                    $technoilahi->title,
                    $technoilahi->alasan_rembes,
                    $file,
                    $nominal,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/raimbes/list.mdh.php', $data);
        }

        // Rejected Raimburse Parameter
        if ($param1 == 'notApproved') {
            $data['page']           = "Rejected Raimbes";
            $data['detail']         = $this->db->get('rembes')->result();
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tanggal'),
                $this->lang->line('nama'),
                $this->lang->line('alasan'),
                $this->lang->line('berkas'),
                $this->lang->line('totally'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            rembes.id,
                            rembes.alasan_rembes,
                            rembes.tanggal_diminta,
                            rembes.tanggal_disetujui,
                            rembes.title,
                            rembes.status_rembes,
                            rembes.nominal_diminta,
                            rembes.file_rembes,
                            pegawai.nama_akhir,
                            pegawai.nama_awal,
                                        ')
                ->join('pegawai', 'pegawai.id=rembes.id_pegawai')
                ->where('rembes.status_rembes', '2')
                ->get('rembes')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $nominal   = number_format($technoilahi->nominal_diminta);
                $file = '<a class="btn btn-sm btn-success" href="' . base_url() . 'mdhdesign/uploads/rembes/' . $technoilahi->file_rembes . '" target="_blank"><i class="fa fa-download"></i></a>';
                $action = '
                    <a href="#detail' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->tanggal_diminta,
                    $technoilahi->title,
                    $technoilahi->alasan_rembes,
                    $file,
                    $nominal,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/raimbes/list.mdh.php', $data);
        }

        // Action For Approval Raimburse
        if ($param1 == 'check') {
            // Raimbes Send From Admin To Employee
            $reply['id_rembes']     = $this->input->post('id_rembes', true);
            $reply['pesan']         = $this->input->post('pesan', true);
            $reply['date']          = date('Y-m-d');
            $this->db->insert('rerembes', $reply);

            $data['status_rembes']      = '1';
            $data['tanggal_disetujui']  = date('Y-m-d');
            $this->db->where('id', $reply['id_rembes'])->update('rembes', $data);
            $this->session->set_flashdata('flash', 'Raimbes Has been Approved');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Reject Action Raimburse
        if ($param1 == 'dismiss') {
            // Raimbes Reply
            $reply['id_rembes']     = $this->input->post('id_rembes', true);
            $reply['pesan']         = $this->input->post('pesan', true);
            $reply['date']          = date('Y-m-d');
            $this->db->insert('rerembes', $reply);

            $data['status_rembes']      = '2';
            $data['tanggal_disetujui']  = date('Y-m-d');
            $this->db->where('id', $reply['id_rembes'])->update('rembes', $data);
            $this->session->set_flashdata('flash', 'Raimbes Has been Rejected');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /* ========================== Employee Task Function =============== */

    function tugas($param1 = '', $param2 = '')
    {
        // Pending Task Parameter 
        if ($param1 == 'pending') {
            $data['page']       = "Pending Task";
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tanggal_buat'),
                $this->lang->line('deadline'),
                $this->lang->line('tugas') . ' ' . $this->lang->line('nama'),
                $this->lang->line('berkas'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            tugas.id,
                            tugas.tanggal_buat,
                            tugas.tanggal_progress,
                            tugas.tanggal_selesai,
                            tugas.title,
                            tugas.deadline,
                            tugas.status_selesai,
                            tugas.file,
                            pegawai.nama_akhir,
                            pegawai.nama_awal,
                                        ')
                ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                ->where('tugas.status_selesai', '0')
                ->get('tugas')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $file = '<a target="_blank" href="' . base_url() . 'mdhdesign/uploads/task/' . $technoilahi->file . '" class="btn btn-success"><i class="fa fa-download"></i></a>';
                $action = '
                    <a href="' . base_url('admin/task/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    <a href="' . base_url('belakang/tugas/delete/' . $technoilahi->id) . '" class="btn btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                    <a href="#edittask' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->tanggal_buat,
                    $technoilahi->deadline,
                    $technoilahi->title,
                    $file,
                    $action,
                ));
            }
            $data['mdh']        = $this->table->generate();
            $data['pegawai']    = $this->db->get('pegawai')->result();
            $data['task']       = $this->db->get('tugas')->result();
            return $this->belakanglib->theme('backend/task/pending.mdh.php', $data);
        }

        // Progress Task Parameters
        if ($param1 == 'progress') {
            $data['page']       = "Progress Task";
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tanggal_buat'),
                $this->lang->line('deadline'),
                $this->lang->line('tugas') . ' ' . $this->lang->line('nama'),
                $this->lang->line('berkas'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            tugas.id,
                            tugas.tanggal_buat,
                            tugas.tanggal_progress,
                            tugas.tanggal_selesai,
                            tugas.title,
                            tugas.deadline,
                            tugas.status_selesai,
                            tugas.file,
                            pegawai.nama_akhir,
                            pegawai.nama_awal,
                                        ')
                ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                ->where('tugas.status_selesai', '2')
                ->get('tugas')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $file = '<a target="_blank" href="' . base_url() . 'mdhdesign/uploads/task/' . $technoilahi->file . '" class="btn btn-success"><i class="fa fa-download"></i></a>';
                $action = '
                    <a href="' . base_url('admin/task/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->tanggal_buat,
                    $technoilahi->deadline,
                    $technoilahi->title,
                    $file,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            $data['pegawai']    = $this->db->get('pegawai')->result();
            $data['task']       = $this->db->get('tugas')->result();
            return $this->belakanglib->theme('backend/task/pending.mdh.php', $data);
        }

        // Complete Task Parameter
        if ($param1 == 'done') {
            $data['page']       = "Done Task";
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('tanggal_buat'),
                $this->lang->line('deadline'),
                $this->lang->line('tugas') . ' ' . $this->lang->line('nama'),
                $this->lang->line('berkas'),
                $this->lang->line('action')
            ));

            $query = $this->db
                ->select('
                            tugas.id,
                            tugas.tanggal_buat,
                            tugas.tanggal_progress,
                            tugas.tanggal_selesai,
                            tugas.title,
                            tugas.deadline,
                            tugas.status_selesai,
                            tugas.file,
                            pegawai.nama_akhir,
                            pegawai.nama_awal,
                                        ')
                ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                ->where('tugas.status_selesai', '1')
                ->get('tugas')->result();

            $no = 1;
            foreach ($query as $technoilahi) {
                $name   = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $file = '<a target="_blank" href="' . base_url() . 'mdhdesign/uploads/task/' . $technoilahi->file . '" class="btn btn-success"><i class="fa fa-download"></i></a>';
                $action = '
                    <a href="' . base_url('admin/task/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->tanggal_buat,
                    $technoilahi->deadline,
                    $technoilahi->title,
                    $file,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            $data['pegawai']    = $this->db->get('pegawai')->result();
            $data['task']       = $this->db->get('tugas')->result();
            return $this->belakanglib->theme('backend/task/pending.mdh.php', $data);
        }


        //  Add And Update Task Parameter
        if ($param1 == 'addtugas') {
            $this->form_validation->set_rules('id_pegawai', 'Employee Name', 'required');
            $this->form_validation->set_rules('tanggal_progress', 'Start Date', 'required');
            $this->form_validation->set_rules('deadline', 'Deadline', 'required');
            $this->form_validation->set_rules('title', 'Task Name', 'required');
            $this->form_validation->set_rules('isi', 'Task Description', 'required');
            if ($this->form_validation->run() == false) {
                return redirect($_SERVER['HTTP_REFERER']);

                // Add Task Condition
            } else if ($this->input->post('add') != null) {
                $data['title']           = $this->input->post('title', true);
                $data['id_pegawai']           = $this->input->post('id_pegawai', true);
                $data['tanggal_buat']        = date('Y-m-d');
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
                $this->session->set_flashdata('flash', 'Task Created Success');
                return redirect($_SERVER['HTTP_REFERER']);

                // Update Task Condition
            } else if ($this->input->post('edit') != null) {
                $data['title']              = $this->input->post('title', true);
                $data['id_pegawai']         = $this->input->post('id_pegawai', true);
                $data['tanggal_buat']       = date('Y-m-d');
                $data['tanggal_progress']   = $this->input->post('tanggal_progress', true);
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

                $this->db->where('id', $this->input->post('id'))->update('tugas', $data);
                $this->session->set_flashdata('flash', 'Task Updated Success');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Delete Task Condition
        if ($param1 == 'delete') {
            $this->db->where('id', $param2)->delete('tugas');
            $this->session->set_flashdata('flash', 'Task Deleted Success');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Detail Task Condition
        if ($param1 == 'detail') {
            $data['page']       = "Detail Task";
            $data['prog']       = $this->db
                ->where('id_tugas', $param2)
                ->order_by('id', 'DESC')
                ->get('progress')->result();
            $data['de']         = $this->db->where('id', $param2)->get('tugas')->row();
            return $this->belakanglib->theme('backend/task/detail.mdh.php', $data);
        }
    }

    /* ========================== Employee Payroll Function =============== */

    function payroll($param1 = '', $param2 = '')
    {
        // Allowance Salary Parameter
        if ($param1 == 'tunjangan') {
            $this->form_validation->set_rules('nama_tunjangan', 'Salary Allowance', 'required');
            $this->form_validation->set_rules('nominal', 'Nominal', 'required');
            $this->form_validation->set_rules('type', 'Allowance Type', 'required');
            // Get Data Condition
            if ($this->form_validation->run() == false) {
                $data['page']           = "Salary Allowance";
                $data['woke']            = $this->db->get('tunjangan')->result();
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample" class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('tunjangan') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('totally'),
                    $this->lang->line('tipe'),
                    $this->lang->line('action')
                ));

                $query = $this->db->get('tunjangan')->result();

                $no = 1;
                foreach ($query as $technoilahi) {
                    if ($technoilahi->type == 1) {
                        $type = 'Daily';
                    } else if ($technoilahi->type == 2) {
                        $type = 'Monthly';
                    } else if ($technoilahi->type == null) {
                        $type = '';
                    }
                    $number = number_format($technoilahi->nominal);
                    $action = '
                        <a href="#editTunjangan' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="' . base_url('belakang/payroll/delTunjangan/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_tunjangan,
                        $number,
                        $type,
                        $action,
                    ));
                }
                $data['mdh']    = $this->table->generate();
                return $this->belakanglib->theme('backend/payroll/tunjangan.mdh.php', $data);

                // Add Data Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_tunjangan']     = $this->input->post('nama_tunjangan', true);
                $data['nominal']            = $this->input->post('nominal', true);
                $data['type']               = $this->input->post('type', true);
                $this->db->insert('tunjangan', $data);
                $this->session->set_flashdata('flash', 'Salary Allowance Has been created');
                return redirect('admin/payroll/allowance');

                // Update Data Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_tunjangan']     = $this->input->post('nama_tunjangan', true);
                $data['nominal']            = $this->input->post('nominal', true);
                $data['type']               = $this->input->post('type', true);
                $this->db->where('id', $this->input->post('id'))->update('tunjangan', $data);
                $this->session->set_flashdata('flash', 'Salary Allowance Has been Updated');
                return redirect('admin/payroll/allowance');
            }
        }

        // Deduction Salary Parameter
        if ($param1 == 'potongan') {
            $this->form_validation->set_rules('nama_potongan', 'Dedcution Name', 'required');
            $this->form_validation->set_rules('nominal', 'Nominal', 'required');

            // Get Data Condition
            if ($this->form_validation->run() == false) {
                $data['page']               = "Salary Deduction";
                $data['woke']               = $this->db->get('potongan')->result();
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample" class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('potongan') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('totally'),
                    $this->lang->line('action')
                ));

                $query = $this->db->get('potongan')->result();

                $no = 1;
                foreach ($query as $technoilahi) {
                    $number = number_format($technoilahi->nominal);
                    $action = '
                        <a href="#editPotongan' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="' . base_url('belakang/payroll/delPotongan/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_potongan,
                        $number,
                        $action,
                    ));
                }
                $data['mdh']    = $this->table->generate();
                return $this->belakanglib->theme('backend/payroll/potongan.mdh.php', $data);

                // Add Deduction Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_potongan']      = $this->input->post('nama_potongan', true);
                $data['nominal']            = $this->input->post('nominal', true);
                $this->db->insert('potongan', $data);
                $this->session->set_flashdata('flash', 'Salary Desuction Has been created');
                return redirect('admin/payroll/deduction');

                // Update Deduction Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_potongan']      = $this->input->post('nama_potongan', true);
                $data['nominal']            = $this->input->post('nominal', true);
                $this->db->where('id', $this->input->post('id'))->update('potongan', $data);
                $this->session->set_flashdata('flash', 'Salary Desuction Has been created');
                return redirect('admin/payroll/deduction');
            }
        }

        // Allowance Delete Parameter
        if ($param1 == 'delTunjangan') {
            $this->db->where('id', $param2)->delete('tunjangan');
            $this->session->set_flashdata('flash', 'Allowance Has been deleted');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Deduction Delete Parameter
        if ($param1 == 'delPotongan') {
            $this->db->where('id', $param2)->delete('potongan');
            $this->session->set_flashdata('flash', 'Deduction Has been Deleted');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Payroll Generate Payslip
        if ($param1 == 'buat') {
            $this->form_validation->set_rules('id_department', 'Department Name', 'required');
            $this->form_validation->set_rules('id_designation', 'Designation Name', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('id_pegawai', 'Employee Name', 'required');
            // Page Seacrh Condition
            if ($this->form_validation->run() == false) {
                $data['page']       = "Make Payment";
                $data['mdh']        = '1';
                $data['company']    = $this->db->get('company')->row();
                $data['department'] = $this->db->get('department')->result();
                return $this->belakanglib->theme('backend/payroll/buat.mdh.php', $data);

                // Page Seacrh with Employee Salary Slip Condition 
            } else {
                $data['page']       = "Make Payment";
                $data['department'] = $this->db->get('department')->result();
                $data['employee']   = $this->db
                    ->where('id', $this->input->post('id_pegawai'))
                    ->get('pegawai')->result();
                $data['mdh']        = '2';
                $data['company']    = $this->db->get('company')->row();
                $data['tunjangan']  = $this->db->get('tunjangan')->result();
                $data['potongan']   = $this->db->get('potongan')->result();
                $date               = substr($this->input->post('date'), 0, 7);
                $id                 = $this->input->post('id_pegawai', true);
                $data['absensi']    = $this->Belakang_m->countAttendance($date, $id);
                $data['totalhour']  = $this->Belakang_m->countHours($date, $id);
                $data['totalLembur'] = $this->Belakang_m->countLembur($date, $id);
                $data['lembur']     = $this->db
                    ->where('date', date('Y-m-d'))
                    ->get('lembur')->result();
                return $this->belakanglib->theme('backend/payroll/buat.mdh.php', $data);
            }
        }

        // Get Designation From Department ID Parameter
        if ($param1 == 'pegawai') {
            $q = $this->db->where('id_designation', $param2)->get('pegawai')->result();
            $data = "<option value=''> - Choose Employee - </option>";
            foreach ($q as $value) {
                $data .= "<option value='" . $value->id . "'> " . $value->nama_awal . ".$value->nama_akhir." . " </option>";
            }
            echo $data;
        }

        // Add Payslipp  Generate
        if ($param1 == 'make') {
            $this->form_validation->set_rules('id_pegawai', 'Employee Name', 'required');
            $this->form_validation->set_rules('nominal_diberikan', 'Salary Grand Total', 'required');
            if ($this->form_validation->run() == false) {
                // Condition If Form Null
                return redirect($_SERVER['HTTP_REFERER']);
            } else {
                $data['id_pegawai']             = $this->input->post('id_pegawai', true);
                $data['potongan']               = $this->input->post('potongan', true);
                $data['pajak']                  = $this->input->post('pajak', true);
                $data['tunjangan']              = $this->input->post('tunjangan', true);
                $data['bonus']                  = $this->input->post('bonus', true);
                $data['lembur']                 = $this->input->post('lembur', true);
                $data['tanggal_gaji']           = $this->input->post('tanggal_gaji', true);
                $jumlah                         = $this->input->post('nominal_diberikan', true) + $this->input->post('bonus', true);
                $data['nominal_diberikan']      = $jumlah;
                $data['jam_dibuat']             = $this->input->post('jam_dibuat', true);
                $data['absen_bulanan']          = $this->input->post('absen_bulanan', true);
                $data['total_kerja']            = $this->input->post('total_kerja', true);
                $data['nomorik']                = $this->input->post('nomorik', true);
                $check = $this->db
                    ->where('id_pegawai', $this->input->post('id_pegawai'))
                    ->where('tanggal_gaji', $this->input->post('tanggal_gaji'))
                    ->get('gaji');
                if (count($check->result()) > 0) {
                    $this->session->set_flashdata('gagal', 'Sorry, Salary Slip Already exists');
                    return redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->db->insert('gaji', $data);
                    $this->session->set_flashdata('flash', 'Pay Slip Has been Created');
                    return redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }

        // Manage Employee Salary Parameter
        if ($param1 == 'manage') {
            // Form Validation for seacrh condition
            if ($this->input->post('cari') != null) {
                $this->form_validation->set_rules('id_department', 'Department Name', 'required');
                $this->form_validation->set_rules('id_designation', 'Designation Name', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                // Form Validation For Change Status Paid
            } else if ($this->input->post('ubah') != null) {
                $this->form_validation->set_rules('id', 'Salary Slip ID', 'required');
                $this->form_validation->set_rules('metode_kirim', 'Payment Method', 'required');
                $this->form_validation->set_rules('status_gaji', 'Status', 'required');
            }

            // Condition List Salary
            if ($this->form_validation->run() == false) {
                $data['page']           = "Manage Salary";
                $data['department']     = $this->db->get('department')->result();
                $data['designation']    = $this->db->get('designation')->result();
                $data['mdh']            = '';
                $data['salary']         = $this->db->get('gaji')->result();
                return $this->belakanglib->theme('backend/payroll/manage.mdh.php', $data);
            } else if ($this->input->post('cari') != null) {
                $data['page']           = "Manage Salary";
                $data['department']     = $this->db->get('department')->result();
                $data['designation']    = $this->db->get('designation')->result();
                $tanggal                = substr($this->input->post('date'), 0, 7);
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample" class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('tanggal'),
                    $this->lang->line('potongan'),
                    $this->lang->line('tunjangan'),
                    $this->lang->line('bonus'),
                    $this->lang->line('pajak'),
                    $this->lang->line('gaji'),
                    $this->lang->line('totally'),
                    $this->lang->line('action')
                ));

                $query = $this->db
                    ->select('
                        pegawai.nama_awal,
                        pegawai.nama_akhir,
                        pegawai.besar_gaji,
                        gaji.tanggal_gaji,
                        gaji.id,
                        gaji.potongan,
                        gaji.tunjangan,
                        gaji.pajak,
                        gaji.bonus,
                        gaji.nominal_diberikan,
                        gaji.status_gaji
                   ')
                    ->join('pegawai', 'pegawai.id=gaji.id_pegawai')
                    ->where('pegawai.id_department', $this->input->post('id_department'))
                    ->where('pegawai.id_designation', $this->input->post('id_designation'))
                    ->where('gaji.tanggal_gaji', $tanggal)
                    ->order_by('gaji.id', 'DESC')
                    ->get('gaji')->result();

                $no = 1;
                foreach ($query as $technoilahi) {
                    $nama       = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                    $potongan   = number_format($technoilahi->potongan);
                    $tunjangan  = number_format($technoilahi->tunjangan);
                    $bonus      = number_format($technoilahi->bonus);
                    $nominal    = number_format($technoilahi->nominal_diberikan);
                    $besargaji  = number_format($technoilahi->besar_gaji);
                    if ($technoilahi->status_gaji == '0') {
                        $action = '
                        <a href="#update' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-success"><i class="fa fa-money"></i></a>
                        <a href="' . base_url('admin/payroll/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
                    } else if ($technoilahi->status_gaji == '1') {
                        $action = '
                        <a href="' . base_url('admin/payroll/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
                    }

                    $this->table->add_row(array(
                        $no++,
                        $nama,
                        $technoilahi->tanggal_gaji,
                        $potongan,
                        $tunjangan,
                        $bonus,
                        $technoilahi->pajak,
                        $besargaji,
                        $nominal,
                        $action,
                    ));
                }
                $data['mdh']        = $this->table->generate();
                $data['salary']     = $query;

                return $this->belakanglib->theme('backend/payroll/manage.mdh.php', $data);
                // Condition For Change Status
            } else if ($this->input->post('ubah') != null) {
                $data['metode_kirim']       = $this->input->post('metode_kirim', true);
                $data['status_gaji']        = $this->input->post('status_gaji', true);

                $this->db->where('id', $this->input->post('id'))->update('gaji', $data);
                $this->session->set_flashdata('flash', 'Success');
                return redirect('admin/payroll/manage');
            }
        }

        // Salary Detail Parameter
        if ($param1 == 'detail') {
            $data['page']           = "Salary Detail";
            $data['gaji']           = $this->db
                ->select('
                                    pegawai.nama_awal,
                                    pegawai.nama_akhir,
                                    pegawai.besar_gaji,
                                    gaji.tanggal_gaji,
                                    gaji.id,
                                    gaji.potongan,
                                    gaji.tunjangan,
                                    gaji.pajak,
                                    gaji.bonus,
                                    gaji.nominal_diberikan,
                                    gaji.status_gaji,
                                    gaji.nomorik,
                                    pegawai.alamat,
                                    pegawai.ponsel,
                                    pegawai.email,
                                    gaji.total_kerja,
                                    gaji.absen_bulanan,
                                    gaji.lembur,
                                    gaji.jam_dibuat
                                    ')
                ->join('pegawai', 'pegawai.id=gaji.id_pegawai')
                ->where('gaji.id', $param2)
                ->get('gaji')->row();
            return $this->belakanglib->theme('backend/payroll/detail.mdh.php', $data);
        }

        // Print Salary Detail Parameter
        if ($param1 == 'print') {
            $data['page']           = "Print Salary";
            $data['sett']           = $this->db
                ->join('mobile', 'mobile.status=pengaturan.status')
                ->join('attendance', 'attendance.status=pengaturan.status')
                ->join('payroll', 'payroll.status=pengaturan.status')
                ->get('pengaturan')->row();
            $data['gaji']           = $this->db
                ->select('
                                    pegawai.nama_awal,
                                    pegawai.nama_akhir,
                                    pegawai.besar_gaji,
                                    gaji.tanggal_gaji,
                                    gaji.id,
                                    gaji.potongan,
                                    gaji.tunjangan,
                                    gaji.pajak,
                                    gaji.bonus,
                                    gaji.nominal_diberikan,
                                    gaji.status_gaji,
                                    gaji.nomorik,
                                    pegawai.alamat,
                                    pegawai.ponsel,
                                    pegawai.email,
                                    gaji.total_kerja,
                                    gaji.absen_bulanan,
                                    gaji.lembur,
                                    gaji.jam_dibuat
                                    ')
                ->join('pegawai', 'pegawai.id=gaji.id_pegawai')
                ->where('gaji.id', $param2)
                ->get('gaji')->row();
            return $this->load->view('backend/payroll/print.mdh.php', $data);
        }
    }

    /* ========================== Employee Reward Function =============== */

    function hadiah($param1 = '', $param2 = '')
    {

        // Reward Type Parameter

        if ($param1 == 'type') {
            $this->form_validation->set_rules('nama_type', 'Type Name', 'required');
            if ($this->form_validation->run() == false) {

                // Get List Table Condition
                $data['page']       = "Reward Type";

                $mdhTable   = array(
                    'table_open'            => '<table  class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('tipe') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action')
                ));

                $query = $this->db->get('typereward')->result();

                $no = 1;
                foreach ($query as $technoilahi) {
                    $action = '
                        <a href="#editType' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="' . base_url('belakang/hadiah/typeDel/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_type,
                        $action,
                    ));
                }
                $data['all']    = $this->db->get('typereward')->result();
                $data['mdh']    = $this->table->generate();
                return $this->belakanglib->theme('backend/reward/type.mdh.php', $data);

                // Add Reward Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_type']      = $this->input->post('nama_type', true);
                $this->db->insert('typereward', $data);
                $this->session->set_flashdata('flash', 'Reward Type Has been Added');
                return redirect('admin/reward/type');

                // Update Reward Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_type']      = $this->input->post('nama_type', true);
                $this->db->where('id', $this->input->post('id'))->update('typereward', $data);
                $this->session->set_flashdata('flash', 'Reward Type Has been Updated');
                return redirect('admin/reward/type');
            }
        }

        // Reward Giving Parameter
        if ($param1 == 'giving') {

            // Form Validation Includes
            $this->form_validation->set_rules('id_type', 'Reward Type', 'required');
            $this->form_validation->set_rules('id_pegawai', 'Pegawai Name', 'required');
            $this->form_validation->set_rules('deskripsi', 'Reward Description', 'required');
            if ($this->form_validation->run() == false) {

                // Get List Data Condition
                $data['page']       = "Giving List";
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample" class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('tipe') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('reward') . ' ' . $this->lang->line('tanggal'),
                    $this->lang->line('gambar') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action')
                ));

                // Query of get giving reward
                $query = $this->db
                    ->select('typereward.nama_type,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            reward.id,
                            reward.tanggal,
                            reward.image,
                            reward.deskripsi')
                    ->join('typereward', 'typereward.id=reward.id_type')
                    ->join('pegawai', 'pegawai.id=reward.id_pegawai')
                    ->order_by('reward.id', 'DESC')
                    ->get('reward')->result();

                $no = 1;

                // Looping for list data giving reward
                foreach ($query as $technoilahi) {
                    $image = '<img width="70px" src="' . base_url() . 'mdhdesign/uploads/reward/' . $technoilahi->image . '">';
                    $action = '
                        <a href="#editGiving' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="' . base_url('belakang/hadiah/delete/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_type,
                        $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir,
                        $technoilahi->tanggal,
                        $image,
                        $action,
                    ));
                }

                $data['mdh']    = $this->table->generate();
                $data['all']    = $this->db->get('reward')->result();
                $data['type']   = $this->db->get('typereward')->result();
                $data['pgw']    = $this->db->where('status', '1')->get('pegawai')->result();
                return $this->belakanglib->theme('backend/reward/list.mdh.php', $data);

                // Add Condition 
            } else if ($this->input->post('add') != null) {
                $data['id_type']        = $this->input->post('id_type', true);
                $data['id_pegawai']     = $this->input->post('id_pegawai', true);
                $data['tanggal']        = $this->input->post('tanggal', true);
                $data['deskripsi']      = $this->input->post('deskripsi', true);

                $mdh['upload_path']        = './mdhdesign/uploads/reward/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'pegawai-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $image = $this->upload->data();
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->insert('reward', $data);
                $this->session->set_flashdata('flash', 'Reward Has been added');
                return redirect('admin/reward/giving');

                // Update Condition
            } else if ($this->input->post('edit') != null) {
                $data['id_type']        = $this->input->post('id_type', true);
                $data['id_pegawai']     = $this->input->post('id_pegawai', true);
                $data['tanggal']        = $this->input->post('tanggal', true);
                $data['deskripsi']      = $this->input->post('deskripsi', true);

                $mdh['upload_path']        = './mdhdesign/uploads/reward/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'pegawai-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $image = $this->upload->data();

                        $check = $this->db->where('id', $this->input->post('id'))->get('reward')->row();
                        if ($check->image != null) {
                            $target = $mdh['upload_path'] . '/' . $check->image;
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
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->where('id', $this->input->post('id'))->update('reward', $data);
                $this->session->set_flashdata('flash', 'Reward Has been updated');
                return redirect('admin/reward/list');
            }
        }

        // Delete Reward Type Parameter
        if ($param1 == 'typeDel') {
            $this->db->where('id', $param2)->delete('typereward');
            $this->session->set_flashdata('flash', 'Type Reward Has been deleted');
            return redirect('admin/reward/type');
        }

        // Delete Reward Parameter
        if ($param1 == 'delete') {
            $this->db->where('id', $param2)->delete('reward');
            $this->session->set_flashdata('flash', 'Reward Has been deleted');
            return redirect('admin/reward/giving');
        }
    }

    /* ========================== Employee Notice Board Function =============== */

    function notice($param1 = '', $param2 = '')
    {

        // Notice Type Parameter
        if ($param1 == 'type') {

            // form validation includes
            $this->form_validation->set_rules('nama_type', 'Type Name', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Notice Type";

                // Table Library Includes
                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                // Colum Of Table
                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('tipe') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action')
                ));

                // Get Type 
                $query = $this->db->get('typepengumuman')->result();

                // Looping For List Data
                $no = 1;
                foreach ($query as $technoilahi) {
                    $action = '
                        <a href="#editType' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="' . base_url('belakang/notice/typeDelete/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_type,
                        $action,
                    ));
                }
                $data['mdh']    = $this->table->generate();
                $data['type']   = $this->db->get('typepengumuman')->result();
                return $this->belakanglib->theme('backend/notice/type.mdh.php', $data);

                // Add Type Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_type']      = $this->input->post('nama_type', true);
                $this->db->insert('typepengumuman', $data);
                $this->session->set_flashdata('flash', 'Notice Type Has been Added');
                return redirect('admin/notice/type');

                // Update Type Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_type']      = $this->input->post('nama_type', true);
                $this->db->where('id', $this->input->post('id'))->update('typepengumuman', $data);
                $this->session->set_flashdata('flash', 'Notice Type Has been Updated');
                return redirect('admin/notice/type');
            }
        }


        // Type Delete Parameter
        if ($param1 == 'typeDelete') {
            $this->db->where('id', $param2)->delete('typepengumuman');
            $this->session->set_flashdata('flash', 'Notice Type Has been Deleted');
            return redirect('admin/notice/type');
        }


        // Notice Board Parameter
        if ($param1 == 'list') {

            // Form Validation Includes
            $this->form_validation->set_rules('id_type', 'Type Name', 'required');
            $this->form_validation->set_rules('title', 'Notice Title', 'required');
            $this->form_validation->set_rules('isi', 'Description', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Notice List";

                // Table Library Includes
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample"  class="display table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                // Table Content
                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('pengumuman') . ' ' . $this->lang->line('title'),
                    $this->lang->line('pengumuman') . ' ' . $this->lang->line('gambar'),
                    $this->lang->line('pengumuman') . ' ' . $this->lang->line('tanggal'),
                    $this->lang->line('pengumuman') . ' ' . $this->lang->line('tipe'),
                    $this->lang->line('action')
                ));

                // Query Builder For Notice Board
                $query = $this->db
                    ->select('
                                typepengumuman.nama_type,
                                pengumuman.id,
                                pengumuman.isi,
                                pengumuman.title,
                                pengumuman.tanggal,
                                pengumuman.image
                                            ')
                    ->join('typepengumuman', 'typepengumuman.id=pengumuman.id_type')
                    ->get('pengumuman')->result();


                // Looping Data For Notice Board
                $no = 1;
                foreach ($query as $technoilahi) {
                    $image = '<img src="' . base_url() . 'mdhdesign/uploads/notice/' . $technoilahi->image . '" width="70px">';
                    $action = '
                        <a href="#noticeUpdate' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="' . base_url('belakang/notice/delete/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->title,
                        $image,
                        $technoilahi->tanggal,
                        $technoilahi->nama_type,
                        $action,
                    ));
                }
                $data['mdh']    = $this->table->generate();
                $data['type']   = $this->db->get('typepengumuman')->result();
                $data['all']    = $this->db->get('pengumuman')->result();
                return $this->belakanglib->theme('backend/notice/list.mdh.php', $data);

                // Add Notice Board Condition
            } else if ($this->input->post('add') != null) {
                $data['id_type']        = $this->input->post('id_type', true);
                $data['title']          = $this->input->post('title', true);
                $data['isi']            = $this->input->post('isi', true);
                $data['tanggal']        = date('Y-m-d');

                $mdh['upload_path']        = './mdhdesign/uploads/notice/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'website-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $image = $this->upload->data();

                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->insert('pengumuman', $data);
                $this->session->set_flashdata('flash', 'Notice Has been added');
                return redirect('admin/notice/list');

                // Update Notice Board Condition
            } else if ($this->input->post('edit') != null) {
                $data['id_type']        = $this->input->post('id_type', true);
                $data['title']          = $this->input->post('title', true);
                $data['isi']            = $this->input->post('isi', true);
                $data['tanggal']        = date('Y-m-d');

                $mdh['upload_path']        = './mdhdesign/uploads/notice/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'website-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);

                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $image = $this->upload->data();

                        $check = $this->db->where('id', $this->input->post('id'))->get('pengumuman')->row();
                        if ($check->image != null) {
                            $target = $mdh['upload_path'] . '/' . $check->image;
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
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->where('id', $this->input->post('id'))->update('pengumuman', $data);
                $this->session->set_flashdata('flash', 'Notice Has been updated');
                return redirect('admin/notice/list');
            }
        }

        // Delete Notice Board Parameter
        if ($param1 == 'delete') {
            $this->db->where('id', $param2)->delete('pengumuman');
            $this->session->set_flashdata('flash', 'Notice Has been Deleted');
            return redirect('admin/notice/list');
        }
    }


    /* ========================== Employee News Function =============== */

    function berita($param1 = '', $param2 = '')
    {

        // Add News Condition
        if ($param1 == 'add') {

            // Form Validation Includes
            $this->form_validation->set_rules('id_cat', 'Category Name', 'required');
            $this->form_validation->set_rules('title', 'News Title', 'required');
            $this->form_validation->set_rules('isi', 'Content News', 'required');
            if ($this->form_validation->run() == false) {

                // View Page Of Add News
                $data['page']        = "Add News";
                $data['cat']         = $this->db->get('catberita')->result();
                return $this->belakanglib->theme('backend/news/add.mdh.php', $data);

                // Add News Condition
            } else {
                $data['id_cat']     = $this->input->post('id_cat', true);
                $data['title']      = $this->input->post('title', true);
                $data['isi']        = $this->input->post('isi', true);
                $data['date']       = date('Y-m-d');
                $mdh['upload_path']        = './mdhdesign/uploads/berita/';
                $mdh['allowed_types']      = 'png|jpg|jpeg';
                $mdh['max_size']           = 2048;
                $mdh['file_name']          = 'berita-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);
                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {
                        $image = $this->upload->data();
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);

                        $this->image_lib->resize();
                        $data['image']      = $image['file_name'];
                    }
                }
                $this->db->insert('berita', $data);
                $this->session->set_flashdata('flash', 'News Added Successfull');
                return redirect('admin/news/list');
            }
        }


        // Update News Parameter
        if ($param1 == 'edit') {

            // Includes Form Validation
            $this->form_validation->set_rules('id_cat', 'Category Name', 'required');
            $this->form_validation->set_rules('title', 'News Title', 'required');
            $this->form_validation->set_rules('isi', 'Content News', 'required');
            if ($this->form_validation->run() == false) {

                // View Page Of News Update
                $data['page']        = "Update News";
                $data['cat']         = $this->db->get('catberita')->result();
                $data['de']          = $this->db->where('id', $param2)->get('berita')->row();
                return $this->belakanglib->theme('backend/news/edit.mdh.php', $data);

                // Update Condition
            } else {
                $data['id_cat']             = $this->input->post('id_cat', true);
                $data['title']              = $this->input->post('title', true);
                $data['isi']                = $this->input->post('isi', true);

                $mdh['upload_path']         = './mdhdesign/uploads/berita/';
                $mdh['allowed_types']       = 'png|jpg|jpeg';
                $mdh['max_size']            = 2048;
                $mdh['file_name']           = 'berita-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->upload->initialize($mdh);
                if (!empty($_FILES['image']['name'])) {
                    if ($this->upload->do_upload('image')) {

                        $chcek = $this->db->where('id', $param2)->update('berita')->row();
                        if ($chcek->image != null) {
                            $target = $mdh['upload_path'] . '/' . $chcek->image;
                            unlink($target);
                        }
                        $image = $this->upload->data();
                        $mdh['image_library']   = 'gd2';
                        $mdh['source_image']    = $mdh['upload_path'] . '/' . $image['file_name'];
                        $mdh['create_thumb']    = FALSE;
                        $mdh['maintain_ratio']  = FALSE;
                        $mdh['quality']         = '100%';
                        $mdh['new_image']       = $mdh['source_image'];
                        $this->load->library('image_lib', $mdh);
                        $this->image_lib->resize();
                        $data['image']          = $image['file_name'];
                    }
                }
                $this->db->where('id', $param2)->update('berita', $data);
                $this->session->set_flashdata('flash', 'News Added Successfull');
                return redirect('admin/news/list');
            }
        }

        // List News Parameters
        if ($param1 == 'list') {
            $data['page']       = "News List";

            // Table Library Inlcudes
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            // Table Content for list news
            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('berita') . ' ' . $this->lang->line('category'),
                $this->lang->line('berita') . ' ' . $this->lang->line('title'),
                $this->lang->line('berita') . ' ' . $this->lang->line('gambar'),
                $this->lang->line('action')
            ));

            // Query Content for news data
            $query = $this->db
                ->select('
                            catberita.nama_cat,
                            berita.id,
                            berita.isi,
                            berita.title,
                            berita.image
                                        ')
                ->join('catberita', 'catberita.id=berita.id_cat')
                ->get('berita')->result();

            // Looping data
            $no = 1;
            foreach ($query as $technoilahi) {
                $image = '<img width="78px" src="' . base_url() . 'mdhdesign/uploads/berita/' . $technoilahi->image . '">';
                $action = '
                    <a href="' . base_url('admin/news/edit/' . $technoilahi->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . base_url('belakang/berita/delete/' . $technoilahi->id) . '" class="btn btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
                $this->table->add_row(array(
                    $no++,
                    $technoilahi->nama_cat,
                    $technoilahi->title,
                    $image,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/news/list.mdh.php', $data);
        }

        // Delete News Parameter
        if ($param1 == 'delete') {
            $this->db->where('id', $param2)->delete('berita');
            $this->session->set_flashdata('flash', 'News Has been deleted');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Category List | Add & Update Parameter
        if ($param1 == 'category') {
            // Form Validation Includes
            $this->form_validation->set_rules('nama_cat', 'Category Name', 'required');

            // View Category Data Condition
            if ($this->form_validation->run() == false) {
                $data['page']           = "News Category";
                $data['type']           = $this->db->get('typecuti')->result();

                // Library table includes
                $mdhTable   = array(
                    'table_open'            => '<table class="table mb-none mdh-table">',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                // Data Content For News Category
                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    'No',
                    $this->lang->line('category') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('action'),
                ));

                // Get News Category Data
                $query = $this->db->get('catberita')->result();

                // Looping Category data
                $no = 1;
                foreach ($query as $technoilahi) {
                    $action = '
                    <a href="' . base_url('belakang/berita/delCategory/' . $technoilahi->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    <a href="#editType' . $technoilahi->id . '" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn btn-sm btn-warning"><i class="fa fa-warning"></i></a>';
                    $this->table->add_row(array(
                        $no++,
                        $technoilahi->nama_cat,
                        $action,
                    ));
                }
                $data['mdh']    = $this->table->generate();
                $data['all']    = $this->db->get('catberita')->result();
                return $this->belakanglib->theme('backend/news/category.mdh.php', $data);

                // Add Category News Condition
            } else if ($this->input->post('add') != null) {
                $data['nama_cat'] =  $this->input->post('nama_cat', true);
                $this->db->insert('catberita', $data);
                $this->session->set_flashdata('flash', 'Category News Success Added');
                return redirect('admin/news/category');

                // Update Category News Condition
            } else if ($this->input->post('edit') != null) {
                $data['nama_cat']  =  $this->input->post('nama_cat', true);
                $this->db->where('id', $this->input->post('id'))->update('catberita', $data);
                $this->session->set_flashdata('flash', 'Category News Success Updated');
                return redirect('admin/news/category');
            }
        }

        // Delete News Category Parameter
        if ($param1 == 'delCategory') {
            $this->db->where('id', $param2)->delete('catberita');
            $this->session->set_flashdata('flash', 'Category Has been deleted');
            return redirect('admin/news/category');
        }
    }

    /* ========================== Company About Sett Function =============== */

    function aboutCompany()
    {

        // Form Validation Includes
        $this->form_validation->set_rules('about_company', 'Vission And Mission', 'required');
        $this->form_validation->set_rules('descripsi_company', 'Company Description', 'required');

        // View Page Company Setting Condition
        if ($this->form_validation->run() == false) {
            $data['page']       = "About Company";
            $data['about']      = $this->db->get('company')->row();
            return $this->belakanglib->theme('backend/other/company.mdh.php', $data);

            // Update Company Setting Condition
        } else {
            $data['about_company']      = $this->input->post('about_company', true);
            $data['descripsi_company']      = $this->input->post('descripsi_company', true);

            $mdh['upload_path']        = './mdhdesign/uploads/system/';
            $mdh['allowed_types']      = 'png|jpg|jpeg';
            $mdh['max_size']           = 2048;
            $mdh['file_name']          = 'company-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->upload->initialize($mdh);

            // Upload Image Condition
            if (!empty($_FILES['image_company']['name'])) {
                if ($this->upload->do_upload('image_company')) {
                    $image = $this->upload->data();

                    $check = $this->db->get('company')->row();
                    if ($check->image_company != null) {
                        $target = $mdh['upload_path'] . '/' . $check->image_company;
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
                    $data['image_company']      = $image['file_name'];
                }
            }
            $this->db->update('company', $data);
            $this->session->set_flashdata('flash', 'Company Has been updated');
            return redirect('admin/company');
        }
    }

    /* ========================== Admin Notification Function =============== */

    function notification($param1 = '', $param2 = '')
    {

        // List Data Condition
        if ($param1 == 'list') {
            $data['page']       = "Notification";

            // Library Table Includes
            $mdhTable   = array(
                'table_open'            => '<table id="basicExample"  class="display table">',

                'thead_open'            => '<thead>',
                'thead_close'           => '</thead>',

                'heading_row_start'     => '<tr>',
                'heading_row_end'       => '</tr>',
                'heading_cell_start'    => '<th>',
                'heading_cell_end'      => '</th>',

                'tbody_open'            => '<tbody>',
                'tbody_close'           => '</tbody>',

                'row_start'             => '<tr>',
                'row_end'               => '</tr>',
                'cell_start'            => '<td>',
                'cell_end'              => '</td>',

                'row_alt_start'         => '<tr>',
                'row_alt_end'           => '</tr>',
                'cell_alt_start'        => '<td>',
                'cell_alt_end'          => '</td>',

                'table_close'           => '</table>'
            );

            // Table Content for Notification data
            $this->table->set_template($mdhTable);
            $this->table->set_heading(array(
                'No',
                $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                $this->lang->line('pengumuman') . ' ' . $this->lang->line('title'),
                $this->lang->line('pengumuman'),
                $this->lang->line('pengumuman') . ' ' . $this->lang->line('tanggal'),
                $this->lang->line('action')
            ));

            // Query Builder For Get New Notification
            $query = $this->db
                ->select('pegawai.nama_awal,
                        pegawai.nama_akhir,
                        notifadm.title,
                        notifadm.tanggal_notifikasi,
                        notifadm.isi,
                        notifadm.status,
                        notifadm.id')
                ->join('pegawai', 'pegawai.id=notifadm.id_pegawai')
                ->where('notifadm.status', '0')->get('notifadm')->result();

            // Looping Data For Notification
            $no = 1;
            foreach ($query as $technoilahi) {
                $action = '
                    <a href="' . base_url('belakang/notification/checkone/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>';
                $name = $technoilahi->nama_awal . ' ' . $technoilahi->nama_akhir;
                $this->table->add_row(array(
                    $no++,
                    $name,
                    $technoilahi->title,
                    $technoilahi->isi,
                    $technoilahi->tanggal_notifikasi,
                    $action,
                ));
            }
            $data['mdh']    = $this->table->generate();
            return $this->belakanglib->theme('backend/other/notif.mdh.php', $data);
        }

        // Bulk Check Parameter
        if ($param1 == 'checkall') {
            $data['status'] = '1';
            $this->db->where('status', '0')->update('notifadm', $data);
            $this->session->set_flashdata('flash', 'Notification Has been readed');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        // Check One Parameter
        if ($param1 == 'checkone') {
            $data['status'] = '1';
            $this->db->where('id', $param2)->update('notifadm', $data);
            $this->session->set_flashdata('flash', 'Notification Has been readed');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /* ========================== All Data Reports Function =============== */


    function laporan($param1 = '', $param2 = '')
    {

        // Attendance Reports Parameters
        if ($param1 == 'absensi') {

            // Form Validation Seacrh Data Includes
            $this->form_validation->set_rules('tahun', 'Year', 'required');
            $this->form_validation->set_rules('bulan', 'Month', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Attendance Month Reports";
                // Calendar Of Reports
                $data['kalendar']   = CAL_GREGORIAN;
                $data['bulan']      = date('m');
                $data['tahun']      = date('Y');
                $data['hari']       = cal_days_in_month($data['kalendar'], $data['bulan'], $data['tahun']);
                $data['pegawai']    = $this->db->order_by('nama_awal', 'ASC')->get('pegawai')->result();
                $data['department'] = $this->db->get('department')->result();
                return $this->belakanglib->theme('backend/laporan/absensi.mdh.php', $data);
            } else {
                $data['page']       = "Attendance Month Reports";

                $data['kalendar']   = CAL_GREGORIAN;
                $data['bulan']      = $this->input->post('bulan');
                $data['tahun']      = $this->input->post('tahun');
                $data['hari']       = cal_days_in_month($data['kalendar'], $data['bulan'], $data['tahun']);
                $data['department'] = $this->db->get('department')->result();

                // Get Variabel Condition When already id_department or exist
                // Have id_department condition
                if ($this->input->post('id_department') != null) {
                    $query =  $this->db
                        ->where('id_department', $this->input->post('id_department'))
                        ->order_by('nama_awal', 'ASC')
                        ->get('pegawai')->result();
                    // Exist id_department condition
                } else {
                    $query = $this->db
                        ->order_by('nama_awal', 'ASC')
                        ->get('pegawai')->result();
                }
                $data['pegawai']    = $query;
                $this->session->set_flashdata('flash', 'Seacrh Successfull');
                return $this->belakanglib->theme('backend/laporan/absensi.mdh.php', $data);
            }
        }


        // Today Attendance Reports Parameter
        if ($param1 == 'absensiharian') {
            $this->form_validation->set_rules('date', 'Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Daily Attendance";

                $data['department'] = $this->db->get('department')->result();
                $data['tanggal']    = date('Y-m-d');
                $data['pegawai']    = $this->db
                    ->order_by('nama_awal', 'ASC')
                    ->get('pegawai')->result();

                return $this->belakanglib->theme('backend/laporan/absensi_harian.mdh.php', $data);
            } else {
                $data['page']       = "Daily Attendance";
                $data['department'] = $this->db->get('department')->result();
                if ($this->input->post('id_department') != null) {
                    $query = $this->db
                        ->where('id_department', $this->input->post('id_department'))
                        ->order_by('nama_awal', 'ASC')
                        ->get('pegawai')->result();
                } else {
                    $query = $this->db
                        ->order_by('nama_awal', 'ASC')
                        ->get('pegawai')->result();
                }
                $data['tanggal']    = $this->input->post('date');
                $data['pegawai']    = $query;
                $this->session->set_flashdata('flash', 'Seacrh Successfull');
                return $this->belakanglib->theme('backend/laporan/absensi_harian.mdh.php', $data);
            }
        }

        // Totally Attendance Reports For Employee Individual
        if ($param1 == 'absensitotal') {
            $this->form_validation->set_rules('start', 'Start Date', 'required');
            $this->form_validation->set_rules('end', 'End Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']           = "Totally Attendance";
                $data['department']     = $this->db->get('department')->result();

                $data['pegawai']        = $this->db
                    ->order_by('nama_awal', 'DESC')
                    ->get('pegawai')->result();
                return $this->belakanglib->theme('backend/laporan/totally.mdh.php', $data);
            } else {
                $data['page']           = "Totally Attendance";
                $data['department']     = $this->db->get('department')->result();
                if ($this->input->post('id_department') != null) {
                    $query        = $this->db
                        ->where('id_department', $this->input->post('id_department'))
                        ->order_by('nama_awal', 'DESC')
                        ->get('pegawai')->result();
                } else {
                    $query    = $this->db
                        ->order_by('nama_awal', 'DESC')
                        ->get('pegawai')->result();
                }

                $data['pegawai']        = $query;
                return $this->belakanglib->theme('backend/laporan/totally.mdh.php', $data);
            }
        }


        // Payroll Reports Parameters
        if ($param1 == 'gaji') {
            $this->form_validation->set_rules('awal', 'First Date', 'required');
            $this->form_validation->set_rules('last', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Salary Reports";
                return $this->belakanglib->theme('backend/laporan/absensi.mdh.php', $data);
            } else {
                $data['page']       = "Salary Reports";
                return $this->belakanglib->theme('backend/laporan/absensi.mdh.php', $data);
            }
        }

        // Leave Reports Parameters
        if ($param1 == 'cuti') {
            // Form validation includes
            $this->form_validation->set_rules('start', 'First Date', 'required');
            $this->form_validation->set_rules('end', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Laporan Cuti";
                $data['department'] = $this->db->get('department')->result();
                $data['cuti']       = $this->db
                    ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                    ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->get('cuti')->result();
                $data['approve']    = $this->db
                    ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                    ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.status', '1')
                    ->get('cuti')->result();
                $data['pending']    = $this->db
                    ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                    ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.status', '0')
                    ->get('cuti')->result();
                $data['reject']     = $this->db
                    ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                    ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                    ->join('typecuti', 'typecuti.id=cuti.id_type')
                    ->where('cuti.status', '2')
                    ->get('cuti')->result();
                return $this->belakanglib->theme('backend/laporan/cuti.mdh.php', $data);
            } else {
                $data['page']       = "Laporan Cuti";
                $data['department'] = $this->db->get('department')->result();
                if ($this->input->post('id_department') != null) {
                    $data['cuti']       = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                    $data['approve']    = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.status', '1')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                    $data['pending']    = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.status', '0')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                    $data['reject']     = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.status', '2')
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                } else {
                    $data['cuti']       = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                    $data['approve']    = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.status', '1')
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                    $data['pending']    = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.status', '0')
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                    $data['reject']     = $this->db
                        ->select('
                            cuti.id,
                            cuti.alasan,
                            cuti.isi,
                            cuti.tanggal_izin,
                            cuti.tanggal_cuti,
                            cuti.sampai_tanggal,
                            cuti.status,
                            pegawai.nama_awal,
                            pegawai.nama_akhir,
                            typecuti.nama_type,
                                        ')
                        ->join('pegawai', 'pegawai.id=cuti.id_pegawai')
                        ->join('typecuti', 'typecuti.id=cuti.id_type')
                        ->where('cuti.status', '2')
                        ->where('cuti.tanggal_izin BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->get('cuti')->result();
                }
                return $this->belakanglib->theme('backend/laporan/cuti.mdh.php', $data);
            }
        }

        // Task Reports Parameters
        if ($param1 == 'tugas') {
            $this->form_validation->set_rules('start', 'First Date', 'required');
            $this->form_validation->set_rules('end', 'Last Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']       = "Task Reports";
                $data['department']      = $this->db->get('department')->result();
                $data['task']       = $this->db
                    ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                    ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                    ->order_by('tugas.id', 'DESC')
                    ->get('tugas')->result();
                $data['done']       = $this->db
                    ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                    ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                    ->where('tugas.status_selesai', '1')
                    ->order_by('tugas.id', 'DESC')
                    ->get('tugas')->result();
                $data['prog']       = $this->db
                    ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                    ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                    ->where('tugas.status_selesai', '2')
                    ->order_by('tugas.id', 'DESC')
                    ->get('tugas')->result();
                $data['pending']       = $this->db
                    ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                    ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                    ->where('tugas.status_selesai', '0')
                    ->order_by('tugas.id', 'DESC')
                    ->get('tugas')->result();
                return $this->belakanglib->theme('backend/laporan/tugas.mdh.php', $data);
            } else {
                $data['page']       = "Task Reports";
                $data['department'] = $this->db->get('department')->result();
                if ($this->input->post('id_department') != null) {
                    $data['task']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                    $data['done']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('tugas.status_selesai', '1')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                    $data['prog']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('tugas.status_selesai', '2')->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                    $data['pending']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('tugas.status_selesai', '0')
                        ->where('pegawai.id_department', $this->input->post('id_department'))
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                } else {
                    $data['task']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                    $data['done']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('tugas.status_selesai', '1')
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                    $data['prog']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('tugas.status_selesai', '2')
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                    $data['pending']       = $this->db
                        ->select('
                                                tugas.id,
                                                tugas.tanggal_buat,
                                                tugas.tanggal_progress,
                                                tugas.tanggal_selesai,
                                                tugas.title,
                                                tugas.deadline,
                                                tugas.status_selesai,
                                                tugas.file,
                                                pegawai.nama_akhir,
                                                pegawai.nama_awal,')
                        ->join('pegawai', 'pegawai.id=tugas.id_pegawai')
                        ->where('tugas.status_selesai', '0')
                        ->where('tugas.tanggal_buat BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                        ->order_by('tugas.id', 'DESC')
                        ->get('tugas')->result();
                }
                return $this->belakanglib->theme('backend/laporan/tugas.mdh.php', $data);
            }
        }

        // Overtime Reports Parameters
        if ($param1 == 'lembur') {
            $this->form_validation->set_rules('start', 'Start Date', 'required');
            $this->form_validation->set_rules('end', 'End Date', 'required');
            if ($this->form_validation->run() == false) {
                $data['page']               = "Overtime Reports";
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample"  class="display table" >',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('start') . ' ' . $this->lang->line('time'),
                    $this->lang->line('end') . ' ' . $this->lang->line('time'),
                    $this->lang->line('total_overtime_hours'),
                    $this->lang->line('action')
                ));

                $query        = $this->db
                    ->select('
                                pegawai.nama_awal,
                                pegawai.nama_akhir,
                                lembur.jam_mulai,
                                lembur.id,
                                lembur.sampai_jam,
                                lembur.jumlah_jam
                                ')
                    ->join('pegawai', 'pegawai.id=lembur.id_pegawai')
                    ->order_by('lembur.id', 'DESC')
                    ->get('lembur')->result();

                foreach ($query as $technoilahi) {
                    $name   = $technoilahi->nama_awal . '' . $technoilahi->nama_akhir;
                    $action = '<a href="' . base_url('admin/overtime/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                    $this->table->add_row(array(
                        $name,
                        $technoilahi->jam_mulai,
                        $technoilahi->sampai_jam,
                        $technoilahi->jumlah_jam,
                        $action
                    ));
                }
                $data['mdh']    = $this->table->generate();
                return $this->belakanglib->theme('backend/laporan/lembur.mdh.php', $data);
            } else {
                $mdhTable   = array(
                    'table_open'            => '<table id="basicExample"  class="display table" >',

                    'thead_open'            => '<thead>',
                    'thead_close'           => '</thead>',

                    'heading_row_start'     => '<tr>',
                    'heading_row_end'       => '</tr>',
                    'heading_cell_start'    => '<th>',
                    'heading_cell_end'      => '</th>',

                    'tbody_open'            => '<tbody>',
                    'tbody_close'           => '</tbody>',

                    'row_start'             => '<tr>',
                    'row_end'               => '</tr>',
                    'cell_start'            => '<td>',
                    'cell_end'              => '</td>',

                    'row_alt_start'         => '<tr>',
                    'row_alt_end'           => '</tr>',
                    'cell_alt_start'        => '<td>',
                    'cell_alt_end'          => '</td>',

                    'table_close'           => '</table>'
                );

                $this->table->set_template($mdhTable);
                $this->table->set_heading(array(
                    $this->lang->line('pegawai') . ' ' . $this->lang->line('nama'),
                    $this->lang->line('start') . ' ' . $this->lang->line('time'),
                    $this->lang->line('end') . ' ' . $this->lang->line('time'),
                    $this->lang->line('total_overtime_hours'),
                    $this->lang->line('action')
                ));

                $query        = $this->db
                    ->select('
                                pegawai.nama_awal,
                                pegawai.nama_akhir,
                                lembur.jam_mulai,
                                lembur.id,
                                lembur.sampai_jam,
                                lembur.jumlah_jam,
                                ')
                    ->join('pegawai', 'pegawai.id=lembur.id_pegawai')
                    ->where('lembur.date BETWEEN "' . $this->input->post('start') . '" AND "' . $this->input->post('end') . '"')
                    ->order_by('lembur.id', 'DESC')
                    ->get('lembur')->result();

                foreach ($query as $technoilahi) {
                    $name   = $technoilahi->nama_awal . '' . $technoilahi->nama_akhir;
                    $action = '<a href="' . base_url('admin/overtime/detail/' . $technoilahi->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                    $this->table->add_row(array(
                        $name,
                        $technoilahi->jam_mulai,
                        $technoilahi->sampai_jam,
                        $technoilahi->jumlah_jam,
                        $action
                    ));
                }
                $data['mdh']    = $this->table->generate();
                return $this->backendlib->theme('backend/laporan/lembur.mdh.php', $data);
            }
        }
    }

    /* ======================== Logout Function ====================== */
    function logout()
    {
        $this->session->userdata('id');
        $this->session->userdata('status');
        $this->session->userdata('role');
        session_destroy();
        return redirect('admin/login');
    }

    /* ======================== Admin Index Redirect ====================== */
    function index()
    {
        return redirect('admin/login');
    }
}
