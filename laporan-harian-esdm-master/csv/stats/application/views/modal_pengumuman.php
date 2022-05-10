<!-- Modal Login-->
  <div id="form-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background: #3c8dbc">
      <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc">
            <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1">×</button>
            <h4 class="modal-title" style="text-transform: none; color: white"><b>Pengumuman</b></h4>
        </div>
        <div class="modal-body">
	        <div class="form-group">
	        	<h4 class="modal-title" style="text-transform: none;"><b><?=$content_pengumuman->JUDUL_PENGUMUMAN; ?></b></h4> 
	        	<?php echo date("d-m-Y", strtotime($content_pengumuman->TANGGAL_AWAL)); ?>
	        </div>
	        <div class="form-group">
	        	<label><?=$content_pengumuman->PENGUMUMAN; ?></label>
	        </div>
        </div>
      </div>
    </div>
