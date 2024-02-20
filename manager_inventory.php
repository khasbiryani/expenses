<?php
ob_start();
session_start();
//error_reporting(0);
require_once("database_connect.php");
require_once("property_read.php");
if($_SESSION["position"]=="MANAGER"){
require_once('property_read.php');

}	
else
{
echo "<div align='center'><h2 class='fs-title'>Please Log In    <meta http-equiv='refresh' content='2; url=index.php'></h2></div>";
exit();
}
error_reporting(0);

			$branch=$_SESSION['branch'];
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
  	<title>Employees - <?php echo $branch_name;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>	
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	
		         
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href='images/fav-icon.ico'>
		<script src="js/linkExp.js" type="text/javascript">
		</script>
		
		<style>
.days{
	position: sticky;
  left:0 ;
  padding:0px;

  font-size:13px;
  margin:0px;
}
</style>
		<script >
		
		
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
		}}
		
		function plus(id){
			val=document.getElementById(id+'-span').value;
		//alert(val);
		if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.open("POST","inventory_plus.php?id="+id+"&val="+val,true);
			obj.send();
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4 && obj.status==200)
				{
					
					document.getElementById(id+'-span').value=obj.responseText;
				
			}
			}
		}
		function minus(id){
				val=document.getElementById(id+'-span').value;
		//alert(val);
		if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.open("POST","inventory_minus.php?id="+id+"&val="+val,true);
			obj.send();
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4 && obj.status==200)
				{
					
					document.getElementById(id+'-span').value=obj.responseText;
				
			}
			}
			
		}
		function update_inventory(id){
			val=document.getElementById(id+'-span').value;
		//alert(val);
		if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.open("POST","inventory_update.php?id="+id+"&val="+val,true);
			obj.send();
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4 && obj.status==200)
				{
					//alert(obj.responseText);
					document.getElementById(id+'-span').value=obj.responseText;
				
			}
			}
			
		}
		function comm(id){
				comment=document.getElementById(id+'-comment').value;
				//alert(id);
				
		if(window.XMLHttpRequest)
			{
				obj2=new XMLHttpRequest();
			}
			else
			{
				obj2=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj2.open("POST","inventory_comment.php?id="+id+"&val="+comment,true);
			obj2.send();
			obj2.onreadystatechange=function()
			{
				if(obj2.readyState==4 && obj2.status==200)
				{
					
					//document.getElementById(id+'-comment').value=obj2.responseText;
				
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
			   echo "Hi! ".$_SESSION['name'];
			   
			   ?>
            
              
	          </li>
			  
			  
	           
	         
	        
	        
			   <li >
             <a href="#manage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">MANAGE</a>
              <ul class="collapse list-unstyled" id="manage">
               
               
                <li>
                    <a href="manager_inventory.php">Inventory</a>
                </li>
				<li>
                    <a href="settle.php">CASH Registers Settle</a>
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
              
              </ul>
            </div>
          </div>
        </nav>
	
           <div >
		   
    <div class="card card_box"  style='background-color:#fcfcfc;overflow:scroll;padding:5px;'>
	<h3 style='text-align:center;'><b>Inventory</b></h3>
	<span><input type='checkbox' onclick='expand(this.id)' id='expandall'> Expand all</span>
		
	<?php
	$cat_query="select c58,c59,c57 from t108";
	$result = mysqli_query($con, $cat_query);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
				
					echo "<details><summary><span style='font-size:25px;font-weight:bold'>".$row['c58']."</span> (".$row['c59'].")</summary>";
					$cat_id=$row['c57'];
					$inv_query="select c39,c40,c37 from t109 where c57='$cat_id'";
					$result2 = mysqli_query($con, $inv_query);
					echo "<table class='table tabvle-hover'>";
											echo "<thead thead class='thead-dark'><tr><th>Item</th><th>Desc</th><th></th><th>Qty</th><th></th><th>Cmts</th></tr></thead>";
									
					if (mysqli_num_rows($result2) > 0) {
								// output data of each row
								while($row2 = mysqli_fetch_assoc($result2)) {
									$inv_id=$row2['c37'];
									$item=$row2['c39'];
									$item_desc=$row2['c40'];
									
									$branch_query="select c42,c55,c43 from t110 where c37='$inv_id' and c13='$branch' and c57='$cat_id'";
									
									$result3 = mysqli_query($con, $branch_query);
									if (mysqli_num_rows($result3) > 0) {
										
										
									}
									else{
										 $insert="insert into t110 (c37,c57,c39,c40,c55,c13)values('$inv_id','$cat_id','$item','$item_desc','0','$branch')";
										mysqli_query($con, $insert);
									}
									$result4 = mysqli_query($con, $branch_query);
									if (mysqli_num_rows($result4) > 0) {
										while($row4 = mysqli_fetch_assoc($result4)) {
										
										echo "<tr><td>$item</td><td>$item_desc</td>
										<td><img src='images/minus.png' height='25px' class='arrow-prev' width='25px' onclick='minus(this.title)' title='".$row4['c42']."'></td>
										<td><input class='form-control' type='number' value='".$row4['c55']."' id='".$row4['c42']."-span' style='width:75px' onblur='update_inventory(this.name)' name='".$row4['c42']."'></td>
										<td><img src='images/plus.png' class='arrow-prev' height='25px' width='25px' onclick='plus(this.title)' title='".$row4['c42']."'></td>
										<td><input type='text-box' value='".$row4['c43']."' class='form-control' style='width:275px' onblur='comm(this.name)' name='".$row4['c42']."' id='".$row4['c42']."-comment' > </td></tr>";
										}
									}
									
									
								
									
								}
					}
					echo "</table>";
					echo "</details>";
				}

					
				
				}
	
	
	
	

	?>
		
		<div id='result_box'>
		
		</div>
	</div >
	
	</div>
	  
	  </div>
		</div>

    
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  <style>

body{

	background-color:#808080;
}
.card_box{
	padding:2px;
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
.arrow-prev:active{
	opacity:0.5;
	
	transform: translateY(-2px);
}

</style>
</html>