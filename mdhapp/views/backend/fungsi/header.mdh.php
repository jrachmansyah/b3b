<!DOCTYPE html>
<html class="fixed">

<head>
    <!-- Basic -->
    <meta charset="UTF-8" />

    <title><?= $page; ?></title>
    <meta name="description" content="<?= $sett->nama_system; ?>">

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/owl-carousel/owl.theme.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/vendor/morris/morris.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/stylesheets/theme-custom.css" />

    <!-- Head Libs -->
    <script src="<?= base_url(); ?>mdhdesign/backend/vendor/modernizr/modernizr.js"></script>

    <?php if (
        $page == "Admin Data" || $page == "Slider Mobile" || $page == "Add Employee"
        || $page == "Edit Employee" || $page == "General Settings" || $page == "Giving List"
        || $page == "Notice List" || $page == "Add News" || $page == "Update News" || $page == "About Company"
        || $page == "Pending Task" || $page == "Progress Task" || $page == "Done Task"
        || $page == "Payroll Settings" || $page == "Mobile Settings"
    ) { ?>
        <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/plugins/dropify/css/dropify.min.css">
    <?php } ?>
    <?php if (
        $page == "Add Employee" || $page == "Edit Employee" || $page == "Notice List"
        || $page == "Add News" || $page == "Update News" || $page == "About Company"
    ) { ?>
        <!-- Summmernote Plugin -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <?php } ?>
    <?php if ($page == "Map Tracker Today" || $page == "Map Tracker") { ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/map.css" />
    <?php } ?>
    <?php if (
        $page == "Employee List" || $page == "Employee Out" || $page == "Leave Approved" || $page == "Leave Pending"
        || $page == "Notification" || $page == "Leave Rejected" || $page == "Pending Raimbes" || $page == "Approval Raimbes"
        || $page == "Rejected Raimbes" || $page == "Pending Task" || $page == "Detail Task"  || $page == "Done Task"
        || $page == "Progress Task" || $page == "Giving List" || $page == "Notice List" || $page == "News List"
        || $page == "Leave Reports" || $page == "Task Reports" || $page == "Today Attendance" || $page == "Overtime Reports"
        || $page == "Manage Salary"
    ) { ?>
        <!-- Data Tables -->
        <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/plugins/datatables/dataTables.bs4.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/plugins/datatables/dataTables.bs4-custom.css" />
    <?php } ?>
</head>

<body>
    <section class="body">
        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="<?= base_url('admin/dashboard'); ?>" class="logo">
                    <img src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->admin_logo; ?>" height="35" alt="JSOFT Admin" />
                </a>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="header-right">


                <!-- <ul class="notifications">
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-flag"></i>
                        </a>

                        <div class="dropdown-menu notification-menu large">
                            <div class="notification-title">
                                <?= $this->lang->line('bahasa'); ?>
                            </div>

                            <div class="content">
                                <ul>

                                    <li>
                                        <a href="<?= base_url('belakang/ubahBahasa/indonesian'); ?>">
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Indonesian</span>
                                                <span class="message pull-right text-dark">
                                                    <i>
                                                        <img>
                                                    </i>
                                                </span>
                                            </p>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= base_url('belakang/ubahBahasa/english'); ?>">
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">English</span>
                                                <span class="message pull-right text-dark">
                                                    <i>
                                                        <img>
                                                    </i>
                                                </span>
                                            </p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="badge"><?= count($notifall); ?></span>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                <span class="pull-right label label-default"><?= count($notifall); ?></span>
                                Notification
                            </div>

                            <div class="content">
                                <ul>
                                    <?php foreach ($notif as $n) { ?>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="<?= base_url(); ?>mdhdesign/mobile/image/notif.png" alt="Notif" width="35px" class="img-circle" />
                                                </figure>
                                                <span class="title"><?= $n->title; ?></span>
                                                <span class="message"><?= substr($n->isi, 0, 50); ?></span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>

                                <hr />

                                <div class="text-right">
                                    <a href="<?= base_url('admin/notif'); ?>" class="view-more"><?= $this->lang->line('lihat_semua'); ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul> -->

                <span class="separator"></span>

                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <img src="<?= base_url(); ?>mdhdesign/uploads/admin/<?= $me->photo; ?>" alt="<?= $me->nama_awal; ?> <?= $me->nama_akhir; ?>" class="img-circle" data-lock-picture="<?= base_url(); ?>mdhdesign/uploads/admin/<?= $me->photo; ?>" />
                        </figure>
                        <div class="profile-info" data-lock-name="<?= $me->nama_awal; ?> <?= $me->nama_akhir; ?>" data-lock-email="<?= $me->email; ?>">
                            <span class="name"><?= $me->nama_awal; ?> <?= $me->nama_akhir; ?></span>
                            <span class="role">
                                <?php if ($me->role == 1) {
                                    echo "Super Admin";
                                } else if ($me->role == 2) {
                                    echo "Secretariat";
                                } else if ($me->role == 3) {
                                    echo "HRD";
                                } ?>
                            </span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?= base_url('admin/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <?php include 'sidebar.mdh.php'; ?>
            <!-- end: sidebar -->
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2><?= $page; ?></h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <a href="<?= base_url('admin/dashboard'); ?>">
                                    <i style="color: white" class="fa fa-home"></i>
                                </a>
                            </li>
                            <li><span style="color: white"><?= $page; ?></span></li>
                        </ol>

                        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                    </div>
                </header>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                <div class="gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>
                <?php if (validation_errors()) :
                    echo '<div class="alert alert-danger alert-dismissable" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
                    ' . validation_errors() . '
                    </div>';
                endif; ?>