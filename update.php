<?php
//error_reporting(0);
$text=$_REQUEST['text'];
 $link=$_REQUEST['link'];
$table=$_REQUEST['table'];
include_once("database_connect.php");
//reading property file
include_once("property_read.php");
$set_values=explode(",",$text);
//print_r($set_values);
$eid="";
$branch="";
foreach($set_values as $key=>$values)
{
	$key_arr=explode("=",$values);
	//print_r($key_arr);
	
		
		if($key_arr[0]=='c13')
		{
			$branch=$key_arr[1];
		}
	
}

 $now_time = DateTime::createFromFormat('U.u',microtime(true));
	 $date_time=(string)$now_time->format("d/m/Y-H:i:s");
	 $text=substr($text,0,-1);
	 // $text=$text."c23='".$date_time."'";
	 $query="update $table set $text where 1=1".$link;
 
 //logging
	// $desc=":updated $table table and set text as $text with reference $link";
	// $query_log="(".$query.")";
//require_once('logging_sub_admin.php');
////
if($result=mysqli_query($con,$query))
{
	echo "<b>Record Updated SuccessFully</b>";
	
}
else
{
		echo "<b>Error Updating record</b>";
}

$query="update t103 set c13=$branch where 1=1$link";

$result=mysqli_query($con,$query);

?>