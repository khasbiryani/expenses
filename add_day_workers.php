<!doctype html>
<html lang="en">
  <head>
  	<title>ADD Worker - AURORA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href='images/fav-icon.ico'>
  </head>
  
  
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5 logo_lit" style="background-image: url(images/logo.png);"></a>
				<h4 style='text-align:center;color:white;font-family:georgia;font-weight:bold'>AURORA</h4>
	        <ul class="list-unstyled components mb-5">
	         <li>
	              <a href="schedule.php">Schedule</a>
	          </li>
	          <li>
             <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="employees.php">Display</a>
                </li>
                <li>
                    <a href="editemployee.php">Update</a>
                </li>
                <li>
                    <a href="addemployee.php">add</a>
                </li>
				  <li>
                    <a href="deleteemployee.php">delete</a>
                </li>
              </ul>
	          </li>
	          <li class="active">
              <a href="monthlyexp.php">Monthly Expenses (CALENDER)</a>
	          </li>
	         <li>
             <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
              <ul class="collapse list-unstyled" id="reportsSubmenu">
                <li>
                    <a href="#">CATEGORY</a>
                </li>
              <li>
                    <a href="month_based.php">Monthly</a>
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
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
               
               
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
	
	
	
           <div class="container col-sm-5 col-md-10 col-lg-8 mt-5 ">
		   
    <div class="card card_box"  style='background-color:#fcfcfc'>
	<?php 
	$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
	$date=$_REQUEST['date'];
	echo '<form action="add_day_workers.php" method="POST">';?>
		<table class='table table-hover' id='users-table'>
	<?php
	 error_reporting(0);
		echo "<thead thead class='thead-dark'><tr>";
	echo "<td>select worker</td><td>hours</td>";
	echo "</tr></thead><tr><td><select class='form-control' name='user'>";

foreach($main_decode["users"] as $name=>$rest)
		echo "<option  value='$name' >$name</option>";
		
		echo "</select></td><td><input type='text' placeholder='Enter hours' class='form-control' name='hours'></td>";
echo "<input type='hidden' name='date' value='$date' />";
		?>
		</tr>
			
			
			
			<tr><td><input type="submit" class="btn btn-success" value="Submit"></td><td><?php echo "<a href='day_details.php?date=$date'><input type='button'value='Cancel' class='btn btn-warning'></a>";?></td>
	</tr>
		</table>
		</form>
		
		<?php
 
  if(isset($_POST['user']))
{
	$user=$_POST['user'];
	$hours=$_POST['hours'];
	 $date=$_POST['date'];
	$day_l= date('D', strtotime($date));
	//$hours_str=$main_decode["schedule"]["$name"]["$day_l"];
	$hours_array=explode("-",$hours);
								$hours_min_start=explode(":",$hours_array[0]);
								$hours_min_end=explode(":",$hours_array[1]);
								
								if($hours_min_start[0]<10)
								{
									$hours_min_start[0]+=12;
								}
								$hours_min_end[0]+=12;
								$hours=$hours_min_end[0]-$hours_min_start[0];
								$minus=$hours_min_start[1]/60;
								$plus=$hours_min_end[1]/60;
								$hours=$hours-$minus+$plus;
								
								$pay_cal=$main_decode['users']["$name"]['pay']*$hours;
							$payroll_info[$user]['hours']="$hours";
								$payroll_info[$user]['pay']="$pay_cal";
	
	$main_decode['daily-expenses']["$date"]["Payroll_details"][$user]['hours']="$hours";
	
	$main_decode['daily-expenses']["$date"]["Payroll_details"][$user]['pay']="$pay_cal";
		//$main_decode['daily-expenses']["$date"]["actual"]["Payroll_details"]["$user"]["pay"]="$pay_cal";

	//print_r($main_decode['daily-expenses']["$date"]["Payroll_details"]);
	$pay_total=0;
	foreach($main_decode["daily-expenses"][$date]["Payroll_details"] as $name=>$details){
		$pay_total+=$details["pay"];
		
	}
	
	
	$main_decode['daily-expenses']["$date"]["actual"]["Payroll"]="$pay_total";
	unset($main_decode["daily-expenses"][$date]["actual"]["Total"]);
	$total=0;
	foreach($main_decode["daily-expenses"][$date]["actual"] as $id=>$val){
		
		$total+=trim($val);
	}
	$main_decode["daily-expenses"][$date]["actual"]["Total"]="$total";
	
	//	print_r($main_decode['daily-expenses']["$date"]);			
	
$jsonData = json_encode($main_decode);
file_put_contents('main.json', $jsonData);
echo "<div class='alert alert-success' id='alert_box' role='alert'>
 Category added successfully!!
</div>";

	
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