<?php


$done = false;

if(isset($_GET["taskId"]) and isset($_GET["instanceId"])) {

	require_once("BpmObjectClass.php");
	require_once("getVariablePermohonan.php");
	require_once("finishTask.php");

	$taskId = $_GET["taskId"];
	$instanceId = $_GET["instanceId"];

	//call get Permohonan
	$bpdId = "25.4d157674-ea38-4c9c-b8ae-1dc1ac0e78ef";
	$branchId = "2063.cea29001-7378-4484-8e24-8ce25aed66e3";
	$appId = "2066.960b0111-9fbb-4d9d-b173-62a594a21aa0";
	$auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
	$data = new Permohonan();
	$data->statusPermohonan = "Evaluasi oleh Evaluator";
	$data->isTolak = "false";  //default
	$data->isBacktoEvaluator = "false";  //default

	$response = callGetPermohonan($auth,$instanceId);
	if ($response->status == "200") {
		//var_dump($response->data);	
		$data->namaPerusahaan = $response->data['variables']['permohonan']['namaPerusahaan'];
		$data->idPerusahaan = $response->data['variables']['permohonan']['idPerusahaan'];
		$data->jenisIzin = $response->data['variables']['permohonan']['jenisIzin'];
		$data->npwp = $response->data['variables']['permohonan']['npwp'];
		$data->catatanInvestor = $response->data['variables']['permohonan']['catatanInvestor'];
		$data->catatanEvaluator = $response->data['variables']['permohonan']['catatanEvaluator'];
		$data->catatanEselon4 = $response->data['variables']['permohonan']['catatanEselon4'];
		$data->catatanEselon3 = $response->data['variables']['permohonan']['catatanEselon3'];
		$data->catatanEselon2 = $response->data['variables']['permohonan']['catatanEselon2'];
		$data->tglPengajuan = $response->data['variables']['permohonan']['tglPengajuan'];
	} else {
		die("Data not found");
	}
	if(isset($_POST["submit"])) {


		$data->isTolak = "false";  //default
		$data->isBacktoEvaluator = "false";  //default

		$finishTask = callFinishTask($auth,$taskId,$data);

		if ($finishTask->status == "200") {	
			echo "Data has been submited to Eselon 2<br/>";	
			//echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
			//echo "Instance ID = ".$finishTask->piid;
			//echo "Task ID = ".$test->tkiid;
			$done = true;
		} else {
			echo "<font color='red'>";
			echo $finishTask->status;
			echo $finishTask->exceptionType;
			echo $finishTask->errorMessage;
			echo "</font>";
		}
		echo "<h5><a href='tasklistEselon3.php'>Back</a></h5>";
	} 
	if(isset($_POST["reject"])) {


		$data->isTolak = "true";  //default
		$data->isBacktoEvaluator = "false";  //default

		$finishTask = callFinishTask($auth,$taskId,$data);

		if ($finishTask->status == "200") {	
			echo "Data has been rejected<br/>";	
			//echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
			//echo "Instance ID = ".$finishTask->piid;
			//echo "Task ID = ".$test->tkiid;
			$done = true;
		} else {
			echo "<font color='red'>";
			echo $finishTask->status;
			echo $finishTask->exceptionType;
			echo $finishTask->errorMessage;
			echo "</font>";
		}
	}
	if(isset($_POST["reevaluate"])) {


		$data->isTolak = "false";  //default
		$data->isBacktoEvaluator = "true";  //default

		$finishTask = callFinishTask($auth,$taskId,$data);

		if ($finishTask->status == "200") {	
			echo "Data has been sent to Evaluator<br/>";	
			//echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
			//echo "Instance ID = ".$finishTask->piid;
			//echo "Task ID = ".$test->tkiid;
			$done = true;
		} else {
			echo "<font color='red'>";
			echo $finishTask->status;
			echo $finishTask->exceptionType;
			echo $finishTask->errorMessage;
			echo "</font>";
		}
	} 

} else {
	die("Task not found");
}


if($done == false) {
?>

<H2>Form Evaluasi izin Usaha Pertambangan</H2><br/> 
<form method="post" action="">
Nama Perusahaan:<br/><input type="text" name="namaPerusahaan" value="<?php echo $data->namaPerusahaan;?>"><br/><br/>
Jenis Izin:<br/><input type="text" name="jenisIzin" value="<?php echo $data->jenisIzin;?>"/><br/><br/>


Catatan Eselon 2:<br/><textarea name="catatanEselon2"  disabled="disabled"><?php echo $data->catatanEselon2;?></textarea><br/><br/>
Catatan Eselon 3:<br/><textarea name="catatanEselon3"  ><?php echo $data->catatanEselon3;?></textarea><br/><br/>
Catatan Eselon 4:<br/><textarea name="catatanEselon4" disabled="disabled"><?php echo $data->catatanEselon4;?></textarea><br/><br/>
Catatan Evaluator:<br/><textarea name="catatanEvaluator"  disabled="disabled"><?php echo $data->catatanEvaluator;?></textarea><br/><br/>
Catatan Investor:<br/><textarea name="catatanInvestor" disabled="disabled"><?php echo $data->catatanInvestor;?></textarea><br/><br/>
<input type="submit" name="reject" value="Tolak" />
<input type="submit" name="reevaluate" value="Kembalikan ke Evaluator" />
<input type="submit" name="submit" value="Lanjutkan" />
</form>

<?php
}
?>