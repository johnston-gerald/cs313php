<?php
$cms_db = new Database();
$db = $cms_db->getDB('cms');

function display_db_error($error_message) {
    $error = $error_message;
    include 'database/error.php';
    exit;
}

function getCategory() {
    global $db;
    
    try {
        $query = 'SELECT category_id, name
                  FROM category;';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $cms = array();
        foreach ($result as $row) {
            $category = new Category($row['category_id'], $row['name']);
            $cms[] = $category;
        }
        return $cms;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}

function getCMSNav() {
    global $db;
    
    try {
        $query = 'SELECT page_id, title, content, date_created, date_last_modified, category_id
                  FROM page';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $cms = array();
        foreach ($result as $row) {
            $page = new CMS($row['page_id'], $row['title'], $row['content'], $row['date_created'], $row['date_last_modified'], $row['category_id']);
            $cms[] = $page;
        }
        return $cms;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}

function getPage($page_id) {
    global $db, $page_id;
    
    try {
        $query = 'SELECT page_id, title, content, date_created, date_last_modified, category_id
                  FROM page
                  WHERE page_id = :page_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':page_id', $page_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $cms = array();
        foreach ($result as $row) {
            $page = new CMS($row['page_id'], $row['title'], $row['content'], $row['date_created'], $row['date_last_modified'], $row['category_id']);
            $cms[] = $page;
        }
        return $cms;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}