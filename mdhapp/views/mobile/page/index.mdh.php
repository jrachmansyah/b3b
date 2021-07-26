<main class="margin">
    <!-- Slider Content -->
    <section class="slider-mdh">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $no = 0;
                $a  = 0;
                foreach ($slid as $s1) { ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $no++; ?>" <?= $a++ == 0 ? 'class="active"' : null; ?>></li>
                <?php } ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $i  = 1;
                foreach ($slid as $s2) { ?>
                    <div class="carousel-item <?= $i++ == 1 ? 'active' : null; ?>">
                        <img src="<?= base_url(); ?>mdhdesign/uploads/slider/<?= $s2->image; ?>" class="d-block w-100" alt="<?= $s2->nama; ?>" />
                    </div>
                <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- Slider Content End -->
    <div class="clear"></div>
    <!-- Main Menu -->
    <section class="container">
        <div class="row main-menu">
            <div class="col-4 text-center menu-home">
                <a href="<?= base_url('attendance'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon1.png" alt="" />
                        <h5 class="">Absensi</h5>
                    </div>
                </a>
            </div>
            <div class="col-4 text-center menu-home">
                <a href="<?= base_url('leave/list'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon2.png" alt="" />
                        <h5 class="">Cuti</h5>
                    </div>
                </a>
            </div>
            <!-- <div class="col-4 text-center menu-home">
                <a href="<?= base_url('task/list'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon3.png" alt="" />
                        <h5 class="">My Task</h5>
                    </div>
                </a>
            </div> -->
            <div class="col-4 text-center menu-home">
                <a href="<?= base_url('overtime/list'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon4.png" alt="" />
                        <h5 class="">Lembur</h5>
                    </div>
                </a>
            </div>
            <div class="col-4 text-center menu-home">
                <a href="<?= base_url('salary/list'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon5.png" alt="" />
                        <h5 class="">Gaji</h5>
                    </div>
                </a>
            </div>
            <!-- <div class="col-4 text-center menu-home">
                <a href="<?= base_url('news/list'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon6.png" alt="" />
                        <h5 class="">News</h5>
                    </div>
                </a>
            </div> -->
            <!-- <div class="col-4 text-center menu-home">
                <a href="<?= base_url('raimbes/list'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon7.png" alt="" />
                        <h5 class="">Raimbes</h5>
                    </div>
                </a>
            </div> -->
            <div class="col-4 text-center menu-home">
                <a href="<?= base_url('account'); ?>">
                    <div class="menu-item">
                        <img src="<?= base_url(); ?>mdhdesign/mobile/image/icon8.png" alt="" />
                        <h5 class="">Account</h5>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- Main Menu End -->
    <section class="container">

        <div class="banner-div" style="background-image: url('<?= base_url(); ?>mdhdesign/uploads/system/<?= $sett->banner_image; ?>');">
            <div class="banner-content">
                <h2 class="banner-head">
                    <?= $sett->banner_title; ?>
                </h2>
                <a class="c-btn" href="<?= base_url('company'); ?>"><?= $sett->banner_button; ?></a>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <br>
    <!-- <section class="container">
        <div class="section-head">
            <h4 class="title-main">Notice</h4>
            <a class="c-btn" href="<?= base_url('notice/list'); ?>">More</a>
        </div>
        <div class="row">
            <div class="container px-0">
                <div class="swiper-container offerslidetab1 my-3">
                    <div class="swiper-wrapper">
                        <?php foreach ($notice as $n) { ?>
                            <div class="swiper-slide">
                                <div class="card has-background border-0 bg-default">
                                    <div class="background opacity-30">
                                        <img src="<?= base_url(); ?>mdhdesign/uploads/notice/<?= $n->image; ?>" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="font-weight-normal"><?= $n->title; ?></h3>
                                        <p class="text-mute"><?= $n->tanggal; ?></p>
                                        <div class="text-right">
                                            <a href="<?= base_url('notice/detail/' . $n->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $n->title))); ?>" class="btn btn-sm btn-white text-uppercase">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-pagination white-pagination text-left mb-3"></div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Notice End -->
    <!-- <section class="container">
        <div class="section-head">
            <h4 class="title-main">News</h4>
            <a class="c-btn" href="<?= base_url('news/list'); ?>">More</a>
        </div>
        <?php foreach ($news as $row) { ?>
            <div class="post-item">
                <div class="post-asset image">
                    <img src="<?= base_url() . 'mdhdesign/uploads/berita/' . $row->image; ?>" alt="<?= $row->title; ?>">
                </div>
                <div class="post-header">
                    <h3 class="post-title"><a href="<?= base_url('news/detail/' . $row->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $row->title))); ?>" data-loader="show"><?= $row->title; ?></a></h3>
                    <p class="post-description"><?= substr($row->isi, 0, 300); ?></p>
                    <span class="post-category"><i class="fa fa-th-large"></i><?= $row->nama_cat; ?></span>
                    <span class="post-date"><i class="fa fa-clock-o"></i><?= $row->date; ?></span>
                </div>
                <div class="post-footer">
                    <a href="<?= base_url('news/detail/' . $row->id . '/' . strtolower(preg_replace("/[^a-zA-Z0-9]/", "-", $row->title))); ?>" class="post-author">
                        <span class="author-name"><b>Detail News</b></span>
                    </a>
                </div>
            </div>
            <div class="form-mini-divider"></div>
        <?php } ?>
    </section> -->
    <!-- Notice End -->
    <br />
    <br />
    <br />
</main>
</div>
</div>