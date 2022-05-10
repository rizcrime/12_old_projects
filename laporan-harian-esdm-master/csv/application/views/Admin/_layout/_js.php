<!-- REQUIRED JS SCRIPTS -->
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/admin/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/dist/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js" ></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.blockui.js"></script>  -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fuelux.wizard.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/tinymce/init-tinymce.js"></script>
<!-- <script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/dataTables.responsive.min.js'?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		var acc = document.getElementsByClassName("accordion-step4");
		var z;
		for (z = 0; z < acc.length; z++) {
			acc[z].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel_step4 = this.nextElementSibling;
				if (panel_step4.style.display === "block") {
					panel_step4.style.display = "none";
				} else {
					panel_step4.style.display = "block";
				}
			});
		}
	});

	$('.datepicker').datepicker({
    format: 'dd-mm-YYYY HH:ii:ss',
	});

	$('.tgl-end-now-datepicker').datepicker({
		format: 'yyyy-mm-dd',
		setDate: new Date(),
    	endDate: '<?=date("Y-m-d")?>'
	});

	$('.tgl-end-now-datepicker').on('changeDate show', function(e) {
		this.setCustomValidity('');
	});

	jQuery("input[flag='input-file']").ace_file_input({
      no_file:'No File ...',
      btn_choose:'Choose',
      btn_change:'Change',
      droppable:false,
      onchange:null,
	  thumbnail:false, //| true | large
	  denyExt:  ['exe', 'php'],
	  <?php if(isset($allowed_ace_input)): ?>
		allowExt:  <?=$allowed_ace_input?>,
	  <?php endif; ?>
	  maxSize: <?=get_max_size()?>,
      //whitelist:'gif|png|jpg|jpeg'
      //blacklist:'exe|php'
      //onchange:''
      //
	})
	.on('file.error.ace', function(event, info) {
		if(info.error_count['size'] > 0) {
			alert("Ukuran file maximum sebesar: <?=get_max_size(TRUE)?>");
		}

		event.preventDefault();
	});

    $("a[data-toggle='modal']").click(function(){
    	jQuery("input[flag='input-file']").ace_file_input({
	    no_file:'No File ...',
	    btn_choose:'Choose',
	    btn_change:'Change',
	    droppable:false,
	    onchange:null,
		thumbnail:false, //| true | large
		denyExt:  ['exe', 'php'],
		<?php if(isset($allowed_ace_input)): ?>
			allowExt:  <?=$allowed_ace_input?>,
		<?php endif; ?>
		maxSize: <?=get_max_size()?>,
	    //whitelist:'gif|png|jpg|jpeg'
	    //blacklist:'exe|php'
	    //onchange:''
	    //
	    });
	})
	.on('file.error.ace', function(event, info) {
		if(info.error_count['size'] > 0) {
			alert("Ukuran file maximum sebesar: <?=get_max_size(TRUE)?>");
		}

		event.preventDefault();
	});

    $("button[data-toggle='modal']").click(function(){
    	jQuery("input[type='File']").ace_file_input({
	    no_file:'No File ...',
	    btn_choose:'Choose',
	    btn_change:'Change',
	    droppable:false,
	    onchange:null,
		thumbnail:false, //| true | large
		denyExt:  ['exe', 'php'],
		<?php if(isset($allowed_ace_input)): ?>
			allowExt:  <?=$allowed_ace_input?>,
		<?php endif; ?>
		maxSize: <?=get_max_size()?>,
	    //whitelist:'gif|png|jpg|jpeg'
	    //blacklist:'exe|php'
	    //onchange:''
	    //
		})
		.on('file.error.ace', function(event, info) {
		if(info.error_count['size'] > 0) {
			alert("Ukuran file maximum sebesar: <?=get_max_size(TRUE)?>");
		}

		event.preventDefault();
	});
    });

    $("button[data-toggle='modal']").click(function(){
    	$('[data-rel=popover]').popover({html:true});
    });
    
    $('[data-rel=popover]').popover({html:true});

    jQuery(function($) {
			
		var $validation = false;
		$('#fuelux-wizard-container')
		.ace_wizard({
			//step: 2 //optional argument. wizard will jump to step "2" at first
			//buttons: '.wizard-actions:eq(0)'
		})
	
		$('#modal-wizard-container').ace_wizard();
	
		$(document).one('ajaxloadstart.page', function(e) {
			//in ajax mode, remove remaining elements before leaving page
			$('[class*=select2]').remove();
		});
	});

    $(function(){           
        if (!Modernizr.inputtypes.date) {
            $('input[type=date]').datepicker({
                  dateFormat : 'yyyy-mm-dd'
                }
             );
        }
    });

	// $(document).ajaxSend(function() {
	// 	$.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	// });

	// $(document).ajaxComplete(function() {
    //     $.unblockUI();
	// });

	  // Modal helper
	  var actionInProgress = false;
	var nextActionQueue = [];

	function showModal(modal) {
	if (actionInProgress) {
		nextActionQueue.push({
		id: modal.attr('id'),
		action: showModal
		});
		return;
	}

	actionInProgress = true;
	modal.on('shown.bs.modal', showCompleted);
	modal.modal("show");

	function showCompleted() {
		actionInProgress = false;
		modal.off('shown.bs.modal', showCompleted);
		if (nextActionQueue.length > 0) {
		var next = nextActionQueue.shift();
		next.action($("#" + next.id));
		}
	}
	};

	function hideModal(modal) {
	if (actionInProgress) {
		nextActionQueue.push({
		id: modal.attr('id'),
		action: hideModal
		});
		return;
	}
	
	actionInProgress = true;
	modal.on('hidden.bs.modal', hideCompleted);
	modal.modal("hide");

	function hideCompleted() {
		actionInProgress = false;
		modal.off('hidden.bs.modal', hideCompleted);
		if (nextActionQueue.length > 0) {
		var next = nextActionQueue.shift();
		next.action($("#" + next.id));
		}
	}
	};

	// End of modal helper

	// Accoridion helper
	$('.panel').on('hide.bs.collapse', function (e) {
		$("#"+e.currentTarget.id+" .accordion-mark").removeClass("active");
	})
	$('.panel').on('show.bs.collapse', function (e) {
		$("#"+e.currentTarget.id+" .accordion-mark").addClass("active");
	})
	$('.panel').on('show.bs.collapse hide.bs.collapse', function (e) {
		let iframeInsidePanel = $('.panel iframe');
		if(iframeInsidePanel.length !== 0) {
			if(iframeInsidePanel[0].iFrameResizer !== undefined) {
				iframeInsidePanel[0].iFrameResizer.resize();
			}
		}
	})
	// End of accordion helper
	$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
		if(!(originalOptions.data instanceof FormData)) {
			if(!options.data) {
				options.data = "<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>";
			} else {
				options.data += "&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>";
			}
		} else {
			let formData = options.data;

			if(!formData.get("<?=$this->security->get_csrf_token_name()?>")) {
				options.data.append("<?=$this->security->get_csrf_token_name()?>", "<?=$this->security->get_csrf_hash()?>");
			}
		}
	});
	// End of CSRF

</script>
<!-- My Ajax -->
<!-- <?php include './assets/admin/js/ajax.php'; ?> -->
<?php 
	if($page=='admin'){
		include './assets/admin/js/ajax_admin.php';
	} elseif ($page == 'kabkot'){
		include './assets/admin/js/ajax_kabkot.php';
	} elseif ($page == 'pusdatin'){
		include './assets/admin/js/ajax_pusdatin.php';
	} elseif ($page == 'klik'){
		include './assets/admin/js/ajax_klik.php';
	} elseif ($page == 'geologi'){
		include './assets/admin/js/ajax_geologi.php';
	} elseif ($page == 'pemohon') {
		include './assets/admin/js/ajax_pemohon.php';
	} elseif ($page == 'role') {
		include './assets/admin/js/ajax_role.php';
	} elseif ($page == 'provinsi') {
		include './assets/admin/js/ajax_provinsi.php';
	} elseif ($page == 'skemaizin') {
		include './assets/admin/js/ajax_skema_izin.php';
	} elseif ($page == 't_persyaratan_izin') {
		include './assets/admin/js/ajax_t_persyaratan_izin.php';
	} elseif ($page == 'mapping_izin') {
		include './assets/admin/js/ajax_mapping_izin.php';
	} elseif ($page == 'skema_workflow') {
		include './assets/admin/js/ajax_workflow_skema.php';
	} elseif ($page == 'verifikasi_perusahaan') {
		include './assets/admin/js/ajax_verifikasi_bidder.php';

	} elseif ($page == 'perusahaan') {
		include './assets/admin/js/ajax_bidder.php';
	} elseif ($page == 'profile_perusahaan') {
		include './assets/admin/js/ajax_profile_perusahaan.php';
	} elseif ($page == 'permohonan_izin') {
		include './assets/admin/js/ajax_proses_permohonan.php';		
	} elseif ($page == 'skema_proses') {
		include './assets/admin/js/ajax_proses_skema.php';		
	} elseif ($page == 'skema_proses_role') {
		include './assets/admin/js/ajax_proses_skema_role.php';		
	} elseif ($page == 'permohonan_izin_eval') {
		include './assets/admin/js/ajax_izinEval.php';		
	} elseif ($page == 'permohonan_izin_atas') {
		include './assets/admin/js/ajax_izinEvalAtas.php';		
	} elseif ($page == 'arsip_izin') {
		include './assets/admin/js/ajax_arsip.php';		
	} elseif ($page == 'hak_izin') {
		include './assets/admin/js/ajax_hak_izin.php';		
	} elseif ($page == 'syarat_ketentuan') {
		include './assets/admin/js/ajax_syarat_ketentuan.php';		
	} elseif ($page == 'home') {
		include './assets/admin/js/ajax_home.php';		
	} elseif ($page == 'home_perusahaan') {
		// No js.	
	} elseif ($page == 'permohonan_izin_ood') {
		// No js.		
	} elseif ($page == 'dok_syarat_perusahaan') {
		include './assets/admin/js/ajax_dok_syarat_perusahaan.php';
	} elseif ($page == 'guideline_admin') {
		include './assets/admin/js/ajax_guideline_admin.php';
	} elseif ($page == 'report_izin') {
		include './assets/admin/js/ajax_report_izin.php';
	} elseif ($page == 'list_user') {
		include './assets/admin/js/ajax_list_user.php';
	} elseif ($page == 'summary_izin') {
		include './assets/admin/js/ajax_summary_izin.php';
	} elseif ($page == 'pengumuman') {
		include './assets/admin/js/ajax_pengumuman.php';
	}
	elseif ($page == 'aktivitas') {
		include './assets/admin/js/ajax_aktivitas.php';
	}
	elseif ($page == 'gunung') {
		include './assets/admin/js/ajax_gunung.php';
	}
	
	// else {
	// 	include './assets/admin/js/ajax_dok_syarat_perusahaan.php';
	// }
?>