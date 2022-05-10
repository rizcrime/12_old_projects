<div class="panel-group" style="width: 100%; background-color: white; border: solid 1px #3c8dbc; border-radius: 5px;margin-bottom: 5px;">
  <div id="data-permohonan-accordion" class="panel panel-default" style="border: none;">
    <div class="panel-heading" style="padding: 1px 15px 1px 15px; background-color: #3c8dbc;" data-toggle="collapse" data-target="#data-permohonan-collapse">
      <div class="panel-title">
        <h4><i class="fa fa-file-text" style="color: #fff000"></i> <strong style="color: white;">Data Permohonan</strong><span class="accordion-mark"></span></h4>
      </div>
    </div>
    <div id="data-permohonan-collapse" class="panel-collapse collapse">
      <div class="panel-body">
        <form>
        <?=get_csrf_token()?>
          <iframe style="margin-top: 10px; border: 0px;" src="<?=$enkriptedQSDataPermohonan?>" width="100%" scrolling="no"></iframe>
          <p id="callback"></p>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
iFrameResize({
      inPageLinks             : true,
      resizedCallback         : function(messageData){ // Callback fn when resize is received
      },
      messageCallback         : function(messageData){ // Callback fn when message is received
        alert(messageData.message);
      },
      closedCallback         : function(id){ // Callback fn when iFrame is closed
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
</script>