<?php
$scripture_db = new Database();
$db = $scripture_db->getDB('scriptures');

//function display_db_error($error_message) {
//    $error = $error_message;
//    include 'database/error.php';
//    exit;
//}

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
        header('location: database/error.php');
        exit;
    }
}

/*
GET SCRIPTURES
Queries the scriptures table to get a list of scriptures that
have the passed book. Returns an array of scriptures.
*/
function searchScriptures($book) {
  global $db;
  
//  try {
    // Create select statement
    $query = 'SELECT book, chapter, verse, content
              FROM scriptures
              WHERE book = :book
              ORDER BY book, chapter, verse DESC';

    // Get results
    $statement = $db->prepare($query);
    $statement->bindValue(':book', $book);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    
    // Read results into a Scripture array
      $scriptures = array();
      foreach ($result as $row) {
          $scripture = new Scripture($row['book'], $row['chapter'], $row['verse'], $row['content']);
          $scriptures[] = $scripture;
      }
      
      // Return scriptures.
      return $scriptures;
    
//  } catch (PDOException $exc) {
//    header('location: database/error.php');
//  }
}

/*
GET BOOKS
Queries the scripture table to get a list of the books. Returns
an array of strings representing books.
*/
function getBooks() {
  global $db;
  
  try {
    // Write select all distinct books query
    $query = 'SELECT DISTINCT book
              FROM scriptures
              ORDER BY book DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    // Store results
    $result = $statement->fetchAll();
    $statement->closeCursor();
    
    // Create array to store books
    $books = array();
    // Loop through each result
    foreach($result as $row) {
      // Add the book field to our books array
      $books[] = $row['book'];
    }
    
    // Return our array of books
    return $books;
    
  } catch (PDOException $exc) {
    header('location: database/error.php');
    exit;
  }
}
