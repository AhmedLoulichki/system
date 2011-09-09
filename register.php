<?php

header("content-type:text/html; charset=utf-8");
require_once 'classes/auth.php';
$auth = new Auth();

// Did the user enter a password/username and click submit?
if ($_POST && strlen($_POST['email']) && strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0) {
    $response = $auth->register($_POST['email'], $_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>system</title>
        <!--        <link type="text/css" rel="stylesheet" href="css/main.css" />-->
    </head>
    <body>
        <div id="login">
            <form method="post" action="">
                <h2>Register</h2>
                <p>
                    <label for="email">Email:</label><br />
                    <input type="email" name="email" placeholder="email" autofocus /><br />

                    <label for="username">Username: </label><br />
                    <input type="text" name="username" placeholder="username" /><br />

                    <label for="password">Password: </label><br />
                    <input type="password" name="password" placeholder="password" /><br />

                    <input type="submit" id="submit" value="Register" name="submit" />
                </p>
            </form>
            <?php if (isset($response))
                echo "<h4 class='alert'>" . $response . "</h4>"; ?>

            <a href="login.php" title="Login">Login</a>
        </div>
    </body>