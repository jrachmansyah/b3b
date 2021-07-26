<!-- end: page -->
</section>
</div>
<aside id="sidebar-right" class="sidebar-right">
    <div class="nano">
        <div class="nano-content">
            <a href="#" class="mobile-close visible-xs">
                Collapse <i class="fa fa-chevron-right"></i>
            </a>

            <div class="sidebar-right-wrapper">
                <div class="sidebar-widget widget-calendar">
                    <h6>Calendar</h6>
                    <div data-plugin-datepicker data-plugin-skin="dark"></div>
                </div>

                <div class="sidebar-widget widget-friends">
                    <h6><?= $this->lang->line('absensi'); ?> <?= $this->lang->line('today'); ?> </h6>
                    <ul>
                        <?php foreach ($mdhatt as $todayatt) { ?>
                            <li class="status-online">
                                <figure class="profile-picture">
                                    <img src="<?= base_url(); ?><?= $todayatt->image_masuk; ?>" alt="<?= $todayatt->nama_awal . ' ' . $todayatt->nama_akhir; ?>" class="img-circle" />
                                </figure>
                                <div class="profile-info">
                                    <span class="name"><?= $todayatt->nama_awal . ' ' . $todayatt->nama_akhir; ?></span>
                                    <span class="title" style="color: white;">Check-in : <?= $todayatt->jam_masuk; ?></span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>
</section>
<?php include 'componen.mdh.php'; ?>