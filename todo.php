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
    		<li>Måste ha en till kolumn i post table för att kunna skriva vilket id bilden som hör till det inlägget har.<br />
    		Sen får jag göra en php sida som bara visar EN bild genom att man skickar in ett id till den.<br />
    		Ungefär som album nu gör bara att den ska hämta bilden genom att få ett id med GET antar jag.<br />
    		Kolla på <a target="_blank" href='http://raynux.com/blog/2008/11/20/store-and-display-image-from-mysql-database/'>detta!</a> Speciellt på filen han kallar image.php</li>
    	</ul>
    </body>
</html>