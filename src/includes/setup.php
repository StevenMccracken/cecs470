<?php
  include 'config.php';

  // if we set $needDB, we get a connection
  if (isset($needDB) and $needDB == true) {
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    $error = mysqli_connect_error();
    if ($error != null) {
      $output = "<p>Unable to connect to database</p>" . $error;
      exit($output);
    }
  }

  
?>
