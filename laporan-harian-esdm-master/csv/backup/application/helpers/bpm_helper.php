<?php

class ResponseExposedProcess{
    public $status;
    public $errorMessage;
    public $exposedItemList = [];
 }
 
 class ResponseStartProcess{
    public $status;
    public $errorMessage;
    public $exceptionType;
    public $name;
    public $piid;
    public $caseFolderID;
    public $processAppName;
    public $processAppAcronym;
    public $snapshotID;
    public $branchID;
    public $tkiid;
    public $taskName;
    public $taskStatus;
    public $taskAssignedTo;
    public $dueTime;
    public $serviceID;
    public $serviceSnapshotID;
    public $flowObjectID;
 
 }
 
 class ResponseRunQuery{
     public $status;
     public $errorMessage;
     public $exceptionType;
     public $taskList = [];
 }
 
 class Task{
     public $bpdName;
     public $instanceDueDate;
     public $instanceId;
     public $instanceName;
     public $instanceStatus;
     public $taskDueDate;
     public $taskId;
     public $taskPriority;
     public $taskStatus;
     public $taskSubject;
 }
 
 class ExposedItem{
    public $type;
    public $itemID;
    public $processAppID;
    public $processAppName;
    public $startURL;
    public $branchID;
    public $display;
 }
 
 class Permohonan{
    public $idPermohonan;
    public $jenisIzin;
    public $namaPerusahaan;
    public $idPerusahaan;
    public $npwp;
    public $tglPengajuan;
    public $statusPermohonan;
    public $isTolak;
    public $isBacktoEvaluator;
    public $ditolakBy;
    public $catatanEvaluator;
    public $catatanEselon2;
    public $catatanEselon3;
    public $catatanEselon4;
    public $catatanInvestor;
    public $currentUser;
    public $isBacktoKasiBKPM; //20181205
    public $isBacktoBOBKPM;  //20181205
 }
 
 class ResponseSetData{
     public $status;
     public $errorMessage;
     public $data;
     public $exceptionType;
 }
 
 class ResponseGetData{
     public $status;
     public $errorMessage;
     public $data;
     public $exceptionType;
     //public $permohonan;
 }

 function callGetPermohonan($instanceId) {

    $_ci = &get_instance();
    $_ci->load->config('bpm_config');
    $bpm_port = $_ci->config->item("bpm_port");
    $bpm_base_url = $_ci->config->item("bpm_base_url");

    $authorization = $_ci->config->item("bpm_auth");


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  
  
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "{$bpm_port}",
      CURLOPT_URL => "{$bpm_base_url}/rest/bpm/wle/v1/process/".$instanceId."?parts=data",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "authorization: ".$authorization,
        "cache-control: no-cache"
      ),
    ));
  
    $response = curl_exec($curl);
    $err = curl_error($curl);
  
    curl_close($curl);
  
   $responseObj = new ResponseGetData();
  
    if ($err) {
      $responseObj->status='400';
      $responseObj->exceptionType = "Bad Request";
      $responseObj->errorMessage = "cURL Error #:" . $err;
    } else {
      $obj = json_decode($response, true);
        //print_r($obj['data']);
        //var_dump($obj);
        if ($obj['status']=='200') {
           $responseObj->status=$obj['status'];
           $responseObj->data=$obj['data'];    
  
        } else {
           $responseObj->status=$obj['status'];
           $responseObj->errorMessage=$obj['Data']['errorMessage'];
           $responseObj->exceptionType = $obj['Data']['exceptionType'];
        }
    }
  
    return $responseObj;
  
  }

function callSetPermohonan($authorization, $instanceId, $data) {

    $_ci = &get_instance();
    $_ci->load->config('bpm_config');
    $bpm_port = $_ci->config->item("bpm_port");
    $bpm_base_url = $_ci->config->item("bpm_base_url");

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt_array($curl, array(
        CURLOPT_PORT => "{$bpm_port}",
        CURLOPT_URL => "{$bpm_base_url}/rest/bpm/wle/v1/process/".$instanceId."/variable/permohonan",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            "authorization: ".$authorization,
            "cache-control: no-cache"
            ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $responseObj = new ResponseSetData();

    if ($err) {
        $responseObj->status='400';
        $responseObj->exceptionType = "Bad Request";
        $responseObj->errorMessage = "cURL Error #:" . $err;
    } else {
        $obj = json_decode($response, true);
        //print_r($obj['data']);
        //var_dump($obj);
        if ($obj['status']=='200') {
            $responseObj->status=$obj['status'];
            $responseObj->data=$obj['data'];    

        } else {
            $responseObj->status=$obj['status'];
            $responseObj->errorMessage=$obj['Data']['errorMessage'];
            $responseObj->exceptionType = $obj['Data']['exceptionType'];
        }
    }

    return $responseObj;

}


function callStartProcessWithData($bpdId, $data) {

    $dataJson = json_encode($data);
    $dataPermohonan = '{"permohonan":'.$dataJson.'}';

    $_ci = &get_instance();
    $_ci->load->config('bpm_config');
    $bpm_port = $_ci->config->item("bpm_port");
    $bpm_base_url = $_ci->config->item("bpm_base_url");

    $authorization = $_ci->config->item("bpm_auth");
    $branchId = $_ci->config->item("bpm_branch_id");
    $appId = $_ci->config->item("bpm_app_id");
    $snapshotId = $_ci->config->item("bpm_snapshot_id");
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "{$bpm_port}",
      CURLOPT_URL => "{$bpm_base_url}/rest/bpm/wle/v1/process?action=start&bpdId=".$bpdId."&branchId=".$branchId."&snapshotId=".$snapshotId,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"bpdId\"\r\n\r\n".$bpdId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"processAppId\"\r\n\r\n".$appId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"part\"\r\n\r\ndata\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"params\"\r\n\r\n".$dataPermohonan."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
      CURLOPT_HTTPHEADER => array(
        "authorization: ".$authorization,
        "cache-control: no-cache"
      ),
    ));
  
    $response = curl_exec($curl);
    $err = curl_error($curl);
  
    curl_close($curl);
  
    $responseObj = new ResponseStartProcess();
  
    if ($err) {
      $responseObj->status='400';
      $responseObj->errorMessage = "cURL Error #:" . $err;
    } else {
      $obj = json_decode($response,true);
      if ($obj['status']=='200') {
         $responseObj->status = $obj['status'];
         $responseObj->name = $obj['data']['name'];
         $responseObj->piid = $obj['data']['piid'];
         $responseObj->caseFolderID = $obj['data']['caseFolderID'];
         $responseObj->processAppName = $obj['data']['processAppName'];
         $responseObj->processAppAcronym = $obj['data']['processAppAcronym'];
         $responseObj->snapshotID = $obj['data']['snapshotID'];
         $responseObj->branchID = $obj['data']['branchID'];
         $responseObj->tkiid = $obj['data']['tasks'][0]['tkiid'];
         $responseObj->taskName = $obj['data']['tasks'][0]['name'];
         $responseObj->taskStatus = $obj['data']['tasks'][0]['status'];
         $responseObj->taskAssignedTo = $obj['data']['tasks'][0]['assignedTo'];
         $responseObj->dueTime = $obj['data']['tasks'][0]['dueTime'];
         $responseObj->serviceID = $obj['data']['tasks'][0]['serviceID'];
         $responseObj->serviceSnapshotID = $obj['data']['tasks'][0]['serviceSnapshotID'];
         $responseObj->flowObjectID = $obj['data']['tasks'][0]['flowObjectID'];
         // foreach ($obj['data']['exposedItemsList'] as $item) {
         //    $exposedItem = new ExposedItem();
         //    $exposedItem->type=$item['type'];
         //    array_push( $responseObj->exposedItemList, $exposedItem);     
         // }
  
         // //proses submit data
         $setData = callSetPermohonan($authorization, $responseObj->piid, $data);
         if ($setData->status=="200") {
            //Set data berhasil
         } else {
            //Set data gagal
            $responseObj->status = $setData->status;
            $responseObj->errorMessage = $setData->errorMessage;
            $responseObj->exceptionType = $setData->exceptionType;
  
            //Delete task & instance
  
         }
  
      } 
      // else {
      //    $responseObj->status=$obj['status'];
      //    $responseObj->errorMessage="Error ".$obj['status'];
      // }
    }
  
    return $responseObj;
  }

  function callFinishTask($taskId, $data) {

    $_ci = &get_instance();
    $_ci->load->config('bpm_config');
    $bpm_port = $_ci->config->item("bpm_port");
    $bpm_base_url = $_ci->config->item("bpm_base_url");

    $authorization = $_ci->config->item("bpm_auth");

    $dataJson = json_encode($data);
    $dataPermohonan = '{"permohonan":'.$dataJson.'}';
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "{$bpm_port}",
      CURLOPT_URL => "{$bpm_base_url}/rest/bpm/wle/v1/task/".$taskId."?action=finish&params=".urlencode($dataPermohonan),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_HTTPHEADER => array(
        "authorization: ".$authorization,
        "cache-control: no-cache"
      ),
    ));
  
    $response = curl_exec($curl);
    $err = curl_error($curl);
  
    curl_close($curl);
  
    $responseObj = new ResponseGetData();
  
    if ($err) {
      $responseObj->status='400';
      $responseObj->errorMessage = "cURL Error #:" . $err;
    } else {
      $obj = json_decode($response,true);
      if ($obj['status']=='200') {
         $responseObj->status=$obj['status'];
         $responseObj->name = $obj['data'];
      } else {      
            //Set data gagal
            // vdd($obj);
            $responseObj->status=$obj['status'];
            $responseObj->errorMessage=$obj['Data']['errorMessage'];
            $responseObj->exceptionType = $obj['Data']['exceptionType'];
      }
  
    }
  
    return $responseObj;
  
  }

  function getTaskByInstanceId($instanceId) {

    $_ci = &get_instance();
    $_ci->load->config('bpm_config');
    $bpm_port = $_ci->config->item("bpm_port");
    $bpm_base_url = $_ci->config->item("bpm_base_url");

    $authorization = $_ci->config->item("bpm_auth");


	$curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt_array($curl, array(
	  CURLOPT_PORT => "{$bpm_port}",
	  CURLOPT_URL => "{$bpm_base_url}/rest/bpm/wle/v1/search/query?instanceProcessApp%7CPMWF=&condition=instanceStatus%7CActive&condition=taskStatus%7CReceived&condition=instanceId%7C".$instanceId."&organization=byTask&run=true&shared=false&filterByCurrentUser=false",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "PUT",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ".$authorization,
	    "cache-control: no-cache"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$responseObj = new Task();

  if ($err) {
    // //echo "cURL Error #:" . $err;
    // $responseObj->status='400';
    // $responseObj->errorMessage = "cURL Error #:" . $err;
    // return null; 
  } else {
    //echo $response;
    $obj = json_decode($response, true);
    //print_r($obj['data']);
    //var_dump($obj);
    if ($obj['status']=='200') {
       $responseObj->status=$obj['status'];
       if (isset($obj['data']['data'])){
         foreach ($obj['data']['data'] as $item) {

            $task = new Task();
            $task->bpdName=$item['bpdName'];
            $task->instanceDueDate=$item['instanceDueDate'];
            $task->instanceId=$item['instanceId'];
            $task->instanceName=$item['instanceName'];
            $task->instanceStatus=$item['instanceStatus'];
            $task->taskDueDate=$item['taskDueDate'];
            $task->taskId=$item['taskId'];
            $task->taskPriority=$item['taskPriority'];
            $task->taskStatus=$item['taskStatus'];
            $task->taskSubject=$item['taskSubject'];
            //array_push( $responseObj->taskList, $task); 
            $responseObj = $task;    
         }
       }
       //$responseObj->exposedItemList=$obj['data']['exposedItemsList'];
       

    } else {
       // $responseObj->status=$obj['status'];
       // $responseObj->errorMessage="Error ".$obj['status'];
    }
    
  }

  return $responseObj;

}

	// BPM Service Warper
	function get_permohonan_bpm($instance_id, $status_permohonan = "") {
		$data = new Permohonan();
		$data->statusPermohonan = $status_permohonan;
		$data->isTolak = "false";  //default
		$data->isBacktoEvaluator = "false";  //default

		$response = callGetPermohonan($instance_id);
		if ($response->status == "200") {
            // vdd($response->data);
            $data->idPermohonan = $response->data['variables']['permohonan']['idPermohonan'];
			$data->namaPerusahaan = $response->data['variables']['permohonan']['namaPerusahaan'];
			$data->idPerusahaan = $response->data['variables']['permohonan']['idPerusahaan'];
			// $data->jenisIzin = $response->data['variables']['permohonan']['jenisIzin'];
			// $data->npwp = $response->data['variables']['permohonan']['npwp'];
			// $data->catatanInvestor = $response->data['variables']['permohonan']['catatanInvestor'];
			// $data->catatanEvaluator = $response->data['variables']['permohonan']['catatanEvaluator'];
			// $data->catatanEselon4 = $response->data['variables']['permohonan']['catatanEselon4'];
			// $data->catatanEselon3 = $response->data['variables']['permohonan']['catatanEselon3'];
			// $data->catatanEselon2 = $response->data['variables']['permohonan']['catatanEselon2'];
			$data->tglPengajuan = $response->data['variables']['permohonan']['tglPengajuan'];

			return $data;
		} else {
			return FALSE;
		}
	}

	function bpm_process($instance_id, $role_id, $is_tolak = FALSE, $is_back_to_eval = FALSE, $status_permohonan = "") {
        // Bypass
        // return TRUE;

        if(empty($instance_id)) {
            return TRUE; // Bypass if not instance_id, probably not ready
        }

		$data_permohonan_bpm = get_permohonan_bpm($instance_id, $status_permohonan);
		// var_dump($data_permohonan_bpm);

		if($data_permohonan_bpm === FALSE) {
			return FALSE;
		}

		$data_permohonan_bpm->isTolak = ($is_tolak ? "true" : "false"); //default
    $data_permohonan_bpm->isBacktoEvaluator = ($is_back_to_eval ? "true" : "false");  //default
    
    if($role_id === FALSE) {
      $instance_data = getTaskByInstanceId($instance_id);
    } else {
      $instance_data = getTaskByInstanceIdAndRoleId($instance_id, $role_id);
    }
    // var_dump($instance_data);

		if(empty($instance_data)) {
			return FALSE;
		}

    // vdd($instance_data);
    
		$finishTask = callFinishTask($instance_data->taskId, $data_permohonan_bpm);

		if ($finishTask->status == "200") {	
			// echo "Data has been submited to Eselon 4<br/>";	
			// //echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
			// //echo "Instance ID = ".$finishTask->piid;
			// //echo "Task ID = ".$test->tkiid;
			// $done = true;
			return TRUE;
		} else {
			// echo "<font color='red'>";
			// echo $finishTask->status;
			// echo $finishTask->exceptionType;
			// echo $finishTask->errorMessage;
      // echo "</font>";
      // var_dump($finishTask);
      // die("Error!");
			return FALSE;
		}

  }
  
  //20181205 proses bpm khusus di deputi BKPM
  function bpm_deputi_bkpm_process($instance_id, $role_id, $is_back_to_kasi = FALSE, $is_back_to_bo = FALSE, $status_permohonan = "") {
        // Bypass
        // return TRUE;

        if(empty($instance_id)) {
            return TRUE; // Bypass if not instance_id, probably not ready
        }

		$data_permohonan_bpm = get_permohonan_bpm($instance_id, $status_permohonan);
		// var_dump($data_permohonan_bpm);

		if($data_permohonan_bpm === FALSE) {
			return FALSE;
		}

		$data_permohonan_bpm->isBacktoBOBKPM = ($is_bcak_to_bo ? "true" : "false"); //default
    $data_permohonan_bpm->isBacktoKasiBKPM = ($is_back_to_kasi ? "true" : "false");  //default
    
    if($role_id === FALSE) {
      $instance_data = getTaskByInstanceId($instance_id);
    } else {
      $instance_data = getTaskByInstanceIdAndRoleId($instance_id, $role_id);
    }
    // var_dump($instance_data);

		if(empty($instance_data)) {
			return FALSE;
		}

    // vdd($instance_data);
    
		$finishTask = callFinishTask($instance_data->taskId, $data_permohonan_bpm);

		if ($finishTask->status == "200") {	
			// echo "Data has been submited to Eselon 4<br/>";	
			// //echo "<h5><a href='formPengajuan.php'>Back</a></h5>";
			// //echo "Instance ID = ".$finishTask->piid;
			// //echo "Task ID = ".$test->tkiid;
			// $done = true;
			return TRUE;
		} else {
			// echo "<font color='red'>";
			// echo $finishTask->status;
			// echo $finishTask->exceptionType;
			// echo $finishTask->errorMessage;
      // echo "</font>";
      // var_dump($finishTask);
      // die("Error!");
			return FALSE;
		}

  }
  
  function getTaskByInstanceIdAndRoleId($instanceId, $roleId) {

    $_ci = &get_instance();
    $_ci->load->config('bpm_config');
    $bpm_port = $_ci->config->item("bpm_port");
    $bpm_base_url = $_ci->config->item("bpm_base_url");

    $authorization = $_ci->config->item("bpm_auth");
    
    $curl = curl_init();
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    switch ($roleId) {
        case 'ESHK': $subject = "Eselon 3 Hukum";
        break;
        case 'ESL1': $subject = "Eselon 1";
        break;
        case 'ESL2': $subject = "Eselon 2";
        break;
        case 'ESL3': $subject = "Eselon 3";
        break;
        case 'ESLN': $subject = "Eselon 4";
        break;
        case 'ESLS': $subject = "Eselon 2 Sesditjen";
        break;
        case 'ESLT': $subject = "Eselon 2 Teknis";
        break;
        case 'ESTK': $subject = "Eselon 3 Teknis";
        break;
        case 'EVAL': $subject = "Evaluator";
        break;
        case 'KBRH': $subject = "Kabiro Hukum";
        break;
        case 'MNTI': $subject = "Menteri";
        break;
        case 'SHKM': $subject = "Staf Eselon 3 Hukum";
        break;
        default: $subject = "";
    }
  
    $taskSubject = "Step: Evaluasi by ".$subject;

    if($roleId=="EVAL") {
      $taskSubject = "Step: Evaluasi data";
    }
	/* 20181205 role di bkpm sudah dipecah jadi 3 : BO-Kasi-Deputi
    if($roleId == "BKPS") {
      $taskSubject = "Step: Proses by BKPM";
    }
    
    if($roleId == "BKPH") {
      $taskSubject = "Step: Pengesahan by BKPM";
    }
	*/
	
	if($roleId == "BKPB") {  //20181205 Role BO_BKPM
      $taskSubject = "Step: Evaluasi by BO BKPM";
    }
    
    if($roleId == "BKPK") { //20181205 Role Kasi BKPM
      $taskSubject = "Step: Evaluasi by Kasi BKPM";
    }
	
	if($roleId == "BKPD") {  //20181205 Role Deputi BKPM
      $taskSubject = "Step: Deputi BKPM";
    }

    curl_setopt_array($curl, array(
      CURLOPT_PORT => "{$bpm_port}",
      CURLOPT_URL => "{$bpm_base_url}/rest/bpm/wle/v1/search/query?instanceProcessApp%7CPMWF=&condition=taskSubject%7C".urlencode($taskSubject)."&condition=instanceStatus%7CActive&condition=taskStatus%7CReceived&condition=instanceId%7C".$instanceId."&organization=byTask&run=true&shared=false&filterByCurrentUser=false",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_HTTPHEADER => array(
        "authorization: ".$authorization,
        "cache-control: no-cache"
      ),
    ));
  
    $response = curl_exec($curl);
    $err = curl_error($curl);
  
    curl_close($curl);
  
    $responseObj = new Task();
  
    if ($err) {
      // //echo "cURL Error #:" . $err;
      // $responseObj->status='400';
      // $responseObj->errorMessage = "cURL Error #:" . $err;
      // return null; 
    } else {
      //echo $response;
      $obj = json_decode($response, true);
      //print_r($obj['data']);
      // var_dump($obj);
      if ($obj['status']=='200') {
         $responseObj->status=$obj['status'];
         if (isset($obj['data']['data'])){
           foreach ($obj['data']['data'] as $item) {
  
              $task = new Task();
              $task->bpdName=$item['bpdName'];
              $task->instanceDueDate=$item['instanceDueDate'];
              $task->instanceId=$item['instanceId'];
              $task->instanceName=$item['instanceName'];
              $task->instanceStatus=$item['instanceStatus'];
              $task->taskDueDate=$item['taskDueDate'];
              $task->taskId=$item['taskId'];
              $task->taskPriority=$item['taskPriority'];
              $task->taskStatus=$item['taskStatus'];
              $task->taskSubject=$item['taskSubject'];
              //array_push( $responseObj->taskList, $task); 
              $responseObj = $task;    
           }
         }
         //$responseObj->exposedItemList=$obj['data']['exposedItemsList'];
         
  
      } else {
         // $responseObj->status=$obj['status'];
         // $responseObj->errorMessage="Error ".$obj['status'];
      }
      
    }
  
    return $responseObj;
  
  }