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
                                    <label class="control-label">About Title</label>
                                    <input type="text" class="form-control" value="<?= $about->about_company; ?>" name="about_company" id="w1-firstname" required>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label">Company Description</label>
                                    <textarea id="summernote" class="form-control" name="descripsi_company" id="w1-address"><?= $about->descripsi_company; ?></textarea>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <label class="control-label">Image</label>
                                    <input type="file" d="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/system/<?= $about->image_company; ?>" name="image_company" id="w1-photo">
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary">Post News</button>
                        </div>
                    </div>
                </form>
            </div>

        </section>
    </div>
</div>