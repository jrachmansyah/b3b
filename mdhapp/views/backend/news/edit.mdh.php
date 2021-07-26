<div class="row">
    <div class="col-lg-12" data-appear-animation="fadeInDown">
        <section class="panel form-wizard" id="w1">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $page; ?></h2>
            </header>
            <div class="panel-body panel-body-nopadding">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div id="w1-account" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('title'); ?></label>
                                    <input type="text" class="form-control" value="<?= $de->title; ?>" name="title" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('category'); ?></label>
                                    <select class="form-control" name="id_cat">
                                        <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('category'); ?></option>
                                        <?php foreach ($cat as $dp) { ?>
                                            <option value="<?= $dp->id; ?>" <?= $de->id_cat == $dp->id ? 'selected' : null; ?>><?= $dp->nama_cat; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('detail'); ?> <?= $this->lang->line('berita'); ?></label>
                                    <textarea id="summernote" class="form-control" name="isi" id="w1-address"><?= $de->isi; ?></textarea>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label"><?= $this->lang->line('gambar'); ?></label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/berita/<?= $de->image; ?>" name="image" id="w1-photo">
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary"><?= $this->lang->line('ubah'); ?></button>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </div>
</div>