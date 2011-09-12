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
    if($_FILES['userfile']) {
    	$response = $post->add_post($_POST['title'], $_POST['message'], $_SESSION['username'], $_POST['userfile']);
    	
    	if(!$response){
	  		header("location: admin.php");
		}
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Create post</title>
       	<script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link type="text/css" href="css/main.css" rel="stylesheet" media="screen" />
    </head>
    <body>
        <div id="wrapper">
    	
	    	<div id="sidebar_wrapper">
	       	    <a href="admin.php" title="Back">Back</a>
	    	</div>
	    	<div style="clear: left;"></div>
	    	
	   		<div id="post_wrapper">
		   		<div class="post">
		        	<form method="post" action="" id="create_post_form" enctype="multipart/form-data">
		            	<h2>Create post</h2>
		                <p>
		                    <input type="text" name="title" placeholder="Title" required="required" /><br />
		                    
		                    <textarea name="message" placeholder="Message..." required="required" rows="6" cols="35"></textarea><br />
		
		                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    		<input name="userfile" type="file" /><br />
							
							<?php if (isset($response))
		              			echo "<h4 class='alert'>" . $response . "</h4>"; ?>
		              			
		                    <input type="submit" id="submit" value="Create" name="submit" />
		                </p>
		       		</form>
		    	</div>
	    	<!-- #post_wrapper END -->
        	</div>
        	<div class="clear"></div>
        </div>
    </body>
</html>