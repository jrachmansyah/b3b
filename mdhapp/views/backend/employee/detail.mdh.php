<section>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <section class="panel">
                <header class="panel-heading bg-tertiary">
                    <div class="panel-heading-profile-picture">
                        <img src="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $emp->photo; ?>">
                    </div>
                </header>
                <div class="panel-body">
                    <h4 class="text-semibold mt-sm" align="center"><?= $emp->nama_awal . ' ' . $emp->nama_akhir; ?></h4>
                    <?= $emp->deskripsi_pegawai; ?>
                    <hr class="solid short">
                </div>
            </section>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-9">

            <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                    <li class="active">
                        <a href="#overview" data-toggle="tab"><?= $this->lang->line('tugas'); ?> <?= $this->lang->line('history'); ?></a>
                    </li>
                    <li>
                        <a href="#edit" data-toggle="tab"><?= $this->lang->line('detail'); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <h4 class="mb-xlg"><?= $this->lang->line('tugas'); ?></h4>

                        <div class="timeline timeline-simple mt-xlg mb-md">
                            <div class="tm-body">
                                <div class="tm-title">
                                    <h3 class="h5 text-uppercase"><?= date('Y-M'); ?></h3>
                                </div>
                                <ol class="tm-items">
                                    <?php foreach ($tsk as $ts) { ?>
                                        <li>
                                            <div class="tm-box">
                                                <p class="text-muted mb-none"><?= $ts->tanggal_buat; ?> | Deadline <?= $ts->deadline; ?>.</p>
                                                <p>
                                                    <?= $ts->isi; ?>
                                                </p>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div id="edit" class="tab-pane">

                        <form class="form-horizontal" method="get">
                            <h4 class="mb-xlg"><?= $this->lang->line('info_general'); ?></h4>
                            <fieldset>
                                <table class="table">
                                    <tr>
                                        <td><?= $this->lang->line('nama_awal'); ?></td>
                                        <td>: <?= $emp->nama_awal; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('nama_akhir'); ?></td>
                                        <td>: <?= $emp->nama_akhir; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('kelamin'); ?></td>
                                        <td>: <?= $emp->jk == 'L' ? 'Man' : 'Woman'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('ultah'); ?></td>
                                        <td>: <?= $emp->ttl; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('email'); ?></td>
                                        <td>: <?= $emp->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('ponsel'); ?></td>
                                        <td>: <?= $emp->ponsel; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('username'); ?></td>
                                        <td>: <?= $emp->username; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Whatsapp</td>
                                        <td>: <?= $emp->whatsapp; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('alamat'); ?></td>
                                        <td><?= $emp->alamat; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Facebook Link</td>
                                        <td>:
                                            <a class="badge badge-primary" href="<?= $emp->fb; ?>">
                                                <i class="fa fa-facebook"></i> Facebook Link
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Instagram Link</td>
                                        <td>:
                                            <a class="badge badge-primary" href="<?= $emp->ig; ?>">
                                                <i class="fa fa-instagram"></i> Instagram Link
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Twitter Link</td>
                                        <td>:
                                            <a class="badge badge-primary" href="<?= $emp->tw; ?>">
                                                <i class="fa fa-twitter"></i> Twitter Link
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                            <hr class="dotted tall">
                            <h4 class="mb-xlg"><?= $this->lang->line('detail'); ?> <?= $emp->nama_awal . ' ' . $emp->nama_akhir; ?></h4>
                            <fieldset>
                                <?= $emp->deskripsi_pegawai; ?>
                            </fieldset>
                            <hr class="dotted tall">
                            <h4 class="mb-xlg">Experience <?= $emp->nama_awal . ' ' . $emp->nama_akhir; ?></h4>
                            <fieldset>
                                <?= $emp->pengalaman; ?>
                            </fieldset>
                            <hr class="dotted tall">
                            <h4 class="mb-xlg">Bank Info</h4>
                            <fieldset>
                                <table class="table">
                                    <tr>
                                        <td><?= $this->lang->line('nomor_bank'); ?></td>
                                        <td>: <?= $emp->nomor_rek; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('nama_bank'); ?></td>
                                        <td>: <?= $emp->atas_nama; ?></td>
                                    </tr>
                                </table>
                            </fieldset>

                            <hr class="dotted tall">
                            <h4 class="mb-xlg">Company Info</h4>
                            <fieldset>
                                <table class="table">
                                    <tr>
                                        <td><?= $this->lang->line('department'); ?></td>
                                        <td>: <?= $emp->nama_department; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('designation'); ?></td>
                                        <td>: <?= $emp->nama_designation; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('tanggal_gabung'); ?></td>
                                        <td>: <?= $emp->tanggal_gabung; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('gaji'); ?></td>
                                        <td>: <?= number_format($emp->besar_gaji); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= $this->lang->line('status'); ?></td>
                                        <td>: <?= $emp->status == '1' ? 'Active' : 'Out'; ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-3">

            <h4 class="mb-md"><?= $this->lang->line('ringkasan'); ?></h4>
            <ul class="simple-card-list mb-xlg">

                <li class="primary">
                    <h3>
                        <?php
                        if (count($absensi->result()) > 0) {
                            foreach ($absensi->result() as $real) {
                                echo substr($real->hours, 0, 8);
                            }
                        } else {
                            echo '00:00:00';
                        } ?>
                    </h3>
                    <p><?= $this->lang->line('total_work_hours'); ?> </p>
                </li>
                <li class="primary">
                    <h3>
                        <?php
                        if (count($totalhour->result()) > 0) {
                            foreach ($totalhour->result() as $time) {
                                echo substr($time->hours, 0, 8);
                            }
                        } else {
                            echo '00:00:00';
                        } ?>
                    </h3>
                    <p><?= $this->lang->line("total_overtime_hours"); ?> </p>
                </li>

                <li class="primary">
                    <h3><?= count($leave); ?></h3>
                    <p><?= $this->lang->line("cuti"); ?> <?= $this->lang->line("approved"); ?></p>
                </li>
                <li class="primary">
                    <h3><?= count($abs); ?></h3>
                    <p><?= $this->lang->line("absensi"); ?></p>
                </li>
                <li class="primary">
                    <h3><?= count($rmb); ?></h3>
                    <p><?= $this->lang->line("rembes"); ?> <?= $this->lang->line("approved"); ?></p>
                </li>
                <li class="primary">
                    <h3><?= count($tsk); ?></h3>
                    <p><?= $this->lang->line("tugas"); ?></p>
                </li>

            </ul>

        </div>
    </div>
</section>