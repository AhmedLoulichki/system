<?php

header("content-type:text/html; charset=utf-8");

require_once 'classes/auth.php';
$auth = new Auth();

if ($_SESSION['status'] != 'admin') {
    header("location: index.php");
}

if (isset($_GET['status']) && $_GET['status'] == 'loggedout') {
    $auth->logout();
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>system</title>
        <script type="text/javascript" src="js/script.js"></script>
        <style>	li {margin-bottom: 15px;} </style>
    </head>
    <body>
    	<ul>
    		<li>Funktion som gör så att den markerar de input fält som inte är ifyllda med en röd ram.</li>
    		<li>Få delete post att fungera med bilder!
    			Har en sql query skriven som jag tycker borde fungera utmärkt men jag får syntax error! :/</li>
    		<li>Skapa en post med en bild fungerar inte då den får tillbaka fel imageID från mysql_insert_id i post_mysql.php</li>
    	</ul>
    </body>
</html>