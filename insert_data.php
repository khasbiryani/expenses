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

  	<title>Insert Record - <?php echo $branch_name;?></title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" href='images/fav-icon.ico'>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>	

		<link rel="stylesheet" href="css/font-awesome.min.css">

		<link rel="stylesheet" href="css/style.css">

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

	          <li>

             <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>

              <ul class="collapse list-unstyled" id="pageSubmenu">

                <li>

                    <a href="employees.php">Display</a>

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

                 <li class="nav-item active">

                   <b> <a class="nav-link" href="expenses_attributes.php">+CATEGORY</a></b>

                </li>

              

                <li class="nav-item active">

                    <b><a class="nav-link" href="delet_expenses_records.php"><button class='btn btn-info'>Modify Expense</button></a></b>

                </li>

               

               

              </ul>

            </div>

          </div>

        </nav>

	

           <div>

		   

    <div class="card card_box"  style='background-color:#fcfcfcoverflow:scrolling' id='result_box'>

		

  <div class="form-row">

    <div class="form-group col-md-6">

      <label for="startDate">Start Date</label>

      <input type="date" class="form-control" id="startDate" required onChange="start_insert()">

    </div>

    <div class="form-group col-md-6">

      <label for="endDate">End Date</label>

      <input type="Date" class="form-control" id="endDate" >

    </div>

  </div>

  <form id='week_data'>



		<table class='table table-hover' id='table'>

		<thead thead class="thead-dark">

		<tr><td><input type='checkbox' onClick="select_all()" id='selectAll'>All</td><td>CATEGORY</td><td>COST</td></tr>

		</thead>

		<?php



$expenses_array=array();

$link='';

		$query="select c19,c20 from t106;";

	$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {


				foreach($row as $key=>$value)

				{

					if($key=='c19')

					{

						$link=$value;

					}

					else if($key=='c20')

						{
							$expenses_array[$value]=$link;

						}

				}
				

				}

	}


	ksort($expenses_array);
	foreach($expenses_array as $value=>$link){
		echo "<tr><td><input type='checkbox' name='".$link."_id' class='form-control' onClick='enable(this.name)'></td>

			<td>$value</td>

			

			<td><input type='text'  id='".$link."_id' name='$link' class='form-control' disabled placeholder='ENTER VALUE'></td>

			<td><button class='btn btn-success'  style='width:75px;' onClick='get_data()'>Enter</button></td></tr>

			

			

			";
	}


			

		

		?>

		</table>

		</form>

		<table class='table'>

	<tr><td>	<button class='btn btn-success'  style='width:75px;' onClick="get_data()">Enter</button>	</td></tr>

	</table>

	<div id='check'>

	

	</div>

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

  var dates_set=0;

 function start_insert(){

	 end_date=document.getElementById("endDate");

	 	 start_date=document.getElementById("startDate");

		 if(start_date.value=="")

		 {

			 

		 }

		 else{

			 dates_set=1;

		 }

				//alert("NO date set ");

//		 alert("start date: "+start_date.value);

	// alert("end date: "+end_date.value);

	 

 }

 function enable(i){



	 //var s=i+"";

	 //i=i.toString();

	 //alert(i.);

	 inpu=document.getElementById(i);

	//alert(inpu);

	 if(dates_set==0)

	 {

		

		 alert("select dates first");

		 location.reload();	

		  document.getElementsByName(i).checked=false;

		 

	 }

	 else{

		 

	 

	if(inpu.hasAttribute("disabled")==true)

		inpu.removeAttribute("disabled");

	else

		inpu.setAttribute("disabled","true");

	 }

 }

 

 function select_all(){

	 var selectAll=document.getElementById("selectAll");

	 allval=selectAll.checked;

	  if(dates_set==0)

	 {

		 alert("select dates first");

	 }

	var input= document.getElementsByTagName("input");

	for(i=0;i<input.length;i++)

	{

		if(input[i].type=="checkbox")

		{

			if(allval==true)

			input[i].checked=true;

		else if(allval==false)

			input[i].checked=false;

			

		}

		else if(input[i].type=="text")

		{

			if(allval==true)

				input[i].removeAttribute("disabled");

			else if(allval==false)

				input[i].setAttribute("disabled","true");

		}

		

	}

 }

 function input_add(){

	 table=document.getElementById("table");

	 

	 var inputs="<tr><td></td><td><input type='text' class='form-control' placeholder='Enter CATEGORY'></td><td><input type='text' class='form-control' placeholder='Enter value'></td></td>"

	 table.appendChild(inputs);

 }

 

 $(document).ready(function(){

  $("#add").click(function(){

    $("#table").append(" <tr><td></td><td><input type='text' class='form-control' placeholder='ENTER CATEGORY'></td><td><input type='text' class='form-control' placeholder='ENTER VALUE'></td></td>");

  });

  

});





function get_data(){

	form_id=document.getElementById("week_data");

	len=form_id.elements.length;

	count=0;

	var category="";

	var text="";

	if(dates_set==1){

		

	for(i=0;i<len;i++)

	{

		if(form_id.elements[i].placeholder=='ENTER CATEGORY')

		{

			category=form_id.elements[i].value;

		}

		if(form_id.elements[i].placeholder=='ENTER VALUE')

		{

			if(category=="")

			{

				if(form_id.elements[i].hasAttribute("disabled")==true)

					continue;

				text=text+form_id.elements[i].id+":"+form_id.elements[i].value+",";

				

			}

			else{

				text=text+category+":"+form_id.elements[i].value+",";

				category="";

			}

			

			

		}

	}

	

	startDate=document.getElementById("startDate").value;

	endDate=document.getElementById("endDate").value;

	

if(endDate=="")

{

endDate=startDate;

}

	

	

	if(window.XMLHttpRequest)

		{

			obj=new XMLHttpRequest();

		}

		else

		{

			obj=new ActiveXObject('Microsoft.XMLHTTP');

		}

		obj.open("POST","data_update.php?text="+text+"&startDate="+startDate+"&endDate="+endDate,true);

		obj.send();

		obj.onreadystatechange=function()

		{

		if(obj.readyState==4 && obj.status==200)

		{

		

		document.getElementById("check").innerHTML=obj.responseText;

		

		location.reload();

		

			

		}

		}

	

	}

	else{

		

		alert("select the dates first!!");

	}



	

	

}

  </script>

  <style>



body{



	background-color:#808080;

}

.card_box{

	padding:5px;

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