<?php
require_once('database_connect.php');
$id=$_REQUEST['id'];
$value=$_REQUEST['value'];




$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
		 $schedule_id=explode("-",$id);
$hours_str=$value;
					$hours_array=explode("-",$hours_str);
					$hours_min_start=explode(":",$hours_array[0]);
					$hours_min_end=explode(":",$hours_array[1]);
					
					if($hours_min_start[0]<10)
					{
						$hours_min_start[0]+=12;
					}
					$hours_min_end[0]+=12;
					$hours=$hours_min_end[0]-$hours_min_start[0];
					$minus=$hours_min_start[1]/60;
					$plus=$hours_min_end[1]/60;
					$hours=$hours-$minus+$plus;
					
					$query="select c5 from t101 where c1='".$schedule_id[2]."' and c13='".$schedule_id[1]."'";
					$pay='';
					$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				foreach($row as $key=>$value)
				{
					$pay=$value;
				}
					$pay_cal=$pay*$hours;
				}
	}
		 echo $query="update t103 set c16='$hours_str', c17='$hours', c18='$pay_cal' where c15='".$schedule_id[0]."' and c13='".$schedule_id[1]."' and c1='".$schedule_id[2]."';";
		if($result=mysqli_query($con,$query))
{
	echo "<b>Record Updated SuccessFully</b>";
	
}

?>