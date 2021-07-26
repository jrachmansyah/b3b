<div class="popup-overlay" id="add" style="margin-top:40px;">
    <form action="" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Overtime Create</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Overtime Title</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-envelope"></i>
                    <input type="text" name="title" class="form-element" />
                </div>
            </div>

            <div class="form-mini-divider"></div>
            <label class="control-label">Overtime Description ( Optional )</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-info"></i>
                    <textarea class="form-element" name="isi_lembur" rows="6"></textarea>
                </div>
            </div>

            <div class="form-mini-divider"></div>
            <label class="control-label">Date</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-calendar"></i>
                    <input type="date" name="date" class="form-element" />
                </div>
            </div>
            <br>
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" name="add" value="true" class="button orange">Create Overtime</button>
        </div>
    </form>
</div>