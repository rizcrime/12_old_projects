
<?php

require_once("BpmObjectClass.php");

function callExposedProcess($authorization) {

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "9443",
    CURLOPT_URL => "https://bpm.esdm.go.id:9443/rest/bpm/wle/v1/exposed/process",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "authorization: ".$authorization,
      "cache-control: no-cache",
      "postman-token: feb170d6-62b0-2a6e-ca4b-480d7416d744"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  $responseObj = new ResponseExposedProcess();

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
       foreach ($obj['data']['exposedItemsList'] as $item) {
          $exposedItem = new ExposedItem();
          $exposedItem->type=$item['type'];
          $exposedItem->itemID=$item['itemID'];
          $exposedItem->branchID=$item['branchID'];
          $exposedItem->processAppID=$item['processAppID'];
          $exposedItem->processAppName=$item['processAppName'];
          $exposedItem->startURL=$item['startURL'];  
          $exposedItem->display=$item['display'];
          array_push( $responseObj->exposedItemList, $exposedItem);     
       }
       //$responseObj->exposedItemList=$obj['data']['exposedItemsList'];
       

    } else {
       $responseObj->status=$obj['status'];
       $responseObj->errorMessage="Error ".$obj['status'];
    }
    
  }

  return $responseObj;

}


//Contoh call
//$auth = "Basic Y2l0c19kZXY6Y2l0czEyMw==";
//$test = callExposedProcess($auth);
//var_dump($test);



?>