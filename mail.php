<?php



$to = "aurora.il@myperiperi.com";
// $to = "munazzaruddin@gmail.com";
$otp= rand();
require_once("property_read.php");
$property_decode["otp"]=$otp;
$newJsonString = json_encode($property_decode);
file_put_contents('attribute.json', $newJsonString);
$subject = "OTP : $otp";
$message = "
<html style='height:100%'>
<head>
<title>HTML email</title>
<style>

  </style>
</head>
<body style='background:#808080; text-align:center; color: white; font-family: garamond, georgia; border-radius:15px; height: 100%'>
<img src='http://sedatdilek.com/images/portofperiperilogo-long.png' heigh='250px' width='425px'>
<h4 style='font-style: italic'>Hello, Sedat Dilek</h4>
<h2>your one time password is <b>: $otp </b></h2>

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: aurora.il@myperiperi.com' . "\r\n";


mail($to,$subject,$message,$headers);

?><meta http-equiv="refresh" content="0;url=update_password.php">


