<div class="row">


    <div class="col-lg-12" data-appear-animation="fadeInDown">
        <section class="panel form-wizard" id="w1">
            <header class="panel-heading">
                <h2 class="panel-title">Mobile Sett</h2>
            </header>
            <div class="panel-body panel-body-nopadding">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div id="w1-account" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('tombol_welcome'); ?></label>
                                    <input type="text" class="form-control" value="<?= $sett->welcome_button; ?>" name="welcome_button" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('splash_screen'); ?> (560 x 1100)</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->awalan; ?>" name="awalan" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('feature'); ?> 1</label>
                                    <input type="text" class="form-control" name="feature1" value="<?= $sett->feature1; ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('deskripsi'); ?> 1</label>
                                    <textarea class="form-control" name="dfeature1"><?= $sett->dfeature1; ?></textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?> <?= $this->lang->line('feature'); ?> 1</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->splash_screen1; ?>" name="splash_screen1" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?> <?= $this->lang->line('icon'); ?> 1</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->img1; ?>" name="img1" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('feature'); ?> 2</label>
                                    <input type="text" class="form-control" name="feature2" value="<?= $sett->feature2; ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('deskripsi'); ?> <?= $this->lang->line('feature'); ?> 2</label>
                                    <textarea class="form-control" name="dfeature2"><?= $sett->dfeature3; ?></textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?> <?= $this->lang->line('feature'); ?> 2</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->splash_screen2; ?>" name="splash_screen2" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?> <?= $this->lang->line('icon'); ?> 2</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->img2; ?>" name="img2" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('feature'); ?> 3</label>
                                    <input type="text" class="form-control" name="feature3" value="<?= $sett->feature3; ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('deskripsi'); ?> <?= $this->lang->line('feature'); ?> 3</label>
                                    <textarea class="form-control" name="dfeature3"><?= $sett->dfeature3; ?></textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?> <?= $this->lang->line('feature'); ?> 3</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->splash_screen2; ?>" name="splash_screen3" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?> <?= $this->lang->line('icon'); ?> 3</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->img3; ?>" name="img3" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label">Qrcode Scanner</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->qrcode; ?>" name="qrcode" id="w1-photo">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-sm btn-primary" type="submit" name="welcome" value="true"><?= $this->lang->line('ubah'); ?> <?= $this->lang->line('pengaturan'); ?></button>
                    </div>

                </form>
            </div>
        </section>
    </div>

</div>