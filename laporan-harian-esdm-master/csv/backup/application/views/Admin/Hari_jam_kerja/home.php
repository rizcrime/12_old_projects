<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<div class="box">
  <div class="box-header">

  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <?=form_open("JamKerja/ubah", array("class" => "form-horizontal"))?>
    <div class="form-group">
        <label for="startHour" class="col-sm-2 control-label">Jam Masuk</label>
        <div class="col-sm-2">
        <input type="text" name="START_HOUR" class="form-control" id="startHour" value="<?=$work_hour->START_HOUR?>" placeholder="Start">
        </div>
    </div>
    <div class="form-group">
        <label for="endHour" class="col-sm-2 control-label">Jam Pulang</label>
        <div class="col-sm-2">
        <input type="text" name="END_HOUR" class="form-control" id="endHour" value="<?=$work_hour->END_HOUR?>" placeholder="End">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
    <?=form_close()?>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    window.onload = function() {
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}
	function effect_msg() {
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}
    $('#startHour').timepicker({
        timeFormat: 'HH:mm:ss'
    });
    $('#endHour').timepicker({
        timeFormat: 'HH:mm:ss'
    });
</script>