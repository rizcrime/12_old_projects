 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
 <style type="text/css">
 button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}
</style>

<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">
    <div class="widget-main">
      <div id="fuelux-wizard-container">
        <div>
          <ul class="steps">
            <li data-step="1">
              <a href="<?php echo site_url("Permohonan_izin/edit/{$currentIDPermohonanEdit}") ?>" style="display: block;">
                <span class="step">#</span>
                <span class="title">Profile Perusahaan</span>
              </a>
            </li>
            
            <li data-step="2">
              <a href="<?php echo site_url("Permohonan_izin/step2_edit/{$currentIDPermohonanEdit}") ?>" style="display: block;">
                <span class="step">1</span>
                <span class="title">Pilih Jenis Izin</span>
              </a>
            </li>

            <li data-step="3" >
            <a href="<?php echo site_url("Permohonan_izin/step3_edit/{$currentIDPermohonanEdit}") ?>" style="display: block;">
              <span class="step">2</span>
              <span class="title">Dokumen Persyaratan</span>
            </a>
            </li>

            <li data-step="4">
            <a href="<?php echo site_url("Permohonan_izin/step4_edit/{$currentIDPermohonanEdit}") ?>" style="display: block;">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </a>
            </li>

            <li data-step="5" class="active">
              <span class="step">4</span>
              <span class="title">Kirim Permohonan</span>
            </li>
          </ul>
        </div>
        <hr />
      </div>
    </div><!-- /.widget-main -->

    <?=form_open("Permohonan_izin/kirimPermohonan")?>
      <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
        <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
          <h4>Pernyataan</h4>
        </div>
        <div class="profile-user-info profile-user-info-striped" style="text-align:justify;"> 
          <?= $sk_permohonan->DESKRIPSI ?>
          <div class="checkbox">
            <label class="block">
              <input type="checkbox" value="Y" name="isSetuju" id="isSetuju" class="ace input-lg" required><span class="lbl"> Saya setuju dengan pernyataan di atas </span>
            </label>
          </div>
        </div>
      </div>

      <div style="overflow:auto;">
        <div style="float:left;">
          <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
        </div>
        <div style="float:right;">
          <a class="btn-sm btn-info" href="<?php echo base_url()?>Permohonan_izin/step4_edit/<?=$currentIDPermohonanEdit?>" class="btn-sm btn-info"><i class="fa fa-chevron-left"></i> Kembali</a>
          <button class="btn-sm btn-success" class="btn-sm btn-success">Kirim <i class="fa fa-chevron-right"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>

<style type="text/css">
textarea{
  width: 100%;
  resize: vertical;
}
div.col-md-12{
  margin-top: 10px;
}
div.col-md-8{
  padding: 0;
}
.steps li.active .step{
  background-color: #fff000;
}
table.table-bordered thead td{
  background-color: #c0d9ec;
  color: black;
  font-weight: 700;
}
</style>