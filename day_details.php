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

  	<title>Daily Expenses - <?php echo $branch_name;?></title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" href='images/fav-icon.ico'>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

		<link rel="stylesheet" href="css/font-awesome.min.css">

		<link rel="stylesheet" href="css/style.css">

		<script src="js/linkExp.js" type="text/javascript">

		</script>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>	

		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>	

		<script type='text/javascript'>

		function get_graph(data,id,text,max){

			//alert(id);

			var label=[];

			var $data=data;

			var maxi=max+100;

			var $text=text;

			//alert($data.length);

			//array of colors for display

			var rgb=["rgba(220,53,69,1)","rgba(0,255,0,1)","rgb(0,0,160,1)","rgba(255,128,64,1)","rgba(128,255,255,1)",

			"rgba(225,255,0,1)","rgba(128,128,0,1)","rgba(64,0,64,1)","rgba(128,0,0,1)","rgba(255,53,69,1)",

			"rgba(128,0,255,1)","rgba(67,5,64,1)","rgba(12,5,64,1)","rgba(67,5,78,1)","rgba(100,5,64,1)","rgba(78,56,64,1)","rgba(6,5,64,1)","rgba(67,50,64,1)","rgba(128,5,18,1)","rgba(67,57,64,1)","rgba(66,5,64,1)","rgba(67,55,64,1)"];

			var rgb_back=["rgba(220,53,69,0.3)","rgba(0,255,0,0.5)","rgb(0,0,160,0.75)","rgba(255,128,64,0.75)","rgba(128,255,255,0.75)",

			"rgba(225,255,0,0.75)","rgba(128,128,0,0.75)","rgba(64,0,64,0.75)","rgba(128,0,0,0.75)","rgba(255,53,69,0.75)",

			"rgba(128,0,255,0.75)","rgba(67,5,64,0.75)","rgba(12,5,64,0.75)","rgba(67,5,78,0.75)","rgba(100,5,64,0.75)","rgba(78,56,64,0.75)","rgba(6,5,64,0.75)","rgba(67,50,64,0.75)","rgba(128,5,18,0.75)","rgba(67,57,64,1)","rgba(66,5,64,0.75)","rgba(67,55,64,0.75)"]

			var dataset_array=[];

			//setting data set in form of array

			for(i=0;i<$data.length;i++)

			{

				//label[i]=$text[i];

				//alert($data[i]);

				//alert(myChart.data.datasets[i].label);

					dataset_array[i]={

						label:$text[i] ,

						backgroundColor: rgb_back[i],

						borderColor: rgb[i],

						borderWidth: 2,

					   

					  

						  data:$data[i],

					  }

			}

						//alert(dataset_array);

						

						

					var ctx = document.getElementById(id).getContext('2d');

					//alert($data);

			var myChart = new Chart(ctx, {

				  

				type: 'bar',

				data: {

					labels: label,

					type:'bar',

				   datasets: dataset_array

					

					

				},

				  options: {

					 responsive: true,

				maintainAspectRatio: false,

					scales: {

						

						yAxes: [{

							ticks: {

								beginAtZero:true,

								steps: 100,

								stepValue: 100,

								max: maxi

							}

						}]

						

					}

				}

			});







		}

		

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

		

		function next(da) {

			window.location.href="day_details.php?date="+da;

}





function get_sales(){

	let params = new URLSearchParams(location.search);

		var dat=params.get('date');

		if(window.XMLHttpRequest)

			{

				obj=new XMLHttpRequest();

			}

			else

			{

				obj=new ActiveXObject('Microsoft.XMLHTTP');

			}

			obj.open("POST","sales_download.php?dat="+dat,true);

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





function previous(da) {

window.location.href="day_details.php?date="+da;

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

              

                <li>

                    <a href="addemployee.php">add</a>

                

              </ul>

	          </li>

	          <li class="active">

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

      <div id="content" >



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

	

           <div>

		   

    

	

		

	<?php

	//error_reporting(0);

	$update_only_str=file_get_contents('main.json');

		$main_decode=json_decode($update_only_str,true);

	$date=$_REQUEST['date'];

	 



	$view_date=DateTime::createFromFormat('d-m-Y', $date)->format('m-d-Y');

	$day = date('l', strtotime($date));

	

	$next=date('d-m-Y', strtotime('1 day', strtotime($date)));

	$prev=date('d-m-Y', strtotime('-1 day', strtotime($date)));

	 

	echo " <div style='text-align:center; margin-left:5%;margin-right:5%' class='card card_box'>";

	

	echo '<div class="form-inline justify-content-center " style="background-color:white;" id="hdr_mth_yr"> 

		<img class="arrow-prev" src="images/prev.png" onclick="previous(this.title)" title="'.$prev.'" style="margin-right:10px;">';

	  echo "<h6><b>$view_date $day</b></h6>";

	 echo' <img class="arrow-next" src="images/next.png" onclick="next(this.title)" title="'.$next.'"><br>';

      echo " 

	</div></div>";

	

	

	

	//Payroll info from clover

	

	echo "<div class='card card_box'  style='background-color:#fcfcfc;margin-left:2%;margin-top:20px;width:auto;margin-right:2%;overflow:scroll'><h3 style='text-align:center'><b>Payroll</b></h3>";

	

	echo "<table class='table table-hover'>

	

	<thead style='background-color:#323232;color:white;'><tr><td>Name</td><td>In Time</td> <td>Out Time</td><td>Elapsed Time</td><td>hours worked</td> <td>Pay</td><td>Amount</td><td><a href='payroll_insert.php'><button class='btn btn-primary'>+ADD</button></a></td></tr></thead>

	

	

	";

	

	date_default_timezone_set("America/Chicago");

$in=strtotime($date.' 00:00:01') * 1000;

$out=strtotime($date.' 23:59:59') * 1000;

$url="https://www.clover.com/v3/merchants/".$property_decode['clover'][$branch]['merchId']."/shifts?filter=in_time>=$in&filter=out_time<=$out";

$post_data = NULL;

  $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . 	$this->access_token));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$property_decode['clover'][$branch]['apiToken']

        )                                                                       

        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if($post_data != NULL){

            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($post_data));

        }

        $data = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		$p=json_decode($data,true);

		

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

					echo "<tr>";

					

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

		$total_pay=0;

		$total_hours=0;

		//print_r($in_time);

		foreach($in_time as $name=>$val)

		{

			foreach($val as $in=>$value)

			{

			echo "<tr>";

			$start=date("d-m-Y H:i:s",substr($value,0,10));

			$end=date("d-m-Y H:i:s",substr($out_time[$name][$in],0,10));

			$day=date("l",strtotime($start));

			$begin=date("m-d-Y H:i:s",substr($value,0,10));

			$stop=date("m-d-Y H:i:s",substr($out_time[$name][$in],0,10));

			echo "<td>$name - $day</td><td>$begin</td><td>$stop</td>";

			//echo "$name inTIme: $start   OutTime: $end  elapsed time:";

			$first=new DateTime($start);

			$second=new DateTime($end);

	$interval = $first->diff($second);

$elapsed = $interval->format('%h hours %i minutes %s seconds');

		echo "<td>$elapsed</td>";

$hours=$interval->format('%h');

$minutes=round(($interval->format('%i'))/60,4);

$seconds=round(($interval->format('%s'))/3600,4);

$hours=$hours+$minutes+$seconds;

echo "   <td> $hours</td><td>".$pay_array[$name]."</td> ";

$cal=0;

$total_hours+=$hours;

if($pay_array[$name]!=null)

{

$cal=round($hours*$pay_array[$name],2);

$total_pay+=$cal;



}

echo "<td>$cal</td>";

			echo "</tr>";

			

		}

		}





	

	echo "<tr style='background-color:yellow;'><td></td><td></td><td></td><td>Total Hours</td><td>$total_hours</td><td>Total Payroll Today:</td><td>$total_pay</td></tr>";

	echo "</table></div>";



	

	

	

	

	

	

	

	

	

	

	

	

	

	

	echo '<div class="card card_box"  style="background-color:#fcfcfc;float:left;margin-left:20px;margin-top:20px;width:auto; height:800px;overflow:scroll;">

	';

	echo "<h3 style='text-align:center'><b>";

	$timestamp = strtotime($date);





	if($date==date("d-m-Y"))

		echo " (TODAY)";

	

	

	echo " Expenses </b></h3>";

	echo "<table class='table table-hover'>

	

	<thead style='background-color:#323232;color:white;'><tr><td>Category</td>

	<td>Amount</td>

	<td><a href='insert_data.php'><button class='btn btn-primary'>+ADD</button></td>";

	//</a><td><a href='edit_day_details.php?date=$date'><button class='btn btn-info'>EDIT</button></a></td>

	echo "</tr></thead>";

	

	

	$date=DateTime::createFromFormat('d-m-Y', $date)->format('Y-m-d');

	$category=array();

	$cat_array=array();

	$val_array=array();

	$values=array();

	$max=0;

	$query="select c22,c19,c30 from t104 where c23='$date' and c13='$branch';";

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";

					$count=0;

					$col="";

				foreach($row as $key=>$value)

				{

					if($key=="c22")

					{

						$link=$value;

						$col=$key;

						

					}

					if($key=="c19")

					{

					$query2="select c20 from t106 where c19='$value';";

						$result2=mysqli_query($con,$query2);

						if (mysqli_num_rows($result2) > 0) {

									// output data of each row

									while($row2 = mysqli_fetch_assoc($result2)) {

									foreach($row2 as $key2=>$value2)

									{

										echo "<td>$value2</td>";

										array_push($category,$value2);

									}

									}

						}

						

					}

					else if($key=="c30")

					{

			

				

				array_push($values,$value);

				array_push($val_array,$values);

				if($value>$max)

					$max=$value;

				$values=array();

				echo "<td>$$value</td>

				<td><input type='button' class='btn  btn-success' value='update' id='$link' title='$col' name='t104'></td>

				<td><img src='images/cancel.png'  class='cancel_icon' id='$link' title='$col' value='60'  name='t104'></td></tr>

				";

			}

	}

	echo "</tr>";

	}

	}

	//print_r($category);

	

	$total_exp=0;

	

	

	echo "<td>Payroll</td><td>$$total_pay</td></tr>";

	$total_exp+=$total_pay;

	array_push($category,"Payroll");

					array_push($values,$total_pay);

				array_push($val_array,$values);

	

	$query="select sum(c30) from t104 where c23='$date' and c13='$branch'";

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					

				foreach($row as $key=>$value)

				{

					$total_exp+=$value;

					//array_push($category,"Total");

					//array_push($values,$total_exp);

				//array_push($val_array,$values);

				//$values=array();

				}

				}

	}

	



	echo "<td>Total Expenses</td><td>$$total_exp</td></tr>";

	$max=$total_exp;

	

	echo "</table>";

	

	

	array_push($cat_array,$category);

	

	

	?>

		

	</div>

	

	

	

	

	

	

	<div class="card card_box"  style='background-color:#fcfcfc;float:left;margin-left:20px;margin-top:20px;width:auto;height:800px;overflow:scroll;'>

	<?php

	

	

	

	echo "<h3 style='text-align:center'><b>Sales</b></h3>";

	

	echo "<table class='table table-hover'>

	

	<thead style='background-color:#323232;color:white;'><tr><td>Sales</td><td>Amount</td><td><button onclick='get_sales()' class='btn btn-primary'>+ADD</button></td></tr></thead>

	

	

	";

	

	$flag=0;

	$netsales=0;

	$query="select c34,c33,c36 from t107 where c23='$date' and c13='$branch';";

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";

					$na="";

				foreach($row as $key=>$value)

				{

					if($key=='c34')

					{

						$link=$value;

						$col=$key;

					}

					else if($key=='c33')

					{

					echo "<td>$value</td>
					
					";

					$na=$value;

					}

					else 

					{

						echo "<td>$$value </td>
						<td><input type='button' class='btn  btn-success' value='update' id='$link' title='$col' name='t107'></td>

				<td><img src='images/cancel.png'  class='cancel_icon' id='$link' title='$col' value='60'  name='t107'></td>
						";

						if($na=="Net Sales")

						{

							$netsales=$value;

						}

						

					}

				}

				echo "

				

				

				</tr>";

				}

	}

	

	

	

echo "<b>NetSales: $$netsales , Total Expenses: $$total_exp ,<br> profit: $" ;

echo $netsales-$total_exp."</b>";

	

	echo "</table>";

	

	

	

	

	

	?>

	

	</div>

	

	

		

	<?php

	/*

	//Payroll info

	

	echo "<h3 style='text-align:center'><b>Payroll</b></h3>";

	

	echo "<table class='table table-hover'>

	

	<thead style='background-color:#323232;color:white;'><tr><td>Name</td><td>Hours Worked</td> <td>pay rate</td> <td>Total Pay</td><td><a href='insert_sales.php'><button class='btn btn-primary'>+ADD</button></a></td></tr></thead>

	

	

	";

	

	$flag=0;

	$query="select c1,c17,c5,c30 from t114 where c31='$date' and c13='$branch';";

	$result=mysqli_query($con,$query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";

					

				foreach($row as $key=>$value)

				{

					

					

					echo "<td>$value</td>";

					

				}

				echo "</tr>";

				}

	}

	



	

	echo "</table>";

	

	

	

	

	*/

	?>

	

	

	

	

	

			

	

	

	<div class="card card_box"  style='background-color:#fcfcfc;float:left;margin-left:20px;margin-top:20px;height:800px;overflow:scroll;'>

	<?php

	$category_array=json_encode($category);

							//print_r($val_array);

							$values_array=json_encode($val_array);

							$ch='ch';

							echo "<div class='canvas-div' align='center'><h3>Cost Analysis</h3><canvas id='$ch' ></canvas></div>";

							echo "<script type='text/javascript'>

							get_graph($values_array,'$ch',$category_array,$max);

							</script>";

	?>

	</div>

	

	

	

	

	

	<div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;float:left;margin-left:20px;margin-top:20px;height:800px' id='result_box'>

			<h3 style='text-align:center;'>INSERT NEW EXPENSES</h3>

  <div class="form-row">

    <div class="form-group col-md-6">

      <label for="startDate">Start Date</label>

      <input type="date" class="form-control" id="startDate" required onChange="start_insert()" value="<?php echo $date ?>" disabled>

    </div>

    <div class="form-group col-md-6">

      <label for="endDate">End Date</label>

      <input type="Date" class="form-control" id="endDate" value="<?php echo $date ?>" disabled>

    </div>

  </div>

  <form id='week_data'>



		<table class='table table-hover' id='table'>

		<thead thead class="thead-dark">

		<tr><td><input type='checkbox' onClick="" id='selectAllSales'>All</td><td>CATEGORY</td><td>COST</td></tr>

		</thead>

		<?php





$link='';

		$query="select c19,c20 from t106;";

	$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) > 0) {

				// output data of each row

				while($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";

				foreach($row as $key=>$value)

				{

					if($key=='c19')

					{

						$link=$value;

					}

					else if($key=='c20')

						{

							echo "<td><input type='checkbox' name='".$link."_id' class='form-control' onClick='enable(this.name)'></td>

			<td>$value</td>

			

			<td><input type='text'  id='".$link."_id' name='$link' class='form-control' disabled placeholder='ENTER VALUE'></td>

			<td><input type='button' class='btn btn-success'  style='width:75px;' onClick='get_data()' value='Enter'></td>

			

			

			";

						}

				}

				echo "</tr>";

				}

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

	

	

	

	 <div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;float:left;margin-left:20px;margin-top:20px;height:800px;' id='result_box'>

	<h3 style='text-align:center;'>INSERT/UPDATE SALES RECORDS</h3>

		

  <div class="form-row">

 

    <div class="form-group col-md-6">

      <label for="startDate">Start Date</label>

      <input type="date" class="form-control" id="startDate" value="<?php echo $date ?>" disabled>

    </div>

    <div class="form-group col-md-6">

      <label for="endDate">End Date</label>

      <input type="Date" class="form-control" id="endDate"  value="<?php echo $date ?>" disabled>

    </div>

  </div>

  <form id='sales_data'>



		<table class='table table-hover' id='table'>

		<thead thead class="thead-dark">

		<tr><td><input type='checkbox' onClick="" id='selectAllSales'>All</td><td>CATEGORY</td><td>COST</td></tr>

		</thead>

		<?php





			foreach($property_decode['sales_type'] as $cat){

				

			



							echo "<td><input type='checkbox' name='".$cat."_id' class='form-control' onClick='enable_sales(this.name)'></td>

			<td>$cat</td>

			

			<td><input type='text'  id='".$cat."_id' name='$cat' class='form-control' disabled placeholder='ENTER VALUE'></td>

			<td><input type='button' class='btn btn-success'  style='width:75px;' onClick='get_data_sales()' value='Enter'></td>

			

			</tr>

			";

			}	



			

		

		?>

		</table>

		</form>

		<table class='table'>

	<tr><td>	<button class='btn btn-success'  style='width:75px;' onClick="get_data_sales()">Enter</button>	</td></tr>

	</table>

	<div id='check'>

	

	</div>

	</div>

	

	

	

	

	</div>

	  

	  </div>

		</div>



  

    <script src="js/popper.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/main.js"></script>

<script>

var d = new Date();

  var today=d.getDay();

  var dates_set=1;

 function start_insert(){

	 end_date=document.getElementById("endDate");

	 	 start_date=document.getElementById("startDate");

		 alert("start date: "+start_date.value);

		 if(start_date.value=="")

		 {

			 

		 }

		 else{

			 dates_set=1;

		 }

				//alert("NO date set ");

	 

 alert("end date: "+end_date.value);

	 

 }

 function enable(i){



	 //var s=i+"";

	 //i=i.toString();

	 //alert(i.);

	 inpu=document.getElementById(i);

	//alert(inpu);

	 

	

		 

	 

	if(inpu.hasAttribute("disabled")==true)

		inpu.removeAttribute("disabled");

	else

		inpu.setAttribute("disabled","true");

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





 function enable_sales(i){



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

 

 function select_all_sales(){

	 var selectAll=document.getElementById("selectAllSales");

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



function get_data_sales(){

	form_id=document.getElementById("sales_data");

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

	

	//alert(text);

	

	

	if(window.XMLHttpRequest)

		{

			obj=new XMLHttpRequest();

		}

		else

		{

			obj=new ActiveXObject('Microsoft.XMLHTTP');

		}

		obj.open("POST","sales_update.php?text="+text+"&startDate="+startDate+"&endDate="+endDate,true);

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

  </body>

  

  <style>



body{



	background-color:#808080;

}

.card_box{

	padding:5px;

	  box-shadow: 0 10px 8px 0 rgba(0, 0, 0, 0.3), 0 10px 20px 0 rgba(0, 0, 0, 0.5);

	margin-bottom:10px;

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

<style>

		canvas{

			width:500px !important;

			height:450px !important;

			

 

		}

		@media only screen and (max-width: 450px) {

			canvas{

			width:350px !important;

			height:300px !important;

			

 

		}

		}

		.canvas-div{

			

		

		}

		</style>

</html>