<?php

$done = false;

if(isset($_POST["submit"])) {

	require_once("BpmObjectClass.php");
	require_once("startProcess.php");

	//call service
	$bpdId = "25.4d157674-ea38-4c9c-b8ae-1dc1ac0e78ef"; // Unique per izin
	$branchId = "2063.cea29001-7378-4484-8e24-8ce25aed66e3"; // Sama semua (konstan)
	$appId = "2066.960b0111-9fbb-4d9d-b173-62a594a21aa0"; // Sama semua (konstan) 
	$auth = "Basic Y2l0c19kZXY6Y2l0czEyMw=="; // // Sama semua (konstan)
	$data = new Permohonan();
	$data->idPermohonan = "8546"; // Wajib
	$data->jenisIzin = $_POST["jenisIzin"];
	$data->namaPerusahaan = $_POST["namaPerusahaan"]; // Wajib
	$data->idPerusahaan = "88888"; //
	$data->npwp = "014947878343";
	//$data->statusPermohonan = "Evaluasi oleh Evaluator";
	$data->isTolak = "false";  //default
	$data->isBacktoEvaluator = "false";  //default
	$data->tglPengajuan = "2018-10-17T17:08:00Z";
	$data->catatanInvestor = $_POST["catatanInvestor"];
	$test = callStartProcessWithData($auth,$bpdId,$branchId,$appId,$data);

	if ($test->status == "200") {	
		echo "Data has been submited<br/>";	
		echo "Instance ID = ".$test->piid."<br/>";
		echo "Task ID = ".$test->tkiid."<br/>";
		echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
		$done = true;
	} else {
		echo "<font color='red'>";
		echo $test->status;
		echo $test->exceptionType;
		echo $test->errorMessage;
		echo "</font>";
	}
} 


if($done == false) {
?>

<H2>Form Pengajuan izin Usaha Pertambangan</H2><br/> 
<form method="post" action="">
Nama Perusahaan:<br/><input type="text" name="namaPerusahaan" ><br/><br/>
Jenis Izin:<br/><input type="text" name="jenisIzin" /><br/><br/>

Catatan:<br/><textarea name="catatanInvestor" ></textarea><br/><br/>
<input type="submit" name="submit" value="Ajukan" />
</form>

<?php
}
?>