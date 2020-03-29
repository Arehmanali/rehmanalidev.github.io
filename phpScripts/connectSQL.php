<?php
	$con = mysqli_connect("localhost","newuser8","88888888","lms");
					
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
					
?>