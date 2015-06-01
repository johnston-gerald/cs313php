<?php
$heading = 'Home';
    echo "<h1>$heading</h1>";

include 'login_model.php';

if (!isset($_SESSION['is_logged_in'])) {    //check if user is not logged in
    include 'login_form.php';
} else  {
    include 'logout_form.php';              //display logout form if user is logged in
}

if(isset($_POST['signup'])) {         //check if signup button was clicked
    include 'signup_form.php';
}

//validate and register
if(isset($_POST['submit_reg'])){
    if(empty($_POST['username'])){
        $login_message = 'You must enter a username.';
        include('signup_form.php');
        $display_reg = true;
    } elseif($_POST['password1']!=$_POST['password2']){
        $login_message = 'The passwords do not match.';
        include('signup_form.php');
        $display_reg = true;
    } else {
        $username = $_POST['username'];
        $password = $_POST['password1'];
        
        $passwordError = validatePassword($password);
        if(!(isUniqueUsername($username))){
            $login_message = "Username ($username) already exists.";
            $display_reg = true;
            include('signup_form.php');
        }elseif(!empty($passwordError)){
            $login_message = $passwordError;
        } else{
            addNewUser($username, $password);
            $login_message = 'Registration was successful.';
        }
    }
}