<?php
$host="localhost:3306";
$user="root";
$pwd="";
$db="porto";
// $host="50.62.137.41";
// $user="port";
// $pwd="Portos!1";
// $db="portofperiperi";
$con=mysqli_connect($host,$user,$pwd,$db);
if(mysqli_connect_errno())
{
		echo "failed to connect to data base".mysqli_connect_error();
}

?>