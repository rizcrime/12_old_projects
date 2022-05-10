<?php
$no = 1;
foreach ($dataDok_syarat_perusahaan as $dok_syarat_perusahaan) {
  ?>
  <tr>
    <td width="2%"><?php echo $no; ?></td>
    <td><?php echo $dok_syarat_perusahaan->DOKUMEN_PERSYARATAN; ?></td>
    <td>
      <?php if ($dok_syarat_perusahaan->IS_ACTIVE == 'Y') {
        echo 'Ya';
      } else if ($dok_syarat_perusahaan->IS_ACTIVE == 'N') {
        echo 'Tidak';
      } else {
        echo $dok_syarat_perusahaan->IS_ACTIVE;
      } ?>
    </td>
    <td>
      <?php if ($dok_syarat_perusahaan->IS_MANDATORY == 'Y') {
        echo 'Ya';
      } else if ($dok_syarat_perusahaan->IS_MANDATORY == 'N') {
        echo 'Tidak';
      } else {
        echo $dok_syarat_perusahaan->IS_MANDATORY;
      } ?>
    </td>
    <td>
      <?php
        if(!is_null($dok_syarat_perusahaan->SUB_DOKUMEN_PERSYARATAN)) {
          print_as_dropdown($dok_syarat_perusahaan->SUB_DOKUMEN_PERSYARATAN);
        } else {
          echo "-";
        }
      ?>
    </td>
    <td>
      <?php if ($dok_syarat_perusahaan->IS_NOMOR == 'Y') {
        $tipe = ($dok_syarat_perusahaan->IS_TYPE_NUMBER == 'Y' ? "(Hanya Angka)" : "(Text)");

        echo 'Ya ' . $tipe;
      } else if ($dok_syarat_perusahaan->IS_NOMOR == 'N') {
        echo 'Tidak';
      } else {
        echo $dok_syarat_perusahaan->IS_NOMOR;
      } ?>
    </td>
    <td>
      <?php if ($dok_syarat_perusahaan->IS_TANGGAL_MULAI == 'Y') {
        echo 'Ya';
      } else if ($dok_syarat_perusahaan->IS_TANGGAL_MULAI == 'N') {
        echo 'Tidak';
      } else {
        echo $dok_syarat_perusahaan->IS_TANGGAL_MULAI;
      } ?>
    </td>
    <td>
      <?php if ($dok_syarat_perusahaan->IS_TANGGAL_AKHIR == 'Y') {
        echo 'Ya';
      } else if ($dok_syarat_perusahaan->IS_TANGGAL_AKHIR == 'N') {
        echo 'Tidak';
      } else {
        echo $dok_syarat_perusahaan->IS_TANGGAL_AKHIR;
      } ?>
    </td>
    <td>
      <?php if ($dok_syarat_perusahaan->IS_UPDATEABLE == 'Y') {
        echo 'Ya';
      } else if ($dok_syarat_perusahaan->IS_UPDATEABLE == 'N') {
        echo 'Tidak';
      } else {
        echo $dok_syarat_perusahaan->IS_UPDATEABLE;
      } ?>
    </td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataDok_syarat_perusahaan btn-minier" data-id="<?php echo $dok_syarat_perusahaan->ID_DOK_SYARAT; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-dok_syarat_perusahaan btn-minier" data-id="<?php echo $dok_syarat_perusahaan->ID_DOK_SYARAT; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
    </td>
  </tr>
  <?php
  $no++;
}
?>