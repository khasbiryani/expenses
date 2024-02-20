<?php

require_once("property_read.php");
require_once("database_connect.php");

if(isset($_POST['email']))
{
	 
	 $email=$_POST['email'];
	

	if ($email!="aurora.il@myperiperi.com"){
		echo "<span style='color:red;text-align:center'>Wrong Email</span>";
	}
	else{
	echo '<meta http-equiv="refresh" content="0;url=mail.php">';
		
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Verify Email Address</title>
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
			<form class="login100-form validate-form" action='verify_email.php' method='POST'>
			<span class="login100-form-title p-b-37">
					Verify Email Address
				</span>

				
				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter email">
					<input class="input100" type="email" name="email" placeholder="a*****.**@**peri****.com"  focus>
					<span class="focus-input100"></span>
				</div>
				

				<div class="container-login100-form-btn">
					<input type='submit' class="login100-form-btn" id='sign_in' value='Sign In'>
						
					
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
