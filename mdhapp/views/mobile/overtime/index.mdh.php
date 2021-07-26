<main>
    <div class="container">
        <div class="profile-bg">
            <div class="form-divider"></div>
            <div class="form-row txt-center">
                <div class="profile-image">
                    <img class="avatar-img" alt="User Avatar" src="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $me->photo; ?>" width="100" height="100" />
                </div>
                <div class="exp-wrapper d-flex">
                    <?php if ($mdh->jam_mulai == null) {
                        echo '<p class="exp left">00:00<span> Masuk</span></p>';
                    } else {
                        echo '<p class="exp left">' . $mdh->jam_mulai . '<span> Masuk</span></p>';
                    }

                    if ($mdh->sampai_jam == null) {
                        echo ' <p class="exp right">00:00<span> Keluar</span></p>';
                    } else {
                        echo ' <p class="exp right">' . $mdh->sampai_jam . '<span> Keluar</span></p>';
                    }
                    ?>

                </div>
            </div>
            <div class="container">
                <div class="student-name">
                    <div class="star-icon"><i class="fa fa-star"></i></div>
                    <?php if ($mdh->jam_mulai == null) {
                        echo '<h3>00:00</h3>
                        <p>Overtime hours</p>';
                    } else {
                        if ($mdh->sampai_jam == null) {
                            echo '<h3>' . date_create($mdh->jam_mulai)->diff(date_create(date('h:i A')))->format('%H:%i') . '</h3>
                            <p>Overtime hours</p>';
                        } else {
                            echo '<h3>' . date_create($mdh->jam_mulai)->diff(date_create($mdh->sampai_jam))->format('%H:%i') . '</h3>
                            <p>Overtime hours</p>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <a href="<?= base_url('overtime/view/start/' . $mdh->id); ?>">
                            <div class="absen-menu">
                                <h3 class="st-fact">
                                    <i class="fa fa-sign-in" style="color: teal"></i>
                                </h3>
                                <p class="mb-0">Start</p>
                            </div>
                        </a>
                    </div>

                    <div class="col center-item text-center">
                        <a href="<?= base_url('overtime/view/end/' . $mdh->id); ?>">
                            <div class="absen-menu">
                                <h3 class="st-fact">
                                    <i class="fa fa-sign-out" style="color: red"></i>
                                </h3>
                                <p class="mb-0">End</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="container" style="margin-bottom: 60px;">
            <div class="section-head">
                <h4 class="title-main">Activity</h4>
            </div>

            <div>
                <ul class="technoilahi-list list-unstyled mb-0">
                    <?php foreach ($activity as $ac) { ?>
                        <li>
                            <a href="#" data-popup="view<?= $ac->id; ?>" class="d-flex align-items-center">
                                <div class="d-flex align-items-center course-item">
                                    <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/start.png" alt="Activity" />
                                    <div class="ml-10 wd-100">
                                        <h4 class="technoilahi-name" style="margin-bottom: 2px;"><?= $ac->title; ?></h4>
                                        <p><?= substr($ac->des, 0, 70); ?>....</p>
                                        <span class="badge badge-primary"><?= $ac->time; ?></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
        <div class="form-divider"></div>
    </div>
    <a class="bouble-link white txt-orange" data-popup="add" style="margin-bottom:50px; background-color:aquamarine;" href="#"><i class="fa fa-plus" style="color: blue"></i></a>
    <?php $this->load->view('mobile/modal/overtimedetail_modal'); ?>
</main>

</div>
</div>