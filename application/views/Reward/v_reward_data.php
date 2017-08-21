
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

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
            </div>
          </div>
        </div>
        <!-- /page content -->

        