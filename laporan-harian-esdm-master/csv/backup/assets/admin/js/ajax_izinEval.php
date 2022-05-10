<script>
    var MyTable = $('#list-data2').dataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });

    window.onload = function() {
      // tampilIzinEval();
      <?php
      if ($this->session->flashdata('msg') != '') {
        echo "effect_msg();";
      }
      ?>
    }

    function refresh() {
      MyTable = $('#list-data2').dataTable();
    }

    function effect_msg_form() {
    // $('.form-msg').hide();
    $('.form-msg').show(1000);
    setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
  }

  function effect_msg() {
    // $('.msg').hide();
    $('.msg').show(1000);
    setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
  }

  // function tampilIzinEval() {
  //   $.get('<?php //echo base_url('Permohonan_izin_eval/tampil2'); ?>', function(data) {
  //     MyTable.fnDestroy();
  //     $('#data-izinEval').html(data);
  //     refresh();
  //   });
  // }

  function blockUINextPage() {
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });
  }

  $(document).on("click", ".tolak", function() {
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

    $.ajax({
      method: "GET",
      url: "<?php echo base_url('Permohonan_izin_eval/tolak'); ?>",
      processData: false,
      contentType: false
    })
    .done(function(data) {
      
      $('#tempat-modal').html(data);
      $('#tolak-permohonan').modal('show');

    })
    .always(function(){
        $.unblockUI();
    })
  })

  $(document).on("click", ".request-dokumen", function() {
    $.blockUI({ message: '<h1><img src="" />Loading..</h1>' });

    $.ajax({
      method: "GET",
      url: "<?php echo base_url('Permohonan_izin_eval/request_dokumen_modal'); ?>",
      processData: false,
      contentType: false
    })
    .done(function(data) {
      
      $('#tempat-modal').html(data);
      $('#request-dokumen').modal('show');

    })
    .always(function(){
        $.unblockUI();
    })
  })

</script>
<script type="text/javascript">
  jQuery(function($) {

    $('[data-rel=popover]').popover({html:true});
    
  });
</script>