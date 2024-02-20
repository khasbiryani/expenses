<?php
	error_reporting(0);
//$text=$_REQUEST['text'];
//$table=$_REQUEST['table'];
$text="101";
$table="t101";
include_once("database_connect.php");//daata base connectivity
//reading property file
include_once("property_read.php");

//for knowing no of columns
$read_all="select * from $table where 1=1 ";

$read_all_result= mysqli_query($con,$read_all);
$read_again=$read_all_result;
echo '<table class="table table-hover"><tr>';

while($name=(mysqli_fetch_field($read_again)->name))
{
	
	 $query="select * from ".$table." where 1=1 and $name='$text'";
	if($result=mysqli_query($con,$query))
	{
		if(($rows=mysqli_num_rows($result))>0)
		{
		while($col=(mysqli_fetch_field($result)->name))
		{
			echo "<th>".$array_names[substr(trim($col),1)]."</th>";
		}
		echo "</tr>";
			while ($row = mysqli_fetch_row($result)) 
			{
			echo "<tr>";
				foreach($row as $print)
						echo "<td>$print</td>";
				echo "<td><input type='button' class='btn  btn-success' value='update'</td>";
			echo "</tr>";	
			}
			echo '</table>';
			die();
		}
	}
			
}
?>