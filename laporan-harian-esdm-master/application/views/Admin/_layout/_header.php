<header class="main-header">
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jsiframe/iframeResizer.contentWindow.min.js" defer></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jsiframe/iframeResizer.min.js"></script>
    <!-- Logo -->
    <a href="<?php echo base_url('Home'); ?>" class="logo" style="background: #F4E909;">
       <!--<span class="logo-mini" ><small><i class="fa fa-edit"></i></small></span>-->
       <span class="logo-mini" ><small><i class="navbar navbar-static-top" role="navigation"></i></small></span>
       <span class="logo-lg" style="background:#F4E909;"><b style="background: #F4E909; color:#000">Laporan Harian</b></span>
       <!--<nav class="navbar navbar-static-top" role="navigation">
		</nav>	-->
    </a>

    <!-- nav -->
    <?php echo @$_nav; ?>
</header>
<?php 
// function tgl_indo($tanggal){
//     $tanggal = date("Y-m-d", strtotime($tanggal));
//     $bulan = array (
//         1 =>   'Januari',
//         'Februari',
//         'Maret',
//         'April',
//         'Mei',
//         'Juni',
//         'Juli',
//         'Agustus',
//         'September',
//         'Oktober',
//         'November',
//         'Desember'
//     );
//     $pecahkan = explode('-', $tanggal);

//         // variabel pecahkan 0 = tanggal
//         // variabel pecahkan 1 = bulan
//         // variabel pecahkan 2 = tahun

//     return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
// }

?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="need-confirm-modal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-si">Ya</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">Tidak</button>
      </div>
    </div>
  </div>
</div>

<script>
	var modalConfirm = function(selector, callback){
		let event;
		$(document).on("click", selector, function (e) {
			e.preventDefault();
			event = e;
			$("#need-confirm-modal").modal('show');
		});

		$("#modal-btn-si").on("click", function(){
			callback(true, event);
			$("#need-confirm-modal").modal('hide');
		});
		
		$("#modal-btn-no").on("click", function(){
			callback(false, event);
			$("#need-confirm-modal").modal('hide');
		});
	};
</script>