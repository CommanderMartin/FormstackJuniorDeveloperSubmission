<?php	
	//Check for anything we are listening for in the URL	
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
		
		if($action == "createDocument")
		{
			//?action=createDocument
			echo("<script>ToggleWorkOption(1)</script>");
			
			if(isset($_GET['documentText']))
			{
				//?action=createDocument&documentText=TEXT
				$documentText = $_GET['documentText'];
				PopulateDocumentTextField($documentText);
			}			
		}		
	}	
	else if(isset($_GET['documentText']))
	{
		//?documentText=testing&submitDocument=true
		$documentText = $_GET['documentText'];
		
		if(isset($_GET['submitDocument']))
		{
			CreateDocument($documentText);			
		}
	}
	
	//Create a new document with the user's text and fill in the other date values
	function CreateDocument($documentText)
	{
		//echo $documentText; //"<script>console.log('" . json_encode($documentText) . "');</script>";  
		
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
		
		$documentCreationDate = date("c");
		//echo($documentCreationDate);
		
		$sql = "INSERT INTO documentTable (documentdata, creationdate, lastmodifieddate)
		VALUES ('$documentText','$documentCreationDate','$documentCreationDate')";			
		
		if(mysqli_query($conn, $sql))
		{
			//echo("document added");
		}
		else
		{
			echo("error: " . $sql . "<br>" . mysqli_error($conn));
		}
		
		
		
		$newid = mysqli_insert_id($conn);
		AddDataToLog($conn, $newid, 1);		
		
		
		mysqli_close($conn);
	}
	
	//Populate the text field with the data in the URL
	function PopulateDocumentTextField($documentText)
	{	
		echo
		("
			<script>
				var textarea = document.getElementById('newDocumentTextArea');
				var documentText = '$documentText';
				textarea.value = documentText;	
			</script>
		");
	}
	

	function AddDataToLog($conn, $newid, $created = 0)
	{
		$sql = "INSERT INTO documentversions (documentid, versiondate, created)
		VALUES ($newid, now(), $created)";
		
		if(mysqli_query($conn, $sql))
		{
			//echo("document updated");
		}
		else
		{
			echo("error: " . $sql . "<br>" . mysqli_error($conn));
		}
	}


	
		
?>