<?php
	include("Assets/Includes/phpPerformExportCode.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Docu Stack</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--[if lt EI 9]>
		<script src= "http://html5shim.googlecode.com/svn/trunk/html5.js">
		</script>
		<![endif]-->
		
		<link rel = "stylesheet" type = "text/css" href = "assets/siteStyle.css">
		
		<link rel = "icon" type = "image/png" href = "assets/Images/Favicons/favicon.png" sizes = "16x16" />
	</head>
	
	<!--
		Requirements
	
		Create a web application based on PHP + MySQL stack (free to add framework of
			choice on top of that) with following functionalities:
			
		* Allows you to store a set of key/value pairs of different types (strings, numbers, dates)	as documents ------------------------------------
			
		* When saving a document, it should also store some metadata: -------------------------------------------------------------------------------
			- date when document was created
			- date when document was last modified
			- date when document was last exported	
		* Allows you to list all documents stored along with all metadata fields --------------------------------------------------------------------
		* Allows you to update values for existing document by their key ----------------------------------------------------------------------------
		* When updating document, it updates metadata of last modification date ---------------------------------------------------------------------
		* Allows you to delete document -------------------------------------------------------------------------------------------------------------
		* Allows you to export stored document for download as a comma-separated text file with columns being: --------------------------------------
			“key” and “value”. It should also contain “creation date” and “last update date” in it’s first 
			line, before headings and list of fields.
		* Exposes all above functionality over the RESTful web interface ----------------------------------------------------------------------------
		* Please share the project within publicly accessible GIT repository (like Github or Gitlab). -----------------------------------------------
		
		* Bonus requirement: Add ability to export stored document in the same CSV format to a 3rd party cloud --------------------------------------
			storage service of your choice. Exporting the file this way should return publicly accessible URL 
			to that file.
	-->
	
	<?php 		
		include("Assets/Includes/javascriptCode.php");	
	?>	
	
	<body>	
		<!-- Main Content section -->
		<main>
			<nav>	
				DocuStack
			</nav>

			<div class = "preMainContent">
				Welcome to <span class = "greenLetters"> DocumentStack </span>!  
				<br><br><br>
				Your one stop shop for saving and editing a document through the power of MySQL!
				<br><br><br><br>
				Click one of the buttons below to start working!
				
				<div class = "selectionButtonArea">
					<button class = "roundedButton" type="button" onclick = "ToggleWorkOption(1)">Create a new document</button>
					<button class = "roundedButton" type="button" onclick = "ToggleWorkOption(2)">Work with a previous document</button>
				</div>				
			</div>
			
			<div class = "mainContent">				
				<div id = "workArea1">
					<form action = "index.php" method = "GET">
						<textarea id = "newDocumentTextArea" name = "documentText"></textarea>					
					
						<button class = "roundedButton" type = "documentData" name = "submitDocument" value = "true">Submit document</button>					
					</form>
					
					<?php include("Assets/Includes/phpCreateNewCode.php"); ?>
				</div>
				
				<div id = "workArea2">
					<form action = "index.php" method = "GET">
						<button class = "roundedButton" type = "submit" name = "action" value = "previousDocument"> Refresh Table </button>
					</form>
					
					<?php include("Assets/Includes/phpDisplayTableCode.php"); ?>
				</div>
				
				<div id = "workArea3">	
					<form action = "index.php" method = "GET">
						<textarea id = "editDocumentTextArea" name = "updateDocumentText"></textarea>							
					
						<button id = "updateButton" class = "roundedButton" name = "updateElement" value = "0">Update Document</button>	
						<button class = "roundedButton">Cancel</button>	
						
						<?php include("Assets/Includes/phpEditCode.php"); ?>
					</form>
				</div>
				
				<div id = "workArea4">
					<form action = "index.php" method = "GET">
						<textarea id = "exportDocumentTextArea"></textarea>	
					
						<button id = "exportButton" class = "roundedButton" name = "exportElement" value = "0">Export Document</button>
						<button class = "roundedButton">Cancel</button>		

						<?php include("Assets/Includes/phpDisplayExportCode.php"); ?>
					</form>
				</div>
				
				<div id = "workArea5">
					<form action = "index.php" method = "GET">
						<textarea id = "deleteDocumentTextArea"></textarea>					
					
						<button id = "deleteButton" class = "roundedButton" name = "deleteElement" value = "0">Delete Document</button>					
						<button class = "roundedButton">Cancel</button>							
					</form>				
					
					<?php include("Assets/Includes/phpDeleteCode.php"); ?>
				</div>
			</div>
		</main>
		
		<footer>
			Joshua Holland 2019 Formstack Project Site
			<br>
			<br>
			Thanks for checking this out!
		</footer>				
	</body>
</html>
