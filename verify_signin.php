<?php
ob_start();
session_start();

unset($session_variable);
	// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();


require_once("database_connect.php");



?>