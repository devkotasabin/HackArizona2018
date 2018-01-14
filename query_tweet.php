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

    $sql = $_GET["sql"];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    	while($row = $result->fetch_row()) {
    		//echo "https://ludu.xyz?board_id=".$row["board_id"]."&gamer_name=".$_GET["gamer_name"];
    		//echo $domain_address."?board_id=".$row["board_id"]."&gamer_name=".$_GET["gamer_name"];
    		//$info = array('gamer_name' => $row["gamer_name"], 'gamer2' => $row["gamer2"], 'gamer3' => $row["gamer3"], 'gamer4' => $row["gamer4"], 'status' => $row["status"]);
    		//echo json_encode($info);
            $len = count($row);
            for ($i=0; $i < $len ; $i++) { 
                 echo $row[$i];
                 if($i<=$len-2)
                    echo "|";
             }
             echo "<br>";
    	}
    }
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

?>