<?php

header("content-type:text/html; charset=utf-8");
require_once 'classes/post_mysql.php';
$post = new post_mysql();

require_once 'classes/auth.php';
$auth = new Auth();

if ($_SESSION['status'] != 'admin') {
    header("location: index.php");
}

if (isset($_GET['status']) && $_GET['status'] == 'loggedout') {
    $auth->logout();
    header("location: login.php");
}

if (isset($_GET['delete_post_id']) && $_SESSION['status'] == 'admin') {
    $post->delete_post($_GET['delete_post_id']);
    header("location: admin.php");
}

if (isset($_GET['edit_post_id']) && $_SESSION['status'] == 'admin') {
    header("location: edit_post.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link type="text/css" href="css/main.css" rel="stylesheet" media="screen" />
    </head>
    <body>
    	<div id="wrapper">
    	
    	<div id="sidebar_wrapper">
    		<a href=add_post.php>Add new post</a><br />
    		<a href="todo.php">TODO</a><br />
    		<a href="test/">Testmiljö</a><br />
	        <a href="#" onclick="logout()">Logout</a>
    	</div>
    	<div style="clear: left;"></div>
        
        <div id="post_wrapper">
        <?php $result = $post->get_all_posts();
        if (mysql_num_rows($result) > 0):
            while ($assoc = mysql_fetch_assoc($result)): ?>
            
            	<div class="post">
                	<h2 class="post_title"><?php echo $assoc['title']; ?></h2>
                    <img src="css/img/user.png" /><span class="post_author"><?php echo $assoc['author']; ?></span>
                    
                    <div class="post_message">
                    	<p class="post_created"><?php echo $assoc['created']; ?></p>
                    	<p><?php echo nl2br($assoc['message']); ?></p>
                    </div>
                    
                    <p class="post_links"><a href="edit_post.php?id=<?php echo $assoc['id']; ?>">Edit post</a> -
                    <a href="#" onclick="delete_post(<?php echo $assoc['id']; ?>)">Delete post</a></p>
                </div>                
	  <?php endwhile;
        endif; ?>
        
        <!-- #post_wrapper END -->
        </div>
        <div class="clear"></div>
        
        
        </div>
    </body>
</html>