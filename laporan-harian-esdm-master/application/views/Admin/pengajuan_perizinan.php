<div class="row">
  <div class="box-body">
    <form class="form-horizontal">
    <?=get_csrf_token()?>
      <div class="form-group">
        <label class="control-label col-md-3">Kategori Perizinan</label>
        <div class="col-md-8">
          <select name="kategori" id="kategori" class="form-control">
            <option value="0">-PILIH-</option>
            <?php foreach($dataKategori_perizinan as $row):?>
              <option value="<?php echo $row->ID_KATEGORI_PERIZINAN;?>"><?php echo $row->NAMA;?></option>
            <?php endforeach;?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3">Upload Dokumen Perizinan</label>
        <div class="perizinan col-md-8">
        </div>

      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#kategori').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url('Pengajuan_perizinan/get_perizinan');?>",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<label>'+data[i].NAMA+'</label><input type="file" name="NAMA" class="form-control">';
          }
          $('.perizinan').html(html);
        }
      });
    });
  });
</script>

