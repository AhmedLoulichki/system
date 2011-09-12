<?php

header("content-type:text/html; charset=utf-8");
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {

	$fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $error = $_FILES['userfile']['error'];

	if($error){
		echo "Error while uploading file. Please try again.";
		echo "<br /><br /><a href='form.php'>Back</a>";
		exit;
	}
    
    if(!in_array($fileType, array('image/jpeg', 'image/png', 'image/gif'))) {
    	echo "Unsupported file extension. Supported extensions are JPG, PNG and GIF";
    	echo "<br /><br /><a href='form.php'>Back</a>";
    	exit;
    }
    
    if(filesize($tmpName) > 500000){
    	echo "Filesize must be less than 500 K";
    	echo "<br /><br /><a href='form.php'>Back</a>";
    	exit;
    }
    
    $content = file_get_contents($tmpName);
    $content = addslashes($content);

    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }

    define('DBSERVER', 'localhost');
    define('DBUSERNAME', 'root');
    define('DBPASSWORD', 'root');
    define('DBNAME', 'system');
    
    define('IMAGETABLE', 'upload');

    mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD) or die("Couldnt connect to mysql!<br />" . mysql_error());
    mysql_select_db(DBNAME) or die("Couldnt select database!<br />" . mysql_error());

    $query = "INSERT INTO " . IMAGETABLE . " (name, size, type, content ) " .
            "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

    mysql_query($query) or die('Error, query failed<br />' . mysql_error());

    echo "<b>$fileName</b> has been uploaded.";
} else {
    echo "Please select a file to upload!";
}
echo "<br /><br /><a href='form.php'>Back</a>";
?>
