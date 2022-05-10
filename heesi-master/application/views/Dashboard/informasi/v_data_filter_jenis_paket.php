 <?php 
 $no = 1;
 for ($i=0; $i < count($data_pramanifest); $i++) {
   ?>
   <tr>
    <td><?php echo $no ?></td>
    <td><?php echo $data_pramanifest[$i]['kd_pihk']; ?></td>
    <td><?php echo $data_pramanifest[$i]['pihk']; ?></td>
    <td><?php echo $data_pramanifest[$i]['kd_paket']; ?></td>
    <td><?php echo $data_pramanifest[$i]['kd_tahun']; ?></td>
    <td><?php echo $data_pramanifest[$i]['pemberangkatan_ke']; ?></td>
    <td><?php echo $data_pramanifest[$i]['jenis_paket']; ?></td>
    <td><a href="#" onclick="showDetail(<?php echo $data_pramanifest[$i]['kd_pra_manifest'] ?>)"><?php echo $data_pramanifest[$i]["jumlah"] ?></a></td>
    <td>
      <?php if ($data_pramanifest[$i]['jumlah_aktual'] > 0) {
        echo "Berangkat";
      }else{
        echo "Belum Berangkat";
      } ?> 
    </td>
    <td width='15%'>
      <a href="<?php echo base_url('Dashboard/Pramanifest/detail_pramanifest/').$data_pramanifest[$i]['kd_pra_manifest']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>Detail</a>
    </td>
  </td>
</tr>
<?php
$no++;
}
?>