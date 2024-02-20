<?php
require_once("property_read.php");
require_once("database_connect.php");
$branch=$property_decode["branch"];
$text=$_REQUEST['text'];
$text=rtrim($text,",");
$startDate=date_create($_REQUEST['startDate']);
$endDate=date_create($_REQUEST['endDate']);

$diff=date_diff($startDate,$endDate);
$interval=$diff->format("%a");
$interval=trim($interval)+1;
$key_val=explode(',',$text);
$valuesArr=array();
$from=date_format($startDate,"m-d-Y");
$to=date_format($endDate,"m-d-Y");
$cat_id_val=Array();
foreach($key_val as $row)
{
	$row;
	$cols=explode(":",$row);
	$index1=$cols[0];
	$index2=$cols[1];
	$index1=explode("_",$index1);
	//$cat_id_val[$index1[0]]=$index2;
	//echo $main_decode["inserted-data"]["$from to $to"][$index1]="$index2";
	$valuesArr[$index1[0]]=round($cols[1]/$interval,2);
}


$startDate=date_format($startDate,"d-m-Y");
$endDate=date_format($endDate,"d-m-Y");

				
				
$begin=new dateTime("$startDate");
$stop=new dateTime("$endDate");
		$stop->setTime(0,0,1);
		$inter = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $inter, $stop);
foreach ($period as $dt) {
	$current_date=$dt->format("Y-m-d");
	//$current_date;
	$today=date("Y-m-d");
	foreach($valuesArr as $cat=>$val)
	{
		$query="select c36 from t107 where c23='$current_date' and c33='$cat' and c13='$branch';";
		$result = mysqli_query($con, $query);
				$branch_name="";
				$cat_value=0;
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo $cat_value=$row['c36'];
					echo $val+=$row['c30'];
				$q="update t107 set c36='$val' where c23='$current_date' and c33='$cat' and c13='$branch';";
				mysqli_query($con,$q);
				
				$up="select c36 from t107 where c23='$current_date' and c33='Net Sales' and c13='$branch';";
				$result = mysqli_query($con, $up);
				$branch_name="";
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo $netsales=$row['c36'];
					$netsales=$netsales-$cat_value+$val;
					echo $q="update t107 set c36='$netsales' where c23='$current_date' and c33='Net Sales' and c13='$branch';";
				mysqli_query($con,$q);
				}
				}
				
				}
				}else{
		
		
		
		$query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$val','$branch','$today');";
		mysqli_query($con,$query);
				}
		
	}

}

	
		
		

?>