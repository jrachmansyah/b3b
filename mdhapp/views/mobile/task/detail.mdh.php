<main class="no-margin">
    <section class="container" style="margin-top: 50px;">
        <div class="tab-item author-tab">
            <ul class="nav nav-pills nav-fill menu-cuti">
                <li class="nav-item" style="width: 50%;">
                    <a href="javascript:void(0);" data-content="contentPost" class="nav-link active menu-tab" href="#">Detail</a>
                </li>
                <li class="nav-item" style="width: 50%;">
                    <a href="javascript:void(0);" data-content="contentFavorites" class="nav-link menu-tab" href="#">History Progress</a>
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
                <div class="content-item active" id="contentPost">
                    <div>
                        <h3 align="center"><?= $de->title; ?></h3>
                        <p>
                            <?= $de->isi; ?>
                        </p>
                        <p>
                            Deadline Date <b><?= $de->deadline; ?> </b>
                        </p>
                        <p align="center">
                            <a class="btn btn-primary" target="_blank" href="<?= base_url(); ?>mdhdesign/uploads/task/<?= $de->file; ?>">
                                <i class="fa fa-download"></i> Download Files
                            </a>
                        </p>
                        <p>
                            <?php if (count($persentase) == null) {
                                $total  = '0';
                            } else {
                                $total = $persentase->total;
                            } ?>
                            Progress : <?= $total; ?>%
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?= $total; ?>%" aria-valuenow="<?= $total; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </p>
                    </div>
                </div>
                <div class="content-item" id="contentFavorites">
                    <div style="margin-bottom: 100px;">
                        <div class="post-comments no-padding" style="margin-bottom: 140px;">
                            <ul>
                                <?php foreach ($plist as $pl) { ?>
                                    <li>
                                        <div class="comment-container">
                                            <div class="comment-header">
                                                <span class="user-name"><?= $pl->nama_progress; ?></span>
                                                <div>
                                                    <span class="comment-date"><i class="fa fa-clock-o"></i> <?= $pl->persentase; ?>%</span>
                                                </div>
                                            </div>

                                            <div class="comment-content">
                                                <?= $pl->progress_isi; ?>
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
<?= $this->load->view('mobile/modal/detailt_modal', '', true); ?>
</div>
</div>