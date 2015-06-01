<?php
//this is a workaround for PHP 5.3-5.4 (not necessary for PHP 5.5+)
if (version_compare(PHP_VERSION, '5.5.0') < 0) {
    require 'password.php';
}

$login_db = new Database();
$db = $login_db->getDB('login');

function addNewUser($username, $password) {
    global $db;
    $pword = password_hash($password, PASSWORD_DEFAULT);
    
    $query = 'INSERT INTO login (username, password)
              VALUES (:username, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $pword);
    $statement->execute();
    $statement->closeCursor();
}

function isLoggedIn($username, $password) {
    global $db;
    $query = 'SELECT login_id, password
              FROM login
              WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $valid_user = ($statement->rowCount() == 1);
    $result = $statement->fetchAll();
    $statement->closeCursor();
    
    $hash = '';
    foreach ($result as $row) {
        $hash = $row['password'];
    }
    $valid_password = password_verify($password, $hash);
    
    return ($valid_user && $valid_password);
}

function getLoginId($username) {
    global $db;
    
    try {
        $query = 'SELECT login_id
                  FROM login
                  WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        //$style = array();
        foreach ($result as $row) {
            $login_id = $row['login_id'];
        }
        
        return $login_id;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}

function isUniqueUsername($username) {
    global $db;
    $query = 'SELECT login_id FROM login
              WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $valid = ($statement->rowCount()==0);
    $statement->closeCursor();
    return $valid;
}

function validatePassword($password) {
    $errors = '';
    $break = '';

    if (strlen($password) < 7) {
        $errors .= "Password too short!";
        $break = "<br>";
    }
    
    if (!preg_match("#[0-9]+#", $password)) {
        $errors .= "$break" . "Password must include at least one number!";
        $break = "<br>";
    }
    
//disabled for testing purposes
//    if (!preg_match("#[a-zA-Z]+#", $password)) {
//        $errors .= "$break" . "Password must include at least one letter!";
//    }
    return ($errors);
}