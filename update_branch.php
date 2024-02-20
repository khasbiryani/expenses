<?php
require_once('property_read.php');
$id=$_REQUEST['id'];

$property_decode['branch']=$id;
$newJsonString = json_encode($property_decode);
file_put_contents('attribute.json', $newJsonString);


?>