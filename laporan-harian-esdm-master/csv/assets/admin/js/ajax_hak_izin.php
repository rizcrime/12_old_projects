<script>
  $(document).ready(function(e) {
    tampilAdmin();
    <?php
      if ($this->session->flashdata('msg') != '') {
        echo "effect_msg();";
      }
    ?>
  });

  var MyTable = $('#list-data').dataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });

  function refresh() {
    MyTable = $('#list-data').dataTable();
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

  function tampilAdmin() {
    $.get('<?php echo base_url('Hak_izin/tampil'); ?>', function(data) {
      MyTable.fnDestroy();
      $('#data-admin').html(data);
      refresh();
    });
  }

  $(document).on("click", ".update-dataAdmin", function() {
    var id = $(this).attr("data-id");
    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Hak_izin/update'); ?>",
      data: "id=" +id
    })
    .done(function(data) {
      $('#tempat-modal').html(data);
      $('#update-hak_izin').modal('show');
    })
  })

  $(document).on('submit', '#form-update-hak_izin', function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('Hak_izin/prosesUpdate'); ?>',
      data: formData,
      processData: false,
            contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);

      // tampilAdmin();
      if (out.status == 'form') {
        $('.form-msg').html(out.msg);
        effect_msg_form();
      } else {
        document.getElementById("form-update-hak_izin").reset();
        $('#update-hak_izin').modal('hide');
        $('.msg').html(out.msg);
        effect_msg();
      }
    })
    .error(function(data) {
      console.log(data);
    })

  });

  $('#update-admin').on('hidden.bs.modal', function () {
    $('.form-msg').html('');
  })
</script>
<script type="text/javascript">
  jQuery(function($) {

    $('[data-rel=popover]').popover({html:true});
    
  });
</script>