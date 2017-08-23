<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small>REGISTRASI REWARD</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form role="form" action="<?php echo base_url()?>index.php/reward/saveLean" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pengajuan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="date" name="tanggalPengajuan" type="text" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">NIK</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="nik" value="<?php if($dataKaryawan != null) echo $dataKaryawan->NIK ;?>" name = "nik" type="text" required readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Karyawan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="namaKaryawan" value="<?php if($dataKaryawan != null) echo $dataKaryawan->Nm_Karyawan ;?>" name="namaKaryawan" type="text" required disabled/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Proposal</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="judulProposal" name="judulProposal" type="text" required/>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
          </form>
        </div>
        </div>
        </div>
    </div>
  </div>
</div>
<!-- /page content -->
        