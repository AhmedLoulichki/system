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
        <title>Login</title>
       	<script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link type="text/css" href="css/main.css" rel="stylesheet" media="screen" />
    </head>
    <body>
    	<div id="wrapper">
    	
	    	<div id="sidebar_wrapper">
	       	    <a href="register.php" title="Register">Register</a>
	    	</div>
	    	<div style="clear: left;"></div>
	    	
	   		<div id="post_wrapper">
		   		<div class="post">
		        	<form method="post" action="" id="login_form">
		            	<h2>Login</h2>
		                <p>
		                    <input type="text" name="username" placeholder="Username" required="required" /><br />
		
		                    <input type="password" name="password" placeholder="Password" required="required" /><br />
							
							<?php if (isset($response))
		              			echo "<h4 class='alert'>" . $response . "</h4>"; ?>
		              			
		                    <input type="submit" id="submit" value="Login" name="submit" />
		                </p>
		       		</form>
		            
		    	</div>
	    	<!-- #post_wrapper END -->
        	</div>
        	<div class="clear"></div>
        </div>
    </body>