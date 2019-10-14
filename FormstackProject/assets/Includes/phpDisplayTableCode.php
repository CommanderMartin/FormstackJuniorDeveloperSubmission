<?php
	//Check for anything we are listening for in the URL	
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
		
		if($action == "previousDocument")
		{
			//?action=previousDocument
			echo("<script>ToggleWorkOption(2)</script>");
		}
	}
	
	LoadDocumentTable();
	
	//Displays all the current documents in the database
	function LoadDocumentTable()
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
		
		$sql = "SELECT * FROM documenttable";	
		
		if($result = mysqli_query($conn, $sql))
		{
			echo("
			<form action = 'index.php' method = 'GET'>			
				<table class = 'documentTable'>
					<tr>
						<th> Document Key </th>
						<th> Document Text </th>
						<th> Creation Date </th>
						<th> Last Edit Date </th>
						<th> Last Export Date </th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
			");
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{			    	
				echo("<tr>
						<td>" . $row["documentid"] . "</td>
						<td>" . $row["documentdata"] . "</td>
						<td>" . $row["creationdate"] . "</td>
						<td>" . $row["lastmodifieddate"] . "</td>
						<td>" . $row["lastexportdate"] . "</td>
						<td> <button class = 'smallRoundedButton type = 'submit' name = 'edit' value = " . $row['documentid'] . "> Edit document </button> </td>
						<td> <button class = 'smallRoundedButton' type = 'submit' name = 'export' value = " . $row['documentid'] . "> Export document </button> </td>
						<td> <button class = 'smallRoundedButton' type = 'submit' name = 'delete' value = " . $row['documentid'] . "> Delete document </button> </td>
					</tr>");		       			        			        
			}
			
			echo("
				</table>
			</form>
			");
		}
		else
		{
			//echo("0 results");
		}
		
		mysqli_close($conn);
	}		
?>








