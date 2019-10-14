<?php
	$user = 'root';
	$pass = '';
	$db = 'documentstackprojectdb';
	
	$conn = new mysqli('localhost', $user, $pass, $db);
	
	if($conn->connect_error)
	{
		die("Connection Failed: " . $conn->connect_error);
	}
	else
	{
		echo("Connection successful");
	}
?>
