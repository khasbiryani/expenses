<!doctype html>
<html lang="en">
  <head>
  	<title>Last Records - AURORA</title>
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
		  		<a href="#" class="img logo rounded-circle mb-5 logo_lit" style="background-image: url(images/logo.png); "></a>
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
                 <li class="nav-item ">
                    <a class="nav-link" href="expenses_attributes.php">CATEGORY</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="weekly_data.php">Weekly</a>
                </li>
             
               
               
              </ul>
            </div>
          </div>
        </nav>
	
           <div class="container col-sm-5 col-md-10 col-lg-12 mt-5 " style='overflow:scrolling'>
		   
    <div class="card card_box"  style='background-color:#fcfcfc' id='result_box'>
<h3 style='text-align:center;'><b>Your Timely Expenses</b></h3>
		
	<?php
	
	$update_only_str=file_get_contents('main.json');
	$main_decode=json_decode($update_only_str,true);
	foreach(array_reverse($main_decode['inserted-data']) as $dates=>$data)
	{
		echo "<details style='margin:10px'>";
		echo "<summary 'b>$dates</b></summary>";
		echo "<table class='table table-hover'>";
		foreach($data as $cat=>$val)
		{
			echo "<tr><td class='table-active'>$cat</td><td>$$val</td></tr>";
		}
		echo "</table></details>";
	}
	
	
	?>
	
		
	<button class='btn btn-primary' onClick='print()' style='width:75px;'>Print</button>	
	</div>
	
	</div>
	  
	  </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
	  <script src="js/print.js"></script>
  </body>
  <script>
  var d = new Date();
  var today=d.getDay();
  
 function week_display(){
	 
	 
	 
 }
  </script>
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
a{
	color:black;
	
}
.show_hide{
	visibility:visible;

	
}
.hide_show{
	visibility:hidden;
	

}
</style>
</html>