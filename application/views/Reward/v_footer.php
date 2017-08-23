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
    <!-- <script src="<?php echo base_url(); ?>assets/js/Chart.js/dist/Chart.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/Chart.js/dist/Chart.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>

    <script type="text/javascript">
    function showNominal(){
      var level = document.getElementById("level");
      var nominalElement = document.getElementById("nominalReward");
      choosenLevel = level.options[level.selectedIndex].value;

      if(choosenLevel == "PENGAJUAN"){
          nominalElement.value = "Rp. 5.000";
          nominalElement.readOnly = true;
      }else if (choosenLevel == "DIPERTIMBANGKAN"){
          nominalElement.value = "Rp. 25.000";
          nominalElement.readOnly = true;
      }else if (choosenLevel == "MENJADI PROGRAM"){
          nominalElement.value = "Rp. 100.000";
          nominalElement.readOnly = true;
      }else if (choosenLevel == "TEREALISASI"){
          nominalElement.value = "";
          nominalElement.readOnly = false;
      }
    }
      $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });

    $(document).ready(function(){
      var date_input=$('input[name="tanggalPengajuan"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        language: 'id',
        format: 'dd MM yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    });

    $(document).ready(function(){
      var date_input=$('input[name="tanggalPenyerahan"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        language: 'id',
        format: 'dd MM yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    });
    </script>
  </body>
</html>