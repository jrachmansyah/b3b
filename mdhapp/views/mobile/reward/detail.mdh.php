<main class="no-margin">
    <section class="container" style="margin-bottom: 40px;">
        <div class="form-divider"></div>
        <div class="post-item mt-30">
            <div class="post-asset image">
                <img src="<?= base_url(); ?>mdhdesign/uploads/reward/<?= $mdh->image; ?>" alt="<?= $mdh->nama_type; ?>">
            </div>
            <div class="post-header">
                <h1 class="post-title"><?= $mdh->nama_type; ?></h1>
                <span class="post-date"><i class="fa fa-clock-o"></i> <?= $mdh->tanggal; ?></span>
            </div>
        </div>
        <div class="post-detail">
            <h3 align="center">Congratulations to <?= $mdh->nama_awal; ?> <?= $mdh->nama_akhir; ?></h3>
            <div class="form-divider"></div>
            <?= $mdh->deskripsi; ?>
        </div>
        <div class="form-divider"></div>
    </section>
</main>