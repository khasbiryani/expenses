


<div id='shifts'>


</div>
<?php
date_default_timezone_set("America/Chicago");
$in=strtotime('30-12-2020 00:00:01') * 1000;
$out=strtotime('30-12-2020 23:59:59') * 1000;
$url="https://www.clover.com/v3/merchants/1N466HW7NKYH1/items";
$post_data = NULL;
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer 098894a4-d273-b687-5bb4-a7844c477cee' 
        )                                                                       
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if($post_data != NULL){
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));
        }
        $data = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$p=json_decode($data,true);
		print_r($p);
		$newJsonString = json_encode($p);
file_put_contents('shifts.json', $newJsonString);
		$counter= count($p['elements']);
		$in_time=Array();
		$out_time=Array();
		for($i=0;$i<$counter;$i++)
		{
			$eid=$p["elements"][$i]['employee']['id'];
			$ename=$p["elements"][$i]['employee']['id'];
				if(array_key_exists('overrideInTime',$p["elements"][$i]))
				{
					$in_time[$ename]=$p["elements"][$i]['overrideInTime'];
					
				}
				 else 
					$in_time[$ename]=$p["elements"][$i]['inTime'];
				
				if(array_key_exists('overrideOutTime',$p["elements"][$i]))
					$out_time[$ename]=$p["elements"][$i]['overrideOutTime'];
				else
					$out_time[$ename]=$p["elements"][$i]['outTime'];
			
		}
		print_r($in_time);
		
		foreach($in_time as $name=>$value)
		{
			$start=date("d-m-Y,H:i:s",substr($value,0,10));
			$end=date("d-m-Y,H:i:s",substr($out_time[$name],0,10));
			echo "$name inTIme: $start   OutTime: $end  elapsed time:";
			$first=new DateTime($start);
			$second=new DateTime($end);
	$interval = $first->diff($second);
	echo $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		
$hours=$interval->format('%h');
$minutes=round(($interval->format('%i'))/60,4);
$seconds=round(($interval->format('%s'))/3600,4);
$hours=$hours+$minutes+$seconds;
echo "   Hours worked: $hours ";
			echo "<br>";
			
		}
		
		
		$url="https://www.clover.com/v3/merchants/1N466HW7NKYH1/employees/WB7RBMZ2SEZ90/shifts";
$post_data = NULL;
  $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer 098894a4-d273-b687-5bb4-a7844c477cee' 
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
		
?>