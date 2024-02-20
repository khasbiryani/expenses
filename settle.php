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
			val=document.getElementById(id+'-span').innerHTML;
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
					
					document.getElementById(id+'-span').innerHTML=obj.responseText;
				
			}
			}
		}
		function minus(id){
				val=document.getElementById(id+'-span').innerHTML;
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
					
					document.getElementById(id+'-span').innerHTML=obj.responseText;
				
			}
			}
			
		}
		function comment(id){
				comment=document.getElementById(id+'-comment').value;
				
		if(window.XMLHttpRequest)
			{
				obj=new XMLHttpRequest();
			}
			else
			{
				obj=new ActiveXObject('Microsoft.XMLHTTP');
			}
			obj.open("POST","inventory_comment.php?id="+id+"&val="+comment,true);
			obj.send();
			obj.onreadystatechange=function()
			{
				if(obj.readyState==4 && obj.status==200)
				{
					
					//document.getElementById(id+'-span').innerHTML=obj.responseText;
				
			}
			}
		}
		function calc(){
			
			a100=document.getElementById('c45').value*100;
			a50=document.getElementById('c46').value*50;
			a20=document.getElementById('c47').value*20;
			a10=document.getElementById('c48').value*10;
			a5=document.getElementById('c49').value*5;
			a1=document.getElementById('c50').value*1;
			c25=document.getElementById('c64').value*0.25;
			c10=document.getElementById('c65').value*0.10;
			c5=document.getElementById('c64').value*0.05;
			total=a100+a50+a20+a10+a5+a1+c25+c10+c5;
			alert(total);
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
	
	<form action='settle.php' method='POST'>
		
	<?php
	
$query="select c23, c45,c46,c47, c48,c49,c50,c64,c65,c66,c51,c63,c56,c67,c68,c69,c70 from t111;"; 
	 
		$result = mysqli_query($con, $query);
			
				$result = mysqli_query($con, $query);
				while($key = $result -> fetch_field()-> name){
				if($key=="c44"||$key=='c13'||$key=='c1'){
					continue;
				}
				else if($key=="c23")
				{
					echo '<div class="form-group">';
			echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
				
					echo "<td><input type='Date' name='$key' id='$key' class='form-control'>";
					
				
				}
				else if($key=="c66")
				{
					echo '<div class="form-group">';
			echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
					echo "
				
				
				
				
				 <input type='number' class='form-control' title='$key' id='$key' name='$key' placeholder='Enter ".$property_decode[trim($key)]."' id='$key' required></div>";
				
				echo "	<button class='btn btn-info' onclick='calc()'>Calculate</button>";
				}
				else if($key=="c70")
				{
					echo '<div class="form-group">';
			echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
					echo "
				
				
				
				
				 <input type='text' class='form-control' title='$key' id='$key' name='$key' placeholder='Enter ".$property_decode[trim($key)]."' id='$key'></div>";
				
				
				}
				else
				{
					
					echo '<div class="form-group">';
			echo "<label for='$key'><b>".$property_decode[$key]."</b></label>";
					echo "
				
				
				
				
				 <input type='number' class='form-control' title='$key' id='$key' name='$key' placeholder='Enter ".$property_decode[trim($key)]."' id='$key' required></div>";
				}
			}
		
if($_POST['c23'])
{
	$query='insert into t111 set ';
	foreach($_POST as $key=>$value)
	{
		$query.=$key."='".$value."',";
	}
	 $query.="c13='$branch',c1='".$_SESSION['name']."'";
	mysqli_query($con,$query);
	
}

		?>
		
			
			
			
			<input type="submit" class="btn btn-success" value="Submit"> &nbsp &nbsp 

	
		</form>



		
		</form>
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