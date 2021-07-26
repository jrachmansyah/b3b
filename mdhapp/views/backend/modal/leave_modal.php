<?php foreach ($modal as $m) { ?>
    <div id="modal<?= $m->id; ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"><?= $this->lang->line('cuti') . ' ' . $this->lang->line('detail'); ?> </h2>
            </header>
            <form action="#">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td><?= $this->lang->line('start') . ' ' . $this->lang->line('tanggal'); ?></td>
                            <td><?= $m->tanggal_cuti; ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('end') . ' ' . $this->lang->line('tanggal'); ?></td>
                            <td><?= $m->sampai_tanggal; ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('alasan'); ?></td>
                            <td><?= $m->alasan; ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('detail'); ?></td>
                            <td><?= $m->isi; ?></td>
                        </tr>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss"><?= $this->lang->line('tutup'); ?></button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
<?php } ?>