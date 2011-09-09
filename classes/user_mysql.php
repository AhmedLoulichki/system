<?php

require_once 'variables.php';
require_once 'ssha.php';

class user_mysql {

    public function __construct() {
        mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD) or die("Couldnt connect to mysql!<br />" . mysql_error());
        mysql_select_db(DBNAME) or die("Couldnt select database!<br />" . mysql_error());
    }

    /*
     * function to handle the register SQL queries
     */
    public function sql_register($email, $username, $password) {
        $sql = "SELECT * FROM " . USERTABLE . " WHERE username = '$username' OR email = '$email'";
        $result = mysql_query($sql) or die("sql register query failed!<br />" . mysql_error());

        if (mysql_num_rows($result) > 0) {
            return 'false';
            exit();
        }

        $email = mysql_real_escape_string($email);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);

        $ssha = new ssha();
        $hashed_password = $ssha->hashSSHA($password);

        $sql2 = "INSERT INTO " . USERTABLE . " (email, username, password) VALUES ('$email','$username','$hashed_password')";
        $result2 = mysql_query($sql2) or die("sql 2 register query failed!<br />" . mysql_error());
        
        return 'true';
    }

    /*
     * function to handle the login SQL queries
     */
    public function sql_login($username, $password) {
        $ssha = new ssha();
        $hashed_password = $ssha->hashSSHA($password);

        $sql = "SELECT * FROM " . USERTABLE . " WHERE username = '$username' AND password = '$hashed_password'";
        $result = mysql_query($sql) or die("sql_login query failed!<br />" . mysql_error());

        return $result;
    }

}

?>