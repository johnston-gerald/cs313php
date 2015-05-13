<?php
$db = Database::getDB('scriptures');
$page = $action;

function display_db_error($error_message) {
    $error = $error_message;
    include 'error.php';
    exit;
}

function getScriptures() {
    global $db;
    
    try {
        $query = 'SELECT book, chapter, verse, content 
                  FROM scriptures 
                  ORDER BY book, chapter, verse DESC';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $scriptures = array();
        foreach ($result as $row) {
            $scripture = new Scripture($row['book'], $row['chapter'], $row['verse'], $row['content']);
            $scriptures[] = $scripture;
        }
        return $scriptures;
        
    } catch (PDOException $exc) {
        header('location: error.php');
        exit;
    }
}