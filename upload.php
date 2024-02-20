<?php
//ob_start();
//session_start();
require_once('property_read.php');
ini_set('max_execution_time', 600);
require_once('database_connect.php');
//error_reporting(0);

//uploading regularsubject file
if($_FILES["regularsubject"]["name"]){
	$target_dir = "./docs/subject_list/regular_subject_list/";
	$target_file = $target_dir . basename($_FILES["regularsubject"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["regularsubject"]["tmp_name"]);
   
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		unlink("./$target_file");
	}
	// Check file size
	if ($_FILES["regularsubject"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "xlsx" ) {
		echo "Sorry, only xlsx file is allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
    if (move_uploaded_file($_FILES["regularsubject"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["regularsubject"]["name"]). " has been uploaded.";
		//logging
		require_once('insert_t106.php');
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t106:file deleted from location";
		require_once('logging_sub_admin.php');
		////
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		 $desc=":file uploading failed";
		require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
		}
}



//updating oe subject file
if($_FILES["oesubject"]["name"]){
$target_dir = "./docs/subject_list/oe_subject_list/";
$target_file = $target_dir . basename($_FILES["oesubject"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["oesubject"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["oesubject"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["oesubject"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["oesubject"]["name"]). " has been uploaded.";
		require_once('insert_t107.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}


//updating pe subject file
if($_FILES["pesubject"]["name"]){
$target_dir = "./docs/subject_list/pe_subject_list/";
$target_file = $target_dir . basename($_FILES["pesubject"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["pesubject"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["pesubject"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["pesubject"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["pesubject"]["name"]). " has been uploaded.";
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
		require_once('insert_t108.php');
		
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t108:file deleted from location";
		

		require_once('logging_sub_admin.php');
    } else {
		
		 $desc=":file uploading failed";
	
		require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}


if($_FILES["facultyassigned"]["name"]){
$target_dir = "./docs/faculty_assigned/faculty_assignment/";
$target_file = $target_dir . basename($_FILES["facultyassigned"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["facultyassigned"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["facultyassigned"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["facultyassigned"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["facultyassigned"]["name"]). " has been uploaded.";
		require_once('upload_subject.php');
		
		
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t103:file deleted from location";
	require_once('logging_sub_admin.php');
    } else {
		 $desc=":file uploading failed";
		
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file faculty.";
    }
}
}




//updating oe student file
if($_FILES["oestudent"]["name"]){
$target_dir = "./docs/OE/";
$target_file = $target_dir . basename($_FILES["oestudent"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["oestudent"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["oestudent"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["oestudent"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["oestudent"]["name"]). " has been uploaded.";
		require_once('insert_t109.php');
		
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t109:file deleted from location";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":file uploading file";
		
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}




//updating pe student file
if($_FILES["pestudent"]["name"]){
$target_dir = "./docs/PE/";
$target_file = $target_dir . basename($_FILES["pestudent"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["pestudent"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["pestudent"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["pestudent"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["pestudent"]["name"]). " has been uploaded.";
		require_once('insert_t110.php');
		
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t110:file deleted from location";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":file uploading file";
		
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}





//updating Spl lab Subject file
if($_FILES["splsubject"]["name"]){
$target_dir = "./docs/SPL-LAB/spl-lab-subject-list/";
$target_file = $target_dir . basename($_FILES["splsubject"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["splsubject"])) {
    $check = getimagesize($_FILES["splsubject"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["splsubject"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["splsubject"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["splsubject"]["name"]). " has been uploaded.";
		require_once('insert_t111.php');
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t111:file deleted from location";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		 $desc=":file uploading file";
		
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}



//updating spl lab student file
if($_FILES["splstudent"]["name"]){
$target_dir = "./docs/SPL-LAB/spl-lab-student-list/";
$target_file = $target_dir . basename($_FILES["splstudent"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["splstudent"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["splstudent"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["splstudent"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["splstudent"]["name"]). " has been uploaded.";
		require_once('insert_t112.php');
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.":data inserted into t112:file deleted from location";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		 $desc=":file uploading file";
		

require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}






//updating student year file
if($_FILES["studentyear"]["name"]){
$target_dir = "./docs/student_year_update/";
$target_file = $target_dir . basename($_FILES["studentyear"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["studentyear"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["studentyear"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["studentyear"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["studentyear"]["name"]). " has been uploaded.";
		require_once("update_student_year.php");
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.": years of student updated in t101";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":file uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}


//Add faculty Photo
if($_FILES["facultyphoto"]["name"]){
$target_dir = "./images/faculty_images/";
$total=count($_FILES["facultyphoto"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["facultyphoto"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats
if($imageFileType != "jpg" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["facultyphoto"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["facultyphoto"]["name"][$i]). " has been uploaded.";
		
		 $desc=":file uploaded to $target_file successfully";
		
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":file uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
}


//updating Faculty Code
if($_FILES["facultycode"]["name"]){
$target_dir = "./docs/";
$target_file = $target_dir . basename($_FILES["facultycode"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["facultycode"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["facultycode"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["facultycode"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["facultycode"]["name"]). " has been uploaded.";
		require_once("update_faculty_unique_codes.php");
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.": years of student updated in t101";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":file uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}





//updating Faculty Code
if($_FILES["facultymail"]["name"]){
$target_dir = "./docs/";
$target_file = $target_dir . basename($_FILES["facultymail"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["facultymail"]["tmp_name"]);
   
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink("./$target_file");
}
// Check file size
if ($_FILES["facultymail"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "xlsx" ) {
    echo "Sorry, only xlsx file is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["facultymail"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["facultymail"]["name"]). " has been uploaded.";
		require_once("update_faculty_mail.php");
		 $desc=":file uploaded to $target_file successfully";
		$desc=$desc.": years of student updated in t101";
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":file uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}

//update php files
if($_FILES["phpfiles"]["name"]){
$target_dir = "./";
$total=count($_FILES["phpfiles"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["phpfiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["phpfiles"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["phpfiles"]["name"][$i]). " has been uploaded.";
		
		 $desc=":file uploaded to $target_file successfully";
		
		

//require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":failed uploading file";
//require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
}



//update Sales files
if($_FILES["salesfiles"]["name"]){
$target_dir = "./docs/sales/";
$total=count($_FILES["salesfiles"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["salesfiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["salesfiles"]["tmp_name"][$i], $target_file)) {
        //echo "The file ". basename( $_FILES["salesfiles"]["name"][$i]). " has been uploaded.";
		
		 //$desc=":file uploaded to $target_file successfully";
		
		


		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 //$desc=":failed uploading file";
//require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
require_once('updates_sales_records.php');
}




//update Payroll files
if($_FILES["payrollfiles"]["name"]){
$target_dir = "./docs/payroll/";
$total=count($_FILES["payrollfiles"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["payrollfiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["payrollfiles"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["salesfiles"]["name"][$i]). " has been uploaded.";
		
		 //$desc=":file uploaded to $target_file successfully";
		
		


		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 //$desc=":failed uploading file";
//require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
require_once('updates_payroll_records.php');
}





//update JS files
if($_FILES["jsfiles"]["name"]){
$target_dir = "./js/";
$total=count($_FILES["jsfiles"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["jsfiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["jsfiles"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["jsfiles"]["name"][$i]). " has been uploaded.";
		
		 $desc=":file uploaded to $target_file successfully";
		
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":failed uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
}


//update XML files
if($_FILES["xmlfiles"]["name"]){
$target_dir = "./xml/";
$total=count($_FILES["xmlfiles"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["xmlfiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["xmlfiles"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["xmlfiles"]["name"][$i]). " has been uploaded.";
		
		 $desc=":file uploaded to $target_file successfully";
		
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":failed uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
}



//update css files
if($_FILES["cssfiles"]["name"]){
$target_dir = "./css/";
$total=count($_FILES["cssfiles"]["name"]);
for($i=0; $i< $total;$i++)
{
$target_file = $target_dir . basename($_FILES["cssfiles"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["cssfiles"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["cssfiles"]["name"][$i]). " has been uploaded.";
		
		 $desc=":file uploaded to $target_file successfully";
		
		

require_once('logging_sub_admin.php');
		//echo '<meta http-equiv="refresh" content="5;url=admin-main.php">';
    } else {
		
		 $desc=":failed uploading file";
require_once('logging_sub_admin.php');
        echo "Sorry, there was an error uploading your file Subject.";
    }
}
}
}





/*
if($_SESSION['position']==6)
{
	echo "<div align='center' style='margin:10px;'> In 3 seconds You will be redirected, Please wait...</div>";
	header("Location: faculty-aut.php");
	echo '<meta http-equiv="refresh" content="3;url=faculty-aut.php">';
	//print_r($_SESSION);
}
else
{
	echo "<div align='center' style='margin:10px;'><a href='manage_database.php'>click here</a> to go back to manage database page.</div>";
	//echo '<meta http-equiv="refresh" content="2;url=manage_database.php">';
	
}
//echo '<meta http-equiv="refresh" content="2;url=manage_database.php">';

*/


?>