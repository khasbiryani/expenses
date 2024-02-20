<?php
$update_only_str=file_get_contents('notes.json');
$notes_decode=json_decode($update_only_str,true);
require_once("property_read.php");
				$branch=$property_decode["branch"];
$month=$_REQUEST['val'];
$year=$_REQUEST['year'];
$key=$year."-".$month."-".$branch;
$content=$_REQUEST['content'];
$notes_decode[$key]=$content;
	$newJsonString = json_encode($notes_decode);
file_put_contents('notes.json', $newJsonString);




?>