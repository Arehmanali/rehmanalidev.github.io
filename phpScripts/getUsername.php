<?php
	
	//Ensure the student is logged in, if not kick them back to the home page
	//Initialize session
	session_start();
	
	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
		header("location: ../index.html");
		exit;
	}
	
	//If they are logged in get their username from the SESSION array
	$username = $_SESSION['username'];

?>