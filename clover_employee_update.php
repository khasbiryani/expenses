<?php
require_once("database_connect.php");
require_once("property_read.php");
$branch=$property_decode["branch"];
$url="https://www.clover.com/v3/merchants/".$property_decode["clover"][$branch]["merchId"]."/employees";
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
print_r($p);
		
		$counter= count($p['elements']);
		$in_time=Array();
		$out_time=Array();
		for($i=0;$i<$counter;$i++)
		{
			$id=$p["elements"][$i]['id'];
			
			$name=$p["elements"][$i]['nickname'];
			if($name=="")
				$name=$p["elements"][$i]['name'];
			$pin= $p["elements"][$i]['pin'];
			$role=$p["elements"][$i]['role'];
			$email=$p["elements"][$i]['email'];
			$query="select c2 from t101 where c1='$id'";
			if ($role=='ADMIN'){
				continue;
			}
			
			$result=mysqli_query($con,$query);
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				echo $query="update t101 set c2='$name',c9='$pin',c12='$role',c3='$email',c13='$branch' where c1='$id'";
				mysqli_query($con,$query);
			}
			else
			{
			echo $query="insert into t101 (c1,c2,c9,c12,c3,c13,c7) values('$id','$name','$pin','$role','$email','$branch','0');";
			mysqli_query($con,$query);
			}
		}

?>