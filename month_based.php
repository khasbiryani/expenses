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
		<style>
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

			</style>

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

	          <li >

              <a href="monthlyexp.php">Monthly Expenses (CALENDER)</a>

	          </li>

	         <li class='active'>

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

		   

    <div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;' id='result_box'>

<h3 style='text-align:center;'><b>Monthly Report <? echo $branch_name?></b></h3>

		 <form class="form-inline justify-content-center" style="padding:10px"  >
		 <img class="arrow-prev" src="images/prev.png" onclick="previous()">

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

		   <input type='button' value="SUBMIT" class='btn btn-success' onclick="submitReport()"> 
		   <img class="arrow-next" src="images/next.png" onclick="next()">
		</form>
		
	<div id="result_box">

	<?php

error_reporting(0);



$month=date("m");

$year=date("Y");
// print_r($_COOKIE); 

// if(isset($_COOKIE['monthlyreportmonth'])){

// 	$month=$_COOKIE['monthlyreportmonth']+1;

// 	if($month<10)

// 	{

// 		$month="0".$month;

// 	}

// 	$year=$_COOKIE['monthlyreportyear'];
// 	echo "<script>document.getElementById('month').value=$month;document.getElementById('year')=$year</script>";
// }

 if(isset($_COOKIE["monthlyreportmonth"]))

{
	$month=$_COOKIE["monthlyreportmonth"]+1;

	if($month<10)

	{

		$month="0".$month;

	}

	$year=$_COOKIE["monthlyreportyear"];

}

$n_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);

$cost_array=Array();

$array1=Array();

$array2=Array();

$cat_array=Array();

$from=date("Y-m-d", strtotime("01-".$month."-".$year));

$todate=date("Y-m-d",strtotime("$n_days-$month-$year"));

/*

for($i=1;$i<=$n_days;$i++){

	$day=$i;

	if($i<10)

	{

		$day="0"."$i";

	}

	$date=$day."-".$month."-".$year;

	

	$update_only_str=file_get_contents('main.json');

	$main_decode=json_decode($update_only_str,true);

	foreach($main_decode["daily-expenses"]["$date"]["actual"] as $cat=>$value){

		

		if(!array_key_exists($cat,$cost_array))

		{

			$cost_array[$cat]=$value;

			array_push($cat_array,$cat);

		}

		else

		{

			$cost_array[$cat]+=$value;

		}

		

	}

	

}

$arr=Array();

$category=Array();

$total=0;

foreach($cost_array as $id=>$val){

	

	array_push($arr,intval($val));

	if($id=="Total")

		$total=$val;

	array_push($category,$id);

}

*/



$query="select c19,c30 from t104 where c23 between '$from' and '$todate' and c13='$branch';";

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					$cati=" ";

				foreach($row as $key=>$value)

				{

					

					if($key=="c19")

					{

					$query2="select c20 from t106 where c19='$value';";

						$result2=mysqli_query($con,$query2);

						if (mysqli_num_rows($result2) > 0) {

									// output data of each row

									while($row2 = mysqli_fetch_assoc($result2)) {

									foreach($row2 as $key2=>$value2)

									{

										//echo "<td>$value2</td>";

										

											$cati=$value2;

										if(!array_key_exists($value2,$cost_array))

										{

											$cost_array[$value2]=0;

											

										}

										

									}

									}

						}

						

					}

					else if($key=="c30")

					{

				$cati;

				if($cati==" ")

				{

					

				}

				else{

				$cost_array[$cati]+=$value;

				if($value>$max)

					$max=$value;

				

				}

				$values=array();

				//echo "<td>$$value</td>";

			}

	}

	//echo "</tr>";

	}

	}



	

	$total_exp=0;

	

	/*

	$query="select sum(c30) from t114 where c31 between '$from' and '$todate' and c13='$branch'";

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					

				foreach($row as $key=>$value)

				{

					$value=round($value,2);

					$total_exp+=$value;

					//echo "<td>Payroll</td><td>$$value</td></tr><tr>";

			$cost_array['Payroll']=$value;				

				}

				}

	}

	*/

	

	//payroll from clover







				

	

	date_default_timezone_set("America/Chicago");

	$total_pay=0;

	

$in=strtotime($from.' 00:00:01') * 1000;



$out=strtotime($todate.' 23:59:59') * 1000;

 $url="https://www.clover.com/v3/merchants/".$property_decode["clover"][$branch]["merchId"]."/shifts?filter=in_time>=$in&filter=out_time<=$out";

$post_data = NULL;

  $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$property_decode["clover"][$branch]["apiToken"] 

        )                                                                       

        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if($post_data != NULL){

            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));

        }

        $data = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		$p=json_decode($data,true);

		//print_r($p);

		$counter= count($p['elements']);

		$in_time=Array();

		$out_time=Array();

		$pay_array=Array();

		for($i=0;$i<$counter;$i++)

		{

			$eid=$p["elements"][$i]['employee']['id'];

			$ename=$p["elements"][$i]['employee']['id'];

			$query="select c2,c5 from t101 where c1='$eid'";

			$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					

					

				foreach($row as $key=>$value)

				{

					

					if($key=='c2')

					{

					$ename=$value;

					$pay_array[$ename]=0;

					}

					else if($key=='c5')

						$pay_array[$ename]=$value;

				}

				}

	}

			

				if(array_key_exists('overrideInTime',$p["elements"][$i]))

				{

					$in_time[$ename][$i]=$p["elements"][$i]['overrideInTime'];

					

				}

				 else 

					$in_time[$ename][$i]=$p["elements"][$i]['inTime'];

				

				if(array_key_exists('overrideOutTime',$p["elements"][$i]))

					$out_time[$ename][$i]=$p["elements"][$i]['overrideOutTime'];

				else

					$out_time[$ename][$i]=$p["elements"][$i]['outTime'];

			

		}

		

		//print_r($in_time);

		foreach($in_time as $name=>$val)

		{

			foreach($val as $in=>$value)

			{

			//echo "<tr>";

			$start=date("d-m-Y H:i:s",substr($value,0,10));

			$end=date("d-m-Y H:i:s",substr($out_time[$name][$in],0,10));

			$day=date("l",strtotime($start));

			//echo "<td>$name - $day</td><td>$start</td><td>$end</td>";

			//echo "$name inTIme: $start   OutTime: $end  elapsed time:";

			$first=new DateTime($start);

			$second=new DateTime($end);

	$interval = $first->diff($second);

$elapsed = $interval->format('%h hours %i minutes %s seconds');

		//echo "<td>$elapsed</td>";

$hours=$interval->format('%h');

$minutes=round(($interval->format('%i'))/60,4);

$seconds=round(($interval->format('%s'))/3600,4);

$hours=$hours+$minutes+$seconds;

//echo "   <td> $hours</td><td>".$pay_array[$name]."</td> ";

$cal=0;

if($pay_array[$name]!=null)

{

$cal=round($hours*$pay_array[$name],2);

$total_pay+=$cal;

}



			

		}

		}



	$cost_array['Payroll']=$total_pay;

	$total_exp+=$total_pay;

	

	

	

	



	

	

	

	

	

	

	

	

	

	

	

	

	//print_r($cost_array);

	

$arr=Array();

$category=Array();

$total=0;

foreach($cost_array as $id=>$val){

	

	array_push($arr,intval($val));

	

		$total+=$val;

	array_push($category,$id);

}



	//echo "<td>Total Expenses</td><td>$$total_exp</td></tr>";

	$max=$total_exp;

	

	//echo "</table>";

	

	

	//array_push($cat_array,$category);

	















$cos_array=json_encode($arr);

$cat_array=json_encode($category);

$idi="mt_exp";

$day_l= date('M', strtotime($from));

echo "<h3 style='text-align:center;'>Monthly Expenses for $day_l $year</h3><div class='canvas-div' style='text-align:center'><canvas style='text-align:center' id='$idi' ></canvas></div>";

							echo "<script type='text/javascript'>

							get_graph($cos_array,'$idi',$cat_array);

							</script>

							

							<br><br>";

							

							echo "<div style='overflow:scroll;'><div class='expenses-div'><table class='table table-hover' id='table'>

							<thead thead class='thead-dark' style='color:white;background-color:black;'><tr><td>CATEGORY</td><td>COST</td><td>Percent</td></tr></thead>";

asort($cost_array);

							foreach($cost_array as $cat=>$val){

								if($cat=="Total")

									$total=$val;

								else

								{

									$pe=(round(intval($val))/round(intval($total)))*100;

									$pe=round($pe,2);

									echo "<tr><td>$cat</td><td>$val $</td><td>$pe %</td></tr>";

								}

								

							}

							echo "<tr><td>Total</td><td>$total $</td></tr>";

							

						

			

$query="select c33,c36 from t107 where c23 between '$from' and '$todate' and c13='$branch';";		

$result=mysqli_query($con,$query);

$collection=array();

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					

					$name="";

				foreach($row as $key=>$value)

				{

					if($key=="c33")

					{

						$name=$value;

						if(!array_key_exists($value,$collection))

						{

							$collection[$value]=0;

							

							}

							

					}

					else if($key=="c36")

						$collection[$name]+=$value;

				}

				

				}

	}

	// print_r($collection);

	echo "<tr ><td>Net Sales</td><td>".array_sum($collection)."$</td></tr>";

	echo "<tr style='background-color:yellow;'><td>Profits</td><td>";

	echo array_sum($collection)-$total;

	echo "$</td></tr>";

	echo "</table></div>

							";

	echo "<div style='float:left;width:45%' class='collection-div'><table class='table table-hover'><thead thead class='thead-dark' style='color:white;background-color:black;'><tr><td>Payment Type</td><td>Amount</td></tr></thead>";			

	foreach($collection as $type=>$value)

	{

		echo "<tr><td>$type</td><td>$value</td></tr>";

	}



			echo "</table></div></div>";		

							

//print_r($cost_array);



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
	<script type='text/javascript'>
		
		
			function next() {
				let currentMonth = Number(getCookie('monthlyreportmonth'));
			let currentYear = Number(getCookie('monthlyreportyear'));
				// console.log('month as received: ',currentMonth);
				
    			currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
				currentMonth = (currentMonth + 1) % 12;
    			
				// console.log('year ',currentYear);
				// console.log('month',currentMonth);
				document.cookie= 'monthlyreportmonth='+currentMonth;
				document.cookie= 'monthlyreportyear='+ currentYear;
				// console.log(document.cookie);
				location.reload();
   
	
}

function previous() {
	let currentMonth = Number(getCookie('monthlyreportmonth'));
			let currentYear = Number(getCookie('monthlyreportyear'));
	
				currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
				currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
				// console.log('year ',currentYear);
				// console.log('month',currentMonth);
				document.cookie= 'monthlyreportmonth='+currentMonth;
				document.cookie= 'monthlyreportyear='+ currentYear;
				// console.log(document.cookie);
				
				location.reload();
   
}

function submitReport(){

	document.cookie= 'monthlyreportmonth='+document.getElementById('month').value;
	document.cookie= 'monthlyreportyear='+ document.getElementById('year').value;
	location.reload();

}
</script>

  </body>


  <script>
	function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
today = new Date();

currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");

selectMonth = document.getElementById("month");
// console.log(document.cookie);
if(getCookie('monthlyreportmonth')){
	// console.log(getCookie('monthlyreportmonth'));
	selectMonth.value = getCookie('monthlyreportmonth');
	selectYear.value = getCookie('monthlyreportyear');
}
else{
	selectMonth.value=currentMonth;
	selectYear.value=currentYear;
	document.cookie= 'monthlyreportmonth='+currentMonth;
	document.cookie= 'monthlyreportyear='+ currentYear;
}


  







//month_display();

  

 /*function month_display(){

	 currentYear = document.getElementById("year").value;

currentMonth = document.getElementById("month").value;

	  if(window.XMLHttpRequest)

		{

			obj3=new XMLHttpRequest();

		}

		else

		{

			obj3=new ActiveXObject('Microsoft.XMLHTTP');

		}

		obj3.open("POST","calculate_month_exp.php?month="+currentMonth+"&year="+currentYear,true);

		obj3.send();

		obj3.onreadystatechange=function()

		{

		if(obj3.readyState==4 && obj3.status==200)

		{

		document.getElementById('result_box').innerHTML=obj3.responseText;

		//alert(obj3.responseText);

			

		

		}

		}

	 

 }*/

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