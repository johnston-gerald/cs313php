<?php
$heading = 'Scripture Resources';
    echo "<h1>$heading</h1>";

include 'database/scripture.php';
include 'database/database.php';
include 'database/scripture_model.php';

$scriptures = getScriptures();
foreach ($scriptures as $row) {   
    $book = $row->getBook();
    $chapter = $row->getChapter();
    $verse = $row->getVerse();
    $content = $row->getContent();
    
    echo "<br><span class='bold'>$book $chapter:$verse</span> - \"$content\"<br>";
}