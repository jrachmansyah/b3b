<main class="no-margin">
    <section class="container" style="margin-bottom: 40px;">
        <div class="form-divider"></div>
        <div class="post-item mt-30">
            <div class="post-asset image">
                <img src="<?= base_url(); ?>mdhdesign/uploads/notice/<?= $mdh->image; ?>" alt="<?= $mdh->title; ?>">
            </div>
            <div class="post-header">
                <h1 class="post-title"><?= $mdh->title; ?></h1>
                <span class="post-category"><i class="fa fa-th-large"></i> <?= $mdh->nama_type; ?></span>
                <span class="post-date"><i class="fa fa-clock-o"></i> <?= $mdh->tanggal; ?></span>
            </div>
        </div>
        <div class="post-detail">
            <?= $mdh->isi; ?>
        </div>
        <div class="form-divider"></div>
    </section>
</main>