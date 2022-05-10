<div class="modal-content" style="border-radius: 10px">
  <div class="modal-header" style="background-color:SteelBlue; color:white;border-radius: 10px 10px 0 0;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="text-align: center;"><strong>Alasan Request Dokumen</strong></h4>
  </div>
  <form id="modal-request-dokumen" method="POST" action="<?php echo base_url('Permohonan_izin_eval/request_dokumen_kelengkapan')?>">
  <?=get_csrf_token()?>
    <div class="modal-body">
     <div class="profile-user-info profile-user-info-striped">
      <div class="profile-info-row">
        <div class="profile-info-name" style="min-width: 200PX">
          <textarea id="alasan-request-dokumen" name="ALASAN_REQUEST" cols="400" rows="4"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer" style="border-radius:0 0 10px 10px;">
    <button type="submit" class='btn btn-sm btn-primary' data-id="">
      <i class='ace-icon fa fa-save'></i>
      Request
    </button>
    <button class='btn btn-sm btn-danger' data-dismiss='modal'>
      <i class='ace-icon fa fa-times'></i>
      Batal
    </button>
  </div>
</form>
</div>

<script>
$(document).on('submit', '#modal-request-dokumen', function(e) {
  var textContent = tinymce.get('alasan-request-dokumen').getContent();
  
  if(textContent.trim() == "") {
    e.preventDefault();
    alert("Mohon isi alasan request dokumen");
    return;
  }

  $("#request-dokumen").modal("hide");
  blockUINextPage();
});

$("#request-dokumen").on('show.bs.modal', function (e) {
    tinymce.init({
      selector: '#alasan-request-dokumen',
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

$("#request-dokumen").on('hidden.bs.modal', function (e) {
  tinyMCE.remove("#alasan-request-dokumen");
})
</script>