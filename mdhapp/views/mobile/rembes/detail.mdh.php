<main class="no-margin">
    <section class="container" style="margin-top: 50px;">
        <div class="tab-item author-tab">
            <ul class="nav nav-pills nav-fill menu-cuti">
                <li class="nav-item" style="width: 50%;">
                    <a href="javascript:void(0);" data-content="detail" class="nav-link active menu-tab" href="#">Detail</a>
                </li>
                <li class="nav-item" style="width: 50%;">
                    <a href="javascript:void(0);" data-content="jawaban" class="nav-link menu-tab" href="#">Reply</a>
                </li>
            </ul>
            <hr />
            <?php if (validation_errors()) :
                echo '<div class="alert alert-danger alert-dismissable" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
                    ' . validation_errors() . '
                    </div>';
            endif; ?>
            <div class="tab-content">
                <div class="content-item active" id="detail" style="margin-bottom: 100px;">
                    <div>
                        <?php if ($de->status_rembes == 0) { ?>
                            <p align="center">
                                <img src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" width="300px">
                            </p>
                        <?php } else if ($de->status_rembes == 1) { ?>
                            <p align="center">
                                <img src="<?= base_url(); ?>mdhdesign/mobile/image/berhasil.png" width="300px">
                            </p>
                        <?php } else if ($de->status_rembes == 2) { ?>
                            <p align="center">
                                <img src="<?= base_url(); ?>mdhdesign/mobile/image/gaga.png" width="300px">
                            </p>
                        <?php } ?>
                        <h3 align="center"><?= $de->title; ?></h3>
                        <p>
                            <?= $de->alasan_rembes; ?>
                        </p>
                        <p>
                            Date <b><?= $de->tanggal_diminta; ?> </b>
                        </p>
                        <p>
                            Status <b>
                                <?php if ($de->status_rembes == 0) { ?>
                                    Pending
                                <?php } else if ($de->status_rembes == 1) { ?>
                                    Approval
                                <?php } else if ($de->status_rembes == 2) { ?>
                                    Rejected
                                <?php } ?>
                            </b>
                        </p>
                        <p>
                            Nominal : <?= number_format($de->nominal_diminta); ?>
                        </p>
                        <p align="center">
                            <a class="btn btn-primary" href="<?= base_url(); ?>mdhdesign/uploads/rembes/<?= $de->file_rembes; ?>">
                                <i class="fa fa-download"></i> Download Files
                            </a>
                        </p>

                    </div>
                </div>
                <div class="content-item" id="jawaban">
                    <div style="margin-bottom: 100px;">
                        <div class="post-comments no-padding" style="margin-bottom: 140px;">
                            <ul>
                                <?php foreach ($reply as $rp) { ?>
                                    <li>
                                        <div class="comment-container">
                                            <div class="comment-header">
                                                <span class="user-name"> Admin </span>
                                                <div>
                                                    <span class="comment-date"><i class="fa fa-clock-o"></i> <?= $rp->date; ?></span>
                                                </div>
                                            </div>

                                            <div class="comment-content">
                                                <?= $rp->pesan; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
</div>
</div>