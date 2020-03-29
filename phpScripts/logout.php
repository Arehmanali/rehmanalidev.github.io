<?php
	//Start session
	session_start();
	 
	//Clear all session variables
	$_SESSION = array();
	 
	//Destroy session.
	session_destroy();
	 
	// Redirect to bookmark page
	header("location: ../index.html");
	exit;
?>