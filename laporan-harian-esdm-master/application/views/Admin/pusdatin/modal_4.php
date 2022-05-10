<?php
$kemarin = date("d-m-Y", mktime(0,0,0, date("m"), date("d")-1, date("Y")));


//echo $kemarin.'test';

?>
<!--<form id="form-tambah" method="POST">
<?=get_csrf_token()?>-->

 <div class="main-container ace-save-state" id="laporan4">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div class="main-content">
				<div class="main-content-inner">

					<div class="page-content">
						<div class="page-header">
							<h1>
								Produksi Ekuivalen Minyak dan Gas
							</h1>
						</div><!-- /.page-header -->
<!-- Upload CSV -->                                                
<form id="upload" method="POST" enctype="multipart/form-data">
<?=get_csrf_token()?>
    <!--<div class="row">-->
        <div class="profile-info-name"> File CSV </div>
        <div class="profile-info-value">
        	<input type="file" name="userfile" class="btn-sm btn-primary">
        	
        </div>
        
        <div class="profile-info-value">
            <button id="upload" type="submit" class="btn-sm btn-primary">Import CSV<i class="fa fa-upload"></i></button>   
        </div>
    <!--</div>-->
</form>  
<!-- END Upload CSV --> 
                        
                        
<form id="form-tambah" method="POST">
<?=get_csrf_token()?>						<div class="row">
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Tanggal Laporan </div>

										<div class="profile-info-value">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
												<input class="form-control date-picker" name="TANGGAL_LAPORAN" id="id-date-picker-1" type="text" value="<?php echo $kemarin ?>" data-date-format="dd-mm-yyyy" disabled />
                                                <button  type="button" class="btn btn-success btn-minier" onclick="ProdGasGet()" id="select-gunung">Show Before</button> 
											</div>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Produksi Harian (BOEPD)</div>

										<div class="profile-info-value">
											<input required class="form-control" type="number" name="PROD_HARIAN" id="PROD_HARIAN" placeholder="Produksi Harian">
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Rata - rata Produksi Bulanan (BOEPD)</div>

										<div class="profile-info-value">
											<input required class="form-control" type="number" name="PROD_BULANAN" id="PROD_BULANAN" placeholder="Produksi Bulanan">
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Rata - rata Produksi Tahunan (BOEPD)</div>

										<div class="profile-info-value">
											<input required class="form-control" type="number" name="PROD_TAHUNAN" id="PROD_TAHUNAN" placeholder="Produksi Tahunan">
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Target APBN (BOEPD)</div>

										<!--<div class="profile-info-value">
											<input required class="form-control" type="number" name="APBN" id="APBN" placeholder="Target APBN">
										</div>-->
                                        
                                        
                                        <div class="profile-info-value">
                                        	
                                             <?php
      //include 'koneksi.php';
    // $mahasiswa = mysqli_query($koneksi, "SELECT * from mahasiswa");
    $dataTahunTargetProdMinyak = $this->db->query("SELECT APBN_EKV_MIGAS from t_target where TAHUN = '".date('Y')."' ORDER BY ID_TARGET DESC limit 1");
      $no=1;
      foreach ($dataTahunTargetProdMinyak->result_array() as $row)
    {
    ?>
											<input required class="form-control" type="number" name="APBN" id="APBN" value="<?php echo $row['APBN_EKV_MIGAS'] ?>" readonly>
                                            <?php } ?>
										</div>
                                        
                                        
									</div>
                                    
                                    <div class="profile-info-row">
										<div class="profile-info-name">*Catatan</div>

										<div class="profile-info-value">
											<textarea  class="form-control" type="text" name="CATATAN" id="CATATAN" placeholder="Catatan" style="width: 80%;min-height:88px;"></textarea>
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
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div>
	</form>
    
<script type="text/javascript">
// Submit upload
    $('#upload').submit(function(e) {
        var form = $('#upload')[0];
        var formData = new FormData(form);
    
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '<?php echo base_url('Lap_pusdatin/prosesUploadEkv'); ?>',
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(data) {
            var out = jQuery.parseJSON(data);
            if (out.status == true) {
			   $('#PROD_HARIAN').val(out.PROD_HARIAN);
               $("#PROD_BULANAN").val(out.PROD_BULANAN);
               $("#PROD_TAHUNAN").val(out.PROD_TAHUNAN);
               $("#APBN").val(out.APBN);
			   //$("#DETAIL").val(out.DETAIL);
			  // $("#KETERANGAN").val(out.KETERANGAN);
            } else {
                alert(out.errorMsg);
            }
        })
        .error(function(data) {
            console.log(data);
        })

        e.preventDefault();
    });
// End Submit upload 

function ProdGasGet(){
	 var tanggal = $('#id-date-picker-1').val();
	//alert(tanggal); 
	// lakukan ajax 
	// untuk mendapatkan keterangan dan detail  sebelum tanggal tersebut
	$.ajax({
		type: "GET",
		dataType: "JSON",
		async: true,
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		url: "<?php echo site_url('Lap_pusdatin/showBeforeDateEkvMiGas'); ?>",
		data: {
			"tanggal": tanggal
		},
		success: function(response){
			//var dataa = JSON.parse(response.KETERANGAN);
			//alert(dataa);
			//console.log(response["keterangan"]);
			//alert(response.keterangan);
			// tampilkan pada form di field keterangan dan detail
			
			
			
			//alert(response.gunung);
			//$('select[name="JENIS"]').val(response.jenis);
			//$('textarea[name="BERITA"]').val(response.berita);
			$('input[name="PROD_HARIAN"]').val(response.prod_harian);
			$('input[name="PROD_BULANAN"]').val(response.prod_bulanan);
			$('input[name="PROD_TAHUNAN"]').val(response.prod_tahunan);
			$('input[name="APBN"]').val(response.apbn);
		
			
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
      url: '<?php echo base_url('Lap_pusdatin/prosesTambah'); ?>',
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