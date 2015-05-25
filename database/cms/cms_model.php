<?php
$cms_db = new Database();
$db = $cms_db->getDB('cms');

//function display_db_error($error_message) {
//    $error = $error_message;
//    include '../database/error.php';
//    exit;
//}

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

function getStyles() {
    global $db;
    
    try {
        $query = 'SELECT style_id, style_name 
                  FROM style';
        $statement = $db->prepare($query);
        //$statement->bindValue(':page_id', $page_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        $styles = array();
        foreach ($result as $row) {
            $styles = new Style($row['style_id'], $row['style_name']);
            $cms[] = $styles;
        }
        
        return $cms;
        
    } catch (PDOException $exc) {
        header('location: database/error.php');
        exit;
    }
}

function setStyle($active_style) {
    global $db;
    $query = 'UPDATE selected_style
              SET active_style = :active_style
              WHERE selected_style_id = "1"';
    $statement = $db->prepare($query);
    $statement->bindValue(':active_style', $active_style);
    $statement->execute();
    $statement->closeCursor();
}

function savePage($title, $content, $admin_id, $category_id) {
    global $db;

    $query = 'INSERT INTO page
                 (title, content, date_created, date_last_modified, admin_id, category_id)
              VALUES
                 (:title, :content, NOW(), NOW(), :admin_id, :category_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->bindValue(':category_id', $category_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function saveCategory($category_name) {
    global $db;

    $query = 'INSERT INTO category
                 (name)
              VALUES
                 (:category_name)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}