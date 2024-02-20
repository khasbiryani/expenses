<?php
ini_set('max_execution_time', 900);


require_once "docs/Classes/PHPExcel.php";
require_once("property_read.php");
require_once("database_connect.php");
//require_once("code_insert.php");
$dir='./docs/';
$files_in_dir=scandir($dir);
$year='';
$file_name='';

echo "<br><b style='text-color:red;'>Loading, Please wait!</b>";
foreach($files_in_dir as $file)
{
	$file_details=pathinfo($file);
//print_r($file_details);
	if($file_details["extension"]=='csv')
	{
		$file_name=$file_details['basename'];
		//$year=$year_code[$file_details['filename']];
	}
	else
		continue;


		//echo "$file_name<br>";
		$tmpfname = "docs/$file_name";
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
			  
			  $objPHPExcel = new PHPExcel();

		 // Set the active Excel worksheet to sheet 0 

		$objPHPExcel->setActiveSheetIndex(0); 
		///////////////////////////////////
		
	
		
		
		$branch=$property_decode["branch"];
		$skip=0;
		//////////////////////
		$data_array=array();
		echo "{";
		$arr=['C','D','E','F','G','H','I','J','K','L','M','N','O','P'];
		for ($row = 1; $row <= $lastRow; $row++) 
		{
			
		/*	$c=$worksheet->getCell('C'.$row)->getValue();
			$d=$worksheet->getCell('D'.$row)->getValue();
			$e=$worksheet->getCell('E'.$row)->getValue();
			$f=$worksheet->getCell('F'.$row)->getValue();
			$g=$worksheet->getCell('G'.$row)->getValue();
			$h=$worksheet->getCell('H'.$row)->getValue();
			$i=$worksheet->getCell('I'.$row)->getValue();
			$j=$worksheet->getCell('J'.$row)->getValue();
			$k=$worksheet->getCell('K'.$row)->getValue();
			$l=$worksheet->getCell('L'.$row)->getValue();
			$m=$worksheet->getCell('M'.$row)->getValue();
			$n=$worksheet->getCell('N'.$row)->getValue();
			$o=$worksheet->getCell('O'.$row)->getValue();
			$p=$worksheet->getCell('P'.$row)->getValue();*/
			$str="";
			$count=0;
			foreach($arr as $a)
			{
				$val=$worksheet->getCell($a.$row)->getValue();
				if($val=="Yes")
					$str=$str.'1,';
				if($val=="No")
				{
					$str=$str.'0,';
					$count++;
				}
			}
			
			$str=substr($str,0,-1);
			if($count==14)
			{
				$skip++;
				continue;
			}
			echo "{ $str},<br>";
		
			//echo "$i,$j,$k},<br>";
			
		}	
		echo "}";
		echo "$skip";

}

//echo '<meta http-equiv="refresh" content="0;url=insert_sales.php">';		
		


?>
