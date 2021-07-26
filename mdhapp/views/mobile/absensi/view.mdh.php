<main>
    <div class="container">
        <div class="profile-bg">
            <div class="form-divider"></div>
            <div class="form-row txt-center">
                <div class="profile-image">
                    <img class="avatar-img" alt="User Avatar" src="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $me->photo; ?>" width="100" height="100" />
                </div>
                <div class="exp-wrapper d-flex">
                    <?php if (count($q1->result()) != 1) { ?>
                        <p class="exp left">00:00<span> Masuk</span></p>
                        <p class="exp right">00:00<span> Keluar</span></p>

                        <?php } else if (count($q1->result()) == 1) {
                        $hours = 0;
                        foreach ($q1->result() as $a) { ?>

                            <p class="exp left"><?= $a->jam_masuk; ?><span> Masuk</span></p>
                            <p class="exp right"><?= $a->jam_keluar; ?><span> Keluar</span></p>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="container">
                <div class="student-name">
                    <div class="star-icon"><i class="fa fa-star"></i></div>
                    <?php if (count($q1->result()) != 1) { ?>
                        <h3>00:00</h3>
                        <p>Total Jam Kerja</p>

                    <?php } else if (count($q1->result()) == 1) {
                        $hours = 0;
                        foreach ($q1->result() as $a) {
                            if ($a->jam_keluar == null) {
                                echo '<h3>' . date_create($a->jam_masuk)->diff(date_create(date('h:i A')))->format('%H:%i') . '</h3>
                                <p>Total Jam Kerja</p>';
                            } else {
                                echo '<h3>' . date_create($a->jam_masuk)->diff(date_create($a->jam_keluar))->format('%H:%i') . '</h3>
                                <p>Total Jam Kerja</p>';
                            }
                        } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <a data-popup="checkin" href="#">
                            <div class="absen-menu">
                                <h3 class="st-fact">
                                    <i class="fa fa-sign-in" style="color: teal"></i>
                                </h3>
                                <p class="mb-0">Checked In</p>
                            </div>
                        </a>
                    </div>

                    <div class="col center-item text-center">
                        <a data-popup="checkout" href="#">
                            <div class="absen-menu">
                                <h3 class="st-fact">
                                    <i class="fa fa-sign-out" style="color: red"></i>
                                </h3>
                                <p class="mb-0">Checked Out</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="container" style="margin-bottom: 60px;">
            <div class="section-head">
                <h4 class="title-main">History</h4>
            </div>

            <div>
                <ul class="technoilahi-list list-unstyled mb-0">
                    <?php foreach ($q2 as $absen) { ?>
                        <li>
                            <a href="<?= base_url('attendance/tracker/' . $absen->id . '/' . strtolower(preg_replace("/[^0-9]/", "-", $absen->date))); ?>" class="d-flex align-items-center">
                                <div class="d-flex align-items-center course-item">
                                    <?php if ($absen->image_masuk == null) {
                                    } else { ?>
                                        <img class="img-xs" src="<?= base_url(); ?><?= $absen->image_masuk; ?>" alt="Absen masuk" />
                                    <?php } ?>
                                    <div class="ml-10 wd-100">
                                        <h4 class="technoilahi-name"><?= $absen->date; ?> | Click To Map Tracker</h4>
                                        <?= $absen->jam_masuk; ?> - <?= $absen->jam_keluar; ?>
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
</main>
<?= $this->load->view('mobile/modal/attendance_modal', '', TRUE); ?>
</div>
</div>