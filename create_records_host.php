<?php
include 'configurations.php';
//$string = file_get_contents("tweetdata.txt");
//echo memory_get_usage();
//echo ini_get('memory_limit');
//echo phpinfo();
ini_set('memory_limit','-1');
$string = file_get_contents($_GET["file_name"]);
$i=1;
$c = 0;
while ($i<strlen($string)) {
	$count_brackets = 1;
	$record = '{';
	while ($count_brackets!=0) {
		if ($string[$i]=='{') {
			$count_brackets = $count_brackets +1;
		}
		elseif ($string[$i]=='}') {
			$count_brackets = $count_brackets -1;
		}
		$record .= $string[$i];
		$i = $i+1;
	}
	echo file_get_contents($server_address."create_records.php?record=".urlencode($record));
	//error_log("http://cgi.cs.arizona.edu/~abureyanahmed/create_board.php?gamer_name=".$_GET["gamer_name"], 0);
	$c = $c +1;
	//echo $c;
	//echo "<br>";
	/*if ($c==1649) {
		echo "*********";
		echo substr($string, $i, 3);
		break;
	}*/
	$i = $i+3;
}
?>