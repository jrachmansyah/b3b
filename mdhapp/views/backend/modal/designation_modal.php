<div id="designationAdd" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('tambah') . ' ' . $this->lang->line('designation'); ?></h2>
        </header>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('department') . ' ' . $this->lang->line('nama'); ?></label>
                            <select class="form-control" name="id_department">
                                <?php foreach ($q1 as $d) : ?>
                                    <option value="<?= $d->id; ?>"><?= $d->nama_department; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-lg-12">
                        <br>
                            <label class="control-label"><?= $this->lang->line('designation') . ' ' . $this->lang->line('nama'); ?></label>
                            <input type="text" name="nama_designation" value="<?=set_value('nama_designation');?>" class="form-control">
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

<?php foreach ($q2 as $a) { ?>
    <div id="designationEdit<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('ubah') . ' ' . $this->lang->line('designation'); ?></h2>
            </header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('department') . ' ' . $this->lang->line('nama'); ?></label>
                                <select class="form-control" name="id_department">
                                    <?php foreach ($q1 as $d) : ?>
                                        <option value="<?= $d->id; ?>" <?= $a->id_department == $d->id ? 'selected' : null; ?>><?= $d->nama_department; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="id" value="<?= $a->id; ?>">
                            </div>
                            <div class="col-lg-12">
                            <br>
                                <label class="control-label"><?= $this->lang->line('designation') . ' ' . $this->lang->line('nama'); ?></label>
                                <input type="text" name="nama_designation" value="<?= $a->nama_designation; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input name="edit" value="<?= $this->lang->line('tambah'); ?>" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?> </button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>