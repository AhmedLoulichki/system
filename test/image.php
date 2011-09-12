<?php

require_once '../classes/variables.php';

if(empty($_GET['id'])){
	echo "A valid imageID is required to display the image.";
	exit;
}


$imageID = $_GET['id'];

mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD) or die("Couldnt connect to mysql!<br />" . mysql_error());
mysql_select_db(DBNAME) or die("Couldnt select database!<br />" . mysql_error());

$sql = "SELECT * FROM upload WHERE id = '$imageID'";
$result = mysql_query($sql) or die('Error, query failed<br />' . mysql_error());

if($result == true && mysql_num_rows($result) == 1){

	$row = mysql_fetch_array($result);
	
	$type = $row['type'];
	$content = $row['content'];
	
	header('Content-type: ' . $type);
	echo $content;
	
} else {
	echo "That imageID doesn't exist.";
	exit;
}


/*

$sql = "SELECT * FROM upload ORDER BY id DESC";

$result = mysql_query($sql) or die('Error, query failed<br />' . mysql_error());

if($result !== false && mysql_num_rows($result) > 0){

	$row = mysql_fetch_array($result);
	
	$content = $row['content'];
	
	header('Content-type: image/png');
     echo $content;
	
	while ($assoc = mysql_fetch_assoc($result)){
		$id = $assoc['id'];
		$name = $assoc['name'];
		$size = $assoc['size'];
		$content = $assoc['content'];
		
		$img = glob($content);
		
		echo "<img src='$img' alt='doh' />";
	}
	
}

*/

?>