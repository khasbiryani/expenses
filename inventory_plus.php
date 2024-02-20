<?php
require_once("property_read.php");
				require_once("database_connect.php");
				$branch=$property_decode["branch"];
$id=$_REQUEST['id'];

$val=$_REQUEST['val'];
$val+=1;
$query="update t110 set c55='$val' where c42='$id'";
mysqli_query($con,$query);
echo $val;

?>