<div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
    <div class="box-body">
        <div class="input-group form-group" style="width: 100%; background-color: white; padding: 0 0px 10px 0px; border: solid 1px #3c8dbc; border-radius: 5px;">
          <div class="col-md-12" style="background-color: #3c8dbc; color: white; margin: 0 0 15px 0; border-radius: 5px 5px 0 0;">
            <h4><i class="fa fa-file" style="color: #fff000"></i> <strong>Pengesahan</strong></h4>
          </div>
          <div class="col-md-12">
            <?php if($pengesahan_data->status == "CURL_ERROR"): ?>
              <h3 class="text-center"><?=$pengesahan_data->message?></h3>
            <?php elseif($pengesahan_data->status == "success"): ?>
              <h1 class="text-center"><?=$pengesahan_data->message?></h1>
<?php
	$url = 	$pengesahan_data->urlIzin;
	$arr = explode('/',$url);
	$jumlah = count($arr);
	$file =  $arr[$jumlah-1];
	$url = str_replace($file, '',$url);
	$url = str_replace("/IzinPDF", '',$url);
	$url = $url."/IzinPDF/".$file;
?>
              <h4 class="text-center">File Izin: <a href='<?=$url?>' target='_blank'><?=$pengesahan_data->fileIzin?></a></h4>
            <?php else: ?>
              <h1 class="text-center"><?=$pengesahan_data->message?></h1>
            <?php endif; ?>
          </div>
          <div class="col-md-12">
            <a href='<?=base_url("Permohonan_izin_atas")?>'><button class="btn btn-primary pull-right" style="margin-right: 5px">Periksa Izin Lain</button></a>
          </div>
        </div>
    </div>
<div id="tempat-modal"></div>