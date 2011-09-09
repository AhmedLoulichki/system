<?php

header("content-type:text/html; charset=utf-8");
require_once 'classes/auth.php';
$auth = new Auth();
require_once 'classes/post_mysql.php';
$post = new post_mysql();

if (!isset($_SESSION['status']) && $_SESSION['status'] != 'authorized' && $_SESSION['status'] != 'admin') {
    header("location: login.php");
}

if (isset($_GET['status']) && $_GET['status'] == 'loggedout') {
    $auth->logout();
    header("location: login.php");
}

if ($_POST && strlen($_POST['title']) > 0 && strlen($_POST['message']) > 0) {
    if ($_FILES['userfile']['size'] > 0) {
        //TODO Here we send the file into the "add_post" function too.
        // Still have to make this work in the class.
        $response = $post->add_post($_POST['title'], $_POST['message'], $_SESSION['username'], $_POST['userfile']);
    }
    $response = $post->add_post($_POST['title'], $_POST['message'], $_SESSION['username']);
    header("location: admin.php");
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
        <a href="admin.php">Back</a>
        <div id="add_post">
            <form method="post" enctype="multipart/form-data" action="">
                <h2>Add new post</h2>
                <p>
                    <label for="title">Title: </label><br />
                    <input type="text" name="title" placeholder="Title" autofocus="autofocus" required="required" /><br />

                    <label for="message">Message: </label><br />
                    <textarea name="message" placeholder="Message..." required="required" rows="8" cols="30"></textarea><br />

                    <label for="userfile">Image: </label><br />
                    <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
                    <input name="userfile" type="file" /><br />

                    <input type="submit" id="submit" value="Submit" name="submit" />
                </p>
            </form>
            <?php if (isset($response))
                echo "<h4 class='alert'>" . $response . "</h4>"; ?>
        </div>
    </body>
</html>