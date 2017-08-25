
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Karyawan</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table" id="dataTables-example">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">NIK </th>
                            <th class="column-title">NAMA KARYAWAN</th>
                            <!-- <th class="column-title">BAGIAN </th> -->
                            <th class="column-title">AKSES </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                              $nomor=1;
                              foreach($dataPengguna as $row)
                                {
                                  echo "<tr>
                                    <td class='warning'>".$row->NIK."</td>
                                    <td class='warning'>".$row->Nm_Karyawan."</td>
                                    
                                    <td class='warning'>".$row->hak_akses."</td>
                                    <td class='warning'><a href = 'editDataKaryawan/".$row->id_akses."'>EDIT</a></td>
                                    </tr>";
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

        