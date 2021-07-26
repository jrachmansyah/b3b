<?php if ($this->agent->is_mobile() == false) {
    return redirect('scan');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
    <title><?= $page; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,900" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/font-awesome.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/global.style.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/plugins/turbo-slider/turbo.css" />
    <?php if ($page == "Today Tracker" || $page == "Map Tracker") { ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/map.css" />
    <?php } ?>
    <?php if ($page == "My Task" || $page == "Task Detail" || $page == "Raimbes" || $page == "My Account") { ?>
        <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/backend/plugins/dropify/css/dropify.min.css">
    <?php } ?>
    <?php if ($page == "Employee Dashboard") { ?>
        <link href="<?= base_url(); ?>mdhdesign/mobile/login/vendor/swiper/css/swiper.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>mdhdesign/mobile/login/css/style.css" rel="stylesheet">
    <?php } else { ?>
        <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/frontend/css/swiper.min.css" />
    <?php } ?>
</head>

<body data-page="homepage">
    <div class="loader">
        <span class="load"></span>
    </div>
    <div class="wrapper">
        <div class="nav-menu">
            <nav class="menu">
                <!-- Template logo start -->
                <div class="nav-header">
                    <a href="<?= base_url('mobile/dashboard'); ?>">
                        <img class="rounded-circle img-fluid" width="100px" alt="" src="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $me->photo; ?>" />
                        <span><?= $me->nama_awal; ?> <?= $me->nama_akhir; ?></span>
                        <span><?= $me->email; ?></span>
                    </a>
                </div>
                <?php include 'sidebar.mdh.php'; ?>
            </nav>
        </div>
        <?php include 'bottom.mdh.php'; ?>
        <div class="wrapper-inline">
            <!-- Header area start -->


            <?php if ($page != 'Employee Dashboard') { ?>
                <header class="no-background">
                    <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
                    <h1 class="page-title"><?= $page; ?></h1>
                    <div class="navi-menu-button">
                        <em></em>
                        <em></em>
                        <em></em>
                    </div>
                </header>
            <?php } else { ?>
                <header>
                    <h1 class="page-title"><?= $page; ?></h1>
                    <div class="navi-menu-button">
                        <em></em>
                        <em></em>
                        <em></em>
                    </div>
                </header>
            <?php } ?>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
            <div class="gagal" data-gagal="<?= $this->session->flashdata('gagal'); ?>"></div>