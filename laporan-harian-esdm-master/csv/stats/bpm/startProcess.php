<?php

require_once("BpmObjectClass.php");

require_once("setVariablePermohonan.php");

function callStartProcessWithData($authorization, $bpdId, $branchId, $appId, $data) {

  $dataJson = json_encode($data);
  $dataPermohonan = '{"permohonan":'.$dataJson.'}';

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/process?action=start&bpdId=".$bpdId."&branchId=".$branchId,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"bpdId\"\r\n\r\n".$bpdId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"processAppId\"\r\n\r\n".$appId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"part\"\r\n\r\ndata\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"params\"\r\n\r\n".$dataPermohonan."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      //"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
      "postman-token: 23ed6e81-5fd1-e926-9ef8-be474f530f47"
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
       $responseObj->status=$obj['status'];
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
       $setData = callSetPermohonan($authorization,$responseObj->piid,$data);
       if ($setData->status=="200") {
          //Set data berhasil
       } else {
          //Set data gagal
          $responseObj->status=$setData->status;
          $responseObj->errorMessage=$setData->errorMessage;
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

// //Contoh call
// $bpdId = "25.4d157674-ea38-4c9c-b8ae-1dc1ac0e78ef";
// $branchId = "2063.cea29001-7378-4484-8e24-8ce25aed66e3";
// $appId = "2066.960b0111-9fbb-4d9d-b173-62a594a21aa0";
// $auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
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
// $data->catatanInvestor = "Ini catatan investor";
// $test = callStartProcessWithData($auth,$bpdId,$branchId,$appId,$data);
// echo "<pre>";
// var_dump($test);
// echo "</pre>";


?>