<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="timeline">
            <div class="tm-body">
                <div class="tm-title">
                    <h3 class="h5 text-uppercase"><?= $mdh->date; ?></h3>
                </div>
                <ol class="tm-items">
                    <?php foreach ($isi as $pr) { ?>
                        <li>
                            <div class="tm-info">
                                <div class="tm-icon"><i class="fa fa-star"></i></div>
                                <time style="margin-left:-15px;" class="tm-datetime" datetime="<?= $pr->time; ?>">
                                    <div class="tm-datetime-time"><?= $pr->time; ?></div>
                                </time>
                            </div>
                            <div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
                                <h4><?= $pr->title; ?></h4>
                                <p> <?= $pr->des; ?> </p>
                        </li>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>