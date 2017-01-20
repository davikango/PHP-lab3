<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Main Directory</title>
	<link rel="stylesheet" type="text/css" href="website.css"/>
	<link rel="stylesheet" type="text/css" href="contactsDir.css"/>
</head>
<body>
<div id="container">
	<div id="header">
	 
			<?php 
				define(ROOT, '../');
				include_once ROOT. 'header.php';
			?>
		

	</div>

	<div id="labspractica">
	
		 <?php 
			include_once ROOT. 'menu.inc';
		?>
			
		
	</div>
	
	<div id="labcontent">
			<div class="directory">
				<h1>Online Contacts Directory</h1>
				<h3>Search for a Contact</h3>
				<form method="post" action="contacts.php">
					<p>First Name <input type = "text" name= "firstName"/><br/><br />
					Last Name <input type = "text" name= "lastName"/></p><br/>
					<input type = "submit" name="Search" value = "Search" />
				</form>
				<hr />
				<a href="addContact.php">Add New Contact Entry</a>
			</div>
	</div>
		
	<div id="footer">
		 
		<?php 
			include_once ROOT. 'footer.inc';
		?>	
		
	</div>

</div>

</body>
</html>