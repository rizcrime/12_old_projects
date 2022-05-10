<?php

require_once("BpmObjectClass.php");

function getTaskByInstanceId($authorization,$instanceId) { 
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt_array($curl, array(
	  CURLOPT_PORT => "9443",
	  CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/search/query?instanceProcessApp%7CPMWF=&condition=instanceStatus%7CActive&condition=taskStatus%7CReceived&condition=instanceId%7C".$instanceId."&organization=byTask&run=true&shared=false&filterByCurrentUser=false",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "PUT",
	  CURLOPT_HTTPHEADER => array(
	    "authorization: ".$authorization,
	    "cache-control: no-cache",
	    "postman-token: 2fff59bf-ccf8-ff71-9556-123616f54b93"
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

function getTaskByInstanceIdAndRoleId($authorization,$instanceId,$roleId) { 
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

// echo "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/search/query?instanceProcessApp%7CPMWF=&condition=taskSubject%7C".urlencode($taskSubject)."&condition=instanceStatus%7CActive&condition=taskStatus%7CReceived&condition=instanceId%7C".$instanceId."&organization=byTask&run=true&shared=false&filterByCurrentUser=false";

  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/search/query?instanceProcessApp%7CPMWF=&condition=taskSubject%7C".urlencode($taskSubject)."&condition=instanceStatus%7CActive&condition=taskStatus%7CReceived&condition=instanceId%7C".$instanceId."&organization=byTask&run=true&shared=false&filterByCurrentUser=false",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: 2fff59bf-ccf8-ff71-9556-123616f54b93"
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


$auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
$instanceId = "2059";
 echo "<pre>ESLS: ";
 $task = getTaskByInstanceIdAndRoleId($auth,$instanceId,"ESLS");
 echo $task->taskId;
 echo "</pre>";
 echo "<pre>ESLT: ";
 $task = getTaskByInstanceIdAndRoleId($auth,$instanceId,"ESLT");
 echo $task->taskId;
 echo "</pre>";

 $instanceId = "2059";
 $task = getTaskByInstanceId($auth,$instanceId);
 var_dump($task);

 $instanceId = "2060";
 $task = getTaskByInstanceIdAndRoleId($auth,$instanceId,"EVAL");
 var_dump($task);


 $instanceId = "2060";
 $task = getTaskByInstanceId($auth,$instanceId);
 var_dump($task);
?>