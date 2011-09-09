<?php

header("content-type:text/html; charset=utf-8");
require_once 'classes/auth.php';
$auth = new Auth();
require_once 'classes/post_mysql.php';
$post = new post_mysql();

if ($_SESSION['status'] != 'admin') {
    header("location: index.php");
}

if (isset($_GET['status']) && $_GET['status'] == 'loggedout') {
    $auth->logout();
    header("location: login.php");
}
if ($_POST && strlen($_POST['title']) > 0 && strlen($_POST['message']) > 0) {
    $post->edit_post($_GET['id'], $_POST['title'], $_POST['message']);
    header("location: admin.php");
}

$result = $post->get_post($_GET['id']);
if (mysql_num_rows($result) > 0) {
    $assoc = mysql_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>system</title>
        <!--        <link type="text/css" rel="stylesheet" href="css/main.css" />-->
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <a href="admin.php">Back</a>
        <div id="add_post">
            <form method="post" action="">
                <h2>Edit post</h2>
                <p>
                    <label for="title">Title: </label><br />
                    <input type="text" name="title" placeholder="Title" autofocus="autofocus" required="required" value="<?php echo $assoc['title']; ?>" /><br />

                    <label for="message">Message: </label><br />
                    <textarea name="message" placeholder="Message..." required="required" rows="8" cols="30"><?php echo $assoc['message']; ?></textarea><br />

                    <input type="submit" id="submit" value="Submit" onclick="submit()" name="submit" />
                </p>
            </form>
            <?php if (isset($response))
                echo "<h4 class='alert'>" . $response . "</h4>"; ?>
        </div>
    </body>