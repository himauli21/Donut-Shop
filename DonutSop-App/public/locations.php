<?php
	// LOGIC => getting all the products from the db
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dbname = "store";

	$conn = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		// GET request received, therefore you should get all locations from db
		$query = "SELECT * from locations";

		$results = mysqli_query($conn, $query);

		$locations = array();
		$count = 0;
		while( $product = mysqli_fetch_assoc($results) ) {
			array_push($locations, $product);
			$count = $count+1;
		}

		// build the JSON response
		$reply  = array("code"=>"1", "message"=>"success", "count"=>$count, "locations"=>$locations);
		

		// send the results as JSON
		sendJSONReply($reply);
		
	}
	else if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// 1. if post request, then make a new item in the database
		// get the inputs from the form
		$name = $_POST["name"];
		$street = $_POST["street"];
		$city = $_POST["city"];
		$province = $_POST["province"];
		$postal_code = "";		//postal code is always blank

		// 2. Setup the query
		$query =
			'INSERT INTO locations (name, street, city, province, postal_code) ' .
			'VALUES ("' .$name . '","' . $street . '","' . $city . '","' . $province . '","' . $postal_code . '")';


		// 3. get results
		$results = mysqli_query($conn, $query);

		if ($results) {
			// reply with a success message
			
			/*
			response looks like this:
				{
					"code":1, 
					"message":"item added"
				}
			*/

			$items = array("code"=>"1", "message"=>"Item added");
			sendJSONReply($items);
			
		}
		else {
			$items = array("code"=>"-1", "message"=>"Error while adding.");
			sendJSONReply($items);
			
			echo mysqli_error($conn);
		}


	}
	else {
		$items = array("code"=>"1", "message"=>"error");
		sendJSONReply($items, 405);
	}

	function sendJSONReply($items, $code=200) {
		// send it back as json

		// set the header
		header("Content-Type: application/json");

		// set the status code
		if ($code != 200) {
			http_response_code($code);
		}

		// set the content
		$json = json_encode($items);

		// deal with errors
		if ($json === false) {
			// sometimes you get an error when converting
			// your data to json format
			$errMsg = array("error"=>json_last_error_msg());
			$json = json_encode($errMsg);
		    // Set HTTP response status code to: 500 - Internal Server Error
		    http_response_code(500);
		}
		echo $json;

	}
?>
