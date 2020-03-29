<?php

	//connect to the database
	include "phpScripts/connectSQL.php";

	//Ensure the student is logged in, if not kick them back to the home page
	//and get the username
	include "phpScripts/getUsername.php";
	
	//Get the course id from GET array
	$course_id = $_GET['id'];

	//Get the course name from GET array
	$course_name = $_GET['course_name'];
	
	//Set SESSION elements to course_id and course_name
	$_SESSION['course_id'] = $course_id;
	$_SESSION['course_name'] = $course_name;

	//Prepare SQL query to get array of course units
	$query = "SELECT * FROM unit WHERE unit.course_no =" . $_SESSION['course_id'] . ";";
	// Query the database and get the result
	$units = mysqli_query($con, $query);

	

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
        			<li><a href="userpage.php">My Courses</a></li>
        			<li>|</li>
        			<li><a href="phpScripts/logout.php">Logout</a></li>
      			</ul>
    		</nav>
  		</header>
		<section class="course_header">
    		<h2><?php echo $course_id . " - " . $course_name ?></h2>
		</section>
		<div class="sideNav">
		<!-Script to display the navigation heirarchy->
		<?php include "phpScripts/getNav.php"; ?>
		</div>
		<div class="course_wrapper" >
		<!-Display the main page of the course->
			<section class="course_content">
				<h2>Course Description:</h2>
				<?php 
					//Build query to get course details
					$query = "SELECT course.course_description FROM course WHERE course.course_no ='" . $course_id . "';";
					//Query the database to get the details
					$course_details = mysqli_query($con, $query);
					if ($course_details->num_rows > 0) {
						while($detailRow = $course_details->fetch_assoc()) {
							//echo the details of the course
							echo "<span>" . $detailRow['course_description'] . "</span>";
						}
					}
					//Prepare SQL query to get array of units
					$query = "SELECT * FROM unit WHERE unit.course_no ='" . $course_id . "';";
					// Query the database and get the result
					$units = mysqli_query($con, $query);
					//Check if any unit rows returned, display the unit and the unit description
					if ($units->num_rows > 0) {
						while($unitRow = $units->fetch_assoc()) {
							echo "<article style = 'margin-top:60px;margin-left:60px;padding-right:60px'>";
							echo "<br><span style= 'font-weight:bold;border-bottom:1px dashed;font-size:30px;'>Unit " . $unitRow['unit_no'] . "</span>";
							echo "<br><br><span>" . $unitRow['unit_description'] . "</span>";
							echo "</article>";
						}
					}
				?>
			</section>
		</div>
	</div>
</body>
</html>
