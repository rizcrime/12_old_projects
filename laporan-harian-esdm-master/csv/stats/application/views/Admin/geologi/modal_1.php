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
                                
                                <!--<button class="btn btn-success btn-minier" type="file">-->
                               <!-- <input type="button" class="upbtn" value="Upload File"  />-->
                                <!--<a href="<?php echo base_url("index.php/Lap_geologi/form"); ?>">Import Data</a>-->
                                <!--</button> -->
                                
	<form id="submit">
		<!-- 
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file">
		
		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<button type="submit">Submit</button>
	</form>
							</h1>
                            
                            
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Tanggal Laporan </div>

										<div class="profile-info-value">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
												<input class="form-control date-picker" name="TANGGAL_LAPORAN" id="id-date-picker-1" type="text" value="<?php echo $kemarin ?>" data-date-format="dd-mm-yyyy" />
                                                <button  type="button" class="btn btn-success btn-minier" onclick="GunungApiGet()" id="select-gunung">Show Before</button>  
											</div>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Gunung Api </div>

										<div class="profile-info-value">

											<select required class="form-control" name="ID_GUNUNG" id="select-gunung">

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
										<div class="profile-info-name"> Seismograf </div>

										<div class="profile-info-value">
											<textarea required class="form-control" type="text" name="KETERANGAN" placeholder="Seismograf" style="resize: vertical;"></textarea>
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
  
function MigasGet(){
		alert('hehe');
		$(document).ready(function(){
 
        $('#submit').submit(function(e){
            e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>index.php/Lap_geologi/importData',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                          alert("Upload Image Berhasil.");
                   }
                 });
            });
       }); 
   }
  
  function GunungApiGet(){
	 var tanggal = $('#id-date-picker-1').val();
	//alert(tanggal); 
	// lakukan ajax 
	// untuk mendapatkan keterangan dan detail  sebelum tanggal tersebut
	$.ajax({
		type: "GET",
		dataType: "JSON",
		async: true,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		url: "<?php echo site_url('Lap_geologi/showBeforeDateGunungApi'); ?>",
		data: {
			"tanggal": tanggal
		},
		success: function(response){
			//var dataa = JSON.parse(response.KETERANGAN);
			//alert(dataa);
			//console.log(response["keterangan"]);
			//alert(response.keterangan);
			// tampilkan pada form di field keterangan dan detail
			
			$('select[name="ID_GUNUNG"]').val(response.id_gunung);
			$('select[name="ID_AKTIVITAS"]').val(response.id_aktivitas);
			//alert(response.gunung);
			$('textarea[name="REKOMENDASI"]').val(response.rekomendasi);
			$('textarea[name="VONA"]').val(response.vona);
			$('textarea[name="DETAIL"]').val(response.detail);
			$('textarea[name="KETERANGAN"]').val(response.keterangan);
			
		},
		error: function(jqXHR, textStatus, errorThrown) {
		   console.log(textStatus, errorThrown);
		}
	});
	
	//var detail = $('').val;
	//alert(keterangan);
  }
</script>
<script type="text/javascript">
    $(document).ready(function(){
 
        $('#submit').submit(function(e){
            e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>index.php/Lap_geologi/importData',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                          alert("Upload Image Berhasil.");
                   }
                 });
            });
         
 
    });
     
</script>