<?php



	require_once("property_read.php");

	require_once("database_connect.php");

	date_default_timezone_set("America/Chicago");

	$branch=$property_decode["branch"];

	$d=mktime(0,0,0,11, 01, 2021);

	

		 $date=$property_decode['clover'][$branch]['last'];
		// $date= "2022-11-02";//be removed

		 $current_date=$date;
		// $current_date = "2022-11-02";// be removed

		$date=date_create($date);

		$today=date("Y-m-d");
		// $today = "2022-11-02";//be removed
		$yesterday=date('Y-m-d',strtotime("-1 days"));

		$current_time = date('H', time());

		if ($current_time<=23)

			$today=$yesterday;

		echo "<br>";
		// $today = "2022-04-01";//to be removed
		$today=date_create($today);

	

		$startDate=date_format($date,"d-m-Y");

		$endDate=date_format($today,"d-m-Y");

	

		$begin=new dateTime("$startDate");

	$stop=new dateTime("$endDate");

			$stop->setTime(0,0,1);

			$inter = DateInterval::createFromDateString('1 day');

	$period = new DatePeriod($begin, $inter, $stop);

	

	foreach ($period as $dt) {

		$current_date=$dt->format("d-m-Y");

		// echo $date=date("d-m-Y", $current_date);

		echo"\t";

$in=strtotime($current_date.' 00:00:01') * 1000;

echo "\t";

$out=strtotime($current_date.' 23:59:59') * 1000;

echo "<br>";

 $url="https://www.clover.com/v3/merchants/".$property_decode['clover'][$branch]['merchId']."/orders/?limit=500&filter=createdTime>=$in&filter=createdTime<=$out&expand=payments,payment.tender";

$post_data = NULL;

  $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$property_decode['clover'][$branch]['apiToken']

        )                                                                       

        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if($post_data != NULL){

            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));

        }

        $data = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		$p=json_decode($data,true);
		$myfile = fopen("sales_data.json", "w") or die("Unable to open file!");
		fwrite($myfile, $data);
		fclose($myfile);
	

		$total=0;

		$p=$p["elements"];

		$counter= count($p);
		// echo "count of elements".$counter;
		$debit=0;

		$credit=0;

		$cash=0;

		$tax=0;

		$tips=0;
		$doordash=0;
		$grubhub=0;
		$uber=0;
		$chownow=0;
		$phoneapp=0;


		$credit_count=0;
		$check_total = 0;
		$labels=array();
		for($i=0;$i<$counter;$i++){

			
			
			

			$val=0;

			if ($p[$i]["paymentState"]=="PAID" || $p[$i]["paymentState"]=="PARTIALLY_PAID"){

				echo ($p[$i]["total"]/100)."    ".$p[$i]["total"];
			$check_total += $p[$i]["total"]/100;
			echo "<br><br>";

			foreach($p[$i]['payments']['elements'] as $data)

			{


				if(!in_array($data['tender']['label'], $lables))
					array_push($labels,$data['tender']['label']);
			

			if (isset($data["tipAmount"]))

			{

				$tips+=$data["tipAmount"];

			}

			

				$val=$data["amount"];

				$tax+=$data["taxAmount"];

			

			$total+=$val+$data["tipAmount"];

			if ($data['tender']['label']=="Debit Card")

				$debit+=$val+$data["tipAmount"];

			else if($data['tender']['label']=="Credit Card")

			{

				$credit+=$val+$data["tipAmount"];

				$credit_count++;

			

				

			}

			else if($data['tender']['label']=="Cash")

				$cash+=$val;
			else if ($data['tender']['label']=="DoorDash")
				$doordash+=$val/100;
			else if ($data['tender']['label']=='UberEats')
				$uber+=$val/100;
			else if ($data['tender']['label']=='Grubhub')
				$grubhub+=$val/100;
			else if ($data['tender']['label']=='ChowNow')
				$chownow+=$val/100;
			else if ($data['tender']['label']=='PhoneApp')
				$phoneapp+=$val/100;
				 





			

			

		}

			}

		 }

		 echo "<br><br>";

		 echo "check Total  : ".$check_total."<br><br>";
		//  $netSales=(($total-$tax)/100);

		

		 $debit=$debit/100;

		 $credit=$credit/100;

		 $cash=$cash/100;

		 $tips=$tips/100;

		 $tax=$tax/100;
		 $total/=100;
		 $netSales=$total-$tax-$tips;
		 $amount_collected=$total;

		 print_r( $labels);
		 echo "<br>";
		

		echo $current_date=$dt->format("Y-m-d");
		echo "<br>";
		$today=date("Y-m-d");

		 $query="select c36 from t107 where c23='$current_date' and c33='Net Sales' and c13='$branch';";

		$result = mysqli_query($con, $query);

				$branch_name="";

				$cat_value=0;

				if (mysqli_num_rows($result) > 0) {

				echo "data exists";

				}

				else{

   

				

   

		foreach($property_decode['sales_type'] as $cat){
			if($cat=="Cash"){
				$query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$cash','$branch','$today');";
				echo $query;

			echo "<br><br>";

		    mysqli_query($con,$query);
			}
			

			// if ($cat=="Net Sales")

			// 	$query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$netSales','$branch','$today');";

			// else if($cat=="Taxes & Fees")

			// 	$query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$tax','$branch','$today');";

			// else if($cat=="Tips")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$tips','$branch','$today');";

			// else if($cat=="Amount Collected")

			// 	$query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$amount_collected','$branch','$today');";

			// else if($cat=="Credit Card")

			// 	$query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$credit','$branch','$today');";

			// else if($cat=="Debit Card")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$debit','$branch','$today');";

			
			// else if($cat=="DoorDash")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$doordash','$branch','$today');";
			// else if($cat=="UberEats")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$uber','$branch','$today');";
			// else if($cat=="GRUBHUB")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$grubhub','$branch','$today');";
			// else if($cat=="CHOWNOW")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$chownow','$branch','$today');";
			// else if($cat=="PhoneApp")

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$phoneapp','$branch','$today');";

			// else

			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','0','$branch','$today');";

		

			

		}

	}







	}

	$property_decode['clover'][$branch]['last']=$current_date;

	$newJsonString = json_encode($property_decode);

	file_put_contents('attribute.json', $newJsonString);



	

	



?>