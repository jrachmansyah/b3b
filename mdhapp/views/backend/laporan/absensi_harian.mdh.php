<div class="row">
    <div class="col-md-12" data-appear-animation="rotateInDownRight">
        <section class="panel">
            <div class="panel-body">
                <form action="" method="post" class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('department'); ?></label>
                        <select class="form-control" name="id_department">
                            <option value=""><?= $this->lang->line('semua'); ?></option>
                            <?php foreach ($department as $dp) {
                                echo '<option value="' . $dp->id . '">' . $dp->nama_department . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <button class="btn btn-sm btn-primary" type="submit" style="margin-top: 30px;">
                            <i class="fa fa-search"></i> <?= $this->lang->line('cari'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <div class="col-md-12" data-appear-animation="rotateInDownRight">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title"><?= $page; ?> - <?= $tanggal; ?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="basicExample" class="display table">
                        <tr>
                            <th><?= $this->lang->line('nama'); ?></th>
                            <th><?= $this->lang->line('status'); ?></th>
                            <th><?= $this->lang->line('jam_masuk'); ?></th>
                            <th><?= $this->lang->line('jam_pulang'); ?></th>
                            <th><?=$this->lang->line('totally');?></th>
                        </tr>
                        <?php foreach ($pegawai as $p) { ?>
                            <tr>
                                <td>
                                    <p><b><?= $p->nama_awal . ' ' . $p->nama_akhir; ?></b></p>
                                </td>
                                <?php
                                $no = 1;
                                $query = $this->db
                                    ->where('id_pegawai', $p->id)
                                    ->where('date', $tanggal)
                                    ->get('absensi');
                                if (count($query->result()) == 1) {
                                    foreach ($query->result() as $q) { ?>
                                        <td><i class="fa fa-check" style="color:green;"></i></td>
                                        <td><?= $q->jam_masuk; ?></td>
                                        <td><?= $q->jam_keluar; ?></td>
                                        <td><?= $q->total_kerja; ?></td>
                                <?php }
                                } else {
                                    echo '<td><i class="fa fa-times" style="color:red;"></i></td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td> - </td>';
                                }
                                ?>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>