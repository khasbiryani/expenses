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
		$query="select c30 from t104 where c23='$current_date' and c19='$cat' and c13='$branch';";
		$result = mysqli_query($con, $query);
				$branch_name="";
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$val+=$row['c30'];
				$q="update t104 set c30='$val' where c23='$current_date' and c19='$cat' and c13='$branch';";
				mysqli_query($con,$q);
				}
				}else{
		
		$query="insert into t104 (c23,c19,c30,c13,c25) values('$current_date','$cat','$val','$branch','$today');";
		mysqli_query($con,$query);
				}
		
	}

}

	
		
		

?>