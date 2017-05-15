#!/usr/local/php5/bin/php-cgi
<?php
	include 'include/setup.php';
	include 'include/header.php';
	include 'include/active.php';
?>
<main>

	<h1>BOOK A SESSION</h1>

	<?php
		$success = false;
		$phoneRegex = '^([2-9]{3})([\-\.]?)(\d{3})\2?(\d{4})$';
		$nameError = $phoneError = '';
		$name = $phone = '';

		// Check if the form has been submitted and validate fields
		if (isset($_POST["submit"])) {
			// Assume the fields have been filled out correctly
			$validFields = true;

			if (!isset($_POST["name"]) || !preg_match('/^[a-zA-Z]+[a-zA-Z\.\-\s]*$/', $_POST["name"])) {
				$nameError = 'Invalid name';
				$validFields = false;
			} else $name = $_POST["name"];

			// FIXME: Regex doesn't work even for valid formats
			if (!isset($_POST["phone"]) || !preg_match('/^([2-9]{3})([\-\.]?)(\d{3})\2?(\d{4})$/', $POST_["phone"])) {
				$phoneError = 'Invalid phone number';
				$validFields = false;
			} else $phone = $_POST["phone"];
		}

		// If the form submission was successful, display a different page
		if ($success) {
			echo 'ayy';
		} else {
			// Display the form because it was either incorrect or not submitted
			?>
			<form method="post" name="" id="" action="">
				<fieldset>
					<legend>Your Information</legend>
					<div id="getCust">
						<label for="name">Name:</label>
						<input type="text" name="name" id="name" class="required" placeholder="required" value=" <?php echo $name; ?>" />
						<span><?php echo $nameError; ?></span><br><br>

						<label for="phone">Phone:</label>
						<input type="tel" name="phone" id="phone" class="required" placeholder="required" pattern="^([2-9]{3})([\-\.]?)(\d{3})\2?(\d{4})$" value=" <?php echo $phone; ?>">
						<span><?php echo $phoneError; ?></span>
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
		<?php
		}
	?>

	<div class="clear"></div>
</main>
<?php include 'include/footer.php' ?>
