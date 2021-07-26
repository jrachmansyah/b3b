<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title" style="color: white;">Main Menu</div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li <?= $page == "Dashboard" ? 'class="nav-active"' : null; ?>>
                        <a href="<?= base_url('admin/dashboard'); ?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span><?= $this->lang->line('dashboard'); ?></span>
                        </a>
                    </li>
                    <li class="nav-parent <?= $page == "Admin Data" || $page == "Slider Mobile"
                                                || $page == "General Settings" || $page == "Attendance Settings"
                                                || $page == "Payroll Settings" || $page == "Mobile Settings"
                                                ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span> <?= $this->lang->line('pengaturan'); ?> </span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/settings/general'); ?>"> <?= $this->lang->line('general'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/settings/mobile'); ?>"> Mobile  </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/settings/attendance'); ?>"> <?= $this->lang->line('absensi'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/settings/payroll'); ?>"> <?= $this->lang->line('gaji'); ?> </a>
                            </li>
                            <li <?= $page == "Slider Mobile" ? 'class="nav-active"' : null; ?>>
                                <a href="<?= base_url('admin/slider'); ?>"> <?= $this->lang->line('slider'); ?> </a>
                            </li>
                            <li <?= $page == "Admin Data" ? 'class="nav-active"' : null; ?>>
                                <a href="<?= base_url('admin/admin'); ?>"> <?= $this->lang->line('admin'); ?> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent <?= $page == "Department List" || $page == "Designation" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                            <span><?= $this->lang->line('company'); ?> </span>
                        </a>
                        <ul class="nav nav-children">
                            <li <?= $page == "Department List" ? 'class="nav-active"' : null; ?>>
                                <a href="<?= base_url('admin/department'); ?>"> <?= $this->lang->line('department'); ?> </a>
                            </li>
                            <li <?= $page == "Designation" ? 'class="nav-active"' : null; ?>>
                                <a href="<?= base_url('admin/designation'); ?>"> <?= $this->lang->line('designation'); ?> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent <?= $page == "Add Employee" || $page == "Edit Employee" || $page == "Employee Out"
                                                || $page == "Employee List" || $page == "Employee Detail" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span><?= $this->lang->line('pegawai'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li <?= $page == "Employee List" ? 'class="nav-active"' : null; ?>>
                                <a href="<?= base_url('admin/employee/list'); ?>"> <?= $this->lang->line('list'); ?> </a>
                            </li>
                            <li <?= $page == "Add Employee" ? 'class="nav-active"' : null; ?>>
                                <a href="<?= base_url('admin/employee/add'); ?>"> <?= $this->lang->line('tambah'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/employee/block'); ?>"> <?= $this->lang->line('keluar'); ?> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent <?= $page == "Today Attendance" || $page == "Overtime" || $page == "Map Tracker"
                                                || $page == "Map Tracker Today" || $page == "Detail Overtime" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span><?= $this->lang->line('absensi'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/attendance/today'); ?>"> <?= $this->lang->line('today'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/attendance/overtime'); ?>"> <?= $this->lang->line('lembur'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/attendance/map'); ?>"> <?= $this->lang->line('map_track'); ?> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent <?= $page == "Leave Type"
                                                || $page == "Leave Approved" || $page == "Leave Pending"
                                                || $page == "Leave Rejected" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-plane" aria-hidden="true"></i>
                            <span><?= $this->lang->line('cuti'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/leave/type'); ?>"> <?= $this->lang->line('tipe'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/leave/approve'); ?>"> <?= $this->lang->line('approved'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/leave/pending'); ?>"> <?= $this->lang->line('pending'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/leave/rejected'); ?>"> <?= $this->lang->line('ditolak'); ?> </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-parent <?= $page == "Pending Raimbes" || $page == "Approval Raimbes" || $page == "Rejected Raimbes" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-usd" aria-hidden="true"></i>
                            <span><?= $this->lang->line('rembes'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/raimbes/pending'); ?>"> <?= $this->lang->line('pending'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/raimbes/approved'); ?>"> <?= $this->lang->line('approved'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/raimbes/dismiss'); ?>"> <?= $this->lang->line('ditolak'); ?> </a>
                            </li>
                        </ul>
                    </li> -->

                    <!-- <li class="nav-parent <?= $page == "Pending Task" || $page == "Detail Task"
                                                || $page == "Done Task"
                                                || $page == "Progress Task" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <span><?= $this->lang->line('tugas'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/task/pending'); ?>"> <?= $this->lang->line('pending'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/task/progress'); ?>"> <?= $this->lang->line('diproses'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/task/done'); ?>"> <?= $this->lang->line('selesai'); ?> </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-parent  <?= $page == "Salary Allowance" || $page == "Salary Deduction"
                                                || $page == "Make Payment" || $page == "Manage Salary"
                                                || $page == "Salary Detail" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span><?= $this->lang->line('gaji'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/payroll/allowance'); ?>"> <?= $this->lang->line('tunjangan'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/payroll/deduction'); ?>"> <?= $this->lang->line('potongan'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/payroll/make'); ?>"> <?= $this->lang->line('buat'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/payroll/manage'); ?>">
                                    <?= $this->lang->line('kelola_gaji'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-parent <?= $page == "Giving List" || $page == "Reward Type" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                            <span><?= $this->lang->line('reward'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/reward/type'); ?>"> <?= $this->lang->line('tipe'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/reward/giving'); ?>"> <?= $this->lang->line('berikan'); ?> </a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-parent <?= $page == "Notice Type" || $page == "Notice List" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                            <span><?= $this->lang->line('pengumuman'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/notice/type'); ?>"> <?= $this->lang->line('tipe'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/notice/list'); ?>"> <?= $this->lang->line('list'); ?> </a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-parent <?= $page == "News Category" || $page == "News List" || $page == "Add News" || $page == "Update News" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span><?= $this->lang->line('berita'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/news/category'); ?>"> <?= $this->lang->line('category'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/news/add'); ?>"> <?= $this->lang->line('tambah'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/news/list'); ?>"> <?= $this->lang->line('list'); ?></a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-parent <?= $page == "Attendance Month Reports" || $page == "Attendance Daily Reports" || $page == "Attendance Totally Reports"
                                                || $page == "Daily Attendance" || $page == "Totally Attendance" || $page == "Overtime Reports"
                                                || $page == "Leave Reports" || $page == "Task Reports" ? 'nav-expanded nav-active' : null; ?>">
                        <a>
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span><?= $this->lang->line('laporan'); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="<?= base_url('admin/reports/attendance_daily'); ?>"> <?= $this->lang->line('absensi'); ?> <?= $this->lang->line('daily'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/reports/attendance'); ?>"> <?= $this->lang->line('absensi'); ?> <?= $this->lang->line('monthly'); ?> </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/reports/attendance_total'); ?>"> <?= $this->lang->line('absensi'); ?> <?= $this->lang->line('totally'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/reports/leave'); ?>"> <?= $this->lang->line('cuti'); ?></a>
                            </li>
                            <!-- <li>
                                <a href="<?= base_url('admin/reports/task'); ?>"> <?= $this->lang->line('tugas'); ?></a>
                            </li> -->
                            <li>
                                <a href="<?= base_url('admin/reports/overtime'); ?>"> <?= $this->lang->line('lembur'); ?></a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="<?= $page == "Notification" ? 'nav-expanded nav-active' : null; ?>">
                        <a href="<?= base_url('admin/notif'); ?>">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <span><?= $this->lang->line('pemberitahuan'); ?></span>
                        </a>
                    </li> -->
                    <li class="<?= $page == "About Company" ? 'nav-expanded nav-active' : null; ?>">
                        <a href="<?= base_url('admin/company'); ?>">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <span><?= $this->lang->line('about_company'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/logout'); ?>" target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <hr class="separator" />

            <!-- <div class="sidebar-widget widget-stats">
                <div class="widget-header">
                    <h6 style="color: white"><?= $this->lang->line('ringkasan'); ?></h6>
                    <div class="widget-toggle">+</div>
                </div>
                <div class="widget-content">
                    <ul>
                        <li>
                            <span class="stats-title">Mont Task Clear</span>
                            <span class="stats-complete">85%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                                    <span class="sr-only">85% Complete</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="stats-title">Today Attendance</span>
                            <span class="stats-complete">70%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                    <span class="sr-only">70% Complete</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</aside>