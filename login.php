<?php

header("content-type:text/html; charset=utf-8");
require_once 'classes/auth.php';
$auth = new Auth();

// Did the user enter a password/username and click submit?
if ($_POST && strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0) {
    $response = $auth->login($_POST['username'], $_POST['password']);
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
        <div id="login_form">
            <form method="post" action="">
                <h2>Login</h2>
                <p>
                    <label for="username">Username: </label><br />
                    <input type="text" name="username" placeholder="username" autofocus="autofocus" required="required" /><br />

                    <label for="password">Password: </label><br />
                    <input type="password" name="password" placeholder="password" required="required" /><br />

                    <input type="submit" id="submit" value="Login" name="submit" />
                </p>
            </form>
            <?php if (isset($response))
                echo "<h4 class='alert'>" . $response . "</h4>"; ?>

            <a href="register.php" title="Register">Register</a>
        </div>
    </body>