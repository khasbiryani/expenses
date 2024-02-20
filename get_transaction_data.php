<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://development.plaid.com/transactions/get',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
 "client_id": "6021bb6e241237001162670d",
  "secret": "eda19607f01fb06571b0e22e568561",
  "access_token": "access-development-66ad72fc-b402-4c79-b174-c2b77cf4211d",
  "start_date": "2022-01-01",
  "end_date": "2022-09-01" 
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo gettype($response);
// $response =  json_encode($response);
$response = json_decode($response,true);
foreach($response["transactions"] as $key => $transactions){
  echo $transactions["merchant_name"];
  echo "<br>";
}
?>