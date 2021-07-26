<main style="margin-bottom:100px;">
    <section class="container" style="margin-bottom: 60px;">
        <div class="section-head">
            <h4 class="title-main">Reports Your Task</h4>
        </div>

        <div>
            <ul class="technoilahi-list list-unstyled mb-0">
                <?php foreach ($mdh as $ap) { ?>
                    <li>
                        <a href="<?= base_url('task/detail/' . $ap->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $ap->title))); ?>" class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <?php if ($ap->status_selesai == '1') { ?>
                                    <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/berhasil.png" alt="Success">
                                <?php } else if ($ap->status_selesai == '2' || $ap->status_selesai == '0') { ?>
                                    <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" alt="Success">
                                <?php } ?>
                                <div class="ml-10">
                                    <h4 class="technoilahi-name"><?= $ap->title; ?></h4>
                                    <small class="badge badge-sm badge-primary"><i class="fa fa-calendar mr-1"></i> Deadline <?= $ap->deadline; ?> </small>
                                </div>
                            </div>
                            <div>
                                <div class="progress" style="width: 170px;">
                                    <?php
                                    $query = $this->db->query("SELECT SUM(persentase) as total from mdh_progress WHERE id='" . $ap->id . "'")->row();
                                    if (count($query) == 1) { ?>
                                        <div class="progress-bar" role="progressbar" style="width: <?= $query->total; ?>%" aria-valuenow="<?= $query->total; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    <?php } else { ?>
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    <?php } ?>
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