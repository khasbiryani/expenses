<?php
$data=$_REQUEST["data"];

$data=explode(";",$data);
$link = $data[0];
$public = $data[1];
$access = $data[2];

include_once("database_connect.php");

echo $query = "insert into t115 (c73,c74,c75) values('$link','$public','$access')";
if($result=mysqli_query($con,$query))

{

	echo "<b>yes</b>";

	

}

else

{

		echo "<b>no</b>";

}

?>