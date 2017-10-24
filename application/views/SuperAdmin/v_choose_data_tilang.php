        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Welcome Home, <?php if($nama!=null) echo $nama ;?> </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DATA TILANG</h2>
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
                            <th class="column-title">#</th>
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
                                    <td class='warning'><a href = 'editTilang/".$row->id_tilang."'>EDIT</a></td>
                                    </tr>"
                                  ;
                                }
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div><!-- end of x_content-->
                </div><!-- end of x_panel-->
              </div><!-- end of div col md 12 -->
            </div><!-- end of div row -->
          </div>
        </div>
        <!-- /page content -->