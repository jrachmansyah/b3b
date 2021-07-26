<div class="popup-overlay" id="add" style="margin-top:40px;">
    <form action="" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Add Activity</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Activity Title</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-envelope"></i>
                    <input type="text" name="title" class="form-element" />
                </div>
            </div>

            <div class="form-mini-divider"></div>
            <label class="control-label">Activity Description ( Optional )</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-info"></i>
                    <textarea class="form-element" name="des" rows="6"></textarea>
                </div>
            </div>
            <br>
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" name="add" value="true" class="button orange">Create Activity</button>
        </div>
    </form>
</div>
<?php foreach ($activity as $v) { ?>
    <div class="popup-overlay" id="view<?= $v->id; ?>" style="margin-top:40px;">
        <form action="" method="post" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Detail Activity</h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <h4><?= $v->title; ?></h4>
                <p><?= $v->des; ?></p>
                <br>
                <div class="form-mini-divider"></div>
            </div>
        </form>
    </div>
<?php } ?>