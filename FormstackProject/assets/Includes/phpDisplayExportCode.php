<?php
	//Check for anything we are listening for in the URL	
	if(isset($_GET['export']))
	{
		//?export=5
		$export = $_GET['export'];
		echo("<script>ToggleWorkOption(4)</script>");
		DisplayDocumentExport($export);
	}
	
	//Displays a previous created document
	function DisplayDocumentExport($export)
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
		
		$sql = "SELECT * FROM documenttable WHERE documentid = " . $export;
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
		
		if($result -> num_rows > 0)
		{
		
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
					var textarea = document.getElementById('exportDocumentTextArea');
					var documentText = '$documentText';
					textarea.value = documentText;	
					textarea.readOnly = true;
					
					//Set export button value
					var exportButton = document.getElementById('exportButton');
					exportButton.value = " . $row["documentid"] . "
				</script>
			");		
		}
		else
		{
			//echo("no results");
		}			
		
		mysqli_close($conn);
	}
?>
















	