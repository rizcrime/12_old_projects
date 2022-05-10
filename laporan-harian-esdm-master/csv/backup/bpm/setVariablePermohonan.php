<?php

require_once("BpmObjectClass.php");

function callSetPermohonan($authorization,$instanceId,$data) {

  $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/process/".$instanceId."/variable/permohonan",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: 7918dde9-971b-9a05-d27f-2841d469d73d"
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


// $data = new Permohonan();
// $data->idPermohonan = "8546";
// $data->jenisIzin = "Izin Usaha Minerba 2";
// $data->namaPerusahaan = "PT AGUS CITS 2";
// $data->idPerusahaan = "88888";
// $data->npwp = "014947878343";
// $data->statusPermohonan = "Evaluasi oleh Evaluator";
// $data->isTolak = "false";  //default
// $data->isBacktoEvaluator = "false";  //default
// $data->tglPengajuan = "2018-10-17T17:08:00Z";
// $auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";

// callSetPermohonan($auth,"1998",$data);

?>