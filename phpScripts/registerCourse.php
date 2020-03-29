<?php
	
	//Ensure student is logged in and get username
	include "getUsername.php";
	
	//Get the course_id from GET array
	$course_id = $_GET['id'];

	//Connect to the database
	include "connectSQL.php";

	//Prepare query to add course registration
	$query = "INSERT INTO course_registration (username, course_no)
			  VALUES ('" . $username . "','" . $course_id . "');";

	//Add the course registration to the database
	$result = mysqli_query($con, $query);

	if($result){
		header("location: ../courseRegistration.php");
	} else {
		echo "<h1>ERROR!</h1>";
	}

	
?>