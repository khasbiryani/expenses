<?php
error_reporting(0);
//echo "ur in search_fields";
$text=$_REQUEST['text'];
$table=$_REQUEST['table'];
include_once("database_connect.php");//data bse connectivity
$link="";
//reading property file
include_once("property_read.php");

$query="select * from $table where 1=1".$text;

//logging
	 $desc=":searched for $text data of $table,";
	 //$query_log="(#".$query."#)";
require_once('logging_sub_admin.php');
////
//echo $query;
echo '<table class="table table-hover"><tr>';
if($result=mysqli_query($con,$query))
	{
		
		if(($rows=mysqli_num_rows($result))>0)
		{
		echo "Count:$rows";
		echo '<table class="table table-hover"><tr>';
		while($col=(mysqli_fetch_field($result)->name))
		{
			
			$column=$array_names[$col];
			echo "<th>$column</th>";
		}
		echo "</tr>";
			while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
	$co=0;
    foreach($row as $key=>$field) {
		//echo $key;
	
		if($co==0)
			{
				$co++;
				$key1=$key;
			$link=$field;
			//continue;
			}
        echo "<td  ><a href='#' name='$table' title='$key1' value='60' id='$link'>" . $field . "</a></td>";
		
    }
		echo "<td><input type='button' class='btn  btn-success' value='update' id='$link' title='$key1' name='$table'>	</td>";
		echo "<td><img src='images/cancel.png'  class='cancel_icon' id='$link' title='$key1' value='60'  name='$table'></td>";
    echo '</tr>';
}
			echo "</table>";
			die();
		}
		else 
			echo "<b>Match Not Found</b>";
	}
?>
