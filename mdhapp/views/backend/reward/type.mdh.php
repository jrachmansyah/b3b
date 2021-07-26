<?= '<div class="row">
<div class="col-md-12" data-appear-animation="rotateInDownLeft">
    <section class="panel">
        <header class="panel-heading">
            <a class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-sm btn-primary" href="#departmentAdd">
                <i class="fa fa-plus"></i> ' . $this->lang->line('tambah') . ' ' . $this->lang->line('tipe') . '
            </a>
        </header>
    </section>
</div>
    <div class="col-md-12" data-appear-animation="rotateInUpLeft">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title">' . $page . '</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    ' . $mdh . '
                </div>
            </div>
        </section>
    </div>
</div>';
$this->load->view('backend/modal/reward_modal');
?>