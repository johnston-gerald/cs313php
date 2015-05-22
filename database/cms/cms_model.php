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
        $query = 'SELECT page_id, title, category_id
                  FROM page';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $cms = array();
        foreach ($result as $row) {
            $page = new Nav($row['page_id'], $row['title'], $row['category_id']);
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
        $query = 'SELECT page_id, title, content, date_created, date_last_modified, username, name
                  FROM page AS p
                  INNER JOIN admin AS a
                    ON p.admin_id = a.admin_id
                  INNER JOIN category AS c
                    ON  p.category_id = c.category_id
                  WHERE page_id = :page_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':page_id', $page_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $cms = array();
        foreach ($result as $row) {
            $page = new CMS($row['page_id'], $row['title'], $row['content'], 
                    $row['date_created'], $row['date_last_modified'], 
                    $row['username'], $row['name']);
            $cms[] = $page;
        }
        return $cms;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}

function getStyle() {
    global $db;
    static $active_style;
    
    try {
        $query = 'SELECT active_style 
                  FROM selected_style
                  WHERE selected_style_id = "1"';
        $statement = $db->prepare($query);
        //$statement->bindValue(':page_id', $page_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        //$style = array();
        foreach ($result as $row) {
            $active_style = $row['active_style'];
        }
        
        return $active_style;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}