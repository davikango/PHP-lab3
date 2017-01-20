<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>contacts</title>
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
			 <?php
				
						if(isset($_POST['addEntry'])){
							if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address'])
									&& !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])){
										
										$firstName = $_POST['firstName'];
										$lastName = $_POST['lastName'];
										$email = $_POST['email'];
										$phone = $_POST['phone'];
										$address = $_POST['address'];
										$city = $_POST['city'];
										$state = $_POST['state'];
										$zip = $_POST['zip'];
										$newContact = "$firstName,$lastName,$email,$phone,$address,$city,$state,$zip.\n";
										
										$handle = fopen("contacts.txt","at");
										if($handle == false){
											echo "The directory text file does not exist.";
										}else if(flock($handle,LOCK_EX && LOCK_SH)){
														if(fwrite($handle, $newContact) > 0){
															echo "<p> $firstName $lastName  has been successfully saved!</p>"; 
														}else{
															echo "<p>Error, could not add contact";
														}
												flock($handle, LOCK_UN);
											   }else{
													echo "<p>Cannot lock and write to the file, please try again later</p>";
												}
										fclose($handle);										
							}
							else{
								echo "<p>You must enter a value in each field. Click your browser's Back button to return to the form.</p>";		
							}			
						}
						
						if(isset($_POST['Search'])){
							if(!empty($_POST['firstName']) && !empty($_POST['lastName'])){
								$firstName = $_POST['firstName'];
								$lastName = $_POST['lastName'];
		
								
								$handle = fopen("contacts.txt","r");
									$wholeContact = fgets($handle);
									
									while(!feof($handle)){
										$curContact = explode(",", $wholeContact);																		
										if(strcmp($firstName,$curContact[0]) == 0 && strcmp($lastName,$curContact[1] == 0)){
											
											echo "Search was successful, we have a Match!"; ?>
											
											<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
												<p>First Name <input type = "text" name= "firstName" value="<?php echo $curContact[0];?>"/>
												&nbspLast Name <input type = "text" name= "lastName" value="<?php echo $curContact[1];?>"/><br/><br/>
												Email Address <input type = "text" name= "email" value="<?php echo $curContact[2];?>"/><br/><br/>
												Phone Number <input type = "text" name= "phone" value="<?php echo $curContact[3];?>"/><br/><br/>
												Address <input type = "text" name= "address" value="<?php echo $curContact[4];?>"/>
												&nbspCity <input type = "text" name= "city" value="<?php echo $curContact[5];?>"/><br/><br/>
												State <select name="state" size="1" value="<?php echo $curContact[6];?>">
												  <option value="AL">Alabama</option>
												  <option value="AK">Alaska</option>
												  <option value="AZ">Arizona</option>
												  <option value="AR">Arkansas</option>
												  <option value="CA">California</option>
												  <option value="CO">Colorado</option>
												  <option value="CT">Connecticut</option>
												  <option value="DE">Delaware</option>
												  <option value="DC">Dist of Columbia</option>
												  <option value="FL">Florida</option>
												  <option value="GA">Georgia</option>
												  <option value="HI">Hawaii</option>
												  <option value="ID">Idaho</option>
												  <option value="IL">Illinois</option>
												  <option value="IN">Indiana</option>
												  <option value="IA">Iowa</option>
												  <option value="KS">Kansas</option>
												  <option value="KY">Kentucky</option>
												  <option value="LA">Louisiana</option>
												  <option value="ME">Maine</option>
												  <option value="MD">Maryland</option>
												  <option value="MA">Massachusetts</option>
												  <option value="MI">Michigan</option>
												  <option value="MN">Minnesota</option>
												  <option value="MS">Mississippi</option>
												  <option value="MO">Missouri</option>
												  <option value="MT">Montana</option>
												  <option value="NE">Nebraska</option>
												  <option value="NV">Nevada</option>
												  <option value="NH">New Hampshire</option>
												  <option value="NJ">New Jersey</option>
												  <option value="NM">New Mexico</option>
												  <option value="NY">New York</option>
												  <option value="NC">North Carolina</option>
												  <option value="ND">North Dakota</option>
												  <option value="OH">Ohio</option>
												  <option value="OK">Oklahoma</option>
												  <option value="OR">Oregon</option>
												  <option value="PA">Pennsylvania</option>
												  <option value="RI">Rhode Island</option>
												  <option value="SC">South Carolina</option>
												  <option value="SD">South Dakota</option>
												  <option value="TN">Tennessee</option>
												  <option value="TX">Texas</option>
												  <option value="UT">Utah</option>
												  <option value="VT">Vermont</option>
												  <option value="VA">Virginia</option>
												  <option value="WA">Washington</option>
												  <option value="WV">West Virginia</option>
												  <option value="WI">Wisconsin</option>
												  <option value="WY">Wyoming</option>
												</select>
												&nbspZip <input type = "text" name= "zip" value="<?php echo $curContact[7];?>"/></p><br/>
												<input type = "submit" name="updateEntry" value = "Update Entry" />
											</form>
			<?php
											break;
										}else{										
											$wholeContact = fgets($handle);
										}
										
									}
									if(feof($handle)){
										echo "Sorry we could not find anyone with the name: \"$firstName $lastName\"";
									}
									
								fclose($handle);
							}else{
								echo "<p>You must enter a value in each field. Click your browser's Back button to return to the form.</p>";
							}						
						}
						
						if(isset($_POST['updateEntry'])){
							if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address'])
									&& !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])){
										
										$firstName = $_POST['firstName'];
										$lastName = $_POST['lastName'];
										$email = $_POST['email'];
										$phone = $_POST['phone'];
										$address = $_POST['address'];
										$city = $_POST['city'];
										$state = $_POST['state'];
										$zip = $_POST['zip'];
										$updatedContact = "$firstName,$lastName,$email,$phone,$address,$city,$state,$zip\n";
										$explodedUpdatedContact = explode(",",$updatedContact);
										
										$handle = fopen("contacts.txt","r+t");
										if($handle == false){
											echo "The directory text file does not exist.";
										}else{
													if(flock($handle,LOCK_EX && LOCK_SH)){
															
															$curLine = fgets($handle);
															while(!feof($handle)){
																$curContact = explode(",", $curLine);	
														
																if(strcmp($firstName,$curContact[0]) == 0 && strcmp($lastName,$curContact[1] == 0)){
																							
																	if(fwrite($handle, implode(",",str_replace($curContact,$explodedUpdatedContact,$curContact))) > 0){
																		echo "<p> $firstName $lastName  has been successfully updated!</p>"; 
																	}else{
																		echo "<p>Error, could not update contact";
																	}
																	break;
																}else{
																		$curLine = fgets($handle);
																}
															}		
														flock($handle, LOCK_UN);
													}else{
															echo "<p>Cannot lock and write to the file, please try again later</p>";
													}
													fclose($handle);																			
										}					
							}else{
								echo "<p>You must enter a value in each field. Click your browser's Back button to return to the form.</p>";		
							}			
						}
						
			?>
						
			
						<hr />
						<br /><a href="index.php">Return to Directory</a>
			
						 
				
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