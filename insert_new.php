<?php
error_reporting(0);
include_once("database_connect.php");
require_once("property_read.php");
$table=$_REQUEST["table"];
$columns=$_REQUEST["cols"];
$values=$_REQUEST["values"];
$col_array=explode(":",$columns);
$values_array=explode(":",$values);
$query=" ";
	
foreach($col_array as $index=>$col)
{
	$now = DateTime::createFromFormat('U.u',microtime(true));
	  $trno=(string)$now->format("YmdHisu");
	 $date_time=(string)$now->format("d/m/Y-H:i:s");
	//echo $col."<br>";
 $val=$values_array[$index];
 if($table=='t102'||$table=='t101'||$table=='t105')
	  $query="insert into $table $col values $val";
 else
	 $query="insert into $table"."_".$property_decode['current_database']['value']."$col values $val";
	//echo "<br>";
	
	//logging
	 $desc=":inserted new record to $table table with values= $val";
	// $query_log="(".$query.")";
require_once('logging_sub_admin.php');
////
	if($result=mysqli_query($con,$query))
	{
		echo "<b>Record inserted SuccessFully</b><br>";
	
	}
	else
	{
		echo "<b>Error inserting record</b><br>".mysqli_error();;
	}
	
}

?>