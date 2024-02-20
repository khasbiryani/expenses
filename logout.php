<?php
error_reporting(0);
session_start();


// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
unset($_COOKIE['position']); 
setcookie('position', null, -1, '/'); 

?>
<meta http-equiv="refresh" content="0;url=index.php">