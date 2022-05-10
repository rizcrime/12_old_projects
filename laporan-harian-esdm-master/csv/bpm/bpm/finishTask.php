<?php


require_once("BpmObjectClass.php");

function callFinishTask($authorization,$taskId,$data) {

  $dataJson = json_encode($data);
  $dataPermohonan = '{"permohonan":'.$dataJson.'}';

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/task/".$taskId."?action=finish&params=".urlencode($dataPermohonan),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: 207af25c-6524-3453-f562-7cdf40014cce"
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
          $responseObj->status=$setData->status;
          $responseObj->errorMessage=$setData->errorMessage;
          $responseObj->exceptionType = $setData->exceptionType;
    }

  }

  return $responseObj;

}

?>