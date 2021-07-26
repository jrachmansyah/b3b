<div class="row">
    <div class="col-md-12" data-appear-animation="bounceInDown">
        <section class="panel">
            <div class="panel-body">
                <form action="" method="post" class="row">
                    <div class="col-lg-5 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('start'); ?> <?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="start" class="form-control">
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('end'); ?> <?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="end" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <button class="btn btn-sm btn-primary" type="submit" style="margin-top: 30px;">
                            <i class="fa fa-search"></i> <?= $this->lang->line('cari'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <?php echo '
    <div class="col-md-12" data-appear-animation="fadeInUpBig">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title">' . $page . '</h2>
        </header>
        <div class="panel-body">
            <div class="table-responsive">
                ' . $mdh . '
            </div>
        </div>
    </section>
</div>
</div>';
    ?>