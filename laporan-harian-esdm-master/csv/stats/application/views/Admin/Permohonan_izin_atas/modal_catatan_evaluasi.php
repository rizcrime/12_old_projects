<script>
  tinymce.init({
    selector: '#uraian-text-dokumen',
    height: 200,
    menubar: false,
    plugins: [
        "advlist autolink lists charmap preview hr pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons paste textcolor"
      ],
      toolbar1: "insert | undo redo | bold italic | bullist numlist outdent indent | table",
  });

  function uninitMce() {
    tinyMCE.remove("#uraian-text-dokumen");
  }
</script>
<form id="form-evaluasiCatatan">
<?=get_csrf_token()?>
  <div class="modal-content" style="border-radius: 10px;">
    <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
      <button type="button" class="close" data-dismiss="modal" onclick="uninitMce()">&times;</button>
      <h4 class="modal-title" style="text-align: center;"><strong>Form Evaluasi Dokumen</strong></h4>
    </div>
    <div class="modal-body">
    <div class="form-msg"></div>
     <div class='row'>
      <div class='col-md-6' style="padding-right:0px;">
        <iframe src="<?=base_url("Permohonan_izin_atas/download_persyaratan?file={$dokumen_permohonan->ID_PERSYARATAN}")?>" width='100%' height='400px' frameBorder="0"></iframe>
      </div>
      <div class='col-md-6' style="padding-left:0px;overflow-y: auto;height: 400px;">
      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <input type="hidden" name="ID_DOKUMEN_PERMOHONAN" value="<?php echo $id_dokumen_permohonan;?>">
          <input type="hidden" name="ID_PERUSAHAAN" value="<?php echo $id_perusahaan?>">
          <div class="profile-info-name" style="min-width: 135PX">
            JENIS DOKUMEN
            <span style="align-content: center;" class="" data-rel="popover"  data-trigger="hover" title="Jenis dokumen" data-content="This is information about ...."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
          </div>

          <div class="profile-info-value">
            <?php echo $catatan->PERSYARATAN ?>
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 135PX">
            URAIAN
            <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Masukkan uraian" data-content="This is information about ...."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
          </div>

          <div class="profile-info-value">
            <textarea class="tinymce" name="URAIAN" id="uraian-text-dokumen"><?=issetor($evaluasi->URAIAN)?></textarea>
          </div>
        </div>

        <div class="profile-info-row">
          <div class="profile-info-name" style="min-width: 135PX">
            KETERANGAN
            <span style="align-content: center;" class="" data-rel="popover" data-trigger="hover" title="Masukkan keterangan" data-content="This is information about ...."><i class="ace-icon fa fa-info-circle" style="color: #6fb3e0"></i></span>
          </div>

          <div class="profile-info-value">
            <textarea class="form-control" placeholder="Keterangan ..." name="KETERANGAN" aria-describedby="sizing-addon2" ><?=issetor($evaluasi->KETERANGAN)?></textarea>
          </div>
        </div>
      </div>
    </div>  
    <div class="modal-footer" style="border-radius:0 0 10px 10px;">
      <button type="submit" class='btn btn-sm btn-primary'>
        <i class='ace-icon fa fa-save'></i>
        Save
      </button>
      <button class='btn btn-sm btn-danger' data-dismiss='modal' onclick="uninitMce()">
        <i class='ace-icon fa fa-times'></i>
        Cancel  
      </button>
    </div>
  </div>
  </div>
</form>

<style type="text/css">
#mceu_22,#mceu_45{
  display: none!important;
}
</style>