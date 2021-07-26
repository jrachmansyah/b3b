<div id="sliderAdd" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('tambah') . ' ' . $this->lang->line('slider'); ?></h2>
        </header>
        <form action="<?= base_url('admin/slider'); ?>" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('gambar') . ' ' . $this->lang->line('nama'); ?></label>
                            <input type="text" name="nama" class="form-control">
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
                        <input name="add" value="<?= $this->lang->line('tambah'); ?>" type="submit" class="btn btn-primary">
                        <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?></button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<?php foreach ($slider as $a) { ?>
    <div id="sliderEdit<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('tambah') . ' ' . $this->lang->line('slider'); ?> </h2>
            </header>
            <form action="<?= base_url('admin/slider'); ?>" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('gambar') . ' ' . $this->lang->line('nama'); ?></label>
                                <input type="text" name="nama" value="<?= $a->nama; ?>" class="form-control">
                                <input type="hidden" name="id" value="<?= $a->id; ?>">
                            </div>

                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('gambar'); ?> </label>
                                <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/slider/<?= $a->image; ?>" />
                            </div>

                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input name="edit" value="<?= $this->lang->line('ubah'); ?>" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss"><?= $this->lang->line('batal'); ?> </button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>