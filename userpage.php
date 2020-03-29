<?php
	
	//Ensure the student is logged in, if not kick them back to the home page
	//and get the username
	include "phpScripts/getUsername.php";

	//Connect to the database
	include "phpScripts/connectSQL.php";

	//Query the database to get the students first name
	$query = "SELECT student.first_name FROM student WHERE student.username = '$username';";
	$result = mysqli_query($con, $query);
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$first_name = $row['first_name'];
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
        			<li><a href="courseRegistration.php">Register For Courses</a></li>
        			<li>|</li>
        			<li><a href="phpScripts/logout.php">Logout</a></li>
      			</ul>
    		</nav>
  		</header>
		<section class="header_section">
    		<h2>Welcome, <span class="light"><?php echo $first_name ?></span></h2>
		</section>
		<div class="content_wrapper" >
			<section class="courses">
				<?php include "phpScripts/getCourses.php" ?>
			</section>
		</div>
	</div>
</body>
</html>
