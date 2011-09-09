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
    		<li>Byt ut alla namn på variabler, funktioner, klasser m.m från "message" till "post".
Eftersom "message" egentligen pekar på den delen i varje inlägg som innehåller meddelandet.
"post" är översättningen av inlägg till engelska.</li>
			<li>Sätta in:<br />
			header("content-type:text/html; charset=utf-8");<br />
			i alla sidor högst upp. Redan implementerat på admin.php! Checka!</li>
    	</ul>
    </body>
</html>