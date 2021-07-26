<div class="row">
    <div class="col-lg-12" data-appear-animation="fadeInUp">
        <section class="panel form-wizard" id="w1">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('pengaturan'); ?> <?= $this->lang->line('general'); ?> </h2>
            </header>
            <div class="panel-body panel-body-nopadding">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div id="w1-account" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('nama_system'); ?></label>
                                    <input type="text" class="form-control" name="nama_system" value="<?= $sett->nama_system; ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('judul_banner'); ?></label>
                                    <input type="text" class="form-control" name="banner_title" value="<?= $sett->banner_title; ?>" id="w1-firstname" required>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('tombol_banner'); ?></label>
                                    <input type="text" class="form-control" name="banner_button" value="<?= $sett->banner_button; ?>" id="w1-firstname" required>
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Url</label>
                                    <input type="text" class="form-control" name="banner_link" value="<?= $sett->banner_link; ?>" id="w1-firstname" required>
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"><?= $this->lang->line('timezone'); ?></label>
                                    <select class="form-control" name="timezone">
                                        <?php
                                        $time = timezone_identifiers_list();
                                        foreach ($time as $tm) { ?>
                                            <option value="<?= $tm; ?>" <?= $sett->timezone == $tm ? 'selected' : null; ?>><?= $tm; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar_banner'); ?> [ Jpg | Png | Jpeg ]</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->banner_image; ?>" name="banner_image" id="w1-photo">
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('logo_login'); ?> [ Jpg | Png | Jpeg ]</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->logo_company; ?>" name="logo_company" id="w1-photo">
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('admin_logo'); ?> ( 233 x 108) [ Jpg | Png | Jpeg ]</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->admin_logo; ?>" name="admin_logo" id="w1-photo">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-sm btn-primary" type="submit" name="general" value="true"><?= $this->lang->line('ubah'); ?> <?= $this->lang->line('pengaturan'); ?></button>
                    </div>

                </form>
            </div>
        </section>
    </div>

    

</div>