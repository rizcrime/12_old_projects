<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Alasan Penolakan</strong></h4>
  </div>
  <form id="modal-form-tolak" method="POST" action="<?php echo base_url('Permohonan_izin_eval/prosesTolak')?>">
  <?=get_csrf_token()?>
    <div class="modal-body">
     <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          <textarea id="alasan-penolakan-text" name="ALASAN_PENOLAKAN" cols="400" rows="4"><?=issetor($cat_kesimpulan->CATATAN_SIMPULAN)?></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary' data-id="">
      <i class='ace-icon fa fa-save'></i>
      Tolak
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Batal
    </button>
  </div>
</form>
</div>

<script>
$(document).on('submit', '#modal-form-tolak', function(e) {
  var textContent = tinymce.get('alasan-penolakan-text').getContent();
  
  if(textContent.trim() == "") {
    e.preventDefault();
    alert("Mohon isi alasan penolakan");
    return;
  }

  $("#tolak-permohonan").modal("hide");
  blockUINextPage();
});

$("#tolak-permohonan").on('show.bs.modal', function (e) {
    tinymce.init({
      selector: '#alasan-penolakan-text',
      height: 300,
      plugins: [
        "advlist autolink lists charmap preview hr pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons paste textcolor"
      ],
      toolbar1: "insert | preview | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |",
    });
  })

$("#tolak-permohonan").on('hidden.bs.modal', function (e) {
  tinyMCE.remove("#alasan-penolakan-text");
})
</script>