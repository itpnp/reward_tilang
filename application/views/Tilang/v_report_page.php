<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><small>GENERATE REPORT</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form role="form" action="<?php echo base_url()?>index.php/tilang/generateReport" method="post" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">BULAN</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="bulan">
                      <option value="01">JANUARI</option>
                      <option value="02">FEBRUARI</option>
                      <option value="03">MARET</option>
                      <option value="04">APRIL</option>
                      <option value="05">MEI</option>
                      <option value="06">JUNI</option>
                      <option value="07">JULI</option>
                      <option value="08">AGUSTUS</option>
                      <option value="09">SEPTEMBER</option>
                      <option value="10">OKTOBER</option>
                      <option value="11">NOVEMBER</option>
                      <option value="12">DESEMBER</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">TAHUN</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="tahun">
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                  </select>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success">GENERATE</button>
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
        