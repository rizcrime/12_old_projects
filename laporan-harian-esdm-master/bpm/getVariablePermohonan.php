<?php


require_once("BpmObjectClass.php");
function callGetPermohonan($authorization,$instanceId) {

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/process/".$instanceId."?parts=data",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: 034236c8-24f3-24e8-960a-4712e6665197"
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
?>