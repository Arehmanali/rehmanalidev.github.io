<?php

	//connect to the database
	include "connectSQL.php";

	// SQL query to get registered courses for user
	$query = "SELECT *  
			  FROM   course 
			  WHERE course_no NOT IN 
			  (  SELECT course_no 
			  FROM course_registration
			  WHERE course_registration.username = '$username'
			  );";

	// Query the database and get the result
	$result = mysqli_query($con, $query);

	//Check if any rows returned, display the courses
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<a class='noStyle' href='phpScripts/registerCourse.php?id=" . $row['course_no'] . "'>";
			echo "<article class='course'>";
			echo "<h2>" . $row['course_no'] . " - " . $row['course_name'] . "</h2>";
			echo "<span>" . $row['course_description'] . "</span>";
			echo "</article></a>";
		}
	} else {
		echo "<h2>You have registered for all available courses!</h2>"; //If the student has registered for all courses
		echo "<h3>Follow the link at the top right of the page to return to your course page.</h3>";
	}
	
	//Close the connection with the database
	mysqli_close($con);
?>