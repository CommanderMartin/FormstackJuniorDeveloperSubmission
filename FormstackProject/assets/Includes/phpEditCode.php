<?php
	//Check for anything we are listening for in the URL	
	if(isset($_GET['edit']))
	{
		//?edit=1
		$edit = $_GET['edit'];			
		echo("<script>ToggleWorkOption(3)</script>");
		DisplayDocumentEdit($edit);
	}
	else if(isset($_GET['updateDocumentText']))
	{
		//?updateDocumentText=TEXT&updateElement=ELEMENTNUMBER
		$updateDocumentText = $_GET['updateDocumentText'];
		
		if(isset($_GET['updateElement']))
		{
			$updateElement = $_GET['updateElement'];
			
			PerformDocumentEdit($updateElement, $updateDocumentText);
		}
	}
	
	//Displays a previous created document
	function DisplayDocumentEdit($edit)
	{
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
		
		$sql = "SELECT * FROM documenttable WHERE documentid = " . $edit;
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
		
		$documentText = $row["documentdata"];
		
		echo
		("
			<table class = 'documentTable'>
				<tr>
					<th> Document Key </th>
					<th> Creation Date </th>
					<th> Last Edit Date </th>
					<th> Last Export Date </th>
				</tr>
				
				<tr>
					<td>" . $row["documentid"] . "</td>
					<td>" . $row["creationdate"] . "</td>
					<td>" . $row["lastmodifieddate"] . "</td>
					<td>" . $row["lastexportdate"] . "</td>
				</tr>
			</table>
			
			<script>
				//Set text area values
				var textarea = document.getElementById('editDocumentTextArea');
				var documentText = '$documentText';
				textarea.value = documentText;	
				
				//Set update button value
				var exportButton = document.getElementById('updateButton');
				exportButton.value = " . $row["documentid"] . "				
			</script>
		");		
	}

	//Submits the document data to overwrite the selected record
	function PerformDocumentEdit($updateElement, $updateDocumentText)
	{
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
		
		$documentModifiedDate = date("c");		
		
		//First update the export date on the selected row
		$sql = "UPDATE documenttable SET documentdata = '$updateDocumentText', lastmodifieddate = '$documentModifiedDate' WHERE documentid = " . $updateElement;
		
		if(mysqli_query($conn, $sql))
		{
			//echo("Update succeeded");
		}
		else
		{
			//echo("Update failed");
		}
	}
?>















