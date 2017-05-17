<?php
  session_start();
  include 'config.php';

  // useful if the page are in a nested folder (admin)
  if (!isset($path)) {
    $path = './';
  }

  // get the status
  $isLog = false;
  if (isset($_SESSION['auth']) && $_SESSION['auth']) {
    $isLog = true;
  }

  // if we set $protected, we need to be authenticated
  if (isset($protected) and $protected == true) {
    if (!isLog) {
      header('location:' . $path . 'admin/login.php');
      exit(0);
    }
  }

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
