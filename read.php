<?php
ob_start();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/style2.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

<script type='text/javascript' src='js/check_size.js'>
</script>
<script src="js/script_for_index.js" type="text/javascript">
</script>
<script type="text/javascript" src='js/script_new.js'>

</script>

<script type="text/javascript" src="js/linkExp.js"></script>
<html>
<body>
<?php
//error_reporting(0);
session_start();
require_once("database_connect.php");
require_once("property_read.php");
//require_once("code.php");

	 

			 $table="t101";
			$tab=$table;
		
			//$table_array=$property_decode['cluster'];
		//	echo array_search($table,$table_array);
			//if(in_array($table,$table_array))
				//$table=$table."_".$property_decode['current_database']['value'];
$table_name=$table;
$pn="1";
$name=$_REQUEST["name"];
//$table="teacher_form";
include_once("database_connect.php");//data base connection
$link="";
$cols="";
$status="";
//reading property file
include_once("property_read.php");
$cols=$property_decode[$tab][$name];

//logging
	// $desc=":viewed  complete data of $table_name ,";
	// $query_log="(".$query.")";
//require_once('logging_sub_admin.php');
////
//for pagination




$read_all="select $cols from $table where 1=1";

$read_all_result= mysqli_query($con,$read_all);

$all_rows=mysqli_num_rows($read_all_result);
$min=($pn*10)-10;
//for printing limited records
$read="select $cols from $table limit ".$min.",".'10';
$results = mysqli_query($con,$read);
$rows=mysqli_num_rows($results);
		
	
$total_pages=ceil($all_rows/10);

//long search box one for all
	
		
		
		//search boxes
$col_arr=explode(",",$cols);
echo"<div class='container' style='padding:5px;margin:40px'><form id='search_form'>";
echo "<h4>Enter Text To Search.....</h4>";
for($i=0;$i<sizeof($col_arr);$i++)
	{
		$trimmed_col=trim($col_arr[$i]);//trimming  column
		
		echo " <div class='col-xs-2'>";
		echo '<b>'.$property_decode[$trimmed_col].'</b>';//for each array value is trimmed and then c is removed and then name is collected from array of names
		echo "<input type='text' class='form-control' placeholder='enter text..'  name='$table' id='$trimmed_col'></div>";
	}
echo"<div class='col-xs-2'><br><input type='button' class='btn btn-default ' name='$table' onclick='search_req_data(this.name)' value='search' ></div></form></div>$";

		
		
			//echo "<input type='text' placeholder='Search Here' class='form-control' onkeyup='search(this.value,this.name)' name='$table'>";
			
		
		
		
		
		
		//paginating	
		echo '<div class="paging"><ul class="nav navbar-nav navbar-right pagination pagination-sm" id="page_control" >';
			if($pn>1){
			echo "<li >
                        <a href='#' id='".($pn-1)."' name='$tab' onclick='getdata(this.name,this.id,this.title)' title='$name'><<</a>
			</li>";		}		
			
			$count_prev=0;
			$count_next=0;
				for($i=1;$i<$total_pages;$i++)
				{
					if($i>=($pn-3))
					{					
				if( $i<=($pn+3))
				{
				if($i==$pn)
					{
					echo "<li class='active'>
                        <a href='#' id='".$i."' name='$tab' onclick='getdata(this.name,this.id,this.title)' title='$name'>$i</a>
                    </li>";
						continue ;
					}
					else 
						echo "<li><a href='#' id='$i' name='$tab' onclick='getdata(this.name,this.id,this.title)' title='$name'>$i</a></li>";
				}
				else
					if($count_next<4)
					{
					echo "<li><div style='padding:1px'></div></li>";
					$count_next++;
					}
				}
				else
					if($count_prev<4)
					{
					echo "<li><div style='padding:1px'></div></li>";
					$count_prev++;
					}
				}
				echo "<li>
                        <a href='#' id='".($total_pages)."' name='$tab' onclick='getdata(this.name,this.id,this.title)' title='$name'>$total_pages</a>
                    </li>";
				if($pn<$total_pages)
				{
        echo "<li>
                        <a href='#' id='".($pn+1)."' name='$tab' onclick='getdata(this.name,this.id,this.title)' title='$name'>>></a>
                    </li>
				</ul>";}
			echo	"</div>";
			
			//pagination ends
			
			//printing records
			echo "<h3>".$property_decode[$tab]["name"]."</h3>";
			echo "<div align='right'><img src='images/add.png' class='approved_icon' value='10' name='$tab' ></div>";
echo '<table class="table table-hover">
	<tr>';
	$co=0;
while($name=(mysqli_fetch_field($results)->$name))
{
	if($name=="c10")
	{
		continue;
	}
	if($co==0)
	{
		$co++;
		

	}
		echo '<th>'.$property_decode[trim($name)].'</th>';//getting the names for the code from the array
		
}
		echo '</tr>';
while ($row = mysqli_fetch_assoc($results)) {
    echo '<tr>';
	$count=0;
    foreach($row as $key=>$field) {
		//echo $key;	
			
			if($count==0)
			{
				$key1=$key;
				$count++;
				$link=$field;
			
			
			}
			if(in_array($key,array("c25")))
			{
			 echo "<td  ><a href='#' name='$table' title='$key1' value='60' id='$link'>" . $year_from_code[$field] . "</a></td>";
			continue;
			}
		
        echo "<td  ><a href='#' name='$table' title='$key1' value='60' id='$link'>" . $field . "</a></td>";
		
    }
	if($status!='4'){
	echo "<td><input type='button' class='btn  btn-success' value='update' id='$link' title='$key1'name='$table'></td>";
	echo "<td><img src='images/cancel.png'  class='cancel_icon' id='$link' title='$key1' value='60'  name='$table'></td>";
	if($status!='2')
		echo "<td><img src='images/approved.png' class='approved_icon' id='$link' title='$key1' value='60' name='$table'></td>";
	}
	
    echo '</tr>';
}

echo '</table>';
			
			
			


?>


</body>
</html>

  
        <!-- jQuery Custom Scroller CDN -->
       