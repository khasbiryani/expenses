<?php
$year=$_REQUEST['year'];
$month=$_REQUEST['month'];

	$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
		
		if(empty($main_decode["expected-exp"]["$year"]["$month"]))
		{
			
			$main_decode["expected-exp"]["$year"]["$month"]=$main_decode["expected-exp"]["2020"]["0"];
			$jsonData = json_encode($main_decode);
			file_put_contents('main.json', $jsonData);
			
		}
		else
		{
			$expected_exp=0;
			foreach($main_decode["expected-exp"]["$year"]["$month"] as $key=>$value)
			{
				if($key=="Total")
					break;
				$expected_exp+=$value;
				
			}
			
			$main_decode["expected-exp"]["$year"]["$month"]["Total"]="$expected_exp";
			$jsonData = json_encode($main_decode);
			file_put_contents('main.json', $jsonData);
			echo $expected_exp;
		}
		

?>