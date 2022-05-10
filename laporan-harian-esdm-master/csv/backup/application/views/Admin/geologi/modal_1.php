<?php
$kemarin = date("d-m-Y", mktime(0,0,0, date("m"), date("d")-1, date("Y")));

?>

<form id="form-tambah" method="POST">
<?=get_csrf_token()?>
			<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div class="main-content">
				<div class="main-content-inner">

					<div class="page-content">
						<div class="page-header">
							<h1>
								Gunung Api ||
                                
                               <!-- <a href="<?php echo base_url("index.php/siswa/form"); ?>">Import Data</a>-->
                                
                                <button class="btn btn-success btn-minier"><a href="<?php echo base_url("index.php/Lap_geologi/form"); ?>">Import Data</a></button> 
							</h1>
                            
                            
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Tanggal Laporan's </div>

										<div class="profile-info-value">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
												<input class="form-control date-picker" name="TANGGAL_LAPORAN" id="id-date-picker-1" type="text" value="<?php echo $kemarin ?>" data-date-format="dd-mm-yyyy" />
                                                <button class="btn btn-success btn-minier"><a href="<?php echo base_url("index.php/Lap_geologi/form"); ?>">Show Before</a></button> 
											</div>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Gunung Api </div>

										<div class="profile-info-value">
											<select required class="form-control" name="ID_GUNUNG">
												<option>---Pilih---</option>
												<?php foreach($gunungSet as $row): ?>
										          <option value="<?php echo $row->ID_GUNUNG ?>"><?php echo $row->NAMA_GUNUNG ?></option>
										        <?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Tingkat Aktivitas </div>

										<div class="profile-info-value">
											<select required class="form-control" name="ID_AKTIVITAS">
												<option>---Pilih---</option>
												<?php foreach($aktivitasSet as $row): ?>
										          <option value="<?php echo $row->ID_AKTIVITAS ?>"><?php echo $row->LEVEL ?></option>
										        <?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Keterangan </div>

										<div class="profile-info-value">
											<textarea required class="form-control" type="text" name="KETERANGAN" placeholder="Keterangan" style="resize: vertical;"></textarea>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Rekomendasi </div>

										<div class="profile-info-value">
											<textarea required class="form-control" type="text" name="REKOMENDASI" placeholder="Rekomendasi" style="resize: vertical;"></textarea>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Vona </div>

										<div class="profile-info-value">
											<textarea required class="form-control" type="text" name="VONA" placeholder="Vona" style="resize: vertical;"></textarea>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Detail </div>

										<div class="profile-info-value">
											<textarea required class="form-control" type="text" name="DETAIL" placeholder="Detail" style="resize: vertical;"></textarea>
										</div>
									</div>
								</div>
								<div class="space-10"></div>
								<div class="profile-user-info profile-user-info-striped" style="border: none;">
									<div class="profile-info-row" style="text-align: right;">
										<!--<button class="btn btn-success">
											<i class="ace-icon fa fa-check-square-o align-top bigger-125"></i>
											Posting
										</button>-->
										<button class="btn btn-primary">
											<i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
											Simpan Draft
										</button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.page-content -->
				</div>
			</div>
			</div>
</form>
<script type="text/javascript">
  jQuery(function($) {

    $('[data-rel=popover]').popover({html:true});
    $('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
    
  });
  
  $('#form-tambah').submit(function(e) {
    var formData = new FormData($(this)[0]);
    var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN").val();
    formData.append("ID_JENIS_LAPORAN", ID_JENIS_LAPORAN);

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('Lap_geologi/prosesTambah'); ?>',
      data: formData,
      processData: false,
            contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);
      if (out.status == 'form') {
        $('.form-msg').html(out.msg);
        effect_msg_form();
      } else {
        document.getElementById("form-tambah").reset();
        $('.msg').html(out.msg);
        effect_msg();
      }
    })
    .error(function(data) {
      console.log(data);
    })

    e.preventDefault();
  });
</script>