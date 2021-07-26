<main class="no-margin">
    <section class="container" style="margin-bottom: 40px;">
        <div class="form-divider"></div>
        <div class="post-item mt-30">
            <div class="post-header">
                <h1 class="post-title"><?= $mdh->title; ?></h1>
                <span class="post-date"><i class="fa fa-clock-o"></i> <?= $mdh->tanggal; ?></span>
            </div>
        </div>
        <div class="post-detail">
            <?= $mdh->isi; ?>
        </div>
    </section>
</main>