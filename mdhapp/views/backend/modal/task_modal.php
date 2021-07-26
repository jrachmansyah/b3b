<div id="addtask" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('tambah') . ' ' . $this->lang->line('pegawai'); ?></h2>
        </header>
        <form action="<?= base_url('belakang/tugas/addtugas'); ?>" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('start') . ' ' . $this->lang->line('tanggal'); ?> </label>
                            <input type="date" name="tanggal_progress" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('deadline'); ?></label>
                            <input type="date" name="deadline" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('nama') . ' ' . $this->lang->line('pegawai'); ?></label>
                            <select class="form-control" name="id_pegawai">
                                <option value=""><?= $this->lang->line('choose') . ' ' . $this->lang->line('pegawai'); ?></option>
                                <?php foreach ($pegawai as $p) { ?>
                                    <option value="<?= $p->id; ?>"><?= $p->nama_awal; ?> <?= $p->nama_akhir; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('nama') . ' ' . $this->lang->line('tugas'); ?></label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('tugas') . ' ' . $this->lang->line('detail'); ?></label>
                            <textarea class="form-control" name="isi"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label">File [png|jpg|jpeg|docx|ppt|csv|xls|txt|pdf]</label>
                            <input type="file" name="file" id="input-file-now-custom-1" class="dropify" data-default-file="" />
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

<?php foreach ($task as $a) { ?>
    <div id="edittask<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('ubah'); ?> <?= $this->lang->line('tugas'); ?></h2>
            </header>
            <form action="<?= base_url('belakang/tugas/addtugas'); ?>" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('start'); ?> <?= $this->lang->line('tanggal'); ?></label>
                                <input type="date" name="tanggal_progress" value="<?= $a->tanggal_progress; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('deadline'); ?></label>
                                <input type="date" name="deadline" value="<?= $a->deadline; ?>" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('pegawai'); ?> <?= $this->lang->line('nama'); ?></label>
                                <select class="form-control" name="id_pegawai">
                                    <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('pegawai'); ?></option>
                                    <?php foreach ($pegawai as $p) { ?>
                                        <option value="<?= $p->id; ?>" <?= $p->id == $a->id_pegawai ? 'selected' : null; ?>><?= $p->nama_awal; ?> <?= $p->nama_akhir; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('nama'); ?></label>
                                <input type="text" name="title" value="<?= $a->title; ?>" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('detail'); ?></label>
                                <textarea class="form-control" name="isi"><?= $a->isi; ?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label">File [png|jpg|jpeg|docx|ppt|csv|xls|txt|pdf]</label>
                                <input type="hidden" name="id" value="<?= $a->id; ?>">
                                <input type="file" name="file" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/task/<?= $a->file; ?>" />
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