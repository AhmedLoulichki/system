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
    		<li>Author på varje post ska ha en mailto länk på sig. Den ska även ha en title med den e-postadressen.
    		Alltså när man hover över den ska den komma upp. Använd attributet title.</li>
    		<li>Funktion som gör så att den markerar de input fält som inte är ifyllda med en röd ram.</li>
    	</ul>
    </body>
</html>