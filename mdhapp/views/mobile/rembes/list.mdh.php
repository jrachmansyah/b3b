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
                            <?php foreach ($q2 as $ap) { ?>
                                <li>
                                    <a href="<?=base_url('raimbes/detail/'.$ap->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]/","-",$ap->title)));?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/berhasil.png" alt="Success">
                                            <div class="ml-10">
                                                <h4 class="technoilahi-name"><?= $ap->title; ?></h4>
                                                <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i> <?= $ap->tanggal_diminta; ?> </small>
                                            </div>
                                        </div>
                                        <div>
                                            <small class="d-block c-price"><i class="fa fa-times"></i></small>
                                            <small class="txt-black d-block">
                                                <?= number_format($ap->nominal_diminta); ?>
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
                            <?php foreach ($q1 as $pd) { ?>
                                <li>
                                    <a href="<?=base_url('raimbes/detail/'.$pd->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]/","-",$pd->title)));?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" alt="Success">
                                            <div class="ml-10">
                                                <h4 class="technoilahi-name"><?= $pd->title; ?></h4>
                                                <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i> <?= $pd->tanggal_diminta; ?> </small>
                                            </div>
                                        </div>
                                        <div>
                                            <small class="d-block c-price"><i class="fa fa-times"></i></small>
                                            <small class="txt-black d-block">
                                                <?= number_format($pd->nominal_diminta); ?>
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
<?= $this->load->view('mobile/modal/rembes_modal', '', TRUE); ?>
</div>
</div>