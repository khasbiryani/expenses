<?php
$from=$_REQUEST['from'];
$to=$_REQUEST['to'];
$id=$_REQUEST['id'];

require_once("property_read.php");
				require_once("database_connect.php");
				$branch=$property_decode["branch"];
				
				
				if($id=="Select Employee")
					$uri="shifts";
				else
				{
					$uri="employees/$id/shifts";
				}
				echo "<h3 style='text-align:center'><b>Payroll</b></h3>";
	
	echo "<table class='table table-hover'>
	
	<thead style='background-color:#323232;color:white;'><tr><td>Name</td><td>In Time</td> <td>Out Time</td><td>Elapsed Time</td><td>hours worked</td> <td>Pay</td><td>Amount</td></tr></thead>
	
	
	";
	$date=$from;
	date_default_timezone_set("America/Chicago");
	$total_pay=0;
	$total_hours=0;
	
$in=strtotime($date.' 00:00:01') * 1000;

$out=strtotime($to.' 23:59:59') * 1000;
 $url="https://www.clover.com/v3/merchants/".$property_decode["clover"][$branch]["merchId"]."/$uri?filter=in_time>=$in&filter=out_time<=$out";
$post_data = NULL;
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$property_decode["clover"][$branch]["apiToken"] 
        )                                                                       
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if($post_data != NULL){
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));
        }
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$p=json_decode($data,true);
		//print_r($p);
		$counter= count($p['elements']);
		$in_time=Array();
		$out_time=Array();
		$pay_array=Array();
		for($i=0;$i<$counter;$i++)
		{
			$eid=$p["elements"][$i]['employee']['id'];
			$ename=$p["elements"][$i]['employee']['id'];
			$query="select c2,c5 from t101 where c1='$eid'";
			$result=mysqli_query($con,$query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					
				foreach($row as $key=>$value)
				{
					
					if($key=='c2')
					{
					$ename=$value;
					$pay_array[$ename]=0;
					}
					else if($key=='c5')
						$pay_array[$ename]=$value;
				}
				}
	}
			
				if(array_key_exists('overrideInTime',$p["elements"][$i]))
				{
					$in_time[$ename][$i]=$p["elements"][$i]['overrideInTime'];
					
				}
				 else 
					$in_time[$ename][$i]=$p["elements"][$i]['inTime'];
				
				if(array_key_exists('overrideOutTime',$p["elements"][$i]))
					$out_time[$ename][$i]=$p["elements"][$i]['overrideOutTime'];
				else
					$out_time[$ename][$i]=$p["elements"][$i]['outTime'];
			
		}
		
		//print_r($in_time);
		foreach($in_time as $name=>$val)
		{
			foreach($val as $in=>$value)
			{
			echo "<tr>";
			$start=date("d-m-Y H:i:s",substr($value,0,10));
			$end=date("d-m-Y H:i:s",substr($out_time[$name][$in],0,10));
			$day=date("l",strtotime($start));
			$begin=date("m-d-Y H:i:s",substr($value,0,10));
			$stop=date("m-d-Y H:i:s",substr($out_time[$name][$in],0,10));
			echo "<td>$name - $day</td><td>$begin</td><td>$stop</td>";
			//echo "$name inTIme: $start   OutTime: $end  elapsed time:";
			$first=new DateTime($start);
			$second=new DateTime($end);
	$interval = $first->diff($second);
$elapsed = $interval->format('%h hours %i minutes %s seconds');
		echo "<td>$elapsed</td>";
$hours=$interval->format('%h');
$minutes=round(($interval->format('%i'))/60,4);
$seconds=round(($interval->format('%s'))/3600,4);
$hours=$hours+$minutes+$seconds;
echo "   <td> $hours</td><td>".$pay_array[$name]."</td> ";
$cal=0;
$total_hours+=$hours;
if($pay_array[$name]!=null)
{
$cal=round($hours*$pay_array[$name],2);
$total_pay+=$cal;

}
echo "<td>$cal</td>";
			echo "</tr>";
			
		}
		}

$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
	
	echo "<tr style='background-color:yellow;'><td></td><td></td><td></td><td>Total Hours</td><td>$total_hours</td><td>Total Amount:</td><td><b>$total_pay</b></td></tr>";
	echo "</table>";
	
	
	
	
	

?>