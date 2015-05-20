<?php
// Create var to hold book name
$book = "";
// Check to make sure the request method was a post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Strip input
  $book = htmlspecialchars($_POST["book"]);
}

// Display header
$heading = "Book Results for $book";
echo "<h1>$heading</h1>";

//include '../database.php';
include 'database/scriptures/scripture.php';
include 'database/scriptures/scripture_model.php';

// Call function to get scriptures
$scriptures = searchScriptures($book);

// Display each of the scriptures found.
foreach ($scriptures as $row) {   
    $book = $row->getBook();
    $chapter = $row->getChapter();
    $verse = $row->getVerse();
    $content = $row->getContent();
    
    echo "<br><span class='bold'>$book $chapter:$verse</span> - \"$content\"<br>";
}
?>

<br>
<a href='index.php?action=assignments/scriptures.php'>Back to Scripture Resources</a>