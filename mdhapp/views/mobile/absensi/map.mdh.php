<?php if ($absen->long_masuk == null) { ?>
    <main class="margin">
        <div style="margin-left: 20px; margin-right:20px;">
            <h2 align="center" style="margin-top:30%;">Sorry, we couldn't track where you were standing </h2>
            <hr style="border-bottom: 3px solid black;">
            <p align="center">
                <img src="<?= base_url(); ?>mdhdesign/mobile/image/map-02.png" width="400px">
            </p>
        </div>
    </main>
<?php } else { ?>
    <div class="mdh-google-map-content pb-100" style="height: 100%;">
        <div id="map_todo_mdh" style="height: 100%; margin-bottom:40px;"></div>
    </div>
<?php } ?>