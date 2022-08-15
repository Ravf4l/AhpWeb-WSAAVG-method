<?php
	// connection
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'ahp_6';

	$conn = mysqli_connect($host,$username,$password);

	if (!$conn)
	{
		echo "Can't connect to the server";
		exit();
	}

	if(!mysqli_select_db($conn, $database))
	{
		echo "Database not available";
		exit();
	}
?>