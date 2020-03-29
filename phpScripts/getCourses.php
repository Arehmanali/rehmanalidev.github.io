<?php

	//connect to the database
	include "connectSQL.php";

	// SQL query to get registered courses for user
	$query = "SELECT course_registration.course_no, course.course_name, course.course_description
			  FROM course
			  INNER JOIN course_registration
			  ON course.course_no = course_registration.course_no
			  AND course_registration.username = '$username';";

	// Query the database and get the result
	$result = mysqli_query($con, $query);

	//Check if any rows returned, display the courses
	if ($result->num_rows > 0) {
		echo "<h3>Your Registered Courses:</h3>";
		while($row = $result->fetch_assoc()) {
			echo "<a class='noStyle' href='course.php?id=" . $row['course_no'] . "&course_name=" . $row['course_name'] . "'>";
			echo "<article class='course'>";
			echo "<h2>" . $row['course_no'] . " - " . $row['course_name'] . "</h2>";
			echo "<span>" . $row['course_description'] . "</span>";
			echo "</article></a>";
		}
	} else {
		echo "<h2>You have not registered for any courses!<h2>"; //If the student has not registered for any courses
		echo "<h3>Follow the link at the top right of the page to register for courses.</h3>";
	}
	
	//Close the connection with the database
	mysqli_close($con);
?>