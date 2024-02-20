
	
	<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="icon" type="image/png" href="images/vjitlogo.png"/>
	<title>VJIT FEEDBACK</title>
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>	
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style2.css">
<script type='text/javascript' src='js/no_back.js'>

</script>
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<div class="manage_database_div" align='center'>
	<form method='POST' action='execute_query.php'>
	
	<input type='text' name='query' style='width:800px' placeholder='Enter Query Here' class='form-control'>
	<br><INPUT type='submit' class='btn btn-success'>&nbsp <a href='faculty-aut.php'><INPUT type='button' class='btn btn-default' value='Home'></a>
	</form>
	
	</div>
	
	<div id='result_box'>
	
	</div>
	
	
	<?php
	
	if(isset($_POST["query"]))
	{
		$query=$_POST['query'];
		echo "<div class='manage_database_div' align='center'><table class='table'>";
		
		if($result=mysqli_query($con,$query))
		{
		
					
					while($row = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>";
						foreach($row as $key=>$value)
							echo "<td><b>".$key."</b></td>";
							echo "</tr>";
							break;
					}
				
		}
		if($result=mysqli_query($con,$query))
		{
			if(($rows=mysqli_num_rows($result))>0)
				{
					
					while ($row = mysqli_fetch_row($result)) 
					{
						echo "<tr>";
						foreach($row as $key=>$value)
							echo "<td>$value</td>";
						echo "</tr>";
					}
				}
				
		}
		else
			echo "Error:".mysql_error();
		echo "</table></div>";
		
		

	?>
	