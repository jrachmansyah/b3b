<a class="bouble-link white txt-orange" data-popup="formPopup" style="margin-bottom:50px; background-color:aquamarine;" href="#"><i class="fa fa-plus" style="color: blue"></i></a>

<div class="popup-overlay" id="formPopup">
    <form action="" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Make An Application</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Your Reason</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-envelope"></i>
                    <input type="text" name="alasan" class="form-element" />
                </div>
            </div>

            <div class="form-mini-divider"></div>
            <label class="control-label">Detail Application</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-info"></i>
                    <textarea class="form-element" name="isi" rows="6"></textarea>
                </div>
            </div>
            <div class="form-mini-divider"></div>
            <label class="control-label">Application Types</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-cubes"></i>
                    <select class="form-element" name="id_type">
                        <option value="" selected>Application Types</option>
                        <?php foreach ($type as $ty) { ?>
                            <option value="<?= $ty->id; ?>"><?= $ty->nama_type; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="form-mini-divider"></div>
            <label class="control-label">Start Date</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-calendar"></i>
                    <input type="date" name="tanggal_cuti" class="form-element" />
                </div>
            </div>
            <br>
            <div class="form-mini-divider"></div>
            <label class="control-label">End Date</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-calendar"></i>
                    <input type="date" name="sampai_tanggal" class="form-element" />
                </div>
            </div>
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" name="add" value="true" class="button orange">Send An Application</button>
        </div>
    </form>
</div>

<?php foreach ($all as $a) { ?>
    <div class="popup-overlay" id="detail<?= $a->id; ?>">
        <!-- if you dont want overlay add class .no-overlay -->
        <div class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title"><?= $a->alasan; ?></h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <?= $a->isi; ?>
                <br>
                <br>
                <table class="table">
                    <tr>
                        <td>Start And To Date</td>
                        <td><?= $a->tanggal_cuti; ?> - <?= $a->sampai_tanggal; ?></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><?= $a->nama_type; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <?php if ($a->status == '1') {
                                echo "Approval";
                            } else if ($a->status == '0') {
                                echo "Pending";
                            } else if ($a->status == '2') {
                                echo "No";
                            } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="popup-footer">
                <button class="button orange">Save</button>
                <button class="button" data-dismiss="true">Cancel</button>
            </div>
        </div>
    </div>
<?php } ?>