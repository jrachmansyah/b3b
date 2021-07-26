<div class="row">
    <div class="col-lg-12" data-appear-animation="bounceIn">
        <section class="panel form-wizard" id="w1">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $page; ?></h2>
            </header>
            <div class="panel-body panel-body-nopadding">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div id="w1-account" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"><?= $this->lang->line('jam_masuk'); ?></label>
                                    <input type="time" class="form-control" name="jam_masuk" value="<?= $sett->jam_masuk; ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"><?= $this->lang->line('jam_pulang'); ?></label>
                                    <input type="time" class="form-control" name="boleh_keluar" value="<?= $sett->boleh_keluar; ?>" id="w1-firstname" required>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-md-4">
                                    <label class="control-label"><?= $this->lang->line('dengan_map'); ?></label>
                                    <input type="checkbox" class="form-control" name="track" value="Ya" id="w1-firstname" <?= $sett->track == 'Ya' ? 'checked' : null; ?>>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <label class="control-label"><?= $this->lang->line('dengan_photo'); ?></label>
                                    <input type="checkbox" class="form-control" name="photo" value="Ya" id="w1-firstname" <?= $sett->photo == 'Ya' ? 'checked' : null; ?>>
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Long Titude Company</label>
                                    <input type="text" class="form-control" name="lang_kantor" value="<?= $sett->lang_kantor; ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Lang Titude Company</label>
                                    <input type="text" class="form-control" name="latitude_kantor" value="<?= $sett->latitude_kantor; ?>" id="w1-firstname" required>
                                </div>
                                <!-- <div class="col-lg-4 col-sm-6 col-md-4">
                                    <label class="control-label">Attendance With Survey</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->banner_image; ?>" name="banner_image" id="w1-photo">
                                </div> -->
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