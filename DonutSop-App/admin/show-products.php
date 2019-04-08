<?php

	// import the common database file
	require "db-admin.php";

	// 3.  MAKE a SQL QUERY
	// make the query
	$query = "SELECT * from products";

	// 4. SEND QUERY TO DB & GET RESULTS
	$results = mysqli_query($conn, $query);

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
	  	<h1> Admin Panel </h1>
		<h2> Products are shown below: </h2>

		<!-- products table -->
		<!-- @TODO: Insert PHP code here -->
		<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
		  <thead>
			<tr>
			  <th class="mdl-data-table__cell--non-numeric">Product</th>
			  <th class="mdl-data-table__cell--non-numeric">Description</th>
			  <th>Unit price</th>
			</tr>
		  </thead>
		  <tbody>
			  <?php
				//@TODO: You need to jumble PHP and HTML code here.

				// loop through the database results
				while( $product = mysqli_fetch_assoc($results) ) {
					echo "<tr>";
						echo "<td class='mdl-data-table__cell--non-numeric'>";
							echo $product["name"];
						echo "</td>";
						echo "<td class='mdl-data-table__cell--non-numeric'>";
							echo $product["product_desc"];
						echo "</td>";
						echo "<td>";
							echo $product["price"];
						echo "</td>";
						echo "<td>";
							echo "<a href='edit-product.php?id=" . $product["id"] . "'>";
								echo "Edit";
							echo "</a>";
						echo "</td>";
						echo "<td>";
							echo "<a href='delete-product.php?id=" . $product["id"] . "'>";
								echo "Delete";
							echo "</a>";
						echo "</td>";
					echo "</tr>";
				}
			  ?>


		  </tbody>
		</table>
		<!-- end table -->

		<br>

		<a href="add-product.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="admin_addProduct">
			+ Add Product
		</a>
	  </div>
	</div>

</body>
</html>

<?php
	// 6. DISCONNECT FROM DATABSE
	mysqli_free_result($results); // clean up your row variable
	mysqli_close($conn);	// close connection to db=
?>
