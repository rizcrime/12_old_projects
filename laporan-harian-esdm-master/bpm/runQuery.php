<?php

require_once("BpmObjectClass.php");

function getTaskListByStep($authorization,$step) {

//&condition=assignedToUser%7C".$user."
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/search/query?condition=instanceProcessApp%7CPMWF&condition=instanceStatus%7CActive&condition=taskSubject%7C".urlencode($step)."&condition=taskStatus%7CReceived&sort=instanceId&organization=byTask&run=true&shared=false&filterByCurrentUser=false&size=100",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: a26136bf-ae9f-1c2f-2cd6-78ca6958131a"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  $responseObj = new ResponseRunQuery();

  if ($err) {
    //echo "cURL Error #:" . $err;
    $responseObj->status='400';
    $responseObj->errorMessage = "cURL Error #:" . $err;
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
            array_push( $responseObj->taskList, $task);     
         }
       }
       //$responseObj->exposedItemList=$obj['data']['exposedItemsList'];
       

    } else {
       $responseObj->status=$obj['status'];
       $responseObj->errorMessage="Error ".$obj['status'];
    }
    
  }

  return $responseObj;

}

 // $auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
 // echo "<pre>";
 // echo var_dump(getTaskListByStep($auth,"Step: Evaluasi data"));
 // echo "</pre>";
?>