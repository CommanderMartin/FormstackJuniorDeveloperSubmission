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
		//echo("Connection successful");
	}

	$sql = "SELECT * FROM documenttable";
	$result = mysqli_query($conn, $sql);
	$row = $result->fetch_assoc();
	
	$documentID = $row['documentid'];
	$documentData = $row['documentdata'];
	
	//array of key value pairs
	$array = array('documentid' => $documentID, 'documentData' => $documentData);
	
	echo(json_encode($array));
	
	
	
	
	
	
?>