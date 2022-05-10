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

            <li data-step="4" class="active">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </li>

            <li data-step="5">
              <span class="step">4</span>
              <span class="title">Kirim Permohonan</span>
            </li>
          </ul>
        </div>

        <hr />

      </div>

    </div><!-- /.widget-main -->

    <?=$detail_data_permohonan?>

    <form method="POST" action="<?php echo base_url()?>Permohonan_izin/step3/<?php echo $this->session->userdata('idTemplate')?>">
    <?=get_csrf_token()?>
      <input type="hidden" name="ID_TEMPLATE" value="<?php echo $this->session->userdata('idTemplate')?>">
      <iframe style="margin-top: 10px; border: 0px;" src="<?=$enkriptedQS?>" width="100%" scrolling="no"></iframe>
      <p id="callback">
      </p>
    
    <div style="overflow:auto;">
      <div style="float:left;">
        <a class="btn-sm btn-danger" style="color: white" href="<?php echo site_url('Permohonan_izin') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
      </div>
      <div style="float:right;">
        <!-- <button class="btn-sm btn-info" type="submit"><i class="fa fa-chevron-left"></i> Kembali</a></button> -->
        <a class="btn-sm btn-info" href="<?php echo site_url("Permohonan_izin/step3_edit/{$currentIDPermohonanEdit}") ?>" style="color: white"><i class="fa fa-chevron-left"></i> Kembali</a>        
        <a id="izin-next-step" class="btn-sm btn-success" style="color: white" href="<?php echo base_url()?>Permohonan_izin/step5_edit/<?=$currentIDPermohonanEdit?>">Berikutnya <i class="fa fa-chevron-right"></i></a>
      </div>
    </div>
    </form>
  </div>
</div>

<div id="tempat-modal"></div>


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

  iFrameResize({
        log                     : true,                  // Enable console logging
        inPageLinks             : true,
        resizedCallback         : function(messageData){ // Callback fn when resize is received
          // $('p#callback').html(
          //   '<b>Frame ID:</b> '    + messageData.iframe.id +
          //   ' <b>Height:</b> '     + messageData.height +
          //   ' <b>Width:</b> '      + messageData.width +
          //   ' <b>Event type:</b> ' + messageData.type
          //   );
        },
        messageCallback         : function(messageData){ // Callback fn when message is received
          // $('p#callback').html(
          //   '<b>Frame ID:</b> '    + messageData.iframe.id +
          //   ' <b>Message:</b> '    + messageData.message
          //   );
          alert(messageData.message);
          // document.getElementsByTagName('iframe')[0].iFrameResizer.sendMessage('Hello back from parent page');
        },
        closedCallback         : function(id){ // Callback fn when iFrame is closed
          // $('p#callback').html(
          //   '<b>IFrame (</b>'    + id +
          //   '<b>) removed from page.</b>'
          //   );
        }
      });

  function f_show(obj) {
    if(obj.value){
      $('div[id^=dokumen]').attr("style","display:none");
      $("#dokumen"+obj.value).attr("style","display:block");
    } else {        
      $('div[id^=dokumen]').attr("style","display:none");
    }
  }

  $(document).ready(function(){
    $('#PROVINSI').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>Profile_perusahaan/get_kabkot",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].ID_KABKOT+'">'+data[i].NAMA_KABKOT+'</option>';
          }
          $('.KABKOT').html(html);
        }
      });
    });
  });

  $(document).on("click", "#izin-next-step", function() {
		$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	});
</script>