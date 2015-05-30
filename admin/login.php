<?php
    require_once('authentication/util/secure_conn.php');  // require a secure connection
    
    $username='';
    $password='';
    $login_message = '';
    
    // If the user isn't logged in, force the user to login
    if (!isset($_SESSION['is_valid_user'])) {
        if(isset($_POST['username'])){
            $username = $_POST['username'];
        } else {
            $username = '';
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        } else {
            $password = '';
        }
        if (isValidUserLogin($username, $password)) {
            $_SESSION['is_valid_user'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['admin_id'] = getUserId($username);
            $login_message = 'Login successful.';
        } elseif(isset($_POST['login'])){
                $login_message = 'Incorrect username or password.';
        }
    }