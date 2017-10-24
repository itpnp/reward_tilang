



        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <form role="form" action="<?php echo base_url()?>index.php/kabag/search" method="post" data-parsley-validate class="form-horizontal form-label-left">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>SEARCH</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">BULAN</label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                      <select class="form-control" name="bulan">
                        <option value="01">JANUARI</option>
                        <option value="02">FEBRUARI</option>
                        <option value="03">MARET</option>
                        <option value="04">APRIL</option>
                        <option value="05">MEI</option>
                        <option value="06">JUNI</option>
                        <option value="07">JULI</option>
                        <option value="08">AGUSTUS</option>
                        <option value="09">SEPTEMBER</option>
                        <option value="10">OKTOBER</option>
                        <option value="11">NOVEMBER</option>
                        <option value="12">DESEMBER</option>
                      </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                      <select class="form-control" name="tahun">
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                      </select>
                      </div>
                      <button type="submit" class="btn btn-success">CARI</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DATA TILANG - <?php if($departemen!=null) echo $departemen ;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table" id="dataTables-example">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">NIK </th>
                            <th class="column-title">NAMA KARYAWAN</th>
                            <th class="column-title">TANGGAL TILANG </th>
                            <th class="column-title">KATEGORI</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                              $nomor=1;
                              foreach($dataTilang as $row)
                                {
                                  echo "<tr>
                                    <td class='warning'>".$row->NIK."</td>
                                    <td class='warning'>".$row->Nm_Karyawan."</td>
                                    <td class='warning'>".date('d M Y',strtotime($row->tanggal_tilang))."</td>
                                    <td class='warning'>".$row->nama_kategori."</td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div><!-- end of x_content-->
                </div><!-- end of x_panel-->
              </div><!-- end of div col md 12 -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tilang Chart</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
            </div><!-- end of div row -->
          </div>
        </div>
        <!-- /page content -->

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
    var obj = <?php if($dataTilangArray!=null )echo json_encode($dataTilangArray); ?>;
    var limaR = 0;
    var smk3 = 0;
    var smp = 0;
    var kedisiplinan = 0;
    var keterlambatan = 0;
    var evaluasi = 0;
    var jumlahData = 0;
    for(var i=0; i<obj.length;i++){
      console.log(obj[i][1]);
      if(obj[i][1] == "5R"){
        limaR++;
      }else if(obj[i][1] == "SMK3"){
        smk3++;
      }else if(obj[i][1] == "SMP"){
        smp++;
      }else if(obj[i][1] == "KEDISIPLINAN"){
        kedisiplinan++;
      }else if(obj[i][1] == "KETERLAMBATAN"){
        keterlambatan++;
      }else if(obj[i][1] == "EVALUASI DAN PENCAPAIAN SASARAN MUTU"){
        evaluasi++;
      }
      jumlahData++;
    }
    if(obj != null){
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        scaleOverride : true,
        scaleSteps : 10,
        scaleStepWidth : 50,
        scaleStartValue : 0,
        type: 'bar',
        data: {
            labels: ["5R", "SMK3", "SMP", "KEDISIPLINAN", "KETERLAMBATAN", "SASARAN MUTU"],
            datasets: [{
                label: 'Jumlah Tilang',
                data: [limaR, smk3, smp, kedisiplinan, keterlambatan, kedisiplinan,evaluasi],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        max : jumlahData, 
                        stepSize: 1,
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    }

      $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

        