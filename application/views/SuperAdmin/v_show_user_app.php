
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
                                    <td class='warning'><button class='btn btn-primary btn-xs'  id = '".$row->id_akses."@".$row->hak_akses."@".$row->username."' data-title='Edit' data-toggle='modal' data-target='#editUser' ><span class='glyphicon glyphicon-pencil'></span></button> |  <button class='btn btn-danger btn-xs' id = '".$row->id_akses."' data-title='Edit' data-toggle='modal' data-target='#deleteUser' ><span class='glyphicon glyphicon-trash'></span></button></td>
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
    <div id="editUser" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">EDIT DATA</h4>
          </div>
          <div class="modal-body">
             <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/updateUserApp" data-parsley-validate class="form-horizontal form-label-left">
                <input type="hidden" name = "idUser" id= "idUser"/>

                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="subCategoryName">Hak Akses<span class="required">*</span>
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12" name="chooseUserAppModal" id="chooseUserAppModal" required>
                    <option value="0">-- Pilih Hak Akses --</option>
                    <?php 
                    echo $dataPengguna->hak_akses;
                    if($dataPengguna->hak_akses == 'TILANG'){
                     echo  '<option value=TILANG>TILANG</option>
                                <option value=KABAG>KABAG</option>
                                <option value=REWARD>REWARD</option>
                                <option value=SUPER ADMIN>SUPER ADMIN</option>';
                    }
                     else if($dataPengguna->hak_akses == 'REWARD'){
                     echo  '<option value=REWARD>REWARD</option>
                                <option value=KABAG>KABAG</option>
                                <option value=TILANG>TILANG</option>
                                <option value=SUPER ADMIN>SUPER ADMIN</option>';
                    }
                      else if($dataPengguna->hak_akses == 'KABAG'){
                     echo  '<option value=KABAG>KABAG</option>
                                <option value=REWARD>REWARD</option>
                                <option value=TILANG>TILANG</option>
                                <option value=SUPER ADMIN>SUPER ADMIN</option>';
                    }
                     else if($dataPengguna->hak_akses == 'SUPER ADMIN'){
                     echo  '<option value=SUPER ADMIN>SUPER ADMIN</option>
                                <option value=REWARD>REWARD</option>
                                <option value=TILANG>TILANG</option>
                                <option value=KABAG>KABAG</option>';
                    }
                   ?>
                   </select>
                  </div>
                </div>
               
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Username">Username <span class="required">*</span>
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="text" id="UsernameModal" name="Username" class="form-control col-md-7 col-xs-12" required>
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Pass">Password <span class="required">*</span>
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="password" id="PassModal" name="Pass" class="form-control col-md-7 col-xs-12" required>
                  </div>
                </div>
                  <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="ConfirmPass">Confirm Password <span class="required">*</span>
                  </label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="text" id="ConfirmPassModal" name="ConfirmPass" class="form-control col-md-7 col-xs-12" required>
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
    <div id="deleteUser" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">DELETE DATA</h4>
          </div>
          <div class="modal-body">
             <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/deleteUserApp" data-parsley-validate class="form-horizontal form-label-left">
                <input type="hidden" name = "idUserDelete" id= "idUserDelete"/>
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


        