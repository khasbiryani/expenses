<?php
require_once("database_connect.php");
require_once("property_read.php");
	$branch=$property_decode["branch"];
$query="select c2,c1 from t101 where c13='$branch'";
echo "<input type='checkbox' onclick='expand(this.id)' id='expandall'> Expand all";
$result=mysqli_query($con,$query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<details>";
				foreach($row as $key=>$value)
				{
					if($key=="c2")
					{
						echo "<summary><b>$value</b></summary>";
					}
					else if($key=="c1"){
						$query2="select c31,c32,c17,c33,c30,c23 from t105 where c1='$value' and c13='$branch' ORDER by c31 DESC; ";
						
						$result2 = mysqli_query($con, $query2);
						echo "<table class='table table-hover'><thead class='thead-dark'><tr><th>From Date</th><th>To Date</th><th>Hours Worked</th>
						<th>Payment MOde</th>
						<th>Amount Paid</th>
						<th>Date Paid On</th>
						</tr></thead>";
			if (mysqli_num_rows($result2) > 0) {
						// output data of each row
						while($row2 = mysqli_fetch_assoc($result2)) {
							echo "<tr>";
						foreach($row2 as $key2=>$value2)
						{
							echo "<td>$value2</td>";
						}
						echo "</tr>";
						}
			}
			
			echo "</table>";
					}
				}
				echo "</details>";
				}
	}

?>