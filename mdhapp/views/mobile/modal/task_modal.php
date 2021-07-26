<a class="bouble-link white txt-orange" data-popup="formPopup" style="margin-bottom:50px; background-color:aquamarine;" href="#"><i class="fa fa-plus" style="color: blue"></i></a>

<div class="popup-overlay" id="formPopup" style="margin-top: 40px;">
    <form action="" method="post" enctype="multipart/form-data" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Add Task</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Task Name</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-envelope"></i>
                    <input type="text" name="title" class="form-element" />
                </div>
            </div>

            <div class="form-mini-divider"></div>
            <label class="control-label">Task Detail</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-info"></i>
                    <textarea class="form-element" name="isi" rows="6"></textarea>
                </div>
            </div>

            <div class="form-mini-divider"></div>
            <label class="control-label">Start Date</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-calendar"></i>
                    <input type="date" name="tanggal_progress" class="form-element" />
                </div>
            </div>
            <br>
            <div class="form-mini-divider"></div>
            <label class="control-label">Deadline Date</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-calendar"></i>
                    <input type="date" name="deadline" class="form-element" />
                </div>
            </div>
            <div class="form-mini-divider"></div>
            <label class="control-label">File ( Optinal)</label>
            <div class="form-row-group with-icons">
                <div class="form-row no-padding">
                    <i class="fa fa-calendar"></i>
                    <input type="file" name="file" id="input-file-now-custom-1" class="dropify" data-default-file="" />
                </div>
            </div>
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" name="add" value="true" class="button orange">Create Task</button>
        </div>
    </form>
</div>