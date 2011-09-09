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
    </head>
    <body>
    	<ul>
    		<li>En funktion som för alla text input fält tar det som står i rel attributet och lägger till ett span till höger om inputfältet.
    		Sätt alla input fält in i en div eller p och sedan skicka in texten från rel attributet i den div eller p.
    		Har börjat i script.js
    		Gör en generell funktion som fungerar för alla utan konfig för varje enskild.</li>
    	</ul>
    </body>
</html>