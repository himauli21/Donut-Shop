<?php

	// import the databse
	include("db-admin.php");

	// get the inputs from the form
	$name = $_POST["name"];
	$desc = $_POST["desc"];
	$price = $_POST["price"];

	$query =
		'INSERT INTO products (name, product_desc, price) ' .
		'VALUES ("' .$name . '","' . $desc . '","' . $price . '")';

	// 3. get results
	$results = mysqli_query($conn, $query);

	if ($results) {
		echo "OKAY! <br>";
	}
	else {
		echo "BAD! <br>";
		echo mysqli_error($conn);
	}

?>
<!DOCTYPE html5>
<html>
<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<style type="text/css">
		.mdl-grid {
			max-width:1024px;
			margin-top:40px;
		}

		h1 {
			font-size:36px;
		}
		h2 {
			font-size:30px;
		}
	</style>

</head>
<body>

	<div class="mdl-grid">
	  <div class="mdl-cell mdl-cell--12-col">
		<p> Put some messages here? </p>

		<a href="show-products.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			< Go Back
		</a>
	  </div>
	</div>

</body>
</html>
