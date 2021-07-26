<main style="margin-bottom:100px;">
    <section class="container">
        <div id="load_data"></div>
        <div id="load_data_message"></div>
        <br />
        <p align="center">
            <button class="btn btn-sm btn-primary" id="load_lagi" type="button">Load More</button>
        </p>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
    </section>
    <a class="bouble-link white txt-orange" data-popup="add" style="margin-bottom:50px; background-color:aquamarine;" href="#"><i class="fa fa-plus" style="color: blue"></i></a>
    <?= $this->load->view('mobile/modal/overtime_modal', '', TRUE); ?>
</main>