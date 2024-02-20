<?php
ob_start();
session_start();
error_reporting(0);
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
  	<title>Edit Schedule - <?php echo $branch_name;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href='images/fav-icon.ico'>
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>	
		<style>
.days{
	position: sticky;
  left:0 ;
  padding:0px;

  font-size:13px;
  margin:0px;
}
</style>
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
			  
			  
	           <li class='active'>
	              <a href="schedule.php">Schedule</a>
	          </li>
	          <li >
             <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="employees.php">Display</a>
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
			   <li >
             <a href="#manage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">MANAGE</a>
              <ul class="collapse list-unstyled" id="manage">
                <li>
                    <a href="branch.php">Branch</a>
                </li>
               
                <li>
                    <a href="inventory.php">Inventory</a>
                </li>
				<li>
                    <a href="settle_view.php">View Settle</a>
                </li>
				<li>
                    <a href="settle_admin.php">Settle Register</a>
                </li>
				
              </ul>
	          </li>
			  
                <li>
                    <a href="logout.php">Logout</a>
                </li>
              </ul>
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
			
			&nbsp 			&nbsp 			&nbsp <a href='schedule.php'> <button class='btn btn-success d-inline-block'>Save</button></a>
			
			
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item add">
                   
                </li>
                
               
              </ul>
            </div>
          </div>
        </nav>
	
           <div>
		   
    <div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;'>

		<table class='table table-hover' id='users-table'>
	<?php
	$emp_id_arr=Array();
	$query="select c1,c2 from t101 where c13='$branch' and c7='1'";
		echo "<thead thead class='thead-dark'><tr><th></th>";
	
		$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				foreach($row as $key=>$value)
				{
					if($key=='c1')
					{
						array_push($emp_id_arr,$value);
					}
			 else if($key=="c2")
				{
				echo "<th> ".$value."</th>";
				}
				
			}
				}
	}
				
	echo "</thead><tr>";
		
	$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
		foreach($main_decode["w-days"] as $key=>$days)
		{
				echo "<tr><td style='color:#f6932f;' class='h6 days'>$days</td>";
			foreach($emp_id_arr as $id){
				$query="select c16 from t103 where c15='$days' and c13='$branch' and c1='$id';";
		$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				foreach($row as $key=>$value)
				{
			
				echo "<td><div class='form-group col-lg-35'><input type='text' value='".$value."' id='".$days.'-'.$branch.'-'.$id."' onChange=schedule_update(this.id); class='form-control'></div> </td>";
				}
				}
	}
			
			}
			echo "</tr>";
		}

	?>
		</table>
	</div>
	</div>
	  
	  </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  
  <script>
  function schedule_update(id){
	  
	  var value=document.getElementById(id).value;
		 
		  if(window.XMLHttpRequest)
		{
			obj=new XMLHttpRequest();
		}
		else
		{
			obj=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj.open("POST","schedule_update.php?id="+id+"&value="+value,true);
		obj.send();
		obj.onreadystatechange=function()
		{
		if(obj.readyState==4 && obj.status==200)
		{
		
		
		//document.getElementById('users-table').innerHTML=obj.responseText;
			
		
			
		}
		}
	  
  }
  </script>
  <style>

body{

	background-color:#808080;
}
.card_box{
	padding:1px;
	
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

input[type=text], select, textarea {
  width:85px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}


</style>
</html>