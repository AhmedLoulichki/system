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
    		<li>Funktion som gör så att den markerar de input fält som inte är ifyllda med en röd ram.</li>
    	</ul>
    </body>
</html>