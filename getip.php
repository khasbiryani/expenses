<?php
 $ipaddress = getenv("REMOTE_ADDR") ;
//  Echo "Your IP Address is " . $ipaddress;
 $url="ipinfo.io/$ipaddress?token=8a32a4c4d38d2d";
 $curl = curl_init();
 
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
 
$data = curl_exec($curl);
$p=json_decode($data,true); 

curl_close($curl);
// print_r($p);

$update_only_str=file_get_contents('ipaddress.json');
$ipaddress_json=json_decode($update_only_str,true);
date_default_timezone_set("America/Chicago");
$date=date("m-d-Y;h:i:sa;l");
$p['date']=$date;
array_unshift($ipaddress_json, $p);
// print_r($ipaddress_json);
$newJsonString = json_encode($ipaddress_json);
file_put_contents('ipaddress.json', $newJsonString);


?>