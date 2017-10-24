
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <form role="form" action="<?php echo base_url()?>index.php/reward/searchByMonth" method="post" data-parsley-validate class="form-horizontal form-label-left">
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
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Reward</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table" id="dataTables-example">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Judul Proposal </th>
                            <th class="column-title">NAMA KARYAWAN</th>
                            <th class="column-title">BAGIAN </th>
                            <th class="column-title">Tanggal Pengajuan</th>
                            <th class="column-title">STATUS </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                              foreach($dataReward as $row)
                                {
                                  if($row->tanggal_penyerahan_reward == null){
                                    echo "<tr>
                                      <td class='warning'>".$row->judul."</td>
                                      <td class='warning'>".$row->Nm_Karyawan."</td>
                                      <td class='warning'>".$row->Nm_Bagian."</td>
                                      <td class='warning'>".$row->tanggal_pengajuan."</td>
                                      <td class='warning'>".$row->level_reward."</td>
                                      <td class='warning'><a href = 'registerBounty/".$row->id_lean."'>Give a Reward !</a></td>
                                      </tr>";

                                  }else{
                                    echo "<tr>
                                      <td class='warning'>".$row->judul."</td>
                                      <td class='warning'>".$row->Nm_Karyawan."</td>
                                      <td class='warning'>".$row->Nm_Bagian."</td>
                                      <td class='warning'>".$row->tanggal_pengajuan."</td>
                                      <td class='warning'>".$row->level_reward."</td>
                                      <td class='warning'>REWARDED</td>
                                      </tr>";
                                  }
                                  
                                }
                            ?>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reward Chart</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
    var obj = <?php if($dataRewardArray!=null )echo json_encode($dataRewardArray); ?>;
    var jumlahPengajuan = 0;
    var jumlahDipertimbangkan = 0;
    var jumlahProgram = 0;
    var jumlahRealisasi = 0;
    var jumlahData = 0;
    for(var i=0; i<obj.length;i++){
      console.log(obj[i][1]);
      if(obj[i][1] == "PENGAJUAN"){
        jumlahPengajuan++;
      }else if(obj[i][1] == "DIPERTIMBANGKAN"){
        jumlahDipertimbangkan++;
      }else if(obj[i][1] == "MENJADI PROGRAM"){
        jumlahProgram++;
      }else if(obj[i][1] == "REALISASI"){
        jumlahRealisasi++;
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
            labels: ["PENGAJUAN", "DIPERTIMBANGKAN", "MENJADI PROGRAM", "REALISASI"],
            datasets: [{
                label: 'Jumlah Proposal Lean',
                data: [jumlahPengajuan, jumlahDipertimbangkan, jumlahProgram, jumlahRealisasi],
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
  </body>
</html>
        <!-- /page content -->

        