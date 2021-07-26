<?= '<div class="row">
<div class="col-md-12" data-appear-animation="fadeInLeftBig">
<section class="panel">
    <header class="panel-heading">
        <a class="btn btn-sm btn-primary" href="' . base_url('belakang/notification/checkall') . '">
            <i class="fa fa-check"></i> 
            ' . $this->lang->line('tandai_dibaca') . '
        </a>
    </header>
</section>
</div>
    <div class="col-md-12" data-appear-animation="fadeInUpBig">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title">' . $page . '</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive" >
                    ' . $mdh . '
                </div>
            </div>
        </section>
    </div>
</div>';
?>