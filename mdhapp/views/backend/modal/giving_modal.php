<div id="addGiving" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('giving_reward'); ?></h2>
        </header>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('reward'); ?> <?= $this->lang->line('tipe'); ?></label>
                            <select class="form-control" name="id_type">
                                <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('tipe'); ?></option>
                                <?php foreach ($type as $t) { ?>
                                    <option value="<?= $t->id; ?>"><?= $t->nama_type; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('choose'); ?> <?= $this->lang->line('pegawai'); ?></label>
                            <select class="form-control" name="id_pegawai">
                                <?php foreach ($pgw as $p) { ?>
                                    <option value="<?= $p->id; ?>"><?= $p->nama_awal; ?> <?= $p->nama_akhir; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('tanggal'); ?></label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('detail'); ?></label>
                            <textarea class="form-control" name="deskripsi"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('photo'); ?></label>
                            <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="" />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input name="add" value="<?= $this->lang->line('giving_reward'); ?>" type="submit" class="btn btn-primary">
                        <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?></button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<?php foreach ($all as $a) { ?>
    <div id="editGiving<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('ubah'); ?> <?= $this->lang->line('reward'); ?></h2>
            </header>
            <form action="<?= base_url('admin/admin'); ?>" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('reward'); ?> <?= $this->lang->line('tipe'); ?></label>
                                <select class="form-control" name="id_type">
                                    <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('tipe'); ?></option>
                                    <?php foreach ($type as $t) { ?>
                                        <option value="<?= $t->id; ?>" <?= $a->id_type == $t->id ? 'selected' : null; ?>><?= $t->nama_type; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('choose'); ?> <?= $this->lang->line('pegawai'); ?></label>
                                <select class="form-control" name="id_pegawai">
                                    <?php foreach ($pgw as $p) { ?>
                                        <option value="<?= $p->id; ?>" <?= $p->id == $a->id_pegawai ? 'selected' : null; ?>><?= $p->nama_awal; ?> <?= $p->nama_akhir; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('tanggal'); ?></label>
                                <input type="date" name="tanggal" value="<?= $a->tanggal; ?>" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('detail'); ?></label>
                                <textarea class="form-control" name="deskripsi"><?= $a->deskripsi; ?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('photo'); ?></label>
                                <input type="hidden" name="id" value="<?= $a->id; ?>">
                                <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/reward/<?= $a->image; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input name="edit" value="<?= $this->lang->line('ubah'); ?>" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>