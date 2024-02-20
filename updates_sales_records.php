<?php
ini_set('max_execution_time', 900);


require_once "docs/Classes/PHPExcel.php";
require_once("property_read.php");
require_once("database_connect.php");
//require_once("code_insert.php");
$dir='./docs/sales/';
$files_in_dir=scandir($dir);
$year='';
$file_name='';
$extentions_array= ['CSV', 'csv', 'xls','xlsx'];
echo "<br><b style='text-color:red;'>Loading, Please wait!</b>";
foreach($files_in_dir as $file)
{
	$file_details=pathinfo($file);
	//print_r($file_details);
	if(in_array($file_details["extension"],$extentions_array))
	{
		$file_name=$file_details['basename'];
		//$year=$year_code[$file_details['filename']];
	}
	else
		continue;


		//echo "$file_name<br>";
		$tmpfname = "docs/sales/$file_name";
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
			  
			  $objPHPExcel = new PHPExcel();

		 // Set the active Excel worksheet to sheet 0 

		$objPHPExcel->setActiveSheetIndex(0); 
		///////////////////////////////////
		
	$brands = ['ASSOC BANK MERCH','DoorDash', 'GRUBHUB','STRIPE', 'PORT OF PERI', 'UBER','EZCATER','RAMADAN'  ];
		
		$time="";
		$branch=$property_decode["branch"];
		//////////////////////
		$data_array=array();
		for ($row = 2; $row <= $lastRow; $row++) 
		{
			if($time==""){
				 $time= $worksheet->getCell('B'.$row)->getValue();
			}
			//echo "<br> ".$worksheet->getCell('C'.$row)->getValue();

			if($worksheet->getCell('A'.$row)->getValue()=='CREDIT')
			{
				 $sale_type = explode(':',explode("  ",$worksheet->getCell('C'.$row)->getValue())[0])[1];
				foreach ($brands as $sale){
						
					if(stripos($sale_type,$sale)!==false){
						if (array_key_exists($sale,$data_array)){
							$data_array[$sale]+=$worksheet->getCell('D'.$row)->getValue();
						}
						else{
							$data_array[$sale]=$worksheet->getCell('D'.$row)->getValue();

						}
						
						//echo $sale_type.'<br>';
					}
				}
			}
		
			
			// $data_array[$worksheet->getCell('A'.$row)->getValue()]["B"]=$worksheet->getCell('B'.$row)->getValue();
			// $data_array[$worksheet->getCell('A'.$row)->getValue()]["C"]=$worksheet->getCell('C'.$row)->getValue();
			// $data_array[$worksheet->getCell('A'.$row)->getValue()]["D"]=$worksheet->getCell('D'.$row)->getValue();
			
		}
		print_r($data_array);

		foreach ($data_array as $sales_type=>$amount){
			$date=date("Y-m-d",strtotime($time));
			 $today=date("Y-m-d");
			 $type=$sales_type;
			switch($type){
				case "ASSOC BANK MERCH":
					$type = 'CARD';
					break;
				case "STRIPE":
					$type = 'PhoneApp';
					break;
				case "PORT OF PERI":
					$type = 'CHOWNOW';
					break;
				case "RAMADAN":
					$type = 'RAMADAN ICN CATERING';
					break;


			}
			echo $query="insert into t107 (c23,c33,c36,c13,c25) values('$date','$type',".round($amount).",'$branch','$today');";
			mysqli_query($con,$query);
		}
			// $data=$worksheet->getCell('A'.'2')->getValue();
			// $date=explode("-",$data);
			// $month_day=explode(",",$date[0]);
			// $year=explode(" ",$month_day[1]);
			// $month_day=explode(" ",$month_day[0]);
			// $year=$year[1];
			// //print_r($year);
			// $day='';
			// if($month_day[1]<10)
			// 	$day='0'.$month_day[1];
			// else
			// 	$day=$month_day[1];
			// $time=$year.'-'.$month_day[0].'-'.$day;
			
			 
			//  $flag=0;
			//  foreach($property_decode["sales_type"] as $ty){
			//  $c33=$ty;
			//  if($flag==0)
			//  $c36=$data_array[$ty]["B"];
			// else if($flag==1)
			// 	$c36=$data_array[$ty]["D"];
			
			// if($ty=="Amount Collected")
			// 	$flag=1;
			//  $c36=str_replace("$","",$c36);
			//  $c36=str_replace(",","",$c36);
			 
			//  $query="select c36 from t107 where c23='$date' and c33='$c33' and c13='$branch';";
			// $result = mysqli_query($con, $query);
			// 	$branch_name="";
			// 	if (mysqli_num_rows($result) > 0) {
			// 	// output data of each row
			// 	while($row = mysqli_fetch_assoc($result)) {
			// 		$val+=$row['c30'];
			// 	$q="update t107 set c36='$c36' where c23='$date' and c33='$c33' and c13='$branch';";
			// 	//mysqli_query($con,$q);
			// 	}
			// 	}else{
		
			// $query="insert into t107 (c23,c33,c36,c13,c25) values('$date','$c33','$c36','$branch','$today');";
			// //mysqli_query($con,$query);
			// 	}
				
				//Inserting takes and fees
				
			//$name=$worksheet->getCell('B'.$row)->getValue()."<br>";
			
			//echo "id=$id,name=$name,dob=$dob,year=$year,subject=$subject<br>";
				$now = DateTime::createFromFormat('U.u',microtime(true));
	  $time=(string)$now->format("Y-m-d/H:i:s");
			 //$insert="insert into t101(c1,c2,c5,c23,c25) values(";
			//$insert=$insert.'"'.$id.'","","'.$name.'","'.$time.'","'.$year.'")';
			//echo $insert."<br>";
			
			/*echo $insert;
			if(mysqli_query($con,$insert))
			{
			echo  $insert."<br>";
			}
			else
				echo "Error description: " . mysqli_error();
			
		}
*/
// }
//unlink($tmpfname);


}

echo '<meta http-equiv="refresh" content="0;url=insert_sales.php">';		
		


?>
