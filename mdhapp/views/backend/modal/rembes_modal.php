<!-- Detail -->
<?php foreach ($detail as $m) { ?>
    <div id="detail<?= $m->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('detail'); ?> <?= $this->lang->line('rembes'); ?></h2>
            </header>
            <form action="#">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td><?= $this->lang->line('tanggal'); ?></td>
                            <td><?= $m->tanggal_diminta; ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('rembes'); ?> <?= $this->lang->line('nama'); ?></td>
                            <td><?= $m->title; ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('alasan'); ?></td>
                            <td><?= $m->alasan_rembes; ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('totally'); ?></td>
                            <td><?= number_format($m->nominal_diminta); ?></td>
                        </tr>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss"><?= $this->lang->line('tutup'); ?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>

    <div id="izinkan<?= $m->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('rembes'); ?> <?= $this->lang->line('approved'); ?></h2>
            </header>
            <form action="<?= base_url('belakang/rembes/check'); ?>" method="post">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('pesan_anda'); ?></label>
                                <input type="hidden" name="id_rembes" value="<?= $m->id; ?>">
                                <textarea class="form-control" name="pesan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input name="add" value="Submit" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss"><?=$this->lang->line('tutup');?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>

    <div id="rejected<?= $m->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?=$this->lang->line('rembes');?> <?=$this->lang->line('ditolak');?></h2>
            </header>
            <form action="<?= base_url('belakang/rembes/dismiss'); ?>" method="post">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label"><?=$this->lang->line('pesan_anda');?></label>
                                <input type="hidden" name="id_rembes" value="<?= $m->id; ?>">
                                <textarea class="form-control" name="pesan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input name="add" value="Submit" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss"><?=$this->lang->line('tutup');?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>