<div class="row">
    <div class="col-md-12" data-appear-animation="bounceInDown">
        <section class="panel">
            <div class="panel-body">
                <form action="" method="post" class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('department'); ?></label>
                        <select class="form-control" name="id_department">
                            <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('department'); ?></option>
                            <?php foreach ($department as $dp) { ?>
                                <option value="<?= $dp->id; ?>"><?= $dp->nama_department; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('designation'); ?></label>
                        <select class="form-control" name="id_designation">
                            <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('designation'); ?></option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <button class="btn btn-sm btn-primary" type="submit" name="cari" value="true" style="margin-top: 30px;">
                            <i class="fa fa-search"></i> <?= $this->lang->line('cari'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="col-md-12" data-appear-animation="fadeInUpBig">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title"><?= $page; ?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <?= $mdh; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('backend/modal/salary_modal'); ?>