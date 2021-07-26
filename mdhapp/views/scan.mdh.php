<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?= $page; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/frontend/asset/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>mdhdesign/frontend/asset/theme.css" />
</head>

<body class="preview foodkuy-green-leaf">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="wrapper">
                    <div class="content-right">
                        <div class="in-r">
                            <div class="in-in-r">
                                <div class="in-in-in-r">
                                    <div class="pr-title"><?= $sett->nama_system; ?></div>
                                    <div class="pr-tagline">Solution For Company</div>
                                </div>
                                <div class="wrap-qr">
                                    <div class="your-mobile">
                                        Scan Qrcode For Emplooyee App
                                        <div class="qr-png">
                                            <img src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->qrcode; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-left">
                        <img src="<?= base_url(); ?>mdhdesign/frontend/asset/sc1.png" />
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="pr-bg"></div>
    <script src="<?= base_url(); ?>mdhdesign/frontend/asset/jquery-3.4.1.min.js"></script>
</body>

</html>