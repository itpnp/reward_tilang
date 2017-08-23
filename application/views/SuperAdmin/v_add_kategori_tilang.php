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
                  <td class='warning'><a href = 'editKategori/".$row->id_kategori."'>EDIT</a> |
                  <a href = 'deleteCategory/".$row->id_kategori."'>DELETE</a>
                  </td>
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
<!-- /page content -->
        