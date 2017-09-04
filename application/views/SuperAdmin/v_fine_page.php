
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
                                    <td class='warning'><button class='btn btn-primary btn-xs'  id = '".$row->id_nominal."@".$row->Nm_Jabatan."@".$row->tilang_1."@".$row->tilang_2."@".$row->tilang_3."@".$row->tilang_4."@".$row->tilang_5."' data-title='Edit' data-toggle='modal' data-target='#editNominal' ><span class='glyphicon glyphicon-pencil'></span></button> |
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
        <!-- Modal -->
        <div id="editNominal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT DATA</h4>
              </div>
              <div class="modal-body">
                 <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/updateNominal" data-parsley-validate class="form-horizontal form-label-left">
                    <input type="hidden" name = "idNominal" id= "idNominal"/>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="chooseJabatanModal">Jabatan<span class="required">*</span>
                      </label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" name="chooseJabatanModal" id="chooseJabatanModal" required>
                        <option value="0-0">-- Pilih Kategori --</option>
                        <?php 
                        foreach($dataJabatan as $row){
                         echo '<option value="'.$row->kode_jabatan.'">'.$row->Nm_Jabatan.'</option>';
                        }
                       ?>
                       </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tilang1">Tilang 1 <span class="required">*</span>
                      </label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="tilang1" name="tilang1" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tilang2">Tilang 2 <span class="required">*</span>
                      </label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="tilang2" name="tilang2" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tilang3">Tilang 3 <span class="required">*</span>
                      </label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="tilang3" name="tilang3" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tilang4">Tilang 4 <span class="required">*</span>
                      </label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="tilang4" name="tilang4" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tilang1">Tilang 5 <span class="required">*</span>
                      </label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="tilang5" name="tilang5" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                   

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">SIMPAN</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div id="deleteNominal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">DELETE DATA</h4>
              </div>
              <div class="modal-body">
                 <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/deleteNominal" data-parsley-validate class="form-horizontal form-label-left">
                    <input type="hidden" name = "idNominalDelete" id= "idNominalDelete"/>
                    <p>Yakin ingin menghapus ?</p>
                    <div class="form-group">
                      <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-6">
                        <button type="submit" class="btn btn-success">YA</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>

        