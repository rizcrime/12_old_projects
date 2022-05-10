<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="row">
  <div class="box-body">
    <?php if($bidder->IS_VERIFIED == ""){ ?>
      <div>
        <div class="alert alert-danger" style="background-color: #f2dede!important; color:#bb0000!important;">
          <i class="fa fa-warning bigger-150" style="color: "></i><strong> Info!</strong> Untuk dapat mengajukan izin, silakan submit profile anda, kemudian Admin akan memverifikasi data Anda dan mengirim notifikasi via email selambat-lambatnya 1x24 jam pada hari kerja.
        </div>
      </div>
    <?php } elseif ($bidder->IS_VERIFIED == "N") { ?>
      <div>
        <div class="alert alert-danger" style="background-color: #f2dede!important; color:#bb0000!important;">
          <i class="fa fa-warning bigger-150" style="color: "></i>
          Profile Perusahaan anda ditolak dengan alasan : <?= $bidder->ALASAN_PENOLAKAN ?>. Harap melengkapi dokumen yang sesuai.
        </div>
      </div>
    <?php } ?>
    <p style="color: #bb0000">Last Update: <strong><?= $bidder->LAST_UPDATE ?></strong></p>
    <form method="POST" action="<?php echo base_url('Profile_perusahaan/prosesUpdate/main') ?>" enctype="multipart/form-data">
    <?=get_csrf_token()?>

      <?=$profile_form_content?>

      <div class="form-group">
        <div class="col-md-2 pull-right">
          <a class="form-control btn btn-danger" href='<?=base_url("Home_perusahaan")?>'> <i class="glyphicon glyphicon-remove"></i> Batal</a>
        </div>
        <div class="col-md-2 pull-right"> 
          <?php $submit_string = $bidder->IS_VERIFIED == "N" ? "Kirim Ulang" : "Submit" ?>
          <span id="button-submit">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> <?=$submit_string?></button>
          </span>
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

  div.col-sm-12{
    padding: 0;
  }

  div.col-md-12{
    margin-top: 10px;
  }

  div.col-md-8{
    padding: 0;
  }

</style>

<script>
  var akta_empty_callback = function () {
    $("#button-submit").html('<button type="button" class="form-control btn btn-warning" title="Tidak ada data akta">Kurang data akta</button>');
    $("#button-submit").bind('click', function() {
      alert("Kurang data akta!");
    });
  }

  var akta_exists_callback = function () {
    $("#button-submit").html('<button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> <?=$submit_string?></button>');
    $("#button-submit").unbind('click');      
  }
</script>