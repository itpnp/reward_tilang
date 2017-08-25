<!-- page content -->
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><small>TAMBAH KATEGORI BARU</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/saveKategori" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoryName">Nama Kategori <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="categoryName" name="categoryName" class="form-control col-md-7 col-xs-12" required>
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
    </div> <!-- END OF DIV CLASS X_PANEL-->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><small>DATA KATEGORI</small></h2>
          <div class="clearfix"></div>
        </div>
         <div class="x_content">
          <div class="table-responsive">
            <table class="table table-striped jambo_table" id="dataTables-example">
              <thead>
                <tr class="headings">
                  <th class="column-title">ID KATEGORI </th>
                  <th class="column-title">NAMA KATEGORI</th>
                  <th class="column-title">ACTION </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($dataKategori as $row)
                {
                echo "<tr>
                  <td class='warning'>".$row->id_kategori."</td>
                  <td class='warning'>".$row->nama_kategori."</td>
                  <td class='warning'><button class='btn btn-primary btn-xs' id = '".$row->id_kategori."@".$row->nama_kategori."' data-title='Edit' data-toggle='modal' data-target='#editCategory' ><span class='glyphicon glyphicon-pencil'></span></button> |  <button class='btn btn-danger btn-xs' id = '".$row->id_kategori."' data-title='Edit' data-toggle='modal' data-target='#deleteCategory' ><span class='glyphicon glyphicon-trash'></span></button>
                </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div> <!-- END OF DIV CLASS ROW-->
</div>
<!-- Modal -->
<div id="editCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT DATA</h4>
      </div>
      <div class="modal-body">
         <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/updateCategory" data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" name = "idCategory" id= "idCategory"/>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="categoryName">Nama Kategori <span class="required">*</span>
              </label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="categoryNameModal" name="categoryName" class="form-control col-md-7 col-xs-12" required>
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
<div id="deleteCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DELETE DATA</h4>
      </div>
      <div class="modal-body">
         <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/programmer/deleteCategory" data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" name = "idCategoryDelete" id= "idCategoryDelete"/>
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

<!-- /page content -->
        