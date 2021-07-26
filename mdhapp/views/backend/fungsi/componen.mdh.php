<!-- Vendor -->
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery/jquery.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<script src="<?= base_url(); ?>mdhdesign/backend/vendor/owl-carousel/owl.carousel.js"></script>

<!-- Specific Page Vendor -->
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-appear/jquery.appear.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/flot/jquery.flot.categories.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/flot/jquery.flot.resize.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-sparkline/jquery.sparkline.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/raphael/raphael.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/morris/morris.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/gauge/gauge.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/snap-svg/snap.svg.js"></script>
<script src="<?= base_url(); ?>mdhdesign/backend/vendor/liquid-meter/liquid.meter.js"></script>


<!-- Sweet Alert  -->
<script src="<?= base_url(); ?>mdhdesign/frontend/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>mdhdesign/frontend/plugins/sweetalert/dede.js"></script>
<!-- Theme Base, Components and Settings -->
<script src="<?= base_url(); ?>mdhdesign/backend/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="<?= base_url(); ?>mdhdesign/backend/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?= base_url(); ?>mdhdesign/backend/javascripts/theme.init.js"></script>

<?php if ($page == "Map Tracker Today") { ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_8C7p0Ws2gUu7wo0b6pK9Qu7LuzX2iWY&amp;libraries=places&amp;"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/infobox.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/markerclusterer.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/backend/vendor/gmaps/gmaps.js"></script>
    <?= $this->load->view('backend/componen/map_today.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == "Map Tracker") { ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_8C7p0Ws2gUu7wo0b6pK9Qu7LuzX2iWY&amp;libraries=places&amp;"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/infobox.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/frontend/js/markerclusterer.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/backend/vendor/gmaps/gmaps.js"></script>
    <?= $this->load->view('backend/componen/track.mdh.php', '', TRUE); ?>
<?php } ?>
<?php if ($page == 'Dashboard') { ?>
    <!-- Examples -->
    <script>
        Morris.Donut({
            resize: true,
            element: "morrisDonut",
            data: morrisDonutData,
            colors: ["#0088cc", "#734ba9", "#E36159"],
        });

        Morris.Bar({
            resize: true,
            element: "morrisStacked",
            data: morrisStackedData,
            xkey: "y",
            ykeys: ["a", "b"],
            labels: ["Series A", "Series B"],
            barColors: ["#0088cc", "#2baab1"],
            fillOpacity: 0.7,
            smooth: false,
            stacked: true,
            hideHover: true,
        });
    </script>
<?= '<script src="' . base_url() . 'mdhdesign/backend/javascripts/dashboard/examples.dashboard.js"></script>';
} ?>
<?php if (
    $page == "Admin Data" || $page == "Slider Mobile" || $page == "Department List" || $page == "Designation"
    || $page == "Leave Type" || $page == "Leave Approved" || $page == "Leave Pending" || $page == "Leave Rejected"
    || $page == "Pending Raimbes" || $page == "Approval Raimbes" || $page == "Rejected Raimbes" || $page == "Reward Type"
    || $page == "Giving List" || $page == "Notice Type" || $page == "Notice List" || $page == "News Category"
    || $page == "Leave Reports" || $page == "Pending Task" || $page == "Progress Task" || $page == "Done Task"
    || $page == "Salary Allowance" || $page == "Salary Deduction" || $page == "Manage Salary"
) {
    echo '<script src="' . base_url() . 'mdhdesign/backend/javascripts/ui-elements/examples.modals.js"></script>';
} ?>
<?php if (
    $page == "Employee List" || $page == "Employee Out" || $page == "Leave Approved" || $page == "Leave Pending"
    || $page == "Notification" || $page == "Leave Rejected" || $page == "Pending Raimbes" || $page == "Approval Raimbes"
    || $page == "Rejected Raimbes" || $page == "Pending Task" || $page == "Detail Task" || $page == "Done Task"
    || $page == "Progress Task"  || $page == "Giving List" || $page == "Notice List" || $page == "News List"
    || $page == "Leave Reports" || $page == "Task Reports" || $page == "Today Attendance" || $page == "Overtime Reports"
    || $page == "Manage Salary"
) { ?>
    <!-- Data Tables -->
    <script src="<?= base_url(); ?>mdhdesign/backend/plugins/datatables/dataTables.min.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Data tables -->
    <script src="<?= base_url(); ?>mdhdesign/backend/plugins/datatables/custom/custom-datatables.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/backend/plugins/datatables/custom/fixedHeader.js"></script>
<?php } ?>

<?php if (
    $page == "Admin Data" || $page == "Slider Mobile" || $page == "Add Employee" || $page == "Edit Employee"
    || $page == "General Settings" || $page == "Giving List" || $page == "Notice List" || $page == "Add News"
    || $page == "Update News" || $page == "About Company" || $page == "Pending Task" || $page == "Progress Task" || $page == "Done Task"
    || $page == "Payroll Settings" || $page == "Mobile Settings"
) { ?>
    <script src="<?= base_url(); ?>mdhdesign/backend/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Translated


            // Used events 
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
<?php if ($page == "Add Employee" || $page == "Edit Employee" || $page == "Notice List") { ?>
    <!-- Form wizard validation -->
    <script src="<?= base_url(); ?>mdhdesign/backend/vendor/jquery-validation/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/backend/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
    <script src="<?= base_url(); ?>mdhdesign/backend/javascripts/forms/examples.wizard.js"></script>
<?php } ?>
<?php if (
    $page == "Add Employee" || $page == "Edit Employee" || $page == "Add News" || $page == "Update News"
    || $page == "About Company"
) { ?>
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#summernote1').summernote();
            $('#summernote2').summernote();
        });
    </script>
<?php } ?>

<?php if ($page == "Add Employee" || $page == "Edit Employee") { ?>
    <script>
        window.onload = function() {
            $("select[name='id_department']").change(function() {
                var url = "<?php echo base_url('belakang/pegawai/designation'); ?>/" + $(this).val();
                $("select[name='id_designation']").load(url);
                return false;
            });
        };
    </script>
<?php } ?>
<?php if ($page == "Make Payment" || $page == "Manage Salary") { ?>
    <script>
        window.onload = function() {
            $("select[name='id_department']").change(function() {
                var url = "<?php echo base_url('belakang/pegawai/designation'); ?>/" + $(this).val();
                $("select[name='id_designation']").load(url);
                return false;
            });

            $("select[name='id_designation']").change(function() {
                var url = "<?php echo base_url('belakang/payroll/pegawai'); ?>/" + $(this).val();
                $("select[name='id_pegawai']").load(url);
                return false;
            });
        };
    </script>
<?php } ?>
</body>

</html>