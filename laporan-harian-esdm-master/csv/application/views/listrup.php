<?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-warning alert-dismissible" style="margin-top: 5px;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p><strong><?php echo $this->session->flashdata('error_msg'); ?></strong></p>
            </div>
<?php endif; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">

<div style="">
        <div class="container" style="">
          <div class="center wow fadeInDown" style="padding: 0px">
            <h3><strong>LIST PERUSAHAAN DISETUJUI REGISTRASI USAHA PENUNJANG</strong></h3>
          </div>
          <div class="col-sm-12 wow fadeInDown" style="padding: 0px">
            <div class="panel-body" style="background: #f9f9f9; border-radius: 10px">
              <div class="media accordion-inner">
                <table id="table_id" class="display">
                  <thead>
                    <tr style="background: #d5d9e0">
                      <td>No</td>
                      <td>NAMA PERUSAHAAN</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; foreach($dataTable as $row) : 
                    echo "<tr>";
                    echo "<td>".$i++."</td>";
                    echo "<td>$row->NAMA_PERUSAHAAN</td>";
                    echo "</tr>";
                  endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt centered" style="height: 0px; margin-top: -5px">
        <div class="col-lg-7 col-lg-offset-1 mt">
          
       </div>
    </div>
</div>
  <style type="text/css">

    div.asd{
      background-color: rgba(52, 120, 146, 0.5);
      border:solid 5px #ffffffb8;
      padding: 15px 10px 10px 10px;
      border-radius: 10px;
      margin: 0 18px;
      font-weight: 400;
      color: white;
    }
    div.asd:hover{
      background-color: #efe54a!important;
      font-weight: 17px;
      color: black!important;
    }

  </style>