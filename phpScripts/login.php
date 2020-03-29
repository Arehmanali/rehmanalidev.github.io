<?php
	
	//Start session
	session_start();
	
	//Check if the user is already logged in, if so then direct them to the user page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: ../userpage.php");
		exit;
	}

	//Check if the form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Initialize the session
		session_start();

		//Connect to the database
		include "connectSQL.php";
		
		//Input has already been checked by the form validating script
		//so we know it contains content
		//Define and initialize variables
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		//We now need to check if the username and password pair exist in the database
		
		//Prepare a select statement to look for the username and password combination
		$query = "SELECT student.username FROM student WHERE student.username = 
				 '$username' AND student.password = '$password';";
		
		//Query the database
		$result = mysqli_query($con, $query);
		
		//If the number of rows returned is above 0 then the username and password combination exists
		if($result->num_rows > 0){
			echo '<script language="javascript">';
			echo 'alert("Logging in!")';
			echo '</script>';
			session_start();              
			//Store the user data in session variables
			$_SESSION["loggedin"] = true;
			$_SESSION["username"] = $username;
			//Check if user is Administrator
			if($username == 'Administrator'){
				header("location: ../addEML.php");
			}else{
			//Direct the user to the user page
			header("location: ../userpage.php");
			}
		} else { //if student id and password combination does not exist
		
			echo '<script language="javascript">';
			echo 'alert("Incorrect username/password combination!")';
			echo '</script>';
			header("location: http://google.ca");
		}
		$con->close();
	} else {
		echo '<script language="javascript">';
			echo 'alert("POST error!")';
			echo '</script>';
	}
?>