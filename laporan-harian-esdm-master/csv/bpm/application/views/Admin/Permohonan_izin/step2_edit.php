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
            
            <li data-step="2" class="active">
              <span class="step">1</span>
              <span class="title">Pilih Jenis Izin</span>
            </li>

            <li data-step="3">
              <span class="step">2</span>
              <span class="title">Dokumen Persyaratan</span>
            </li>

            <li data-step="4">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </li>

            <li data-step="5">
              <span class="step">4</span>
              <span class="title">Kirim Permohonan</span>
            </li>
          </ul>
        </div>
        <hr/>
      </div>

    </div><!-- /.widget-main -->


    <form id="main-form" method="POST" action='<?php echo base_url("Permohonan_izin/step3_edit/{$currentIDPermohonanEdit}") ?>'>
    <?=get_csrf_token()?>
     <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
      <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
        <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong>Pilih Jenis Permohonan Izin</strong></h4>
      </div>

      <div class="col-md-12">Permohonan Izin / Non perizinan:</div>
      <div class="col-md-12">
        <select name="ID_FORM" ID="IZIN_INSTANSI" class="form-control">
          <?php foreach ($dataIzinInstansi as $row): ?>
            <option <?php if($row->ID_FORM == "$dataDokumenPrs->ID_FORM"){ echo 'selected="selected"'; } ?> value="<?php echo $row->ID_FORM ?>"><?php echo $row->NAMA_FORM?> </option>          
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-md-12">Jenis</div>
      <div class="col-md-12">
        <select id="template_holder" name="ID_TEMPLATE" class="TEMPLATE form-control" onchange="f_show(this)">
          <?php foreach ($dataTemplate as $parent): ?>
          <option <?php if($parent->ID_TEMPLATE == "$dataDokumenPrs->ID_TEMPLATE"){ echo 'selected="selected"'; } ?> value="<?php echo $parent->ID_TEMPLATE ?>"><?php echo $parent->NAMA_TEMPLATE?> </option>
          <?php endforeach ?>         
        </select>
      </div>

      <?php foreach ($dataTemplateAll as $parent): ?>
        <div id="dokumen<?php echo $parent->ID_TEMPLATE ?>" class="col-md-12" style="display: none">
          <table class="table table-bordered table-striped" style="padding: 10px; border: solid 1px #c0d9ec;">
            <thead>
              <tr>
                <td>#</td>
                <td>Dokumen</td>
                <td>Template</td>
              </tr>
            </thead>
            <tbody>
              <?php 
              $dokumen = $dataDokumen[$parent->ID_TEMPLATE];
              $i = 1;
              foreach ($dokumen as $row): 
                ?>
                <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row['PERSYARATAN'] ?></td>
                  <td><a href='<?=base_url("TemplateContoh/download_template?file={$row['ID_PERSYARATAN']}")?>' target="_blank"><?php echo $row['FILE_CONTOH'] ?></a></td>
                </tr>
              <?php endforeach ?>

            </tbody>
          </table>
        </div>
      <?php endforeach ?>
      <div class="col-md-12">
        <input type="checkbox" checked name="" required> &nbsp; Saya menyetujui <a data-toggle="modal" data-target="#form-sk"  href="" style="color:blue;">syarat dan ketentuan</a> ini.
        
      </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:left;">
        <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin/') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
      </div>
      <div style="float:right;">
        <a class="btn-sm btn-info" href="<?php echo site_url("Permohonan_izin/edit/{$currentIDPermohonanEdit}") ?>" style="color: white"><i class="fa fa-chevron-left"></i> Kembali</a>
        <button id="izin-next-step" type="submit" class="btn-sm btn-success" onclick="nextPrev(1)">Lanjut <i class="fa fa-chevron-right"></i></button>
      </div>
    </div>
  </form>
</div>

<div id="tempat-modal"></div>
<?php echo $modal_sk_permohonan_izin; ?>

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
<script type="text/javascript">

  function f_show(obj) {
    if(obj.value){
      $('div[id^=dokumen]').attr("style","display:none");
      $("#dokumen"+obj.value).attr("style","display:block");
    } else {        
      $('div[id^=dokumen]').attr("style","display:none");
    }
  }
  $(document).ready(function(){
    var templateHolderValue = $("#template_holder").val();
    $('div[id^=dokumen]').attr("style","display:none");
    $("#dokumen"+templateHolderValue).attr("style","display:block");
  });
  $(document).ready(function(){
    $('#IZIN_INSTANSI').change(function(){
      $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
      $('div[id^=dokumen]').attr("style","display:none");
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>Permohonan_izin/get_template",
        method : "POST",
        data : {id: id},
        async : true,
        dataType : 'json',
        success: function(data){
          $.unblockUI();
          var html = '';
          var i;
          html += '<option value="">PILIH</option>';          
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].ID_TEMPLATE+'">'+data[i].NAMA_TEMPLATE+'</option>';
          }
          $('.TEMPLATE').html(html);
        }
      });
    });
  });

  $(document).on("submit", "#main-form", function() {
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	});
</script>