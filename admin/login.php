<?php
    require_once('authentication/util/secure_conn.php');  // require a secure connection
    
    $username='';
    $password='';
    $login_message = '';
//    $login='';
//    if(isset($_POST['username']) && isset($_POST['password'])){
//        $username=$_POST['username'];
//        $password=$_POST['password'];
//        $login=$_POST['login'];
//    }
    
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
//            $_SESSION['admin'] = isAdmin($username);  //set admin access
//            include('comments/index.php');
        } elseif(isset($_POST['login'])){
                $login_message = 'Incorrect username or password.';
//            include('view/login.php');
        }
    }
//    else {
//        include('comments/index.php');
//    }