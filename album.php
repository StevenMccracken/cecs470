#!/usr/local/php5/bin/php-cgi
<?php
  $needDB = true;
  $title = $_GET["Album"] . " " . $_GET["Year"];;
	include 'include/setup.php';
	include 'include/header.php';
?>
<main>
  <h1><?php echo $title; ?></h1>
  <!--Wrap everything in parent div to get images for modals-->
  <div id="parent_modal">
    <?php
       global $conn;
       $sql = "SELECT Album, Year, Url FROM Photos WHERE Album = '". $_GET["Album"] . "';";
       $result = mysqli_query($conn, $sql);
       if($result=mysqli_query($conn, $sql)) {
          while($rows=mysqli_fetch_assoc($result)) { ?>
            <img class="gallery" src="<?php echo $rows["Url"]; ?>" alt="Photo from the album <?php echo $rows["Album"] . " " . $rows["Year"]; ?>">
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
	  <img class="modal-content" id="img01" src="" alt="">
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
       modalImg.alt = this.alt;
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
