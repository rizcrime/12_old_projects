<script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/tinymce/init-tinymce.js"></script>
<form id="form-tambah-catatan">
<?=get_csrf_token()?>
  <div class="modal-content" style="border-radius: 10px;">
    <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="text-align: center;"><strong>Tambah Catatan Perusahaan</strong></h4>
    </div>
    <div class="modal-body" style="max-height: auto;">
      <div class="form-msg"></div>
      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 125PX">
            URAIAN
            <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Uraian" data-content="Masukkan Uraian"><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
          </div>

          <div class="profile-info-value">
            <textarea id="uraian-text-perusahaan" class="tinymce" name="URAIAN"><?=issetor($data_catatan->URAIAN_CAT_DOK_PRSHN)?></textarea>
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 125PX">
            KETERANGAN
            <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Keterangan" data-content="Masukkan keterangan"><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
          </div>

          <div class="profile-info-value">
            <textarea class="form-control" placeholder="Keterangan ..." name="KETERANGAN" aria-describedby="sizing-addon2" ><?=issetor($data_catatan->KETERANGAN_CAT_DOK_PRSHN)?></textarea>
          </div>
        </div>
      </div>
    </div>  
    <div class="modal-footer" style="border-radius:0 0 10px 10px;">
      <button type="submit" class='btn btn-sm btn-primary'>
        <i class='ace-icon fa fa-save'></i>
        Save
      </button>
      <button class='btn btn-sm btn-danger' data-dismiss='modal'>
        <i class='ace-icon fa fa-times'></i>
        Cancel  
      </button>
    </div>
  </div>
</form>

<style type="text/css">
#mceu_22,#mceu_45{
  display: none!important;
}
</style>
