<div class="box-body">
<table id="list-data" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal Laporan</th>
      <th>Nama Gunung</th>
      <th>Aktivita</th>
      <th>Keterangan</th>
      <th>Rekomendasi</th>
      <th>Vona</th>
      <th>Detail</th>
      <th style="text-align: center;">Aksi</th>
    </tr>
  </thead>
  <tbody>
<?php
$no = 1;
foreach ($dataSet as $data) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $data->TANGGAL_LAPORAN; ?></td>
    <td><?php echo $data->NAMA_GUNUNG; ?></td>
    <td><?php echo $data->LEVEL; ?></td>
    <td><?=nl2br(htmlspecialchars($data->KETERANGAN))?></td>
    <td><?=nl2br(htmlspecialchars($data->REKOMENDASI))?></td>
    <td><?=nl2br(htmlspecialchars($data->VONA))?></td>
    <td><?=nl2br(htmlspecialchars($data->DETAIL))?></td>
    <td class="text-center" style="min-width:230px;">
    
    <button class="btn btn-warning update-dataGeologiGunung btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
    <!--<button class="btn btn-warning update-dataGeologiGunung btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" onclick="location.href='<?php echo base_url('Lap_geologi/show_form_draft/'.$data->ID_JENIS_LAPORAN/'update/'.$data->ID_LAPORAN);?>'"><i class="glyphicon glyphicon-repeat"></i> Update</button>-->
    <!--<button class="btn btn-warning konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPost"><i class="glyphicon glyphicon-repeat"></i> Update</button>-->
    <!--<button class="btn btn-warning update-dataGunung btn-minier" data-id="<?php echo $gunung->ID_GUNUNG; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>-->
    <?php if($IS_POST == 'Y'){ ?>
      <button class="btn btn-success konfirmasiPost-admin btn-minier" data-id="<?php echo $data->ID_LAPORAN; ?>" data-toggle="modal" data-target="#konfirmasiPost"><i class="glyphicon glyphicon-ok"></i> POST</button>          
  <?php } ?>
  </td>
</tr>
<?php
$no++;
}
?>
</tbody>
</table>
</div>

<script type="text/javascript">
  
</script>
