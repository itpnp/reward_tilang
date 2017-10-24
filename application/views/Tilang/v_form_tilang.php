<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <form role="form" action="<?php echo base_url()?>index.php/tilang/saveTilang" method="post" data-parsley-validate class="form-horizontal form-label-left">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small>DATA PELAKU</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">NIK</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="nik" value="<?php if($dataKaryawan != null) echo $dataKaryawan->NIK ;?>" name = "nik" type="text" required readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Karyawan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="namaKaryawan" value="<?php if($dataKaryawan != null) echo $dataKaryawan->Nm_Karyawan ;?>" name="namaKaryawan" type="text" required readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Tilang Bulan Ini </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="namaKaryawan" value="<?php if($jumlahTilang != null) echo $jumlahTilang->total ;?>" name="namaKaryawan" type="text" required readonly/>
                </div>
              </div>
              <div class="ln_solid"></div>
        </div>
        </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small>DATA TILANG</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pelanggaran</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="date" name="tanggalTilang" type="text" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="chooseCategory" id="chooseCategory" onChange="showSubCategory()">
                  <option value="">-- Pilih Kategori --</option>
                  <?php 
                  foreach($dataKategori as $row){
                   echo '<option value="'.$row->id_kategori.'">'.$row->nama_kategori.'</option>';
                  }
                 ?>
                 </select>
                 </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Kategori</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="chooseSubCategory" id="chooseSubCategory" required>
                  <option value="">-- Pilih Sub Kategori --</option>
                 </select>
                 </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMINAL</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="nominalTilang" value="<?php if($dendaTilang != null) echo $dendaTilang;?>" name = "nominalTilang" type="text" required readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">KETERANGAN</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="keterangan" name = "keterangan" type="text" required />
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

        </div>
        </div>
        </div>
    </div>
    </form>

  </div>
</div>
<!-- /page content -->
<script type="text/javascript">
  var order = [];
  function showSubCategory(){
    var e = document.getElementById("chooseCategory");

    var subCategory= <?php echo json_encode($subCategory); ?>;

    var idCategory;
    if(e.options[e.selectedIndex].value != "0-0"){
      idCategory = e.options[e.selectedIndex].value;
    }
    var f = document.getElementById("chooseSubCategory");
    f.options.length = 0;
    var firstRow = document.createElement('option');
    firstRow.value = "";
    firstRow.innerHTML = "-- Pilih Sub Kategori --";
    f.appendChild(firstRow);

    for (var i = 0; i<subCategory.length; i++){
      if(typeof subCategory[i][1] !=='undefined'){
        if(subCategory[i][1]==idCategory){
          var opt = document.createElement('option');
          opt.value = subCategory[i][0];
          opt.innerHTML = subCategory[i][2];
          f.appendChild(opt);
        }
      }
    }
  }
</script>

        