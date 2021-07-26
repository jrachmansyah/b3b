<?php if ($page == "Employee Dashboard") { ?>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/swiper.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/mobile/login/js/main.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/mobile/login/js/app.js"></script>
<?php } else { ?>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/swiper.min.js"></script>
<?php } ?>
<?php if ($page == "My Task" || $page == "Task Detail" || $page == "Raimbes" || $page == "My Account") { ?>
    <script src="<?= base_url(); ?>mdhdesign/backend/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
<?php } ?>

<?php if ($sett->photo != 'Ya') {
    echo "";
} else { ?>
    <?php if ($page == "Attendance") { ?>
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                    navigator.geolocation.getCurrentPosition(showLongtitude);
                    navigator.geolocation.getCurrentPosition(showLatitude);
                } else {
                    console.log("Geolocation is not supported by this browser.");
                }
            }

            function showPosition(position) {
                $('#demo').val("Latitude: " + position.coords.latitude +
                    " Longitude: " + position.coords.longitude);
            }

            function showLongtitude(position) {
                $('#long').val(position.coords.longitude);
            }

            function showLatitude(position) {
                $('#latitude').val(position.coords.latitude);
            }
        </script>
    <?php } ?>
<?php } ?>

<?php if ($sett->track != 'Ya') {
    echo '';
} else { ?>
    <?php if ($page == "Attendance") { ?>
        <?php if (count($q1->result()) != 1) { ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
            <script>
                Webcam.set({
                    width: 350,
                    height: 300,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });

                Webcam.attach('#my_camera');

                $('#my_camera').css('width', '100%');
                $('#my_camera video').css('width', '100%');

                $('#btn-capture').click(function() {
                    console.log('Bersiap');

                    Webcam.snap(function(data_uri) {
                        $(".image-tag").val(data_uri);
                        $('#results').html('<img src="' + data_uri + '" style="width: 100%;"/>');
                    });
                });
            </script>
            <?php } else if (count($q1->result()) == 1) {
            foreach ($q1->result() as $check) {
                if ($check->jam_keluar == null) { ?>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
                    <script>
                        Webcam.set({
                            width: 350,
                            height: 300,
                            image_format: 'jpeg',
                            jpeg_quality: 90
                        });

                        Webcam.attach('#my_camera');

                        $('#my_camera').css('width', '100%');
                        $('#my_camera video').css('width', '100%');

                        $('#btn-capture').click(function() {
                            console.log('Bersiap');

                            Webcam.snap(function(data_uri) {
                                $(".image-tag").val(data_uri);
                                $('#results').html('<img src="' + data_uri + '" style="width: 365px; height:280px; margin-left:0px;"/>');
                            });
                        });
                    </script>
        <?php } else {
                }
            }
        } ?>
    <?php } ?>
<?php } ?>

<?php if ($page == "Today Tracker") { ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_8C7p0Ws2gUu7wo0b6pK9Qu7LuzX2iWY&amp;libraries=places&amp;"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/infobox.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/markerclusterer.js"></script>
    <?= $this->load->view('mobile/componen/map.mdh.php', '', true); ?>
<?php } ?>
<?php if ($page == "Map Tracker") { ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_8C7p0Ws2gUu7wo0b6pK9Qu7LuzX2iWY&amp;libraries=places&amp;"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/infobox.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/markerclusterer.js"></script>
    <?= $this->load->view('mobile/componen/track.mdh.php', '', true); ?>
<?php } ?>

<?php if ($page == "Notice List") { ?>
    <?= $this->load->view('mobile/componen/notice.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == "Award List") { ?>
    <?= $this->load->view('mobile/componen/award.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == "Notification") { ?>
    <?= $this->load->view('mobile/componen/notif.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == "Overtime List") { ?>
    <?= $this->load->view('mobile/componen/overtime.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == "News List") { ?>
    <?= $this->load->view('mobile/componen/news.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == "Salary List") { ?>
    <?= $this->load->view('mobile/componen/salary.mdh.php', '', TRUE); ?>
<?php } ?>