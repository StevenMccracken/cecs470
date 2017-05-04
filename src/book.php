#!/usr/local/php5/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>TITLE</title>
		<link rel="stylesheet" type="text/css" href="project.css">
	</head>
	<p>Student Project - not a commercial site.</p>	
   <?php include 'header.php' ?>

	
	<main>
				
		<h1>BOOK A SESSION</h1>
		
		<form method="post" name="" id="" action="">
			<fieldset>
				<legend>Your Information</legend>
					<div id="getCust">
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" class="required" placeholder="required" />	
						<br>
						<br>
						<label for="phone">Phone:</label>
						<input type="text" name="phone" id="phone" class="required" placeholder="required" />	
					</div>
			</fieldset>
			<br>
			<br>
			<fieldset>
				<legend>Service</legend>
					<div id="getService">
						<label for="service">Package: </label>
							<select id="services" class="inline">
							<option>Option1</option>
							<option>Option2</option>
							<option>Option3</option>
							</select>
						<br>
						<br>
						<label for="date">Date:</label>
						<input type="text" name="date" id="date" class="required" placeholder="required" />	
						<br>
						<br>
						<label for="time">Time:</label>
						<input type="text" name="time" id="time" class="required" placeholder="required" />	
						<br>
						<br>
						<label for="special">Special Request:</label>
						<input type="text" name="special" id="special" placeholder="optional" />	
					</div>	
			</fieldset>
			
			<input class="button" name="submit" value="Submit" type="submit">

			
		</form>
		

		<div class="clear"></div>
	</main>
	
   <?php include 'footer.php' ?>	
</html>