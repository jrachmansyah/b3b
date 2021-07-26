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
                        <label class="control-label"><?= $this->lang->line('tahun'); ?></label>
                        <select class="form-control" name="tahun" id="tahun">
                            <option value=""><?= $this->lang->line('choose'); ?></option>
                            <?php
                            $now = date('Y');
                            for ($a = 2010; $a <= $now; $a++) {
                                echo "<option value='$a'>$a</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label class="control-label"><?= $this->lang->line('tambah'); ?></label>
                        <select class="form-control" name="bulan" id="bulan">
                            <option value=""><?= $this->lang->line('choose'); ?> <?= $this->lang->line('bulan'); ?></option>
                            <?php
                            $month = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            $jlh_bln = count($month);
                            $no = 1;
                            for ($c = 0; $c < $jlh_bln; $c += 1) {
                                echo "<option value='" . $no++ . "'> $month[$c] </option>";
                            }
                            ?>
                        </select>
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
                            <th><?=$this->lang->line('name');?></th>
                            <?php
                            $no = 1;
                            for ($x = 0; $x < $hari; $x++) {
                                echo '<th>' . $no++ . '</th>';
                            } ?>
                            <th><?=$this->lang->line('totally');?></th>
                        </tr>
                        <?php foreach ($pegawai as $p) { ?>
                            <tr>
                                <td width="300px">
                                    <p><b><?= $p->nama_awal . ' ' . $p->nama_akhir; ?></b></p>
                                </td>
                                <?php
                                $no = 1;
                                for ($x = 0; $x < $hari; $x++) {

                                    $query = $this->db
                                        ->where('id_pegawai', $p->id)
                                        ->where('date', date($tahun . '-' . $bulan . '-' . $no++))
                                        ->get('absensi');
                                    if (count($query->result()) == 1) {
                                        echo '<td><i class="fa fa-check" style="color:green;"></i></td>';
                                    } else {
                                        echo '<td><i class="fa fa-times" style="color:red;"></i></td>';
                                    }
                                } ?>
                                <td><?php
                                    $q2 = $this->db
                                        ->where('id_pegawai', $p->id)
                                        ->where('left(date,7)', date($tahun . '-' . $bulan))
                                        ->get('absensi')->result();
                                    echo count($q2); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>