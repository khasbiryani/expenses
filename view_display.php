

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/style2.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<script src="js/script_for_index.js" type="text/javascript">
</script>
<?php
//error_reporting(0);
//echo "ur in search_fields";
echo $text=$_REQUEST['text'];
$table=$_REQUEST['table'];

$status="";
$link="";
$val='';
//reading property file
include_once("property_read.php");

include_once("database_connect.php");
$query="select * from $table where 1=1".$text;
//echo $query;

echo "<div class='overlay_form'>";
echo "<h2>You are Viewing ".$property_decode[$table]["name"]."</h2>";
echo "<form id='update_form'><table class='table table-hover'>";
if($result=mysqli_query($con,$query))
	{
		if(($rows=mysqli_num_rows($result))>0)
		{
		
			while ($row = mysqli_fetch_assoc($result)) 
			{
				$count=0;
				$unique='';
				foreach($row as $key=>$field) 
				{
					if($count==0)
					{
						$link=$field;
						$unique=$key;
					}
					
						
					echo "<tr><td><label>".$property_decode[$key]."</label></td>";
					echo "<td>$field</td></tr>";
					$count++;
		
				}
				//echo "<tr><td><input type='button' class='btn  btn-success' value='update changes' id='$link' title='$link'name='$table' onclick='update_data(this.name,this.title)'></td>";
				if($status!='4')
				{
					echo "<td><img src='images/cancel.png'  class='cancel_icon' id='$link'  value='40' title='$unique' name='$table'></td>";
					if($status!='2')
						echo "<td><img src='images/approved.png' class='approved_icon' id='$link'  value='30' name='$table' ></td>";
				}
							echo "</tr>";
							
    
			}
			echo '</table></form><marquee>note: Click on close icon to close overlay</marquee><hr>';
			
			
			
		}
		else
			echo "<b>Match Not Found</b>";
	}
	
?>