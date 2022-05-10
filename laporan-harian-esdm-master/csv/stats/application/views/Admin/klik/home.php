<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<style type="text/css">
		.profile-info-name{
			white-space: nowrap;
		}
		

.tab-content {
  padding : 0px 0px;
}

#exTab2 h3 {
  padding : 5px 15px;
}

/* remove border radius for the tab */

#exTab1 .nav-pills > li > a {
  border-radius: 0;
}


	</style>
	
<div class="box">
<div id="exTab2" class="box">	
<ul class="nav nav-tabs">
			<li class="active">
        <a  href="#1" data-toggle="tab">Entry Laporan</a>
			</li>
			<li><a href="#2" data-toggle="tab">Draf</a>
			</li>
			<li><a href="#3" data-toggle="tab">History</a>
			</li>
            <li>
                <div class="profile-info-row" style="text-align: right;">
                                                <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-gunung">
                                                    <i class="ace-icon fa fa-search align-top bigger-125"></i>
                                                    View All Draft
                                                </button>
                                                
                </div>
            </li>
            <div class="profile-info-row" style="text-align: right;">
            
            <!--<button class="btn btn-success konfirmasiPost-admin pull-right" id="test"><i class="glyphicon glyphicon-ok"></i> POST ALL</button> -->
            
           <!-- <button class="form-control btn btn-primary" data-toggle="modal" data-target="#konfirmasiPost"><i class="glyphicon glyphicon-ok"></i> POSTING ALL</button>--> 
            
            
          
          	</div>
		</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="1">
<!--  Start Entry Laporan -->
<section>
<!-- Jenis Laporan -->
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-name"> Jenis Laporan </div>
										<div class="profile-info-value	">
									      <select required class="form-control" name="ID_JENIS_LAPORAN" id="ID_JENIS_LAPORAN">
									        <option value="">--Pilih Jenis Laporan--</option>
									        <?php foreach($jenis_laporan as $row): ?>
									          <option value="<?php echo $row->URUTAN_LAPORAN ?>"><?php echo $row->JENIS_LAPORAN ?></option>
									        <?php endforeach ?>
									      </select>
									    </div>
									
								</div>
								
							</div>
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-content -->
		<div id="tempat-modal"></div>
</section>
<!-- End Jenis Laporan -->		
<!-- Laporan 1 -->			

 <!-- End Laporan 1 -->
 <!-- Laporan 2 -->
<section id="lap2">

</section>
 <!-- End Laporan 2 -->

 <!-- Laporan 3 -->
 <section id="lap3">
 
</section>
 <!-- End Laporan 3 -->
 
 
 <!-- Laporan 4 -->
<section id="lap4">

</section>
<!-- End Entry lapran 4--> 

			
<!-- Entry lapran 5--> 	
<section>

</section>	
<!-- End Entry lapran 5--> 	

		
<!-- Entry lapran 6--> 	
<section>
	
</section>
<!-- End Entry lapran 6--> 
			
<!-- Start Entry lapran 7--> 
<section>

</section>		
<!-- End Entry lapran 7--> 		
	
<!-- Entry lapran 8--> 	
<section>

</section>	
<!-- End Entry lapran 8--> 
			
<!-- Entry lapran 9--> 	
<section>		

</section>
<!-- End Entry lapran 9--> 	
		
<!-- Entry lapran 10--> 	
<section>

</section>	
<!-- End Entry lapran 10--> 
			
<!-- Entry lapran 11--> 	
<section>

</section>
<!-- End Entry lapran 11--> 			

		</div>
		
<!-- Tab 2 -->		
<div class="tab-pane" id="2">
<section>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<div class="main-content">
				<div class="main-content-inner">

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info profile-user-info-striped">
								    <div class="profile-info-row">
									<div class="profile-info-name"> Jenis Laporan </div>
										<div class="profile-info-value	">
									      <select required class="form-control" id="ID_JENIS_LAPORAN_DRAFT">
									        <option value="">--Pilih Jenis Laporan--</option>
									        <?php foreach($jenis_laporan as $row): ?>
									          <option value="<?php echo $row->URUTAN_LAPORAN ?>"><?php echo $row->JENIS_LAPORAN ?></option>
									        <?php endforeach ?>
									      </select>
								    </div>
								    </div>
									
								</div>
							</div>
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			<div id="tempat-modal-draft"></div>
    
  <!-- /.box-header -->
 
</div>
</section>
		</div>
		
<!-- End Tab 2 -->

<!-- Tab 3 -->
<div class="tab-pane" id="3">
	<!--  Start History Laporan -->
<section>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<div class="main-content">
				<div class="main-content-inner">
				
					
						
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12 col-sm-9">
								<div class="profile-user-info profile-user-info-striped">
								    <div class="profile-info-row">
									<div class="profile-info-name"> Jenis Laporan </div>
										<div class="profile-info-value	">
									      <select required class="form-control" id="ID_JENIS_LAPORAN_HISTORY">
									        <option value="">--Pilih Jenis Laporan--</option>
									        <?php foreach($jenis_laporan as $row): ?>
									          <option value="<?php echo $row->URUTAN_LAPORAN ?>"><?php echo $row->JENIS_LAPORAN ?></option>
									        <?php endforeach ?>
									      </select>
								    </div>
								    </div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Tanggal Laporan Awal </div>

										<div class="profile-info-value">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
												<input class="form-control date-picker" id="id-date-picker-history1" type="text" data-date-format="dd-mm-yyyy" />
											</div>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Tanggal Laporan Akhir </div>

										<div class="profile-info-value">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
												<input class="form-control date-picker" id="id-date-picker-history2" type="text" data-date-format="dd-mm-yyyy" />
											</div>
										</div>
									</div>
									<div class="space-10"></div>
									<div class="profile-user-info profile-user-info-striped" style="border: none;">
										<div class="profile-info-row" style="text-align: right;">
											<button class="btn btn-success" id="btnTampilkan">
												<i class="ace-icon fa fa-search align-top bigger-125"></i>
												Tampilkan
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
    		<div id="tempat-modal-history"></div>
  <!-- /.box-header -->
 
</div>
</section>
<!-- End Historylapran--> 	
		</div>
<!-- End Tab 3 -->
	</div>
  </div>

<hr></hr>

  
   
</div>
<?php show_my_confirm('konfirmasiPost', 'post-dataAdmin', 'Posting Data Ini?', 'Ya, Posting Data Ini'); ?>
<?php echo $modal_add_gunung; ?>


<script>
	
  function refresh() {
    MyTable = $('#list-data').dataTable();
  }
  
  function refresh2() {
    MyTable2 = $('#list-data2').dataTable();
  }

  function effect_msg_form() {
    // $('.form-msg').hide();
    $('.form-msg').show(1000);
    setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
  }

  function effect_msg() {
    // $('.msg').hide();
    $('.msg').show(1000);
    setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
  }

  function tampilAdmin() {
  	var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN_DRAFT").val();
  	alert(ID_JENIS_LAPORAN);
  	$('#tempat-modal-draft').html('');
    /*$.get('<?php echo base_url('Lap_klik/show_form_draft'); ?>/'+ID_JENIS_LAPORAN, function(data) {
		MyTable.fnDestroy();
		$('#tempat-modal-draft').html(data);
		refresh();
	});*/
  }
	
	
	$("#ID_JENIS_LAPORAN").change(function() {
		var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN").val();
		$('#tempat-modal').html('');
		$.get('<?php echo base_url('Lap_klik/show_form'); ?>/'+ID_JENIS_LAPORAN, function(data) {
			$('#tempat-modal').html(data);
		}).fail(function(data) {
    console.log(data);
    }); // or whatever
});
		
	
	
	$("#ID_JENIS_LAPORAN_DRAFT").change(function() {
		var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN_DRAFT").val();
		$('#tempat-modal-draft').html('');
		$.get('<?php echo base_url('Lap_klik/show_form_draft'); ?>/'+ID_JENIS_LAPORAN, function(data) {
			MyTable.fnDestroy();
			$('#tempat-modal-draft').html(data);
			refresh();
		}).fail(function(data) {
			//var d = data.replace(/(<([^>]+)>)/ig,"");
    		console.log(data);
    	});
		
	});
	
	$("#btnTampilkan").click(function() {
		var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN_HISTORY").val();
		var TANGGAL_AWAL = $("#id-date-picker-history1").val();
		var TANGGAL_AKHIR = $("#id-date-picker-history2").val();
		$('#tempat-modal-history').html('');
		$.get('<?php echo base_url('Lap_klik/show_form_history'); ?>/'+ID_JENIS_LAPORAN+'/'+TANGGAL_AWAL+'/'+TANGGAL_AKHIR, function(data) {
			MyTable2.fnDestroy();
			$('#tempat-modal-history').html(data);
			refresh2();
		});
		
	});


  var id_laporan;
  $(document).on("click", ".konfirmasiPost-admin", function() {
    id_laporan = $(this).attr("data-id");
  })
  
  $(document).on("click", ".post-dataAdmin", function() {
    var id = id_laporan;
    var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN_DRAFT").val();
    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Lap_klik/post'); ?>",
      data: "id=" +id + "&ID_JENIS_LAPORAN=" +ID_JENIS_LAPORAN,
    })
    .done(function(data) {
      $('#konfirmasiPost').modal('hide');
      
      var ID_JENIS_LAPORAN = $("#ID_JENIS_LAPORAN_DRAFT").val();
		$('#tempat-modal-draft').html('');
		$.get('<?php echo base_url('Lap_klik/show_form_draft'); ?>/'+ID_JENIS_LAPORAN, function(data) {
			MyTable.fnDestroy();
			$('#tempat-modal-draft').html(data);
			refresh();
		});
		
      $('.msg').html(data);
      effect_msg();
    })
    .error(function(data) {
      console.log(data);
    })
  })

  $(document).on('submit', '#form-update-admin', function(e){
    var formData = new FormData($(this)[0]);

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('Admin/prosesUpdate'); ?>',
      data: formData,
      processData: false,
            contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);

      tampilAdmin();
      if (out.status == 'form') {
        $('.form-msg').html(out.msg);
        effect_msg_form();
      } else {
        document.getElementById("form-update-admin").reset();
        $('#update-admin').modal('hide');
        $('.msg').html(out.msg);
        effect_msg();
      }
    })

    e.preventDefault();
  });
  
  $('#tambah-admin').on('hidden.bs.modal', function () {
    $('.form-msg').html('');
  })
  $('#update-admin').on('hidden.bs.modal', function () {
    $('.form-msg').html('');
  })
</script>
<script type="text/javascript">
  jQuery(function($) {

    $('[data-rel=popover]').popover({html:true});
    $('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})
    
  });
</script>