<div id="addNotice" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('tambah'); ?> <?= $this->lang->line('pengumuman'); ?> </h2>
        </header>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('tipe'); ?> <?= $this->lang->line('pengumuman'); ?></label>
                            <select class="form-control" name="id_type">
                                <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('tipe'); ?></option>
                                <?php foreach ($type as $t) { ?>
                                    <option value="<?= $t->id; ?>"><?= $t->nama_type; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('pengumuman'); ?> <?= $this->lang->line('title'); ?></label>
                            <input type="text" name="title" value="<?= set_value('title'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('detail'); ?></label>
                            <textarea id="summernote" class="form-control" name="isi" id="w1-address"><?= set_value('isi'); ?></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('gambar'); ?></label>
                            <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="" />
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

<?php foreach ($all as $a) { ?>
    <div id="noticeUpdate<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('ubah'); ?> <?= $this->lang->line('pengumuman'); ?></h2>
            </header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('tipe'); ?> <?= $this->lang->line('pengumuman'); ?></label>
                                <select class="form-control" name="id_type">
                                    <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('tipe'); ?></option>
                                    <?php foreach ($type as $t) { ?>
                                        <option value="<?= $t->id; ?>" <?= $t->id == $a->id_type ? 'selected' : null; ?>><?= $t->nama_type; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('pengumuman'); ?> <?= $this->lang->line('title'); ?></label>
                                <input type="text" name="title" value="<?= $a->title; ?>" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('detail'); ?></label>
                                <textarea id="summernote" class="form-control" name="isi" id="w1-address"><?= $a->isi; ?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('gambar'); ?></label>
                                <input type="hidden" name="id" value="<?= $a->id; ?>">
                                <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/notice/<?= $a->image; ?>" />
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