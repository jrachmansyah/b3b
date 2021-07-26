<main class="no-margin">
    <section class="container">
        <?= $this->load->view('mobile/fungsi/author', '', TRUE); ?>
        <div class="tab-item author-tab">
            <ul class="nav nav-pills nav-fill menu-cuti">
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="contentPost" class="nav-link active menu-tab" href="#">Approved</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="contentFavorites" class="nav-link menu-tab" href="#">Pending</a>
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
                        <ul class="technoilahi-list list-unstyled mb-0">
                            <?php foreach ($approve as $ap) { ?>
                                <li>
                                    <a data-popup="detail<?= $ap->id; ?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/berhasil.png" alt="Success">
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
                </div>
                <div class="content-item" id="contentFavorites">
                    <div style="margin-bottom: 100px;">
                        <ul class="technoilahi-list list-unstyled mb-0">
                            <?php foreach ($pending as $pd) { ?>
                                <li>
                                    <a data-popup="detail<?= $pd->id; ?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" alt="Pending">
                                            <div class="ml-10">
                                                <h4 class="technoilahi-name"><?= $pd->alasan; ?></h4>
                                                <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i> <?= $pd->tanggal_cuti; ?> - <?= $pd->sampai_tanggal; ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <small class="d-block c-price"><i class="fa fa-times"></i></small>
                                            <small class="txt-black d-block">
                                                <?= $pd->tanggal_izin; ?>
                                            </small>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</div>
</div>
<?= $this->load->view('mobile/modal/leave_modal'); ?>