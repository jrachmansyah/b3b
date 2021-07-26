<main style="margin-bottom:100px;">
    <section class="container" style="margin-bottom: 60px;">
        <div class="section-head">
            <h4 class="title-main">Reports Your Attendance</h4>
        </div>

        <div>
            <ul class="technoilahi-list list-unstyled mb-0">
                <?php foreach ($mdh as $absen) { ?>
                    <li>
                        <a href="<?= base_url('attendance/tracker/' . $absen->id . '/' . strtolower(preg_replace("/[^0-9]/", "-", $absen->date))); ?>" class="d-flex align-items-center">
                            <div class="d-flex align-items-center course-item">
                                <?php if ($absen->image_masuk == null) {
                                } else { ?>
                                    <img class="img-xs" src="<?= base_url(); ?><?= $absen->image_masuk; ?>" alt="Absen masuk" />
                                <?php } ?>
                                <div class="ml-10 wd-100">
                                    <h4 class="technoilahi-name"><?= $absen->date; ?> | <span class=" badge badge-sm badge-primary" > Click To Map Tracker </span> </h4>
                                    <?= $absen->jam_masuk; ?> - <?= $absen->jam_keluar; ?>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
    <section class="container">
        <a class="bouble-link white txt-orange" data-popup="searchdate" style="margin-bottom:50px; background-color:aquamarine;" href="#"><i class="fa fa-plus" style="color: blue"></i></a>
    </section>
</main>

<div class="popup-overlay" id="searchdate" style="margin-top: 40px;">
    <form action="" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Search Data</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <div class="row">
                <div class="col-sm-6">
                    <label class="control-label">First Date</label>
                    <input type="date" name="awal" class="form-control">
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Last Date</label>
                    <input type="date" name="akhir" class="form-control">
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button type="submit" name="search" value="true" class="button orange">Get Reports</button>
        </div>
    </form>
</div>