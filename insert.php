

<?php
//pagination for display data from table


include_once("database_connect.php");
if(isset($_GET["val"]))
{
	 $string=$_GET["val"].'<br>';
	echo $string."<br>";
	$string_length=strlen($string);
	
	$find="=";
	
	$find_length=strlen($find);
	
	$offset_str1=0;
	
	$offset_str2=0;
	
	$offset_c=0;
	$now = DateTime::createFromFormat('U.u',microtime(true));
	  $trno=(string)$now->format("YmdHisu");
	$columns="(c39,";
	
	$values="('$trno',";
	
	 $table_name=substr($string,0,-($string_length-strpos($string,',')));
	 
	 $string_position2=strpos($string,';',$offset_str2);
	 
	 $offset_str2=$string_position2+$find_length;
	 
	while($string_position1=strpos($string,$find,$offset_str1)){
			
		$string_position2=strpos($string,';',$offset_str2);//; position
		
		//echo '"'.$find.'"' ." is found at ".$string_position1.'<br>';//
		
		$string_c=strpos($string,';c',$offset_c);
		
		//echo '";" is found at'.$string_position2.'<br>';//display ; position
		
		$id=substr($string,$string_c+2,-($string_length-$string_position1));
		
		//echo 'id :'.$id.'<br>';
		
		$value=substr($string,$string_position1+1,-($string_length-$string_position2));
		
		//echo 'value:'.$value.'<br>';
		$col="c".$id.",";
	$columns=$columns.$col;
	
	$values=$values.'"'.$value.'"'.',';
	
		$offset_c=$string_c+$find_length;
		
		$offset_str1=$string_position1+$find_length;	
		
		$offset_str2=$string_position2+$find_length;
	}
	
	//date and time creation
	 
	 $date_time=(string)$now->format("d/m/Y-H:i:s");
	$columns=$columns.'c16)';
	
	$values=$values.'"'.$date_time.'")';
		

	 
	echo $insert="insert into ".$table_name." ".$columns." values".$values.";";
	 mysqli_query($con,$insert);
	 echo "loading...";
}
?>

<meta http-equiv="refresh" content="50;url=index2.html">
