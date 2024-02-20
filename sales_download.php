<?php



	require_once("property_read.php");

    require_once("database_connect.php");

	date_default_timezone_set("America/Chicago");

	$branch=$property_decode["branch"];

    echo $date=$_REQUEST['dat'];

    $date=explode('-',$date);



	$d=mktime(0,0,0,(int)$date[1], (int)$date[0], (int)$date[2]);

	echo $date=date("d-m-Y", $d);

    $current_date=date("Y-m-d", $d);

echo $in=strtotime($date.' 00:00:01') * 1000;

echo $out=strtotime($date.' 23:59:59') * 1000;

 $url="https://www.clover.com/v3/merchants/".$property_decode['clover'][$branch]['merchId']."/orders/?filter=createdTime>=$in&filter=createdTime<=$out&expand=payments,payment.tender";

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

	  //print_r($p);

	//   $fp = fopen('orders.json', 'w');

	//   fwrite($fp, json_encode($p));

	//   fclose($fp);

		$total=0;

		$p=$p["elements"];

		$counter= count($p);

		$debit=0;

		$credit=0;

		$cash=0;

		$tax=0;

		$tips=0;

		$credit_count=0;

		for($i=0;$i<$counter;$i++){

			

			

			$val=0;

			if ($p[$i]["paymentState"]=="PAID"){

				

			foreach($p[$i]['payments']['elements'] as $data)

			{



			

			if (isset($data["tipAmount"]))

			{

				$tips+=$data["tipAmount"];

			}

			

				$val=$data["amount"];

				$tax+=$data["taxAmount"];

			

			$total+=$val;

			if ($data['tender']['label']=="Debit Card")

				$debit+=$val;

			else if($data['tender']['label']=="Credit Card")

			{

				$credit+=$val;

				$credit_count++;

				// echo ($val/100)." <br>";

				// echo $p[$i]['total']."<br>";

				// print_r($data);

				

			}

			else if($data['tender']['label']=="Cash")

				$cash+=$val;

			





			

			//echo "<br><br>";

		}

			}

		 }

        //  echo "<br>";

		// echo $netSales=($total-$tax)/100;

		// echo $debit=$debit/100;

		// echo $credit=$credit/100;

		echo $cash=$cash/100;

		// echo $tips=$tips/100;

		// echo $tax=$tax/100;

		// echo $amount_collected=$total/100+$tips;

        $today=date("Y-m-d");

		echo "<br> credit count: ".$amount_collected;

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

            mysqli_query($con,$query);
			}
            // if ($cat=="Net Sales")

            //     $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$netSales','$branch','$today');";

            // else if($cat=="Taxes & Fees")

            //     $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$tax','$branch','$today');";

            // else if($cat=="Tips")

            // $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$tips','$branch','$today');";

            // else if($cat=="Amount Collected")

            //     $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$amount_collected','$branch','$today');";

            // else if($cat=="Credit Card")

            //     $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$credit','$branch','$today');";

            // else if($cat=="Debit Card")

            // $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','$debit','$branch','$today');";

           

            // else

            // $query="insert into t107 (c23,c33,c36,c13,c25) values('$current_date','$cat','0','$branch','$today');";

        

           

        }

    }



        


	

	



?>