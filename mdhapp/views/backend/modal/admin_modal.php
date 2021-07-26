<div id="adminAdd" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title"><?= $this->lang->line('tambah') . ' ' . $this->lang->line('admin'); ?></h2>
        </header>
        <form action="<?= base_url('admin/admin'); ?>" method="post" enctype="multipart/form-data">
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('nama_awal'); ?> </label>
                            <input type="text" name="nama_awal" value="<?= set_value('nama_awal'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('nama_akhir'); ?></label>
                            <input type="text" name="nama_akhir" value="<?= set_value('nama_akhir'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('email'); ?></label>
                            <input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('password'); ?></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('username'); ?></label>
                            <input type="text" name="username" value="<?= set_value('username'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('ponsel'); ?></label>
                            <input type="number" name="phone" value="<?= set_value('phone'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('ultah'); ?></label>
                            <input type="date" name="ttl" value="<?= set_value('ttl'); ?>" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label"><?= $this->lang->line('kelamin'); ?></label>
                            <select class="form-control" name="jk">
                                <option value="P">Woman</option>
                                <option value="L">Man</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('role'); ?></label>
                            <select class="form-control" name="role">
                                <option value="1">Admin</option>
                                <option value="2">Secretariat</option>
                                <option value="3">HRD</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('alamat'); ?></label>
                            <textarea class="form-control" name="alamat"><?= set_value('alamat'); ?></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="control-label"><?= $this->lang->line('photo'); ?></label>
                            <input type="file" name="photo" id="input-file-now-custom-1" class="dropify" data-default-file="" />
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

<?php foreach ($adm as $a) { ?>
    <div id="adminEdit<?= $a->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('ubah') . ' ' . $this->lang->line('admin'); ?></h2>
            </header>
            <form action="<?= base_url('admin/admin'); ?>" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('nama_awal'); ?></label>
                                <input type="text" name="nama_awal" value="<?= $a->nama_awal; ?>" class="form-control">
                                <input type="hidden" name="id" value="<?= $a->id; ?>">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('nama_akhir'); ?></label>
                                <input type="text" name="nama_akhir" value="<?= $a->nama_akhir; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('email'); ?></label>
                                <input type="email" name="email" value="<?= $a->email; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('password'); ?></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('username'); ?></label>
                                <input type="text" name="username" value="<?= $a->username; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('ponsel'); ?></label>
                                <input type="number" name="phone" value="<?= $a->phone; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('ultah'); ?></label>
                                <input type="date" name="ttl" value="<?= $a->ttl; ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label"><?= $this->lang->line('kelamin'); ?></label>
                                <select class="form-control" name="jk">
                                    <option value="P">Woman</option>
                                    <option value="L">Man</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('role'); ?></label>
                                <select class="form-control" name="role">
                                    <option value="1">Admin</option>
                                    <option value="2">Secretariat</option>
                                    <option value="3">HRD</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('alamat'); ?></label>
                                <textarea class="form-control" name="alamat"><?= $a->alamat; ?></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label"><?= $this->lang->line('photo'); ?></label>
                                <input type="file" name="photo" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/admin/<?= $a->photo; ?>" />
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