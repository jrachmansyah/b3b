<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'belakang';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['scan']              = 'mobile/scan';


// Admin Route
$route['admin/login']                           = 'belakang/login';
$route['admin/logout']                          = 'belakang/logout';
$route['admin/dashboard']                       = 'belakang/dashboard';
$route['admin/notif']                           = 'belakang/notification/list';
$route['admin/company']                         = 'belakang/aboutCompany';

// Setting Route Admin
// Admin Route
$route['admin/admin']                       = 'belakang/pengaturan/admin';
$route['admin/delAdmin/(:num)']             = 'belakang/pengaturan/delAdmin/$1';

// Slider Route
$route['admin/slider']                      = 'belakang/pengaturan/slider';
$route['admin/slider/(:num)']               = 'belakang/pengaturan/delSlider/$1';

// General Settings
$route['admin/settings/general']            = 'belakang/pengaturan/general';

// Mobile Settings
$route['admin/settings/mobile']             = 'belakang/pengaturan/mobile';

// Attendance Settings
$route['admin/settings/attendance']         = 'belakang/pengaturan/absensi';

// Payroll Settings
$route['admin/settings/payroll']            = 'belakang/pengaturan/gaji';

// Company Devision Route
// Department
$route['admin/department']                  = 'belakang/company/department';
$route['admin/department/(:num)']           = 'belakang/company/delDepartment/$1';

// Designation
$route['admin/designation']                 = 'belakang/company/designation';
$route['admin/designation/(:num)']          = 'belakang/company/delDesignation/$1';

// Employee Route
$route['admin/employee/add']                = 'belakang/pegawai/add';
$route['admin/employee/list']               = 'belakang/pegawai/list';
$route['admin/employee/edit/(:num)']        = 'belakang/pegawai/edit/$1';
$route['admin/employee/block/(:num)']       = 'belakang/pegawai/actionOut/$1';
$route['admin/employee/block']              = 'belakang/pegawai/out';
$route['admin/employee/active/(:num)']      = 'belakang/pegawai/actionBack/$1';
$route['admin/employee/detail/(:num)/(:any)'] = 'belakang/pegawai/detail/$1/$2';

// Leave Route
$route['admin/leave/type']                  = 'belakang/leave/type';
$route['admin/leave/delete/(:num)']         = 'belakang/leave/delete/$1';
$route['admin/leave/approve']               = 'belakang/leave/approved';
$route['admin/leave/pending']               = 'belakang/leave/pending';
$route['admin/leave/rejected']              = 'belakang/leave/rejected';

// Raimbes Route
$route['admin/raimbes/pending']             = 'belakang/rembes/pending';
$route['admin/raimbes/approved']            = 'belakang/rembes/approved';
$route['admin/raimbes/dismiss']             = 'belakang/rembes/notApproved';

// Task Route
$route['admin/task/pending']                = 'belakang/tugas/pending';
$route['admin/task/progress']               = 'belakang/tugas/progress';
$route['admin/task/done']                   = 'belakang/tugas/done';
$route['admin/task/detail/(:num)']          = 'belakang/tugas/detail/$1';

// Reward Route
$route['admin/reward/type']                 = 'belakang/hadiah/type';
$route['admin/reward/giving']               = 'belakang/hadiah/giving';

// Notice Route
$route['admin/notice/type']                 = 'belakang/notice/type';
$route['admin/notice/list']                 = 'belakang/notice/list';

// News Route
$route['admin/news/category']               = 'belakang/berita/category';
$route['admin/news/add']                    = 'belakang/berita/add';
$route['admin/news/list']                   = 'belakang/berita/list';
$route['admin/news/edit/(:num)']            = 'belakang/berita/edit/$1';

// Attendance Route
$route['admin/attendance/today']            = 'belakang/absensi/today';
$route['admin/attendance/overtime']         = 'belakang/absensi/overtime';
$route['admin/overtime/detail/(:num)']      = 'belakang/absensi/overtimeDetail/$1';
$route['admin/attendance/track/(:num)']     = 'belakang/absensi/tracker/$1';
$route['admin/attendance/map']              = 'belakang/absensi/mapTrack';


// Salary Admin Route
$route['admin/payroll/allowance']           = 'belakang/payroll/tunjangan';
$route['admin/payroll/deduction']           = 'belakang/payroll/potongan';
$route['admin/payroll/make']                = 'belakang/payroll/buat';
$route['admin/payroll/manage']              = 'belakang/payroll/manage';
$route['admin/payroll/detail/(:num)']       = 'belakang/payroll/detail/$1';
$route['admin/payroll/print/(:num)']        = 'belakang/payroll/print/$1';

// Reports Route
$route['admin/reports/attendance']          = 'belakang/laporan/absensi';
$route['admin/reports/attendance_daily']    = 'belakang/laporan/absensiharian';
$route['admin/reports/attendance_total']    = 'belakang/laporan/absensitotal';
$route['admin/reports/overtime']            = 'belakang/laporan/lembur';

$route['admin/reports/salary']              = 'belakang/laporan/gaji';
$route['admin/reports/leave']               = 'belakang/laporan/cuti';
$route['admin/reports/task']                = 'belakang/laporan/tugas';



// Mobile Route
$route['mobile']                                = 'mobile/index';
// Leave Employee
$route['leave/list']                            = 'mobile/leave/list';

// Task Employee 
$route['task/list']                             = 'mobile/task/list';
$route['task/detail/(:num)/(:any)']             = 'mobile/task/detail/$1/$2';

// Raimbes Employee
$route['raimbes/list']                          = 'mobile/raimbes/list';
$route['raimbes/detail/(:num)/(:any)']          = 'mobile/raimbes/detail/$1/$2';

// Account settings
$route['account']                               = 'mobile/account/index';

// Attendance Employee
$route['attendance']                            = 'mobile/attendance/view';
$route['attendance/tracker/(:num)/(:any)']      = 'mobile/attendance/tracker/$1/$2';

// Maps Route
$route['map/today']                             = 'mobile/maps/today';

// News Route
$route['news/list']                             = 'mobile/news/list';
$route['news/detail/(:num)/(:any)']             = 'mobile/news/detail/$1/$2';

// Notice Route
$route['notice/list']                           = 'mobile/notice/list';
$route['notice/detail/(:num)/(:any)']           = 'mobile/notice/detail/$1/$2';

// Gift Route
$route['award/list']                            = 'mobile/award/list';
$route['award/detail/(:num)/(:any)']            = 'mobile/award/detail/$1/$2';

// Notification
$route['notif/list']                            = 'mobile/notif/list';
$route['notif/detail/(:num)/(:any)']            = 'mobile/notif/detail/$1/$2';

// More Route
$route['log']                                   = 'mobile/more/log';
$route['company']                               = 'mobile/more/company';
$route['app']                                   = 'mobile/more/app';

// Overtime
$route['overtime/list']                         = 'mobile/overtime/list';
$route['overtime/detail/(:num)']                = 'mobile/overtime/detail/$1';
$route['overtime/view/(:any)/(:num)']           = 'mobile/overtime/view/$1/$2';

// Salary Route
$route['salary/list']                           = 'mobile/salary/list';
$route['salary/detail/(:num)']                  = 'mobile/salary/detail/$1';


// Reports Route
$route['reports/attendance']                    = 'mobile/laporan/absensi';
$route['reports/leave']                         = 'mobile/laporan/cuti';
$route['reports/task']                          = 'mobile/laporan/tugas';
$route['reports/salary']                        = 'mobile/laporan/gaji';
$route['reports/overtime']                      = 'mobile/laporan/lembur';
