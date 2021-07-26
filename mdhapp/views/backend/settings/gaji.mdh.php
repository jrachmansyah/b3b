<div class="row">
    <div class="col-lg-12" data-appear-animation="fadeInUp">
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
                                    <label class="control-label"><?= $this->lang->line('gaji'); ?> <?= $this->lang->line('slip'); ?> <?= $this->lang->line('email'); ?></label>
                                    <input type="email" class="form-control" name="email" value="<?= $sett->email; ?>" required>
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"><?= $this->lang->line('gaji'); ?> <?= $this->lang->line('slip'); ?> <?= $this->lang->line('ponsel'); ?></label>
                                    <input type="text" class="form-control" name="phone" value="<?= $sett->phone; ?>" required>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gaji'); ?> <?= $this->lang->line('pajak'); ?></label>
                                    <input type="number" class="form-control" name="pajak_gaji" value="<?= $sett->pajak_gaji; ?>" required>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gaji'); ?> <?= $this->lang->line('slip'); ?> <?= $this->lang->line('alamat'); ?></label>
                                    <textarea class="form-control" name="alamat"><?= $sett->alamat; ?></textarea>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gaji'); ?> <?= $this->lang->line('slip'); ?> <?= $this->lang->line('company_logo'); ?></label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->image_slip; ?>" name="image_slip" id="w1-photo">
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