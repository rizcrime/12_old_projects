<?php
var_dump("ASDASD");

$i = 1;
foreach ($dataPermohonan_izin as $row): 
  ?>
  <tr>
    <td><?php echo $i++ ?></td>
    <td><?php echo $row->ID_PERMOHONAN ?></td>
    <td><?php echo $row->NAMA_PERUSAHAAN ?></td>
    <td>
      <?php
      if ($row->TGL_PENGAJUAN == NULL) {
        echo '-';
      } else {
        echo tgl_indo($row->TGL_PENGAJUAN);
      } 
      ?>                        
    </td>
    <td><?php echo $row->NAMA_FORM ?></td>
    <td><a href='<?=base_url("Permohonan_izin_eval/download_perusahaan?file={$dokumen->RID}");?>' target="_blank"><i class="fa fa-download bigger-160"></i></a></td>
    <td>
      <?php //if($row->ID_CURR_PROSES != NULL){ //TODO: Ask why? ?>
        <a href="<?php echo base_url()?>Permohonan_izin_eval/step1" class="btn btn-info btn-minier"><i class="glyphicon glyphicon-info-sign"></i> Periksa</a>
      <?php //} else { echo "-";} ?>
    </td>

  </tr>

  <?php endforeach;
  // function tgl_indo($tanggal){
  //   $bulan = array (
  //     1 =>   'January',
  //     'February',
  //     'March',
  //     'April',
  //     'May',
  //     'Juny',
  //     'July',
  //     'August',
  //     'September',
  //     'October',
  //     'November',
  //     'December'
  //   );

  //   $pecahkan = explode('-', $tanggal);
  //   return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  // } 
  ?>