<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https:/development.plaid.com/link/token/create',
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
  "client_name": "Insert Client name here",
  "country_codes": ["US"],
  "language": "en",
  "user": {
    "client_user_id": "unique_user_id"
  },
  "products": ["auth"]
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
$response = json_decode($response,true);
echo $response["link_token"];

?>
