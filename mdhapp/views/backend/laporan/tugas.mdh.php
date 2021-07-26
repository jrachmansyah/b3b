<div class="row">
    <div class="col-md-12" data-appear-animation="bounceInDown">
        <section class="panel">
            <div class="panel-body">
                <form action="" method="post" class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('department'); ?></label>
                        <select class="form-control" name="id_department">
                            <option value=""><?= $this->lang->line('semua'); ?></option>
                            <?php foreach ($department as $dp) {
                                echo '<option value="' . $dp->id . '">' . $dp->nama_department . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('start'); ?> <?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="start" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
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
    <div class="col-md-6 col-xl-6 col-sm-6" data-appear-animation="bounceInLeft">
        <section class="panel">
            <div class="panel-body bg-primary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-life-ring"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('totally'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($task); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-6 col-xl-12" data-appear-animation="bounceInRight">
        <section class="panel">
            <div class="panel-body bg-success">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-life-ring"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('selesai'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($done); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-6 col-xl-12" data-appear-animation="bounceInLeft">
        <section class="panel">
            <div class="panel-body bg-warning">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-life-ring"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('diproses'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($prog); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-6 col-xl-12" data-appear-animation="bounceInRight">
        <section class="panel">
            <div class="panel-body bg-secondary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-life-ring"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('pending'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($pending); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12" data-appear-animation="bounceInUp">
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
                    <table id="basicExample" class="display table">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('pegawai'); ?> <?= $this->lang->line('nama'); ?></th>
                                <th><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('nama'); ?></th>
                                <th><?= $this->lang->line('tanggal_buat'); ?> </th>
                                <th><?= $this->lang->line('status'); ?></th>
                                <th><?= $this->lang->line('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($task as $p) { ?>
                                <tr>
                                    <td>
                                        <p><b><?= $p->nama_awal . ' ' . $p->nama_akhir; ?></b></p>
                                    </td>
                                    <td><?= $p->title; ?> </td>
                                    <td><?= $p->tanggal_buat; ?></td>
                                    <td><?php
                                        if ($p->status_selesai == 1) {
                                            echo '<span class="badge badge-primary">Done</span>';
                                        } else if ($p->status_selesai == 0) {
                                            echo '<span class="badge badge-warning">Pending</span>';
                                        } else if ($p->status_selesai == 2) {
                                            echo '<span class="badge badge-danger">Progress</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/task/detail/' . $p->id); ?>" class=" btn btn-sm btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>