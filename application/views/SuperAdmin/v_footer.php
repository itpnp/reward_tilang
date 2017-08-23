<!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/css/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/js/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/css/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/css/iCheck/icheck.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">

      $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
    <script>
    $('#edit').on('show.bs.modal', function(e) {
        var $modal = $(this),
        data = e.relatedTarget.id;
        data = data.split("@");
        $("#idSubCategory").val(data[0]);
        $("#subCategoryNameModal").val(data[1]);
        $("#chooseCategoryModal").val(data[2]);
        })
    </script>
  </body>
</html>