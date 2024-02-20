<!doctype html>
<html lang="en">
  <head>
  	<title>Delete Employee - AURORA</title>
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
	          <li class="active">
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
	          <li >
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
	
		<table class='table table-hover' id='users-table'>
	<?php
	
	
		$update_only_str=file_get_contents('main.json');
		$main_decode=json_decode($update_only_str,true);
		
		echo "<thead thead class='thead-dark'><tr>";
	foreach($main_decode["users-th"] as $key=>$th){
		echo "<th>$th</th>";
		
	}
	echo "<th></th></tr></thead>";
		foreach($main_decode["users"] as $key=>$users)
		{
			echo "<tr>
			
			<td>".$users["name"]."</td>
			
			<td>".$users["pay"]."</td><td>".$users["role"]."</td><td>".$users["phone"]."</td>
			<td><button class='btn btn-danger' id='$key' onClick='deleteEmp(this.id)'>Delete</button></td>
			
			</tr>";
			
		}

	?>
	
	
	
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
  
  function deleteEmp(id)
  {
	  var confirm_del=confirm("Do your really wanna delete Data?");
	  if(confirm_del==true)
	  {
		  
		  if(window.XMLHttpRequest)
		{
			obj=new XMLHttpRequest();
		}
		else
		{
			obj=new ActiveXObject('Microsoft.XMLHTTP');
		}
		obj.open("POST","delete_record.php?id="+id,true);
		obj.send();
		obj.onreadystatechange=function()
		{
		if(obj.readyState==4 && obj.status==200)
		{
		if(obj.responseText=='1')
		{
			alert("Record Deleted Successfully");
			location.reload();
		}
			
		else 
		{
			alert("Error Deleting Record");
		}
			
		}
		}
		
		  
	  }
	  else{
		 
		  
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