<script>
if(screen.width<=770)
{
	document.getElementById('window_overlay').style.display="none";
	document.getElementById('phone_overlay').style.display="block";
}
else
{
document.getElementById('window_overlay').style.display="block";
	document.getElementById('phone_overlay').style.display="none";
}
</script>

<style>
td{
	text-align:center;
}
</style>
<?php
//error_reporting(0);
//echo "ur in search_fields";
 $text=$_REQUEST['text'];
  $forw=$text;
 $table=$_REQUEST['table'];
 $tab=$table;
 if(strpos($tab,'_')!=0)
	$tab=substr($table,0,strpos($table,'_'));
		
$link="";
//reading property file
include_once("property_read.php");
$cols=$property_decode[$tab]["60"];
$star='*';
if($table=="t101")
	$star=$property_decode['t101']['30'];
include_once("database_connect.php");
echo $query="select $star from $table where 1=1".$text;
//echo $query;

echo "<div class='overlay_form' id='window_overlay' style='display:none;'>";
echo "<h2>You are Updating ".$property_decode[$tab]["name"]."</h2>";
echo "<form id='update_form'><table class='table table-hover'>";
if($result=mysqli_query($con,$query))
	{
		if(($rows=mysqli_num_rows($result))>0)
		{
		
			while ($row = mysqli_fetch_assoc($result)) {
				$count=0;
				foreach($row as $key=>$field) {
					if($count==0)
					{
						$key1=$key;
						$count++;
						$link=$field;
						$text=" and $key1='$link'";
					}
						if(in_array($key,$property_decode[$tab]['20']))
						{
							if($key=='c12')
							{
								echo "<tr><td><label>".$property_decode[$key]."</label></td>";
								echo "<td><select name='$key' class='form-control'><option value='$field'>".$property_decode['position'][$field]."</option>";
								foreach($property_decode['position'] as $pos=>$pos_name)
								{
									echo "<option value='$pos_name'>$pos_name</option>";
								}
								echo "</select></td></tr>";
							}
							else if($key=='c13')
							{
								echo "<tr><td><label>".$property_decode[$key]."</label></td>";
												echo "<td><select name='$key' class='form-control'><option value='$field'>".$field."</option>";
									$query1="select * from t102";
							   
								$branches = mysqli_query($con, $query1);
									if (mysqli_num_rows($branches) > 0) {
								// output data of each row
								while($rows = mysqli_fetch_assoc($branches)) {
								echo "<option value='".$rows["c13"]."'>".$rows["c14"]."</option>";
								}
								}
								echo "</select></td></tr>";
							}
							else{
							echo "<tr><td><label>".$property_decode[$key]."</label></td>";
							echo "<td><input type='text' value='$field'  class='form-control' name='$key'></td></tr>";
							}
							continue;
							
						}
						
					echo "<tr><td><label>".$property_decode[$key]."</label></td>";
					echo "<td><input type='text' value='$field' class='form-control' readonly name='$key'></td></tr>";
		
				}
				//echo "text=$text";
				echo "<tr><td><input type='button' class='btn  btn-success' value='update changes' id='$link' title='$key1' name='$table' onclick='update_data(this.name,this.title,this.id)'></td>
							<td><input type='button' class='btn btn-warning' value='cancel'></td>
							</tr>";
    
			}
			echo '</table></form><marquee>note: Click on close icon to close overlay</marquee></div>';
			
		}
		else
			echo "<b>Match Not Found</b>";
	}
	
	//phone overlay
	
	echo "<div class='overlay_form' id='phone_overlay' style='display:block;'>";
echo "<h2>You are Updating ".$property_decode[$tab]["name"]."</h2>";
echo "<form id='update_form1'><table class='table table-hover'>";
if($result=mysqli_query($con,$query))
	{
		if(($rows=mysqli_num_rows($result))>0)
		{
		
			while ($row = mysqli_fetch_assoc($result)) {
				$count=0;
				foreach($row as $key=>$field) {
					if($count==0)
					{
						$key1=$key;
						$count++;
						$link=$field;
						$text=" and $key1='$link'";
					}
						if(in_array($key,$property_decode[$tab]['20']))
						{
							if($key=='c12')
							{
								echo "<tr><td><label>".$property_decode[$key]."</label></td></tr>";
								echo "<tr><td class='text-center'><select name='$key' class='form-control'><option value='$field'>".$property_decode['position'][$field]."</option>";
								foreach($property_decode['position'] as $pos=>$pos_name)
								{
									echo "<option value='$pos'>$pos_name</option>";
								}
								echo "</select></td></tr>";
							}
							else if($key=='c13')
							{
								echo "<tr><td><label>".$property_decode[$key]."</label></td></tr>";
												echo "<tr><td><select name='$key' class='form-control'><option value='$field'>".$field."</option>";
									$query1="select * from t102";
							   
								$branches = mysqli_query($con, $query1);
									if (mysqli_num_rows($branches) > 0) {
								// output data of each row
								while($rows = mysqli_fetch_assoc($branches)) {
								echo "<option value='".$rows["c13"]."'>".$rows["c14"]."</option>";
								}
								}
								echo "</select></td></tr>";
							}
							else{
							echo "<tr><td><label>".$property_decode[$key]."</label></td></tr>";
							echo "<tr><td  class='text-center'><input type='text' value='$field'  class='form-control' name='$key'></td></tr>";
							}
							continue;
							
						}
						
					echo "<tr><td><label>".$property_decode[$key]."</label></td></tr>";
					echo "<tr><td  class='text-center'><input type='text' value='$field' class='form-control' readonly name='$key'></td></tr>";
		
				}
				//echo "text=$text";
				echo "<tr><td><input type='button' class='btn  btn-success' value='update changes' id='$link' title='$key1' name='$table' onclick='update_data(this.name,this.title,this.id)'></td></tr>
							<tr><td  class='text-center'><input type='button' class='btn btn-warning' value='cancel'></td>
							</tr>";
    
			}
			echo '</table></form><marquee>note: Click on close icon to close overlay</marquee></div>';
			die();
		}
		else
			echo "<b>Match Not Found</b>";
	}
?>