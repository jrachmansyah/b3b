<!-- Page content end -->
<a class="bouble-link white txt-orange" data-popup="formPopup" style="margin-bottom:50px; background-color:aquamarine;" href="#"><i class="fa fa-plus" style="color: blue"></i></a>

<div class="popup-overlay" id="formPopup" style="margin-top: 50px;">
    <form action="" method="post" class="popup-container" enctype="multipart/form-data">
        <div class="popup-header">
            <h3 class="popup-title">Add Raimbes</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Raimbes Name</label>
            <input type="text" name="title" class="form-element" />

            <div class="form-mini-divider"></div>
            <label class="control-label">Detail</label>
            <textarea class="form-element" name="alasan_rembes" rows="6"></textarea>

            <br>
            <div class="form-mini-divider"></div>
            <label class="control-label">Nominal</label>
            <input type="number" name="nominal_diminta" class="form-element" />
            <br>
            <div class="form-mini-divider"></div>
            <label class="control-label">File </label>
            <input type="file" name="file_rembes" id="input-file-now-custom-1" class="dropify" data-default-file="" />
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" class="button orange">Send Raimbes</button>
        </div>
    </form>
</div>