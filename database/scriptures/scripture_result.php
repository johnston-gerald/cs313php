<?php
$book = "%";
// Create var to hold book name
if (isset($_GET['book'])) {
    $book = $_GET['book'];
    include '../database.php';
    include 'scripture.php';
    include 'scripture_model.php';
} 
//$book = "";
// Check to make sure the request method was a post
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//  // Strip input
//  $book = htmlspecialchars($_POST["book"]);
//}

// Display header
//$heading = "Book Results for $book";
//echo "<h1>$heading</h1>";

// Call function to get scriptures
$scriptures = searchScriptures($book);
$topics = getTopics();

// Display each of the scriptures found.
foreach ($scriptures as $scripture) {   
    $id = $scripture->getId();
    $book = $scripture->getBook();
    $chapter = $scripture->getChapter();
    $verse = $scripture->getVerse();
    $content = $scripture->getContent();
    
    $output = array();
    foreach ($topics as $topic) {
        $scripture_id = $topic->getScripture_id();
        if($scripture_id == $id){
            $output[] = $topic->getName();
        }
    }
    $topics_string = implode(', ', $output);
    
    echo "<br><span class='bold'>$book $chapter:$verse</span> - \"$content\"<br>"
       . "<span class='scriptureTopic'>Topics: $topics_string</span><br>";
}