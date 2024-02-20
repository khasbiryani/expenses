<?php
$table=$_REQUEST["table"];
$id=$_REQUEST["id"];
include_once("property_read.php");

echo "<tr  name='$id' title='$id'>";
foreach($property_decode[$table]["10"] as $columns_insert=>$value)
{
	echo "<td><input type='text' id='$value' name='$table' required placeholder='enter Text..' class='form-control'></td>";
}
echo "<td><img src='images/remove.png' value='remove' title='$id'></td></tr>";
?>