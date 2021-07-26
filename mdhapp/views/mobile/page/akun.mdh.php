<main>
    <div class="container">
        <div class="profile-bg">
            <div class="form-divider"></div>
            <div class="form-row txt-center">
                <div class="profile-image">
                    <img class="avatar-img" alt="<?= $me->nama_awal; ?>" src="<?= base_url(); ?>mdhdesign/uploads/pegawai/<?= $me->photo; ?>" width="100" height="100" />
                    <a href="#" data-popup="account" class="update-btn"><i class="fa fa-camera"></i></a>
                </div>
                <!-- <div class="exp-wrapper d-flex">
                    <p class="exp left">140<span> Task</span></p>
                    <p class="exp right">350<span> Attendance</span></p>
                </div> -->
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
                    <a href="javascript:void(0);" data-content="contentPost" class="nav-link active menu-tab" href="#">General</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="contentFavorites" class="nav-link menu-tab" href="#">Sosmed</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" data-content="bank" class="nav-link menu-tab" href="#">Bank</a>
                </li>
            </ul>
            <hr />
            <div class="tab-content" style="margin-bottom: 60px;">
                <div class="content-item active" id="contentPost">
                    <div class="form-divider"></div>
                    <div class="form-label-divider"><span>ACCOUNT INFO</span></div>
                    <div class="form-divider"></div>

                    <table class="table">
                        <tr>
                            <td>First Name</td>
                            <td><?= $me->nama_awal; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?= $me->nama_akhir; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?= $me->username; ?></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td><?= $dp->nama_department; ?></td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td><?= $ds->nama_designation; ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?= $me->ponsel; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <?php if ($me->jk == 'P') {
                                    echo "Woman";
                                } else {
                                    echo "Man";
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Birth Day</td>
                            <td><?= $me->ttl; ?></td>
                        </tr>

                        <tr>
                            <td>Detail</td>
                            <td><?= $me->deskripsi_pegawai; ?></td>
                        </tr>
                        <tr>
                            <td>Experience</td>
                            <td><?= $me->pengalaman; ?></td>
                        </tr>
                    </table>


                    <div class="form-row">
                        <a href="#" class="button circle block orange" data-popup="general">Update</a>
                    </div>
                </div>

                <div class="content-item" id="contentFavorites">
                    <div style="margin-bottom: 100px;">
                        <div class="form-divider"></div>
                        <div class="form-label-divider"><span>SOCIAL MEDIA</span></div>
                        <div class="form-divider"></div>

                        <table class="table">
                            <tr>
                                <td>Facebook</td>
                                <td><?= $me->fb; ?></td>
                            </tr>
                            <tr>
                                <td>Twitter</td>
                                <td><?= $me->tw; ?></td>
                            </tr>
                            <tr>
                                <td>Instagram</td>
                                <td><?= $me->ig; ?></td>
                            </tr>
                            <tr>
                                <td>Whatsapp</td>
                                <td><?= $me->whatsapp; ?></td>
                            </tr>

                        </table>


                        <div class="form-row">
                            <a href="#" class="button circle block orange" data-popup="sosmed">Update</a>
                        </div>
                    </div>
                </div>
                <div class="content-item" id="bank">
                    <div class="form-divider"></div>
                    <div class="form-label-divider"><span>BANK INFO</span></div>
                    <div class="form-divider"></div>

                    <table class="table">
                        <tr>
                            <td>Bank Account</td>
                            <td><?= $me->nomor_rek; ?></td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td><?= $me->atas_nama; ?></td>
                        </tr>
                    </table>
                    <div class="form-row">
                        <a href="#" class="button circle block orange" data-popup="infob">Update</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
<?= $this->load->view('mobile/modal/account_modal', '', TRUE); ?>
<!-- Page content end -->
</div>
</div>