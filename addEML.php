<?php

	//Start session
	session_start();
	
	//Check if the user is Administrator, if not then direct them to the user page
	if($_SESSION["username"] !== 'Administrator'){
		header("location: ../userpage.php");
		exit;
	}

	//Check if the form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Connect to the database
		include "phpScripts/connectSQL.php";
		
		//Get the EML from the POST array
		$eml = $_POST['eml'];
		
		//Escape the EML string so that it can be inserted into the database
		$eml = mysqli_real_escape_string($con, $eml);
		
		//Get lesson or quiz
		$eml_type = $_POST['eml_type'];
		
		//Determine parent type
		//If quiz
		if($eml_type == 'quiz'){
			//Check if the lesson already has a quiz
			//Prepare a select statement to look for the username
			$query = "SELECT * FROM quiz WHERE quiz.lesson_id = '" . $_POST['lesson_id'] . "'";
			
			//Query the database
			$rowExists = mysqli_query($con, $query);
			//Build to query to insert the EML into the database
			$query = "INSERT INTO quiz (lesson_id, eml) VALUES ('" . $_POST['lesson_id'] . "', '" . $eml . "');";
		//If lesson
		} else {
			//Check if the unit already has a lesson with that lesson number
			//Prepare a select statement to look for the lesson number in the unit
			$query = "SELECT * FROM lesson WHERE lesson.unit_id = '" . $_POST['unit_id'] . "' AND lesson.lesson_no = '" . $_POST['lesson_no'] . "'";
			//Query the database
			$rowExists = mysqli_query($con, $query);
			//Build to query to insert the EML into the database
			$query = "INSERT INTO lesson (unit_id, lesson_no, eml) VALUES ('" . $_POST['unit_id'] . "','" . $_POST['lesson_no'] . "','" . $eml . "');";
		}
		
		if($rowExists->num_rows === 0){
			//Query the database
			$result = mysqli_query($con, $query);
			//Check if the query was successful
			if($result){
				echo '<script>';
				echo 'alert("EML entered successfully!")';
				echo '</script>';
			}else{
				echo '<script>';
				echo 'alert("EML entry failed!")';
				echo '</script>';			
			}
		}else{
			echo '<script>';
			echo 'alert("Entry already exists!")';
			echo '</script>';
		}
		//Protect against data being re-entered into database if user refreshes page
		unset($_POST);
		//echo "<script>window.location.href='addEML.php'</script>";
		
	}

?>



<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online Learning Management System</title>
<link href="css/singlePageTemplate.css" rel="stylesheet" type="text/css">
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
<script type="text/javascript" src="javascript/formValidator.js"></script>
</head>
<body>
	<div class="container"> 
		<header> 
    		<a href="index.html">
    			<h4 class="logo">Online Learning Management System</h4>
    		</a>
    		<nav>
      			<ul>
        			<li><a href="phpScripts/logout.php">Logout</a></li>
      			</ul>
    		</nav>
  		</header>
		<section class="header_section">
    		<h2>Welcome, <span class="light">Administrator</span></h2>
		</section>
		<div class="content_wrapper" >
			<section class="courses">
				<article class="EMLAdder">
					<form id="emlForm" action="addEML.php" method="post">
						Lesson:<input type='radio' name='eml_type' value='lesson'><br>
						What is the lesson number:<input type="text" name="lesson_no"><br>
						What is the unit ID of the unit this lesson belongs to:<input type="text" name="unit_id"><br>
						Quiz:<input type='radio' name='eml_type' value='quiz'><br>
						What is the lesson ID of the lesson this quiz belongs to:<input type="text" name="lesson_id"><br>
						<textarea form="emlForm" name="eml" style="height:600px; width:1100px;"></textarea><br>
						<input type="submit" name="submit" />
					</form>
				</article>
			</section>
		</div>
	</div>
</body>
</html>
