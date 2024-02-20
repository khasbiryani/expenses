<?php
ini_set('max_execution_time', 900);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "docs/Classes/PHPExcel.php";
require_once("property_read.php");
require_once("database_connect.php");
//require_once("code_insert.php");
$dir='./docs/payroll/';
$files_in_dir=scandir($dir);
$year='';
$file_name='';

echo "<br><b style='text-color:red;'>Loading, Please wait!</b>";
foreach($files_in_dir as $file)
{
	$file_details=pathinfo($file);
//print_r($file_details);
	if($file_details["extension"]=='csv' || $file_details["extension"]=='xlsx' )
	{
		$file_name=$file_details['basename'];
		//$year=$year_code[$file_details['filename']];
	}
	else
		continue;


		//echo "$file_name<br>";
		$tmpfname = "docs/payroll/$file_name";
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
			  
			  $objPHPExcel = new PHPExcel();

		 // Set the active Excel worksheet to sheet 0 

		$objPHPExcel->setActiveSheetIndex(0); 
		///////////////////////////////////
		
	
		$flag=0;
		 $today=date("Y-m-d");
		$branch=$property_decode["branch"];
		//////////////////////
		$data_array=array();
		for ($row = 3; $row <= $lastRow; $row++) 
		{
			if($worksheet->getCell('A'.$row)->getValue()=="")
				break;
	
			
			$name=$worksheet->getCell('B'.$row)->getValue();
			$date=$worksheet->getCell('D'.$row)->getValue();
			$work_date=date("Y-m-d",strtotime($date));
			$hours_worked=$worksheet->getCell('H'.$row)->getValue();
			//echo "$work_date <br>";
			$pay=0;
			$query="select c5 from t101 where c2='$name' and c13='$branch'";
			$result = mysqli_query($con, $query);
				
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($rows = mysqli_fetch_assoc($result)) {
					$pay=$rows['c5'];
					
				}
				
				
				}
				$c30=$hours_worked*$pay;
			
				
				$query="insert into t114 (c1,c30,c31,c32,c23, c13, c17,c5) values('$name','$c30','$work_date','$work_date','$today','$branch','$hours_worked','$pay');";
		if(mysqli_query($con,$query))
			 {
				//  echo "Record Inserted";
			 
				}
			
		}
			
unlink($tmpfname);


}
echo '<meta http-equiv="refresh" content="0;url=payroll_insert.php">';		
		


?>
