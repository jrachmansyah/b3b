<main class="no-margin">
    <section class="container">
        <?= $this->load->view('mobile/fungsi/author', '', TRUE); ?>
        <div class="tab-item author-tab">
            <ul class="nav nav-pills nav-fill menu-cuti">
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="pending" class="nav-link active menu-tab" href="#">Pending</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="progress" class="nav-link menu-tab" href="#">Progress</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="complete" class="nav-link menu-tab" href="#">Completed</a>
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

                <div class="content-item active" id="pending">
                    <div>
                        <ul class="technoilahi-list list-unstyled mb-0">
                            <?php foreach ($pending as $p) { ?>
                                <li>
                                    <a href="<?= base_url('task/detail/' . $p->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $p->title))); ?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" alt="Success">
                                            <div class="ml-10">
                                                <h4 class="technoilahi-name"><?= $p->title; ?></h4>
                                                <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i>Deadline Date <?= $p->deadline; ?> </small>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="progress" style="width: 170px;">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $p->progress; ?>%" aria-valuenow="<?= $p->progress; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="content-item" id="progress">
                    <div>
                        <ul class="technoilahi-list list-unstyled mb-0">
                            <?php foreach ($prog as $ap) { ?>
                                <li>
                                    <a href="<?= base_url('task/detail/' . $ap->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $ap->title))); ?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/unnamed.png" alt="Success">
                                            <div class="ml-10">
                                                <h4 class="technoilahi-name"><?= $ap->title; ?></h4>
                                                <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i>Deadline Date <?= $ap->deadline; ?> </small>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="progress" style="width: 170px;">
                                                <?php
                                                $query = $this->db->query("SELECT SUM(persentase) as total from mdh_progress WHERE id_tugas='" . $ap->id . "'")->row();
                                                if (count($query)  == 1) { ?>
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
                </div>

                <div class="content-item" id="complete">
                    <div style="margin-bottom: 100px;">
                        <ul class="technoilahi-list list-unstyled mb-0">
                            <?php foreach ($done as $pd) { ?>
                                <li>
                                    <a href="<?= base_url('task/detail/' . $pd->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $pd->title))); ?>" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs" src="<?= base_url(); ?>mdhdesign/mobile/image/berhasil.png" alt="Success">
                                            <div class="ml-10">
                                                <h4 class="technoilahi-name"><?= $pd->title; ?></h4>
                                                <small class="text-muted c-period"><i class="fa fa-calendar mr-1"></i>Deadline Date <?= $pd->deadline; ?> </small>
                                            </div>
                                        </div>
                                        <div>
                                            <?php
                                            $query = $this->db->query("SELECT SUM(persentase) as total from mdh_progress WHERE id='" . $pd->id . "'")->row();
                                            if (count($query) == 1) { ?>
                                                <div class="progress-bar" role="progressbar" style="width: <?= $query->total; ?>%" aria-valuenow="<?= $query->total; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            <?php } else { ?>
                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            <?php } ?>
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
<?= $this->load->view('mobile/modal/task_modal', '', TRUE); ?>
</div>
</div>