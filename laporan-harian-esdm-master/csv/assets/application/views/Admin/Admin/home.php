<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-admin"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>NAMA</th>
          <th>USERNAME</th>
          <th>ROLE</th>
          <th>JENIS USER</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-admin">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_admin; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataAdmin', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Admin';
  $data['url'] = 'Admin/import';
  echo show_my_modal('Admin/modals/modal_import', 'import-admin', $data);
?>
<script>
  var MyTable = $('#list-data').dataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });

  window.onload = function() {
    tampilAdmin();
    <?php
      if ($this->session->flashdata('msg') != '') {
        echo "effect_msg();";
      }
    ?>
  }

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
    $.get('<?php echo base_url('Admin/tampil'); ?>', function(data) {
      MyTable.fnDestroy();
      $('#data-admin').html(data);
      refresh();
    });
  }

  $(document).on("click", ".update-dataAdmin", function() {
    var id = $(this).attr("data-id");
    
    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Admin/update'); ?>",
      data: "id=" +id
    })
    .done(function(data) {
      $('#tempat-modal').html(data);
      $('#update-admin').modal('show');
    })
  })

  var id_admin;
  $(document).on("click", ".konfirmasiHapus-admin", function() {
    id_admin = $(this).attr("data-id");
  })
  $(document).on("click", ".hapus-dataAdmin", function() {
    var id = id_admin;
    
    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Admin/delete'); ?>",
      data: "id=" +id
    })
    .done(function(data) {
      $('#konfirmasiHapus').modal('hide');
      tampilAdmin();
      $('.msg').html(data);
      effect_msg();
    })
  })

  $(document).on('submit', '#form-update-admin', function(e){
    var formData = new FormData($(this)[0]);

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('Admin/prosesUpdate'); ?>',
      data: formData,
      processData: false,
            contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);

      tampilAdmin();
      if (out.status == 'form') {
        $('.form-msg').html(out.msg);
        effect_msg_form();
      } else {
        document.getElementById("form-update-admin").reset();
        $('#update-admin').modal('hide');
        $('.msg').html(out.msg);
        effect_msg();
      }
    })

    e.preventDefault();
  });

  $('#form-tambah-admin').submit(function(e) {
    var formData = new FormData($(this)[0]);

    $.ajax({
      method: 'POST',
      url: '<?php echo base_url('Admin/prosesTambah'); ?>',
      data: formData,
      processData: false,
            contentType: false
    })
    .done(function(data) {
      var out = jQuery.parseJSON(data);

      tampilAdmin();
      if (out.status == 'form') {
        $('.form-msg').html(out.msg);
        effect_msg_form();
      } else {
        document.getElementById("form-tambah-admin").reset();
        $('#tambah-admin').modal('hide');
        $('.msg').html(out.msg);
        effect_msg();
      }
    })

    e.preventDefault();
  });

  $('#tambah-admin').on('hidden.bs.modal', function () {
    $('.form-msg').html('');
  })
  $('#update-admin').on('hidden.bs.modal', function () {
    $('.form-msg').html('');
  })
</script>
<script type="text/javascript">
  jQuery(function($) {

    $('[data-rel=popover]').popover({html:true});
    
  });
</script>