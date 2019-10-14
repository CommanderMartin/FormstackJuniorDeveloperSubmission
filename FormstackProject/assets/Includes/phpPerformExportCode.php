<?php
	//Check for anything we are listening for in the URL	
	if(isset($_GET['exportElement']))
	{
		//?exportElement=1
		ExportAndDownloadElement($_GET['exportElement']);
	}
	
	//Export the file to a CSV and send to user downloads
	function ExportAndDownloadElement($elementToExport)
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
		
		$documentExportDate = date("c");
		
		
		//First update the export date on the selected row
		$sql = "UPDATE documenttable SET lastexportdate = '$documentExportDate' WHERE documentid = " . $elementToExport;
		
		if(mysqli_query($conn, $sql))
		{
			//echo("Update succeeded");
		}
		else
		{
			//echo("Update failed");
		}		
		
		//Finally export the selected row
		$sql = "SELECT * FROM documenttable WHERE documentid = " . $elementToExport;
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
		
		if($result -> num_rows > 0)
		{
			$delimiter = ",";
			$filename = "docustack_document_" . $row["documentid"] . "_" . date("c") . ".csv";
			
			//Make the file
			$file = fopen("php://memory", "w");
			
			//Add the misc data
			$rowData = array("Creation date: " . $row["creationdate"],"Last modified date: " . $row["lastmodifieddate"],"Last export date: " . $row["lastexportdate"]);
			fputcsv($file, $rowData, $delimiter);
			
			//Make the columns and set them
			$columns = array("key", "value");
			fputcsv($file, $columns, $delimiter);		
			
			//Write the data from the query to the file
			$rowData = array($row["documentid"], $row["documentdata"]);
			fputcsv($file, $rowData, $delimiter);
			
			//Add headers
			fseek($file, 0);
			
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename . '";');
			
			//Send it to the browser
			fpassthru($file);
			
			mysqli_close($conn);

			exit();
		}
	}

	
	/*$acctnumber=$_REQUEST["acctnumber"];
 
	$sql="select loan_number from loans where loan_number='".$acctnumber."'";
	if($db->isEOF($sql)){
		 $error=1;
	 }

	 $arr= array('error'=>$error,'msg'=>$msg);
	 echo json_encode($arr);
	 
	 ob_end_flush();

    
	//get categories//

    $categories="";
    $sqlc="SELECT categories.category
            FROM categories INNER JOIN category_to_portfolio 
            ON categories.categoryid = category_to_portfolio.categoryid
            where category_to_portfolio.portfolioid=".$portfolioid;
			
    $rsc=$db->rsResults($sqlc,1,1);
	
    while($rowc=$db->FetchObject($rsc)){
        $categories.=$rowc->category.", ";
    }
	
    if($categories!=""){
        $categories=substr($categories,0,strlen($categories)-2);
    }
	
    $arr= array('youtubeid'=>$youtubeid,'videotitle'=>$videotitle,'metadescription'=>$metadescription,
    &
	*/

?>




 














