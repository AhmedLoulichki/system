<?php

header("content-type:text/html; charset=utf-8");
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
    $fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];

    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    //fclose($fp);

    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }

    define('DBSERVER', 'localhost');
    define('DBUSERNAME', 'root');
    define('DBPASSWORD', '');
    define('DBNAME', 'system');

    define('USERTABLE', 'users');
    define('POSTTABLE', 'posts');

    mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD) or die("Couldnt connect to mysql!<br />" . mysql_error());
    mysql_select_db(DBNAME) or die("Couldnt select database!<br />" . mysql_error());

    $query = "INSERT INTO upload (name, size, type, content ) " .
            "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

    mysql_query($query) or die('Error, query failed<br />' . mysql_error());

    echo "<br>File $fileName uploaded<br>";
} else {
    echo "Please select a file to upload!";
}
echo "<br /><a href='form.php'>Back</a>";
?>
