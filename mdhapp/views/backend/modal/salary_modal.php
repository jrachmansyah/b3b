<?php foreach ($salary as $sl) { ?>
    <div id="update<?= $sl->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Pay Now</h2>
            </header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label">Pay Method</label>
                                <select class="form-control" name="metode_kirim">
                                    <option value="1"> Cash </option>
                                    <option value="2"> Bank / Atm </option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label">Status</label>
                                <input type="hidden" name="id" value="<?= $sl->id; ?>">
                                <select class="form-control" name="status_gaji">
                                    <option value="1"> Already Paid </option>
                                    <option value="0"> Not Paid </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input name="ubah" value="Pay Now" type="submit" class="btn btn-primary">
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>