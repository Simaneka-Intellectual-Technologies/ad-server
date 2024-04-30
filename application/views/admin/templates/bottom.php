</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<!-- plugins:js -->
<script src="<?= base_url('assets/admin/vendors/js/vendor.bundle.base.js') ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src=" <?= base_url('assets/admin/vendors/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/vendors/progressbar.js/progressbar.min.js') ?>"></script>

<!--End plugin js for this page-->
<!--inject: js-->
<script src="<?= base_url('assets/admin/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/hoverable-collapse.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/template.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/settings.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/todolist.js') ?>"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?= base_url('assets/admin/js/jquery.cookie.js" type="text/javascript') ?>"></script>
<script src="<?= base_url('assets/admin/js/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/Chart.roundedBarCharts.js') ?>"></script>
<!-- Custom js for this page-->
<script src="<?= base_url('assets/admin/js/file-upload.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/typeahead.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/select2.js') ?>"></script>
<script src="<?= base_url('assets/admin/vendors/prism/prism.js') ?>"></script>
<!-- End custom js for this page-->

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
    });
});
</script>
<!-- End custom js for this page-->
</body>

</html>