<div class="row">
    <div class="col-md-12" data-appear-animation="bounceInDown">
        <section class="panel">
            <form action="<?= base_url('belakang/payroll/make'); ?>" method="post">
                <input type="hidden" name="id_pegawai" value="<?= $gaji->id; ?>">
                <div class="panel-body">
                    <div class="invoice">
                        <header class="clearfix">
                            <div class="row">
                                <div class="col-sm-6 mt-md">
                                    <h2 class="h2 mt-none mb-sm text-dark text-bold">Salary Slip</h2>
                                    <h4 class="h4 m-none text-dark text-bold">#<?= $gaji->nomorik; ?></h4>
                                </div>
                                <div class="col-sm-6 text-right mt-md mb-md">
                                    <address class="ib mr-xlg">
                                        <?= $sett->nama_system; ?>
                                        <br />
                                        <?= $sett->alamat; ?>
                                        <br />
                                        Phone: <?= $sett->phone; ?>
                                        <br />
                                        Email : <?= $sett->email; ?>
                                    </address>
                                    <div class="ib">
                                        <img style="max-width: 180px;" src="<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->image_slip; ?>" alt="OKLER Themes" />
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="bill-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bill-to">
                                        <p class="h5 mb-xs text-dark text-semibold"><?= $this->lang->line('to'); ?>:</p>
                                        <address>
                                            <?= $gaji->nama_awal . ' ' . $gaji->nama_akhir; ?>
                                            <br />
                                            <?= $gaji->alamat; ?>
                                            <br />
                                            <?= $this->lang->line('ponsel'); ?>: <?= $gaji->ponsel; ?>
                                            <br />
                                            <?= $this->lang->line('email'); ?>: <?= $gaji->email; ?>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bill-data text-right">
                                        <p class="mb-none">
                                            <span class="text-dark"><?= $this->lang->line('invoice'); ?> <?= $this->lang->line('tanggal'); ?> :</span>
                                            <span class="value"><?= $gaji->tanggal_gaji; ?></span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark"><?= $this->lang->line('invoice'); ?> <?= $this->lang->line('time'); ?> :</span>
                                            <span class="value"><?= $gaji->jam_dibuat; ?></span>
                                        </p>
                                        <p>
                                            <span class="text-dark"><?= $this->lang->line('total_work_hours'); ?> :</span>
                                            <span class="value"><?= $gaji->total_kerja; ?> </span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark"><?= $this->lang->line('total_overtime_hours'); ?> :</span>
                                            <span class="value"><?= $gaji->lembur; ?> </span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark"><?= $this->lang->line('monthly') . ' ' . $this->lang->line('absensi'); ?> :</span>
                                            <span class="value"><?= $gaji->absen_bulanan; ?> </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <h3><?= $this->lang->line('gaji'); ?> <?= $this->lang->line('detail'); ?></h3>
                            <table class="table invoice-items">
                                <thead>
                                    <tr class="h4 text-dark">
                                        <th id="cell-id" class="text-semibold">#</th>
                                        <th id="cell-item" class="text-semibold"><?= $this->lang->line('nama'); ?></th>
                                        <th id="cell-desc" class="text-semibold"><?= $this->lang->line('nominal'); ?></th>
                                        <th id="cell-qty" class="text-center text-semibold">x</th>
                                        <th id="cell-total" class="text-center text-semibold"><?= $this->lang->line('totally'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#</td>
                                        <td class="text-semibold text-dark"><?= $this->lang->line('tunjangan'); ?></td>
                                        <td class="text-center"><?= number_format($gaji->tunjangan); ?></td>
                                        <td><?= $gaji->absen_bulanan; ?> x / Day Attendance </td>
                                        <td class="text-center"><?= number_format($gaji->tunjangan); ?></td>
                                    </tr>
                                    <tr>
                                        <td>#</td>
                                        <td class="text-semibold text-dark"><?= $this->lang->line('main_salary'); ?></td>
                                        <td class="text-center"><?= number_format($gaji->besar_gaji); ?></td>
                                        <td>1 x / <?= $this->lang->line('monthly'); ?> </td>
                                        <td class="text-center"><?= number_format($gaji->besar_gaji); ?></td>
                                    </tr>
                                    <tr>
                                        <td>#</td>
                                        <td class="text-semibold text-dark"><?= $this->lang->line('potongan'); ?></td>
                                        <td class="text-center"><?= number_format($gaji->potongan); ?></td>
                                        <td>1 x / <?= $this->lang->line('monthly'); ?> </td>
                                        <td class="text-center"><?= number_format($gaji->potongan); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="invoice-summary" style="margin-top: -30px;">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-8">
                                    <table class="table h5 text-dark">
                                        <tbody>
                                            <tr class="b-top-none">
                                                <td colspan="2"><?= $this->lang->line('subtotal'); ?></td>
                                                <?php
                                                $subtotal = ($gaji->besar_gaji + $gaji->tunjangan) - $gaji->potongan; ?>
                                                <td class="text-left"><?= number_format($subtotal); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?= $this->lang->line('pajak'); ?></td>
                                                <td class="text-left"><?= $gaji->pajak; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?= $this->lang->line('bonus'); ?></td>
                                                <td class="text-left"><?= number_format($gaji->bonus); ?></td>
                                            </tr>
                                            <tr class="h4">
                                                <td colspan="2"><?= $this->lang->line('grand_total'); ?></td>
                                                <td class="text-left">
                                                    <?= number_format($gaji->nominal_diberikan); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mr-lg">
                        <a href="<?= base_url('admin/payroll/print/' . $gaji->id); ?>" class="btn btn-default">Print Salary</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>