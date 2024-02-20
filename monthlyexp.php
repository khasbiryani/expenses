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
echo "<div align='center'><h2 class='fs-title'>Please Log In<meta http-equiv='refresh' content='2; url=index.php'></h2></div>";
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
  	<title>Expenses - <?php echo $branch_name;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href='images/fav-icon.ico'>
			<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		
		<script src="js/script_for_index.js" type="text/javascript">
	</script>
	<script src="js/script_new.js" type="text/javascript">
	</script>
	<script src="js/linkExp.js" type="text/javascript">
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
					
					location.reload();
				
			}
			}
		}

		function sales_download(){
			if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.open("POST","all_sales_download.php",true);
			obj.send();
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4 && obj.status==200)
				{
					console.log(obj.response);
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
	          <li >
             <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="employees.php">Display</a>
                </li>
               
                
				
              </ul>
	          </li>
			  <li>
             <a href="#plaidSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Plaid</a>
              <ul class="collapse list-unstyled" id="plaidSubmenu">
                
              <li>
                    <a href="plaid_category.php">Category</a>
                </li>
				
              </ul>
	          </li>
	          <li class='active'>
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
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                  <!-- <li class="nav-item active ">
                    <b><a class="nav-link" href="expenses_attributes.php">+CATEGORY</a></b>
                </li> -->
				<!-- <p style='padding:10px;color:#cc4d6c;font-weight: bold;'> <li class="nav-item active ">
				<a href="insert_data.php"> <img src='images/edit-exp.png' class='add' height='50px' width='50px;'><i>Expenses</i></a> </li>
	<li class="nav-item active "><a href="insert_sales.php"> <img src='images/sales.png' class='add' height='50px' width='50px;'><i>Sales</i></a></li>
	<li class="nav-item active "><a href="payroll_insert.php"> <img src='images/payroll.png' class='add' height='70px' width='70px;'><i>Payroll</i></a></li>
	<li class="nav-item active "><a href="#" onclick="sales_download()" title='wait after clicking to reload page. some times it takes time to reload.'> <img src='images/sales_download.png' class='add' height='50px' width='50px;'><i>Sales download</i></a>
	


			</li></p> -->
               <!-- <li style="margin-right:10px;" id="link-button"><a href="link.html">Link Account</a></li> -->
			   <!-- <li style="margin-right:10px;" id="link-button">Link Account</li> -->
               <li>
			   <?php
			   $date_arr=explode("-",(string)$property_decode["clover"][$branch]["last"]);
			   $date= $date_arr[1]."-".$date_arr[2]."-".$date_arr[0];
			echo "<p title='clicking sales download before 11pm will update through yesterday. otherwise it will update sales through today.  '>Sales updated: $date </p>";
	   ?>
			</li>
              </ul>
            </div>
          </div>
        </nav>
	
           <div>
		   
    <div class="card card_box"  style='background-color:#fcfcfc;'>
	
	<div  style='text-align:center;padding:10px;font-weight: bold;'><b><h4 id='search_box' style='font-weight: bold;color:#cc4d6c;'></h4></b></div>
	<div id='result_box' align='center' >
				
	<h6 style='text-align:center;padding:10px;color:#cc4d6c;font-weight: bold;'>
	
	<a href="insert_data.php"> <img src='images/edit-exp.png' class='add' height='50px' width='50px;'><i>Expenses</i></a> 
	<a href="insert_sales.php"> <img src='images/sales.png' class='add' height='50px' width='50px;'><i>Sales</i></a>
	<a href="payroll_insert.php"> <img src='images/payroll.png' class='add' height='70px' width='70px;'><i>Payroll</i></a>
	<a href="#" onclick="sales_download()" title='wait after clicking to reload page. some times it takes time to reload.'> <img src='images/sales_download.png' class='add' height='50px' width='50px;'><i>Sales download</i></a>
	</h6>
	
	 <form class="form-inline justify-content-center" style="padding:10px" >
            <label class="lead mr-2 ml-2" for="month"> Month</label>
            <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
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


            <label class="lead mr-2 ml-2" for="year">Year</label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
			<?php
			for($i=2018;$i<=3000;$i++)
				echo "<option value=$i>$i</option>"
			?>
            
								
        </select></form>
	
       <div class="form-inline justify-content-center" id='hdr_mth_yr'> 
		<img class="arrow-prev" src="images/prev.png" onclick="previous()">
	   <div class="w-45"><h5 class="card-header d-flex justify-content-center " id="monthAndYear"></h5></div>
	  <img class="arrow-next" src="images/next.png" onclick="next()">
       <?php
			//echo "<p title='clicking sales download before 11pm will update through yesterday. otherwise it will update sales through today.  '>Sales updated: ".$property_decode["clover"][$branch]["last"]."  </p>";
	   ?>
	</div>
	<div style='padding:10px;overflow:scroll;'>
	   <table class="table table-hover"  id="calendar">
            <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            </thead>

            <tbody id="calendar-body">

            </tbody>
        </table>
		<div id='notes_text'>
		<h3>Notes</h3>
		<textarea class='form-control' rows="10" style='margin:15px;' id='notes' onblur='update_notes()'></textarea>
		
		</div>
</div>
        
        
       </div>
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

today = new Date();
currentMonth = today.getMonth();

currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");

months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
colors_months=["#fb99bc","#fa85af","#f970a1","#f85c94","#f74887","#f7347a","#f7347a","#de2e6d","#c52961","#ac2455","#941f49","#7b1a3d"];
colors_mth_bg=["#feeaf1","#feeaf1","#feeaf1","#fdd6e4","#fdd6e4","#fdd6e4","#fcc2d7","#fcc2d7","#fcc2d7","#fbadc9","#fbadc9","#fbadc9"];

var monthAndYear = document.getElementById("monthAndYear");
			var exp_act_str=" ";
calculate_daily_exp();

day_details();

function calculate_daily_exp(){
	
	
		 if(window.XMLHttpRequest)
		{
			obj=new XMLHttpRequest();
		}
		else
		{
			obj=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj.open("POST","calculate_expenses.php?year="+currentYear+"&month="+currentMonth+"&days="+daysInMonth(currentMonth, currentYear),true);
		obj.send();
		obj.onreadystatechange=function()
		{
		if(obj.readyState==4 && obj.status==200)
		{
		document.getElementById('search_box').innerHTML=obj.responseText;
		
			
		
		}
		}
	
}


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    day_details();
	calculate_daily_exp();
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    day_details();
		calculate_daily_exp();
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    day_details();
		calculate_daily_exp();
}




// check how many days in a month code from https://dzone.com/articles/determining-number-days-month
function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
}

function dayclick(id){
	day_id=document.getElementById(id);
	value=day_id.innerHTML;
	window.location.href="day_details.php?date="+id;
	
}
function day_details(){
	
document.getElementById('monthAndYear').innerHTML=months[currentMonth]+" "+currentYear;
document.getElementById('month').value=currentMonth;
document.getElementById('year').value=currentYear;
	if(window.XMLHttpRequest)
		{
			obj5=new XMLHttpRequest();
		}
		else
		{
			obj5=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj5.open("POST","get_act_data.php?val="+currentMonth+"&year="+currentYear,true);
		obj5.send();
		obj5.onreadystatechange=function()
		{
		if(obj5.readyState==4 && obj5.status==200)
		{
		rec=obj5.responseText;
		
		//alert(exp_act_str);
		document.getElementById('calendar-body').innerHTML=rec;
		
			
		
		}
		}
		
		
		
		
		
		if(window.XMLHttpRequest)
		{
			obj6=new XMLHttpRequest();
		}
		else
		{
			obj6=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj6.open("POST","view_notes.php?val="+currentMonth+"&year="+currentYear,true);
		obj6.send();
		obj6.onreadystatechange=function()
		{
		if(obj6.readyState==4 && obj6.status==200)
		{
		rec=obj6.responseText;
		document.getElementById('notes').value=rec;
		//alert(rec);
		
		
			
		
		}
		}
		
	
}

function update_notes(){
	content=document.getElementById('notes').value;
	if(window.XMLHttpRequest)
		{
			obj6=new XMLHttpRequest();
		}
		else
		{
			obj6=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj6.open("POST","update_notes.php?val="+currentMonth+"&year="+currentYear+"&content="+content,true);
		obj6.send();
		obj6.onreadystatechange=function()
		{
		if(obj6.readyState==4 && obj6.status==200)
		{
		rec=obj6.responseText;
		
		//alert(rec);
		
		
			
		
		}
		}
}
</script>
<!-- <button id="link-button">Link Account</button> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script type="text/javascript">
 
(async function($) {
  let handler;
  let link="";
  let public="";
  let access="";
  $.ajax({
	  url:"get_link_token.php"
  })
  .done(function(data){
	  // console.log(data);
	  link = data;
    // console.log(link);
    handler = Plaid.create({
  token: `${link}`,
  onSuccess: (public_token, metadata) => {
	  public = public_token;
    // console.log(public_token);

		$.ajax({
	  url:"get_access_token.php?data="+public
    })
    .done(function(data){
		access = data;
		console.log("Link: "+link);
		console.log("Public: "+public);
        console.log("access:"+access);
	var records = link+";"+public+";"+data;
	 $.ajax({
	  url:"insert_plaid_tokens.php?data="+records
    })
    .done(function(data){
		console.log(data);
    });
    });
	
	
  },
  onLoad: () => {},
  onExit: (err, metadata) => {
	  console.log(metadata);
	  console.log(err);
  },
  onEvent: (eventName, metadata) => {},
  //required for OAuth; if not using OAuth, set to null or omit:
  receivedRedirectUri: null,
});
  });
  
  
 

  $('#link-button').on('click', function(e) {
    handler.open();
  });
})(jQuery);
</script>

<style>

body{

	background-color:#808080;
	
}
td{
	  border: 0.1px solid rgba(0, 0, 0, .1);
	  width:150px;
	  height:100px;
}

.day_div:hover{
	background-color:#fdad9b;
	 border: 1px solid gray;
	 
	
}

.arrow-next{
	height:50px;
}

.arrow-next:hover{
	opacity:0.5;
}
.arrow-next:active{
	opacity:1;
	
	transform: translateX(4px);
	
	
}



.arrow-prev{
	height:50px;
}

.arrow-prev:hover{
	opacity:0.5;
}
.arrow-prev:active{
	opacity:1;
	
	transform: translateX(-4px);
}

.a{
	display:inline;
	
}
.card_box{
	  box-shadow: 0 10px 8px 0 rgba(0, 0, 0, 0.3), 0 10px 20px 0 rgba(0, 0, 0, 0.5);
	
}

.logo_lit{
	
	box-shadow: 0 5px 8px 5px rgba(230, 230, 230, 5), 2px 2px 20px 5px rgba(230, 230, 230, 5);
	
}
.logo_lit:hover{
	
	box-shadow: 0 5px 8px 5px rgba(230, 230, 230, 8), 2px 2px 30px 5px rgba(230, 230, 230, 8);
	
}

.add{
	
	margin-left:15px;
}
.add:hover{
	opacity:0.5;
	cursor:pointer;
	
}

.tooltip {
 visibility:visible;
}
.tooltiptext {
  visibility: hidden;
  /* //width: 300px; */
  height:auto;
  margin-left:50px;
  margin-top:50px;
  margin-right:0px;
  background-color: #e5e5e5;
  color: black;
  font-weight:bold;
  text-align: center;
  border:1px solid black;

  padding: 10px;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  

}


day_div{
	text-decoration:none;
	
}
a{
color:black;	
}
a:hover{
	color:black;
}
h6{
display: inline;
	
}
</style>
</html>