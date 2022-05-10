 <?php 
 $no = 1;
  foreach ($data_pramanifest as $data_pramanifest) {
   ?>
   <tr>
    <td><?php echo $no ?></td>
    <td><?php echo $data_pramanifest->kd_pihk; ?></td>
    <td><?php echo $data_pramanifest->pihk; ?></td>
    <!-- <td><a href="#" onclick="showDetail(<?php echo $data_pramanifest->jumlah_jemaah ?>)"><?php echo $data_pramanifest->jumlah_jemaah ?></a></td> -->
    <td><?php echo $data_pramanifest->jumlah_jemaah ?></td>
</tr>
<?php
$no++;
}
?>