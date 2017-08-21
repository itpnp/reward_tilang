<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>REWARD CONFERMENT</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form role="form" action="<?php echo base_url()?>index.php/reward/saveBounty" method="post" data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" value="<?php if($dataLean != null) echo $dataLean->id_lean; ?>" name="idLean">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Pengajuan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="date" value="<?php if($dataLean != null) echo date('d/m/Y',strtotime($dataLean->tanggal_pengajuan)); ?>" name="tanggalPengajuan" type="text" readonly />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">NIK</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="nik" value="<?php if($dataLean != null) echo $dataLean->nik; ?>" name = "nik" type="text" required readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Karyawan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="namaKaryawan" value="<?php if($dataLean != null) echo $dataLean->Nm_Karyawan; ?>" name="namaKaryawan" type="text" required readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Proposal</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="judulProposal" value="<?php if($dataLean != null) echo $dataLean->judul; ?>" name="judulProposal" type="text" readonly/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Penyerahan Reward</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="date" name="tanggalPenyerahan" type="text"/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">REWARD LEVEL</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" onChange="showNominal()" id="level" name="level">
                        <option value="PENGAJUAN">PENGAJUAN</option>
                        <option value="DIPERTIMBANGKAN">DIPERTIMBANGKAN</option>
                        <option value="MENJADI PROGRAM">MENJADI PROGRAM</option>
                        <option value="TEREALISASI">TEREALISASI</option>
                      </select>
                    </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMINAL REWARD</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input class="form-control" id="nominalReward" value="Rp. 5.000" name="nominalReward" type="text" readonly />
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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
<script type=" type="text/Javascript"">

</script>
<!-- /page content -->
        