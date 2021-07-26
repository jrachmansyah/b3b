<main>
    <div class="container">
        <div class="profile-bg">
            <div class="form-divider"></div>
            <div class="form-row txt-center">
                <div class="profile-image">
                    <img class="avatar-img" alt="<?= $me->nama_awal; ?>" src="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $me->photo; ?>" width="100" height="100" />
                </div>
                <div class="exp-wrapper d-flex">
                    <p class="exp left"><?= $mdhg->lembur; ?> <span> Overtime Hours</span></p>
                    <p class="exp right"><?= $mdhg->total_kerja; ?> <span> Overtime Work</span></p>
                </div>
            </div>
            <div class="container">
                <div class="student-name">
                    <div class="star-icon"><i class="fa fa-star"></i></div>
                    <h3><?= $me->nama_awal; ?> <?= $me->nama_akhir; ?></h3>
                    <p>
                        <?php $ds = $this->db->where('id', $me->id_designation)->get('designation')->row();
                        $dp = $this->db->where('id', $me->id_department)->get('department')->row();
                        echo $ds->nama_designation; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="tab-item author-tab">
            <ul class="nav nav-pills nav-fill menu-cuti">
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="contentPost" class="nav-link active menu-tab" href="#">Detail</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="contentFavorites" class="nav-link menu-tab" href="#">Allowance</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="bank" class="nav-link menu-tab" href="#">Deduction</a>
                </li>
            </ul>
            <hr />
            <div class="tab-content" style="margin-bottom: 60px;">
                <div class="content-item active" id="contentPost">
                    <div class="form-divider"></div>
                    <div class="form-label-divider"><span>- Detail -</span></div>
                    <div class="form-divider"></div>

                    <table class="table">
                        <tr>
                            <td>Salary Basic </td>
                            <td><?= number_format($me->besar_gaji); ?></td>
                        </tr>
                        <tr>
                            <td>Allowance</td>
                            <td><?= number_format($mdhg->tunjangan); ?></td>
                        </tr>
                        <tr>
                            <td>Deduction</td>
                            <td><?= number_format($mdhg->potongan); ?></td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td><?= $mdhg->pajak; ?></td>
                        </tr>
                        <tr>
                            <td>Bonus</td>
                            <td><?= number_format($mdhg->bonus); ?> ( No include tax)</td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td><?= number_format($mdhg->nominal_diberikan); ?></td>
                        </tr>
                        <tr>
                            <td>Date Time</td>
                            <td><?= $mdhg->tanggal_gaji . ' ' . $mdhg->jam_dibuat; ?> </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <?php if ($mdhg->status_gaji == '0') {
                                    echo 'Not yet';
                                } else {
                                    echo 'Done';
                                } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Payment Method</td>
                            <td>
                                <?php if ($mdhg->metode_kirim == '1') {
                                    echo 'Cash';
                                } else {
                                    echo 'Bank / Atm';
                                } ?>
                            </td>
                        </tr>
                    </table>

                </div>

                <div class="content-item" id="contentFavorites">
                    <div style="margin-bottom: 100px;">
                        <div class="form-divider"></div>
                        <div class="form-label-divider"><span>- Allowance -</span></div>
                        <div class="form-divider"></div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Nominal</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tunjangan as $tj) { ?>
                                    <tr>
                                        <td>#</td>
                                        <td><?= $tj->nama_tunjangan; ?></td>
                                        <td><?= number_format($tj->nominal); ?></td>
                                        <td><?= $tj->type == '1' ? 'Daily' : 'Monthly'; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="content-item" id="bank">
                    <div class="form-divider"></div>
                    <div class="form-label-divider"><span>- Deduction -</span></div>
                    <div class="form-divider"></div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($potongan as $pt) { ?>
                                <tr>
                                    <td>#</td>
                                    <td><?= $pt->nama_potongan; ?></td>
                                    <td><?= number_format($pt->nominal); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>
</main>
<!-- Page content end -->
</div>
</div>