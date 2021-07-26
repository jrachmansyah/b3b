<div class="row">
    <div class="col-lg-12" data-appear-animation="rotateInUpLeft">
        <section class="panel form-wizard" id="w1">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $page; ?></h2>
            </header>
            <div class="panel-body panel-body-nopadding">
                <div class="wizard-tabs">
                    <ul class="wizard-steps">
                        <li class="active">
                            <a href="#w1-account" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">1</span>
                                <?= $this->lang->line('info_general'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#w1-profile" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">2</span>
                                <?= $this->lang->line('social_media'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#w1-confirm" data-toggle="tab" class="text-center">
                                <span class="badge hidden-xs">3</span>
                                <?= $this->lang->line('account_gaji'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div id="w1-account" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('nama_awal'); ?></label>
                                    <input type="text" class="form-control" name="nama_awal" value="<?= set_value('nama_awal'); ?>" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('nama_akhir'); ?></label>
                                    <input type="text" class="form-control" name="nama_akhir" value="<?= set_value('nama_akhir'); ?>" id="w1-lastname">
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('kelamin'); ?></label>
                                    <select class="form-control" name="jk" id="w1-jk">
                                        <option value="P">Woman</option>
                                        <option value="L">Man</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"><?= $this->lang->line('ultah'); ?></label>
                                    <input type="date" class="form-control" name="ttl" id="w1-ttl" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('department'); ?></label>
                                    <select class="form-control" name="id_department">
                                        <option value=""> <?= $this->lang->line('choose') . ' ' . $this->lang->line('department'); ?></option>
                                        <?php foreach ($q1 as $dp) { ?>
                                            <option value="<?= $dp->id; ?>"><?= $dp->nama_department; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('designation'); ?></label>
                                    <select class="form-control" name="id_designation">
                                        <option value=""> <?= $this->lang->line('choose'); ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"> <?= $this->lang->line('alamat'); ?></label>
                                    <textarea id="summernote" class="form-control" name="alamat" id="w1-address"><?= set_value('alamat'); ?></textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"> <?= $this->lang->line('pengalaman'); ?></label>
                                    <textarea id="summernote1" class="form-control" name="pengalaman" id="w1-experience"><?= set_value('pengalaman'); ?></textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"> <?= $this->lang->line('pegawai'); ?> <?= $this->lang->line('detail'); ?></label>
                                    <textarea id="summernote2" class="form-control" name="deskripsi_pegawai" id="w1-detail"><?= set_value('deskripsi_pegawai'); ?></textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"> <?= $this->lang->line('photo'); ?></label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="" name="photo" id="w1-photo">
                                </div>
                            </div>
                        </div>
                        <div id="w1-profile" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Facebook <?= $this->lang->line('url'); ?></label>
                                    <input type="url" class="form-control" name="fb" id="w1-facebook" value="<?= set_value('fb'); ?>">
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Instagram <?= $this->lang->line('url'); ?></label>
                                    <input type="url" class="form-control" name="ig" id="w1-instagram" value="<?= set_value('ig'); ?>">
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Twitter <?= $this->lang->line('url'); ?></label>
                                    <input type="url" class="form-control" name="tw" id="w1-twitter" value="<?= set_value('tw'); ?>">
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label">Whatsapp</label>
                                    <input type="number" class="form-control" name="whatsapp" value="<?= set_value('whatsapp'); ?>" id="w1-whastapp">
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('ponsel'); ?></label>
                                    <input type="number" class="form-control" name="ponsel" value="<?= set_value('ponsel'); ?>" id="w1-phone">
                                </div>

                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('email'); ?></label>
                                    <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>" id="w1-email" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('password'); ?></label>
                                    <input type="password" class="form-control" name="password" id="w1-password" required>
                                </div>
                            </div>
                        </div>
                        <div id="w1-confirm" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('gaji'); ?></label>
                                    <input type="number" class="form-control" name="besar_gaji" value="<?= set_value('besar_gaji'); ?>" id="w1-gaji" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('tanggal_gabung'); ?></label>
                                    <input type="date" class="form-control" name="tanggal_gabung" value="<?= set_value('tanggal_gabung'); ?>" id="w1-tanggal_gabung" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('nomor_bank'); ?></label>
                                    <input type="number" class="form-control" name="nomor_rek" value="<?= set_value('nomor_rek'); ?>" id="w1-rek" required>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('nama_bank'); ?></label>
                                    <input type="text" class="form-control" name="atas_nama" value="<?= set_value('atas_nama'); ?>" id="w1-atas_nama" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <ul class="pager">
                            <li class="previous disabled">
                                <a><i class="fa fa-angle-left"></i> <?= $this->lang->line('sebelumnya'); ?></a>
                            </li>
                            <li class="finish hidden pull-right">
                                <button class="btn btn-sm btn-primary" type="submit"> <?= $this->lang->line('tambah'); ?></button>
                            </li>
                            <li class="next">
                                <a> <?= $this->lang->line('selanjutnya'); ?> <i class="fa fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>

        </section>
    </div>
</div>