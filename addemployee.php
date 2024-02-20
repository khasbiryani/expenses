<?php
ob_start();
session_start();
//error_reporting(0);
require_once("database_connect.php");
require_once("property_read.php");
if($_SESSION["position"]=="ADMIN"){
require_once('property_read.php');

}	
else
{
echo "<div align='center'><h2 class='fs-title'>Please Log In    <meta http-equiv='refresh' content='2; url=index.php'></h2></div>";
exit();
}
error_reporting(0);
require_once("property_read.php");
				require_once("database_connect.php");
				$branch=$property_decode["branch"];
				$query="select c14 from t102 where c13='$branch'";
				
				$result = mysqli_query($con, $query);
				$branch_name="";
				if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				$branch_name=$row["c14"];
				}
				}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>ADD EMPLOYEE - <?php echo $branch_name;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>	
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href='images/fav-icon.ico'>
		
		
		<script>
		
		
		function changeBranch(id)
		{
			
			if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.open("POST","update_branch.php?id="+id,true);
			obj.send();
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4 && obj.status==200)
				{
					
					location.reload();
				
			}
			}
		}
		</script>
  </head>
  
  
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5 logo_lit" style="background-image: url(images/logo.png);"></a>
				
				
				
	        <ul class="list-unstyled components mb-5">
			
			<li class="active">
			   <?php
				
		
				echo " <a href='#branchChoose' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><h4 style='text-align:center;color:white;font-family:georgia;font-weight:bold'>".$branch_name."</h4></a>";
				
				?>
            
              <ul class="collapse list-unstyled" id="branchChoose">
               <?php
			   $query="select * from t102";
			   
				$branches = mysqli_query($con, $query);

				if (mysqli_num_rows($branches) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($branches)) {
				echo "	<li>
                    <a href='#' id='".$row["c13"]."' title='".$row["c13"]."' onClick='changeBranch(this.id)'>".$row["c14"]."</a>
                </li>";
					
				}
				}
			   ?>
			  </ul>
	          </li>
	         <li>
	              <a href="schedule.php">Schedule</a>
	          </li>
			  
			  
			  
			   
			  
			  
			  
	          <li class="active">
             <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="employees.php">Display</a>
                </li>
               
                <li>
                    <a href="addemployee.php">add</a>
                </li>
				
              </ul>
	          </li>
	          <li >
              <a href="monthlyexp.php">Monthly Expenses (CALENDER)</a>
	          </li>
	         <li>
             <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
              <ul class="collapse list-unstyled" id="reportsSubmenu">
                
              <li>
                    <a href="month_based.php">Monthly</a>
                </li>
              </ul>
	          </li>
			    <li>
                    <a href="logout.php">Logout</a>
                </li>
	        </ul>

	        <div class="footer">
	        
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item add">
                   <a href='employees.php'> <img src='images/edit.png' height='50px' width='50px;' ></a>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>
	<div class="add">
	
	</div>
		<div class="edit">
	
	</div>
		<div class="delete">
	
	</div>
	
	
	
           <div class="container col-sm-5 col-md-12 col-lg-12 mt-5 ">
		   
    <div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;'>
	<form action="addemployee.php" method='POST'>
		
	<?php
	 $query="select * from t101;"; 
	 
		$result = mysqli_query($con, $query);
			
				$result = mysqli_query($con, $query);
				while($key = $result -> fetch_field()-> name){
				if($key=="c1"){
					continue;
				}
				else if($key=="c12")
				{
					echo '<div class="form-group">';
			echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
				
					echo "<td><select name='$key' id='$key' class='form-control'>";
					
					foreach($property_decode['position'] as $pos=>$pos_name)
					{
						echo "<option value='$pos'>$pos_name</option>";
					}
					echo "</select></div>";
				}
				else if($key=="c13")
				{
					echo '<div class="form-group">';
					echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
					
					
					$query1="select * from t102";
			   
				$branches = mysqli_query($con, $query1);
					if (mysqli_num_rows($branches) > 0) {
				// output data of each row
				echo "<select name='$key' id='$key' class='form-control'>";
				while($rows = mysqli_fetch_assoc($branches)) {
				echo "<option value='".$rows["c13"]."'>".$rows["c14"]."</option>";
				}
				echo "</select></div>";
				}
					
				}
				else
				{
					
					echo '<div class="form-group">';
			echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
					echo "
				
				
				
				
				 <input type='text' class='form-control' title='$key' id='$key' name='$key' placeholder='Enter ".$property_decode[trim($key)]."' id='$key'></div>";
				}
			}
		


		?>
		
			
			
			
			<input type="submit" class="btn btn-success" value="Submit"> &nbsp &nbsp <a href='employees.php'><input type='button'value='Cancel' class="btn btn-warning"></a>

	
		</form>
		
		<?php
 
  if(isset($_POST['c2']))
{
	$name=$_POST['c2'];
	
	//$data=array();
	$query="insert into t101 (".$property_decode["t101"]["60"].") values (";
	$values='';
	foreach($_POST as $key=> $value){
		$values= $values."'".$value."',";
	}
	$values=substr($values,0,-1);
	$query=$query.$values.");";
	
	if( mysqli_query($con,$query))
	{
echo "<div class='alert alert-success' id='alert_box' role='alert'>
 Employee added successfully!!
</div>";

$id='';
$query="select c1 from t101 where c2='$name' and c13='$branch'";
$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				foreach($row as $key=>$value)
				{
					if($key=='c1')
					{
						$id=$value;
					}
			 
				}
				}
	}
	
	$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
		foreach($main_decode["w-days"] as $key=>$days)
		{
			//echo "<tr><td style='color:#f6932f;' class='h6 days'>$days</td>";
			$query="insert into t103 (c15,c13,c1,c16, c17,c18) values('$days','$branch','$id','OFF','0','0')";
			 if(mysqli_query($con,$query))
			 {
				 
			 }
		}
		
	}
	else 
		echo "failed to insert";

	
}
 ?>
	</div>
	</div>
	  
	  </div>
		</div>




    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  <style>

body{

	background-color:#808080;
}
.card_box{
	padding:25px;
	  box-shadow: 0 10px 8px 0 rgba(0, 0, 0, 0.3), 0 10px 20px 0 rgba(0, 0, 0, 0.5);
	
}
.add{
	
	margin-left:15px;
}
.add:hover{
	opacity:0.5;
	cursor:pointer;
	
}
.logo_lit{
	
	box-shadow: 0 5px 8px 5px rgba(230, 230, 230, 5), 2px 2px 20px 5px rgba(230, 230, 230, 5);
	
}
.logo_lit:hover{
	
	box-shadow: 0 5px 8px 5px rgba(230, 230, 230, 8), 2px 2px 30px 5px rgba(230, 230, 230, 8);
	
}
</style>
</html>