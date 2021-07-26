<!-- Modal Account -->
<div class="popup-overlay" id="account" style="margin-top: 60px;">
    <form action="" enctype="multipart/form-data" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Update Account</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Email</label>
            <input type="email" name="email" value="<?= $me->email; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Password</label>
            <input type="password" name="password" class="form-element" />
            <div class="form-mini-divider"></div>


            <label class="control-label">Photo</label>
            <input type="file" name="photo" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $me->photo; ?>" />
            <div class="form-mini-divider"></div>
            <br>

        </div>
        <div class="popup-footer">
            <button type="submit" class="button orange">Update Account</button>
        </div>
    </form>
</div>

<!-- Modal General -->
<div class="popup-overlay" id="general" style="margin-top: 60px;">
    <form action="<?= base_url('mobile/account/general'); ?>" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Update General Info</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">First Name</label>
            <input type="text" name="nama_awal" value="<?= $me->nama_awal; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Last Name</label>
            <input type="text" name="nama_akhir" value="<?= $me->nama_akhir; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">UserName</label>
            <input type="text" name="username" value="<?= $me->username; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Phone</label>
            <input type="text" name="ponsel" value="<?= $me->ponsel; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Gender</label>
            <select class="form-element" name="jk">
                <option value="P">Woman</option>
                <option value="L">Man</option>
            </select>
            <div class="form-mini-divider"></div>

            <label class="control-label">Birth Day</label>
            <input type="date" name="ttl" value="<?= $me->ttl; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Detail</label>
            <textarea class="form-element" name="deskripsi_pegawai"><?= $me->deskripsi_pegawai; ?></textarea>
            <div class="form-mini-divider"></div>

            <label class="control-label">Experience</label>
            <textarea class="form-element" name="pengalaman"><?= $me->pengalaman; ?></textarea>
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" class="button orange">Update Info</button>
        </div>
    </form>
</div>


<!-- Modal Social Media -->
<div class="popup-overlay" id="sosmed" style="margin-top: 60px;">
    <form action="<?= base_url('mobile/account/sosmed'); ?>" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Update Sosmed</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Url Facebook</label>
            <input type="url" name="fb" value="<?= $me->fb; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Url Instagram</label>
            <input type="url" name="ig" value="<?= $me->ig; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Url Twitter</label>
            <input type="url" name="tw" value="<?= $me->tw; ?>" class="form-element" />
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" class="button orange">Update Info</button>
        </div>
    </form>
</div>

<!-- Modal Bank Info -->
<div class="popup-overlay" id="infob" style="margin-top: 60px;">
    <form action="<?=base_url('mobile/account/bank');?>" method="post" class="popup-container">
        <div class="popup-header">
            <h3 class="popup-title">Update Bank Info</h3>
            <span class="popup-close" data-dismiss="true"><i class="fa fa-times"></i></span>
        </div>
        <div class="popup-content">
            <label class="control-label">Bank Account</label>
            <input type="number" name="nomor_rek" value="<?= $me->nomor_rek; ?>" class="form-element" />
            <div class="form-mini-divider"></div>

            <label class="control-label">Bank Name</label>
            <input type="text" name="atas_nama" value="<?= $me->atas_nama; ?>" class="form-element" />
            <div class="form-mini-divider"></div>
        </div>
        <div class="popup-footer">
            <button type="submit" class="button orange">Update Info</button>
        </div>
    </form>
</div>