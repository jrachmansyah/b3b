<div id="tunjanganAdd" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('tambah'); ?> <?= $this->lang->line('tunjangan'); ?></h2>
        </header>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('tunjangan'); ?> <?= $this->lang->line('nama'); ?></label>
                            <input type="text" name="nama_tunjangan" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('totally'); ?></label>
                            <input type="number" name="nominal" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('tunjangan'); ?> <?= $this->lang->line('tipe'); ?></label>
                            <select class="form-control" name="type">
                                <option value="1">Daily</option>
                                <option value="2">Monthly</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input name="add" value="<?= $this->lang->line('tambah'); ?>" type="submit" class="btn btn-primary">
                        <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?></button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<?php foreach ($woke as $a) { ?>
    <div id="editTunjangan<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('ubah'); ?> <?= $this->lang->line('tunjangan'); ?></h2>
            </header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('tugas'); ?></label>
                                <input type="text" name="nama_tunjangan" value="<?= $a->nama_tunjangan; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('totally'); ?></label>
                                <input type="number" value="<?= $a->nominal; ?>" name="nominal" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('tunjangan'); ?> <?= $this->lang->line('tipe'); ?></label>
                                <select class="form-control" name="type">
                                    <option value="1">Daily</option>
                                    <option value="2">Monthly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input type="hidden" name="id" value="<?= $a->id; ?>">
                            <input name="edit" value="<?= $this->lang->line('ubah'); ?>" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>