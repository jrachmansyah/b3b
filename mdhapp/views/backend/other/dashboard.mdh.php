<div class="row">
    <div class="col-12" data-appear-animation="fadeInUp">
        <div class="owl-carousel" data-plugin-carousel data-plugin-options='{ "autoPlay": 3000, "items": 6, "itemsDesktop": [1199,4], "itemsDesktopSmall": [979,3], "itemsTablet": [768,2], "itemsMobile": [479,1] }'>
            <?php foreach ($emp as $em) { ?>
            <?php } ?>
        </div>
    </div>
    <br />
    <div class="col-md-4 col-xl-4" data-appear-animation="fadeInLeft">
        <section class="panel">
            <div class="panel-body bg-secondary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('totally'); ?> <?= $this->lang->line('departmenr'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($dpt); ?></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="<?= base_url('admin/department'); ?>" class="text-uppercase">(<?= $this->lang->line('lihat_semua'); ?>)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4 col-xl-4" data-appear-animation="fadeInDown">
        <section class="panel">
            <div class="panel-body bg-tertiary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('totally'); ?> <?= $this->lang->line('designation'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($dsg); ?></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="<?= base_url('admin/designation'); ?>" class="text-uppercase">(<?= $this->lang->line('lihat_semua'); ?>)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4 col-xl-4" data-appear-animation="fadeInRight">
        <section class="panel">
            <div class="panel-body bg-primary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('totally'); ?> <?= $this->lang->line('pegawai'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($emp); ?></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="<?= base_url('admin/employee/list'); ?>" class="text-uppercase">(<?= $this->lang->line('lihat_semua'); ?>)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4 col-lg-4 col-xl-4" data-appear-animation="bounceInLeft">
        <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-check-square-o"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('totally'); ?> <?= $this->lang->line('absensi'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($atd); ?></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="<?= base_url('admin/attendance/today'); ?>" class="text-muted text-uppercase">(<?= $this->lang->line('lihat_semua'); ?>)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- <div class="col-md-4 col-lg-4 col-xl-4" data-appear-animation="bounceIn">
        <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('selesai'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($tdn); ?></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="<?= base_url('admin/task/done'); ?>" class="text-muted text-uppercase">(<?= $this->lang->line('lihat_semua'); ?>)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> -->
    <!-- <div class="col-md-4 col-lg-4 col-xl-4" data-appear-animation="bounceInRight">
        <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-th"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('diproses'); ?></h4>
                            <div class="info">
                                <strong class="amount"><?= count($tpg); ?></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a href="<?= base_url('admin/task/progress'); ?>" class="text-muted text-uppercase">(<?= $this->lang->line('lihat_semua'); ?>)</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> -->

    <div class="col-md-12 col-xl-12">
        <section class="panel">
            <div class="panel-body bg-quartenary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('total_tanggungan'); ?></h4>
                            <div class="info">
                                <strong class="amount">
                                    <?php if (count($esb) > 0) {
                                        foreach ($esb as $benefit) {
                                            echo number_format($benefit->jumlah);
                                        }
                                    } else {
                                        echo '0';
                                    } ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- <div class="col-md-6" data-appear-animation="rotateInUpLeft">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title"><?= $this->lang->line('tugas_analis'); ?></h2>
            </header>
            <div class="panel-body">
                <div class="chart chart-md" id="morrisDonut" style="height: 400px"></div>
                <script type="text/javascript">
                    var morrisDonutData = [{
                            label: "Task Done",
                            value: <?= count($td); ?>,
                        },
                        {
                            label: "Task Progress",
                            value: <?= count($tp); ?>,
                        },
                        {
                            label: "Task Pending",
                            value: <?= count($tn); ?>,
                        },
                    ];

                    // See: <?= base_url(); ?>mdhdesign/backend/javascripts/ui-elements/examples.charts.js for more settings.
                </script>
            </div>
        </section>
    </div> -->

    <!-- <div class="col-md-6" data-appear-animation="rotateInUpRight">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title"><?= $this->lang->line('absensi_analis'); ?></h2>
            </header>
            <div class="panel-body">
                <!-- Morris: Area -->
                <div class="chart chart-md" id="morrisStacked" style="height: 400px"></div>
                <script type="text/javascript">
                    var morrisStackedData = [
                        <?php foreach ($ana as $ad) { ?> {
                                y: "<?= $ad->date; ?>",
                                a: <?= $ad->total; ?>,
                            },
                        <?php } ?>
                    ];

                    // See: <?= base_url(); ?>mdhdesign/backend/javascripts/ui-elements/examples.charts.js for more settings.
                </script>
            </div>
        </section>
    </div> -->
    <!-- <div class="col-md-6" data-appear-animation="rotateInUpRight">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title"><?= $this->lang->line('rembes'); ?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('nama_pg'); ?></th>
                                <th>Title</th>
                                <th><?= $this->lang->line('tanggal'); ?></th>
                                <th><?= $this->lang->line('totally'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rmb as $rm) { ?>
                                <tr>
                                    <td><?= $rm->nama_awal . ' ' . $rm->nama_akhir; ?></td>
                                    <td><?= $rm->title; ?></td>
                                    <td><?= $rm->tanggal_diminta; ?></td>
                                    <td><?= number_format($rm->nominal_diminta); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div> -->

    <!-- <div class="col-md-6" data-appear-animation="rotateInUpLeft">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>

                <h2 class="panel-title"><?= $this->lang->line('cuti'); ?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th><?= $this->lang->line('nama_pg'); ?></th>
                                <th><?= $this->lang->line('tipe'); ?></th>
                                <th><?= $this->lang->line('tanggal'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lev as $lv) { ?>
                                <tr>
                                    <td><?= $lv->nama_awal . ' ' . $lv->nama_akhir; ?></td>
                                    <td><?= $lv->nama_type; ?></td>
                                    <td><?= $lv->tanggal_cuti . ' - ' . $lv->sampai_tanggal; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div> -->
</div>