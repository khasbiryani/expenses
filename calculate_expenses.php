<?php

error_reporting(0);

require_once("property_read.php");

require_once("database_connect.php");

$branch=$property_decode["branch"];

$month=$_REQUEST['month']+1;

$year=$_REQUEST['year'];

$days=$_REQUEST['days'];

if($month<10)

{

	$month="0".$month;



}

 $fromdate="$year-$month-01";

 $todate="$year-$month-$days";

$total=0;

 $query="select sum(c30) from t104 where c23 between '$fromdate' and '$todate' and c13='$branch'";

$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

				

				foreach($row as $key=>$value)

				{

					

					$total=$value;

				}

				

				}

	}

	

	

	

	

	

	//payroll from clover

	date_default_timezone_set("America/Chicago");

	$total_pay=0;

	

$in=strtotime($fromdate.' 00:00:01') * 1000;



$out=strtotime($todate.' 23:59:59') * 1000;

 $url="https://www.clover.com/v3/merchants/".$property_decode["clover"][$branch]["merchId"]."/shifts?filter=in_time>=$in&filter=out_time<=$out";

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

			//echo "<tr>";

			$start=date("d-m-Y H:i:s",substr($value,0,10));

			$end=date("d-m-Y H:i:s",substr($out_time[$name][$in],0,10));

			$day=date("l",strtotime($start));

			//echo "<td>$name - $day</td><td>$start</td><td>$end</td>";

			//echo "$name inTIme: $start   OutTime: $end  elapsed time:";

			$first=new DateTime($start);

			$second=new DateTime($end);

	$interval = $first->diff($second);

$elapsed = $interval->format('%h hours %i minutes %s seconds');

		//echo "<td>$elapsed</td>";

$hours=$interval->format('%h');

$minutes=round(($interval->format('%i'))/60,4);

$seconds=round(($interval->format('%s'))/3600,4);

$hours=$hours+$minutes+$seconds;

//echo "   <td> $hours</td><td>".$pay_array[$name]."</td> ";

$cal=0;

if($pay_array[$name]!=null)

{

$cal=round($hours*$pay_array[$name],2);

$total_pay+=$cal;

}



			

		}

		}

	$total+=$total_pay;

	

	

	//



	

	

	

	

	$query="select sum(c36) from t107 where c13='$branch' and c23 between '$fromdate' and '$todate';";

	$sales=0;

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

				

				foreach($row as $key=>$value)

				{

					

					$sales=$value;

				}

				

				}

	}

	$sales=round($sales,2);

	

	echo "

	<p style='color:#FD0761'>Profit : $";

	$profit=round($sales-$total,2);

	echo $profit;

	

	echo "<p >Expense: $$total </p> 

	<p style='color:#FF5733'>Sales : $$sales </p>";

	echo "</p>";