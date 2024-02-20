<?php
//error_reporting(0);
require_once("property_read.php");
				require_once("database_connect.php");
				$branch=$property_decode["branch"];
				$query="select c14 from t102 where c13='$branch'";
				
				$result = mysqli_query($con, $query);
				$branch_name="";
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				$branch_name=$row["c14"];
				}
				}

	//error_reporting(0);
	
	 $month=$_REQUEST['val']+1;
	 $year=$_REQUEST['year'];
	 if($month<10)
	{
		$month="0".$month;
	}
	$n_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
	$from=date("Y-m-d", strtotime("01-".$month."-".$year));
$todate=date("Y-m-d",strtotime("$n_days-$month-$year"));
	
	
	
	
	
	$days=["","Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
	$data=array();
	$date=$from;
	 $dt=date("d-m-Y", strtotime($date));
	$day= date('D', strtotime($date));
	$key = array_search($day, $days);
	$i=0;
	
	$flag=0;
	$d=1;
	for($i=1;$i<7;$i++)
	{
		echo "<tr>";
	for($j=1;$j<8;$j++)

	{     
               if($i==1 && $j<$key)
			   {
				   echo "<td> </td>";
			   }
	else
	{
	$query="select sum(c30) from t114 where c31='$date' and c13='$branch'";
	$result=mysqli_query($con,$query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					
				foreach($row as $key=>$value)
				{
					$value=round($value,2);
					$data[$date]['payroll']=$value;
					
					
				}
				}
	}
	$total_exp=0;
	 $query="select sum(c30) from t104 where c23='$date' and c13='$branch';";
	$result=mysqli_query($con,$query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					
				foreach($row as $key=>$value)
				{
					$total_exp+=$value;
					//array_push($category,"Total");
					//array_push($values,$total_exp);
				//array_push($val_array,$values);
				//$values=array();
				}
				}
	}
	

	//echo "<td>Total Expenses</td><td>$$total_exp</td></tr>";
	
	
	
	
	
// 	//payroll from clover start

	

// 	date_default_timezone_set("America/Chicago");

// 	$total_pay=0;

	

// $in=strtotime($date.' 00:00:01') * 1000;



// $out=strtotime($date.' 23:59:59') * 1000;

//  $url="https://www.clover.com/v3/merchants/".$property_decode["clover"][$branch]["merchId"]."/shifts?filter=in_time>=$in&filter=out_time<=$out";

// $post_data = NULL;

//   $ch = curl_init();

//         curl_setopt($ch, CURLOPT_URL, $url);

//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//         // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));

//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$property_decode["clover"][$branch]["apiToken"] 

//         )                                                                       

//         );

//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

//         if($post_data != NULL){

//             curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));

//         }

//         $data1 = curl_exec($ch);

//         $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// 		$p=json_decode($data1,true);

// 		//print_r($p);

// 		$counter= count($p['elements']);

// 		$in_time=Array();

// 		$out_time=Array();

// 		$pay_array=Array();

// 		for($i=0;$i<$counter;$i++)

// 		{

// 			$eid=$p["elements"][$i]['employee']['id'];

// 			$ename=$p["elements"][$i]['employee']['id'];

// 			$query="select c2,c5 from t101 where c1='$eid'";

// 			$result=mysqli_query($con,$query);

// 	if (mysqli_num_rows($result) > 0) {

// 				// output data of each row

// 				while($row = mysqli_fetch_assoc($result)) {

					

					

// 				foreach($row as $key=>$value)

// 				{

					

// 					if($key=='c2')

// 					{

// 					$ename=$value;

// 					$pay_array[$ename]=0;

// 					}

// 					else if($key=='c5')

// 						$pay_array[$ename]=$value;

// 				}

// 				}

// 	}

			

// 				if(array_key_exists('overrideInTime',$p["elements"][$i]))

// 				{

// 					$in_time[$ename][$i]=$p["elements"][$i]['overrideInTime'];

					

// 				}

// 				 else 

// 					$in_time[$ename][$i]=$p["elements"][$i]['inTime'];

				

// 				if(array_key_exists('overrideOutTime',$p["elements"][$i]))

// 					$out_time[$ename][$i]=$p["elements"][$i]['overrideOutTime'];

// 				else

// 					$out_time[$ename][$i]=$p["elements"][$i]['outTime'];

			

// 		}

		

// 		//print_r($in_time);

// 		foreach($in_time as $name=>$val)

// 		{

// 			foreach($val as $in=>$value)

// 			{

// 			//echo "<tr>";

// 			$start=date("d-m-Y H:i:s",substr($value,0,10));

// 			$end=date("d-m-Y H:i:s",substr($out_time[$name][$in],0,10));

// 			$day=date("l",strtotime($start));

// 			//echo "<td>$name - $day</td><td>$start</td><td>$end</td>";

// 			//echo "$name inTIme: $start   OutTime: $end  elapsed time:";

// 			$first=new DateTime($start);

// 			$second=new DateTime($end);

// 	$interval = $first->diff($second);

// $elapsed = $interval->format('%h hours %i minutes %s seconds');

// 		//echo "<td>$elapsed</td>";

// $hours=$interval->format('%h');

// $minutes=round(($interval->format('%i'))/60,4);

// $seconds=round(($interval->format('%s'))/3600,4);

// $hours=$hours+$minutes+$seconds;

// //echo "   <td> $hours</td><td>".$pay_array[$name]."</td> ";

// $cal=0;

// if($pay_array[$name]!=null)

// {

// $cal=round($hours*$pay_array[$name],2);

// $total_pay+=$cal;

// }



			

// 		}

// 		}



// 	// $cost_array['Payroll']=$total_pay;



// 	// echo number_format($total_pay,2);

	$data[$date]['expenses']=$total_exp;
	
	

	//payroll from clover end
	$flag=0;
	$netsales=0;
	// $query="select sum(c36) from t107 where c23='$date' and c33='Net Sales' and c13='$branch';";
	// $result=mysqli_query($con,$query);
	// $data[$date]['netsales']=0;
	// // mysqli_num_rows($result);
	// if (mysqli_num_rows($result) > 0) {
	// 			// output data of each row
	// 			while($row = mysqli_fetch_assoc($result)) {
	// 				//echo "<tr>";
	// 				$na="";
				
	// 			//	print_r($row);
					
	// 				$data[$date]['netsales']=$row["sum(c36)"];
					
					
				
	// 			//echo "</tr>";
	// 			}
	// }
	//print_r($data);
	// $printing= "NetSales: $".$data[$date]['netsales']."<br>Total Expenses:$ ".$data[$date]['expenses']."<br>profit: $";
	// $printing= "<br>Expenses:$ ".$data[$date]['expenses']."<br>";
	// $cal=$data[$date]['netsales']-$data[$date]['expenses'];
	// $printing.=$cal; //this is adding the profit to the priting variable here. 
	$printing= "";
	$dt=date("d",strtotime($date));
	date_default_timezone_set("America/Chicago");
	 $today=date('Y-m-d');
	 $send=date('d-m-Y',strtotime($date));
	if($date==$today)
	{
		echo "<td style='background-color:#FFC300 ;'><a href='day_details.php?date=$send' class='day_div'><div style='height:100%';width='100%'><b> $dt </b><br> $printing</div></a></td>";
	}
	else{
	echo "<td class='day_div'><a href='day_details.php?date=$send' class='day_div'><div style='height:100%';width='100%'><b>$dt</b>  <br> $printing</div></a></td>";
	}
	 $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
	 $d++;
	}
	if($d>$n_days)
	{
		$flag=1;
		echo "</tr> ";
	break;
	}
	}
	if($flag==1)
		break;
	echo "</tr>";
	}

	
	//echo "</table>";
	
	
	
	
	
	?>
	
	