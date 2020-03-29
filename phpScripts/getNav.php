<?php
	
	//Prepare SQL query to get array of units
	$query = "SELECT * FROM unit WHERE unit.course_no ='" . $_SESSION['course_id'] . "';";
	// Query the database and get the result
	$units = mysqli_query($con, $query);
	//Check if any unit rows returned, display the unit
	//Save number of rows (used in quizMark.js)
	$unitCount = $units->num_rows;
	if ($units->num_rows > 0) {
		while($unitRow = $units->fetch_assoc()) {
			echo "<span class='navUnit'>Unit " . $unitRow['unit_no'] . "</span>";
			//Build query to get lessons from unit
			$query = "SELECT lesson.lesson_id, lesson.lesson_no FROM lesson WHERE lesson.unit_id ='" . $unitRow['unit_id'] . "' ORDER BY lesson.lesson_no;";
			//Query the database to get the lessons
			$lessons = mysqli_query($con, $query);
			if ($lessons->num_rows > 0) {
				while($lessonRow = $lessons->fetch_assoc()) {
					echo "<a href='lesson.php?id=" . $lessonRow['lesson_id'] . "'>Lesson " . $lessonRow['lesson_no'] . "</a>";
					//Build query to get quiz from lesson
					$query = "SELECT quiz.quiz_id FROM quiz WHERE quiz.lesson_id ='" . $lessonRow['lesson_id'] . "';";
					//Query the database to get the quiz
					$quiz = mysqli_query($con, $query);
					if ($quiz->num_rows > 0) {
						while($quizRow = $quiz->fetch_assoc()) {
							echo "<a href=quiz.php?id=" . $quizRow['quiz_id'] . "&unitNo=" . $unitRow['unit_no'] . "&lessonNo=" . $lessonRow['lesson_no'] .">Quiz</a>";
						}
					}
				}
			}
		}
	} else {
		echo "Course has no units!";
	}
?>