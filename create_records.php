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


	$jsonIterator = new RecursiveIteratorIterator(
	    new RecursiveArrayIterator(json_decode(urldecode($_GET["record"]), TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
	    if(is_array($val)) {
	        //echo "$key:\n";
	    } else {
	        //echo "$key => $val\n";
	        if($key == "created_at")
	        	$creation_time = $val;
	        elseif ($key == "text") {
	        	$tweet_text = $val;
	        }
	        elseif ($key == "id_str") {
	        	$user_id = $val;
	        }
	        elseif ($key == "name") {
	        	$user_name = $val;
	        }
	        elseif ($key == "location") {
	        	$user_location = $val;
	        }
	        elseif ($key == "favourites_count") {
	        	$favourites_count = $val;
	        }
	        elseif ($key == "lang") {
	        	$user_lang = $val;
	        }
	        elseif ($key == "retweet_count") {
	        	$retweet_count = $val;
	        }
	        elseif ($key == "description") {
	        	$user_description = $val;
	        }
	        elseif ($key == "utc_offset") {
	        	$user_utc_offset = $val;
	        }
	        elseif ($key == "time_zone") {
	        	$user_time_zone = $val;
	        }
	    }
	}

	$sql = "INSERT INTO tweets (tweet_text, creation_time, favourites_count, retweet_count, user_id, user_name, user_location, user_description, user_utc_offset, user_time_zone, user_lang, depression_label)
	VALUES ('".addslashes($tweet_text)."','".addslashes($creation_time)."','".addslashes($favourites_count)."','".addslashes($retweet_count)."','".addslashes($user_id)."','".addslashes($user_name)."','".addslashes($user_location)."','".addslashes($user_description)."','".addslashes($user_utc_offset)."','".addslashes($user_time_zone)."','".addslashes($user_lang)."','0')";
	//echo $sql;

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	    /*$max_creation_time="";
	    $sql = "select max(creation_time) as mct from board where gamer_name='".$_GET["gamer_name"]."'";
	    $result = $conn->query($sql);
	    if ($result->num_rows > 0) {
	    	while($row = $result->fetch_assoc()) {
	    		$max_creation_time = $row["mct"];
	    	}
	    }
	    else
	    {
	    	echo "Error while creating game! Please try again.";
	    }
	    $sql = "select board_id from board where gamer_name='".$_GET["gamer_name"]."' and creation_time='".$max_creation_time."'";
	    $result = $conn->query($sql);
	    if ($result->num_rows > 0) {
	    	while($row = $result->fetch_assoc()) {
	    		//echo "https://ludu.xyz?board_id=".$row["board_id"]."&gamer_name=".$_GET["gamer_name"];
	    		//echo $domain_address."?board_id=".$row["board_id"]."&gamer_name=".$_GET["gamer_name"];
	    		$info = array('board_id' => $row["board_id"], 'game_link' => $domain_address."?board_id=".$row["board_id"]."&gamer_name=".$_GET["gamer_name"]);
	    		echo json_encode($info);
	    	}
	    }*/
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

?>