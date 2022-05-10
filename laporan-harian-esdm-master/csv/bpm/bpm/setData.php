<?php

require_once("BpmObjectClass.php");

function callSetData($authorization,$taskId,$data) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $dataJson = json_encode($data);
  $dataPermohonan = '{"permohonan":'.$dataJson.'}';

  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/task/".$taskId."?action=setData&params=".urlencode($dataPermohonan),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: b2631e32-d14f-b589-8c34-b34fbcf29d93"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  $responseObj = new ResponseSetData();

  if ($err) {
    $responseObj->status='400';
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


//Contoh call

// $bpdId = "25.4d157674-ea38-4c9c-b8ae-1dc1ac0e78ef";
// $branchId = "2063.cea29001-7378-4484-8e24-8ce25aed66e3";
// $appId = "2066.960b0111-9fbb-4d9d-b173-62a594a21aa0";
// $auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
// $data = new Permohonan();
// $data->idPermohonan = "8546";
// $data->jenisIzin = "Izin Usaha Minerba 1";
// $data->namaPerusahaan = "PT AGUS CITS 3";
// $data->idPerusahaan = "88888";
// $data->npwp = "014947878343";
// $data->statusPermohonan = "Evaluasi oleh Evaluator";
// $data->isTolak = "false";  //default
// $data->isBacktoEvaluator = "false";  //default
// // $data->ditolakBy; 
// //$data->catatanEselon2;
// //$data->catatanEselon3;
// //$data->catatanEselon4;
// $data->catatanInvestor = "Ini catatan investor";
// //$data->currentUser;
// $taskId = "6133";
// $test = callSetData($auth,$taskId,$data);
// $dataJson = json_encode($data);
// $dataPermohonan = '{"permohonan":'.$dataJson.'}';
// //echo "<pre>";
// //var_dump($test);
// //echo "</pre>";

?>