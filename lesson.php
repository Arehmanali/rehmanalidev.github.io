<?php

	//connect to the database
	include "phpScripts/connectSQL.php";

	//Ensure the student is logged in, if not kick them back to the home page
	//and get the username
	include "phpScripts/getUsername.php";
	
	//Get the lesson id from GET array
	$lesson_id = $_GET['id'];

	//Prepare SQL query to get lesson array
	$query = "SELECT * FROM lesson WHERE lesson.lesson_id = $lesson_id;";
	// Query the database and get the result
	$lesson = mysqli_query($con, $query);
	//Get each column from the lesson row
	if ($lesson->num_rows > 0) {
		$lessonRow = $lesson->fetch_assoc();
		$lesson_no = $lessonRow['lesson_no'];
		$unit_id = $lessonRow['unit_id'];
		$course_id = $_SESSION['course_id'];
		$course_name = $_SESSION['course_name'];
		//Parse lesson EML to get HTML
		include "phpScripts/parseEML.php";
		$lesson_html = parseLessonEML($lessonFind, $lessonReplace, $lessonRow['eml']);
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
		<?php include "phpScripts/getNav.php" ?>
		</div>
		<div class="course_wrapper" >
		<!-Display the lesson->
			<section class="course_content">
				<?php 
					echo "<h2 style='text-decoration:underline'>Unit " . $unit_id . " - Lesson " . $lesson_no . "<h2><br>";
					echo html_entity_decode($lesson_html); ?>
			</section>
		</div>
	</div>
</body>
</html>
