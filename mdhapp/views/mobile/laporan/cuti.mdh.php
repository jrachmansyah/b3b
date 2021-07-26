<main style="margin-bottom:100px;">
    <section class="container" style="margin-bottom: 60px;">
        <div class="section-head">
            <h4 class="title-main">Reports Your Leave</h4>
        </div>

        <div>
            <ul class="technoilahi-list list-unstyled mb-0">
                <?php foreach ($mdh as $ap) { ?>
                    <li>
                        <a data-popup="detail<?= $ap->id; ?>" class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <?php if ($ap->status == '1') { ?>
                                    <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/berhasil.png" alt="Success">
                                <?php } else if ($ap->status == '0') { ?>
                                    <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" alt="Success">
                                <?php } else if ($ap->status == '2') { ?>
                                    <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/gaga.png" alt="Success">
                                <?php } ?>
                                <div class="ml-10">
                                    <h4 class="technoilahi-name"><?= $ap->alasan; ?></h4>
                                    <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i> <?= $ap->tanggal_cuti; ?> - <?= $ap->sampai_tanggal; ?> </small>
                                </div>
                            </div>
                            <div>
                                <small class="d-block c-price"><i class="fa fa-times"></i></small>
                                <small class="txt-black d-block">
                                    <?= $ap->tanggal_izin; ?>
                                </small>
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
<?php foreach ($mdh as $a) { ?>
    <div class="popup-overlay" id="detail<?= $a->id; ?>" style="margin-top: 40px;">
        <!-- if you dont want overlay add class .no-overlay -->
        <div class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title"><?= $a->alasan; ?></h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <?= $a->isi; ?>
                <br>
                <br>
                <table class="table">
                    <tr>
                        <td>Start And To Date</td>
                        <td><?= $a->tanggal_cuti; ?> - <?= $a->sampai_tanggal; ?></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><?= $a->nama_type; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <?php if ($a->status == '1') {
                                echo "Approval";
                            } else if ($a->status == '0') {
                                echo "Pending";
                            } else if ($a->status == '2') {
                                echo "No";
                            } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="popup-footer">
                <button class="button orange">Save</button>
                <button class="button" data-dismiss="true">Cancel</button>
            </div>
        </div>
    </div>
<?php } ?>