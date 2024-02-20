<?php
$data = $_REQUEST["data"];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://development.plaid.com/item/public_token/exchange',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "client_id": "6021bb6e241237001162670d",
    "secret": "6f045d39b888276633504216a9bd3d",
  "public_token": $data
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response,true);
echo $response["access_token"];
// echo "access-development-66ad72fc-b402-4c79-b174-c2b77cf4211d";
?>

