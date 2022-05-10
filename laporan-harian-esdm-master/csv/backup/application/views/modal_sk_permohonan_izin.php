<form>
<?=get_csrf_token()?>
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px">
      <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><strong>Syarat dan Ketentuan</strong></h4>
      </div>
      <div class="modal-body">
        <div class="profile-user-info profile-user-info-striped">
          <div class="col-md-12">
            <?= $sk_izin->DESKRIPSI ?>
          </div>
        </div>
      </div>  
      <div class="modal-footer" style="border-radius:0 0 10px 10px;">
        <center>
          <button style="padding: 0" class='btn btn-sm btn-success' data-dismiss="modal">Setuju</button>
        </center>
      </div>
    </div>

  </div>
</form>