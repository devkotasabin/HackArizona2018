<?php
include 'configurations.php';

try {

	// Create connection
	$conn = mysqli_connect($database_servername, $database_username, $database_password, $database_name);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";

	// sql to create table
	$sql = "DROP TABLE tweets";

	if ($conn->query($sql) === TRUE) {
	    echo "Table tweets dropped successfully";
	} else {
	    echo "Error dropping table: " . $conn->error;
	}

	// sql to create table
	$sql = "CREATE TABLE tweets (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	tweet_text VARCHAR(1000) NOT NULL,
	creation_time varchar(100) NOT NULL,
	favourites_count INT NOT NULL,
	retweet_count INT NOT NULL,
	user_id VARCHAR(100) NOT NULL,
	user_name varchar(100) NOT NULL,
	user_location varchar(100) NOT NULL,
	user_description varchar(1000) NOT NULL,
	user_utc_offset varchar(100) NOT NULL,
	user_time_zone varchar(100) NOT NULL,
	user_lang varchar(30) NOT NULL,
	depression_label INT NOT NULL
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table tweets created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$conn->close();
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>