<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="width: 30%;"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('nama'); ?> </td>
                        <td>: <?= $de->title; ?></td>
                    </tr>
                    <tr>
                        <td><?=$this->lang->line('tanggal_buat');?></td>
                        <td>: <?= $de->tanggal_buat; ?></td>
                    </tr>
                    <tr>
                        <td><?=$this->lang->line('deadline');?></td>
                        <td>: <?= $de->deadline; ?></td>
                    </tr>
                    <tr>
                        <td><?=$this->lang->line('selesai');?> <?=$this->lang->line('tanggal');?></td>
                        <td>: <?= $de->tanggal_selesai; ?></td>
                    </tr>
                    <tr>
                        <td><?=$this->lang->line('detail');?></td>
                        <td>: <?= $de->isi; ?></td>
                    </tr>
                    <tr>
                        <td><?=$this->lang->line('berkas');?></td>
                        <td>: <a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url(); ?>mdhdesign/uploads/task/<?= $de->file; ?>"><i class="fa fa-download"></i></a></td>
                    </tr>
                    <tr>
                        <td><?=$this->lang->line('progress');?></td>
                        <td>:
                            <?php if (count($prog) > 0) {
                                $persentase = $this->db->query("SELECT SUM(persentase) as total FROM mdh_progress WHERE id_tugas='" . $de->id . "'")->row();
                                echo $persentase->total . '%';
                            } else {
                                echo "0%";
                            } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="timeline">
            <div class="tm-body">
                <div class="tm-title">
                    <h3 class="h5 text-uppercase"><?= $de->title; ?></h3>
                </div>
                <ol class="tm-items">
                    <?php foreach ($prog as $pr) { ?>
                        <li>
                            <div class="tm-info">
                                <div class="tm-icon"><i class="fa fa-star"></i></div>
                                <time style="margin-left:-15px;" class="tm-datetime" datetime="<?= $pr->date; ?>">
                                    <div class="tm-datetime-time"><?= $pr->date; ?></div>
                                </time>
                            </div>
                            <div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
                                <p>
                                    <?= $pr->progress_isi; ?>
                                </p>
                                <div class="content">
                                    <ul>
                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Persentase Progress</span>
                                                <span class="message pull-right text-dark"><?= $pr->persentase; ?>%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $pr->persentase; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pr->persentase; ?>%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>