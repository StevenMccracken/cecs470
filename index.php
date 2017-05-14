#!/usr/local/php5/bin/php-cgi
<?php
  $needDB = true;
  include 'include/setup.php';
?>

<?php include 'include/header.php' ?>
<main>
    <?php
       global $conn;
       $headers = ["PORTRAITS", "EVENT PHOTOGRAPHY", "GRADUATION SHOOTS"];
       $sql = "SELECT * FROM Albums;";
       $result = mysqli_query($conn, $sql);
       $i = 0; //counter for header logic
       if($result=mysqli_query($conn, $sql)) {
          while($rows=mysqli_fetch_assoc($result)) {
             if($i%3 == 0) {
                 echo "<h1>".$headers[$i/3]."</h1>";
             } ?>
             <a href="album.php?album=<?php echo $rows["Name"]; ?>&year=<?php echo $rows["Year"] ?> ">
                <img class="gallery" src="<?php echo $rows["CoverUrl"]; ?>" alt="<?php echo $rows["Name"] . " " . $rows["Year"]; ?>">
             </a>
          <?php
             $i++;
          }
          mysqli_free_result($result);
       } else { echo "no result<br>"; }
       mysqli_close($conn);
       ?>

	<div class="clear"></div>
</main>
<?php include 'include/footer.php' ?>
