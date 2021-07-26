<?php if ($sett->track != 'Ya') { ?>
    <main class="margin">
        <div style="margin-left: 20px; margin-right:20px;">
            <h2 align="center" style="margin-top:50%;">Sorry, it seems that this feature is not activated by your Leader </h2>
            <hr style="border-bottom: 3px solid black;">
            <p align="center">
                <img src="<?= base_url(); ?>mdhdesign/mobile/image/map-01.png" width="400px">
            </p>
        </div>
    </main>
<?php } else { ?>
    <?php if (count($q1->result()) == 1) { ?>
        <div class="mdh-google-map-content pb-100" style="height: 100%;">
            <div id="map_todo_mdh" style="height: 100%; margin-bottom:40px;"></div>
        </div>
    <?php  } else { ?>
        <main class="margin">
            <div style="margin-left: 20px; margin-right:20px;">
                <h2 align="center" style="margin-top:35%;">You haven't done the Check-in for today </h2>
                <p align="center">
                    <img src="<?=base_url();?>mdhdesign/mobile/image/map-02.png" width="400px">
                </p>
            </div>
        </main>
    <?php  } ?>
<?php } ?>