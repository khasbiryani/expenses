<!doctype html>
<html lang="en">
  <head>
  	<title>Edit record - AURORA</title>
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
                <li class="nav-item add">
                   <a href='addemployee.php'> <img src='images/add.png' height='50px' width='50px;' ></a>
                </li>
                <li class="nav-item add">
                  <a href='editemployee.php'>  <img src='images/edit.png' height='50px' width='50px;'></a>
                </li>
                <li class="nav-item add">
                   <a href='deleteemployee.php'>  <img src='images/delete.png' height='50px' width='50px;'></a>
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
           <div class="container col-sm-5 col-md-10 col-lg-8 mt-5 ">
		   
    <div class="card card_box"  style='background-color:#fcfcfc'>
	<?php
	$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
		$date='';
		if(isset($_POST['submit']))
		{
		 $date=$_POST["date"];
		 $total=0;
			foreach($_POST as $key=>$value)
			{
				if($key=='submit')
					break;
				//$token=explode("_",$key);
				//echo $token[1];
				
				 //$main_decode["users"][$token[0]][$token[1]]=trim($value);
				//echo "$key = $value <br>";
				if($key=='date')
					continue;
				
				if(strpos($key,'_')!=NULL)
				{
					
					$arr=explode('_',$key);
					$key="";
					foreach($arr as $v)
					{
						$key.=$v." ";
						
					}
					
				}
				$key=trim($key);
				if($value=="")
				{
					unset($main_decode['daily-expenses']["$date"]["actual"]["$key"]);
					continue;
					
				}
				$main_decode['daily-expenses']["$date"]["actual"]["$key"]="$value";
				$total+=$value;
				//echo "<tr><td>$key</td><td>$value</td></tr>";
			}
			$main_decode['daily-expenses']["$date"]["actual"]["Total"]="$total";
			//print_r($main_decode);
			$jsonData = json_encode($main_decode);
			file_put_contents('main.json', $jsonData);
			echo "
			<a href='day_details.php?date=$date'><button class='btn btn-primary'>Home</button></a>
			<div class='alert alert-success' id='alert_box' role='alert'>
 Details Updated Successfully!!
</div>";
		}
		
		?>
	<form id="emp_upd" action='edit_day_details.php' method="POST"> 
		<table class='table table-hover' id='users-table'>
	<?php
	$date=$_REQUEST['date'];
	
		echo "<thead thead class='thead-dark'><tr>
		
		<td>Category</td><td> Cost</td>";
	
	echo "</tr></thead>";
		foreach($main_decode['daily-expenses']["$date"]['actual'] as $cat=>$value){
			if($cat=="Total")
			{
				echo "<tr>
			
			<td><input type='text' value='".$cat."'  class='form-control' disabled ></td>
			
			<td><input type='text' value='".$value."' name='$cat' class='form-control' disabled ></td>
			
			</tr>";
				
			}
			else
			{
			echo "<tr>
			
			<td><input type='text' value='".$cat."' class='form-control' disabled ></td>
			
			<td><input type='text' value='".$value."' name='$cat' class='form-control'></td>
			
			</tr>";
			}
			
		}
echo "<input type='hidden' name='date' value='$date' />";	?>
	
	<tr><td><input type="submit" class="btn btn-info" name="submit" value="Update"</td></tr>
	
		</table>
		
		</form>
		
		
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
  function update_data(){
	  form_id=document.getElementById("emp_upd");
	  var no_of_element = form_id.elements.length-1;
		var data=new Create2DArray(no_of_element);
		alert(no_of_element);
		for(i=0;i<no_of_element;i++)
		{
			
			var submit_id=form_id.elements[i].id;
			var value=form_id.elements[i].value;
			var title= form_id.elements[i].title;
			var type=form_id.elements[i].type;
			var name=form_id.elements[i].name;
	  
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
</style>
</html>