<form id="regForm" action="">
<?=get_csrf_token()?>
<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Detail Data</strong></h4>
  </div>
  <div class="modal-body">
    <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA
          
        </div>

        <div class="profile-info-value">
          <?php echo $provinsi->NAMA_PROVINSI ?>
        </div>
      </div>

      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          NAMA EN
          
        </div>

        <div class="profile-info-value">
          <?php echo $provinsi->NAMA_PROVINSI_EN ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          MULAI EXIST
          
        </div>

        <div class="profile-info-value">
          <?php echo $provinsi->MULAI_EXIST ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          AKHIR EXIST
          
        </div>

        <div class="profile-info-value">
          <?php echo $provinsi->AKHIR_EXIST ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          KODE
          
        </div>

        <div class="profile-info-value">
          <?php echo $provinsi->KODE_PROVINSI ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          DATE MODIFIED
          
        </div>

        <div class="profile-info-value">
          <?php echo $provinsi->DATE_MODIFIED ?>
        </div>
      </div>
      
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          EDIT BY
          
        </div>
        <div class="profile-info-value">
          <?php echo $provinsi->EDIT_BY ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Close
    </button>
  </div>
</div>
</form>

<script type="text/javascript">
  $('[data-rel=popover]').popover({html:true});
</script>
