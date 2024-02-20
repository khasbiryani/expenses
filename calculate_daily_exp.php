<?php
//error_reporting(0);
$update_only_str=file_get_contents('main.json');
	$main_decode=json_decode($update_only_str,true);
	$months_ind=[0,1,2,3,4,5,6,7,8,9,10,11];
	$i=$main_decode['last-updated'];
	$begin=new dateTime("$i");
	$today=date("d-m-Y");
$tomorrow=new dateTime("tomorrow");
$interval = DateInterval::createFromDateString('1 day');
//$today->setTime(0,0,1);
$period = new DatePeriod($begin, $interval, $tomorrow);
$counter=0;
foreach ($period as $dt) {
	$counter+=1;
	echo $date=$dt->format("d-m-Y");
	if($counter<2)
	{
		
	}
	else
	{
		$date=$dt->format("d-m-Y");
		$month=$dt->format("m")-1;
		$year=$dt->format("Y");
		$day=$dt->format("d");
		$day_l= date('D', strtotime($date));
		
	if(true)
				{
					$counter=1;
					//echo "$date doesn't exist<br>";
					$exp_arr=array();
					$actual_arr=array();
					$n_days=cal_days_in_month(CAL_GREGORIAN,$month-1,$year);
					$payroll_info=array();
					
					
							$pay_cal_tot=0;
							foreach($main_decode['schedule'] as $name=>$day)
							{
								
								
								$hours_str=$day["$day_l"];
								if($hours_str=='OFF')
								{
									continue;
								}
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
								
								$pay_cal=$main_decode['users']["$name"]['pay']*$hours;
								$pay_cal_tot+=$pay_cal;
								//echo "$name $day_l $hours $pay_cal <br>";
								$payroll_info[$name]['hours']="$hours";
								$payroll_info[$name]['pay']="$pay_cal";
								
							}
							$pay_cal_total=round($pay_cal_tot,2);
						unset($main_decode['daily-expenses']["$date"]["actual"]["Total"]);
					$main_decode['daily-expenses']["$date"]["actual"]["Payroll"]="$pay_cal_total";
					$tot=0;
					foreach($main_decode['daily-expenses']["$date"]["actual"] as $key7=>$num)
					{
						$tot+=$num;
					}
					$main_decode['daily-expenses']["$date"]["actual"]["Total"]="$tot";
					$main_decode['daily-expenses']["$date"]["day"]="$day_l";
					$main_decode['daily-expenses']["$date"]["Payroll_details"]=$payroll_info;
					
				
				
	
	}
	
}
}
if($counter==1)
{
$main_decode['last-updated']=$today;
	$jsonData = json_encode($main_decode);
	file_put_contents('main.json', $jsonData);
	
}
?>