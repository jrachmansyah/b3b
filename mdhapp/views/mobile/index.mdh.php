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
            <main class="no-header mt-0">
                <div class="splash-screen" style="background-image: url('<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->awalan; ?>'); no-repeat center;">
                    <div class="get-started-btn-wrapper">
                        <a href="<?= base_url('mobile/welcome'); ?>" class="get-started-btn g-fixed"><?= $sett->welcome_button; ?></a>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/plugins/turbo-slider/turbo.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/turbo-ini.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/global.script.js"></script>
</body>

</html>