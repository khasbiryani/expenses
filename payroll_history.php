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
//error_reporting(0);
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
  	<title>Monthly Report - <?php echo $branch_name;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href='images/fav-icon.ico'>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>	
		<script type='text/javascript'>
		function get_graph(data,id,text){
			//alert(id);
			
			var label=text;
			var $data=data;
			
			var $text=text;
			//alert($text);
			//array of colors for display
			var rgb=["rgba(220,53,69,1)","rgba(0,255,0,1)","rgb(0,0,160,1)","rgba(255,128,64,1)","rgba(128,255,255,1)",
			"rgba(225,255,0,1)","rgba(128,128,0,1)","rgba(64,0,64,1)","rgba(128,0,0,1)","rgba(255,53,69,1)",
			"rgba(128,0,255,1)","rgba(67,5,64,1)","rgba(12,5,64,1)","rgba(67,5,78,1)","rgba(100,5,64,1)","rgba(78,56,64,1)","rgba(6,5,64,1)","rgba(67,50,64,1)","rgba(128,5,18,1)","rgba(67,57,64,1)","rgba(66,5,64,1)","rgba(67,55,64,1)"];
			var rgb_back=["rgba(220,53,69,0.3)","rgba(0,255,0,0.5)","rgb(0,0,160,0.75)","rgba(255,128,64,0.75)","rgba(128,255,255,0.75)",
			"rgba(225,255,0,0.75)","rgba(128,128,0,0.75)","rgba(64,0,64,0.75)","rgba(128,0,0,0.75)","rgba(255,53,69,0.75)",
			"rgba(128,0,255,0.75)","rgba(67,5,64,0.75)","rgba(12,5,64,0.75)","rgba(67,5,78,0.75)","rgba(100,5,64,0.75)","rgba(78,56,64,0.75)","rgba(6,5,64,0.75)","rgba(67,50,64,0.75)","rgba(128,5,18,0.75)","rgba(67,57,64,1)","rgba(66,5,64,0.75)","rgba(67,55,64,0.75)"]
			
			//setting data set in form of array
			
				//label[i]=$text[i];
				//alert($data[i]);
				//alert(myChart.data.datasets[i].label);
					
					var datasets=[{
						label:$text,
						backgroundColor: rgb,
						borderColor: rgb,
						borderWidth: 2,
					   
					  
						  data:$data,
					}];
			
						//alert(dataset_array);
						
						
					var ctx = document.getElementById(id).getContext('2d');
					//alert($data);
			var myChart = new Chart(ctx, {
				  
				type: 'doughnut',
				data: {
					labels: label,
					type:'doughnut',
				   datasets: datasets
					
					
				},
				options : {
					responsive: true,
					maintainAspectRatio: false,
					legend: {
						  display: true,
						  labels: {
							fontSize: 15
						  }
						},
						tooltips:{
							titleFontSize:20,
							bodyFontSize:20
						}
				}
			}
			);



		}
		
		</script>
		
		
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
					
					window.refresh();
				
			}
			}
		}
		
		function expand(id){
	details=document.getElementsByTagName('details');
	expandall=document.getElementById(id);
	
	if(expandall.checked==false)
	{
	for (i=0;i<details.length;i++)
	{
		
		details[i].removeAttribute("open");;
	}
	}
	else{
		for (i=0;i<details.length;i++)
	{
		
		details[i].setAttribute("open","true");
	}
		
	}
}
		</script>
		
  </head>
  <body onload='sortPayroll()'>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5 logo_lit" style="background-image: url(images/logo.png); "></a>
			
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
                    <a href='' id='".$row["c13"]."' title='".$row["c13"]."' onClick='changeBranch(this.id)'>".$row["c14"]."</a>
                </li>";
					
				}
				}
			   ?>
			  </ul>
	          </li>
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
                    <a href="addemployee.php">add</a>
                </li>
				 
              </ul>
	          </li>
	          <li >
              <a href="monthlyexp.php">Monthly Expenses</a>
	          </li>
	         <li class="active">
             <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >Reports</a>
              <ul class="collapse list-unstyled" id="reportsSubmenu">
                
              <li>
                    <a href="month_based.php">Monthly</a>
                </li>
				<li class="active">
                    <a href="payroll_history.php">Payroll Records</a>
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
	
           <div >
		   
    <div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;' >
<h3 style='text-align:center;'><b>Payroll Records</b></h3>
<form class='form-inline justify-content-center'>
<label class="lead mr-2 ml-2" for="month">	Sort By </label>
            <select class="form-control col-sm-4" name="sortBy" id="sortBy" onChange="sortPayroll()" >
                <option value='employee'>Employee</option>
				  <option value='month'>Month</option>
				    <option value='week'>Week</option>
            </select>
			</form>
		 <form class="form-inline justify-content-center" style="padding:10px" method="POST" action="month_based.php" >
            <label class="lead mr-2 ml-2" for="month"> Month</label>
            <select class="form-control col-sm-4" name="month" id="month" >
                <option value=0>Jan</option>
                <option value=1>Feb</option>
                <option value=2>Mar</option>
                <option value=3>Apr</option>
                <option value=4>May</option>
                <option value=5>Jun</option>
                <option value=6>Jul</option>
                <option value=7>Aug</option>
                <option value=8>Sep</option>
                <option value=9>Oct</option>
                <option value=10>Nov</option>
                <option value=11>Dec</option>
            </select>


            <label class="lead mr-2 ml-2" for="year">Year</label><select class="form-control col-sm-4" name="year" id="year" >
			<?php
			for($i=2018;$i<=3000;$i++)
				echo "<option value=$i>$i</option>"
			?>
            
								
        </select>
		   <input type='submit' value="SUBMIT" class='btn btn-success'> 
		</form>
	<div id="result_box">
	<?php
error_reporting(0);


?>
	</div>
	
		
	<button class='btn btn-primary' onClick='window.print()' style='width:75px;'>Print</button>	
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
function sortPayroll(){
	type=document.getElementById('sortBy').value;
	result=document.getElementById("result_box");
if(type=="employee")
{
	if(window.XMLHttpRequest)
		{
			obj5=new XMLHttpRequest();
		}
		else
		{
			obj5=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj5.open("POST","employee_sort.php",true);
		obj5.send();
		obj5.onreadystatechange=function()
		{
		if(obj5.readyState==4 && obj5.status==200)
		{
		result.innerHTML=obj5.responseText;
		
		
		
			
		
		}
		}
	
}
else if(type="month"){
	
}
else if(type=="week"){
	
}

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
.collection-div{
	position:relative;
	float:left;
	width:45%
	
}
.expenses-div{
	float:left;
	width:50%;
	margin-right:10px;
}

@media screen and (max-width: 650px) {
  .collection-div {
	  float:none;
    width:45%
  }
  .expenses-div{
	 width:50%;
	 float:none;
	margin-right:10px; 
  }
}
</style>
<style>
		
		.canvas-div{
			
			align:center;
  margin: auto;
  height: 50vh;
  width: 50vw;
		}
		</style>
</html>