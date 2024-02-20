<?php
$table=$_REQUEST["table"];
include_once("property_read.php");
echo "<h3>Insert Data into ".$property_decode[$table]["name"]."</h3>";
echo "<div align='right'><input type='button' align='right' value='+Add' class='btn btn-success' name='$table'></div>";
echo "<form id='10' name='$table'><table class='table table-hover' id='table_insert'><tr>";
$col_count=0;
foreach($property_decode[$table]["10"] as $columns_insert=>$value)
{
		echo "<th>$property_decode[$value]</th>";	
		$col_count++;
}
echo "</tr>";
echo "</table></form><input type='button' value='Insert' class='btn btn-primary' name='$table' onclick='insert_multiple(this.name)'>$$col_count";

?>