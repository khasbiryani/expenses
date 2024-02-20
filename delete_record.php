<?php


	$id=$_REQUEST['id'];

		$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
	unset($main_decode['users']["$id"]);
	unset($main_decode['schedule']["$id"]);
	$jsonData = json_encode($main_decode);
			file_put_contents('main.json', $jsonData);
			echo "1";
	
	



?>