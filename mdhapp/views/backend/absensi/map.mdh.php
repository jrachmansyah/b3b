<div class="row">
    <div class="col-md-4 col-xl-4" data-appear-animation="fadeInLeft">
        <section class="panel">
            <div class="panel-body bg-primary">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('today_absensi'); ?> </h4>
                            <div class="info">
                                <strong class="amount"><?= count($absensi->result()); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
                            <h4 class="title"><?= $this->lang->line('tidak_datang'); ?> </h4>
                            <div class="info">
                                <strong class="amount">
                                    <?php
                                    $total = count($no) - count($absensi->result());
                                    echo $total;
                                    ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4 col-xl-4" data-appear-animation="fadeInLeft">
        <section class="panel">
            <div class="panel-body bg-success">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= $this->lang->line('pertama_datang'); ?></h4>
                            <div class="info">
                                <?php if (count($q1->result()) == 1) {
                                    foreach ($q1->result() as $qq) { ?>
                                        <strong><?= $qq->nama_awal . ' ' . $qq->nama_akhir; ?></strong>
                                        <p><?= $qq->jam_masuk; ?></p>
                                <?php }
                                } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title"><?= $this->lang->line('pegawai'); ?> <?= $this->lang->line('map_track'); ?></h2>
            </header>
            <div class="panel-body">
                <div class="mdh-google-map-content pb-100">
                    <div id="map_todo_mdh"></div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title"><?= $this->lang->line('map_track'); ?> <?= $this->lang->line('company'); ?></h2>
            </header>
            <div class="panel-body">
                <div id="gmap-street-view" style="height: 500px; width: 100%;"></div>
            </div>
        </section>
    </div>
</div>