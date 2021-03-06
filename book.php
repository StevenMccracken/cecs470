#!/usr/local/php5/bin/php-cgi
<?php
	$needDB = true;
	include 'include/setup.php';
	include 'include/header.php';
	include 'include/active.php';
?>
<link rel="stylesheet" type="text/css" href="book.css">
<main>
	<?php
		$nameError = $phoneError = $packageError = $dateError = $timeError = $dateTimeError = '';
		$name = $phone = $selectedPackage = $date = $time = $dateTime = $special = '';

		// Fetch other packages from database
		$packages = array();
		global $conn;
		$sql = "SELECT * FROM cecs470og3.Packages LEFT JOIN cecs470og3.Services ON Packages.Service = Services.ID ORDER BY Packages.ID;";
		$result = mysqli_query($conn, $sql);
		if ($result=mysqli_query($conn, $sql)) {
			while ($rows=mysqli_fetch_assoc($result)) {
				$description = $rows['Type'] . ' - ' . $rows['Name'] . ' ($' . $rows['Price'] . ' for ' . $rows['Duration'] . ' hours)';
				array_push($packages, $description);
			}

			mysqli_free_result($result);
		}

		mysqli_close($conn);

		// Check if the form has been submitted and validate fields
		$validForm = isset($_POST["submit"]);
		if (isset($_POST["submit"])) {
			if (!isset($_POST["name"]) || preg_match('/^[a-zA-Z]+[a-zA-Z\.\-\s]*$/', $_POST["name"]) === 0) {
				$nameError = 'Invalid name';
				$validForm = false;
			} else $name = $_POST["name"];

			if (!isset($_POST["phone"]) || preg_match('/^[2-9]{1}[\d]{9}$/', $_POST["phone"]) === 0) {
				$phoneError = 'Invalid phone number';
				$validForm = false;
			} else $phone = $_POST["phone"];

			if (!isset($_POST["package"]) || $_POST["package"] === '') {
				$packageError = 'Please select a package';
				$validForm = false;
			} else $selectedPackage = $packages[$_POST["package"]];

			// Split date submited into separate parts
			list($year,$month,$day) = explode('-', $_POST["date"]);
			if (!isset($_POST["date"]) || !checkdate($month, $day, $year)) {
				$dateError = 'Please enter a valid date (yyyy-mm-dd)';
				$validForm = false;
			} else $date = $_POST["date"];

			if (!isset($_POST["time"]) || preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $_POST["time"]) === 0) {
				$timeError = 'Please enter a valid time in 24-hour format (hh:mm)';
				$validForm = false;
			} else $time = $_POST["time"];

			// If there are no date or time errors, then check if the requested time is realistic
			if (strlen($dateError) === 0 && strlen($timeError) === 0) {
				$validDateTime = true;

				// Get the hours and minutes from the submitted time
				list($hour,$minute) = explode(':', $_POST["time"]);

				// Get the unix timestamp from the submitted time
				global $sessionTimestamp;
				$sessionTimestamp = strtotime($_POST["date"]) + ($hour * 3600) + ($minute * 60);

				// Check if the requested time is at least 5 days into the future
				$beginningOfToday = strtotime("midnight", time());
				if ($beginningOfToday + 432000 > $sessionTimestamp) {
					$validForm = false;
					$validDateTime = false;
					$dateTimeError = 'You must request an appointment at least 5 days in advance';
				}

				if ($validDateTime) {
					// Date is at least 5 days in the future, so check if it's within normal business hours
					if (($hour < 8 || $hour > 21) || ($hour === 21 && $minute > 0)) {
						$validForm = false;
						$validDateTime = false;
						$dateTimeError = 'Please choose a time between 8 AM and 9 PM';
					}
				}
			}

			$special = $_POST["special"];
		}

		// Save request in DB and display their order information if form is valid
		$savedToDatabase = false;
		if ($validForm) {
			// Get date and time into correct format for DB
			$appointmentDate = date_create();
			date_timestamp_set($appointmentDate, $sessionTimestamp);
			$appointmentDate = date_format($appointmentDate, 'Y-m-d H:i:s');

			// Get values for package and special for DB insertion
			$packageId = $_POST["package"];
			$special = $special != '' ? $special : null;

			// Include setup.php to re-open connection
			include 'include/setup.php';

			// Create INSERT statement
			$stmt = $conn->prepare('INSERT INTO
				cecs470og3.Requests (name, phone, package, date, specialRequest)
				VALUES (?, ?, ?, ?, ?)');

			$stmt->bind_param('ssiss', $name, $phone, $packageId, $appointmentDate, $special);

			// Execute database insert

			if ($stmt->execute()) {
				$savedToDatabase = true;
		    ?>
				<h2>Philip has received your order request</h2><br>
				<div id="summary"><ul>
					<?php
					echo '<li><b>Name: </b>' . $name . '</li>';
					echo '<li><b>Phone number: </b>' . $phone . '</li>';
					echo '<li><b>Package: </b>' . $selectedPackage . '</li>';
					echo '<li><b>Appointment date: </b>' . date('M jS, Y @ g:i A', $sessionTimestamp) . '</li>';
					if ($special !== null) {
						echo '<li><b>Special request: </b>' . $special . '</li>';
					} ?>
				</ul></div>
			<?php
			} else {
		    echo '<h2>Unable to process your request. Please try again</h2><br>';
			}

			$stmt->close();
			mysqli_close($conn);
		}

		if (!$validForm || !$savedToDatabase) {
			// Display the form because it was either incorrect or not submitted
			?>
			<h1>BOOK A SESSION</h1>
			<form method="post" name="book" id="book">
				<fieldset id="top">
					<div id="nameSection" class="section">
						<label for="name">Name</label><br>
						<input type="text" maxlength="50" name="name" id="name" class="required" placeholder="required" pattern=".{2,50}" required value="<?php echo $name; ?>" />
						<br><span><?php echo $nameError; ?></span>
					</div>

					<div id="phoneSection" class="section">
						<label for="phone">Phone</label><span id="subPhone">(10-digit number)</span><br>
						<input type="tel" name="phone" id="phone" class="required" placeholder="required" pattern="^[2-9]{1}[\d]{9}$" maxlength="10" required value="<?php echo $phone; ?>" />
						<br><span><?php echo $phoneError; ?></span>
					</div>
				</fieldset>

				<fieldset id="bottom">
					<div id="packageSection" class="section">
						<label for="packages">Package</label><br>
						<select required name="package" id="packages" class="inline">
							<option value="">Select one</option>
							<?php
								$i = 1;
								foreach ($packages as $package) {
									echo '<option value = ' . $i++;
									if ($selectedPackage === $package) {
										echo ' selected="selected">';
									} else echo '>';

									echo $package . '</option>';
								}
							?>
						</select>
						<br><span><?php echo $packageError; ?></span>
					</div>

					<span><?php echo $dateTimeError; ?></span>

					<div id="dateSection" class="section">
						<label for="date">Date</label><span id="subDate">(yyyy-mm-dd) At least 5 days in advance</span><br>
						<input type="date" name="date" id="date" class="required" required value="<?php echo $date; ?>" />
						<br><span><?php echo $dateError; ?></span>
					</div>

					<div id="timeSection" class="section">
						<label for="time">Time</label><span id="subTime">(24-hour hh:mm)</span><br>
						<input type="time" name="time" id="time" class="required" required value="<?php echo $time; ?>" />
						<br><span><?php echo $timeError; ?></span>
					</div>

					<div id="specialSection" class="section">
						<label for="special">Special Request</label><br>
						<input type="text" name="special" id="special" placeholder="optional" value="<?php echo $special; ?>" />
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
