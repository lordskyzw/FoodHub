<?php
	
	$conn = mysqli_connect('localhost','root','','Foodhub');

	if ($conn == false) 
	{
		echo "Database connection failed";
	}
?>