
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Tarif Tilang</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table" id="dataTables-example">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Nomor</th>
                            <th class="column-title">Jabatan</th>
                            <th class="column-title">1X</th>
                            <th class="column-title">2X</th>
                            <th class="column-title">3X</th>
                            <th class="column-title">4X</th>
                            <th class="column-title">5X</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              $nomor=1;
                              foreach($dataTarif as $row)
                                {
                                  echo "<tr>
                                    <td class='warning'>".$row->id_nominal."</td>
                                    <td class='warning'>".$row->Nm_Jabatan."</td>
                                    <td class='warning'>".$row->tilang_1."</td>
                                    <td class='warning'>".$row->tilang_2."</td>
                                    <td class='warning'>".$row->tilang_3."</td>
                                    <td class='warning'>".$row->tilang_4."</td>
                                    <td class='warning'>".$row->tilang_5."</td>
                                    <td class='warning'><a href = 'editFine/".$row->id_nominal."'>EDIT</a></td>
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

        