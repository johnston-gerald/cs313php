<?php
/*Insert Scripture*/
include '../database.php';
include 'scripture.php';
include 'scripture_model.php';

$scripture_db = new Database();
$db = $scripture_db->getDB('scriptures');

// Insert the scripture
//try {

$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];

  $stmt = $db->prepare('INSERT INTO scriptures (book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)');
  $stmt->bindValue(':book', $book);
  $stmt->bindValue(':chapter', $chapter);
  $stmt->bindValue(':verse', $verse);
  $stmt->bindValue(':content', $content);
  // Insert the data
  $stmt->execute();
  $stmt->closeCursor();
//} catch (PDOException $exc) {
//  header('location: database/error.php');
//  exit;
//}

// Get the id of the inserted scripture value
$newId = $db->lastInsertId();
// Get the possible topics
$topics = getAllTopics();
foreach ($topics as $topic) {
  if (isset($_POST[$topic->getName()])) {
    $stmt = $db->prepare("INSERT INTO topic_scripture_link (scripture_id, topic_id) VALUES(:s_id, 
    (SELECT id FROM topics WHERE name = :topic))");
    $stmt->bindParam(':s_id', $newId);
    $stmt->bindParam(':topic', $topic->getName());
    $stmt->execute();
    $stmt->closeCursor();
  }
}

if (isset($_POST['new_topic']) && isset($_POST['new_topic_name'])) {
  $stmt = $db->prepare("INSERT INTO topics (name) VALUES (:name)");
  $stmt->bindParam(':name', $_POST['new_topic_name']);
  $stmt->execute();
  $stmt->closeCursor();
  
  $newTopicId = $db->lastInsertId();
  $stmt = $db->prepare("INSERT INTO topic_scripture_link (scripture_id, topic_id) VALUES(:sId, :tId)");
  $stmt->bindParam(':sId', $newId);
  $stmt->bindParam(':tId', $newTopicId);
  $stmt->execute();
  $stmt->closeCursor();
}

// return the scriptures
include 'database/scriptures/scripture_result.php';