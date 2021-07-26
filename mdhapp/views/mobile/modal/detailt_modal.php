<!-- Update Task -->
<?php if ($de->status_selesai == 0 || $de->status_selesai == 2 ) { ?>
    <div class="popup-overlay" id="formPopup" style="margin-top: 40px;">
        <form action="<?= base_url('mobile/task/edit'); ?>" method="post" enctype="multipart/form-data" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Update Task</h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <label class="control-label">Task Name</label>
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="title" value="<?= $de->title; ?>" class="form-element" />
                    </div>
                </div>

                <div class="form-mini-divider"></div>
                <label class="control-label">Task Detail</label>
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding">
                        <i class="fa fa-info"></i>
                        <textarea class="form-element" name="isi" rows="6"><?= $de->isi; ?></textarea>
                    </div>
                </div>

                <div class="form-mini-divider"></div>
                <label class="control-label">Start Date</label>
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding">
                        <i class="fa fa-calendar"></i>
                        <input type="date" name="tanggal_progress" value="<?= $de->tanggal_progress; ?>" class="form-element" />
                    </div>
                </div>
                <br>
                <div class="form-mini-divider"></div>
                <label class="control-label">Deadline Date</label>
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding">
                        <i class="fa fa-calendar"></i>
                        <input type="date" name="deadline" value="<?= $de->deadline; ?>" class="form-element" />
                    </div>
                </div>
                <div class="form-mini-divider"></div>
                <label class="control-label">File ( Optinal)</label>
                <div class="form-row-group with-icons">
                    <div class="form-row no-padding">
                        <i class="fa fa-calendar"></i>
                        <input type="hidden" name="id" value="<?= $de->id; ?>" <input type="file" name="file" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/task/<?= $de->file; ?>" />
                    </div>
                </div>
                <div class="form-mini-divider"></div>
            </div>
            <div class="popup-footer">
                <button type="submit" name="add" value="true" class="button orange">Update Task</button>
            </div>
        </form>
    </div>
<?php } else if ($de->status_selesai == 1 ) { ?>
    <div class="popup-overlay" id="formPopup" style="margin-top: 40px;">
        <form action="#" method="post" enctype="multipart/form-data" class="popup-container">
            <div class="popup-content">
                <p align="center">
                    <img src="<?= base_url(); ?>mdhdesign/mobile/image/done.png">
                </p>
                <h4 align="center"> Task is Complete</h4>
                <div class="form-mini-divider"></div>
            </div>
        </form>
    </div>
<?php } ?>

<!-- Add Progress -->
<?php if ($de->status_selesai == 0 || $de->status_selesai == 2 ) { ?>
    <div class="popup-overlay" id="addprogress" style="margin-top: 40px;">
        <form action="<?= base_url('mobile/task/addProgress'); ?>" method="post" enctype="multipart/form-data" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Add Task Progress</h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <label class="control-label">Progress Name</label>
                <input type="text" name="nama_progress" class="form-element" />

                <div class="form-mini-divider"></div>
                <label class="control-label">Progress Detail</label>
                <textarea class="form-element" name="progress_isi" rows="6"></textarea>

                <div class="form-mini-divider"></div>
                <label class="control-label">Task Persentase</label>
                <input type="hidden" name="id_tugas" value="<?= $de->id; ?>">
                <input type="text" name="persentase" class="form-element" />

                <div class="form-mini-divider"></div>
            </div>
            <div class="popup-footer">
                <button type="submit" name="add" value="true" class="button orange">Add Progress</button>
            </div>
        </form>
    </div>
<?php } else if ($de->status_selesai == 1) { ?>
    <div class="popup-overlay" id="addprogress" style="margin-top: 40px;">
        <form action="#" method="post" enctype="multipart/form-data" class="popup-container">
            <div class="popup-content">
                <p align="center">
                    <img src="<?= base_url(); ?>mdhdesign/mobile/image/done.png">
                </p>
                <h4 align="center"> Task is Complete</h4>
                <div class="form-mini-divider"></div>
            </div>
        </form>
    </div>
<?php } ?>

<!-- Reports Done -->
<?php if ($de->status_selesai == 0 || $de->status_selesai == 2 ) { ?>
    <div class="popup-overlay" id="reports" style="margin-top: 40px;">
        <form action="<?= base_url('mobile/task/done'); ?>" method="post" enctype="multipart/form-data" class="popup-container">
            <div class="popup-header">
                <h3 class="popup-title">Change Task Status </h3>
                <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
            </div>
            <div class="popup-content">
                <p align="center">
                    <img src="<?= base_url(); ?>mdhdesign/mobile/image/done.png">
                    <input type="hidden" name="id_tugas" value="<?= $de->id; ?>">
                </p>
                <p align="center">
                    <button type="submit" class="button orange">Confirm Task</button>
                </p>
                <div class="form-mini-divider"></div>
            </div>
            <div class="popup-footer">

            </div>
        </form>
    </div>
<?php } else if ($de->status_selesai == 1) { ?>
    <div class="popup-overlay" id="reports" style="margin-top: 40px;">
        <form action="#" method="post" enctype="multipart/form-data" class="popup-container">
            <div class="popup-content">
                <p align="center">
                    <img src="<?= base_url(); ?>mdhdesign/mobile/image/done.png">
                </p>
                <h4 align="center"> Task is Complete</h4>
                <div class="form-mini-divider"></div>
            </div>
        </form>
    </div>
<?php } ?>

<!-- History Progress -->