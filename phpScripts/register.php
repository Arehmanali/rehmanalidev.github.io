<?php

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//connect to the database
		include "connectSQL.php";
		
		//Input has already been checked by the form validating script
		//so we know it contains content
		//Define and initialize variables
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$address = $_POST['address'];
		$phone_no = $_POST['phone_no'];
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		//We now need to check if the username already exists in the database
		
		//Prepare a select statement to look for the username
		$query = "SELECT student.username FROM student WHERE student.username = '$username'";
		
		//Query the database
		$result = mysqli_query($con, $query);
		
		//If the number of rows return is above 0 then the username already exists
		if($result->num_rows > 0){
			echo '<script language="javascript">';
			echo 'alert("Username already exists, please try again!")';
			echo '</script>';
			header("location: ../index.html");
		} else { //if username doesn't exist we can enter it into the database
			
			//Prepare the SQL statement
			$query = "INSERT INTO student (first_name, last_name, address, phone_no, username, password)
			VALUES ('" . $first_name . "','" . $last_name . "','" . $address . "','" . $phone_no . "','" . $username . "', '" . $password . "');";

			if ($con->query($query) === TRUE) {
				echo '<script language="javascript">';
				echo 'alert("New user created successfully!")';
				echo '</script>';
				session_start();              
				//Store the user data in session variables
				$_SESSION["loggedin"] = true;
				$_SESSION["username"] = $username;
				header("location: ../userpage.php");
			} else {
				echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		$con->close();
	}
?>