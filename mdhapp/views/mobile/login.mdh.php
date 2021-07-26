
<?php if ($this->agent->is_mobile() == false) {
    return redirect('scan');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title><?= $page; ?> - <?= $sett->nama_system; ?></title>
    <link href="<?= base_url(); ?>mdhdesign/mobile/login/vendor/materializeicon/material-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

    <link href="<?= base_url(); ?>mdhdesign/mobile/login/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>mdhdesign/mobile/login/css/style.css" rel="stylesheet" id="style">

</head>

<body class="ui-rounded">


    <!-- page content starts -->
    <div class="has-background bg-default">
        <figure class="background opacity-30">
            <img src="<?= base_url(); ?>mdhdesign/mobile/login/img/login.jpg" alt="">
        </figure>

        <div class="login-container">
            <div class="row no-gutters">
                <div class="col-12 align-self-start header">
                    <div class="row">
                        <div class="col">
                            <div class="logo-header">
                                <img src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->logo_company; ?>" alt="" class="logo-img">
                            </div>
                        </div>
                    </div>
                </div>
                <form action="" method="post" class="col-12 align-self-center">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-3">
                            <h1 class="text-center font-weight-normal mb-5">Login Account</h1>
                            <div class="form-group float-label style-light active">
                                <input type="email" class="form-control" name="email">
                                <label class="form-control-label">Email</label>
                            </div>
                            <div class="form-group float-label style-light position-relative">
                                <input type="password" name="password" class="form-control">
                                <label class="form-control-label">Password</label>
                            </div>
                            <button type="submit" class="btn btn-lg btn-white btn-block my-4">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- End Boostrab -->

    <script src="<?= base_url(); ?>mdhdesign/mobile/login/js/main.js"></script>

    <script src="<?= base_url(); ?>mdhdesign/mobile/login/vendor/cookie/jquery.cookie.js"></script>

</body>

</html>