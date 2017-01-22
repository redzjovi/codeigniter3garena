    <script>
    $(function () {
        var current_url = document.URL;
        $('li > a[href="'+current_url+'"]').parent().addClass('active');
    });
    </script>

    <script src="<?php echo base_url() ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datatables.net-colreorder/js/dataTables.colReorder.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datatables.net-responsive-bs/js/responsive.bootstrap.min.js"></script>
</body>
</html>