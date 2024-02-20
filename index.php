<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}


ob_start();
//error_reporting(0);
session_start();

unset($session_variable);
	// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

require_once("property_read.php");
require_once("database_connect.php");
require_once("getip.php");
if (isset($_COOKIE["position"]))
{
	echo $_COOKIE;
	if($_COOKIE["position"]=="ADMIN")
			{
			/////logging
				/*$desc=", Logged in as faculty";
				$query_log="(".$query.")";
				require_once('logging.php');*/
				
				///////
				session_start();
				$_SESSION["position"]="ADMIN";
				header("Location: ./monthlyexp.php");
			}
			else if($_COOKIE["position"]=="MANAGER")
			{
				/*//logging
				$desc=", updating data";
				$query_log='no query';
				require_once('logging.php');
				
				
				/////////*/

				
				session_start();
				$_SESSION["position"]="MANAGER";
				$_SESSION["branch"]=$_COOKIE["branch"];
				header("Location: ./manager_inventory.php");
				//echo "hello Manager ";
			}
			else{
				unset($_COOKIE['position']); 
				setcookie('position', null, -1, '/'); 

			}
}

else if(isset($_POST['pass']))
{
	$verify=0;
	 
	$pass=$_POST['pass'];
		
	
	
	$query="select c1,c2,c12,c13 from t101 where c9='$pass'";
	if($result=mysqli_query($con,$query))
	{
		
		if(($rows=mysqli_num_rows($result))>0)
		{
			session_start();
			
			while ($row = mysqli_fetch_assoc($result)) 
			{
  
				foreach($row as $key=>$field)
				{
					echo " $key $field";
				
					if($key=="c13")
					{
						$_SESSION["branch"]=$field;
						$cookie_name= "branch";
			$cookie_value = $_SESSION["branch"];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 60), "/"); // 86400 = 1 day
					}
					else if($key=="c1")
					{
						$_SESSION["id"]=$field;
						
					}
					else if($key=="c2")
					{
						$_SESSION["name"]=$field;
						
					}
					
					else if($key=="c12")
					{
						
					 $_SESSION["position"]=$field;
					}
				}	
				break;
					
			}
			$cookie_name= "position";
			$cookie_value = $_SESSION["position"];
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			//print_r($_COOKIE);
			if($_SESSION["position"]=="ADMIN")
			{
			
				header("Location: ./monthlyexp.php");
			}
			else if($_SESSION["position"]=="MANAGER")
			{
				
				header("Location: ./manager_inventory.php");
	
			}
		}
	
		else if($id==$property_decode['admin']['id1'][0] && $pass==$property_decode['admin']['pass1'][0])
	{
		
		session_start();
		$_SESSION["admin"]=$id;
		//header("Location: ./read.php?table=t104&name=60");
		echo "hello from admin";
		
		header("Location: ./monthlyexp.php");
	}
	else if($id==$property_decode['admin']['id2'][0] && $pass==$property_decode['admin']['pass2'][0])
	{
		
		
		session_start();
		
		$_SESSION["sub-admin"]=$id;
		//header("Location: ./read.php?table=t104&name=60");
		
		//////logging
											$desc=":, logged in as sub admin";
											$query_log='no query';
										require_once('logging.php');
										
		
		
		
		
		header("Location: sub-admin-index.php",true);
		
		//echo "<script>window.top.location='http://vjitfeedback.com/sub-admin-index.php'</script>";
		echo "hello from subadmin";
		
	}
		
		
	
	else
	{
		echo "<span style='color:red;text-align:center'>Enter Correct Details</span>";
		
	}
	}
		
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SIGN IN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/fav-icon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
		<div style='text-align:center;'>
		<img class="img logo rounded-circle mb-5 logo_lit" width="85px" height="85px"  src="images/logo.png"></div>
			<form class="login100-form validate-form" action='index.php' method='POST'>
				<span class="login100-form-title p-b-37">
					Sign In
				</span>

				
				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="pass" placeholder="ENTER PIN" required pattern="[0-9]*" inputmode="numeric">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<input type='submit' class="login100-form-btn" id='sign_in' value='Sign In'>
						
					
				</div><br>
				<div class="container-login100-form-btn">
				<a href='verify_email.php'>Forgot Password</a>
</div>
				<br>


				
			</form>

			
		</div>
		<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=QmP9YTZStExgtXKrl8RQiGbWteBTpq1TldGEgNherXp1JOpQlWRI6kBhpwxW"></script></span>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
