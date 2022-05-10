<div class="box">
  <div class="box-header" style="background-color: #3c8dbc; color: white">
    <h4>Filter Data</h4>
</div>
<!-- /.box-header -->
<div class="box-body">
    <table class="table table-bordered">
        <tr>
            <td style="width: 200px">Pilih Form</td>
            <td>
                <select class="BID_PERIOD_CODE" onchange="f_show(this)">
                    <option value="" <?php if(empty($this->input->get('filter_departemen'))) echo 'selected';?>>Pilih Izin</option>
                    <?php
                    foreach($daftar_perizinan as $perizinan)
                    {
                        //$selected = $this->input->get('filter_departemen')==$city['ID_FORM'] ? 'selected':'';
                        $selected = "";
                        echo '<option value="'.$perizinan->ID_FORM.'" '.$selected.'>'.$perizinan->NAMA_FORM.'</option>';
                    }
                    ?> 
                </select>
            </td>
        </tr>


    </table>
    <?php //var_dump($daftar_sla) ?>
    <?php foreach ($daftar_perizinan as $perizinan): ?>
    <?php //var_dump($abc); ?>
      <div id="grup<?php echo $perizinan->ID_FORM ?>" style="display:none">    
          <form method="POST" action="<?php echo base_url('Sla_izin/updateSla');?>">
          <?=get_csrf_token()?>                    
              <div class="row">
                <div class="col-md-12">
                    <table class ="table table-bordered">
                    <input type="hidden" name="ID_FORM" value="<?=$perizinan->ID_FORM?>">
                        <?php 
                        $processes = $daftar_proses_skema[$perizinan->ID_SKEMA];
                        // var_dump($map);
                        $sla=[];
                        foreach ($processes as $key => $row):
                            $sla_izin = 1;

                            if(isset($daftar_sla[$perizinan->ID_FORM])) {
                                if(isset($daftar_sla[$perizinan->ID_FORM][$row["ID_PROSES"]])) {
                                    $sla_izin = issetor($daftar_sla[$perizinan->ID_FORM][$row["ID_PROSES"]][0]['SLA'], 1);
                                }
                            }
                        ?>
                            <input type="hidden" name="SLA_DATA[<?=$key?>][0]" value="<?=$row['ID_PROSES']?>">
                            <tr>
                                <td><?=$row['NAMA_PROSES']?></td>
                                <td><input type="number" min="0" name="SLA_DATA[<?=$key?>][1]" value="<?=$sla_izin?>"> Hari</td>
                                <td></td>
                            </tr>
                        <?php 
                            // $sla[] = $row['SLA'];
                        ?>
                        <?php endforeach ?>
                        <?php 
                            $jumlah = array_sum($sla);
                        ?>
                        <tr>
                            <!-- <td>Total</td>
                            <td><?php echo $jumlah?> Hari</td> -->
                        </tr>
                    </table>
                    <button id="btn-simpan" class="btn btn-sm btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>    
    </div>
<?php endforeach ?>
</div>
</div>
<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>


<script type="text/javascript">
    function f_show(obj) {
        if(obj.value){
            $('div[id^=grup]').attr("style","display:none");
            $("#grup"+obj.value).attr("style","display:block");
        } else {        
            $('div[id^=grup]').attr("style","display:none");
        }
    }
</script>