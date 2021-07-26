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
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('start'); ?> <?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="start" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('end'); ?> <?= $this->lang->line('tanggal'); ?></label>
                        <input type="date" name="end" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <button class="btn btn-sm btn-primary" type="submit" style="margin-top: 30px;">
                            <i class="fa fa-search"></i> <?=$this->lang->line('cari');?>
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
                <h2 class="panel-title"><?= $page; ?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="basicExample" class="display table">
                        <tr>
                            <th><?=$this->lang->line('nama');?></th>
                            <th><?=$this->lang->line('totally');?> <?=$this->lang->line('absensi');?></th>
                        </tr>
                        <?php foreach ($pegawai as $p) { ?>
                            <tr>
                                <td>
                                    <p><b><?= $p->nama_awal . ' ' . $p->nama_akhir; ?></b></p>
                                </td>
                                <?php
                                $no = 1;
                                if ($this->input->post('start') != null) {
                                    $query = $this->db->query("SELECT COUNT(id) as total FROM mdh_absensi 
                                                WHERE id_pegawai='" . $p->id . "'
                                                AND date BETWEEN '" . $this->input->post('start') . "' AND '" . $this->input->post('end') . "' ")->row();
                                } else {
                                    $query = $this->db->query("SELECT COUNT(id) as total FROM mdh_absensi 
                                                WHERE id_pegawai='" . $p->id . "' ")->row();
                                }
                                if (count($query) > 0) {
                                    echo '<td>' . $query->total . '</td>';
                                } else {
                                    echo '<td>0</td>';
                                } ?>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>