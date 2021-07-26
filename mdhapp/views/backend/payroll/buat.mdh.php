<div class="row">
    <div class="col-md-12" data-appear-animation="bounceInDown">
        <section class="panel">
            <div class="panel-body">
                <form action="" method="post" class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('department'); ?> </label>
                        <select class="form-control" name="id_department">
                            <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('department'); ?></option>
                            <?php foreach ($department as $dp) { ?>
                                <option value="<?= $dp->id; ?>"><?= $dp->nama_department; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('department'); ?></label>
                        <select class="form-control" name="id_designation">
                            <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('designation'); ?></option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('pegawai'); ?></label>
                        <select class="form-control" name="id_pegawai">
                            <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('pegawai'); ?></option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <button class="btn btn-sm btn-primary" type="submit" style="margin-top: 30px;">
                            <i class="fa fa-search"></i> <?= $this->lang->line('cari'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <?php if ($mdh == '1') {
        echo '';
    } else { ?>
        <?php if (count($employee) == 1) {
            foreach ($employee as $emp) { ?>
                <div class="col-md-12" data-appear-animation="bounceInDown">
                    <section class="panel">
                        <form action="<?= base_url('belakang/payroll/make'); ?>" method="post">
                            <input type="hidden" name="id_pegawai" value="<?= $emp->id; ?>">
                            <div class="panel-body">
                                <div class="invoice">
                                    <header class="clearfix">
                                        <div class="row">
                                            <div class="col-sm-6 mt-md">
                                                <h2 class="h2 mt-none mb-sm text-dark text-bold">Salary Slip</h2>
                                                <h4 class="h4 m-none text-dark text-bold">#<?php
                                                                                            $nomorik = substr(md5(rand()), 0, 7);
                                                                                            echo $nomorik;
                                                                                            echo '<input type="hidden" name="nomorik" value="' . $nomorik . '">';
                                                                                            ?></h4>
                                            </div>
                                            <div class="col-sm-6 text-right mt-md mb-md">
                                                <address class="ib mr-xlg">
                                                    <?= $sett->nama_system; ?>
                                                    <br />
                                                    <?= $sett->alamat; ?>
                                                    <br />
                                                    <?= $this->lang->line('ponsel'); ?> : <?= $sett->phone; ?>
                                                    <br />
                                                    <?= $this->lang->line('email'); ?> : <?= $sett->email; ?>
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
                                                    <p class="h5 mb-xs text-dark text-semibold"><?=$this->lang->line('to');?>:</p>
                                                    <address>
                                                        <?= $emp->nama_awal . ' ' . $emp->nama_akhir; ?>
                                                        <br />
                                                        <?= $emp->alamat; ?>
                                                        <br />
                                                        <?= $this->lang->line('ponsel'); ?>: <?= $emp->ponsel; ?>
                                                        <br />
                                                        <?= $this->lang->line('email'); ?>: <?= $emp->email; ?>
                                                    </address>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bill-data text-right">
                                                    <p class="mb-none">
                                                        <span class="text-dark"><?= $this->lang->line('invoice'); ?> <?= $this->lang->line('tanggal'); ?> :</span>
                                                        <span class="value"><?= date('Y-m'); ?></span>
                                                        <input type="hidden" name="tanggal_gaji" value="<?= date('Y-m'); ?>">
                                                    </p>
                                                    <p class="mb-none">
                                                        <span class="text-dark"><?= $this->lang->line('invoice'); ?> <?= $this->lang->line('time'); ?> :</span>
                                                        <span class="value"><?= date('H:i:s'); ?></span>
                                                        <input type="hidden" name="jam_dibuat" value="<?= date('H:i:s'); ?>" </p> <p class="mb-none">
                                                        <span class="text-dark"><?= $this->lang->line('total_work_hours'); ?> :</span>
                                                        <span class="value">
                                                            <?php if (count($totalhour) > 0) {
                                                                echo substr($totalhour->hours, 0, 8);
                                                                echo '<input type="hidden" name="total_kerja" value="' . substr($totalhour->hours, 0, 8) . '">';
                                                            } else {
                                                                echo '00:00';
                                                            } ?>
                                                        </span>
                                                    </p>
                                                    <p class="mb-none">
                                                        <span class="text-dark"><?= $this->lang->line('total_overtime_hours'); ?> :</span>
                                                        <span class="value">
                                                            <?php if (count($totalLembur) > 0) {
                                                                echo substr($totalLembur->hours, 0, 8);
                                                                echo '<input type="hidden" name="lembur" value="' . substr($totalLembur->hours, 0, 8) . '">';
                                                            } else {
                                                                echo '00:00';
                                                            } ?>
                                                        </span>
                                                    </p>
                                                    <p class="mb-none">
                                                        <span class="text-dark"><?= $this->lang->line('monthly') . ' ' . $this->lang->line('absensi'); ?> :</span>
                                                        <span class="value">
                                                            <?php if (count($absensi) > 0) {
                                                                echo $absensi->total;
                                                                echo '<input type="hidden" name="absen_bulanan" value="' . $absensi->total . '">';
                                                            } else {
                                                                echo '0';
                                                            } ?>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <h3><?= $this->lang->line('potongan'); ?></h3>
                                        <table class="table invoice-items">
                                            <thead>
                                                <tr class="h4 text-dark">
                                                    <th id="cell-id" class="text-semibold">#</th>
                                                    <th id="cell-item" class="text-semibold"><?= $this->lang->line('nama'); ?> </th>
                                                    <th id="cell-desc" class="text-semibold"><?= $this->lang->line('nominal'); ?></th>
                                                    <th id="cell-qty" class="text-center text-semibold">x</th>
                                                    <th id="cell-total" class="text-center text-semibold"><?= $this->lang->line('totally'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($potongan as $ppn) {
                                                    @$ppntotal += $ppn->nominal;
                                                ?>
                                                    <tr>
                                                        <td>#</td>
                                                        <td class="text-semibold text-dark"><?= $ppn->nama_potongan; ?></td>
                                                        <td><?= number_format($ppn->nominal); ?></td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-center"><?= number_format($ppn->nominal); ?></td>
                                                    </tr>
                                                <?php } ?>
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
                                                            <td class="text-left"><?= number_format($ppntotal); ?></td>
                                                            <input type="hidden" name="potongan" value="<?= @$ppntotal; ?>">
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <h3><?= $this->lang->line('tunjangan'); ?></h3>
                                        <table class="table invoice-items">
                                            <thead>
                                                <tr class="h4 text-dark">
                                                    <th id="cell-id" class="text-semibold">#</th>
                                                    <th id="cell-item" class="text-semibold"><?= $this->lang->line('nama'); ?></th>
                                                    <th id="cell-desc" class="text-semibold"><?= $this->lang->line('nominal'); ?></th>
                                                    <th id="cell-desc" class="text-semibold"><?= $this->lang->line('tipe'); ?></th>
                                                    <th id="cell-qty" class="text-center text-semibold">x</th>
                                                    <th id="cell-total" class="text-center text-semibold"><?= $this->lang->line('totally'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tunjangan as $ttn) {
                                                    if ($ttn->type == '1') {
                                                        if (count($absensi) > 0) {
                                                            @$ttntotal += $ttn->nominal * $absensi->total;
                                                        } else {
                                                            @$ttntotal += $ttn->nominal;
                                                        }
                                                    }
                                                ?>
                                                    <tr>
                                                        <td>#</td>
                                                        <td class="text-semibold text-dark"><?= $ttn->nama_tunjangan; ?></td>
                                                        <td><?= number_format($ttn->nominal); ?></td>
                                                        <td>
                                                            <?= $ttn->type == '1' ? 'Daily' : 'Monthly'; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if ($ttn->type == '1') {
                                                                if (count($absensi) > 0) {
                                                                    echo $absensi->total;
                                                                } else {
                                                                    echo '0';
                                                                }
                                                            } else {
                                                                echo '1';
                                                            } ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if ($ttn->type == '1') {
                                                                if (count($absensi) > 0) {
                                                                    $total = $ttn->nominal * $absensi->total;
                                                                } else {
                                                                    $total = $ttn->nominal;
                                                                }
                                                            } ?>
                                                            <?= number_format($total); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
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
                                                            <td class="text-left"><?= number_format($ttntotal); ?></td>
                                                            <input type="hidden" name="tunjangan" value="<?= @$ttntotal; ?>">
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <h3><?= $this->lang->line('main_salary'); ?></h3>
                                        <table class="table invoice-items">
                                            <thead>
                                                <tr class="h4 text-dark">
                                                    <th id="cell-id" class="text-semibold">#</th>
                                                    <th id="cell-item" class="text-semibold"><?= $this->lang->line('nama'); ?></th>
                                                    <th id="cell-desc" class="text-semibold"><?= $this->lang->line('nominal'); ?></th>
                                                    <th id="cell-total" class="text-center text-semibold"><?= $this->lang->line('totally'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>#</td>
                                                    <td class="text-semibold text-dark"><?= $this->lang->line('pegawai'); ?> <?= $this->lang->line('gaji'); ?></td>
                                                    <td>
                                                        <?= number_format($emp->besar_gaji); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= number_format($emp->besar_gaji); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#</td>
                                                    <td class="text-semibold text-dark"><?= $this->lang->line('pegawai'); ?> <?= $this->lang->line('bonus'); ?></td>
                                                    <td>
                                                        <input type="number" name="bonus" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        - No Include Tax
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="invoice-summary">
                                        <div class="row">
                                            <div class="col-sm-4 col-sm-offset-8">
                                                <table class="table h5 text-dark">
                                                    <tbody>
                                                        <tr class="b-top-none">
                                                            <td colspan="2"><?= $this->lang->line('subtotal'); ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                $subtotal = ($emp->besar_gaji - @$ppntotal) + @$ttntotal;
                                                                echo number_format($subtotal);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><?= $this->lang->line('pajak'); ?></td>
                                                            <td class="text-left"><?= $sett->pajak_gaji; ?>%</td>
                                                            <input type="hidden" name="pajak" value="<?= $sett->pajak_gaji; ?>%">
                                                        </tr>
                                                        <tr class="h4">
                                                            <td colspan="2"><?= $this->lang->line('grand_total'); ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                $grand = $subtotal / $sett->pajak_gaji;
                                                                $grandtotal = $subtotal - $grand;
                                                                echo number_format($grandtotal);
                                                                ?>
                                                                <input type="hidden" name="nominal_diberikan" value="<?= $grandtotal; ?>">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mr-lg">
                                    <button type="submit" class="btn btn-default"><?= $this->lang->line('make_salary'); ?></button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
    <?php
            }
        } else {
            echo '';
        }
    } ?>
</div>