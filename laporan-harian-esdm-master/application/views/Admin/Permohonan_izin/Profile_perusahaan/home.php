<style type="text/css">
  button {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }
</style>

<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">


    <div class="widget-main">
      <div id="fuelux-wizard-container">
        <div>
          <ul class="steps">
            <li data-step="1" class="active">
              <span class="step">#</span>
              <span class="title">Profile Perusahaan</span>
            </li>

            <li data-step="2">
              <span class="step">1</span>
              <span class="title">Pilih Jenis Izin</span>
            </li>

            <li data-step="3">
              <span class="step">2</span>
              <span class="title">Dokumen Persyaratan</span>
            </li>

            <li data-step="4">
              <span class="step">3</span>
              <span class="title">Data Permohonan</span>
            </li>

            <li data-step="5">
              <span class="step">4</span>
              <span class="title">Kirim Permohonan</span>
            </li>
          </ul>
        </div>

        <hr />

      </div>

    </div><!-- /.widget-main -->

    <p style="color: #bb0000">Last Update: <strong><?= $bidder->LAST_UPDATE ?></strong></p>
    <form id="main-profile" method="POST" action="<?php echo base_url('Profile_perusahaan/prosesUpdate') ?>" enctype="multipart/form-data">
    <?=get_csrf_token()?>
      <?=$profile_form_content?>

        <div style="overflow:auto;">
          <div style="float:left;">
            <a class="btn-sm btn-danger" href="<?php echo site_url('Permohonan_izin') ?>" style="color: white"><i class="fa fa-times"></i> Cancel</a>
          </div>
          <div style="float:right;">
            <div id="button-lanjut"></div>
          </div>
        </div>
      </form>
    </div>

    <?php echo $modal_add_akta; ?>
    <?php show_my_confirm('konfirmasiHapus', 'hapus-dataAkta', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>

    <div id="tempat-modal"></div>


    <style type="text/css">
    textarea{
      min-height: 68px;
    }

    div.col-md-12{
      margin-top: 10px;
    }

    div.col-md-8{
      padding: 0;
    }

    .steps li.active .step{
      background-color: #fff000;
    }

  </style>
  <script type="text/javascript">
    var akta_empty_callback = function () {
      $("#button-lanjut").html('<button type="button" class="btn-sm btn-warning" title="Tidak ada data akta">Kurang data akta</button>');
      $("#button-lanjut").bind('click', function() {
        alert("Kurang data akta!");
      });
    }

    var akta_exists_callback = function () {
      $("#button-lanjut").html('<button type="submit" id="izin-next-step" class="btn-sm btn-success">Berikutnya <i class="fa fa-chevron-right"></i></button>');
      $("#button-lanjut").unbind('click');      
    }

    $(document).on("submit", "#main-profile", function() {
		  $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
	  });
  </script>