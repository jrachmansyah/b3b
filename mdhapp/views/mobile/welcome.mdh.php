
<?php if ($this->agent->is_mobile() == false) {
    return redirect('scan');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
    <title><?= $page; ?> - <?= $sett->nama_system; ?></title>
    <!-- Google font file. If you want you can change. -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,900" rel="stylesheet" />

    <!-- Fontawesome font file css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/font-awesome.min.css" />

    <!--turbo slider plugin css file -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/plugins/turbo-slider/turbo.css" />

    <!-- Template global css file. Requared all pages -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>mdhdesign/frontend/css/global.style.css" />
</head>

<body>
    <div class="wrapper">
        <div class="wrapper-inline">
            <!-- Page content start -->
            <main class="no-header wizard-page">
                <div class="wizard">
                    <div class="wizard-item" style="background-image: url('<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->splash_screen1; ?>')">
                        <div class="wizard-content">
                            <div class="form-divider"></div>

                            <img src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->img1; ?>" width="250" alt="" />

                            <div class="form-mini-divider"></div>

                            <h3 style="color: white"><?= $sett->feature1; ?></h3>
                            <p style="color: white">
                                <?= $sett->dfeature1; ?>
                            </p>

                            <div class="form-divider"></div>
                        </div>
                    </div>
                    <div class="wizard-item" style="background-image: url('<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->splash_screen2; ?>')">
                        <div class="wizard-content">
                            <div class="form-divider"></div>

                            <img src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->img2; ?>" width="250" alt="" />

                            <div class="form-mini-divider"></div>

                            <h3 style="color: white"><?= $sett->feature2; ?></h3>
                            <p style="color: white">
                                <?= $sett->dfeature2; ?>
                            </p>

                            <div class="form-divider"></div>
                        </div>
                    </div>
                    <div class="wizard-item" style="background-image: url('<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->splash_screen3; ?>')">
                        <div class="wizard-content">
                            <div class="form-divider"></div>

                            <img src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->img3; ?>" width="250" alt="" />

                            <div class="form-mini-divider"></div>

                            <h3 style="color: white"><?= $sett->feature1; ?></h3>
                            <p style="color: white">
                                <?= $sett->dfeature1; ?>
                            </p>

                        </div>
                    </div>
                </div>
                <a class="wizard-skip-link" href="<?= base_url('mobile/login'); ?>"><i class="fa fa-arrow-right"></i></a>
            </main>
            <!-- Page content end -->
        </div>
    </div>

    <!--Page loader DOM Elements. Requared all pages-->
    <div class="sweet-loader">
        <div class="box">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </div>
    </div>

    <!-- JQuery library file. requared all pages -->
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/jquery-3.2.1.min.js"></script>

    <!-- Turbo slider plugin file. requared only wizard pages -->
    <script src="<?= base_url(); ?>mdhdesign/frontend/plugins/turbo-slider/turbo.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/turbo-ini.js"></script>

    <!-- Template global script file. requared all pages -->
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/global.script.js"></script>
</body>

</html>