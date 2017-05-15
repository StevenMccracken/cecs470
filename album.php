#!/usr/local/php5/bin/php-cgi
<?php include 'config.php';
$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$error = mysqli_connect_error();
if ($error != null) {
  $output = "<p>Unable to connect to database</p>" . $error;
  exit($output);
} ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $_GET["Album"] . " " . $_GET["Year"]; ?></title>
		<link rel="stylesheet" type="text/css" href="project.css">
	</head>
<?php include 'include/header.php' ?>

	<main>
   <h1><?php echo $_GET["Album"] . " " . $_GET["Year"]; ?></h1>
   <!--Wrap everything in parent div to get images for modals-->
   <div id="parent_modal">
      <?php
         global $conn;
         $sql = "SELECT Url FROM Photos WHERE Album = '". $_GET["Album"] . "';";
         $result = mysqli_query($conn, $sql);
         if($result=mysqli_query($conn, $sql)) {
            while($rows=mysqli_fetch_assoc($result)) { ?>
              <img class="gallery" src="<?php echo $rows["Url"]; ?>" alt="Photo from the album <?php echo $rows["Album"]; ?>">
				<?php
            }
         mysqli_free_result($result);
         } else { echo "no result<br>";}
         mysqli_close($conn);
         ?>
	</div>
	<div class="clear"></div>
		<!-- The Modal -->
		<div id="myModal" class="modal">
		  <span class="close">&times;</span>
		  <img class="modal-content" id="img01" src="">
		  <div id="caption"></div>
		</div>
	</main>

	<script>
	var modal = document.getElementById('myModal');
	var img = document.getElementById('parent_modal').childNodes;
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	for(var i=0; i<img.length; i++) {
		img[i].onclick = function() {
		 modal.style.display = "block";
		 modalImg.src = this.src;
		 captionText.innerHTML = this.alt;
		}
	}
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	modal.style.display = "none";
	}
	</script>
   <?php include 'include/footer.php' ?>
</html>
