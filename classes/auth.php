<?php

session_start();

require_once 'variables.php';
require_once 'user_mysql.php';
require_once 'ssha.php';

class Auth {

    public function register($email, $username, $password) {
        $user_mysql = new user_mysql();
        $result = $user_mysql->sql_register($email, $username, $password);

        if ($result == 'true') {
            header("location: index.php");
            exit();
        } else {
            return "That email or username already exists.";
            exit();
        }
    }

    public function login($username, $password) {

        $user_mysql = new user_mysql();
        $result = $user_mysql->sql_login($username, $password);

        if ($result != false && mysql_num_rows($result) == 1) {

            while ($assoc = mysql_fetch_assoc($result)) {
                $db_username = $assoc['username'];
                $db_password = $assoc['password'];
                $user_id = $assoc['id'];
                $is_admin = $assoc['admin'];
            }
        } else {
            return "Please enter a correct username and password.1";
            exit();
        }

        $ssha = new ssha();
        $hashed_password = $ssha->hashSSHA($password);

        // admin login
//        if ($username == "circuuz" && $hashed_password == "Nd7J0GcPD2AZoCeArKUBHwvpg3plYmE0") {
//            $_SESSION['status'] = 'admin';
//            $_SESSION['username'] = $db_username;
//            header("location: admin.php");
//            exit();
//        }

        if ($username === $db_username && $hashed_password === $db_password) {
            $_SESSION['username'] = $db_username;

            if ($is_admin === "1") {
                $_SESSION['status'] = 'admin';
                header("location: admin.php");
                exit();
            }
            $_SESSION['status'] = 'authorized';
            header("location: index.php");
            exit();
        } else {
            return "Please enter a correct username and password.2";
            exit();
        }
    }

    public function logout() {
        if (isset($_SESSION['status'])) {
            unset($_SESSION['status']);

            session_destroy();
        }
    }

}

?>