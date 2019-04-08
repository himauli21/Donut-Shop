<?php
  // 1. WHAT IS YOUR DATABASE INFO?
  $dbhost = "localhost";		// address of your database
  $dbuser = "root";
  $dbpassword = "root";			// on MAMP, this is "root"
  $dbname = "store";

  // 2.  CONNECT TO THE DATABASE
  $conn = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
?>
