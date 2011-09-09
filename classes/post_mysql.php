<?php

require_once 'variables.php';

class post_mysql {

    public function __construct() {
        mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD) or die("Couldnt connect to mysql!<br />" . mysql_error());
        mysql_select_db(DBNAME) or die("Couldnt select database!<br />" . mysql_error());
    }

    public function get_all_posts() {
        $sql = "SELECT * FROM " . POSTTABLE . " ORDER BY created DESC LIMIT 10";
        $result = mysql_query($sql) or die("sql get_all_posts query failed!<br />" . mysql_error());

        return $result;
    }

    public function add_post($title, $message, $username) {
        $title = mysql_real_escape_string($title);
        $message = mysql_real_escape_string($message);
        $username = mysql_real_escape_string($username);

        $created = date('Y-m-d');

        $sql = "INSERT INTO " . POSTTABLE . " (title, message, author, created) VALUES ('$title','$message','$username','$created')";
        $result = mysql_query($sql) or die("sql add_post query failed!<br />" . mysql_error());
    }

    public function delete_post($post_id) {
        $sql = "DELETE FROM " . POSTTABLE . " WHERE id = " . $post_id;
        $result = mysql_query($sql) or die("sql delete_post query failed!<br />" . mysql_error());
    }

    public function get_post($post_id) {
        $sql = "SELECT * FROM " . POSTTABLE . " WHERE id = " . $post_id;
        $result = mysql_query($sql) or die("sql get_post query failed!<br />" . mysql_error());
        return $result;
    }

    public function edit_post($post_id, $title, $message) {
        $title = mysql_real_escape_string($title);
        $message = mysql_real_escape_string($message);

        $created = date('Y-m-d');

        $sql = "UPDATE " . POSTTABLE . " SET title = '$title', message = '$message', created = '$created' WHERE id = " . $post_id;
        $result = mysql_query($sql) or die("sql edit_post query failed!<br />" . $sql . "<br />" . mysql_error());
    }

}

?>