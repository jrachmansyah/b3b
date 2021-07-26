<!-- Checkin Attendance -->
<?php
if (count($q1->result()) == 1) { ?>
    <div class="popup-overlay" id="checkin" style="margin-top: 60px;">
        <form action="" enctype="multipart/form-data" method="post" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Upps!</h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <h4 align="center">
                    You have checked-in for today
                </h4>
            </div>
        </form>
    </div>
<?php } else { ?>
    <div class="popup-overlay" id="checkin" style="margin-top: 60px;">
        <form action="<?= base_url('mobile/attendance/checkin'); ?>" enctype="multipart/form-data" method="post" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Checkin</h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <label class="control-label">Time</label>
                <input type="text" value="<?= date('h:i A'); ?>" class="form-element" />
                <input type="hidden" name="jam_masuk" value="<?= date('h:i A'); ?>" class="form-element" />
                <div class="form-mini-divider"></div>

                <?php if ($sett->track == 'Ya') { ?>
                    <!--  Get Location -->
                    <label class="control-label">Location</label>
                    <input type="text" readonly id="demo" class="form-element" />
                    <input type="hidden" name="long_masuk" id="long">
                    <input type="hidden" name="latitude_masuk" id="latitude">
                    <div class="form-mini-divider"></div>
                    <button class="btn btn-sm btn-primary" onclick="getLocation()" type="button">Get Location</button>
                    <div class="form-mini-divider"></div>
                    <!-- Location End -->
                <?php } ?>

                <?php if ($sett->photo == 'Ya') { ?>
                    <!-- With Photo -->
                    <div class="row">
                        <div class="col-12">
                            <label class="control-label">Photo</label>
                            <div id="my_camera"></div>
                            <div id="results"></div>
                            <p align="center">
                                <br>
                                <input type=button value="Take Snapshot" class="btn btn-sm btn-primary" id="btn-capture">
                            </p>
                            <input type="hidden" name="image_masuk" class="image-tag">
                        </div>
                    </div>
                    <!-- Photo End -->
                <?php } ?>

            </div>
            <div class="popup-footer">
                <button type="submit" class="button orange">Check-in Now</button>
            </div>
        </form>
    </div>
<?php } ?>

<!-- Check Out Attendance -->
<?php
$checkAbsen = $this->db->where('date', date('Y-m-d'))->where('id_pegawai', $this->session->userdata('id'))->get('absensi');
if (count($checkAbsen->result()) == 1) {
    foreach ($checkAbsen->result() as $ck) {
        if ($ck->jam_keluar != null) { ?>
            <div class="popup-overlay" id="checkout" style="margin-top: 60px;">
                <form action="" enctype="multipart/form-data" method="post" class="popup-container">
                    <div class="popup-header">
                        <h3 class="popup-title">Upps!</h3>
                        <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
                    </div>
                    <div class="popup-content">
                        <h4 align="center">
                            You have checked-out for today
                        </h4>
                    </div>
                </form>
            </div>
        <?php } else { ?>
            <div class="popup-overlay" id="checkout" style="margin-top: 60px;">
                <form action="<?= base_url('mobile/attendance/checkout'); ?>" enctype="multipart/form-data" method="post" class="popup-container">
                    <div class="popup-header">
                        <h3 class="popup-title">Checkout</h3>
                        <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
                    </div>
                    <div class="popup-content">
                        <label class="control-label">Time</label>
                        <input type="text" value="<?= date('h:i A'); ?>" class="form-element" />
                        <input type="hidden" name="jam_keluar" value="<?= date('h:i A'); ?>" class="form-element" />
                        <div class="form-mini-divider"></div>

                        <?php if ($sett->track == 'Ya') { ?>
                            <!--  Get Location -->
                            <label class="control-label">Location</label>
                            <input type="text" readonly id="demo" class="form-element" />
                            <input type="hidden" name="long_keluar" id="long">
                            <input type="hidden" name="latitude_keluar" id="latitude">
                            <div class="form-mini-divider"></div>
                            <button class="btn btn-sm btn-primary" onclick="getLocation()" type="button">Get Location</button>
                            <div class="form-mini-divider"></div>
                            <!-- Location End -->
                        <?php } ?>

                        <?php if ($sett->photo == 'Ya') { ?>
                            <!-- With Photo -->
                            <div class="row">
                                <div class="col-12">
                                    <label class="control-label">Photo</label>
                                    <div id="my_camera"></div>
                                    <div id="results"></div>
                                    <p align="center">
                                        <br>
                                        <input type=button value="Take Snapshot" class="btn btn-sm btn-primary" id="btn-capture">
                                    </p>
                                    <input style="width: 350px; height:300px" type="hidden" name="image_keluar" class="image-tag">
                                </div>
                            </div>
                            <!-- Photo End -->
                        <?php } ?>
                        <!-- Total Kerka -->
                        <?php foreach ($q1->result() as $end) { ?>
                            <input type="hidden" name="total_kerja" value="<?= date_create($end->jam_masuk)->diff(date_create($end->jam_keluar))->format('%H:%i'); ?>">
                        <?php } ?>
                    </div>
                    <div class="popup-footer">
                        <button type="submit" class="button orange">Check-out Now</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    <?php } ?>

<?php } else { ?>
    <div class="popup-overlay" id="checkout" style="margin-top: 60px;">
        <form action="" enctype="multipart/form-data" method="post" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Upps!</h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <h4 align="center">
                    Please Check-in first before you Check-out
                </h4>
            </div>
        </form>
    </div>
<?php } ?>